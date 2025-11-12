<?php
session_start();
$d = $_SESSION['acta'] ?? [];
function rn($k, $v, $d)
{
    return (isset($d[$k]) && (string)$d[$k] === (string)$v) ? 'checked' : '';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario de Inspección - Laboratorios y Equipos</title>
    <link rel="stylesheet" href="../css/deslizamiento.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
        <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-semibold text-gray-800">Inspección de Laboratorios y Equipos</h1>
            <ul class="flex items-center space-x-7">
                <li>
                    <a href="#siguiente" class=" text-cyan-700 hover:text-cyan-500 font-medium transition">
                        Siguiente
                    </a>
                </li>
                <li>
                    <a href="#volver" class="text-red-600 hover:text-red-800 font-medium transition">
                        Volver
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="mx-auto my-8 max-w-5xl rounded-lg border border-gray-300 bg-white p-8 shadow-lg mt-24">
        <!-- Encabezado -->
        <div class="mb-6 border-b pb-4 text-center">
            <h1 class="text-lg font-bold uppercase">Formulario de Inspección - Laboratorios y Equipos</h1>
            <p class="mt-2 text-sm font-semibold">Formulario de revisión de equipos y laboratorios</p>
        </div>

        <!-- FORMULARIO -->
        <form action="../save.php?next=../generar_word.php" method="post" class="space-y-6 rounded-md">

            <!-- Laboratorio Psicosensométrico -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Laboratorio Psicosensométrico</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="font-semibold">¿Tiene laboratorio psicosensométrico?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="lab_psico" value="si" class="mr-2" <?= rn('lab_psico', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="lab_psico" value="no" class="mr-2" <?= rn('lab_psico', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Evita filtraciones sonoras?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="filtraciones_sonoras" value="si" class="mr-2" <?= rn('filtraciones_sonoras', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="filtraciones_sonoras" value="no" class="mr-2" <?= rn('filtraciones_sonoras', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="modelo_equipo" class="font-semibold">Modelo del equipo:</label>
                        <input type="text" id="psico_modelo" name="psico_modelo" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['psico_modelo'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="marca_equipo" class="font-semibold">Marca del equipo:</label>
                        <input type="text" id="marca_equipo" name="psico_marca" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['psico_marca'] ?? '') ?>" />
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo está homologado?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="psico_homol" value="si" class="mr-2" <?= rn('psico_homol', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="psico_homol" value="no" class="mr-2" <?= rn('psico_homol', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="certificado_homologacion" class="font-semibold">Número de certificado de homologación:</label>
                        <input type="text" id="certificado_homologacion" name="num_homolo" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['num_homolo'] ?? '') ?>" />
                    </div>
                </div>
            </section>

            <!-- Evaluación del Equipo Psicosensométrico -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase text-center m-3">Evaluación del Equipo Psicosensométrico</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-3">
                    <div>
                        <label class="font-semibold">¿El equipo evalúa Vista?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="evalua_vista" value="si" class="mr-2" <?= rn('evalua_vista', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="evalua_vista" value="no" class="mr-2" <?= rn('evalua_vista', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo evalúa Oído?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="evalua_oido" value="si" class="mr-2" <?= rn('evalua_oido', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="evalua_oido" value="no" class="mr-2" <?= rn('evalua_oido', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo tiene capacidad de visión nocturna?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="vision_nocturna" value="si" class="mr-2" <?= rn('vision_nocturna', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="vision_nocturna" value="no" class="mr-2" <?= rn('vision_nocturna', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo tiene campo de visión?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="campo_vision" value="si" class="mr-2" <?= rn('campo_vision', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="campo_vision" value="no" class="mr-2" <?= rn('campo_vision', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo evalúa Reacción al freno?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="reaccion_freno" value="si" class="mr-2" <?= rn('reaccion_freno', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="reaccion_freno" value="no" class="mr-2" <?= rn('reaccion_freno', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El equipo evalúa Coordinación motriz?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="coordinacion_motriz" value="si" class="mr-2" <?= rn('coordinacion_motriz', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="coordinacion_motriz" value="no" class="mr-2" <?= rn('coordinacion_motriz', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Es propiedad de la escuela?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="propiedad_escuela" value="si" class="mr-2" <?= rn('propiedad_escuela', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="propiedad_escuela" value="no" class="mr-2" <?= rn('propiedad_escuela', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿La escuela presenta planes de mantenimiento del equipo psicosensométrico?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="mantenimiento_equipo" value="si" class="mr-2" <?= rn('mantenimiento_equipo', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="mantenimiento_equipo" value="no" class="mr-2" <?= rn('mantenimiento_equipo', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Observaciones -->
            <section>
                <label for="observaciones" class="font-semibold">Observación del laboratorio Psicosensométrico </label>
                <textarea id="observaciones" name="labora_observaciones" rows="4" class="w-full rounded border p-2"><?= htmlspecialchars($d['labora_observaciones'] ?? '') ?></textarea>
            </section>

            <!-- Simulador -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase text-center">Simulador</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="font-semibold">¿Cuenta con simulador?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="cuenta_simulador" value="si" class="mr-2" <?= rn('cuenta_simulador', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="cuenta_simulador" value="no" class="mr-2" <?= rn('cuenta_simulador', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿El simulador está homologado?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="simulador_homologado" value="si" class="mr-2" <?= rn('simulador_homologado', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="simulador_homologado" value="no" class="mr-2" <?= rn('simulador_homologado', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿La escuela entrega el documento de homologación del equipo?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="documento_homologacion" value="si" class="mr-2" <?= rn('documento_homologacion', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="documento_homologacion" value="no" class="mr-2" <?= rn('documento_homologacion', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Observaciones -->
            <section>
                <label for="observaciones" class="font-semibold">Observación del Simulador</label>
                <textarea id="observaciones" name="simula_observaciones" rows="4" class="w-full rounded border p-2"><?= htmlspecialchars($d['simula_observaciones'] ?? '') ?></textarea>
            </section>

            <!-- Equipo Biométrico -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Equipo Biométrico</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="numero_equipos" class="font-semibold">Número de equipos:</label>
                        <input type="number" id="numero_equipos" name="numero_equipos" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['numero_equipos'] ?? '') ?>" />
                    </div>

                    <div>
                        <label class="font-semibold">¿Registra la asistencia de docentes?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="registra_asistencia_docentes" value="si" class="mr-2" <?= rn('registra_asistencia_docentes', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="registra_asistencia_docentes" value="no" class="mr-2" <?= rn('registra_asistencia_docentes', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Registra la asistencia de los alumnos?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="asistencia_alumnos" value="si" class="mr-2" <?= rn('asistencia_alumnos', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="asistencia_alumnos" value="no" class="mr-2" <?= rn('asistencia_alumnos', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Registra la asistencia de los instructores?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="asistencia_instructores" value="si" class="mr-2" <?= rn('asistencia_instructores', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="asistencia_instructores" value="no" class="mr-2" <?= rn('asistencia_instructores', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Observaciones -->
            <section>
                <label for="observaciones" class="font-semibold">Observación de Equipo Biométrico</label>
                <textarea id="observaciones" name="biome_observaciones" rows="4" class="w-full rounded border p-2"><?= htmlspecialchars($d['biome_observaciones'] ?? '') ?></textarea>
            </section>

            <!-- Plataforma Virtual -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase text-center">Plataforma Virtual</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="font-semibold">¿La escuela cuenta con plataforma virtual?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="plataforma_virtual" value="si" class="mr-2" <?= rn('plataforma_virtual', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="plataforma_virtual" value="no" class="mr-2" <?= rn('plataforma_virtual', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Permite visualizar módulos y tareas?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="visualiza_modulos" value="si" class="mr-2" <?= rn('visualiza_modulos', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="visualiza_modulos" value="no" class="mr-2" <?= rn('visualiza_modulos', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="nombre_plataforma" class="font-semibold">Nombre de la plataforma:</label>
                        <input type="text" id="nombre_plataforma" name="nombre_plataforma" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['nombre_plataforma'] ?? '') ?>" />
                    </div>

                    <div>
                        <label class="font-semibold">¿Permite visualizar evaluaciones a los estudiantes?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="evaluaciones_estudiantes" value="si" class="mr-2" <?= rn('evaluaciones_estudiantes', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="evaluaciones_estudiantes" value="no" class="mr-2" <?= rn('evaluaciones_estudiantes', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Permite evaluaciones en línea?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="evaluaciones_en_linea" value="si" class="mr-2" <?= rn('evaluaciones_en_linea', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="evaluaciones_en_linea" value="no" class="mr-2" <?= rn('evaluaciones_en_linea', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">¿Permite descargar el registro de asistencia y calificaciones?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="registro_asistencia" value="si" class="mr-2" <?= rn('registro_asistencia', 'si', $d) ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="registro_asistencia" value="no" class="mr-2" <?= rn('registro_asistencia', 'no', $d) ?> />
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Observaciones -->
            <section>
                <label for="observaciones" class="font-semibold">Observaciones a la plataforma:</label>
                <textarea id="observaciones" name="plataform_observaciones" rows="4" class="w-full rounded border p-2"><?= htmlspecialchars($d['plataform_observaciones'] ?? '') ?></textarea>
            </section>

            <!-- Botones de acción -->
            <div class="flex justify-between items-center pt-6">
                <!-- Volver-->
                <button type="submit" id="volver"
                    formaction="../save.php?next=../no-profesionales/pista_motos.php"
                    class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <!-- ícono -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
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

            <p class="mt-4 text-sm italic text-gray-600">
                Nota: La información que consta en las actas debe tener el sustento correspondiente.
            </p>
        </form>
    </div>

</body>

</html>