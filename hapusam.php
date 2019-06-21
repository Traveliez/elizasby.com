<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapusam ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../edit-am';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../edit-am';
            </script>
            ";
}


 ?>