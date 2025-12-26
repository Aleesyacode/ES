<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "es"; // Pastikan nama databasemu di phpMyAdmin benar-benar 'es'

// Ganti $koneksi menjadi $conn agar cocok dengan file lain
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>