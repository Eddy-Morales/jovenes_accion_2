<?php
// ...existing code...

session_start(); // <-- permite multi-paso (SESSION) sin romper el flujo de 1 solo form
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

$tpl = __DIR__ . '/plantillas/no_profesionales.docx';
if (!is_file($tpl)) {
    http_response_code(500);
    exit("❌ No se encontró la plantilla: $tpl");
}

$tp = new TemplateProcessor($tpl);

// Une TODO: lo acumulado en pasos previos + lo recién enviado (si usas 1 solo form, $_SESSION suele estar vacío, no pasa nada)
$datos = array_merge($_SESSION['acta'] ?? [], $_POST ?? []);

// --- NUEVO: generar código único y añadir al conjunto de datos ---
$codigo = 'ACTA-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
$datos['codigo'] = $codigo;
// --- FIN nuevo ---

// Normalizador (arrays -> "A, B")
$norm = function ($v) {
    return is_array($v) ? implode(', ', array_map('trim', $v)) : trim((string)$v);
};

// Rellena todos los placeholders cuyo nombre coincida con name=""
foreach ($datos as $k => $v) {
    $tp->setValue($k, $norm($v));
}

// Asegura SI/NO en mayúsculas si existen estos radios
foreach (['recuperacion', 'actualizacion'] as $r) {
    if (isset($datos[$r])) $tp->setValue($r, strtoupper($norm($datos[$r])));
}

// --- NUEVO: generar imagen QR (opcional) e insertarla en el template ---
$outDir = __DIR__ . '/salida';
if (!is_dir($outDir)) mkdir($outDir, 0775, true);

$tmpDir = $outDir . '/tmp';
if (!is_dir($tmpDir)) mkdir($tmpDir, 0775, true);

// Genera QR usando Google Chart API (puedes cambiar por otra librería si prefieres local)
$qrFile = $tmpDir . '/qr_' . preg_replace('/[^A-Z0-9_-]/', '_', $codigo) . '.png';
$qrUrl = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . urlencode($codigo);
file_put_contents($qrFile, file_get_contents($qrUrl));

// Inserta la imagen en el marcador ${qr_codigo} de la plantilla
// Asegúrate de tener en la plantilla un campo de imagen con el nombre "qr_codigo"
$tp->setImageValue('qr_codigo', array('path' => $qrFile, 'width' => 120, 'height' => 120, 'ratio' => false));
// --- FIN nuevo ---

// Guardar y descargar
$out = $outDir . '/Acta_Inspeccion_' . date('Ymd_His') . '.docx';
$tp->saveAs($out);

// limpia el tmp QR
if (is_file($qrFile)) @unlink($qrFile);

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . basename($out) . '"');
header('Content-Length: ' . filesize($out));
readfile($out);

// Si fue un flujo multi-paso, limpia sesión para iniciar un nuevo registro
session_destroy();