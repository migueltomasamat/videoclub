<?php

require __DIR__.'/Parciales/header.vista.php';
require __DIR__.'/Parciales/nav.vista.php';

?>
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Todos los Clientes</h2>
            <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Listado de clientes del Videoclub</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
            <?php
                foreach ($clientes as $cliente){?>

            <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                </a>
                <div class="p-5">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="#"><?=$cliente->nombre?></a>
                    </h3>
                    <span class="text-gray-500 dark:text-gray-400">Cliente V.I.P</span>
                    <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Maximos alquilers concurrentes: <?=$cliente->getMaxAlquilerConcurrente()?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
require __DIR__.'/Parciales/footer.vista.php';

