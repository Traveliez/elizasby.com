<?php 
	include '../include/fungsi.php';
	
	$bank = $_POST['bank'];
	
        $kodemember = $_POST["kodemember"];
	$tampil=mysqli_query($conn, "SELECT * FROM bank WHERE bank='$bank' AND kode_member='$kodemember' ");
	$jml=mysqli_num_rows($tampil);
	if($jml > 0){
	    echo"
	     <option selected value=''>Pilih No Rekening</option>";
	     while($r=mysqli_fetch_array($tampil)){
	         echo "<option >$r[norek]</option>";
			 
	     }
	}else{
	    echo "
	     <option selected>- Tidak ada No Rekening -</option>";
	}

	
?>