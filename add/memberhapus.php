<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM member WHERE id_member = $idd") [0];
    $id = $wp["id_member"];
    
    $query = "DELETE FROM member 
                WHERE id_member = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di hapus
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
                document.location.href = '../member';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('withdrawal gagal di hapus');
                document.location.href = '../member';
            </script>
            ";
    }
  

?>
