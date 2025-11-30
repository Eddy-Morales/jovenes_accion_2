<?php

session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') {
    return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8');
}
function valArr($base, $col, $d, $def = '') {
    if (!empty($d[$base]) && isset($d[$base][$col])) return htmlspecialchars($d[$base][$col], ENT_QUOTES, 'UTF-8');
    return htmlspecialchars($def, ENT_QUOTES, 'UTF-8');
}
// Compatibilidad: comprueba selección tipo radio (_sel) o formato antiguo array (aulas_key[col] == 'SI')
function isRadioSelected($fieldName, $col, $d) {
    // caso nuevo: campo único con sufijo _sel (valor = número de aula)
    if (isset($d[$fieldName]) && (string)$d[$fieldName] === (string)$col) {
        return 'checked';
    }
    // caso antiguo: array con claves por aula y valor "SI" o "1"
    $orig = preg_replace('/_sel$/', '', $fieldName);
    if (!empty($d[$orig]) && isset($d[$orig][$col]) && ($d[$orig][$col] === 'SI' || $d[$orig][$col] === '1')) {
        return 'checked';
    }
    return '';
}
function isCheckedLegacy($base, $col, $d) {
    if (!empty($d[$base]) && isset($d[$base][$col]) && ($d[$base][$col] === 'SI' || $d[$base][$col] === '1')) return 'checked';
    return '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Infraestructura — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-semibold text-gray-800">Infraestructura (Área administrativa / Aulas / Aula Taller)</h1>
      <ul class="flex items-center space-x-4">
        <li><a href="../SeleccionEscuelas.php" class="text-red-600 hover:text-red-800">Atrás</a></li>
      </ul>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/instalaciones_1.php" method="post" id="form_instalaciones" class="space-y-6">

      <!-- Área administrativa - campos libres -->
      <section>
        <h2 class="font-semibold mb-2">Área administrativa (ej: Recepción, Inspección, Sala de Profesores, Archivo, Área de Recreación)</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Recepción</label>
            <input name="instalaciones_recepcion" value="<?= val('instalaciones_recepcion', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Inspección / Secretaría / Departamento</label>
            <input name="instalaciones_inspeccion" value="<?= val('instalaciones_inspeccion', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
          <div>
            <label class="block text-sm">Sala de profesores / Sala de espera / Archivo</label>
            <input name="instalaciones_salas_archivo" value="<?= val('instalaciones_salas_archivo', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- Tabla AULAS (1..12) - ahora selección única por fila -->
      <section>
        <h2 class="font-semibold mb-2">AULAS (seleccione una única aula por fila)</h2>
        <div class="overflow-x-auto border rounded">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr>
                <th class="border p-2">Concepto / Aula</th>
                <?php for ($c = 1; $c <= 12; $c++): ?>
                  <th class="border p-2 text-center">A<?= $c ?></th>
                <?php endfor; ?>
                <th class="border p-2">Observaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rows = [
                'capacidad' => 'CAPACIDAD (Máximo 30 alumnos: Número)',
                'material_pedagogico' => 'MATERIAL PEDAGÓGICO (Numeral 2)',
                'proyector_computador' => 'PROYECTOR Y COMPUTADOR (Cada aula: Numeral 3)',
                'lista_alumnos' => 'LISTA DE ALUMNOS PUBLICADO CON IDENTIFICACIÓN DE HORARIOS DE CLASE (Numeral 4)',
                'ventilacion' => 'VENTILACIÓN / CLIMATIZACIÓN (Región/Costas/Oriente/Insular) (Numeral 5)',
                'camaras_video' => 'CÁMARAS DE VIDEO (Con acceso vía web) (Literal k)'
              ];
              foreach ($rows as $key => $label):
              ?>
                <tr>
                  <td class="border p-2 align-top font-medium"><?= $label ?></td>

                  <?php for ($c = 1; $c <= 12; $c++): ?>
                    <td class="border p-1 text-center">
                      <?php if ($key === 'capacidad'): ?>
                        <!-- para capacidad permite número (por aula) -->
                        <input type="number" min="0" name="aulas_<?= $key ?>[<?= $c ?>]" value="<?= valArr("aulas_{$key}", $c, $d) ?>" class="w-full text-sm p-1" />
                      <?php else: ?>
                        <!-- selección única por fila: radio -->
                        <?php $radioName = "aulas_{$key}_sel"; ?>
                        <label class="inline-flex items-center justify-center">
                          <input type="radio" name="<?= $radioName ?>" value="<?= $c ?>" <?= isRadioSelected($radioName, $c, $d) ?> />
                        </label>
                      <?php endif; ?>
                    </td>
                  <?php endfor; ?>

                  <td class="border p-1">
                    <input name="aulas_<?= $key ?>_observaciones" value="<?= val('aulas_'.$key.'_observaciones', $d) ?>" class="w-full p-1 text-sm" />
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <p class="text-xs p-2 text-gray-600">Nota: seleccione una única aula por fila que aplica para el concepto. Para CAPACIDAD puede ingresar número por cada aula.</p>
        </div>
      </section>

      <!-- AULA TALLER -->
      <section>
        <h2 class="font-semibold mb-2">AULA TALLER</h2>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="block text-sm">Material pedagógico (numeral 1)</label>
            <input name="taller_material_pedagogico" value="<?= val('taller_material_pedagogico', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-sm">Corte (si aplica)</label>
            <input name="taller_corte" value="<?= val('taller_corte', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div>
            <label class="block text-sm">Fosa o elevador (SI/NO)</label>
            <select name="taller_fosa_elevador" class="mt-1 w-full rounded border p-2">
              <option value="">-</option>
              <option value="SI" <?= val('taller_fosa_elevador', $d) === 'SI' ? 'selected' : '' ?>>SI</option>
              <option value="NO" <?= val('taller_fosa_elevador', $d) === 'NO' ? 'selected' : '' ?>>NO</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-3">
          <div>
            <label class="block text-sm">Herramientas básicas (SI/NO)</label>
            <select name="taller_herramientas" class="mt-1 w-full rounded border p-2">
              <option value="">-</option>
              <option value="SI" <?= val('taller_herramientas', $d) === 'SI' ? 'selected' : '' ?>>SI</option>
              <option value="NO" <?= val('taller_herramientas', $d) === 'NO' ? 'selected' : '' ?>>NO</option>
            </select>
          </div>

          <div>
            <label class="block text-sm">Diagrama / esquema (SI/NO)</label>
            <select name="taller_diagrama" class="mt-1 w-full rounded border p-2">
              <option value="">-</option>
              <option value="SI" <?= val('taller_diagrama', $d) === 'SI' ? 'selected' : '' ?>>SI</option>
              <option value="NO" <?= val('taller_diagrama', $d) === 'NO' ? 'selected' : '' ?>>NO</option>
            </select>
          </div>

          <div>
            <label class="block text-sm">Material pedagógico por tipo de licencia (C, C1, D, E, G)</label>
            <input name="taller_material_por_licencia" value="<?= val('taller_material_por_licencia', $d) ?>" class="mt-1 w-full rounded border p-2" />
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
            <input name="inst_fun_nombre" value="<?= val('inst_fun_nombre', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inst_fun_firma" value="<?= val('inst_fun_firma', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inst_fun_ci" value="<?= val('inst_fun_ci', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inst_fun_cargo" value="<?= val('inst_fun_cargo', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección</label>
            <input type="date" name="inst_fecha" value="<?= val('inst_fecha', $d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de la Escuela</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="inst_resp_nombre" value="<?= val('inst_resp_nombre', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="inst_resp_firma" value="<?= val('inst_resp_firma', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="inst_resp_ci" value="<?= val('inst_resp_ci', $d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="inst_resp_cargo" value="<?= val('inst_resp_cargo', $d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <!-- Observaciones generales -->
      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="inst_observaciones_generales" rows="4" class="mt-1 w-full rounded border p-2"><?= val('inst_observaciones_generales', $d) ?></textarea>
      </section>

      <div class="flex justify-between items-center pt-4">
        <button type="submit" formaction="../save.php?next=../profesionales/otro_formulario_anterior.php"
                class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700">
          Volver
        </button>

        <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white">
          Guardar y siguiente
        </button>
      </div>
    </form>
  </main>
</body>
</html>