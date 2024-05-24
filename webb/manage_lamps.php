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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_lamp'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image_path = 'default.jpg'; // Default image

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../assets/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if directory exists and create if not
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Check if file already exists
            if (!file_exists($target_file)) {
                // Check file size
                if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    exit();
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                    exit();
                }
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = basename($_FILES["image"]["name"]);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    exit();
                }
            } else {
                $image_path = basename($_FILES["image"]["name"]);
            }
        }

        $sql = "INSERT INTO lamps (name, description, price, category, image_path) VALUES ('$name', '$description', '$price', '$category', '$image_path')";
        $conn->query($sql);
    } elseif (isset($_POST['delete_lamp'])) {
        $lamp_id = $_POST['lamp_id'];
        $sql = "DELETE FROM lamps WHERE id=$lamp_id";
        $conn->query($sql);
    } elseif (isset($_POST['edit_lamp'])) {
        $lamp_id = $_POST['lamp_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image_path = $_POST['existing_image']; // Default to existing image

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../assets/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if directory exists and create if not
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Check if file already exists
            if (!file_exists($target_file)) {
                // Check file size
                if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    exit();
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                    exit();
                }
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = basename($_FILES["image"]["name"]);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    exit();
                }
            } else {
                $image_path = basename($_FILES["image"]["name"]);
            }
        }

        $sql = "UPDATE lamps SET name='$name', description='$description', price='$price', category='$category', image_path='$image_path' WHERE id=$lamp_id";
        $conn->query($sql);
    }
}

$lamps = $conn->query("SELECT * FROM lamps");

$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=1.0">
    <title>Manage Lamps - Lamp Store</title>
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

<section class="manage-lamps">
    <div class="container">
        <h2>Manage Lamps</h2>
        <h3>Add New Lamp</h3>
        <form method="post" action="manage_lamps.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="birou">Lămpi de birou</option>
                    <option value="podea">Lămpi de podea</option>
                    <option value="colt">Lămpi de colț</option>
                    <option value="mediu">Lămpi medii</option>
                    <option value="ambient">Lămpi pentru ambient</option>
                    <option value="led">Lămpi LED</option>
                    <option value="sare">Lămpi de sare</option>
                    <option value="marmura">Lămpi din marmură</option>
                </select>
            </div>
            <button type="submit" name="add_lamp" class="btn">Add Lamp</button>
        </form>
        
        <h3>Existing Lamps</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $lamps->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <td>
                            <form method="post" action="manage_lamps.php" style="display:inline;">
                                <input type="hidden" name="lamp_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete_lamp" class="btn">Delete</button>
                            </form>
                            <form method="post" action="edit_lamp.php" style="display:inline;">
                                <input type="hidden" name="lamp_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="edit_lamp" class="btn">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Lamp Store. Toate drepturile rezervate.</p>
    </div>
</footer>

</body>
</html>