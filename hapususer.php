<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapususer ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../daftar-member';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../daftar-member';
            </script>
            ";
}


 ?>