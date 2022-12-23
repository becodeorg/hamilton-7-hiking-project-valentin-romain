<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-white grid grid-cols-1 gap-5 w-[75%]">
    <form method="post">
        <button type="submit" onclick="return confirm('This will completely remove this hike from the database, and cannot be undone. Are you sure you want to do this ?')" class="absolute top-8 right-[37%]">X</button>
    </form>
    <p class="absolute top-8 left-[36%] italic"><?=$hike['creation_date']?> by <a href="/?by=<?= $hike['created_by']?>"><?=$hike['created_by']?></p></a>
    <?php if(!empty($hike['updated_at'])) {
        echo '<p class="absolute top-12 left-[36%] italic">Last edit: '. $hike['updated_at'] . '</p>';
    }
    ?>
    <h1 class="text-3xl text-center mt-5"><?=$hike['name']?> (<?=$hike['distance']?>km)</h1>
    <ul class="grid grid-cols-3 gap-5 align-center">
    <?php foreach ($tags as $tag) : ?>
        <a href="/?tag=<?= $tag['id']?>"<li class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer"><?=$tag['name']?></li></a>
    <?php endforeach; ?>
    </ul>
    <h2 class="text-xl">Average duration: <?=intdiv($hike['duration'], 60).'h'. ($hike['duration'] % 60)?></h2>
    <h3 class="text-l">Elevation: <?=$hike['elevation_gain']?>m</h3>
    <p class="italic"><?=$hike['description']?></p>
    <a href="/edithike?id=<?=$_GET['id']?>"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit this Hike</button></a>
</div>