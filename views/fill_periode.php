<?php

include('../config/koneksi.php');

if (!empty($_POST)) {
    $id_periode = $_POST['id_periode'];
    $query_periode = "SELECT  tb_periode.id_periode,tb_kriteria.id_kriteria, tb_kriteria.nama_kriteria from tb_periode_has_kriteria
    INNER join tb_kriteria
    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
    INNER join tb_periode
    on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
    WHERE tb_periode.id_periode = '" . $id_periode . "'";
    $result_periode = mysqli_query($conn, $query_periode);
    $result = array();
    while ($dataperiode = mysqli_fetch_assoc($result_periode)) {
        $result[] = $row;
    }

    echo json_encode($result);
}
