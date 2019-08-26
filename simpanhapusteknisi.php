<?php

include('koneksi.php');

$nik = $_POST["nik"];
$sql = "DELETE FROM tb_teknisi WHERE nik='" . $nik . "'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Data Berhasil Diubah');
                window.location=(href='datateknisi.php')</script>";
} else {
    echo "<script>window.alert('Data Gagal Diubah');
    window.location=(href='datateknisi.php')</script>";
}
