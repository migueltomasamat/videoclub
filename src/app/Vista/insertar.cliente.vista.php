<?php

require __DIR__.'/Parciales/header.vista.php';
require __DIR__.'/Parciales/nav.vista.php';

?>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Inserción de un nuevo Cliente</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Introduce los datos del formulario que aparece a continuación</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-1">

                <form action="/cliente" method="post">
                    <input hidden name="numero" id="numero" value="<?=$idUsuario?>"
                    <div class="mb-4">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Cliente</label>
                        <input type="text" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nombre del cliente" required>
                    </div>
                    <div class="mb-4">
                        <label for="maxAlquilerConcurrente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de alquileres concurrentes</label>
                        <input type="number" id="maxAlquilerConcurrente" name="maxAlquilerConcurrente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>

            </div>
        </div>
    </section>

<?php
require __DIR__.'/Parciales/footer.vista.php';


