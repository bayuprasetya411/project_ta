<?php
include('../config/koneksi.php');


if (isset($_POST['edit_id_kriteria'])) {

    $edit_id_kriteria = $_POST['edit_id_kriteria'];

    $query = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$edit_id_kriteria' ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id_kriteria = $row['id_kriteria'];
        $nama_kriteria = $row['nama_kriteria'];
        $bobot_kriteria = $row['bobot_kriteria'];
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