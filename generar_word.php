<?php
session_start(); // Mantiene los datos entre formularios
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Ruta a la plantilla base
$tpl = __DIR__ . '/plantillas/prueba.docx';
if (!is_file($tpl)) {
    http_response_code(500);
    exit("No se encontró la plantilla: $tpl");
}

// Cargar la plantilla
$tp = new TemplateProcessor($tpl);


$datos = array_merge($_SESSION['acta'] ?? [], $_POST ?? []);

// Función para limpiar valores y manejar arreglos
$norm = function ($v) {
    return is_array($v)
        ? implode(', ', array_map('trim', $v))
        : trim((string)$v);
};

// Rellenar placeholders con los datos recibidos
foreach ($datos as $k => $v) {
    $tp->setValue($k, $norm($v));
}

// Radios que deben ir en mayúsculas (SI/NO)
foreach (['recuperacion', 'actualizacion'] as $r) {
    if (isset($datos[$r])) {
        $tp->setValue($r, strtoupper($norm($datos[$r])));
    }
}
// Evitar que haya salida previa antes de headers
if (function_exists('ob_get_length') && ob_get_length()) {
    ob_end_clean();
}

// Crear archivo temporal
$tmpFile = tempnam(sys_get_temp_dir(), 'acta_');
$tp->saveAs($tmpFile);

// Forzar descarga directa al navegador
$nombreDescarga = 'Acta_Inspeccion_' . date('Ymd_His') . '.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $nombreDescarga . '"');
header('Content-Length: ' . filesize($tmpFile));
readfile($tmpFile);

// Borrar el archivo temporal
unlink($tmpFile);

// Limpiar solo los datos del acta (sin destruir la sesión completa)
unset($_SESSION['acta']);

exit;
