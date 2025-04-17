<?php
// Include database connection
require_once "../../app/config/db.php";

// Get categories for dropdown
$sql_categories = "SELECT * FROM categories ORDER BY name";
$result_categories = $conn->query($sql_categories);
$categories = [];
while ($row = $result_categories->fetch_assoc()) {
    $categories[] = $row;
}

// Initialize variables
$name = $description = $price = $stock = $category_id = $image_path = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $errors["name"] = "Nama produk harus diisi";
    } else {
        $name = trim($_POST["name"]);
    }
    
    // Validate description
    if (empty($_POST["description"])) {
        $errors["description"] = "Deskripsi harus diisi";
    } else {
        $description = trim($_POST["description"]);
    }
    
    // Validate price
    if (empty($_POST["price"])) {
        $errors["price"] = "Harga harus diisi";
    } else if (!is_numeric($_POST["price"]) || $_POST["price"] <= 0) {
        $errors["price"] = "Harga harus berupa angka positif";
    } else {
        $price = (float)$_POST["price"];
    }
    
    // Validate stock
    if (empty($_POST["stock"])) {
        $errors["stock"] = "Stok harus diisi";
    } else if (!is_numeric($_POST["stock"]) || $_POST["stock"] < 0) {
        $errors["stock"] = "Stok harus berupa angka non-negatif";
    } else {
        $stock = (int)$_POST["stock"];
    }
    
    // Validate category
    if (empty($_POST["category_id"])) {
        $errors["category_id"] = "Kategori harus dipilih";
    } else {
        $category_id = (int)$_POST["category_id"];
    }
    
    // Handle image upload
    $image_path = "images/placeholder.jpg"; // Default placeholder
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "images/products/";
        
        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $temp_name = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        
        // Generate unique filename
        $new_image_name = uniqid() . '.' . $image_ext;
        $target_file = $target_dir . $new_image_name;
        
        // Check if file is an actual image
        $check = getimagesize($temp_name);
        if ($check === false) {
            $errors["image"] = "File bukan gambar";
        }
        
        // Check file size (max 5MB)
        else if ($_FILES["image"]["size"] > 5000000) {
            $errors["image"] = "Ukuran file terlalu besar (maksimal 5MB)";
        }
        
        // Allow certain file formats
        else if (!in_array($image_ext, ["jpg", "jpeg", "png", "gif"])) {
            $errors["image"] = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan";
        }
        
        // If no errors, try to upload file
        else if (empty($errors["image"])) {
            if (move_uploaded_file($temp_name, $target_file)) {
                $image_path = $target_file;
            } else {
                $errors["image"] = "Gagal mengunggah gambar";
            }
        }
    }
    
    // If no errors, insert product into database
    if (empty($errors)) {
        $sql = "INSERT INTO products (name, description, price, stock, category_id, image_path) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdiis", $name, $description, $price, $stock, $category_id, $image_path);
        
        if ($stmt->execute()) {
            // Redirect to homepage after successful insertion
            header("Location: index.php?success=1");
            exit();
        } else {
            $errors["db"] = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - HarvestFarm</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <div class="logo">
                <img src="./images/logo2.png" alt="HarvestFarm Logo">
            </div>
            <h1>HarvestFarm</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="add_product.php" class="active">Tambah Produk</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="form-section">
            <h2>Tambah Produk Baru</h2>
            
            <?php if (!empty($errors["db"])): ?>
                <div class="alert alert-error"><?php echo $errors["db"]; ?></div>
            <?php endif; ?>
            
            <form id="productForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="name">Nama Produk*</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    <?php if (!empty($errors["name"])): ?>
                        <span class="error"><?php echo $errors["name"]; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi*</label>
                    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
                    <?php if (!empty($errors["description"])): ?>
                        <span class="error"><?php echo $errors["description"]; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Harga (Rp)*</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required>
                        <?php if (!empty($errors["price"])): ?>
                            <span class="error"><?php echo $errors["price"]; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stok*</label>
                        <input type="number" id="stock" name="stock" min="0" value="<?php echo htmlspecialchars($stock); ?>" required>
                        <?php if (!empty($errors["stock"])): ?>
                            <span class="error"><?php echo $errors["stock"]; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="category_id">Kategori*</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo ($category_id == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors["category_id"])): ?>
                        <span class="error"><?php echo $errors["category_id"]; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div id="imagePreview" class="image-preview"></div>
                    <?php if (!empty($errors["image"])): ?>
                        <span class="error"><?php echo $errors["image"]; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    <a href="index.php" class="btn">Batal</a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="images/logo2.png" alt="HarvestFarm Logo">
                <h3>HarvestFarm</h3>
            </div>
            <div class="footer-info">
                <p>&copy; 2025 HarvestFarm. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="js/form-validation.js"></script>
</body>
</html>