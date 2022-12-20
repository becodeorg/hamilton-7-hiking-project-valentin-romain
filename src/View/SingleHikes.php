<h1 class="text-3xl center"><?=$hike['name']?></h1>
<h2 class="text-xl"><?=$hike['distance']?>km</h2>
<h3></h3>
<form method="post">
    <button type="submit" onclick="return confirm('This will completely remove this hike from the database, and cannot be undone. Are you sure you want to do this ?')">X</button>
</form>