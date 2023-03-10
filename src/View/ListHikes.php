<div class="w-[75%]">
<h1 class="text-3xl text-center">Hikes <?php echo (!empty($_GET['by'])) ? "by ".$_GET['by']."</h1>" : "</h1>"; ?></h1>
    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-3">
    <?php foreach ($hikes as $hike) : ?>
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 h-[22em]">
            <a href="/hike?id=<?=$hike['id']?>">
                <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-white"><?= $hike['name'] ?></span></a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-clip"><?=$hike['description'] ?></p>
    </div>
    <?php endforeach; ?>
        <a href="/newhike">
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 h-[22em] flex items-center justify-center">

                <span class="mb-2 text-[5em] font-bold tracking-tight text-gray-900 text-white">+</span>
        </div>
        </a>
    </div>
</div>