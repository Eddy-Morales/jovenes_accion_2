<?php
// ...existing code...

session_start();
$d = $_SESSION['acta'] ?? [];

// Helpers
function val($key, $d, $def = '') { return htmlspecialchars($d[$key] ?? $def, ENT_QUOTES, 'UTF-8'); }
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
  <title>Instructores & Consejo — Acta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/deslizamiento.css">
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
    <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-lg font-semibold">Instructores — Consejo Académico</h1>
      <a href="../SeleccionEscuelas.php" class="text-red-600">Atrás</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <form action="../save.php?next=../profesionales/alumnos_matriculado.php" method="post" class="space-y-6">

      <!-- LISTA DE INSTRUCTORES -->
      <section>
        <h2 class="font-semibold mb-2">LA ESCUELA ENTREGA NÓMINA DE LOS INSTRUCTORES</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2">No.</th>
                <th class="border p-2">Nombre del Instructor</th>
                <th class="border p-2">Tipo de licencia a capacitar</th>
                <th class="border p-2">Hojas de vida (SI/NO)</th>
                <th class="border p-2">Certificaciones de experiencia (SI/NO)</th>
                <th class="border p-2">Observaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i = 1; $i <= 6; $i++): ?>
                <tr>
                  <td class="border p-1 text-center"><?= $i ?></td>
                  <td class="border p-1">
                    <input name="instrutores[<?= $i ?>][nombre]" value="<?= valRow('instrutores',$i,'nombre',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                  <td class="border p-1">
                    <input name="instrutores[<?= $i ?>][licencia]" value="<?= valRow('instrutores',$i,'licencia',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                  <td class="border p-1 text-center">
                    <label class="inline-flex items-center mr-1">
                      <input type="radio" name="instrutores[<?= $i ?>][hojas_vida]" value="SI" <?= chkRadioRow('instrutores',$i,'hojas_vida','SI',$d) ?> /> SI
                    </label>
                    <label class="inline-flex items-center">
                      <input type="radio" name="instrutores[<?= $i ?>][hojas_vida]" value="NO" <?= chkRadioRow('instrutores',$i,'hojas_vida','NO',$d) ?> /> NO
                    </label>
                  </td>
                  <td class="border p-1 text-center">
                    <label class="inline-flex items-center mr-1">
                      <input type="radio" name="instrutores[<?= $i ?>][cert_exper]" value="SI" <?= chkRadioRow('instrutores',$i,'cert_exper','SI',$d) ?> /> SI
                    </label>
                    <label class="inline-flex items-center">
                      <input type="radio" name="instrutores[<?= $i ?>][cert_exper]" value="NO" <?= chkRadioRow('instrutores',$i,'cert_exper','NO',$d) ?> /> NO
                    </label>
                  </td>
                  <td class="border p-1">
                    <input name="instrutores[<?= $i ?>][observaciones]" value="<?= valRow('instrutores',$i,'observaciones',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                </tr>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </section>

      <!-- CONSEJO ACADÉMICO -->
      <section>
        <h2 class="font-semibold mb-2">La escuela proporciona estructura del Consejo Académico</h2>
        <?php
          $consejo = [
            'Director Administrativo','Director Pedagógico','Inspector',
            'Representante de los docentes','Representante de los instructores'
          ];
        ?>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2">Integrado por</th>
                <th class="border p-2">Nombres y apellidos</th>
                <th class="border p-2">Presenta delegación (SI/NO)</th>
                <th class="border p-2">Observaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($consejo as $idx => $pos): $j = $idx + 1; ?>
                <tr>
                  <td class="border p-1 font-medium"><?= htmlspecialchars($pos, ENT_QUOTES, 'UTF-8') ?></td>
                  <td class="border p-1">
                    <input name="consejo[<?= $j ?>][nombre]" value="<?= valRow('consejo',$j,'nombre',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                  <td class="border p-1 text-center">
                    <label class="inline-flex items-center mr-1">
                      <input type="radio" name="consejo[<?= $j ?>][delegacion]" value="SI" <?= chkRadioRow('consejo',$j,'delegacion','SI',$d) ?> /> SI
                    </label>
                    <label class="inline-flex items-center">
                      <input type="radio" name="consejo[<?= $j ?>][delegacion]" value="NO" <?= chkRadioRow('consejo',$j,'delegacion','NO',$d) ?> /> NO
                    </label>
                  </td>
                  <td class="border p-1">
                    <input name="consejo[<?= $j ?>][observaciones]" value="<?= valRow('consejo',$j,'observaciones',$d) ?>" class="w-full rounded border p-1 text-sm" />
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>

      <!-- IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN -->
      <section>
        <h3 class="font-semibold">IDENTIFICACIÓN DE RESPONSABILIDAD DE LA INSPECCIÓN</h3>
        <div class="grid grid-cols-3 gap-4 mt-2">
          <div class="p-3 border rounded">
            <h4 class="font-medium">Funcionario de la ANT</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="ins_fun_nombre" value="<?= val('ins_fun_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="ins_fun_firma" value="<?= val('ins_fun_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="ins_fun_ci" value="<?= val('ins_fun_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="ins_fun_cargo" value="<?= val('ins_fun_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>

          <div class="p-3 border rounded flex flex-col items-center justify-center">
            <label class="block text-sm">Fecha de inspección de control</label>
            <input type="date" name="ins_fecha" value="<?= val('ins_fecha',$d) ?>" class="mt-1 rounded border p-2" />
          </div>

          <div class="p-3 border rounded">
            <h4 class="font-medium">Responsable de la Escuela</h4>
            <label class="block text-xs mt-2">Nombre</label>
            <input name="ins_resp_nombre" value="<?= val('ins_resp_nombre',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Firma</label>
            <input name="ins_resp_firma" value="<?= val('ins_resp_firma',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">C.I.</label>
            <input name="ins_resp_ci" value="<?= val('ins_resp_ci',$d) ?>" class="mt-1 w-full rounded border p-2" />
            <label class="block text-xs mt-2">Cargo</label>
            <input name="ins_resp_cargo" value="<?= val('ins_resp_cargo',$d) ?>" class="mt-1 w-full rounded border p-2" />
          </div>
        </div>
      </section>

      <section>
        <label class="block text-sm font-medium">OBSERVACIONES GENERALES</label>
        <textarea name="ins_observaciones_generales" rows="4" class="mt-1 w-full rounded border p-2"><?= val('ins_observaciones_generales',$d) ?></textarea>
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
