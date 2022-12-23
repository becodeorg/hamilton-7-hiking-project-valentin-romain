<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 text-white">
    <h1 class="text-3xl text-center">Hi, <?= $_SESSION['user']['username']?> !</h1>
    <?php if($_SESSION['user']['admin'] == 1) {
        echo "<p class='italic text-xs text-center'>You have Administrator privilege. With great power comes great responsibilities.</p>";
    }
    ?>
    <p>This is the informations we have about you:</p>
    <table class="w-full">
        <tr>
            <th>Username</th>
            <td class="text-center"><?=$_SESSION['user']['username']?></td>
        </tr>
        <tr>
            <th>First Name</th>
            <td class="text-center"><?=$_SESSION['user']['firstname']?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td class="text-center"> <?=$_SESSION['user']['lastname']?></td>
        </tr>
        <tr>
            <th>E-Mail Address</th>
            <td class="text-center"><?=$_SESSION['user']['email']?></td>
        </tr>
    </table>
    <a href="/profile?edit"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit my Profile</button></a>
</div>