<?php
require_once '../../app/config/db.php';

// Ambil semua kategori untuk filter
$sql_kategori = "SELECT DISTINCT kategori FROM produk ORDER BY kategori";
$result_kategori = $conn->query($sql_kategori);
$kategoris = [];
while ($row = $result_kategori->fetch_assoc()) {
    $kategoris[] = $row['kategori'];
}

// Ambil semua produk
$sql_produk = "SELECT * FROM produk ORDER BY tanggal_tambah DESC";
$result_produk = $conn->query($sql_produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarvestFarm - Hasil Tani Segar</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">HarvestFarm</a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="create.php">Tambah Produk</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <div class="container">
            <h1 class="page-title">Produk Hasil Tani Segar</h1>
            
            <div class="filter-container">
                <label for="filter-kategori">Filter Kategori:</label>
                <select id="filter-kategori">
                    <option value="semua">Semua Kategori</option>
                    <?php foreach ($kategoris as $kategori): ?>
                    <option value="<?= $kategori ?>"><?= $kategori ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="products">
                <?php if ($result_produk->num_rows > 0): ?>
                    <?php while ($produk = $result_produk->fetch_assoc()): ?>
                    <div class="product-card" data-category="<?= $produk['kategori'] ?>">
                        <div class="product-image">
                            <?php if (!empty($produk['gambar'])): ?>
                            <img src="uploads/<?= $produk['gambar'] ?>" alt="<?= $produk['nama'] ?>">
                            <?php else: ?>
                            <img src="assets/images/no-image.jpg" alt="No Image">
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?= $produk['nama'] ?></h3>
                            <p class="product-category">Kategori: <?= $produk['kategori'] ?></p>
                            <p class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                            <p class="product-stock">Stok: <?= $produk['stok'] ?></p>
                            <div class="product-actions">
                                <a href="detail.php?id=<?= $produk['id'] ?>" class="btn btn-view">Detail</a>
                                <a href="edit.php?id=<?= $produk['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="#" class="btn btn-delete" data-id="<?= $produk['id'] ?>" data-name="<?= $produk['nama'] ?>">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Tidak ada produk yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title">Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus produk <span id="product-name"></span>?</p>
            <div class="modal-actions">
                <button id="cancel-delete" class="btn btn-edit">Batal</button>
                <a id="confirm-delete" href="#" class="btn btn-delete">Hapus</a>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> HarvestFarm. Semua hak dilindungi.</p>
        </div>
    </footer>
    
    <script src="js/script.js"></script>
</body>
</html>