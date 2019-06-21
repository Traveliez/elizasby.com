<?php 
	include '../include/fungsi.php';

	$broker = $_POST['broker'];
	$kodemember = $_POST["kodemember"];
	$tampil=mysqli_query($conn, "SELECT * FROM validasi WHERE broker='$broker' AND kode_member='$kodemember' AND status = 2");
	$jml=mysqli_num_rows($tampil);
	if($jml > 0){
	    echo"
	     <option selected value=''>Pilih No Akun</option>";
	     while($r=mysqli_fetch_array($tampil)){
	         echo "<option >$r[no_akun]</option>";
			 
	     }
	}else{
	    echo "
	     <option selected>- Tidak ada No Akun -</option>";
	}

	
?>