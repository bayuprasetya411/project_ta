
    <?php

    include('koneksi.php');

    if (!empty($_POST)) {
        $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $querytambah = "INSERT INTO tb_teknisi (nik, nama, no_telpon, id_area) VALUES ('$nik','$nama','$no_telpon','$id_area')";
        $insert = mysqli_query($conn, $querytambah);

        if ($insert) {
            echo "<script>window.alert('Data Berhasil Disimpan');
                        window.location=(href='datateknisi.php')</script>";
        } else {
            echo "<script>window.alert('Data Gagal Disimpan');
            window.location=(href='datateknisi.php')</script>";
        }
    }

    // } elseif (isset($_POST['editdata'])) {
    //     $nik = $_POST['nik'];
    //     $nama = $_POST['nama'];
    //     $no_telpon = $_POST['no_telpon'];
    //     $id_area = $_POST['id_area'];
    //     $queryedit = "UPDATE FROM tb_teknisi ";
    // }



    // if (isset($_POST['hapusdata'])) {

    //     $nik = $_POST['nik'];
    //     $query = "DELETE FROM tb_teknisi WHERE nik ='$nik'";
    //     $delete = mysqli_query($conn, $query);


    //     if ($delete) {
    //         echo '<script> alert("Data Berhasil Disimpan"); </script>';
    //         header("location:datateknisi.php");
    //     } else {
    //         echo "<script>window.alert('Data Gagal Dihapus');
    //         window.location=(href='datateknisi.php')</script>";
    //     }
    // }
    ?>

