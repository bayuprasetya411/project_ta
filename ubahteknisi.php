<?php
include('koneksi.php');

if (isset($_POST["nik"])) {
    $query = "SELECT * FROM tb_teknisi WHERE nik ='" . $_POST["nik"] . "'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nik = $row['nik'];
        $nama = $row['nama'];
        $id_area = $row['id_area'];
        $no_telpon = $row['no_telpon'];
    };
}

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




<!-- Script hapus teknisi -->
<!-- <script type="text/javascript">
        $(document).ready(function() {
            $('#hapusteknisi').on('click', function() {
                $('#modal-hapus').modal('show');

                $tr = $tr.children('td').map(function() {
                    return $this.text();
                }).get();

                console.log(data);
                $('#nik').val(data[1]);
            });

        });
    </script> -->
<!-- Script hapus teknisi -->