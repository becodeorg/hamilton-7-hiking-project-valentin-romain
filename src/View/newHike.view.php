<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-[75%]">
    <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-white">Enter a new Hike !</span>
    <form method="post">
        <div class="relative z-0 mb-6 w-full group mt-10">
            <input type="text" name="hikeName" id="hikeName" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
            <label for="hikeName" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hike Name</label>
        </div>
        <div class="relative z-0 mb-6 w-full group mt-10">
            <input type="number" step="0.01" name="hikeDistance" id="hikeDistance" style ="-webkit-appearance: none; -moz-appearance: textfield;" min="0" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
            <label for="hikeDistance" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Distance (km)</label>
        </div>
        <div class="relative z-0 mb-6 w-full group mt-10">
            <input type="number" name="hikeDuration" id="hikeDuration" style ="-webkit-appearance: none; -moz-appearance: textfield;" min="0" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
            <label for="hikeDuration" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Duration (minutes)</label>
        </div>
        <div class="relative z-0 mb-6 w-full group mt-10">
            <input type="number" step="0.01" style ="-webkit-appearance: none; -moz-appearance: textfield;" name="hikeElevation" id="hikeElevation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
            <label for="hikeElevation" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Elevation Gain (m)</label>
        </div>
        <div class="relative z-0 mb-6 w-full group mt-10">
            <textarea name="hikeDescription" id="hikeDescription" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required></textarea>
            <label for="hikeDescription" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
        </div>
        <div class="text-white text-center">
            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white grid grid-cols-2 mb-5">
            <?php foreach ($tags as $tag) : ?>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center pl-3">
                        <input id="<?=$tag['name']?>" type="checkbox" name="tags[]" value="<?=$tag['id']?>" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="<?=$tag['name']?>" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"><?=$tag['name']?></label>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create a new hike</button>
    </form>
</div>