<?php 

require '../include/fungsi.php';

$idd = $_GET["id"];

$wp = query("SELECT * FROM validasi WHERE id = $idd") [0];

    $br = $wp['broker'];
    $id = $wp["id"];
    $status = 3 ;

    

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
        //         alert('validasi di gagalkan');
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

            $affiliasi = $data['aff'];

            if ($data["broker"]==="xm" OR $data["broker"]==="fbs") {
                $broker = strtoupper($data['broker']);
            }else{
                $broker = ucwords($data['broker']);
            }
            
            $ceku = mysqli_query($conn,"SELECT * FROM member WHERE email_member = '".$cEmail."'");
            $user = mysqli_fetch_array($ceku);
            $cUser = $user['username_member'];

            if ($data['broker'] === "firewoodfx") {
                $brok = "<a target='_blank' href='https://secure.firewoodfx.com/client/register?ib=1680012112' class='link2'>Buka Akun ".$broker."</a>";
            }elseif ($data['broker'] === "insta forex") {
                 $brok = "<a target='_blank' href='https://secure.ifxid.com/open-account?lang=id&x=elizafx' class='link2'>Buka Akun ".$broker."</a>";
            }elseif ($data['broker'] === "tickmill") {
                 $brok = "<a target='_blank' href='https://secure.tickmill.com/trader/?task=1050&lang=5' class='link2'>Buka Akun ".$broker."</a>";
            }elseif ($data['broker'] === "fbs") {
                 $brok = "<a target='_blank' href='https://my.fbs.trade/registration/real/?ppk=warungbroker' class='link2'>Buka Akun ".$broker."</a>";
            }elseif ($data['broker'] === "xm") {
                 $brok = "<a target='_blank' href='https://www.xm-indonesia.com/register/account/real?lang=id' class='link2'>Buka Akun ".$broker."</a>";
            }else {
                 $brok = "<a target='_blank' href='https://www.binary.com/en/home.html?s=0&t=3J6NsaCqqfOygU2w4MC-pWNd7ZgqdRLk&utm_source=affiliate_115270&utm_medium=affiliate&utm_campaign=acquisition&account_tabs=binary_options&market_tabs=binary' class='link2'>Buka Akun ".$broker."</a>";
            }

            if ($affiliasi==="rti") {
                require '../classes/vgrti.php';
            }elseif ($affiliasi==="oeangkoe"){
                require '../classes/vgoeangkoe.php';
            }else{
                require '../classes/vg.php';
            }

            require_once('../classes/class.phpmailer.php');

     
            $to = $cEmail;
            $SubjectMsg = "Validasi Akun Gagal";
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
                    <script> alert("Notifikasi Validasi Gagal Berhasil Dikirim"); 
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
