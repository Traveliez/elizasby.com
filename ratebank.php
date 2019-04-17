<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
require 'include/fungsi.php'; 
require 'include/header.php'; 
$rate = query("SELECT * FROM rate ORDER BY id ASC");
$juhal = "ratebank";

if( isset($_POST["isirate"]) ) {
    $tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $broker = htmlspecialchars(strtolower($_POST["broker"]));    
    $deposit = htmlspecialchars($_POST["deposit"]);
    $withdrawal = htmlspecialchars($_POST["withdrawal"]);
    $status = htmlspecialchars($_POST["depowd"]);

    //query insert data
    $query = "INSERT INTO rate 
                VALUES 
                ('','$tang','$jam','$broker','$deposit','$withdrawal','$status') 
            ";
    
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
        <script>
            alert('Isi Data Rate berhasil');
            document.location.href = 'ratebank';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Isi Data Rate gagal');
            document.location.href = 'ratebank';
        </script>
        ";
    }
}

if( isset($_POST["updaterate"]) ) {
    $tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $broker = htmlspecialchars($_POST["broker"]);
    $b = query("SELECT * FROM rate WHERE broker = '$broker' ")[0];
    $id = $b['id'];
    $deposit = htmlspecialchars($_POST["deposit"]);
    $withdrawal = htmlspecialchars($_POST["withdrawal"]);
    
    //query update rebate
    $query = "UPDATE rate SET
                tang = '$tang',
                jam = '$jam',
                deposit = '$deposit',                
                withdrawal = '$withdrawal'
                
                WHERE id = $id
            ";
    
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
        <script>
            alert('Update Rate berhasil');
            document.location.href = 'ratebank';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('update Rate gagal');
            document.location.href = 'ratebank';
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
                <!-- Deposit -->
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="card">
                        <div class="header">
                            <h2>Update Kurs Brokers</h2>
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
                                        <th>#</th>
                                        <th>Broker</th>
                                        <th>Deposit</th>
                                        <th>Withdrawal</th>
                                        <th>Metode</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rate as $row ) : ?> 

                                    <tr class="">
                                        <th scope="row"><?= $i  ?></th>

                                        <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                        <td><?= "<b>" . strtoupper($row["broker"]) . " </b>" ?></td>
                                        <?php else: ?>
                                        <td><?= "<b>" . ucwords($row["broker"]) . " </b>" ?></td>
                                        <?php endif; ?>

                                        <td>Rp <?= $row["deposit"] ?></td>
                                        <td>Rp <?= $row["withdrawal"] ?></td>

                                        <?php if ($row["status"]==="1") : ?>
                                        <td> Lokal </td>
                                        <?php else: ?>
                                        <td> Broker </td>
                                        <?php endif; ?>

                                        <td>
                                            <button type="button" data-color="blue" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#mdModal<?= $row["id"] ?>"><i class="material-icons">build</i></button>
                                            <!-- <a href="updaterate.php?id=<?= $ratefw["id"] ?>" >
                                                <span class="badge bg-cyan"><i class="material-icons">build</i></span> 
                                            </a> -->
                                        </td>

                                        <!-- For Material Design Colors -->
                                        <div class="modal fade" id="mdModal<?= $row["id"] ?>" tabindex="-1" role="dialog">
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
                                                                        <div class="form-line">
                                                                            <input type="text" id="broker" name="broker" class="form-control" value="<?= $row["broker"] ?>" readonly >
                                                                        </div>                                
                                                                        
                                                            
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
                                                                            <input type="text" id="deposit" name="deposit" class="form-control" value="<?= $row["deposit"] ?>">
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
                                                                            <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="<?= $row["withdrawal"] ?>">
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

                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div><!-- #END# Deposit -->

                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="header">
                            <h2>Isi Kurs Broker</h2>
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
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Broker</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="broker" name="broker" class="form-control" placeholder="Nama Broker" required="">
                                            </div>
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
                                                <input type="text" id="deposit" name="deposit" class="form-control" placeholder="Rate Deposit" required="">
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
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" placeholder="Rate Withdrawal" required="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Depo WD</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="depowd" id="depowd" required="">
                                                <option value="1">Lokal</option>
                                                <option value="2">Broker</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="isirate" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
            

                

            </div>
            
        </div>
    </section>

            
    <?php require 'include/scripts.php'; ?>