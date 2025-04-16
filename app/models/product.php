<?php
class Product {
  private $conn;
  private $table = "products";

  public $id;
  public $name;
  public $price;
  public $description;
  public $image;
  public $user_id;

  public function __construct($db) {
    $this->conn = $db;
  }

  // CREATE
  public function create() {
    $query = "INSERT INTO " . $this->table . "
      SET name=:name, price=:price, 
      description=:description, image=:image, user_id=:user_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":user_id", $this->user_id);

    return $stmt->execute();
  }

  // READ, UPDATE, DELETE methods...
  // READ ALL PRODUCTS
  public function getAll() {
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  // READ SINGLE PRODUCT BY ID
  public function getById($id) {
    $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt;
  }

  // UPDATE PRODUCT
  public function update() {
    $query = "UPDATE " . $this->table . "
      SET name=:name, price=:price, 
      description=:description, image=:image
      WHERE id=:id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }

  // DELETE PRODUCT
  public function delete() {
    $query = "DELETE FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    return $stmt->execute();
  }
}
?>