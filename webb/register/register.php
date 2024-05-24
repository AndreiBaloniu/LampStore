<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password, put it here
$dbname = "lamp_store";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user';

    $sql = "INSERT INTO users (username, email, country, city, password, role) VALUES ('$username', '$email', '$country', '$city', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Înregistrare reușită!";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - Lamp Store</title>
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

<section class="register">
    <div class="container">
        <h2>Înregistrare</h2>
        <form id="registerForm" method="POST">
            <div class="form-group">
                <label for="username">Nume Utilizator:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Adresă de Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Parolă:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="country">Țară:</label>
                <select id="country" name="country" onclick="populateCities()">
                    <script src="../register/scripts.js"></script>
                    <option value="">Alege o țară</option>
                    <option value="Romania">România</option>
                    <option value="Statele Unite">Statele Unite</option>
                    <!-- Alte țări pot fi adăugate aici -->
                </select>

            </div>
            <div class="form-group">
                <label for="city">Oraș:</label>
                <select id="city" name="city">
                    <option value="">Alege un oraș</option>
                </select>
            </div>
            <button type="submit" class="btn">Înregistrare</button>
        </form>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="container">
            <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
        </div>
    </div>
</footer>

</body>
</html>