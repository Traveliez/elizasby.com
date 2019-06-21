<?php 
session_start();
    if (!isset($_SESSION["email"])) {
        require 'include/fungsi.php';
    }else{
        
        require 'include/fungsi.php';
        $user = query("SELECT * FROM member WHERE email_member = '".$_SESSION['email']."'") [0];
        $email = $user["email_member"];
        $username = $user["username_member"];
        $kodemember = $user["kode_member"];
        $profile = query("SELECT * FROM profile WHERE kode_member = '$kodemember'") [0];
        $sk = query("SELECT * FROM saku WHERE kode_member='$kodemember' AND email = '$email' ORDER BY id DESC LIMIT 1")[0];
        $saku = $sk['saldo'];
        $kodesaku = $sk['kodesaku'];
    }
    
    $juhal = "layanan";
$rate = query("SELECT * FROM rate WHERE broker!='fxpro'");

//cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["withdrawal"]) ) {
    $tangg = ($_POST["tang"]);
    $tanggal = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    if (!isset($_SESSION["email"])) {
        $email = strtolower(htmlspecialchars($_POST["email"]));
        $cekemail = mysqli_query($conn, "SELECT * FROM member WHERE email_member = '$email' ");
        if( mysqli_num_rows($cekemail) != 1 ) {
            echo "<script>
                        alert('Email Belum Terdaftar');
                        document.location.href = 'deposit';
                    </script>";
                return false;
        }
        $km = query("SELECT * FROM member WHERE email_member = '$email'") [0];
        $kodemember = $km["kode_member"];
    }else{
        $email = $user["email_member"];
        $kodemember = $user["kode_member"];
    }
    
    $broker = strtolower(stripcslashes($_POST["broker"]));
    $no_akun = htmlspecialchars($_POST["noakun"]);
    $withdrawal = htmlspecialchars($_POST["jumlahwithdrawal"]);
    $bank = strtolower(stripcslashes($_POST["bank"]));
    $norek = stripcslashes($_POST["norek"]);
    $namarek = stripcslashes($_POST["namarek"]);
    

    $cekemail = mysqli_query($conn, "SELECT * FROM member WHERE email_member = '$email' ");

        
    //cek password
    if( mysqli_num_rows($cekemail) === 1 ) {
        $cekakun = mysqli_query($conn, "SELECT * FROM validasi WHERE no_akun = '$no_akun' AND email = '$email' AND status = 2 ");
        
        if (mysqli_num_rows($cekakun) === 1) {
            $row = mysqli_fetch_assoc($cekakun);
            if ($broker === "pilih broker") {
                echo "<script>
                        alert('Broker Belum Di Pilih');
                        document.location.href = 'withdrawal';
                    </script>";
                return false;
            }elseif (($row["broker"] === $broker)) {
                if ($bank === "pilih bank") {
                    echo "<script>
                            alert('Bank Tujuan Belum Di Pilih');
                            document.location.href = 'withdrawal';
                        </script>";
                    return false;
                }
            }else{
                echo "<script>
                    alert('Broker tidak sesuai dengan No Akun Anda');
                    document.location.href = 'withdrawal';
                </script>";
                return false;
            }
        }else{
            echo "<script>
                    alert('No Akun Belum Terdaftar atau silahkan validasi akun dulu');
                    document.location.href = 'withdrawal';
                </script>";
            return false;
        }
       
     }else{
        echo "<script>
                    alert('Email belum terdaftar');
                    document.location.href = 'withdrawal';
                </script>";
             return false;
     }

    $ratedepo = query("SELECT * FROM rate WHERE broker = '$broker' ")[0];
    $dollar = $ratedepo['withdrawal'];
    
    $total = (int)$withdrawal*$dollar;
    $status = 1;
    $wdr = 0;

    

    //query insert data
    $query = "INSERT INTO withdraw
                VALUES 
                ('','$tanggal','$jam','$kodemember','$email','$broker','$no_akun','$withdrawal','$bank','$norek','$namarek','$total','$status','$wdr') 
            ";

    mysqli_query($conn, $query);

    if( mysqli_affected_rows($conn) > 0 ) {
    //     $cekDps = mysqli_query($conn,"SELECT * FROM withdraw WHERE no_akun = '".$no_akun."' AND total = '".$total."'");
    //     $dataDps = mysqli_fetch_array($cekDps);
    //     $id = $dataDps['id'];
        
    // echo '
    //     <script>   
    //         alert("Withdrawal Berhasil");             
    //         document.location.href ="invoice.php?wd='.$dataDps["id"].'";           
    //     </script>
    //     ';
        //ambil data dari tabel validasi
            $ceka = mysqli_query($conn,"SELECT * FROM withdraw WHERE no_akun = $no_akun AND total = $total");
            $data = mysqli_fetch_array($ceka);
            $cEmail = $data['email'];
            $cNama = ucwords($data['nama']);
            $no_akun = $data['no_akun'];
            $bank = $data['bank'];
            $bukti = $data['bukti_transfer'];
            $norek = $data['norek'];
            $namarek = $data['namarek'];
            $withdrawal = number_format($data['withdrawal'],2);
            $total = number_format($data['total']);

            if ($data["broker"]==="xm" OR $data["broker"]==="fbs") {
                $broker = strtoupper($data['broker']);
            }else{
                $broker = ucwords($data['broker']);
            }

            if($bank == 'mandiri'){
                $bank = ucwords($data['bank']);
            }else{
                $bank = strtoupper($data['bank']);
            }
            
            $ceku = mysqli_query($conn,"SELECT * FROM member WHERE email_member = '".$cEmail."'");
            $user = mysqli_fetch_array($ceku);
            $cUser = $user['username_member'];

            require 'classes/wd.php';

            require_once('classes/class.phpmailer.php');

     
            $to = $cEmail;
            $SubjectMsg = "Withdrawal Akun Trading";
            $bodyMsg = $message;
  
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "mail.warungbroker.com"; //host masing2 provider email
                //$mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = "cs@warungbroker.com"; //user email
                $mail->Password = "elizasby2018"; //password email 
                $mail->SetFrom("cs@warungbroker.com", "WarungBroker"); //set email pengirim
                $mail->Subject = $SubjectMsg; //subyek email
                $mail->AddAddress($cEmail);  //tujuan email
                $mail->AddBCC("cs@warungbroker.com", "WarungBroker");
                $mail->MsgHTML ($bodyMsg);
    
              if($mail->Send())
              {
                echo '
                    <script> 
                        alert("withdrawal berhasil");             
                        document.location.href ="invoice.php?wd='.$data["id"].'";
                    </script>
                    ';

                
              }
              else
              {
                echo "Mail Error - >".$mail->ErrorInfo;
              }

        
    } else {
        echo '
            <script> 
                alert("Withdrawal Gagal");
                document.location.href ="invoice.php?wd='.$data["id"].'";                
            </script>
            ';
    }
    
    
}

//cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["withdrawalsaku"]) ) {
    $tangg = ($_POST["tang"]);
    $tanggal = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    
    $email = $user["email_member"];
    $kodemember = $user["kode_member"];
    
    
    $broker = "saku";
    $no_akun = $kodesaku;
    $withdrawal = htmlspecialchars($_POST["jumlahwithdrawals"]);
    $bank = strtolower(stripcslashes($_POST["bank"]));
    $norek = stripcslashes($_POST["norek"]);
    $namarek = stripcslashes($_POST["namarek"]);

    if($withdrawal < 10000){
      echo '<script>
                alert("Minimal Jumlah Withdrawal Saku ke Bank Rp. 10,000");
                document.location.href ="withdrawal.php?saku='.$sk["kodesaku"].'";                
            </script>';
        return false;
        }
    if($withdrawal > $saku){
      echo '<script>
                alert("Dana Saku Anda Tidak Mencukupi");
                document.location.href ="withdrawal.php?saku='.$sk["kodesaku"].'";                
            </script>';
        return false;
        }

    $ratedepo = query("SELECT * FROM rate WHERE broker = 'firewoodfx' ")[0];
    $dollar = $ratedepo['withdrawal'];
    
    $total = (int)$withdrawal/$dollar;
    $status = 3;
    $wdr = 0;

    

    //query insert data
    $query = "INSERT INTO withdraw
                VALUES 
                ('','$tanggal','$jam','$kodemember','$email','$broker','$no_akun','$total','$bank','$norek','$namarek','$withdrawal','$status','$wdr') 
            ";

    mysqli_query($conn, $query);

    $saldosaku =(int) $saku - $withdrawal;
    //query insert data
    $querys = "INSERT INTO saku
    VALUES 
    ('','$kodemember','$email','$kodesaku','$tanggal','$jam','withdrawal','0','$withdrawal','$saldosaku') 
    ";
    mysqli_query($conn, $querys);

    if( mysqli_affected_rows($conn) > 0 ) {
        $cekDps = mysqli_query($conn,"SELECT * FROM withdraw WHERE no_akun = '".$kodesaku."' AND total = '".$withdrawal."'");
        $dataDps = mysqli_fetch_array($cekDps);
        $id = $dataDps['id'];
        
    echo '
        <script>   
            alert("Withdrawal Berhasil");             
            document.location.href ="invoice.php?wdsaku='.$dataDps["id"].'";           
        </script>
        ';

        
    } else {
        echo '
            <script> 
                alert("Withdrawal Gagal");
                document.location.href ="withdrawal.php?saku='.$sk["kodesaku"].'";                
            </script>
            ';
    }
    
    
}
    
