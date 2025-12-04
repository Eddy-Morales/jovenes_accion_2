<?php
session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') {
    return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8');
}
function valRow($base, $i, $field, $d, $def = '') {
    if (!empty($d[$base]) && isset($d[$base][$i]) && isset($d[$base][$i][$field])) {
        return htmlspecialchars($d[$base][$i][$field], ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars($def, ENT_QUOTES, 'UTF-8');
}
function chkRadioRow($base, $i, $field, $v, $d) {
    if (!empty($d[$base]) && isset($d[$base][$i]) && isset($d[$base][$i][$field]) && (string)$d[$base][$i][$field] === (string)$v) return 'checked';
    return '';
}
function chkRadio($key, $v, $d) { return (isset($d[$key]) && (string)$d[$key] === (string)$v) ? 'checked' : ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Alumnos matriculados — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-lg font-semibold">Alumnos — Control / Matriculados</h1>
      <a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/alumnos_graduados.php" method="post" enctype="multipart/form-data" class="space-y-6">

      <!-- fila fija inicial: Art. 19) Nómina de alumnos matriculados -->
      <section>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2">Base legal</th>
                <th class="border p-2">Pregunta</th>
                <th class="border p-2 text-center">Si</th>
                <th class="border p-2 text-center">No</th>
                <th class="border p-2 text-center">N/A</th>
                <th class="border p-2">Evidencia (adjuntar)</th>
                <th class="border p-2">Observación</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border p-2 align-top">
                  <strong>Art. 19) Resolución 010-DIR-ANT-2018</strong>
                </td>
                <td class="border p-2 align-top">
                  La Escuela presenta nómina de alumnos matriculados autorizados por ANT
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_presenta[respuesta]" value="SI" <?= (isset($d['nomina_presenta']['respuesta']) && $d['nomina_presenta']['respuesta']==='SI') ? 'checked' : '' ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_presenta[respuesta]" value="NO" <?= (isset($d['nomina_presenta']['respuesta']) && $d['nomina_presenta']['respuesta']==='NO') ? 'checked' : '' ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_presenta[respuesta]" value="N/A" <?= (isset($d['nomina_presenta']['respuesta']) && $d['nomina_presenta']['respuesta']==='N/A') ? 'checked' : '' ?> />
                </td>
                <td class="border p-2 align-top">
                  <input type="file" name="nomina_presenta_evidencia" class="w-full text-sm" />
                  <div class="text-xs text-gray-600 mt-1">Si ya hay archivo guardado, se mantiene.</div>
                </td>
                <td class="border p-2 align-top">
                  <input name="nomina_presenta[observacion]" value="<?= htmlspecialchars($d['nomina_presenta']['observacion'] ?? '', ENT_QUOTES,'UTF-8') ?>" class="w-full rounded border p-1 text-sm" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Datos del alumno -->
      <section>
        <h2 class="font-semibold mb-2">ALUMNO</h2>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-xs">Nombres y Apellidos del alumno</label>
            <input name="alumno_nombre" value="<?= val('alumno_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-xs">C.I.</label>
            <input name="alumno_ci" value="<?= val('alumno_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-xs">Periodo de capacitación</label>
            <input name="alumno_periodo" value="<?= val('alumno_periodo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-xs">Jornada de clases</label>
            <select name="alumno_jornada" class="mt-1 w-full rounded border p-2">
              <option value="">--</option>
              <option value="Mañana" <?= (val('alumno_jornada',$d) === 'Mañana') ? 'selected' : '' ?>>Mañana</option>
              <option value="Tarde" <?= (val('alumno_jornada',$d) === 'Tarde') ? 'selected' : '' ?>>Tarde</option>
              <option value="Noche" <?= (val('alumno_jornada',$d) === 'Noche') ? 'selected' : '' ?>>Noche</option>
            </select>
          </div>
        </div>
      </section>

      <!-- Control de requisitos (con base legal) -->
      <section>
        <h3 class="font-semibold">Control de requisitos (muestra de alumnos)</h3>
        <?php
          $items = [
            ['base'=>'Numeral 5) Art. 14) Reglamento Aplicación a la LOTTTSV','pregunta'=>'Tiene primer año de bachillerato aprobado?'],
            ['base'=>'Numeral 8) Art. 14) Reglamento Aplicación a la LOTTTSV','pregunta'=>'Tiene certificado de sangre otorgado por la cruz roja ecuatoriana?'],
            ['base'=>'Numeral 3) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene comprobante de pago de derecho de matrícula?'],
            ['base'=>'Art. 52) Resolución 010-DIR-ANT-2018','pregunta'=>'Presenta acta de matrícula del alumno?'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas psicológicas?'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas psicosensométricas?'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas médicas?'],
            ['base'=>'Numeral 4.3) Art. 4) Resolución 066-DIR-ANT-2018','pregunta'=>'Tiene permiso de aprendizaje?'],
            ['base'=>'Numeral 1) literal h) Art. 8) Resolución 010-DIR-ANT-2018','pregunta'=>'Usa el sistema biométrico para el registro de asistencia?'],
            ['base'=>'Art. 3) Resolución 066-DIR-ANT-2018','pregunta'=>'La escuela presenta la asistencia por materia?'],
            ['base'=>'Art. 3) Resolución 066-DIR-ANT-2018','pregunta'=>'Se evidencia que el alumno se encuentra recibiendo clases en el momento de la inspección?'],
            ['base'=>'Literal d) Art. 56) Resolución 010-DIR-ANT-2018','pregunta'=>'Presenta calificaciones de las materias concluidas?'],
            ['base'=>'Art. 3) Resolución 066-DIR-ANT-2018','pregunta'=>'El alumno presenta inasistencia a clases?'],
            ['base'=>'Art. 3) Resolución 066-DIR-ANT-2018','pregunta'=>'La escuela presenta la justificación de faltas?'],
            ['base'=>'Anexo 4) Resolución Nro. 566-DIR-ANT-2015','pregunta'=>'La escuela presenta el acta de consolidación?'],
            ['base'=>'Resolución Nro. 003-DIR-2011/ANT / 001-DIR-2012-ANT / 7012-DIR-2016-ANT','pregunta'=>'Presenta facturas de los pagos realizados?'],
          ];
        ?>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2">Base legal</th>
                <th class="border p-2">Pregunta</th>
                <th class="border p-2 text-center">Si</th>
                <th class="border p-2 text-center">No</th>
                <th class="border p-2 text-center">N/A</th>
                <th class="border p-2">Evidencia (adjuntar)</th>
                <th class="border p-2">Observación</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $i => $it): $idx = $i + 1; ?>
                <tr>
                  <td class="border p-2 align-top"><?= htmlspecialchars($it['base'], ENT_QUOTES, 'UTF-8') ?></td>
                  <td class="border p-2 align-top"><?= htmlspecialchars($it['pregunta'], ENT_QUOTES, 'UTF-8') ?></td>

                  <td class="border p-2 text-center align-top">
                    <input type="radio" name="items[<?= $idx ?>][respuesta]" value="SI" <?= chkRadioRow('items',$idx,'respuesta','SI',$d) ?> />
                  </td>
                  <td class="border p-2 text-center align-top">
                    <input type="radio" name="items[<?= $idx ?>][respuesta]" value="NO" <?= chkRadioRow('items',$idx,'respuesta','NO',$d) ?> />
                  </td>
                  <td class="border p-2 text-center align-top">
                    <input type="radio" name="items[<?= $idx ?>][respuesta]" value="N/A" <?= chkRadioRow('items',$idx,'respuesta','N/A',$d) ?> />
                  </td>

                  <td class="border p-2 align-top">
                    <input type="file" name="items_evidencia[<?= $idx ?>]" class="w-full text-sm" />
                    <div class="text-xs text-gray-600 mt-1">Si ya hay archivo guardado, se mantiene.</div>
                  </td>

                  <td class="border p-2 align-top">
                    <input name="items[<?= $idx ?>][observacion]" value="<?= valRow('items',$idx,'observacion',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
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