<?php
include('../config/koneksi.php');

if (isset($_GET)) {
    $query_teknisi = mysqli_query($conn, "SELECT * FROM tb_teknisi where nik ='" . $_GET['nik'] . "' ");
    $data_teknisi = mysqli_fetch_assoc($query_teknisi);
    $query_periode = mysqli_query($conn, "SELECT * FROM tb_periode where id_periode ='" . $_GET['id_periode'] . "' ");
    $data_periode = mysqli_fetch_assoc($query_periode);
    $query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai
    INNER join tb_subkriteria
    ON tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
    INNER join tb_kriteria
    on tb_subkriteria.id_kriteria= tb_kriteria.id_kriteria
    WHERE nik  = '" . $_GET['nik'] . "' and id_periode = '" . $_GET['id_periode'] . "'");
    // while ($data_nilai = mysqli_fetch_assoc($query_nilai)) {
    //     // echo '<pre>';
    //     // print_r($data_nilai);
    //     // echo '</pre>';
    // }
    $result_nilai = array();
    $result_detail = array();
    while ($data_nilai = mysqli_fetch_assoc($query_nilai)) {
        $row = array(
            'id_nilai' => $data_nilai['id_nilai'],
            'id_kriteria' => $data_nilai['id_kriteria'],
            'nama_kriteria' => $data_nilai['nama_kriteria'],
            'id_sub_kriteria' => $data_nilai['id_sub_kriteria'],
            'nama_sub_kriteria' => $data_nilai['nama_sub_kriteria'],
            'nilai_sub_kriteria' => $data_nilai['nilai_sub_kriteria']
        );
        $result_nilai[] = $row;
    }
    $result_detail['nilai'] = $result_nilai;
    $result_detail['nama'] = $data_teknisi['nama'];
    $result_detail['nama_periode'] = $data_periode['nama_periode'];
    echo json_encode($result_detail);
    // exit();

    // $result_edit = array();
    // while ($row = mysqli_fetch_assoc($query)) {
    //     $result_edit[] = $row;
    // }

    // echo json_encode($result_edit);
}
