<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
                            $id = $_GET["id"];
                            
                            if($_POST['upload']){
                			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
                			$nama = $_FILES['file']['name'];
                			$x = explode('.', $nama);
                			$ekstensi = strtolower(end($x));
                			$ukuran	= $_FILES['file']['size'];
                			$file_tmp = $_FILES['file']['tmp_name'];	
                			
                			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                				if($ukuran  < 10044070){			
                					move_uploaded_file($file_tmp, 'bukti_transfer/'.$nama);
                					$query = "UPDATE data_instaforex SET bukti_transaksi='$nama' where id='$id'";
                					mysqli_query($conn, $query);
                				}
                			}
                
                			header("location: tampilan-instaforex");
							}
							
							
							if($_POST['edit']){
                			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
                			$nama = $_FILES['file']['name'];
                			$x = explode('.', $nama);
                			$ekstensi = strtolower(end($x));
                			$ukuran	= $_FILES['file']['size'];
                			$file_tmp = $_FILES['file']['tmp_name'];
                			
                			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                				if($ukuran  < 10044070){			
                					move_uploaded_file($file_tmp, 'bukti_transfer/'.$nama);
                					$query = "UPDATE data_instaforex SET bukti_transaksi='$nama' where id='$id'";
                					mysqli_query($conn, $query);
                				}
                			}
                
                			header("location: tampilan-instaforex");
                		}
						
						
                		
    
?>