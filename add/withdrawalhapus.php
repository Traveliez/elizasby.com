<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM withdraw WHERE id = $idd") [0];
    $id = $wp["id"];
    
    $query = "DELETE FROM withdraw 
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di hapus
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
                document.location.href = '../withdrawal';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('withdrawal gagal di hapus');
                document.location.href = '../withdrawal';
            </script>
            ";
    }
  

?>
