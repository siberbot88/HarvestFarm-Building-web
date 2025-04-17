<?php
// Include database connection
require_once "../../app/config/db.php";

// Get categories for filter
$sql_categories = "SELECT * FROM categories ORDER BY name";
$result_categories = $conn->query($sql_categories);
$categories = [];
while ($row = $result_categories->fetch_assoc()) {
    $categories[] = $row;
}

// Handle search and filtering
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// Build query with filters
$sql = "SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (p.name LIKE '%$search%' OR p.description LIKE '%$search%')";
}

if ($category_id > 0) {
    $sql .= " AND p.category_id = $category_id";
}

$sql .= " ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarvestFarm - Hasil Tani Berkualitas</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
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
                <li><a href="index.php" class="active">Beranda</a></li>
                <li><a href="create.php">Tambah Produk</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Hasil Tani Segar Langsung dari Petani</h2>
                <p>Temukan produk hasil tani berkualitas untuk kebutuhan Anda</p>
            </div>
        </section>

        <section class="filter-section">
            <form id="filterForm" action="index.php" method="GET">
                <div class="search-bar">
                    <input type="text" name="search" id="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                <div class="category-filter">
                    <select name="category_id" id="category_id">
                        <option value="0">Semua Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo ($category_id == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </section>

        <section class="products">
            <h2>Produk Petani Kami</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <div class="product-grid">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?php if (!empty($row['image_path']) && file_exists($row['image_path'])): ?>
                                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                                <?php else: ?>
                                    <img src="images/placeholder.jpg" alt="Product Image Placeholder">
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                                <p class="category"><?php echo htmlspecialchars($row['category_name']); ?></p>
                                <p class="price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                <p class="stock">Stok: <?php echo $row['stock']; ?></p>
                                <div class="product-actions">
                                    <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-view"><i class="fas fa-eye"></i> Detail</a>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                    <button class="btn btn-delete" onclick="confirmDelete(<?php echo $row['id']; ?>)"><i class="fas fa-trash"></i> Hapus</button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="no-products">
                    <p>Tidak ada produk yang ditemukan.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="./images/logo-white.png" alt="HarvestFarm Logo">
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