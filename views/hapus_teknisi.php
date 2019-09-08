<?php

include('../config/koneksi.php');

if (isset($_POST['hapus_nik'])) {
    $hapus_nik = $_POST['hapus_nik'];
    $query = "SELECT *  FROM tb_teknisi WHERE nik = '$hapus_nik' ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nik = $row['nik'];
    }
}
?>
<input type="hidden" name="nik" class="form-control" id="nik" placeholder="Nik Karyawan" value="<?php echo $nik ?>" required autofocus="autofocus" />
<h5>Yakin Anda Akan Menghapus Data?</h5>