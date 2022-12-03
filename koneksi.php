<?php 
    $conn = mysqli_connect("localhost", "root", "", "uas_web");

    if (!$conn) {
        die("Gagal terhubung ke database" . mysqli_connect_error());
    }
?>