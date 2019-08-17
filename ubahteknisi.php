<?php
include('koneksi.php');

if (isset($_POST["nik"])) {
    $query = "SELECT * FROM tb_teknisi WHERE nik ='" . $_POST["nik"] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>




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