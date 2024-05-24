<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lamp Store</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

<header>
    <div class="container">
        <h1>Lamp Store</h1>
        <nav>
            <ul>
            <li><a href="./index/index.html">Acasă</a></li>
                <li><a href="./produse/produse.php">Produse</a></li>
                <li><a href="./despre/despre.html">Despre Noi</a></li>
                <li><a href="./contact/contact.html">Contact</a></li>
                <li><a href="./login/login.php">Autentificare</a></li>
                <li><a href="./register/register.php">Înregistrare</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="admin">
    <div class="container">
        <h2>Admin Dashboard</h2>
        <button onclick="location.href='manage_users.php'" class="btn">Manage Users</button>
        <button onclick="location.href='manage_lamps.php'" class="btn">Manage Lamps</button>
    </div>
</section>


<footer class="fixed-footer">
    <div class="container">
        <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
    </div>
</footer>

</body>
</html>
