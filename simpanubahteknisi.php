<?php

include('koneksi.php');


if (!empty($_POST)) {
    $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
    $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);

    $sql = "UPDATE tb_teknisi SET nama ='" . $nama . "', id_area ='" . $id_area . "', no_telpon='" . $no_telpon . "' WHERE nik='" . $nik . "'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>window.alert('Data Berhasil Diubah');
                window.location=(href='datateknisi.php')</script>";
    } else {
        echo "<script>window.alert('Data Gagal Diubah');
    window.location=(href='datateknisi.php')</script>";
    }
}
