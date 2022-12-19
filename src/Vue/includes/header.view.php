<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-500">
<nav>
    <ul class="flex flex-row gap-10">
        <li><a href="/">Home</a></li>
        <?php if (empty($_SESSION['user'])): ?>
            <li><a href="/login">Login</a></li>
            <li><a href="/registration">Register</a></li>
        <?php else: ?>
            <li><a href="/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>