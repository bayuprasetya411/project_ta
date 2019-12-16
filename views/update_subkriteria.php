<?php
include('../config/koneksi.php');

if (isset($_POST['edit_id_subkriteria'])) {

    $edit_id_subkriteria = $_POST['edit_id_subkriteria'];
    $query_subkriteria = "SELECT tb_subkriteria.id_sub_kriteria, tb_subkriteria.nama_sub_kriteria, tb_subkriteria.nilai_sub_kriteria , tb_kriteria.nama_kriteria, tb_subkriteria.id_kriteria FROM tb_subkriteria 
    INNER JOIN tb_kriteria
    on tb_subkriteria.id_kriteria = tb_kriteria.id_kriteria
    WHERE tb_subkriteria.id_kriteria = '$edit_id_subkriteria'";
    $result_subkriteria = mysqli_query($conn, $query_subkriteria);
    ?>
    <div class="container">
        <div class="row">
            <?php
                $i = 0;
                while ($datasubkriteria = mysqli_fetch_array($result_subkriteria)) { ?>

                <input type='hidden' class="form-control" name="id_sub_kriteria[<?php echo $i ?>]" id="id_sub_kriteria" value="<?php echo $datasubkriteria['id_sub_kriteria'] ?>" />
                <input type='hidden' class="form-control" name="id_kriteria[<?php echo $i ?>]" id="id_kriteria" value="<?php echo $datasubkriteria['id_kriteria'] ?>" />

                <div class='col-sm-4'>
                    <label> Nama Kriteria </label>
                    <div class="form-group">
                        <input type='text' class="form-control" name="nama_kriteria[<?php echo $i ?>]" id="id_kriteria" value="<?php echo $datasubkriteria['nama_kriteria'] ?>" readonly />
                    </div>
                </div>

                <div class='col-sm-4'>
                    <label> Nama Sub Kriteria </label>
                    <div class="form-group">
                        <input type='text' class="form-control" name="nama_sub_kriteria[<?php echo $i ?>]" id="nama_sub_kriteria" value="<?php echo $datasubkriteria['nama_sub_kriteria'] ?>" required autofocus />
                    </div>
                </div>

                <div class='col-sm-4'>
                    <label> Nilai Sub Kriteria</label>
                    <div class="form-group">
                        <input type='number' name="nilai_sub_kriteria[<?php echo $i ?>]" id="nilai_sub_kriteria" class="form-control" value="<?php echo $datasubkriteria['nilai_sub_kriteria'] ?>" placeholder="Nilai Sub Kriteria (0-100)" required />
                    </div>
                </div>

            <?php $i++;
                } ?>
        </div>
    </div>
<?php }
?>