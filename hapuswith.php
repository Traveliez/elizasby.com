<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapuswith ($id) > 0) {
	echo "          
            <script>
               
                document.location.href = '../withdrawal';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../withdrawal';
            </script>
            ";
}


 ?>