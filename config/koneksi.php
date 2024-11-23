<?php
$servername = "localhost"; // Sesuaikan dengan server database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "perpustakaan"; // Sesuaikan dengan nama database Anda

// Membuat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
