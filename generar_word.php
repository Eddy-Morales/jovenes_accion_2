<?php

session_start();
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Ruta a la plantilla base
$tpl = __DIR__ . '/plantillas/test.docx';
if (!is_file($tpl)) {
    http_response_code(500);
    exit("Plantilla no encontrada: $tpl");
}

// Asegurar contenedor de acta en sesión
if (!isset($_SESSION['acta'])) {
    $_SESSION['acta'] = [];
}

// Crear copia temporal de la plantilla y convertir {{campo}} -> ${campo} (si aplica)
$tmpTpl = sys_get_temp_dir() . '/tpl_' . uniqid() . '.docx';
if (!copy($tpl, $tmpTpl)) {
    exit("No se pudo crear copia temporal de la plantilla.");
}

$zip = new ZipArchive();
if ($zip->open($tmpTpl) === TRUE) {
    // Revisar y corregir archivos XML dentro del docx
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $name = $zip->getNameIndex($i);
        if (preg_match('#^(word/.*\.xml|word/_rels/.*\.xml|docProps/.*\.xml|customXml/.*\.xml)$#i', $name)) {
            $content = $zip->getFromIndex($i);
            if ($content !== false) {
                $content = preg_replace_callback(
                    '/\{\{\s*([A-Za-z0-9_]+)\s*\}\}/',
                    function ($m) { return '${' . $m[1] . '}'; },
                    $content
                );
                $zip->addFromString($name, $content);
            }
        }
    }
    $zip->close();
} else {
    @unlink($tmpTpl);
    exit("No se pudo abrir el archivo .docx temporal.");
}

// Generar o recuperar código único
if (empty($_SESSION['acta']['codigo_unico'])) {
    try {
        $codigo_unico = 'ACTA-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
    } catch (Exception $e) {
        $codigo_unico = 'ACTA-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -8));
    }
    $_SESSION['acta']['codigo_unico'] = $codigo_unico;
} else {
    $codigo_unico = $_SESSION['acta']['codigo_unico'];
}

// Merge datos: sesión (save.php debe haber guardado) y POST (por si se envía directo)
$rawDatos = array_merge($_SESSION['acta'] ?? [], $_POST ?? [], ['codigo_unico' => $codigo_unico, 'codigo' => $codigo_unico]);

// Normalizador: convierte valores a string; arrays se aplanan según reglas
$normalize_scalar = function ($v) {
    if (is_null($v)) return '';
    return trim((string)$v);
};

$flat = [];
$flatten = function ($data, $prefix = '') use (&$flatten, &$flat, $normalize_scalar) {
    foreach ($data as $k => $v) {
        $key = $prefix === '' ? (string)$k : $prefix . '_' . (string)$k;
        if (is_array($v)) {
            // distinguir array asociativo de indexado
            $isAssoc = array_values($v) !== $v;
            if ($isAssoc) {
                // recursivo
                $flatten($v, $key);
            } else {
                // indexado: si todos son escalares -> unir en lista; si hay subarrays -> indexar por número
                $allScalars = true;
                foreach ($v as $elem) {
                    if (is_array($elem)) { $allScalars = false; break; }
                }
                if ($allScalars) {
                    // guardar lista compacta
                    $parts = [];
                    foreach ($v as $elem) {
                        $s = $normalize_scalar($elem);
                        if ($s !== '') $parts[] = $s;
                    }
                    $flat[$key] = implode(', ', $parts);
                } else {
                    $idx = 1;
                    foreach ($v as $elem) {
                        // cada elemento puede ser escalar o array
                        if (is_array($elem)) {
                            $flatten($elem, $key . '_' . $idx);
                        } else {
                            $flat[$key . '_' . $idx] = $normalize_scalar($elem);
                        }
                        $idx++;
                    }
                }
            }
        } else {
            $flat[$key] = $normalize_scalar($v);
        }
    }
};

$flatten($rawDatos);

// Asegurar claves auxiliares
$flat['codigo_unico'] = $codigo_unico;
$flat['codigo'] = $codigo_unico;

// Cargar TemplateProcessor con la copia temporal
try {
    $tp = new TemplateProcessor($tmpTpl);
} catch (Exception $e) {
    @unlink($tmpTpl);
    exit("Error cargando plantilla en TemplateProcessor: " . $e->getMessage());
}

// Setear valores: TemplateProcessor requiere nombres con [A-Za-z0-9_]
foreach ($flat as $k => $v) {
    $safeKey = preg_replace('/[^A-Za-z0-9_]/', '_', $k);
    if ($safeKey === '') continue;
    // TemplateProcessor lanza excepción si la variable no existe en la plantilla?
    // setValue simplemente reemplaza si existe, no falla si no existe.
    try {
        $tp->setValue($safeKey, $v);
    } catch (Exception $e) {
        // ignorar variables problemáticas y continuar
        continue;
    }
}

// Radios comunes: forzar mayúsculas "SI"/"NO" si existen (opcional)
$radiosMayus = ['recuperacion','actualizacion'];
foreach ($radiosMayus as $r) {
    if (isset($flat[$r]) && $flat[$r] !== '') {
        try { $tp->setValue($r, strtoupper($flat[$r])); } catch (Exception $e) {}
    }
}

// Preparar salida: archivo temporal final
if (function_exists('ob_get_length') && ob_get_length()) @ob_end_clean();
$outFile = tempnam(sys_get_temp_dir(), 'acta_') . '.docx';
try {
    $tp->saveAs($outFile);
} catch (Exception $e) {
    @unlink($tmpTpl);
    exit("No se pudo generar el documento: " . $e->getMessage());
}

// Forzar descarga
$downloadName = 'Acta_Inspeccion_' . date('Ymd_His') . '.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $downloadName . '"');
header('Content-Length: ' . filesize($outFile));
readfile($outFile);

// Limpieza
@unlink($outFile);
@unlink($tmpTpl);

// (Opcional) conservar sólo el código en sesión
$_SESSION['acta'] = ['codigo_unico' => $codigo_unico];

exit;
?>