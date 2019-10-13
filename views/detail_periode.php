<?php

include('../config/koneksi.php');

if (isset($_GET)) {
    $query_periode = mysqli_query($conn, "SELECT * FROM tb_periode where id_periode ='" . $_GET['detail_id_periode'] . "' ");
    $data_periode = mysqli_fetch_assoc($query_periode);
    $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
    inner join tb_kriteria
    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria 
    where id_periode ='" . $_GET['detail_id_periode'] . "' ");
    $data_total_bobot = mysqli_fetch_array($result_total_bobot);
    // $query_kriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
    $query_periode_has_kriteria = mysqli_query($conn, "SELECT * FROM tb_periode_has_kriteria
    INNER JOIN tb_kriteria
    ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
    WHERE id_periode = '" . $_GET['detail_id_periode'] . "'");

    $result_periode = array();
    $result_edit_periode = array();
    // $result_kriteria = array();

    // while ($data_kriteria = mysqli_fetch_array($query_kriteria)) {

    //     $row1 = array(
    //         'id_kriteria' => $data_kriteria['id_kriteria'],
    //         'nama_kriteria' => $data_kriteria['nama_kriteria']
    //     );
    //     $result_kriteria[] = $row1;
    // }

    while ($data_periode_has_kriteria = mysqli_fetch_array($query_periode_has_kriteria)) {

        $row = array(
            'id_periode' => $data_periode_has_kriteria['id_periode'],
            'id_kriteria' => $data_periode_has_kriteria['id_kriteria'],
            'nama_kriteria' => $data_periode_has_kriteria['nama_kriteria'],
            'bobot_normalisasi' => $data_periode_has_kriteria['bobot_kriteria'] / $data_total_bobot['total_bobot']
        );
        $result_periode[] = $row;
    }

    // $result_edit_periode['kriteria'] = $result_kriteria;
    $result_edit_periode['periode'] = $result_periode;
    $result_edit_periode['nama_periode'] = $data_periode['nama_periode'];
    echo json_encode($result_edit_periode);
}


// $edit_id_periode = $_POST['edit_id_periode'];


// $query = "SELECT tb_periode_has_kriteria.id_periode, tb_periode.nama_periode, tb_periode_has_kriteria.id_kriteria  FROM tb_periode_has_kriteria
//             inner Join tb_periode
//             on tb_periode_has_kriteria.id_periode  =  tb_periode.id_periode 
//             WHERE tb_periode_has_kriteria.id_periode  = $edit_id_periode ";
// $result = mysqli_query($conn, $query);
// while ($row = mysqli_fetch_array($result)) {
//     $id_periode = $row['id_periode'];
//     $nama_periode = $row['nama_periode'];
//     $data_kriteria = $row['id_kriteria'];
// }
// 
