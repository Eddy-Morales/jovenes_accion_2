<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario de Inspección Vehicular</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-100 via-blue-100 to-slate-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white/60 backdrop-blur-md shadow-md fixed top-0 left-0 w-full z-50">
        <nav class="max-w-5xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-semibold text-gray-800">Inspección Vehicular</h1>
        </nav>
    </header>

    <div class="mx-auto my-8 max-w-5xl rounded-lg border border-gray-300 bg-white p-8 shadow-lg mt-24">
        <!-- Encabezado -->
        <div class="mb-6 border-b pb-4 text-center">
            <h1 class="text-lg font-bold uppercase">Formulario de Inspección de Vehículos</h1>
            <p class="mt-2 text-sm font-semibold">Formulario para revisión de vehículos</p>
        </div>

        <!-- FORMULARIO -->
        <form id="vehiclesForm" class="space-y-6 rounded-md">
            <!-- Contenedor para los vehículos -->
            <div id="vehiclesContainer">

                <!-- Fila de un vehículo -->
                <div class="vehicle-row space-y-4 border-b pb-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="placa" class="font-semibold">Nro. Placa:</label>
                            <input type="text" name="placa[]" class="w-full rounded border p-2" />
                        </div>

                        <div>
                            <label for="ano_fabricacion" class="font-semibold">Año de fabricación:</label>
                            <input type="text" name="ano_fabricacion[]" class="w-full rounded border p-2" />
                        </div>
                    </div>

                    <h3 class="text-md font-bold uppercase mt-4 text-center">Verificación Física</h3>
                    <p class="mt-4 text-sm italic text-cyan-600 text-center">
                        CUENTA CON FRANJAS RETROREFLECTIVAS EN EL VEHÍCULO
                    </p>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Franjas Reflectivas -->
                        <div>
                            <label for="frontal" class="font-semibold block">Frontal</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="frontal[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="frontal[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Logotipos y Nombre de la Escuela -->
                        <div>
                            <label for="frontal" class="font-semibold block">Posterior</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="posterior[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="posterior[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Lateral -->
                        <div>
                            <label for="laterales" class="font-semibold block mb-2">Laterales</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="laterales[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="laterales[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>

                    </div>

                    <!--Segunda pregunta-->
                    <p class="mt-4 text-sm italic text-cyan-600 text-center">
                        CUENTA CON FRANJAS RETROREFLECTIVAS EN EL VEHÍCULO
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Logotipos frontal-->
                        <div>
                            <label for="frontal" class="font-semibold block">Frontal</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="logo_frontal[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="logo_frontal[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Posterior-->
                        <div>
                            <label for="frontal" class="font-semibold block">Posterior</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="logo_posterior[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="logo_posterior[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Lateral -->
                        <div>
                            <label for="laterales" class="font-semibold block mb-2">Laterales</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="logo_laterales[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="logo_laterales[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- dimensiones -->
                        <div>
                            <label for="laterales" class="font-semibold block mb-2">Dimensiones</label>
                            <input type="text" id="" name="dimensiones[]" class="w-full rounded border p-2" />
                        </div>
                    </div>

                    <!--Tercera pregunta-->
                    <p class="mt-4 text-sm italic text-cyan-600 text-center">
                        CUENTA CON LETRERO "ESTUDIANTE CONDUCIENDO"
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Superior-->
                        <div>
                            <label for="frontal" class="font-semibold block">Superior</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="letrero_sup[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="letrero_sup[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Posterior-->
                        <div>
                            <label for="frontal" class="font-semibold block">Posterior</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="letrero_posterior[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="letrero_posterior[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>

                        <!-- dimensiones -->
                        <div>
                            <label for="laterales" class="font-semibold block mb-2">Dimensiones</label>
                            <input type="text" id="" name="letrero_dimen[]" class="w-full rounded border p-2" />
                        </div>
                    </div>

                    <!-- Doble Comando -->
                    <h3 class="text-md font-bold uppercase mt-4 text-center">Doble Comando</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <!-- Acelerador -->
                        <div>
                            <label for="acelerador" class="font-semibold">Acelerador:</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="acelerador[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="acelerador[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>

                        <!-- Freno -->

                        <div>
                            <label for="freno" class="font-semibold">Freno:</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="freno[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="freno[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>

                        <!-- Embrague -->
                        <div>
                            <label for="embrague" class="font-semibold">Embrague:</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="embrague[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="embrague[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Espego interno -->
                        <div>
                            <label class="font-semibold">Cuenta con espejo interno adicional:</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="espejo_interno_adicional[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="espejo_interno_adicional[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                        <!-- Rastreo Satelital -->
                        <div>
                            <label class="font-semibold">Cuenta con dispositivo de rastreo satelital:</label>
                            <div class="flex items-center gap-4">
                                <label>
                                    <input type="radio" name="rastreo_satelital[]" value="si" class="mr-2" /> Sí
                                </label>
                                <label>
                                    <input type="radio" name="rastreo_satelital[]" value="no" class="mr-2" /> No
                                </label>
                            </div>
                        </div>
                    </div>

                    <section>
                        <h3 class="text-md font-bold uppercase mt-4 text-center">Documentación Adicional</h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-5">

                            <div>
                                <label class="font-semibold">Entrega copia de matrícula:</label>
                                <div class="flex items-center gap-4">
                                    <label>
                                        <input type="radio" name="matricula[]" value="si" class="mr-2" /> Sí
                                    </label>
                                    <label>
                                        <input type="radio" name="matricula[]" value="no" class="mr-2" /> No
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="font-semibold">Entrega copia de póliza de seguros:</label>
                                <div class="flex items-center gap-4">
                                    <label>
                                        <input type="radio" name="poli_aseg[]" value="si" class="mr-2" /> Sí
                                    </label>
                                    <label>
                                        <input type="radio" name="poli_aseg[]" value="no" class="mr-2" /> No
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="font-semibold">Utiliza para fines ajenos a la autorización:</label>
                                <div class="flex items-center gap-4">
                                    <label>
                                        <input type="radio" name="uso_ajeno[]" value="si" class="mr-2" /> Sí
                                    </label>
                                    <label>
                                        <input type="radio" name="uso_ajeno[]" value="no" class="mr-2" /> No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-md font-bold uppercase mt-4 text-center">Bitácora de Mantenimiento</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div>
                                <label class="font-semibold">Bitácora de mantenimiento conforme las recomendaciones de la casa comercial o fabricante:</label>
                                <div class="flex items-center gap-4">
                                    <label>
                                        <input type="radio" name="bitacora[]" value="si" class="mr-2" /> Sí
                                    </label>
                                    <label>
                                        <input type="radio" name="bitacora[]" value="no" class="mr-2" /> No
                                    </label>
                                </div>
                            </div>

                        </div>

                    </section>

                    <!-- Botones de acción -->
                    <div class="flex justify-between items-center pt-6">
                        <!-- Volver-->
                        <button type="submit" id="volver"
                            formaction="../save.php?next=../no-profesionales/Info_general.php"
                            class="inline-flex items-center gap-2 rounded-md border border-cyan-300 bg-white px-5 py-2.5 text-gray-700 shadow-sm transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            <!-- ícono -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Volver
                        </button>

                        <!-- Botón para agregar un vehículo -->
                        <button type="button" onclick="addVehicle()"
                            class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Agregar otro vehículo
                        </button>

                        <button type="submit"
                            id="siguiente" class="inline-flex items-center gap-2 rounded-md bg-green-600 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                            Siguiente
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                    </div>

                </div>

                <script>
                    function addVehicle() {
                        const vehicleRow = document.querySelector('.vehicle-row').cloneNode(true);
                        document.getElementById('vehiclesContainer').appendChild(vehicleRow);
                    }
                </script>

</body>

</html>