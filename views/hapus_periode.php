<?php


include('../config/koneksi.php');

if (isset($_GET)) {
    $query_periode = mysqli_query($conn, "SELECT * FROM tb_periode where id_periode ='" . $_GET['hapus_id_periode'] . "' ");
    while ($data_periode = mysqli_fetch_assoc($query_periode)) {
        $id_periode = $data_periode['id_periode'];
        $nama_periode = $data_periode['nama_periode'];
    }
}

?>
<input type="hidden" name="id_periode" id="id_periode" value="<?php echo $id_periode ?>" />
<h5 class="text-center">Yakin Anda Akan Menghapus Data?</h5>