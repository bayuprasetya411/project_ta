<?php
include('../config/koneksi.php');

if (isset($_POST['edit_id_nilai'])) {
    $edit_id_nilai = $_POST['edit_id_nilai'];
    $query = mysqli_query($conn, "SELECT * FROM tb_nilai WHERE id_nilai = '$edit_id_nilai'");

    while ($row = mysqli_fetch_array($query)) {
        $id_nilai = $row['id_nilai'];
        $periode = $row['periode'];
        $nik = $row['nik'];
        $id_kriteria = $row['id_kriteria'];
        $id_sub_kriteria = $row['id_sub_kriteria'];
    }
}

?>

<div class="form-group">
    <label class="control-label" for="nik">
        Periode
    </label>
    <input type="text" name="periode" class="form-control" id="periode" placeholder="Periode" required="" value="<?php echo $periode ?> " readonly />
</div>

<?php
$query_teknisi = mysqli_query($conn, "SELECT * FROM tb_teknisi ORDER BY nik DESC");
?>

<div class="form-group">
    <label class="control-label" for="nik">
        Nama Teknisi
    </label>
    <?php while ($tampil = mysqli_fetch_array($query_teknisi)) {
        if ($tampil['nik'] == $nik) {
            ?>
            <input type="hidden" name="nik" class="form-control" id="nik" placeholder="" required="" value="<?php echo $nik ?> " />
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Teknisi" required="" value="<?php echo $tampil['nama']; ?>" readonly />
        <?php } ?>
    <?php
    } ?>
</div>

<?php
$query_kriteria = "SELECT * FROM tb_kriteria";
$result_kriteria = mysqli_query($conn, $query_kriteria);
while ($row = mysqli_fetch_array($result_kriteria)) {
    ?>
    <div class="form-group">
        <label class="control-label" for="id_kriteria">
            <input type="hidden" name="kri[<?php echo $row['id_kriteria'] ?>]" value="<?php echo $id_kriteria ?>">
            <?php echo $row['nama_kriteria'] ?>
        </label>
        <select name="subkri[<?php echo $row['id_kriteria'] ?>]" class="form-control" aria-controls="dataTable" id="id_kriteria" required>
            <option>Pilih Sub Kriteria</option>
            <?php
                $query_subkriteria = "SELECT * FROM tb_subkriteria where id_kriteria ='" . $row['id_kriteria'] . "'";
                $result_subkriteria = mysqli_query($conn, $query_subkriteria);
                while ($data = mysqli_fetch_array($result_subkriteria)) {
                    if ($data['id_sub_kriteria'] == $id_sub_kriteria) {
                        ?>
                    <option value="<?php echo $data['id_sub_kriteria'] ?>" selected> <?php echo $data['nama_sub_kriteria'] ?></option>
                <?php
                        } else {
                            ?>
                    <option value="<?php echo $data['id_sub_kriteria'] ?>"> <?php echo $data['nama_sub_kriteria'] ?></option>
                <?php }
                        ?>
            <?php } ?>
        </select>
    </div>
<?php } ?>