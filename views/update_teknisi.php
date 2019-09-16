<?php

include('../config/koneksi.php');

if (isset($_POST['edit_nik'])) {

    $edit_nik = $_POST['edit_nik'];

    $query = "SELECT * FROM tb_teknisi WHERE nik = $edit_nik ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nik = $row['nik'];
        $nama = $row['nama'];
        $id_area = $row['id_area'];
        $no_telpon = $row['no_telpon'];
    }
}

?>

<div class="form-group">
    <label class="control-label" for="nik">Nik Karyawan</label>
    <input type="text" name="nik" class="form-control" id="nik" value="<?php echo $nik ?>" readonly>
</div>

<div class="form-group">
    <label class="control-label" for="nama">Nama Karyawan</label>
    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $nama ?>" autofocus="autofocus" required>
</div>

<?php
$query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
?>
<div class="form-group">
    <label class="control-label" for="id_area">
        Area
    </label>
    <select name="id_area" class="form-control" aria-controls="dataTable" id="id_area">
        <option value="0">--- Pilih Area ----</option>
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
    <label class="control-label" for="no_telpon">No Telpon (08xxxxxxxxxxxxxx)</label>
    <input type="text" name="no_telpon" class="form-control" id="no_telpon" value="<?php echo $no_telpon ?>" required>
</div>