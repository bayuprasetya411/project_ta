<?php

// variabel
$servername = 'Localhost';
$username = 'root';
$password = '';
$database = 'db_corporate';

// koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// cek koneksi
if (!$conn) {

    die("Koneksi Gagal : " . mysqli_connect_error());
}
