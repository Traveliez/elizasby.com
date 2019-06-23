<?php 

require '../../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM data_fbs WHERE id = $idd") [0];


    $id = $wp["id"];
    $status = 1;

    

    //query edit data
    $query = "UPDATE data_fbs 
               SET status = '$status'                
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di edit
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
			alert('Status = Gagal');
                document.location.href = '../../tampilan-fbs';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('gagal');
                document.location.href = '../../tampilan-fbs';
            </script>
            ";
    }
  

?>
