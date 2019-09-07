<?php
include('../config/koneksi.php');


if (isset($_POST['get_id_kriteria'])) {
    $get_id_kriteria = $_POST['get_id_kriteria'];
    $query = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$get_id_kriteria' ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id_kriteria = $row['id_kriteria'];
        $nama_kriteria = $row['nama_kriteria'];
    }
}



?>


<input type="hidden" name="id_kriteria" class="form-control" id="nik" value="<?php echo $id_kriteria ?>">

<label class="control-label" for="nama_kriteria">Nama Kriteria</label>
<input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" value="<?php echo $nama_kriteria ?>" readonly>

<label class="control-label" for="nama_sub_kriteria">Nama Sub Kriteria</label>
<input type="text" name="nama_sub_kriteria" class="form-control" id="nama_sub_kriteria" placeholder="Nama Sub Kriteria" required autofocus="autofocus" />

<label class="control-label" for="nilai_sub_kriteria">Nilai Sub Kriteria</label>
<input type="number" name="nilai_sub_kriteria" class="form-control" id="nilai_sub_kriteria" placeholder="Nilai Sub Kriteria (0-100)" required>