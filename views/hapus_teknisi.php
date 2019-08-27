<?php

include('../config/koneksi.php');

$nik = $_GET['nik'];
$query = "DELETE FROM tb_teknisi WHERE nik ='$nik'";
$deleted = mysqli_query($conn, $query);

if ($deleted) {
    echo "<script>window.alert('Data Berhasil Terhapus');
    window.location=(href='datateknisi.php')</script>";
} else {
    echo "<script>window.alert('Data Gagal Terhapus');
    window.location=(href='update_teknisi.php')</script>";
}
