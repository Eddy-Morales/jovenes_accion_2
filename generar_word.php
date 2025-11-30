<?php

session_start();
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Ruta a la plantilla base
$tpl = __DIR__ . '/plantillas/test.docx';
if (!is_file($tpl)) {
    http_response_code(500);
    exit("No se encontró la plantilla: $tpl");
}

// Inicializar contenedor de acta en sesión si hace falta
if (!isset($_SESSION['acta'])) {
    $_SESSION['acta'] = [];
}

// Cargar la plantilla
$tp = new TemplateProcessor($tpl);

// Usar el código de sesión si ya existe; si no, generarlo
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

// Armar datos asegurando que el código generado no sea sobrescrito.
// También mapear 'codigo' porque la plantilla tiene ${codigo}
$datos = array_merge(
    $_SESSION['acta'] ?? [],
    $_POST ?? [],
    [
        'codigo_unico' => $codigo_unico,
        'codigo' => $codigo_unico
    ]
);

// Función para normalizar valores y manejar arrays
$norm = function ($v) {
    if (is_array($v)) {
        return implode(', ', array_map('trim', $v));
    }
    return trim((string)$v);
};

// Rellenar placeholders con los datos recibidos
foreach ($datos as $k => $v) {
    // TemplateProcessor espera el nombre sin llaves: setValue('nombre', 'valor')
    $tp->setValue($k, $norm($v));
}

// Radios que deben ir en mayúsculas (SI/NO)
foreach (['recuperacion', 'actualizacion'] as $r) {
    if (!empty($datos[$r])) {
        $tp->setValue($r, strtoupper($norm($datos[$r])));
    }
}

// Asegurar explícitamente que los placeholders del código reciban el valor
$tp->setValue('codigo_unico', $codigo_unico);
$tp->setValue('codigo', $codigo_unico);

// Evitar salida previa que rompa los headers
if (function_exists('ob_get_length') && ob_get_length()) {
    @ob_end_clean();
}

// Crear archivo temporal y guardar el .docx
$tmpFile = tempnam(sys_get_temp_dir(), 'acta_');
$tp->saveAs($tmpFile);

// (Opcional) Guardar una copia de depuración en el proyecto para inspección manual
// @copy($tmpFile, __DIR__ . '/debug_acta_prueba.docx');

// Forzar descarga al navegador
$nombreDescarga = 'Acta_Inspeccion_' . date('Ymd_His') . '.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $nombreDescarga . '"');
header('Content-Length: ' . filesize($tmpFile));
readfile($tmpFile);

// Borrar el archivo temporal
@unlink($tmpFile);

// Conservar solo el código único en la sesión para referencia posterior
$_SESSION['acta'] = ['codigo_unico' => $codigo_unico];

exit;
?>