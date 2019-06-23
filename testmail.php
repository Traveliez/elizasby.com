<?php 
require 'classes/reg.php';
include "classes/class.phpmailer.php";
//$to = $cEmail;
    $cEmail = "sgendenk@gmail.com";
    $SubjectMsg = "Registrasi WarungBroker";
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
        $mail->Password = "br0k3r"; //password email 
        $mail->SetFrom("cs@warungbroker.com", "warungbroker.com"); //set email pengirim
        $mail->Subject = $SubjectMsg; //subyek email
        $mail->AddAddress($cEmail);  //tujuan email
        $mail->AddBCC("cs@warungbroker.com", "warungbroker.com");
        $mail->MsgHTML ($bodyMsg);

      if($mail->Send()) {
        echo"
            <script> alert ('Register Berhasil! Silahkan Login') ;
             document.location.href = 'index.php';
            </script>
            ";                    
      }
      else
      {
        echo "Mail Error - >".$mail->ErrorInfo;
      } 

?>