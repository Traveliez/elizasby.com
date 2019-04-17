<?php 
require '../include/fungsi.php';

$id = $_GET["id"];

if ( hapuspromosi ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../postpromo';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../postpromo';
            </script>
            ";
}


 ?>