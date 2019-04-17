<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM withdraw WHERE id = $idd") [0];


    $id = $wp["id"];
    $status = 3 ;

    

    //query edit data
    $query = "UPDATE withdraw 
               SET status = '$status'                
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di edit
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
                
                document.location.href = '../withdrawal';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('withdrawal gagal');
                document.location.href = '../withdrawal';
            </script>
            ";
    }
  

?>
