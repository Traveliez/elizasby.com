<?php

session_start();
if (!isset($_SESSION["username"])) {
    header("location: index");
    exit;
}

require 'vendor/autoload.php';
require 'include/fungsi.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);

    // menentukan nama broker
    $nama_broker = $_POST['broker'];
    
    if ($extension == 'csv') {
        $reader = IOFactory::createReader('Csv');
    }

    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
    // $spreadsheet->getActiveSheet()->setTitle($_FILES['file']['tmp_name']);
    $arrData = $spreadsheet->getActiveSheet()->toArray();
    foreach ($arrData as $index => $data) {
        if ($index == 0) {
            continue;
        }
        $bank = query("SELECT bank, norek FROM withdraw WHERE email = '$data[2]'");
        
        $email_rebate = query("SELECT email FROM rebate WHERE email = '$data[2]'");
        $email_saku = query("SELECT email FROM saku WHERE email = '$data[2]'");


        if($email_rebate[0]['email'] == $email_saku[0]['email']){
            if($data[5] < 10000){
                $saldo_awal = query("SELECT saldo FROM saku WHERE email = '$data[2]'")[0];
                $saldo = $saldo_awal['saldo'] + $data[5];
                mysqli_query($conn, "UPDATE saku SET saldo = $saldo WHERE email = '$data[2]'");
            } else {
                mysqli_query($conn, "UPDATE rebate SET status = 'sukses' WHERE email = '$data[2]'");
            }
        } else {
            echo "
                <script>
                    alert('$data[2] tidak ditemukan');
                    document.location.href = 'tampilan-fbs.php';
                </script>
                ";
        }
        
        if (isset($bank[0])) {
            $tanggal = date('Y-m-d H:i:s');
            $xx = "'" . implode("','", $data) . "'";
            $sql = "INSERT INTO data_fbs (tanggal, timer, periode, no_akun, email, auto_rebate, rebate_dollar, rebate_rupiah, lot, bank, norek, nama_broker) VALUES ('$tanggal', '$tanggal', $xx, '" . $bank[0]['bank'] . "', '" . $bank[0]['norek'] . "', '". $nama_broker ."')";
            $insert = mysqli_query($conn, $sql);

            //fitur auto rebate
            if ($data[3] > 0.0) {
                mysqli_query($conn, "UPDATE data_fbs SET status = 4 WHERE email = '$data[2]' AND timer = '$tanggal' AND no_akun = '$data[1]'");
            }

            if ($insert === TRUE) {
                header('Location: tampilan-fbs.php');
            } else {
                echo "
                <script>
                    alert('upload gagal');
                    document.location.href = 'tampilan-fbs.php';
                </script>
                ";
            }
        } else {
            echo "
                <script>
                    alert('upload gagal ". $data[2] ." tidak ada');
                    document.location.href = 'tampilan-fbs.php';
                </script>
                ";
        }
    }
}