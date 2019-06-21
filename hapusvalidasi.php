<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapusvalidasi ($id) > 0) {
	echo "          
            <script>
                alert('data berhasil dihapus');
                document.location.href = '../validasi';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../validasi';
            </script>
            ";
}


 ?>