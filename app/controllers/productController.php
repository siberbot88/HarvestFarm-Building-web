<?php
require_once '../models/Product.php';
require_once '../config/Database.php';

class ProductController {
  private $db;
  private $product;

  public function __construct() {
    $this->db = (new Database())->getConnection();
    $this->product = new Product($this->db);
  }

  public function create() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Handle image upload
      $targetDir = "../public/uploads/";
      $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
      $targetFile = $targetDir . $fileName;

      move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

      $this->product->name = $_POST['name'];
      $this->product->price = $_POST['price'];
      $this->product->description = $_POST['description'];
      $this->product->image = $fileName;
      $this->product->user_id = $_SESSION['user_id'];

      if ($this->product->create()) {
        header("Location: /products");
      }
    }
    require_once '../views/products/create.php';
  }

  // Methods untuk read, update, delete...
  // READ ALL PRODUCTS
  public function index() {
    $stmt = $this->product->getAll();
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);
    require_once '../views/products/index.php';
  }

  // READ SINGLE PRODUCT
  public function show($id) {
    $stmt = $this->product->getById($id);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    
    if(!$product) {
      header("HTTP/1.0 404 Not Found");
      die("Produk tidak ditemukan");
    }
    
    require_once '../views/products/show.php';
  }

  // UPDATE PRODUCT
  public function update($id) {
    // Ambil data produk yang akan diupdate
    $stmt = $this->product->getById($id);
    $existingProduct = $stmt->fetch(PDO::FETCH_OBJ);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Handle image update
      $fileName = $existingProduct->image; // Default ke gambar lama
      
      if(!empty($_FILES["image"]["name"])) {
        $targetDir = "../public/uploads/";
        $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        
        // Hapus gambar lama
        if(file_exists($targetDir . $existingProduct->image)) {
          unlink($targetDir . $existingProduct->image);
        }
      }

      $this->product->id = $id;
      $this->product->name = $_POST['name'];
      $this->product->price = $_POST['price'];
      $this->product->description = $_POST['description'];
      $this->product->image = $fileName;

      if($this->product->update()) {
        $_SESSION['success'] = "Produk berhasil diupdate!";
        header("Location: /products/" . $id);
      }
    }

    require_once '../views/products/edit.php';
  }

  // DELETE PRODUCT
  public function destroy($id) {
    $this->product->id = $id;
    
    // Ambil data produk untuk hapus gambar
    $stmt = $this->product->getById($id);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    
    if($this->product->delete()) {
      // Hapus gambar dari server
      $targetDir = "../public/uploads/";
      if(file_exists($targetDir . $product->image)) {
        unlink($targetDir . $product->image);
      }
      
      $_SESSION['success'] = "Produk berhasil dihapus!";
      header("Location: /products");
    }
  }
}
?>