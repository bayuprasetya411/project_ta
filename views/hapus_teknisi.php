<?php

include('../config/koneksi.php');

if (isset($_POST['hapus_nik'])) {
    $hapus_nik = $_POST['hapus_nik'];
    $query_teknisi = "SELECT *  FROM tb_teknisi WHERE nik = '$hapus_nik' ";
    $result_teknisi = mysqli_query($conn, $query_teknisi);
    while ($datateknisi = mysqli_fetch_array($result_teknisi)) {
        $nik = $datateknisi['nik'];
    }
}
?>
<input type="hidden" name="nik" id="nik" value="<?php echo $nik ?>" required autofocus="autofocus" />
<h5 class="text-center">Yakin Anda Akan Menghapus Data?</h5>