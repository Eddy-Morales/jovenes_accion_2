<?php
session_start();
$d = $_SESSION['acta'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario de Inspección - Campañas de Seguridad Vial</title>
    <link rel="stylesheet" href="../css/deslizamiento.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
        <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-semibold text-gray-800">Campañas de Seguridad Vial</h1>
        </nav>
    </header>

    <div class="mx-auto my-8 max-w-5xl rounded-lg border border-gray-300 bg-white p-8 shadow-lg mt-24">
        <!-- Encabezado -->
        <div class="mb-6 border-b pb-4 text-center">
            <h1 class="text-lg font-bold uppercase">Campañas de Seguridad Vial (al menos dos al año)</h1>
        </div>

        <!-- FORMULARIO -->
        <form action="../save.php?next=../no-profesionales/Infraestructura.php" method="post" class="space-y-6 rounded-md">

            <!-- Campañas de Seguridad Vial -->
            <section>
                <h2 class="mb-3 border-b pb-1 text-md font-bold uppercase">Ha realizado campañas de seguridad vial</h2>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="font-semibold">¿Ha realizado campañas de seguridad vial?</label>
                        <div class="flex items-center gap-4">
                            <label>
                                <input type="radio" name="campanas_seguridad" value="si" class="mr-2"
                                    <?= (isset($d['campanas_seguridad']) && $d['campanas_seguridad'] === 'si') ? 'checked' : '' ?> />
                                Sí
                            </label>
                            <label>
                                <input type="radio" name="campanas_seguridad" value="no" class="mr-2"
                                    <?= (isset($d['campanas_seguridad']) && $d['campanas_seguridad'] === 'no') ? 'checked' : '' ?> />
                                No
                            </label>
                        </div>
                    </div>

                    <!-- Fechas Programadas (Siempre visibles) -->
                    <div>
                        <label class="font-semibold">En caso de que no lo haya hecho, indicar las fechas programadas:</label>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="primera_fecha" class="font-semibold">Primera:</label>
                                <input type="date" id="primera_fecha" name="primera_fecha" class="w-full rounded border p-2"
                                    value="<?= htmlspecialchars($d['primera_fecha'] ?? '') ?>"  />
                            </div>
                            <div>
                                <label for="segunda_fecha" class="font-semibold">Segunda:</label>
                                <input type="date" id="segunda_fecha" name="segunda_fecha" class="w-full rounded border p-2"
                                    value="<?= htmlspecialchars($d['segunda_fecha'] ?? '') ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Documentación de Sustento -->
            <section>
                <label for="documentacion" class="font-semibold">Documentación de sustento:</label>
                <textarea id="documentacion" name="documentacion" rows="4" class="w-full rounded border p-2"
                    ><?= htmlspecialchars($d['documentacion'] ?? '') ?></textarea>
            </section>

            <!-- Botones de acción -->
            <div class="flex justify-between items-center pt-6">
                <!-- Volver-->
                <button type="submit" id="volver"
                    formaction="../save.php?next=../no-profesionales/Info_general.php"
                    class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-5 py-2.5 text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <!-- ícono -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver
                </button>

                <button type="submit" id="siguiente"
                    class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Siguiente
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

</body>

</html>