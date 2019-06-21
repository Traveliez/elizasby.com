<?php 
	include '../include/fungsi.php';

	$norek = $_POST['norek'];
	$tampil=mysqli_query($conn, "SELECT * FROM bank WHERE norek='$norek'");
	$jml=mysqli_num_rows($tampil);
	if($jml > 0){
	    
	     while($r=mysqli_fetch_array($tampil)){
	         echo "<option >$r[nama]</option>";
			 
	     }
	}else{
	    echo "
	     <option selected>- Tidak ada Nama Rekening -</option>";
	}

	
?>