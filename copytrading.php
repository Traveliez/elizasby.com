<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';

    $tampil = query("SELECT * FROM copytrading ORDER BY no DESC");
    $juhal = "postartikel";
    
if( isset($_POST["tambahdata"]) ) {
    $broker = htmlspecialchars(strtolower($_POST["broker"]));    
    $username = htmlspecialchars(strtolower($_POST["username"]));    
    $profit = htmlspecialchars($_POST["profit"]);
    $equality = htmlspecialchars($_POST["equality"]);
    $ngambang = htmlspecialchars($_POST["ngambang"]);
    $perolehan = htmlspecialchars($_POST["perolehan"]);
    $komisi = htmlspecialchars($_POST["komisi"]);

    //query insert data
    $query = "INSERT INTO copytrading 
                VALUES 
                ('','$broker','$username','$profit','$equality','$ngambang','$perolehan','$komisi') 
            ";
    
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
        <script>
            alert('Isi Data berhasil');
            document.location.href = 'copytrading';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Isi Data gagal');
            document.location.href = 'copytrading';
        </script>
        ";
    }
}
?>

<body class="theme-blue">
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
            <div class="block-header">
                <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h1>
                                Data Copy Trading
                            </h1>
                            <td>
                                <button type="button" data-color="blue" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#mdModal"><i class="material-icons">add</i></button>
                                <!-- <a href="updaterate.php?id=
                                    <span class="badge bg-cyan"><i class="material-icons">build</i></span> 
                                </a> -->
                            </td>

                            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Update Kurs Broker</h4>
                                        </div>
                                        <form class="form-horizontal" action=""  method="post">
                                        <div class="modal-body">
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="email_address_2">Broker</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="broker" name="broker" class="form-control" value="" >
                                                            </div>                                
                                                            
                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">UserName</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="username" name="username" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">Profit</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="profit" name="profit" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">Equality</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="equality" name="equality" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">Keuntungan Mengambang</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="ngambang" name="ngambang" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">Perolehan</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="perolehan" name="perolehan" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="password_2">Komisi</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="komisi" name="komisi" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-link waves-effect" name="tambahdata">Tambah Data</button>
                                            <!--  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                          
                                            <!-- <th>Email</th> -->
                                            <th>No</th>
                                            <th>Broker</th>
                                            <th>UserName</th>
                                            <th>Profit</th>
                                            <th>Equality</th>
                                            <th>Keuntungan Mengambang</th>  
                                            <th>Perolehan</th>
                                            <th>Komisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tampil as $row ) : ?> 
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row["broker"] ?></td>                          
                                            <td><?= $row["username"] ?></td>                          
                                            <td><?= $row["profit"] ?></td>
                                            <td><?= $row["equality"] ?></td>
                                            <td><?= $row["keuntungan_mengambang"] ?></td>
                                            <td><?= $row["perolehan"] ?></td>
                                            <td><?= $row["komisi"] ?></td>

                    		                
                    		                

                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
    </section>

    <?php require 'include/scripts.php'; ?>