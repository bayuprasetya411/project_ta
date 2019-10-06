<?php
include('../config/koneksi.php');


if (isset($_POST['edit_id_kriteria'])) {

    $edit_id_kriteria = $_POST['edit_id_kriteria'];

    $query_kriteria = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$edit_id_kriteria' ";
    $result_kriteria = mysqli_query($conn, $query_kriteria);
    while ($datakriteria = mysqli_fetch_array($result_kriteria)) {
        $id_kriteria = $datakriteria['id_kriteria'];
        $nama_kriteria = $datakriteria['nama_kriteria'];
        $bobot_kriteria = $datakriteria['bobot_kriteria'];
    }
}


?>

<div class="form-group">
    <label class="control-label" for="id_kriteria">
        ID Kriteria
    </label>
    <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" Value="<?php echo $id_kriteria ?>" required readonly />
</div>

<div class="form-group">
    <label class="control-label" for="nama_kriteria">
        Nama Kriteria
    </label>
    <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" Value="<?php echo $nama_kriteria ?>" placeholder="Nama Kriteria" required autofocus="" />
</div>

<div class="form-group">
    <label class="control-label" for="bobot_kriteria">
        Bobot Kriteria
    </label>
    <input type="number" name="bobot_kriteria" class="form-control" id="bobot_kriteria" Value="<?php echo $bobot_kriteria ?>" required placeholder="Bobot Kriteria (1-100)">
</div>