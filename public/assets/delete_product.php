<?php
// Include database connection
require_once "../../app/config/db.php";

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $response = [
        'success' => false,
        'message' => 'ID produk tidak valid'
    ];
    
    echo json_encode($response);
    exit();
}

$product_id = (int)$_GET['id'];

// Get the image path before deleting the product
$sql_image = "SELECT image_path FROM products WHERE id = ?";
$stmt_image = $conn->prepare($sql_image);
$stmt_image->bind_param("i", $product_id);
$stmt_image->execute();
$stmt_image->bind_result($image_path);
$stmt_image->fetch();
$stmt_image->close();

// Delete the product
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    // Delete the product image if it's not a placeholder
    if (!empty($image_path) && $image_path != "images/placeholder.jpg" && file_exists($image_path)) {
        unlink($image_path);
    }
    
    $response = [
        'success' => true,
        'message' => 'Produk berhasil dihapus'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Gagal menghapus produk: ' . $stmt->error
    ];
}

$stmt->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>