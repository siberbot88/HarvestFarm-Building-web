<?php
// Include database connection
require_once "/../../app/config/db.php";

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=no_id");
    exit();
}

$product_id = (int)$_GET['id'];

// Fetch product data with category information
$sql = "SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    header("Location: index.php?error=not_found");
    exit();
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - HarvestFarm</title>
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
                <li><a href="create.php">Tambah Produk</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="product-detail">
            <div class="product-detail-container">
                <!-- <div class="product-image-container">
                    <?php if (!empty($product['image_path']) && file_exists($product['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-detail-image">
                    <?php else: ?>
                        <img src="images/placeholder.jpg" alt="Product Image Placeholder" class="product-detail-image">
                    <?php endif; ?>
                </div> -->

                <div class="product-image-container">
                    <?php if (!empty($product['image_path']) && file_exists('public/' . $product['image_path'])): ?>
                        <img src="<?php echo 'public/' . htmlspecialchars($product['image_path']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                            class="product-detail-image">
                    <?php elseif (!empty($product['image'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                            class="product-detail-image">
                    <?php else: ?>
                        <img src="public/images/placeholder.jpg"
                            alt="Product Image Placeholder"
                            class="product-detail-image">
                    <?php endif; ?>
                </div>


                
                <div class="product-detail-info">
                    <div class="product-header">
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <span class="category-badge"><?php echo htmlspecialchars($product['category_name']); ?></span>
                    </div>
                    
                    <div class="product-price">
                        <h3>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></h3>
                    </div>
                    
                    <div class="product-stock">
                        <p>Stok: <span><?php echo $product['stock']; ?></span></p>
                    </div>
                    
                    <div class="product-description">
                        <h4>Deskripsi Produk</h4>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    </div>
                    
                    <div class="product-detail-actions">
                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit Produk</a>
                        <button class="btn btn-delete" onclick="confirmDelete(<?php echo $product['id']; ?>)"><i class="fas fa-trash"></i> Hapus Produk</button>
                        <a href="index.php" class="btn"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="./images/logo2.png" alt="HarvestFarm Logo">
                <h3>HarvestFarm</h3>
            </div>
            <div class="footer-info">
                <p>&copy; 2025 HarvestFarm. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus produk ini?</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn btn-danger">Hapus</button>
                <button id="cancelDelete" class="btn">Batal</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>