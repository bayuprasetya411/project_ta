
<?php

if (isset($_SESSION['login'])) {
    require_once __DIR__ . '/vendor/autoload.php';
    include("../config/koneksi.php");
    $periode = $_GET['periode'];
    $query_periode_has_kriteria = mysqli_query(
        $conn,
        "SELECT * FROM tb_periode_has_kriteria
    INNER JOIN tb_kriteria
    ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
    INNER JOIN tb_periode
    ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
    WHERE tb_periode.nama_periode = '" . $periode . "'
    "
    );

    $html = '
<html>
    <head>
        <style>

            body {font-family: sans-serif;
                font-size: 10pt;
            }
            p {	margin: 0pt; }
            table.items {
                border: 0.1mm solid #000000;
            }
            td { vertical-align: top; }
            .items td {
                text-align: center;
                border-left: 0.1mm solid #000000;
                border-right: 0.1mm solid #000000;
                border: 0.1mm solid #000000;
            }
            table thead th { 
                text-align: center;
                height: 40px;
                border: 0.1mm solid #000000;
            }
            p.double {
                border: double;
            }

        </style>
    </head>
<body>
        <div class="logo" style ="width: 150px; margin-left:80%;">
            <img src="../assets/telkom2.jpg">
        </div>
        
        <div style="text-align: center;">
            <h3>LAPORAN HASIL PERANGKINGAN TEKNISI</h3>
        </div>
        

        <table width="100%" style="font-size: 10pt; border-collapse: collapse;  border: 0.1mm solid #000000; " cellpadding="1">
            <tr>
                <td width="50%"></td>
            </tr>
        </table>
        <br />
        
        <table width="100%" cellpadding="3" style="font-size: 10pt;">
            <tr>
                <td width="20%">Periode</td>
                <td>: ' . $periode . '</td>
            </tr>
        </table>
        <br />

        <table class="items" width="100%" style="font-size: 10pt; border-collapse: collapse; " cellpadding="2">
            <thead>
                <tr>
                    <th width="40%">Nama Teknisi</th>
            ';

    while ($data_periode_has_kriteria = mysqli_fetch_array($query_periode_has_kriteria)) {
        $id_periode = $data_periode_has_kriteria['id_periode'];
        $nama_periode = $data_periode_has_kriteria['nama_periode'];
        $nama_kriteria = $data_periode_has_kriteria['nama_kriteria'];


        $html .= '<th class="text-center">' . $nama_kriteria . '</th>';
    }


    $html .= '
                    <th width="13%">Total Nilai</th>
                    <th width="10%">Rank</th>
                </tr>
            </thead>

            <tbody>';
    $query_teknisi = mysqli_query($conn, "SELECT tb_nilai.nilai_akhir, tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                INNER JOIN tb_teknisi
                on tb_nilai.nik = tb_teknisi.nik
                where tb_nilai.id_periode = '" . $id_periode . "'
                group by tb_nilai.nik
                order by tb_nilai.nilai_akhir desc");
    $rank = 1;
    while ($data_teknisi = mysqli_fetch_assoc($query_teknisi)) {
        $nik = $data_teknisi['nik'];
        $nama_teknisi = $data_teknisi['nama'];
        $nilai_akhir = $data_teknisi['nilai_akhir'];

        $html .= '<tr>
                <td style="text-align:left;">' . $nama_teknisi . '</td>';
        $total_nilai = 0;
        $query_periode_has_kriteria2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
        inner Join tb_periode
        on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
        INNER JOIN tb_kriteria
        ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
        WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode . "'");

        while ($data_periode_has_kriteria2 = mysqli_fetch_array($query_periode_has_kriteria2)) {

            $nama_periode2 = $data_periode_has_kriteria2['nama_periode'];
            $id_periode2 = $data_periode_has_kriteria2['id_periode'];
            $id_kriteria = $data_periode_has_kriteria2['id_kriteria'];
            $bobot_kriteria = $data_periode_has_kriteria2['bobot_kriteria'];

            $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
            inner join tb_kriteria
            on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
            where tb_periode_has_kriteria.id_periode ='" . $id_periode . "'
    ");

            while ($data_total_bobot = mysqli_fetch_array($result_total_bobot)) {
                $bobot_normalisasi = $bobot_kriteria / $data_total_bobot['total_bobot'];
                $query_subkriteria = mysqli_query($conn, "SELECT tb_nilai.nik, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                inner join tb_subkriteria
                on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                Where tb_nilai.id_kriteria = '" . $id_kriteria . "' and tb_nilai.nik ='" . $nik . "' and tb_nilai.id_periode ='" . $id_periode2 . "'");
                while ($datasub = mysqli_fetch_array($query_subkriteria)) {
                    $nilai_ultility = $datasub['nilai_sub_kriteria'] * $bobot_normalisasi;
                    $total_nilai += $nilai_ultility;
                    $html .= '<td class="text-center">' . $nilai_ultility . '</td>';
                }
            }
        }
        $html .= '<td class="text-center">' . $nilai_akhir . '</td>';
        $html .= '<td class="text-center">' . $rank++ . '</td>';
    }
    $html .= '</tr>
    </tbody>
</table>
        <br />
        <br />
        <br />
        <div style="text-align: right; margin-right:30px">
            Mengetahui & Menyetujui
        </div>
        <br />
        <br />
        <br />
        <br />

        <div style="text-align: right; margin-right:45px">
            <u><b>Akhmad Syrifudin</b></u>
        </div>
        <div style="text-align: right; margin-right:10px">
            Manager BGES Service Denpasar
        </div>
        

    </body>
</html>
';

    $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
    require_once $path . '/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 15,
        'margin_bottom' => 20,
        'margin_header' => 15,
        'margin_footer' => 15
    ]);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
} else {
    echo "<script>
    alert('Anda Belum Login!!!');window.location=(href='login.php');
  </script>";
}
?>

<?php

if ((isset($_GET['aksi'])) and ($_GET['aksi'] == "logout")) {
    session_destroy();
    echo "<script>window.location=(href='login.php')</script>";
}
?>
