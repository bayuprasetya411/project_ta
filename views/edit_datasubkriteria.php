<?php
include('../config/koneksi.php');

if (isset($_POST['edit_id_subkriteria'])) {

    $edit_id_subkriteria = $_POST['edit_id_subkriteria'];
    $query = "SELECT tb_subkriteria.id_sub_kriteria, tb_subkriteria.nama_sub_kriteria, tb_subkriteria.nilai_sub_kriteria , tb_kriteria.nama_kriteria, tb_subkriteria.id_kriteria FROM tb_subkriteria 
    INNER JOIN tb_kriteria
    on tb_subkriteria.id_kriteria = tb_kriteria.id_kriteria
    WHERE tb_subkriteria.id_kriteria = '$edit_id_subkriteria'";
    $result = mysqli_query($conn, $query);
    // echo "<pre>";
    // print_r(mysqli_fetch_array($result));
    // echo "</pre>";
    // exit();
    ?>
    <div class="container">
        <div class="row">
            <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) { ?>

                <input type='hidden' class="form-control" name="id_sub_kriteria[<?php echo $i ?>]" id="id_sub_kriteria" value="<?php echo $row['id_sub_kriteria'] ?>" />
                <input type='hidden' class="form-control" name="id_kriteria[<?php echo $i ?>]" id="id_kriteria" value="<?php echo $row['id_kriteria'] ?>" />

                <div class='col-sm-4'>
                    <label> Nama Kriteria </label>
                    <div class="form-group">
                        <input type='text' class="form-control" name="nama_kriteria[<?php echo $i ?>]" id="id_kriteria" value="<?php echo $row['nama_kriteria'] ?>" readonly />
                    </div>
                </div>

                <div class='col-sm-4'>
                    <label> Nama Sub Kriteria </label>
                    <div class="form-group">
                        <input type='text' class="form-control" name="nama_sub_kriteria[<?php echo $i ?>]" id="nama_sub_kriteria" value="<?php echo $row['nama_sub_kriteria'] ?>" autofocus />
                    </div>
                </div>

                <div class='col-sm-4'>
                    <label> Nilai Sub Kriteria</label>
                    <div class="form-group">
                        <input type='text' name="nilai_sub_kriteria[<?php echo $i ?>]" id="nilai_sub_kriteria" class="form-control" value="<?php echo $row['nilai_sub_kriteria'] ?>" />
                    </div>
                </div>

            <?php $i++;
                } ?>
        </div>
    </div>
<?php }
?>