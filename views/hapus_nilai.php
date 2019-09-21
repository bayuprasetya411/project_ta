<?php

include('../config/koneksi.php');

if (isset($_POST['hapus_id_nilai'])) {
    $hapus_id_nilai = $_POST['hapus_id_nilai'];
    $query = "SELECT *  FROM tb_nilai WHERE id_nilai = '$hapus_id_nilai' ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id_nilai = $row['id_nilai'];
    }
}
?>
<input type="hidden" name="id_nilai" class="form-control" id="id_nilai" value="<?php echo $id_nilai ?>" required autofocus="autofocus" />
<h5>Yakin Anda Akan Menghapus Data?</h5>