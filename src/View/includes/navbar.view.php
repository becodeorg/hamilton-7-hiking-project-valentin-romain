<nav>
    <ul class="flex flex-row gap-10 text-center">
        <li><a href="/">Home</a></li>
        <?php if (empty($_SESSION['user'])): ?>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        <?php elseif($_SESSION['user']['admin'] == 1): ?>
            <li><a href="/admin">Admin</a></li>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/logout">Logout</a></li>
        <?php else: ?>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>