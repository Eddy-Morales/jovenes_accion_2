<?php
session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') { return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8'); }
function chkRadio($key, $v, $d) { return (isset($d[$key]) && (string)$d[$key] === (string)$v) ? 'checked' : ''; }
function inArr($key, $v, $d) {
    $arr = $d[$key] ?? [];
    if (!is_array($arr)) $arr = $arr === '' ? [] : explode(',', (string)$arr);
    return in_array($v, $arr) ? 'checked' : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Equipos — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-lg font-semibold">Equipos — Simulador / Laboratorio / Biométrico</h1>
      <a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/vehiculos.php" method="post" class="space-y-6">

      <!-- SIMULADOR VIRTUAL -->
      <section>
        <h2 class="font-semibold mb-2">SIMULADOR DE CONDUCCIÓN VIRTUAL</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Autorización de la ANT (nº)</label>
            <input name="equip_sim_autorizacion" value="<?= val('equip_sim_autorizacion',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-sm">Simulador homologado</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_sim_homologado" value="SI" <?= chkRadio('equip_sim_homologado','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_sim_homologado" value="NO" <?= chkRadio('equip_sim_homologado','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Espacio físico adecuado</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_sim_espacio" value="SI" <?= chkRadio('equip_sim_espacio','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_sim_espacio" value="NO" <?= chkRadio('equip_sim_espacio','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="block text-sm mb-1">Simulador para categoría de licencia (marcar)</label>
          <?php $catsSim = ['C','C1','D','E','G']; foreach($catsSim as $c): ?>
            <label class="inline-flex items-center mr-3">
              <input type="checkbox" name="equip_sim_categoria[]" value="<?= $c ?>" <?= inArr('equip_sim_categoria',$c,$d) ?> /> <span class="ml-1"><?= $c ?></span>
            </label>
          <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-3">
          <div>
            <label class="block text-sm">El simulador permite — Calificar</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_sim_calificar" value="SI" <?= chkRadio('equip_sim_calificar','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_sim_calificar" value="NO" <?= chkRadio('equip_sim_calificar','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">El simulador permite — Instruir</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_sim_instruir" value="SI" <?= chkRadio('equip_sim_instruir','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_sim_instruir" value="NO" <?= chkRadio('equip_sim_instruir','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="block text-sm">Observaciones simulador</label>
          <input name="equip_sim_observaciones" value="<?= val('equip_sim_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </section>

      <!-- LABORATORIO DE CÓMPUTO -->
      <section>
        <h2 class="font-semibold mb-2">LABORATORIO DE CÓMPUTO</h2>
        <div class="grid grid-cols-4 gap-4">
          <div>
            <label class="block text-sm">Número de laboratorios</label>
            <input type="number" min="0" name="equip_lab_num" value="<?= val('equip_lab_num',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-sm">Para licencia tipo (marcar)</label>
            <?php $labs = ['A1','A','C1','C','D','E','G']; foreach($labs as $l): ?>
              <label class="inline-flex items-center mr-2">
                <input type="checkbox" name="equip_lab_tipo[]" value="<?= $l ?>" <?= inArr('equip_lab_tipo',$l,$d) ?> /> <span class="ml-1 text-sm"><?= $l ?></span>
              </label>
            <?php endforeach; ?>
          </div>

          <div>
            <label class="block text-sm">Al menos 1 computador por cada 2 alumnos</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_lab_ratio" value="SI" <?= chkRadio('equip_lab_ratio','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_lab_ratio" value="NO" <?= chkRadio('equip_lab_ratio','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Laboratorio fijo</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_lab_fijo" value="SI" <?= chkRadio('equip_lab_fijo','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_lab_fijo" value="NO" <?= chkRadio('equip_lab_fijo','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="block text-sm">Observaciones laboratorio</label>
          <input name="equip_lab_observaciones" value="<?= val('equip_lab_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </section>

      <!-- EQUIPO TECNOLÓGICO - BIOMÉTRICO -->
      <section>
        <h2 class="font-semibold mb-2">EQUIPO TECNOLÓGICO — BIOMÉTRICO</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Número de biométricos</label>
            <input type="number" min="0" name="equip_bio_num" value="<?= val('equip_bio_num',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-sm">Registra — Alumnos</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_bio_reg_alumnos" value="SI" <?= chkRadio('equip_bio_reg_alumnos','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_bio_reg_alumnos" value="NO" <?= chkRadio('equip_bio_reg_alumnos','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Registra — Docentes</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_bio_reg_docentes" value="SI" <?= chkRadio('equip_bio_reg_docentes','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_bio_reg_docentes" value="NO" <?= chkRadio('equip_bio_reg_docentes','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-3">
          <div>
            <label class="block text-sm">Registra — Instructores</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_bio_reg_instructores" value="SI" <?= chkRadio('equip_bio_reg_instructores','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_bio_reg_instructores" value="NO" <?= chkRadio('equip_bio_reg_instructores','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Conexión a internet</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="equip_bio_internet" value="SI" <?= chkRadio('equip_bio_internet','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="equip_bio_internet" value="NO" <?= chkRadio('equip_bio_internet','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="mt-3">
          <label class="block text-sm">Observaciones biométricos</label>
          <input name="equip_bio_observaciones" value="<?= val('equip_bio_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
        </div>
      </section>

      <!-- IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN -->
      <section>
        <h3 class="font-semibold">IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN</h3>
        <div class="grid grid-cols-3 gap-4 mt-2">
          <div class="p-3 border rounded">
            <h4 class="font-medium">Funcionario de la ANT</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="equip_fun_nombre" value="<?= val('equip_fun_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="equip_fun_firma" value="<?= val('equip_fun_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="equip_fun_ci" value="<?= val('equip_fun_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="equip_fun_cargo" value="<?= val('equip_fun_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección</label>
            <input type="date" name="equip_fecha" value="<?= val('equip_fecha',$d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de la Escuela</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="equip_resp_nombre" value="<?= val('equip_resp_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="equip_resp_firma" value="<?= val('equip_resp_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="equip_resp_ci" value="<?= val('equip_resp_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="equip_resp_cargo" value="<?= val('equip_resp_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- Observaciones generales + botones -->
      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="equip_observaciones_generales" rows="4" class="mt-1 w-full rounded border p-2"><?= val('equip_observaciones_generales',$d) ?></textarea>
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