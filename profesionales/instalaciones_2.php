<?php

session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') {
    return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8');
}
function chkRadio($key, $v, $d) {
    return (isset($d[$key]) && (string)$d[$key] === (string)$v) ? 'checked' : '';
}
function sel($key, $v, $d) {
    return (isset($d[$key]) && (string)$d[$key] === (string)$v) ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Instalaciones — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-semibold text-gray-800">Instalaciones — Laboratorio / Baños / Bar / Área práctica / Parqueadero</h1>
      <ul class="flex items-center space-x-4"><li><a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a></li></ul>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/instalaciones_2.php" method="post" id="form_instalaciones2" class="space-y-6">

      <!-- LABORATORIO PSICOSENSOMÉTRICO -->
      <section>
        <h2 class="font-semibold mb-2">LABORATORIO PSICOSENSOMÉTRICO</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Espacio físico adecuado</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="lab_espacio" value="SI" <?= chkRadio('lab_espacio','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="lab_espacio" value="NO" <?= chkRadio('lab_espacio','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Evita filtraciones sonoras</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="lab_filtraciones" value="SI" <?= chkRadio('lab_filtraciones','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="lab_filtraciones" value="NO" <?= chkRadio('lab_filtraciones','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Observaciones</label>
            <input name="lab_observaciones" value="<?= val('lab_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>

        <div class="grid grid-cols-4 gap-4 mt-3">
          <div>
            <label class="block text-sm">Equipo propiedad de la escuela</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="lab_equipo_prop" value="SI" <?= chkRadio('lab_equipo_prop','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="lab_equipo_prop" value="NO" <?= chkRadio('lab_equipo_prop','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">Marca</label>
            <input name="lab_marca" value="<?= val('lab_marca',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Homologado</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="lab_homologado" value="SI" <?= chkRadio('lab_homologado','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="lab_homologado" value="NO" <?= chkRadio('lab_homologado','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">Modelo</label>
            <input name="lab_modelo" value="<?= val('lab_modelo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-3">
          <div>
            <label class="block text-sm">Evalúa — Visual</label>
            <input type="text" name="lab_eval_visual" value="<?= val('lab_eval_visual',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Evalúa — Auditiva</label>
            <input type="text" name="lab_eval_auditiva" value="<?= val('lab_eval_auditiva',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Evalúa — Coordinación motriz</label>
            <input type="text" name="lab_eval_motriz" value="<?= val('lab_eval_motriz',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- BAÑOS -->
      <section>
        <h2 class="font-semibold mb-2">BAÑOS</h2>
        <div class="grid grid-cols-4 gap-4">
          <div>
            <label class="block text-sm">Número de baterías sanitarias</label>
            <input type="number" min="0" name="banos_num_baterias" value="<?= val('banos_num_baterias',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Limpieza</label>
            <select name="banos_limpieza" class="mt-1 w-full rounded border p-2">
              <option value="">-</option>
              <option value="EXCELENTE" <?= sel('banos_limpieza','EXCELENTE',$d) ?>>EXCELENTE</option>
              <option value="BUENA" <?= sel('banos_limpieza','BUENA',$d) ?>>BUENA</option>
              <option value="REGULAR" <?= sel('banos_limpieza','REGULAR',$d) ?>>REGULAR</option>
              <option value="MALA" <?= sel('banos_limpieza','MALA',$d) ?>>MALA</option>
            </select>
          </div>
          <div>
            <label class="block text-sm">Estado general</label>
            <input name="banos_estado" value="<?= val('banos_estado',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Observaciones baños</label>
            <input name="banos_observaciones" value="<?= val('banos_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- BAR - CAFETERÍA -->
      <section>
        <h2 class="font-semibold mb-2">BAR / CAFETERÍA</h2>
        <div class="grid grid-cols-4 gap-4">
          <div>
            <label class="block text-sm">Existe bar/cafetería</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="bar_existe" value="SI" <?= chkRadio('bar_existe','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="bar_existe" value="NO" <?= chkRadio('bar_existe','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">Capacidad</label>
            <input name="bar_capacidad" value="<?= val('bar_capacidad',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Estado</label>
            <select name="bar_estado" class="mt-1 w-full rounded border p-2">
              <option value="">-</option>
              <option value="EXCELENTE" <?= sel('bar_estado','EXCELENTE',$d) ?>>EXCELENTE</option>
              <option value="MUY BUENO" <?= sel('bar_estado','MUY BUENO',$d) ?>>MUY BUENO</option>
              <option value="BUENO" <?= sel('bar_estado','BUENO',$d) ?>>BUENO</option>
              <option value="REGULAR" <?= sel('bar_estado','REGULAR',$d) ?>>REGULAR</option>
              <option value="MALO" <?= sel('bar_estado','MALO',$d) ?>>MALO</option>
            </select>
          </div>
          <div>
            <label class="block text-sm">Observaciones bar</label>
            <input name="bar_observaciones" value="<?= val('bar_observaciones',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- ÁREA DE INSTRUCCIÓN PRÁCTICA -->
      <section>
        <h2 class="font-semibold mb-2">ÁREA DE INSTRUCCIÓN PRÁCTICA / PARQUEADERO</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Parque vial (SI/NO)</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="area_parquevial" value="SI" <?= chkRadio('area_parquevial','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="area_parquevial" value="NO" <?= chkRadio('area_parquevial','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Señalética horizontal</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="area_senal_h" value="SI" <?= chkRadio('area_senal_h','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="area_senal_h" value="NO" <?= chkRadio('area_senal_h','NO',$d) ?>> NO</label>
          </div>

          <div>
            <label class="block text-sm">Señalética vertical</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="area_senal_v" value="SI" <?= chkRadio('area_senal_v','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="area_senal_v" value="NO" <?= chkRadio('area_senal_v','NO',$d) ?>> NO</label>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-3">
          <div>
            <label class="block text-sm">Circuito autorizado por el GAD (SI/NO)</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="area_circuito" value="SI" <?= chkRadio('area_circuito','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="area_circuito" value="NO" <?= chkRadio('area_circuito','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">Estacionamientos para funcionarios</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="parq_func" value="SI" <?= chkRadio('parq_func','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="parq_func" value="NO" <?= chkRadio('parq_func','NO',$d) ?>> NO</label>
          </div>
          <div>
            <label class="block text-sm">Estacionamientos para público / instrucción</label>
            <label class="inline-flex items-center mr-2"><input type="radio" name="parq_publico" value="SI" <?= chkRadio('parq_publico','SI',$d) ?>> SI</label>
            <label class="inline-flex items-center"><input type="radio" name="parq_publico" value="NO" <?= chkRadio('parq_publico','NO',$d) ?>> NO</label>
          </div>
        </div>
      </section>

      <!-- IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN -->
      <section>
        <h3 class="font-semibold">IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN</h3>
        <div class="grid grid-cols-3 gap-4 mt-2">
          <div class="p-3 border rounded">
            <h4 class="font-medium">Funcionario de la ANT</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="inst2_fun_nombre" value="<?= val('inst2_fun_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inst2_fun_firma" value="<?= val('inst2_fun_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inst2_fun_ci" value="<?= val('inst2_fun_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inst2_fun_cargo" value="<?= val('inst2_fun_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección</label>
            <input type="date" name="inst2_fecha" value="<?= val('inst2_fecha',$d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de la Escuela</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="inst2_resp_nombre" value="<?= val('inst2_resp_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inst2_resp_firma" value="<?= val('inst2_resp_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inst2_resp_ci" value="<?= val('inst2_resp_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inst2_resp_cargo" value="<?= val('inst2_resp_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- Observaciones generales -->
      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="inst2_observaciones_generales" rows="5" class="mt-1 w-full rounded border p-2"><?= val('inst2_observaciones_generales',$d) ?></textarea>
      </section>

      <div class="flex justify-between items-center pt-4">
        <button type="submit" formaction="../save.php?next=../profesionales/instalaciones_1.php" class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700">Volver</button>
        <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white">Guardar y siguiente</button>
      </div>
    </form>
  </main>
</body>
</html>
