<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login/login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password, put it here
$dbname = "lamp_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Edit User - Lamp Store</title>
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

<section class="edit-user">
    <div class="container">
        <h2>Edit User</h2>
        <form method="post" action="manage_users.php">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?= $user['country'] ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?= $user['city'] ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <button type="submit" name="edit_user" class="btn">Update User</button>
        </form>
    </div>
</section>

<footer class="fixed-footer">
    <div class="container">
        <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
    </div>
</footer>

</body>
</html>
