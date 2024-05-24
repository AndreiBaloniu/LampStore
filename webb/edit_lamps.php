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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lamp_id'])) {
    $lamp_id = $_POST['lamp_id'];
    $sql = "SELECT * FROM lamps WHERE id=$lamp_id";
    $result = $conn->query($sql);
    $lamp = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Edit Lamp - Lamp Store</title>
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

<section class="edit-lamp">
    <div class="container">
        <h2>Edit Lamp</h2>
        <form method="post" action="manage_lamps.php" enctype="multipart/form-data">
            <input type="hidden" name="lamp_id" value="<?= $lamp['id'] ?>">
            <input type="hidden" name="existing_image" value="<?= $lamp['image_path'] ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $lamp['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= $lamp['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?= $lamp['price'] ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="birou" <?= $lamp['category'] == 'birou' ? 'selected' : '' ?>>Lămpi de birou</option>
                    <option value="podea" <?= $lamp['category'] == 'podea' ? 'selected' : '' ?>>Lămpi de podea</option>
                    <option value="colt" <?= $lamp['category'] == 'colt' ? 'selected' : '' ?>>Lămpi de colț</option>
                    <option value="mediu" <?= $lamp['category'] == 'mediu' ? 'selected' : '' ?>>Lămpi medii</option>
                    <option value="ambient" <?= $lamp['category'] == 'ambient' ? 'selected' : '' ?>>Lămpi pentru ambient</option>
                    <option value="led" <?= $lamp['category'] == 'led' ? 'selected' : '' ?>>Lămpi LED</option>
                    <option value="sare" <?= $lamp['category'] == 'sare' ? 'selected' : '' ?>>Lămpi de sare</option>
                    <option value="marmura" <?= $lamp['category'] == 'marmura' ? 'selected' : '' ?>>Lămpi din marmură</option>
                </select>
            </div>
            <button type="submit" name="edit_lamp" class="btn">Update Lamp</button>
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
