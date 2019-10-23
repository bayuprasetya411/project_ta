<?php

include('../config/koneksi.php');

$query_periode_has_kriteria = mysqli_query($conn, "SELECT * FROM tb_periode_has_kriteria
INNER JOIN tb_kriteria
ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
WHERE id_periode = '4'");

$result_periode_has_kriteria = array();
$result_nilai = array();
$result_get_nilai = array();

while ($data_periode_has_kriteria = mysqli_fetch_array($query_periode_has_kriteria)) {

    $bobot_kriteria = $data_periode_has_kriteria['bobot_kriteria'];
    $data = array(
        'id_periode' => $data_periode_has_kriteria['id_periode'],
        'id_kriteria' => $data_periode_has_kriteria['id_kriteria'],
        'nama_kriteria' => $data_periode_has_kriteria['nama_kriteria'],
        'bobot_kriteria' => $data_periode_has_kriteria['bobot_kriteria']
    );

    $result_periode_has_kriteria[] = $data;

    $query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai
        INNER JOIN tb_subkriteria
        on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
        where tb_subkriteria.id_kriteria = '" . $data_periode_has_kriteria['id_kriteria'] . "' and tb_nilai.id_periode = '" . $data_periode_has_kriteria['id_periode'] . "'
        group by nik
        ");

    $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
        inner join tb_kriteria
        on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria 
        where tb_periode_has_kriteria.id_periode ='" . $data_periode_has_kriteria['id_periode'] . "'
        ");

    while ($data_total_bobot = mysqli_fetch_array($result_total_bobot)) {

        $bobot_normalisasi = $bobot_kriteria / $data_total_bobot['total_bobot'];

        while ($data_nilai = mysqli_fetch_assoc($query_nilai)) {

            $nilai_ultility = $data_nilai['nilai_sub_kriteria'] * $bobot_normalisasi;

            // $row = array(
            //     'nama_kriteria' => $data_nilai['id_kriteria'],
            //     'bobot_normalisasi' => $bobot_kriteria / $data_total_bobot['total_bobot'],
            //     'nilai_ultility' => $data_nilai['nilai_sub_kriteria'] * $bobot_normalisasi
            // );
            // $result_nilai[] = $row;

            echo "<pre>";
            print_r($nilai_ultility);
            echo "</pre>";

            echo "<pre>";
            print_r($data_nilai);
            echo "</pre>";
        }
    }
}

$result_get_nilai['data_kriteria'] = $result_periode_has_kriteria;
// $result_get_nilai['data_nilai'] = $result_nilai;
// $result_get_nilai['data_bobot'] = $total_nilai;
echo json_encode($result_get_nilai);
