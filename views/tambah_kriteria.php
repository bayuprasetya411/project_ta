<?php

include('../config/koneksi.php');

if (!empty($_POST)) {

    $id_kriteria = mysqli_real_escape_string($conn, $_POST["id_kriteria"]);
    $nama_kriteria = mysqli_real_escape_string($conn, $_POST["nama_kriteria"]);
    $bobot_kriteria = mysqli_real_escape_string($conn, $_POST["bobot_kriteria"]);

    if ($_POST['bobot_kriteria'] <= 100) {

        $total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_kriteria");
        $row = mysqli_fetch_array($total_bobot);
        $bobot_normalisasi1 = $bobot_kriteria / $row['total_bobot'];
        $querytambah = "INSERT INTO tb_kriteria (id_kriteria, nama_kriteria, bobot_kriteria, bobot_normalisasi_kriteria) VALUES ('$id_kriteria','$nama_kriteria','$bobot_kriteria','$bobot_normalisasi1')";
        $insert = mysqli_query($conn, $querytambah);
        if ($insert) {
            echo "<script> window.alert('Data Berhasil Disimpan');
                        window.location=(href='datakriteria.php') </script>";
        } else {
            echo "<script> window.alert('Data Gagal Disimpan') </script>";
        }
    } else {
        echo "<script> window.alert('bobot kriteria maksimal 100') </script>";
    }
}
