<?php
include('koneksi.php');



?>

<div class="form-group">
    <label class="control-label" for="nik">
        <h4>Nik Karyawan</h4>
    </label>
    <input type="text" name="nik" class="form-control" id="nik" value="<?php echo $nik ?>" required readonly>
</div>

<div class="form-group">
    <label class="control-label" for="nama">
        <h4>Nama Karyawan</h4>
    </label>
    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $nama ?>" autofocus="autofocus" required>
</div>

<?php
$query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
?>

<div class="form-group">
    <label class="control-label" for="id_area">
        <h4>Area</h4>
    </label>
    <select name="id_area" class="form-control" aria-controls="dataTable" id="id_area">


        <?php
        while ($data = mysqli_fetch_array($query_area)) {
            if ($data['id_area'] == $id_area) {
                ?>
        <option value="<?php echo $data['id_area'] ?>" selected> <?php echo $data['area']; ?></option>
        <?php
            } else {
                ?>
        <option value="<?php echo $data['id_area'] ?>"> <?php echo $data['area']; ?></option>
        <?php
            }
        }
        ?>

    </select>
</div>

<div class="form-group">
    <label class="control-label" for="no_telpon">
        <h4>No Telpon (08xxxxxxxxxxxxxx)</h4>
    </label>
    <input type="text" name="no_telpon" class="form-control" id="no_telpon" value="<?php echo $no_telpon ?>" required>
</div>