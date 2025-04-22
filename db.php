<?php
$conn = mysqli_connect("localhost", "root", "", "krsmahasiswa");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>