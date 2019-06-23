<?php 


// $user_name = "vlcfxcom_user2";
// $password = "yohan5758";
// $database = "vlcfxcom_db2";
// $host_name = "vlcfx.com"; 

// $konek = mysqli_connect($host_name, $user_name, $password);
 
// if ($konek) {
// 	echo "Koneksi Terbuka";
// 	mysql_select_db($database);
// }else{
// 	echo "koneksi tertutup";
// }

 

//koneksi database
$conn = mysqli_connect('localhost', 'u523858181_eliza','google123','u523858181_eliza');
//$conn = mysqli_connect('localhost', 'root','','warungbroker');
//$conn = mysqli_connect('elizasby.com', 'u5238264_er','wber2018','u5238264_wb');


$dollarFireDeposit 		= '10000';
  	$dollarFireWithdrawal 	= '10000';
  	$dollarInstaDeposit 	= '13500';
  	$dollarInstaWithdrawal 	= '13000';

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query );
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows [] = $row;
	}
	return $rows;
}

function queryy($queryy) {
	global $conn;
	$resultt = mysqli_query($conn, $queryy );
	$rowss = [];
	while( $roww = mysqli_fetch_assoc($resultt) ) {
		$rowss [] = $roww;
	}
	return $rowss;
}
	

function tambahdeposit ($depo) {
	// ambil data dari tiap elemen form
	global $conn;
	$tanggal = htmlspecialchars($depo["tanggal"]);
	$email = htmlspecialchars($depo["email"]);
	$broker = htmlspecialchars($depo["broker"]);
	$no_akun = htmlspecialchars($depo["no_akun"]);
	$deposit = htmlspecialchars($depo["deposit"]);
	$bank = htmlspecialchars($depo["bank"]);
	$unik =  rand(10,200);

	//query insert data
	$query = "INSERT INTO deposit 
				VALUES 
				('','$tanggal','$email','$broker','$no_akun','$deposit','$bank','$unik') 
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahwithdrawal ($wd) {
	// ambil data dari tiap elemen form
	global $conn;
	$tanggal = htmlspecialchars($wd["tanggal"]);
	$email = htmlspecialchars($wd["email"]);
	$broker = htmlspecialchars($wd["broker"]);
	$no_akun = htmlspecialchars($wd["no_akun"]);
	$withdrawal = htmlspecialchars($wd["withdrawal"]);
	$bank = htmlspecialchars($wd["bank"]);
	$norek = htmlspecialchars($wd["norek"]);
	$namarek = htmlspecialchars($wd["namarek"]);

	//query insert data
	$query = "INSERT INTO withdraw
				VALUES 
				('','$tanggal','$email','$broker','$no_akun','$withdrawal','$bank','$norek','$namarek') 
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function validasi ($vd) {
	// ambil data dari tiap elemen form
	global $conn;
	$tanggal = htmlspecialchars($vd["tanggal"]);
	$email = htmlspecialchars($vd["email"]);
	$nama = htmlspecialchars($vd["nama"]);
	$broker = htmlspecialchars($vd["broker"]);
	$no_akun = htmlspecialchars($vd["no_akun"]);	

	//query insert data
	$query = "INSERT INTO validasi
				VALUES 
				('','$tanggal','$email','$nama','$broker','$no_akun') 
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

// function registrasi ($data) {
// 	// ambil data dari tiap elemen form
// 	global $conn;	
// 	$email = htmlspecialchars($data["email"]);
// 	$username = strtolower(stripcslashes($data["username"]));
// 	$password = mysqli_real_escape_string($conn, $data["password"]);
// 	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
// 	$aff = htmlspecialchars($data["aff"]);
// 	$idaff = rand(100000,900000);
// 	//cek username atau email sudah ada atau belum
// 	$cekemail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
// 	if (mysqli_fetch_assoc($cekemail)) {
// 		echo "<script>
// 				alert('email sudah terdaftar');
				
// 			</script>";
// 		return false;

// 	}

// 	// cek konfirmasi passqord
// 	if ( $password !== $password2) {
// 		echo "<script>
// 				alert('konfirmasi password tidak sesuai');
				
// 			</script>
// 			";
// 		return false;
// 	}

// 	//enskripsi password
// 	$password = password_hash($password, PASSWORD_DEFAULT);

// 	//query tambah member
// 	$query = "INSERT INTO user 
// 				VALUES 
// 				('','$email','$username','$password','$aff','$idaff') 
// 			";
// 	mysqli_query($conn, $query);

// 	return mysqli_affected_rows($conn);
// }

function hapus ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM member Where id = $id");

	return mysqli_affected_rows($conn);
}

function edit ($data) {
	// ambil data dari tiap elemen form
	global $conn;
	$id = ($data["id"]);
	$nama = htmlspecialchars($data["nama"]);
	$username = htmlspecialchars($data["username"]);
	$email = htmlspecialchars($data["email"]);
	$kode_affiliasi = htmlspecialchars($data["kode_affiliasi"]);

	//query insert data
	$query = "UPDATE member SET
				nama = '$nama',
				username = '$username',
				email = '$email',
				kode_affiliasi = 'kode_affiliasi'
				WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function postam ($am) {
	// ambil data dari tiap elemen form
	global $conn;
	$tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $judul = htmlspecialchars($am["judul"]);
    $kategori = htmlspecialchars($am["kategori"]);    
    $kontent = $am["kontent"];

    $gambar = uploada();
    if (!$gambar) {
        return false;
    }

   

    //query insert data
    $query = "INSERT INTO artikel
                VALUES 
                ('','$tang','$jam','$judul','$kategori','$gambar','$kontent') 
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function postpromo ($pp) {
	// ambil data dari tiap elemen form
	global $conn;
	$tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $judul = htmlspecialchars($pp["judul"]);
    $kategori = htmlspecialchars($pp["kategori"]);    
    $kontent = $pp["kontent"];

    $gambar = uploada();
    if (!$gambar) {
        return false;
    }

   

    //query insert data
    $query = "INSERT INTO promo
                VALUES 
                ('','$tang','$jam','$judul','$kategori','$gambar','$kontent') 
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function uploada() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang di upload
	if ($error === 4) {
		echo "<script>
				alert('gambar belum di pilih')
			</script>";
		return false;
	}

	//cek ekstensi file gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang di upload bukan gambar')
			</script>";
		return false;
	}

	//cek ukuran gambar
	if ($ukuranFile > 2000000) {
		echo "<script> 
				alert('ukuran gambar terlalu besar')
			</script>";
		return false;
	}

	//generate nama gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'images/'.$namaFileBaru); 

	return $namaFileBaru;
}

function postfoto ($ft) {
	
	// ambil data dari tiap elemen form
	global $conn;
	
	$user = query("SELECT * FROM admin WHERE username = '".$_SESSION['username']."'") [0];
	$id = $user['id'];
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

   

    //query insert data
     $query = "UPDATE admin SET 
	    
	    foto = '$gambar'                
	    WHERE id = $id
	    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang di upload
	if ($error === 4) {
		echo "<script>
				alert('gambar belum di pilih')
			</script>";
		return false;
	}

	//cek ekstensi file gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang di upload bukan gambar')
			</script>";
		return false;
	}

	//cek ukuran gambar
	if ($ukuranFile > 2000000) {
		echo "<script> 
				alert('ukuran gambar terlalu besar')
			</script>";
		return false;
	}

	//generate nama gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'images/'.$namaFileBaru); 

	return $namaFileBaru;
}


function postpand ($pp) {
	// ambil data dari tiap elemen form
	global $conn;
	$tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $broker = htmlspecialchars($pp["broker"]);    
    $kategori = htmlspecialchars($pp["kategori"]);    
    $kontent = $pp["kontent"];

    

   

    //query insert data
    $query = "INSERT INTO panduanb
                VALUES 
                ('','$tang','$jam','$broker','$kategori','$kontent') 
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

// function editam ($am) {
// 	// ambil data dari tiap elemen form
// 	global $conn;
// 	$id = $am["id"];
// 	$tanggal = htmlspecialchars($am["tanggal"]);
//     $judul = htmlspecialchars($am["judul"]);
//     $kategori = htmlspecialchars($am["kategori"]);
//     $gambar = htmlspecialchars($am["gambar"]);    
//     $kontent = $am["kontent"];

// 	//query insert data
// 	$query = "UPDATE ana SET
// 				tanggal = '$tanggal',
// 				judul = '$judul',
// 				ketegori = '$kategori',
// 				gambar = '$gambar',
// 				kontent = '$kontent'
// 				WHERE id = $id
// 			";
// 	mysqli_query($conn, $query);

// 	return mysqli_affected_rows($conn);
// }

function postedu ($edu) {
	// ambil data dari tiap elemen form
	global $conn;
	$tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $judul = htmlspecialchars($edu["judul"]);
    $kategori = htmlspecialchars($edu["kategori"]);    
    $kontent = $edu["kontent"];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

   

    //query insert data
    $query = "INSERT INTO edu
                VALUES 
                ('','$tang','$jam','$judul','$kategori','$gambar','$kontent') 
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


function hapusartikel ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM artikel WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function hapusedu ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM edu WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function hapusdepo ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM deposit WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapuswith ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM withdraw WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapusvalidasi ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM validasi WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapususer ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM user WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapusbank ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM bank WHERE id = $id");

	return mysqli_affected_rows($conn);
}
function hapuspromosi ($id) {
	// ambil data dari tiap elemen form
	global $conn;
	
	mysqli_query($conn, "DELETE FROM promo WHERE id = $id");

	return mysqli_affected_rows($conn);
}
 ?>