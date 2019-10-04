<?php

include('../config/koneksi.php');


$edit_id_periode = $_POST['edit_id_periode'];


$query = "SELECT tb_periode_has_kriteria.id_periode, tb_periode.nama_periode, tb_periode_has_kriteria.id_kriteria  FROM tb_periode_has_kriteria
            inner Join tb_periode
            on tb_periode_has_kriteria.id_periode  =  tb_periode.id_periode 
            WHERE tb_periode_has_kriteria.id_periode  = $edit_id_periode ";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $id_periode = $row['id_periode'];
    $nama_periode = $row['nama_periode'];
    $data_kriteria = $row['id_kriteria'];
}
?>

<div class="form-group">
    <label class="control-label" for="nama_periode">
        Nama Periode
    </label>
    <input type="hidden" name="id_periode" class="form-control" id="id_periode" value="<?php echo $id_periode ?>" />
    <input type="text" name="nama_periode" class="form-control" id="nama_periode" value="<?php echo $nama_periode ?>" readonly required />
</div>

<div class="form-group">
    <label class="control-label" for="nama_kriteria">
        Kriteria
    </label>
    <select class="form-control select-kriteria" id="id_kriteria" name="id_kriteria[]" multiple="multiple" style="width:100%;" autofocus required>

        <?php
        $query_tampil = mysqli_query($conn, "SELECT * FROM tb_kriteria");
        while ($row1 = mysqli_fetch_array($query_tampil)) {
            $id_kriteria = $row1['id_kriteria'];
            $nama_kriteria = $row1['nama_kriteria'];
            if ($id_kriteria == $data_kriteria) { ?>
                <option value="<?php echo $id_kriteria ?>" selected="selected"><?php echo $nama_kriteria ?></option>
            <?php
                } else {
                    ?>
                <option value="<?php echo $id_kriteria ?>"><?php echo $nama_kriteria ?></option>
        <?php
            }
        } ?>
    </select>
</div>

<script>
    $(document).ready(function() {
        $('.select-kriteria').select2({
            placeholder: "-- Pilih Kriteria --",
            allowClear: true
        });
    });
</script>