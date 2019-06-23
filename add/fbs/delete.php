<?php 

require '../../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM data_fbs WHERE id = $idd") [0];
    $id = $wp["id"];
    
    $query = "DELETE FROM data_fbs 
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di hapus
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
                document.location.href = '../../tampilan-fbs';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('gagal di hapus');
                document.location.href = '../../tampilan-fbs';
            </script>
            ";
    }
  

?>
