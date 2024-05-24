<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ./login/login.php');
    exit();
}
$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password, put it here
$dbname = "lamp_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE id=$user_id";
        $conn->query($sql);
    } elseif (isset($_POST['edit_user'])) {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $role = $_POST['role'];
        
        $sql = "UPDATE users SET username='$username', email='$email', country='$country', city='$city', role='$role' WHERE id=$user_id";
        $conn->query($sql);
    }
}

$users = $conn->query("SELECT * FROM users");

$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Manage Users - Lamp Store</title>
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

<section class="manage-users">
    <div class="container">
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['country'] ?></td>
                        <td><?= $row['city'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td>
                            <form method="post" action="manage_users.php" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete_user" class="btn">Delete</button>
                            </form>
                            <form method="post" action="edit_user.php" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="edit_user" class="btn">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<footer class="fixed-footer">
    <div class="container">
        <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
    </div>
</footer>

</body>
</html>
