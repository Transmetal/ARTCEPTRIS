<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "user_db");

// Periksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Jalankan query
$query = "SELECT * FROM user_form";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
