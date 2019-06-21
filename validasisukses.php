
<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];

// date_default_timezone_set('Asia/Jakarta'); 
// $date = new DateTime();
// $tgl = echo $date->format('d-m-Y : H:i');

$wp = query("SELECT * FROM validasi WHERE id = $idd") [0];


    $id = $wp["id"];
    $status = 2 ;



    //query edit data
    $query = "UPDATE validasi 
               SET status = '$status'                
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di edit
    if(  mysqli_affected_rows($conn) > 0 ) {
        // echo "          
        //     <script>
        //         alert('validasi sukses');
        //         document.location.href = '../validasi';
        //     </script>
        //     ";
         
            //ambil data dari tabel validasi
            $ceka = mysqli_query($conn,"SELECT * FROM validasi WHERE id = $idd");
            $data = mysqli_fetch_array($ceka);
            $cEmail = $data['email'];
            $cNama = ucwords($data['nama']);
            $no_akun = $data['no_akun'];
            $kode_member = $data['kode_member'];

            $caff = mysqli_query($conn,"SELECT * FROM member WHERE email_member = '".$data['email']."' ");
            $daff = mysqli_fetch_array($caff);
            //$aff = query("SELECT * FROM member WHERE email_member = $cEmail")[0];
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
                require '../classes/vsrti.php';
            }elseif ($affiliasi==="oeangkoe"){
                require '../classes/vsoeangkoe.php';
            }else{
                require '../classes/vs.php';
            }
            

            require_once('../classes/class.phpmailer.php');

     
            $to = $cEmail;
            $SubjectMsg = "Validasi Akun Berhasil";
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
                $mail->Username = "cs@warungbroker.com"; //user email
                $mail->Password = "wb2018"; //password email 
                $mail->SetFrom("cs@warungbroker.com", "WarungBroker.com"); //set email pengirim
                $mail->Subject = $SubjectMsg; //subyek email
                $mail->AddAddress($cEmail);  //tujuan email
                $mail->AddBCC("cs@warungbroker.com", "Notif WarungBroker");
                $mail->MsgHTML ($bodyMsg);
            }
              if($mail->Send())
              {
                        echo '
                    <script> alert("validasi sukses"); 
                            document.location.href = "../validasi";
                    </script>
                    ';

                
              }
              else
              {
                echo "Mail Error - >".$mail->ErrorInfo;
              } 

    } else {
        echo "
            <script>
                alert('validasi gagal');
                document.location.href = '../validasi';
            </script>
            ";
    }
  

?>
