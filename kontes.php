<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
require 'include/fungsi.php'; 
require 'include/header.php'; 
$kontes = query("SELECT * FROM kontes ORDER BY id DESC LIMIT 4");
$juhal = "postartikel";

if( isset($_POST["kontes"]) ) {
    $tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $periode = htmlspecialchars($_POST["periode"]);    
    $j1 = htmlspecialchars($_POST["j1"]);
    $r1 = htmlspecialchars($_POST["r1"]);
    $b1 = "xm";
    $e1 = htmlspecialchars($_POST["e1"]);
    $j2 = htmlspecialchars($_POST["j2"]);
    $r2 = htmlspecialchars($_POST["r2"]);
    $b2 = "xm";
    $e2 = htmlspecialchars($_POST["e2"]);
    $j3 = htmlspecialchars($_POST["j3"]);
    $r3 = htmlspecialchars($_POST["r3"]);
    $b3 = "xm";
    $e3 = htmlspecialchars($_POST["e3"]);

    //query insert data
    $query = "INSERT INTO kontes 
                VALUES 
                ('','$tang','$jam','$periode','$j1','$r1','$b1','$e1','$j2','$r2','$b2','$e2','$j3','$r3','$b3','$e3') 
            ";
    
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
        <script>
            alert('input kontes berhasil');
            document.location.href = 'kontes';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('input kontes gagal');
            document.location.href = 'kontes';
        </script>
        ";
    }
}



?>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <?php require 'include/topbar.php'; ?>
    
    <section>
        <?php require 'include/leftbar.php'; ?>
        <?php require 'include/rightbar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
            	<!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pemenang Kontes Rebate Mingguan Broker XM</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action=""  method="post">
                                <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Periode</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="periode" name="periode" class="form-control" placeholder="Periode Kontes" required="">
                                            </div>
                                        </div>
                                    </div>                      
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Juara 1</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="j1" name="j1" class="form-control" placeholder="No Akun" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Rebate</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="r1" name="r1" class="form-control" placeholder="Jumlah Rebate" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Email</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="e1" name="e1" class="form-control" placeholder="Email" required="">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Juara 2</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="j2" name="j2" class="form-control" placeholder="No Akun" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Rebate</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="r2" name="r2" class="form-control" placeholder="Jumlah Rebate" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Email</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="e2" name="e2" class="form-control" placeholder="Email" required="">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                      <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Juara 3</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="j3" name="j3" class="form-control" placeholder="No Akun" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Rebate</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="r3" name="r3" class="form-control" placeholder="Jumlah Rebate" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Email</label>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="e3" name="e3" class="form-control" placeholder="Email" required="">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="kontes" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
                <!-- Deposit -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pemenang Kontes Rebate</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table m-b-0">
                                <thead>
                                    <tr>
                                        <th>Juara</th>
                                        <th>Periode</th>
                                        <th>No Akun</th>
                                        <th>Rebate</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kontes as $row ) : ?> 

                                    <tr class="">
                                        <td scope="row">1</td>
                                        <td><?= $row["periode"] ?></td>
                                        <td><?= $row["j1"] ?></td>
                                        <td>$ <?= $row["r1"] ?></td>
                                        <td><?= $row["e1"] ?></td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">2</td>
                                        <td><?= $row["periode"] ?></td>
                                        <td><?= $row["j2"] ?></td>
                                        <td>$ <?= $row["r2"] ?></td>
                                        <td><?= $row["e2"] ?></td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">3</td>
                                        <td><?= $row["periode"] ?></td>
                                        <td><?= $row["j3"] ?></td>
                                        <td>$ <?= $row["r3"] ?></td>
                                        <td><?= $row["e3"] ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div><!-- #END# Deposit -->

                
            

                

            </div>
            
        </div>
    </section>

    <!-- For Material Design Colors -->
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Kurs Broker</h4>
                        </div>
                        <form class="form-horizontal" action=""  method="post">
                        <div class="modal-body">
                                <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Broker</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                                                            
                                            <select class="form-control show-tick" name="broker" id="broker" required="">
                                                <option value="">-- Please Broker --</option>
                                                <?php foreach ($rate as $row ) : ?>
                                                    <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                                    <option ><?= "<b>" . strtoupper($row["broker"]) . " </b>" ?></option>
                                                    <?php else: ?>
                                                    <option ><?= "<b>" . ucwords($row["broker"]) . " </b>" ?></option>
                                                    <?php endif; ?> 
                                                
                                                <?php endforeach; ?>    
                                            </select>
                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Deposit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="deposit" name="deposit" class="form-control" placeholder="Rate Deposit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Withdrawal</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" placeholder="Rate Withdrawal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect" name="updaterate">UPDATE KURS</button>
                           <!--  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php require 'include/scripts.php'; ?>