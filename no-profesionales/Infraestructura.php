<?php
session_start();
$d = $_SESSION['acta'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acta de Inspección - ANT</title>
  <link rel="stylesheet" href="../css/deslizamiento.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../js/script.js"></script>
</head>

<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">

  <!-- Header -->
  <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50 mb-10">
    <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-semibold text-gray-800">No Profesionales - Instalaciones</h1>
      <ul class="flex items-center space-x-7">
        <li><a href="#siguiente" class="text-cyan-700 hover:text-cyan-500 font-medium transition">Siguiente</a></li>
        <li><a href="#volver" class="text-red-600 hover:text-red-800 font-medium transition">Volver</a></li>
      </ul>
    </nav>
  </header>

  <div class="mx-auto my-8 max-w-5xl rounded-lg border border-gray-300 bg-white p-8 shadow-lg mt-24">
    <!-- Encabezado -->
    <div class="mb-6 border-b pb-4 text-center">
      <img src="img/logo.png" alt="ANT" class="mx-auto mb-3 h-14" />
      <h1 class="text-lg font-bold uppercase">Acta de Inspección para Escuelas de Capacitación para Conductores No Profesionales</h1>
      <p class="mt-2 text-sm font-semibold">Formato de inspección Nro. 1</p>
      <h2 class="mb-3 pb-1 text-md font-bold uppercase">Instalaciones</h2>
    </div>

    <!-- FORMULARIO ÚNICO -->
    <form action="../save.php?next=../no-profesionales/pista_motos.php" method="post" class="space-y-6 rounded-md" id="form_instalaciones">

      <!-- AULAS -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Aulas</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="font-semibold">Tipo de licencia</label>
            <div class="flex gap-6">
              <label class="inline-flex items-center">
                <input type="checkbox" name="cursos[]" value="A" class="mr-2"
                  <?= (!empty($d['cursos']) && in_array('A', (array)$d['cursos'])) ? 'checked' : '' ?> />
                A
              </label>

              <label class="inline-flex items-center">
                <input type="checkbox" name="cursos[]" value="B" class="mr-2"
                  <?= (!empty($d['cursos']) && in_array('B', (array)$d['cursos'])) ? 'checked' : '' ?> />
                B
              </label>

              <label class="inline-flex items-center">
                <input type="checkbox" name="cursos[]" value="Puntos" class="mr-2"
                  <?= (!empty($d['cursos']) && in_array('Puntos', (array)$d['cursos'])) ? 'checked' : '' ?> />
                Recuperacón de puntos
              </label>
            </div>
          </div>

          <div>
            <label class="font-semibold">Cantidad de aulas verificadas</label>
            <input type="number" name="aulas_cantidad_verificadas" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['aulas_cantidad_verificadas'] ?? '') ?>" />
          </div>

          <div>
            <label class="font-semibold">Capacidad que tienen las aulas</label>
            <input type="number" name="aulas_capacidad" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['aulas_capacidad'] ?? '') ?>" />
          </div>

          <div>
            <span class="mb-1 block font-semibold">Equipo didáctico</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="equipo_didactico" value="SI" class="mr-2"
                <?= (isset($d['equipo_didactico']) && $d['equipo_didactico'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="equipo_didactico" value="NO" class="mr-2"
                <?= (isset($d['equipo_didactico']) && $d['equipo_didactico'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Equipo tecnológico (TV o proyector)</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="equipo_tecnologico" value="SI" class="mr-2"
                <?= (isset($d['equipo_tecnologico']) && $d['equipo_tecnologico'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="equipo_tecnologico" value="NO" class="mr-2"
                <?= (isset($d['equipo_tecnologico']) && $d['equipo_tecnologico'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Materiales didácticos o señalización</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="material_didactico" value="SI" class="mr-2"
                <?= (isset($d['material_didactico']) && $d['material_didactico'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="material_didactico" value="NO" class="mr-2"
                <?= (isset($d['material_didactico']) && $d['material_didactico'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Cuenta con mobiliario adecuado (pupitres, pizarrón, etc.)</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="aulas_mobiliario_adecuado" value="SI" class="mr-2"
                <?= (isset($d['aulas_mobiliario_adecuado']) && $d['aulas_mobiliario_adecuado'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="aulas_mobiliario_adecuado" value="NO" class="mr-2"
                <?= (isset($d['aulas_mobiliario_adecuado']) && $d['aulas_mobiliario_adecuado'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Mobiliario docente — Estación de trabajo</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="mobiliario_docente" value="SI" class="mr-2"
                <?= (isset($d['mobiliario_docente']) && $d['mobiliario_docente'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="mobiliario_docente" value="NO" class="mr-2"
                <?= (isset($d['mobiliario_docente']) && $d['mobiliario_docente'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Mobiliario docente — Computador para el docente</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="docente_computador" value="SI" class="mr-2"
                <?= (isset($d['docente_computador']) && $d['docente_computador'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="docente_computador" value="NO" class="mr-2"
                <?= (isset($d['docente_computador']) && $d['docente_computador'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <label class="font-semibold">Número de aulas autorizadas (en resolución ANT)</label>
            <input type="number" name="aulas_num_autorizadas" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['aulas_num_autorizadas'] ?? '') ?>" />
          </div>

          <div>
            <label class="font-semibold">Número de resolución donde se autorizan las aulas</label>
            <input type="text" name="aulas_num_resolucion" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['aulas_num_resolucion'] ?? '') ?>" />
          </div>

          <div>
            <span class="mb-1 block font-semibold">Acceso para personas con discapacidad</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="aulas_acceso_discapacidad" value="SI" class="mr-2"
                <?= (isset($d['aulas_acceso_discapacidad']) && $d['aulas_acceso_discapacidad'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="aulas_acceso_discapacidad" value="NO" class="mr-2"
                <?= (isset($d['aulas_acceso_discapacidad']) && $d['aulas_acceso_discapacidad'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Observaciones de las aulas inspeccionadas</label>
            <textarea name="aulas_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['aulas_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- AULA TALLER -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Aula Taller</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <span class="mb-1 block font-semibold">¿Está dentro de la escuela?</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="taller_dentro_escuela" value="SI" class="mr-2"
                <?= (isset($d['taller_dentro_escuela']) && $d['taller_dentro_escuela'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="taller_dentro_escuela" value="NO" class="mr-2"
                <?= (isset($d['taller_dentro_escuela']) && $d['taller_dentro_escuela'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Cuenta con recursos prácticos para capacitación mecánica</span>
            <label class="inline-flex items-center mr-6">
              <input type="radio" name="taller_recursos_mecanica" value="SI" class="mr-2"
                <?= (isset($d['taller_recursos_mecanica']) && $d['taller_recursos_mecanica'] === 'SI') ? 'checked' : '' ?> /> Sí
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="taller_recursos_mecanica" value="NO" class="mr-2"
                <?= (isset($d['taller_recursos_mecanica']) && $d['taller_recursos_mecanica'] === 'NO') ? 'checked' : '' ?> /> No
            </label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Detalle de materiales para capacitación mecánica</label>
            <textarea name="taller_detalle_materiales" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['taller_detalle_materiales'] ?? '') ?></textarea>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Observaciones del aula taller</label>
            <textarea name="taller_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['taller_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- ÁREA ADMINISTRATIVA -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Área Administrativa</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <?php
          // Helper para radios SI/NO
          function rn($k, $v, $d)
          {
            return (isset($d[$k]) && $d[$k] === $v) ? 'checked' : '';
          }
          ?>
          <div>
            <span class="mb-1 block font-semibold">Dirección general</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_direccion_general" value="SI" class="mr-2" <?= rn('adm_direccion_general', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_direccion_general" value="NO" class="mr-2" <?= rn('adm_direccion_general', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Secretaría académica</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_secretaria_academica" value="SI" class="mr-2" <?= rn('adm_secretaria_academica', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_secretaria_academica" value="NO" class="mr-2" <?= rn('adm_secretaria_academica', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Información</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_informacion" value="SI" class="mr-2" <?= rn('adm_informacion', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_informacion" value="NO" class="mr-2" <?= rn('adm_informacion', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Sala de espera / recepción</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_sala_espera_recepcion" value="SI" class="mr-2" <?= rn('adm_sala_espera_recepcion', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_sala_espera_recepcion" value="NO" class="mr-2" <?= rn('adm_sala_espera_recepcion', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Archivo</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_archivo" value="SI" class="mr-2" <?= rn('adm_archivo', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_archivo" value="NO" class="mr-2" <?= rn('adm_archivo', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Supervisión / inspección</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_supervision_inspeccion" value="SI" class="mr-2" <?= rn('adm_supervision_inspeccion', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_supervision_inspeccion" value="NO" class="mr-2" <?= rn('adm_supervision_inspeccion', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Contabilidad / tesorería</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_contabilidad_tesoreria" value="SI" class="mr-2" <?= rn('adm_contabilidad_tesoreria', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_contabilidad_tesoreria" value="NO" class="mr-2" <?= rn('adm_contabilidad_tesoreria', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Asesoría técnica en educación y seguridad vial</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_educacion_seguridad_vial" value="SI" class="mr-2" <?= rn('adm_educacion_seguridad_vial', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_educacion_seguridad_vial" value="NO" class="mr-2" <?= rn('adm_educacion_seguridad_vial', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">Accesos para personas con discapacidad</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="adm_accesos_discapacidad" value="SI" class="mr-2" <?= rn('adm_accesos_discapacidad', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="adm_accesos_discapacidad" value="NO" class="mr-2" <?= rn('adm_accesos_discapacidad', 'NO', $d) ?> />No</label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Observaciones del área administrativa</label>
            <textarea name="adm_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['adm_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- PRÁCTICA DE CONDUCCIÓN LICENCIA TIPO B -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Práctica de Conducción — Licencia Tipo B</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <span class="mb-1 block font-semibold">¿Tiene parque vial?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="parque_vial" value="SI" class="mr-2" <?= rn('parque_vial', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="parque_vial" value="NO" class="mr-2" <?= rn('parque_vial', 'NO', $d) ?> />No</label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Dirección donde está ubicado el parque vial</label>
            <input type="text" name="ubicacion_pvial" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['ubicacion_pvial'] ?? '') ?>" />
          </div>

          <div>
            <span class="mb-1 block font-semibold">¿Tiene circuito vial autorizado por el GAD?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="pv_circuito_gad" value="SI" class="mr-2" <?= rn('pv_circuito_gad', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="pv_circuito_gad" value="NO" class="mr-2" <?= rn('pv_circuito_gad', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <label class="font-semibold">Número de autorización</label>
            <input type="text" name="pv_num_autorizacion" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['pv_num_autorizacion'] ?? '') ?>" />
          </div>

          <div>
            <label class="font-semibold">Nombre de la institución que emite</label>
            <input type="text" name="pv_institucion_emite" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['pv_institucion_emite'] ?? '') ?>" />
          </div>

          <div>
            <label class="font-semibold">Fecha de vigencia de la autorización</label>
            <input type="date" name="pv_fecha_vigencia" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['pv_fecha_vigencia'] ?? '') ?>" />
          </div>

          <div class="md:col-span-2">
            <span class="mb-1 block font-semibold">¿Cuenta con señalización horizontal y vertical?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="pv_senalizacion_hv" value="SI" class="mr-2" <?= rn('pv_senalizacion_hv', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="pv_senalizacion_hv" value="NO" class="mr-2" <?= rn('pv_senalizacion_hv', 'NO', $d) ?> />No</label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Observaciones de prácticas de conducción</label>
            <textarea name="pv_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['pv_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- BATERÍAS SANITARIAS Y PARQUEADERO -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Baterías Sanitarias y Parqueadero</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="font-semibold">Número de baterías destinado a mujeres</label>
            <input type="number" name="bs_num_mujeres" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['bs_num_mujeres'] ?? '') ?>" />
          </div>

          <div>
            <label class="font-semibold">Número de baterías destinado a hombres</label>
            <input type="number" name="bs_num_hombres" class="w-full rounded border p-2"
              value="<?= htmlspecialchars($d['bs_num_hombres'] ?? '') ?>" />
          </div>
        </div>

        <div class="mt-2">
          <span class="mb-2 block font-semibold">Implementos</span>
          <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
            <!-- Jabón -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_jabon" value="NO">
              <input type="checkbox" value="SI" name="imp_jabon" class="mr-2" <?= !empty($d['imp_jabon']) ? 'checked' : '' ?> />
              Jabón
            </label>

            <!-- Alcohol -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_alcohol" value="NO">
              <input type="checkbox" value="SI" name="imp_alcohol" class="mr-2" <?= !empty($d['imp_alcohol']) ? 'checked' : '' ?> />
              Alcohol
            </label>

            <!-- Papel higiénico -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_papel_higienico" value="NO">
              <input type="checkbox" value="SI" name="imp_papel_higienico" class="mr-2" <?= !empty($d['imp_papel_higienico']) ? 'checked' : '' ?> />
              Papel higiénico
            </label>

            <!-- Basurero con tapa -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_basurero_tapa" value="NO">
              <input type="checkbox" value="SI" name="imp_basurero_tapa" class="mr-2" <?= !empty($d['imp_basurero_tapa']) ? 'checked' : '' ?> />
              Basurero con tapa
            </label>

            <!-- Toallas desechables -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_toallas_desechables" value="NO">
              <input type="checkbox" value="SI" name="imp_toallas_desechables" class="mr-2" <?= !empty($d['imp_toallas_desechables']) ? 'checked' : '' ?> />
              Toallas desechables
            </label>

            <!-- Señalización -->
            <label class="inline-flex items-center">
              <input type="hidden" name="imp_senalizacion" value="NO">
              <input type="checkbox" value="SI" name="imp_senalizacion" class="mr-2" <?= !empty($d['imp_senalizacion']) ? 'checked' : '' ?> />
              Señalización
            </label>
          </div>
        </div>


        <div class="mt-2">
          <span class="mb-1 block font-semibold">¿Los baños están adecuados para personas con discapacidad?</span>
          <label class="inline-flex items-center mr-6"><input type="radio" name="bs_banos_discapacidad" value="SI" class="mr-2" <?= rn('bs_banos_discapacidad', 'SI', $d) ?> />Sí</label>
          <label class="inline-flex items-center"><input type="radio" name="bs_banos_discapacidad" value="NO" class="mr-2" <?= rn('bs_banos_discapacidad', 'NO', $d) ?> />No</label>
        </div>

        <div class="mt-2">
          <label class="font-semibold">Observaciones de las baterías sanitarias</label>
          <textarea name="bs_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['bs_observaciones'] ?? '') ?></textarea>
        </div>

        <div class="mt-4 border-t pt-4">
          <h3 class="mb-2 text-md font-semibold">Parqueadero</h3>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label class="font-semibold">Número de estacionamientos de vehículos de instrucción práctica</label>
              <input type="number" name="pq_num_estacionamientos_instruccion" class="w-full rounded border p-2"
                value="<?= htmlspecialchars($d['pq_num_estacionamientos_instruccion'] ?? '') ?>" />
            </div>
            <div>
              <label class="font-semibold">Número de estacionamientos de usuarios/personal de la escuela</label>
              <input type="number" name="pq_num_estacionamientos_usuarios" class="w-full rounded border p-2"
                value="<?= htmlspecialchars($d['pq_num_estacionamientos_usuarios'] ?? '') ?>" />
            </div>
          </div>

          <div class="mt-2">
            <span class="mb-1 block font-semibold">¿Parquea en zona pública?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="pq_zona_publica" value="SI" class="mr-2" <?= rn('pq_zona_publica', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="pq_zona_publica" value="NO" class="mr-2" <?= rn('pq_zona_publica', 'NO', $d) ?> />No</label>
          </div>

          <div class="mt-2">
            <label class="font-semibold">Observaciones de los parqueaderos</label>
            <textarea name="pq_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['pq_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- SEGURIDADES -->
      <section>
        <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Seguridades</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <span class="mb-1 block font-semibold">¿Tiene equipos contra incendios?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="seg_equipos_incendios" value="SI" class="mr-2" <?= rn('seg_equipos_incendios', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="seg_equipos_incendios" value="NO" class="mr-2" <?= rn('seg_equipos_incendios', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">¿Cuenta con rótulos de emergencia?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="seg_rotulos_emergencia" value="SI" class="mr-2" <?= rn('seg_rotulos_emergencia', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="seg_rotulos_emergencia" value="NO" class="mr-2" <?= rn('seg_rotulos_emergencia', 'NO', $d) ?> />No</label>
          </div>

          <div>
            <span class="mb-1 block font-semibold">¿Cuenta con rótulos de salida de emergencia?</span>
            <label class="inline-flex items-center mr-6"><input type="radio" name="rotulos_salida" value="SI" class="mr-2" <?= rn('rotulos_salida', 'SI', $d) ?> />Sí</label>
            <label class="inline-flex items-center"><input type="radio" name="rotulos_salida" value="NO" class="mr-2" <?= rn('rotulos_salida', 'NO', $d) ?> />No</label>
          </div>

          <div class="md:col-span-2">
            <label class="font-semibold">Observaciones al equipo y distribución de las señales de emergencia</label>
            <textarea name="seg_observaciones" rows="3" class="w-full rounded border p-2"><?= htmlspecialchars($d['seg_observaciones'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- Botones de acción -->
      <div class="flex justify-between items-center pt-6">
        <!-- Volver-->
        <button type="submit" id="volver"
          formaction="../save.php?next=../no-profesionales/campañas.php"
          class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
          <!-- ícono -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Volver
        </button>

        <div class="pt-4">
          <button type="submit" id="siguiente"
            class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
            Siguiente
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

    </form>
  </div>
</body>

</html>