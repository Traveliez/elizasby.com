<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapusartikel ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../artikel';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../artikel';
            </script>
            ";
}


 ?>