<?php

include('../config/koneksi.php');

if (isset($_GET)) {
    $query_periode = mysqli_query($conn, "SELECT * FROM tb_periode where id_periode ='" . $_GET['edit_id_periode'] . "' ");
    while ($data_periode = mysqli_fetch_assoc($query_periode)) {
        $id_periode = $data_periode['id_periode'];
        $nama_periode = $data_periode['nama_periode'];
    }
}

?>
<div class="form-group">
    <label class="control-label" for="nama_periode">Nama Periode</label>
    <input type="hidden" name="id_periode" class="form-control" id="id_periode" value="<?php echo $id_periode ?>" />
    <input type="text" name="nama_periode" class="form-control" id="nama_periode" value="<?php echo $nama_periode ?>" required />
</div>