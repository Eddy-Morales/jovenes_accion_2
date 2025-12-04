<?php
session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') { return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8'); }
function chkRadio($key, $v, $d) { return (isset($d[$key]) && (string)$d[$key] === (string)$v) ? 'checked' : ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Vehículos para la capacitación — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-lg font-semibold">Vehículos para la capacitación</h1>
      <a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/docente_administrativo.php" method="post" class="space-y-6">

      <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse">
          <thead>
            <tr class="bg-gray-100">
              <th class="border p-2">No.</th>
              <th class="border p-2">Placa</th>
              <th class="border p-2">Modelo</th>
              <th class="border p-2">Año fabricación</th>

              <!-- verificaciones documentales / físicas (cada par SI/NO) -->
              <th class="border p-2">Identificación (SI/NO)</th>
              <th class="border p-2">Placa/rotulación (SI/NO)</th>
              <th class="border p-2">Cond. mecánica (SI/NO)</th>
              <th class="border p-2">Verif. frontal (SI/NO)</th>
              <th class="border p-2">Verif. posterior (SI/NO)</th>
              <th class="border p-2">Verif. lateral (SI/NO)</th>
              <th class="border p-2">Observaciones</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 1; $i <= 10; $i++): ?>
              <tr>
                <td class="border p-1 text-center"><?= $i ?></td>

                <td class="border p-1"><input name="veh_<?= $i ?>_placa" value="<?= val("veh_{$i}_placa",$d) ?>" class="w-full rounded border p-1 text-sm" /></td>
                <td class="border p-1"><input name="veh_<?= $i ?>_modelo" value="<?= val("veh_{$i}_modelo",$d) ?>" class="w-full rounded border p-1 text-sm" /></td>
                <td class="border p-1"><input type="number" min="1900" max="2100" name="veh_<?= $i ?>_ano" value="<?= val("veh_{$i}_ano",$d) ?>" class="w-full rounded border p-1 text-sm" /></td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_identificacion" value="SI" <?= chkRadio("veh_{$i}_identificacion",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_identificacion" value="NO" <?= chkRadio("veh_{$i}_identificacion",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_rotulacion" value="SI" <?= chkRadio("veh_{$i}_rotulacion",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_rotulacion" value="NO" <?= chkRadio("veh_{$i}_rotulacion",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_mecanica" value="SI" <?= chkRadio("veh_{$i}_mecanica",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_mecanica" value="NO" <?= chkRadio("veh_{$i}_mecanica",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_frontal" value="SI" <?= chkRadio("veh_{$i}_frontal",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_frontal" value="NO" <?= chkRadio("veh_{$i}_frontal",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_posterior" value="SI" <?= chkRadio("veh_{$i}_posterior",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_posterior" value="NO" <?= chkRadio("veh_{$i}_posterior",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1 text-center">
                  <label class="inline-flex items-center mr-1"><input type="radio" name="veh_<?= $i ?>_lateral" value="SI" <?= chkRadio("veh_{$i}_lateral",'SI',$d) ?> /> SI</label>
                  <label class="inline-flex items-center"><input type="radio" name="veh_<?= $i ?>_lateral" value="NO" <?= chkRadio("veh_{$i}_lateral",'NO',$d) ?> /> NO</label>
                </td>

                <td class="border p-1"><input name="veh_<?= $i ?>_observaciones" value="<?= val("veh_{$i}_observaciones",$d) ?>" class="w-full rounded border p-1 text-sm" /></td>
              </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>

      <!-- IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN -->
      <section>
        <h3 class="font-semibold mt-4">IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN</h3>
        <div class="grid grid-cols-3 gap-4 mt-2">
          <div class="p-3 border rounded">
            <h4 class="font-medium">Funcionario de la ANT</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="veh_fun_nombre" value="<?= val('veh_fun_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="veh_fun_firma" value="<?= val('veh_fun_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="veh_fun_ci" value="<?= val('veh_fun_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="veh_fun_cargo" value="<?= val('veh_fun_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección</label>
            <input type="date" name="veh_fecha" value="<?= val('veh_fecha',$d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de la Escuela</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="veh_resp_nombre" value="<?= val('veh_resp_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="veh_resp_firma" value="<?= val('veh_resp_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="veh_resp_ci" value="<?= val('veh_resp_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="veh_resp_cargo" value="<?= val('veh_resp_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="veh_observaciones_generales" rows="4" class="mt-1 w-full rounded border p-2"><?= val('veh_observaciones_generales',$d) ?></textarea>
      </section>

      <div class="flex justify-between items-center pt-4">
        <button type="submit" id="siguiente"
          class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
            Siguiente
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
      </div>
    </form>
  </main>
</body>
</html>