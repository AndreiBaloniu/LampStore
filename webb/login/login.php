<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password, put it here
$dbname = "lamp_store";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Utilizator găsit: " . $row['username'] . "<br>"; // Debugging
        echo "Hash parola stocată: " . $row['password'] . "<br>"; // Debugging
        if (password_verify($password, $row['password'])) {
            echo "Parola este corectă!<br>"; // Debugging
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header('Location: ../admin.php');
            } else {
                header('Location: ../index/index.html');
            }
            exit();
        } else {
            echo "Parolă incorectă!";
        }
    } else {
        echo "Utilizator inexistent!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare - Lamp Store</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <header>
        <div class="container">
            <h1>Lamp Store</h1>
            <nav>
                <ul>
                <li><a href="../index/index.html">Acasă</a></li>
                <li><a href="../produse/produse.php">Produse</a></li>
                <li><a href="../despre/despre.html">Despre Noi</a></li>
                <li><a href="../contact/contact.html">Contact</a></li>
                <li><a href="../login/login.php">Autentificare</a></li>
                <li><a href="../register/register.php">Înregistrare</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="login">
        <div class="container">
            <h2>Autentificare</h2>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Nume Utilizator:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Parolă:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Autentificare</button>
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
