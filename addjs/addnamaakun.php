<?php 
	include '../include/fungsi.php';

	$noakun = $_POST['noakun'];
	$kodemember = $_POST["kodemember"];
	$tampil=mysqli_query($conn, "SELECT * FROM validasi WHERE no_akun='$noakun' AND kode_member='$kodemember' AND status = 2 ");
	$jml=mysqli_num_rows($tampil);
	if($jml > 0){
	    echo"
	     <option selected value=''>Pilih Nama Akun</option>";
	     while($r=mysqli_fetch_array($tampil)){
	         echo ucwords("<option >$r[nama]</option>");
			 
	     }
	}else{
	    echo "
	     <option selected>- No Akun Belum Di Pilih -</option>";
	}

	
?>