<?php 
require '../include/fungsi.php';

$id = $_GET["id"];



if ( hapusbank ($id) > 0) {
	echo "          
            <script>
                
                document.location.href = '../profile';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../profile';
            </script>
            ";
}


 ?>