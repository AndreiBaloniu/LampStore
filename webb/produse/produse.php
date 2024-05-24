<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // If you have set a password, put it here
$dbname = "lamp_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM lamps";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Produse - Lamp Store</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="../produse/script.js" defer></script>
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

<section class="products">
    <div class="container">
        <h2>Produse</h2>

        <!-- Câmp de căutare și meniul de filtrare -->
        <select id="filterSelect" onchange="filterProducts()">
            <option value="toate">Toate</option>
            <option value="birou">Lămpi de birou</option>
            <option value="podea">Lămpi de podea</option>
            <option value="colt">Lămpi de colț</option>
            <option value="mediu">Lămpi medii</option>
            <option value="ambient">Lămpi pentru ambient</option>
            <option value="led">Lămpi LED</option>
            <option value="sare">Lămpi de sare</option>
            <option value="marmura">Lămpi din marmură</option>
        </select>
        <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="Căutați produse...">

        <div class="product-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $image_path = "../assets/" . $row["image_path"];
                    if (!file_exists($image_path) || empty($row["image_path"])) {
                        $image_path = "../assets/default.jpg"; // Path to a default image
                    }
                    echo '<div class="product" data-category="' . $row["category"] . '">';
                    echo '<div class="product-info">';
                    echo '<img class="product-img" src="' . $image_path . '" alt="' . $row["name"] . '" onclick="openModal(this)">';
                    echo '<div class="product-details">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<p>Preț: ' . $row["price"] . ' RON</p>';
                    echo '</div></div></div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
    </div>
</footer>

<!-- Modal pentru imagini -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>

</body>
</html>
