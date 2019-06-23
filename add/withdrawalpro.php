<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];




$wp = query("SELECT * FROM withdraw WHERE id = $idd") [0];
$no_akun = $wp["no_akun"];
$broker = $wp["broker"];
$withdrawal = number_format($wp["withdrawal"],2);
$total = number_format($wp["total"]);
$bank = $wp["bank"];
$norek = $wp["norek"];
$namarek = $wp["namarek"];
$email = $wp["email"];
$cEmail = $wp["email"];

$u = query("SELECT * FROM member WHERE email_member = '$cEmail'") [0];
$kodemember = $u["kode_member"];

$ratedepo = query("SELECT * FROM rate WHERE broker = '$broker' ")[0];
    $dollar = $ratedepo['withdrawal'];



    $id = $wp["id"];
    $status = 2 ;

// if ($broker != 'dompet') {
//     $asaldana = 'Broker';
// }else {
//     $asaldana = 'Sumber Dana';
// }
    

    //query edit data
    $query = "UPDATE withdraw 
               SET status = '$status'                
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di edit
    if(  mysqli_affected_rows($conn) > 0 ) {
        // echo "          
        //     <script>
        //         alert('withdrawal sukses');
        //         document.location.href = '../withdrawal';
        //     </script>
        //     ";
            //ambil data dari tabel validasi
            $ceka = mysqli_query($conn,"SELECT * FROM withdraw WHERE id = $idd");
            $data = mysqli_fetch_array($ceka);
            $cEmail = $data['email'];
            //$cNama = ucwords($data['nama']);
            $no_akun = $data['no_akun'];
            $withdrawal = number_format($data['withdrawal'],2);
            $bank = strtoupper($data['bank']);
            $norek = $data['norek'];
            $namarek = $data['namarek'];
            $total = $data['total'];
            
            $bukti_transfer = query("SELECT bukti_transfer FROM bukti_transfer WHERE id = $data[id]")[0]['bukti_transfer'];

            $caff = mysqli_query($conn,"SELECT * FROM member WHERE email_member = '".$data['email']."' ");
            $daff = mysqli_fetch_array($caff);            
            $affiliasi = $daff['aff'];

            if ($data["broker"]==="xm" OR $data["broker"]==="fbs") {
                $broker = strtoupper($data['broker']);
            }else{
                $broker = ucwords($data['broker']);
            }

            
            $ceku = mysqli_query($conn,"SELECT * FROM member WHERE email_member = '".$cEmail."'");
            $user = mysqli_fetch_array($ceku);
            $cUser = $user['username_member'];

            if ($affiliasi==="rti") {
                require '../classes/wprti.php';
            }elseif ($affiliasi==="oeangkoe"){
                require '../classes/wpoeangkoe.php';
            }else{
                require '../classes/wp.php';
            }

            require_once('../classes/class.phpmailer.php');

     
            $to = $cEmail;
            $SubjectMsg = "Withdrawal Akun Berhasil";
            $bodyMsg = $message;
  
            if ($affiliasi==="rti") {
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "srv47.niagahoster.com"; //host masing2 provider email
                //$mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = "cs@warungbrokerrti.com"; //user email
                $mail->Password = "wbr2018"; //password email 
                $mail->SetFrom("cs@warungbrokerrti.com", "WarungBrokerRTI.com"); //set email pengirim
                $mail->Subject = $SubjectMsg; //subyek email
                $mail->AddAddress($cEmail);  //tujuan email
                $mail->AddBCC("cs@warungbrokerrti.com", "Notif WarungBrokerRTI");
                $mail->MsgHTML ($bodyMsg);
            }elseif ($affiliasi==="oeangkoe") {
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "srv47.niagahoster.com"; //host masing2 provider email
                //$mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = "cs@oeangkoe.com"; //user email
                $mail->Password = "ok2019"; //password email 
                $mail->SetFrom("cs@oeangkoe.com", "Oeangkoe.com"); //set email pengirim
                $mail->Subject = $SubjectMsg; //subyek email
                $mail->AddAddress($cEmail);  //tujuan email
                $mail->AddBCC("cs@oeangkoe.com", "Oeangkoe.com");
                $mail->MsgHTML ($bodyMsg);
            }else{
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "srv47.niagahoster.com"; //host masing2 provider email
                //$mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->AddEmbeddedImage('../bukti_transfer/'.$bukti_transfer, 'buktiTF');
                $mail->Username = "cs@warungbroker.com"; //user email
                $mail->Password = "br0k3r"; //password email 
                $mail->SetFrom("cs@warungbroker.com", "WarungBroker.com"); //set email pengirim
                $mail->Subject = $SubjectMsg; //subyek email
                $mail->AddAddress($cEmail);  //tujuan email
                $mail->AddBCC("cs@warungbroker.com", "Notif WarungBroker");
                $mail->MsgHTML ($bodyMsg);
            }
    
              if($mail->Send())
              {
            header("location: ../withdrawal.php");
            }
              else
              {
                echo "Mail Error - >".$mail->ErrorInfo;
              }


    } else {
        echo "
            <script>
                alert('withdrawal gagal');
                document.location.href = '../withdrawal';
            </script>
            ";
    }
  

?>
