<?php
// Include database connection
require_once(__DIR__ . '/../config/db.php');

// Function to get all products
function getAllProducts() {
    global $conn;
    $stmt = $conn->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get products by category
function getProductsByCategory($category_id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.category_id = :category_id
        ORDER BY p.created_at DESC
    ");
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to search products
function searchProducts($search_term) {
    global $conn;
    $search_term = "%$search_term%";
    $stmt = $conn->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.name LIKE :search_term OR p.description LIKE :search_term
        ORDER BY p.created_at DESC
    ");
    $stmt->bindParam(':search_term', $search_term);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get a single product by ID
function getProductById($id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = :id
    ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Function to get all categories
function getAllCategories() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM categories ORDER BY name");
    return $stmt->fetchAll();
}

// Function to add a new product
function addProduct($data, $image_file) {
    global $conn;
    
    // Handle image upload
    $image_url = '';
    if ($image_file['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_extension = pathinfo($image_file['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($image_file['tmp_name'], $target_path)) {
            $image_url = $target_path;
        }
    }
    
    // Insert product data into database
    $stmt = $conn->prepare("
        INSERT INTO products (name, description, price, stock, category_id, image_url)
        VALUES (:name, :description, :price, :stock, :category_id, :image_url)
    ");
    
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->bindParam(':stock', $data['stock']);
    $stmt->bindParam(':category_id', $data['category_id']);
    $stmt->bindParam(':image_url', $image_url);
    
    return $stmt->execute();
}

// Function to update a product
function updateProduct($id, $data, $image_file = null) {
    global $conn;
    
    // Get current product data
    $current_product = getProductById($id);
    
    // Handle image upload if new image is provided
    $image_url = $current_product['image_url'];
    if ($image_file && $image_file['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_extension = pathinfo($image_file['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($image_file['tmp_name'], $target_path)) {
            // Delete old image if exists
            if (!empty($current_product['image_url']) && file_exists($current_product['image_url'])) {
                unlink($current_product['image_url']);
            }
            $image_url = $target_path;
        }
    }
    
    // Update product data in database
    $stmt = $conn->prepare("
        UPDATE products 
        SET name = :name, 
            description = :description, 
            price = :price, 
            stock = :stock, 
            category_id = :category_id, 
            image_url = :image_url
        WHERE id = :id
    ");
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->bindParam(':stock', $data['stock']);
    $stmt->bindParam(':category_id', $data['category_id']);
    $stmt->bindParam(':image_url', $image_url);
    
    return $stmt->execute();
}

// Function to delete a product
function deleteProduct($id) {
    global $conn;
    
    // Get product data to delete image file if exists
    $product = getProductById($id);
    
    // Delete image file if exists
    if (!empty($product['image_url']) && file_exists($product['image_url'])) {
        unlink($product['image_url']);
    }
    
    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}