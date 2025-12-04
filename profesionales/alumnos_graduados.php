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
  <title>Alumnos graduados — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-lg font-semibold">Alumnos — Graduados</h1>
      <a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/alumnos_graduados.php" method="post" enctype="multipart/form-data" class="space-y-6">

      <!-- Encabezado / Fecha -->
      <div class="flex justify-between items-center mb-2">
        <div>
          <h2 class="text-base font-semibold">ACTA - Alumnos (Graduados)</h2>
        </div>
        <div>
          <label class="block text-xs">Fecha:</label>
          <input type="date" name="fecha" value="<?= val('fecha',$d) ?>" class="border rounded p-1" />
        </div>
      </div>

      <!-- Sección inicial con Art.19 (matriculados) y Art.22 (graduados) -->
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
                <td class="border p-2 align-top"><strong>Art. 19) Resolución 010-DIR-ANT-2018</strong></td>
                <td class="border p-2 align-top">La Escuela presenta nómina de alumnos matriculados</td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_matriculados_respuesta" value="SI" <?= chkRadio('nomina_alumnos_matriculados_respuesta','SI',$d) ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_matriculados_respuesta" value="NO" <?= chkRadio('nomina_alumnos_matriculados_respuesta','NO',$d) ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_matriculados_respuesta" value="N/A" <?= chkRadio('nomina_alumnos_matriculados_respuesta','N/A',$d) ?> />
                </td>
                <td class="border p-2 align-top"><input type="file" name="nomina_alumnos_matriculados_evidencia" class="w-full text-sm" /></td>
                <td class="border p-2 align-top"><input name="nomina_alumnos_matriculados_observacion" value="<?= val('nomina_alumnos_matriculados_observacion',$d) ?>" class="w-full rounded border p-1 text-sm" /></td>
              </tr>

              <tr>
                <td class="border p-2 align-top"><strong>Art. 22) Resolución 010-DIR-ANT-2018</strong></td>
                <td class="border p-2 align-top">La Escuela presenta nómina de alumnos graduados</td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_graduados_respuesta" value="SI" <?= chkRadio('nomina_alumnos_graduados_respuesta','SI',$d) ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_graduados_respuesta" value="NO" <?= chkRadio('nomina_alumnos_graduados_respuesta','NO',$d) ?> />
                </td>
                <td class="border p-2 text-center align-top">
                  <input type="radio" name="nomina_alumnos_graduados_respuesta" value="N/A" <?= chkRadio('nomina_alumnos_graduados_respuesta','N/A',$d) ?> />
                </td>
                <td class="border p-2 align-top"><input type="file" name="nomina_alumnos_graduados_evidencia" class="w-full text-sm" /></td>
                <td class="border p-2 align-top"><input name="nomina_alumnos_graduados_observacion" value="<?= val('nomina_alumnos_graduados_observacion',$d) ?>" class="w-full rounded border p-1 text-sm" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- ALUMNO: datos -->
      <section>
        <h3 class="font-semibold mb-2">ALUMNO</h3>
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

      <!-- Control de requisitos (lista con base legal y preguntas) -->
      <section>
        <h3 class="font-semibold">Control de requisitos</h3>
        <?php
          $items = [
            ['base'=>'Numeral 5) Art. 14) Reglamento Aplicación a la LOTTTSV','pregunta'=>'Tiene primer año de bachillerato aprobado?'],
            ['base'=>'Numeral 8) Art. 14) Reglamento Aplicación a la LOTTTSV','pregunta'=>'Tiene certificado de sangre otorgado por la cruz roja ecuatoriana?'],
            ['base'=>'Numeral 3) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene comprobante de pago de derecho de matrícula?'],
            ['base'=>'Art. 52) Resolución 010-DIR-ANT-2018','pregunta'=>'Presenta acta de matrícula del alumno'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas psicológicas?'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas psicosensométricas?'],
            ['base'=>'Numeral 4) Art. 17) Resolución 010-DIR-ANT-2018','pregunta'=>'Tiene pruebas médicas?'],
            ['base'=>'Numeral 4.3) Art. 4) Resolución 066-DIR-ANT-2018','pregunta'=>'Tiene permiso de aprendizaje?'],
            ['base'=>'Numeral 1) literal h) Art. 8) Resolución 010-DIR-ANT-2018','pregunta'=>'Usa el sistema biométrico para el registro de asistencia?'],
            ['base'=>'Art. 3) Resolución 066-DIR-ANT-2018','pregunta'=>'La escuela presenta la asistencia por materia?'],
            ['base'=>'Literal d) Art. 56) Resolución 010-DIR-ANT-2018','pregunta'=>'Presenta calificaciones de las materias concluidas?'],
            ['base'=>'Art. 9) Resolución 066-DIR-ANT-2018','pregunta'=>'El alumno presenta inasistencia a clases?'],
            ['base'=>'Art. 9) Resolución 066-DIR-ANT-2018','pregunta'=>'La escuela presenta la justificación de faltas?'],
            ['base'=>'Anexo 4) Resolución Nro. 586-DE-ANT-2015 (solo en caso de convalidación)','pregunta'=>'La Escuela presenta el acta de convalidación?'],
            ['base'=>'Resolución Nro. 003-DIR-2011-ANT / 001-DIR-2012-ANT / 012-DIR-2016-ANT','pregunta'=>'Presenta facturas de los pagos realizados?'],
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

              <!-- filas adicionales: nombres de instructores -->
              <tr>
                <td class="border p-2 align-top">Nombre del instructor de práctica de conducción</td>
                <td class="border p-2" colspan="6">
                  <input name="instructor_practica" value="<?= val('instructor_practica',$d) ?>" class="w-full rounded border p-2 text-sm" />
                </td>
              </tr>
              <tr>
                <td class="border p-2 align-top">Nombre del instructor que tomó el examen práctico de conducción</td>
                <td class="border p-2" colspan="6">
                  <input name="instructor_examen" value="<?= val('instructor_examen',$d) ?>" class="w-full rounded border p-2 text-sm" />
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </section>

      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="graduados_observaciones_generales" rows="4" class="mt-1 w-full rounded border p-2"><?= val('graduados_observaciones_generales',$d) ?></textarea>
      </section>

      <div class="flex justify-between items-center pt-4">
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