<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapusedu ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../edit-edu';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../edit-edu';
            </script>
            ";
}


 ?>