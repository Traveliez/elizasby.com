<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapuspromo ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../editpromo';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../editpromo';
            </script>
            ";
}


 ?>