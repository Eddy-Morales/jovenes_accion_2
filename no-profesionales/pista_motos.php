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
    <title>Formulario de Inspección - Pista de Motos</title>
    <link rel="stylesheet" href="../css/deslizamiento.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
        <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-semibold text-gray-800">Inspección de Pista de Motos</h1>
            <ul class="flex items-center space-x-7">
                <li>
                    <a href="#volver" class=" text-cyan-700 hover:text-cyan-500 font-medium transition">
                        Siguiente
                    </a>
                </li>
                <li>
                    <a href="#siguiente" class="text-red-600 hover:text-red-800 font-medium transition">
                        Volver
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="mx-auto my-8 max-w-5xl rounded-lg border border-gray-300 bg-white p-8 shadow-lg mt-24">
        <!-- Encabezado -->
        <div class="mb-6 border-b pb-4 text-center">
            <h1 class="text-lg font-bold uppercase">Formulario de Inspección de Pista de Motos</h1>
            <p class="mt-2 text-sm font-semibold">Formato de inspección Nro. 1</p>
        </div>

        <!-- FORMULARIO -->
        <form action="../save.php?next=../no-profesionales/equipos.php" method="post" class="space-y-6 rounded-md">

            <!-- Dirección y Superficie -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Pista de Motos</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="direccion" class="font-semibold">Dirección donde está ubicada:</label>
                        <input type="text" id="direccion" name="pista_direccion" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['pista_direccion'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="propiedad" class="font-semibold block mb-2">La pista es propia o arrendada:</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="pista_propiedad" value="SI" class="mr-2" <?= rn('pista_propia', 'SI', $d) ?> /> Propia
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="pista_propiedad" value="NO" class="mr-2" <?= rn('pista_arrendada', 'NO', $d) ?> /> Arrendada
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Que tipo superficie tiene la pista:</label>
                        <input type="text" id="ptipo_superficie" name="tipo_superficie" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['tipo_superficie'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="dimensiones" class="font-semibold block mb-2">La pista es parte del predio (Lugar de funcionamiento):</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="pista_predio" value="SI" class="mr-2" <?= rn('pista_predio', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="pista_predio" value="NO" class="mr-2" <?= rn('pista_predio', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="dimensiones" class="font-semibold block mb-2">La pista tiene una superficie de 700 metros:</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="pista_tamaño" value="SI" class="mr-2" <?= rn('pista_tamaño', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="pista_tamaño" value="NO" class="mr-2" <?= rn('pista_tamaño', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="cerramiento" class="font-semibold block mb-2">¿La pista tiene cerramiento perimetral?</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="pista_cerramiento" value="SI" class="mr-2" <?= rn('pista_cerramiento', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="pista_cerramiento" value="NO" class="mr-2" <?= rn('pista_cerramiento', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">¿Que tipo de cerramiento tiene la pista?</label>
                        <input type="text" id="tipo_cerramiento" name="tipo_superficie" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['tipo_superficie'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="metros_pista" class="font-semibold">¿Cuántos metros mide la pista?</label>
                        <input type="text" id="metros_pista" name="metros_pista" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['metros_pista'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">¿A cuantos kilometros de la escuela se encuentra la pista?</label>
                        <input type="text" id="ptipo_superficie" name="pista_ubikilome" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['pista_ubikilome'] ?? '') ?>" />
                    </div>
                </div>
            </section>

            <!-- Elementos de Demarcación -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase text-center">Elementos de Demarcación</h2>
                <h3 class="mb-3 border-b pb-1 text-md font-bold uppercase ">Postes</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label for="postes_delineadores" class="font-semibold block mb-2">Postes delineadores</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="postes_delineados" value="SI" class="mr-2" <?= rn('postes_delineados', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="postes_delineados" value="NO" class="mr-2" <?= rn('postes_delineados', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Tipo de Material (Postes):</label>
                        <input type="text" id="postes_material" name="postes_material" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['postes_material'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Dimension de altura (Postes):</label>
                        <input type="text" id="postes_material" name="postes_altura" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['postes_altura'] ?? '') ?>" />
                    </div>

                </div>
                <h3 class="mb-3 border-b pb-1 text-md font-bold uppercase">Rampa</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label for="rampa_elevada" class="font-semibold block mb-2">Rampa elevada</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="rampa_elevada" value="SI" class="mr-2" <?= rn('rampa_elevada', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="rampa_elevada" value="NO" class="mr-2" <?= rn('rampa_elevada', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Dimensiones (Rampa):</label>
                        <input type="text" id="postes_material" name="rampa_dimens" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['rampa_dimens'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Tipo de Material (Rampa):</label>
                        <input type="text" id="postes_material" name="rampa_material" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['rampa_material'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold block mb-2">Fijado al piso (Rampa):</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="rampa_fijada" value="SI" class="mr-2" <?= rn('rampa_fijada', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="rampa_fijada" value="NO" class="mr-2" <?= rn('rampa_fijada', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold block mb-2">¿Cuenta son rampa de subida y bajada?:</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="rampa_subida" value="SI" class="mr-2" <?= rn('rampa_subida', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="rampa_subida" value="NO" class="mr-2" <?= rn('rampa_subida', 'NO', $d) ?> /> NO
                        </label>
                    </div>
                </div>
                <!--Dispositivos-->
                <h3 class="mb-3 border-b pb-1 text-md font-bold uppercase mt-8">Dispositivos</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="dispositivos_cono" class="font-semibold block mb-2">Dispositivos en forma de cono</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="dispositivos_cono" value="SI" class="mr-2" <?= rn('rampa_elevada', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="dispositivos_cono" value="NO" class="mr-2" <?= rn('rampa_elevada', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Tipo de Material:</label>
                        <input type="text" id="" name="conos_material" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['conos_material'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Tipo de base:</label>
                        <input type="text" id="" name="conos_base" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['conos_base'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold block mb-2">¿Garantiza estabilidad al piso?:</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="cono_estabilidad" value="SI" class="mr-2" <?= rn('cono_estabilidad', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="cono_estabilidad" value="NO" class="mr-2" <?= rn('cono_estabilidad', 'NO', $d) ?> /> NO
                        </label>
                    </div>
                </div>

                <!--Travesaños-->
                <h3 class="mb-3 border-b pb-1 text-md font-bold uppercase mt-8">Travesaños</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label for="tipo_superficie" class="font-semibold block mb-2">¿Tiene Travesaños?</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="travesanio" value="SI" class="mr-2" <?= rn('travesanio', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="travesanio" value="NO" class="mr-2" <?= rn('travesanio', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Numero de travesaños y medidas:</label>
                        <input type="text" id="" name="trave_num" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['trave_num'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="tipo_superficie" class="font-semibold">Tipo de Material:</label>
                        <input type="text" id="" name="trave_material" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['trave_material'] ?? '') ?>" />
                    </div>
                </div>


                <!--Carteles-->
                <h3 class="mb-3 border-b pb-1 text-md font-bold uppercase mt-8">Carteles</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label for="carteles_indicadores" class="font-semibold block mb-2">¿Tiene carteles indicadores de cambio?</label>
                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="carteles_indi" value="SI" class="mr-2" <?= rn('carteles_indi', 'SI', $d) ?> /> SI
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="carteles_indi" value="NO" class="mr-2" <?= rn('carteles_indi', 'NO', $d) ?> /> NO
                        </label>
                    </div>

                    <div>
                        <label for="" class="font-semibold">Numero de carteles</label>
                        <input type="number" id="" name="num_carteles" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['num_carteles'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="" class="font-semibold">Medida de los carteles</label>
                        <input type="text" id="" name="num_carteles_medidas" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['num_carteles_medidas'] ?? '') ?>" />
                    </div>
                </div>
            </section>

            <!-- Observaciones -->
            <section>
                <label for="observaciones" class="font-semibold">Observación de la pista de motos:</label>
                <textarea id="observaciones" name="pista_observaciones" rows="4" class="w-full rounded border p-2"><?= htmlspecialchars($d['pista_observaciones'] ?? '') ?></textarea>
            </section>


            <!--Circuito autorizado por el GAD-->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase mt-8 text-center">Circuito Autorizado por el GAD</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>
                        <label for="" class="font-semibold">Nro. de autorización</label>
                        <input type="text" id="" name="gad_autorizacion" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['gad_autorizacion'] ?? '') ?>" />
                    </div>
                    <div>
                        <label for="" class="font-semibold">Entididad que emite la autorización</label>
                        <input type="text" id="" name="gad_entidad" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['gad_entidad'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="" class="font-semibold">Tipo de curso o cursos que constan en la autorización</label>
                        <input type="text" id="" name="gad_curso" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['gad_curso'] ?? '') ?>" />
                    </div>

                    <div>
                        <label for="" class="font-semibold">Fecha de emisión de la autorización</label>
                        <input type="text" id="" name="gad_fechaauto" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['gad_fechaauto'] ?? '') ?>" />
                    </div>
                    <div>
                        <label for="" class="font-semibold">Fecha de caducidad de la autorización</label>
                        <input type="text" id="" name="gad_fechacaducidad" class="w-full rounded border p-2"
                            value="<?= htmlspecialchars($d['gad_fechacaducidad'] ?? '') ?>" />
                    </div>


                </div>
            </section>

            <!-- Botones de acción -->
            <div class="flex justify-between items-center pt-6">
                <!-- Volver-->
                <button type="submit" id="volver"
                    formaction="../save.php?next=../no-profesionales/Infraestructura.php"
                    class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <!-- ícono -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver
                </button>

                <div class="pt-4">
                    <button type="submit"
                        id="siguiente" class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                        Siguiente
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <p class="mt-4 text-sm italic text-gray-600">
                Nota: La información que consta en las actas debe tener el sustento correspondiente.
            </p>
        </form>
    </div>

</body>

</html>