?>
<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php'; ?>

<body class="animsition">
    <div class="page-wrapper">
        
        <?php require 'include/headermobile.php'; ?>

        <?php require 'include/sidebar.php'; ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <?php require 'include/headerdesktop.php'; ?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Daftar Broker</h2>
                                    
                                </div>
                            </div>
                        </div> -->
                        <script type="text/javascript">
               
                            $(document).ready(function(){
                                $('#broker').change(function() { // Jika Select Box id provinsi dipilih
                                    var broker = $(this).val(); // Ciptakan variabel provinsi
                                    var kodemember = $("[name='kodemember']").val();
                                    $.ajax({
                                        type: 'POST', // Metode pengiriman data menggunakan POST
                                        url: 'addjs/addnoakun.php', // File yang akan memproses data
                                        data: 'broker=' + broker + '&kodemember=' + kodemember, // Data yang akan dikirim ke file pemroses
                                        success: function(response) { // Jika berhasil
                                            $('#noakun').html(response); // Berikan hasil ke id kota
                                        }
                                    });
                                });
                                
                            });

                            $(document).ready(function(){
                                $('#bank').change(function() { // Jika Select Box id dipilih
                                    var bank = $(this).val(); // Ciptakan variabel 
                                    var kodemember = $("[name='kodemember']").val(); // Ciptakan variabel 
                                    $.ajax({
                                        type: 'POST', // Metode pengiriman data menggunakan POST
                                        url: 'addjs/addnorek.php', // File yang akan memproses data
                                        data: 'bank=' + bank + '&kodemember=' + kodemember, // Data yang akan dikirim ke file pemroses
                                        success: function(response) { // Jika berhasil
                                            $('#norek').html(response); // Berikan hasil ke id 
                                        }
                                    });
                                });
                                
                            });

                            $(document).ready(function(){
                                $('#norek').change(function() { // Jika Select Box id provinsi dipilih
                                    var norek = $(this).val(); // Ciptakan variabel provinsi
                                    $.ajax({
                                        type: 'POST', // Metode pengiriman data menggunakan POST
                                        url: 'addjs/addnamabank.php', // File yang akan memproses data
                                        data: 'norek=' + norek, // Data yang akan dikirim ke file pemroses
                                        success: function(response) { // Jika berhasil
                                            $('#namarek').html(response); // Berikan hasil ke id kota
                                        }
                                    });
                                });
                                
                            });

                        </script>
                        <div class="row ">
                            <?php if (isset($_GET["id"])) : ?>
                            <?php 
                                $idepo =  $_GET["id"];
                                $cekDps = mysqli_query($conn,"SELECT * FROM validasi WHERE id  = '$idepo'");
                                $wd = mysqli_fetch_array($cekDps);
                                $broker = $wd['broker'];
                                $noakun = $wd['no_akun'];
                            ?>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Withdrawal</strong> Akun Trading
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('Y-m-d'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('H:i:s'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="kodemember" name="kodemember" class="form-control" placeholder="" 
                                            value="<?= $kodemember; ?>" 
                                            readonly="">
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Broker</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="broker" name="broker" value="<?= ucwords($broker) ?>" class="form-control" required="" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Akun</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="noakun" id="noakun" value="<?= $noakun ?>" class="form-control" required="" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Jumlah Withdrawal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="jumlahwithdrawal" name="jumlahwithdrawal" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                    <small class="form-text text-muted">Isikan angka saja (USD)</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bank</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="bank" id="bank" class="form-control">
                                                        <option >Pilih Bank</option>
                                                        <option value="bca">BCA</option>
                                                        <option value="bni">BNI</option>
                                                        <option value="bri">BRI</option>
                                                        <option value="mandiri">MANDIRI</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="norek" id="norek" class="form-control">
                                                        <option ></option>
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Nama Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="namarek" id="namarek" class="form-control">
                                                        
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" name="withdrawal">
                                                    <i class="fa fa-dot-circle-o"></i> Withdrawal
                                                </button>
                                                <!-- <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button> -->
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <?php elseif (isset($_GET["saku"])) : ?>
                            
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Withdrawal</strong> Saku
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('Y-m-d'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('H:i:s'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="kodemember" name="kodemember" class="form-control" placeholder="" 
                                            value="<?= $kodemember; ?>" 
                                            readonly="">
                                            <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="select" class=" form-control-label">Saku Rp.</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" placeholder="" class="form-control" required="" value="<?= number_format($saku)  ?>" readonly="">
                                                        <small class="form-text text-muted">Balance Saku Anda</small>
                                                    </div>
                                                </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Jumlah Withdrawal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="jumlahwithdrawal" name="jumlahwithdrawals" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                    <small class="form-text text-muted">Isikan angka saja (Rupiah)</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bank</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="bank" id="bank" class="form-control" required="">
                                                        <option value="">Pilih Bank</option>
                                                        <option value="bca">BCA</option>
                                                        <option value="bni">BNI</option>
                                                        <option value="bri">BRI</option>
                                                        <option value="mandiri">MANDIRI</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="norek" id="norek" class="form-control" required="">
                                                        <option ></option>
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Nama Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="namarek" id="namarek" class="form-control" required="" >
                                                        
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" name="withdrawalsaku">
                                                    <i class="fa fa-dot-circle-o"></i> Withdrawal Saku
                                                </button>
                                                <!-- <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button> -->
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <?php elseif (isset($_SESSION['email'])) : ?>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Withdrawal</strong> Akun Trading
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('Y-m-d'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('H:i:s'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="kodemember" name="kodemember" class="form-control" placeholder="" 
                                            value="<?= $kodemember; ?>" 
                                            readonly="">
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Broker</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="broker" id="broker" class="form-control">
                                                        <option >Pilih Broker</option>
                                                        <option value="firewoodfx">FirewoodFX</option>
                                                        <option value="insta forex">Insta Forex</option>
                                                        <option value="tickmill">Tickmill</option>
                                                        <option value="xm">XM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Akun</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="noakun" id="noakun" class="form-control">
                                                        <option ></option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Jumlah Withdrawal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="jumlahwithdrawal" name="jumlahwithdrawal" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                    <small class="form-text text-muted">Isikan angka saja (USD)</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bank</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="bank" id="bank" class="form-control">
                                                        <option >Pilih Bank</option>
                                                        <option value="bca">BCA</option>
                                                        <option value="bni">BNI</option>
                                                        <option value="bri">BRI</option>
                                                        <option value="mandiri">MANDIRI</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="norek" id="norek" class="form-control">
                                                        <option ></option>
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Nama Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="namarek" id="namarek" class="form-control">
                                                        
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" name="withdrawal">
                                                    <i class="fa fa-dot-circle-o"></i> Withdrawal
                                                </button>
                                                <!-- <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button> -->
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <?php else  : ?>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Withdrawal</strong> Akun Trading
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('Y-m-d'); ?>" 
                                            readonly="">
                                            <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" 
                                            value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                    echo $date->format('H:i:s'); ?>" 
                                            readonly="">
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email" name="email" placeholder="" class="form-control" required="">
                                                    <small class="form-text text-muted">Masukkan email yang sudah terdaftar</small>
                                                </div>
                                            </div>
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Broker</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="broker" id="broker" class="form-control">
                                                        <option >Pilih Broker</option>
                                                        <option value="firewoodfx">FirewoodFX</option>
                                                        <option value="insta forex">Insta Forex</option>
                                                        <option value="tickmill">Tickmill</option>
                                                        <option value="xm">XM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Akun</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="noakun" name="noakun" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                    <small class="form-text text-muted">Masukkan no akun yang sudah di validasi</small>
                                                </div>

                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Jumlah Withdrawal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="jumlahwithdrawal" name="jumlahwithdrawal" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                    <small class="form-text text-muted">Isikan angka saja (USD)</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Bank</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="bank" id="bank" class="form-control">
                                                        <option >Pilih Bank</option>
                                                        <option value="bca">BCA</option>
                                                        <option value="bni">BNI</option>
                                                        <option value="bri">BRI</option>
                                                        <option value="mandiri">MANDIRI</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">No Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="norek" name="norek" placeholder="" class="form-control" required="" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Nama Rekening</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="namarek" name="namarek" placeholder="" class="form-control" required="">
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" name="withdrawal">
                                                    <i class="fa fa-dot-circle-o"></i> Withdrawal
                                                </button>
                                                <!-- <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button> -->
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <?php endif ; ?>
                            <div class="col-lg-6">
                                <div class="overview-wrap">
                                    <h4 class="title-1">Kurs Dollar $1</h4>
                                    
                                </div>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-data3">
                                        <thead>

                                            <tr>
                                                <th>Broker</th>
                                                <th class="text-right">Deposit</th>
                                                <th class="text-right">Withdrawal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($rate as $row ) : ?> 

                                            <tr>
                                                <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                                <td><?= "<b>" . strtoupper($row["broker"]) . " </b>" ?></td>
                                                <?php else: ?>
                                                <td><?= "<b>" . ucwords($row["broker"]) . " </b>" ?></td>
                                                <?php endif; ?>
                                                <td class="text-right">Rp. <?= "<b>" . number_format($row["deposit"]) . " </b>" ?></td>
                                                <td class="text-right">Rp. <?= "<b>" . number_format($row["withdrawal"]) . " </b>" ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
               
                                <div class="card">
                                    <div class="card-header bg-secondary">
                                        <strong class="card-title text-light">Bank Transfer Warung Broker</strong>
                                    </div>
                                    <div class="card-body text-white bg-primary">
                                        <table >
                                            <tr class="" style="color: white;">
                                                <td>
                                                    <img class="" src="images/bca.png" style="width: 75px;">
                                                </td>
                                                <td>
                                                    <p class=""> 088.608.8986</p>
                                                </td>
                                                <td>
                                                    <h4><span class="badge badge-secondary">Margareth Lindsay Y.</span></h4>
                                                </td>
                                            </tr>
                                            <tr class="" style="color: white;">
                                                <td>
                                                    <img class="m-b-5 m-r-15" src="images/bni.png" style="width: 75px;">
                                                </td>
                                                <td>
                                                    <p class="m-r-15">063.021.5090</p>
                                                </td>
                                                <td>
                                                    <h4><span class="badge badge-secondary">Margareth Lindsay Y.</span></h4>
                                                </td>
                                            </tr>
                                            
                                            <tr class="" style="color: white;">
                                                <td>
                                                    <img class="m-b-5 m-r-15" src="images/mandiri.png" style="width: 75px;">
                                                </td>
                                                <td>
                                                    <p class="m-r-15">142.000.247.7999</p>
                                                </td>
                                                <td>
                                                    <h4><span class="badge badge-secondary">Margareth Lindsay Y.</span></h4>
                                                </td>
                                            </tr>
                                            <tr class="" style="color: white;">
                                                <td>
                                                    <img class="m-b-5 m-r-15" src="images/bri.png" style="width: 75px;">
                                                </td>
                                                <td>
                                                    <p class="m-r-15">0412.0100.1323.565</p>
                                                </td>
                                                <td>
                                                    <h4><span class="badge badge-secondary">Melissa Vincentia J.</span></h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div>
                
            </div><!-- END MAIN CONTENT-->
            
                <?php require 'include/footer.php'; ?>
        
        </div><!-- END PAGE CONTAINER-->

    </div>

    <?php require 'include/script.php'; ?>

</body>

</html>
<!-- end document-->
