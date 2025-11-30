<?php

session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') {
    return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8');
}
function chkRadio($key, $v, $d) {
    return (isset($d[$key]) && $d[$key] === $v) ? 'checked' : '';
}
function inArr($key, $value, $d) {
    $arr = $d[$key] ?? [];
    if (!is_array($arr)) $arr = $arr === '' ? [] : explode(',', (string)$arr);
    return in_array($value, $arr) ? 'checked' : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Identificación Institucional — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-semibold text-gray-800">Identificación Institucional</h1>
      <ul class="flex items-center space-x-4">
        <li><a href="../SeleccionEscuelas.php" class="text-red-600 hover:text-red-800">Atrás</a></li>
      </ul>
    </nav>
  </header>

  <main class="max-w-5xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/docente_administrativo.php" method="post" id="form_identificacion" class="space-y-6">

      <!-- Primera fila: Formato Inspección, Provincia, Representante Legal -->
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Formato de Inspección Nro.</label>
          <input name="docente_formato_inspeccion" value="<?= val('docente_formato_inspeccion', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>

        <div>
          <label class="block text-sm font-medium">Provincia</label>
          <input name="docente_provincia" value="<?= val('docente_provincia', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>

        <div>
          <label class="block text-sm font-medium">Nombre de Representante Legal</label>
          <input name="docente_representante" value="<?= val('docente_representante', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </div>

      <!-- Director administrativo y periodo -->
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2">
          <label class="block text-sm font-medium">Nombre del Director Administrativo</label>
          <input name="docente_director_nombre" value="<?= val('docente_director_nombre', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Periodo (Desde - Hasta)</label>
          <div class="flex gap-2">
            <input type="date" name="docente_director_desde" value="<?= val('docente_director_desde', $d) ?>" class="w-1/2 rounded border p-2" />
            <input type="date" name="docente_director_hasta" value="<?= val('docente_director_hasta', $d) ?>" class="w-1/2 rounded border p-2" />
          </div>
        </div>
      </div>

      <!-- Cantón / Dirección / Teléfono -->
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Cantón</label>
          <input name="docente_canton" value="<?= val('docente_canton', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Dirección</label>
          <input name="docente_direccion" value="<?= val('docente_direccion', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Número telefónico</label>
          <input name="docente_telefono" value="<?= val('docente_telefono', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </div>

      <!-- Correo / Web -->
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Correo electrónico</label>
          <input name="docente_email" value="<?= val('docente_email', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Página Web (opcional)</label>
          <input name="docente_web" value="<?= val('docente_web', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Observaciones (Identificación)</label>
          <input name="docente_ident_observaciones" value="<?= val('docente_ident_observaciones', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </div>

      <!-- Nro. Resolución / Fecha -->
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Nro. Resolución de Funcionamiento</label>
          <input name="docente_resolucion" value="<?= val('docente_resolucion', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Fecha resolución</label>
          <input type="date" name="docente_resolucion_fecha" value="<?= val('docente_resolucion_fecha', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Clases teóricas presenciales</label>
          <input name="docente_clases_presenciales" value="<?= val('docente_clases_presenciales', $d) ?>" class="mt-1 w-full rounded border p-2" placeholder="ej. Sí/No o número" />
        </div>
      </div>

      <!-- Clases teóricas virtuales / Observaciones generales del bloque -->
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Clases teóricas virtuales</label>
          <input name="docente_clases_virtuales" value="<?= val('docente_clases_virtuales', $d) ?>" class="mt-1 w-full rounded border p-2" placeholder="ej. Sí/No o número" />
        </div>
        <div class="col-span-2">
          <label class="block text-sm font-medium">Observaciones (clases / identificación)</label>
          <input name="docente_clases_observaciones" value="<?= val('docente_clases_observaciones', $d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </div>

      <!-- Tipo de curso: filas con observaciones -->
      <div>
        <label class="block text-sm font-medium mb-2">Tipo de curso (marcar y agregar observaciones por fila)</label>
        <div class="overflow-x-auto border rounded">
          <table class="w-full text-sm">
            <thead>
              <tr class="bg-gray-100">
                <th class="p-2 border">Tipo</th>
                <th class="p-2 border">¿Aplica?</th>
                <th class="p-2 border">Observaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php $tipos = ['A1','A','C1','C','D','E','G']; ?>
              <?php foreach($tipos as $t): ?>
                <tr>
                  <td class="p-2 border font-medium"><?= $t ?></td>
                  <td class="p-2 border text-center">
                    <input type="checkbox" name="docente_tipo_curso[]" value="<?= $t ?>" <?= inArr('docente_tipo_curso', $t, $d) ?> />
                  </td>
                  <td class="p-2 border">
                    <input name="docente_tipo_observacion_<?= $t ?>" value="<?= val('docente_tipo_observacion_'.$t, $d) ?>" class="w-full rounded border p-1" />
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN -->
      <div>
        <h3 class="font-semibold mb-2">IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN</h3>
        <div class="grid grid-cols-3 gap-4">
          <div class="p-3 border rounded">
            <h4 class="font-medium">Funcionario de la ANT</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="inspeccion_func_nombre" value="<?= val('inspeccion_func_nombre', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inspeccion_func_firma" value="<?= val('inspeccion_func_firma', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inspeccion_func_ci" value="<?= val('inspeccion_func_ci', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inspeccion_func_cargo" value="<?= val('inspeccion_func_cargo', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección</label>
            <input type="date" name="inspeccion_fecha" value="<?= val('inspeccion_fecha', $d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de proporcionar información</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="inspeccion_resp_nombre" value="<?= val('inspeccion_resp_nombre', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inspeccion_resp_firma" value="<?= val('inspeccion_resp_firma', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inspeccion_resp_ci" value="<?= val('inspeccion_resp_ci', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inspeccion_resp_cargo" value="<?= val('inspeccion_resp_cargo', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </div>

      <!-- Observaciones generales -->
      <div>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="docente_observaciones_generales" rows="5" class="mt-1 w-full rounded border p-2"><?= val('docente_observaciones_generales', $d) ?></textarea>
      </div>

      <div class="flex justify-between items-center pt-4">
        <button type="submit" formaction="../save.php?next=../profesionales/otro_formulario_anterior.php"
                class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700">
          Volver
        </button>

        <!-- Generar Word-->
                <button type="submit"
                    formaction="../save.php?next=../generar_word.php"
                    class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Generar Word
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                        <path d="M14 3.5V9h5.5" fill="white" opacity=".25" />
                        <path d="M12 11v5m0 0l-2.5-2.5M12 16l2.5-2.5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
      </div>
    </form>
  </main>
</body>
</html>