<?php
// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'harvestfarm';

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");
?>