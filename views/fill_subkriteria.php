<?php

include('../config/koneksi.php');

if (!empty($_POST)) {
    $id_kriteria = $_POST['id_kriteria'];
    $query_subkriteria = "SELECT * FROM tb_subkriteria WHERE id_kriteria ='$id_kriteria'";
    $sql = mysqli_query($conn, $query_subkriteria);
    $result_subkriteria = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $result_subkriteria[] = $row;
    }
    echo json_encode($result_subkriteria);
}
