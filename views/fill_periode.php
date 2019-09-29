<?php

include('../config/koneksi.php');

if (!empty($_POST)) {
    $id_periode = $_POST['id_periode'];
    $query = "SELECT  tb_periode.id_periode,tb_kriteria.id_kriteria, tb_kriteria.nama_kriteria from tb_periode_has_kriteria
    INNER join tb_kriteria
    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
    INNER join tb_periode
    on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
    WHERE tb_periode.id_periode = '" . $id_periode . "'";
    $sql = mysqli_query($conn, $query);
    $result = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $result[] = $row;
    }

    echo json_encode($result);
}
