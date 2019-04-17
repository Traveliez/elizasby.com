<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $juhal = "transaksi";
    $validasi = query("SELECT * FROM validasi WHERE status=2 ORDER BY id DESC ");
    $rebate = query("SELECT * FROM bagirebate ORDER BY id DESC ");
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
            <div class="block-header">
                <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Akun Trading Member
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <!-- <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            
                                            <th>Nama</th>                                                
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                                                                        
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            
                                            <th>Nama</th>                                                
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                                                                     
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($validasi as $row ) : ?> 
                                        <tr>
                                            <td><?= $i ?></td>
                                            
                                            <td><?= $row["nama"] ?></td>
                                            <td><?= $row["broker"] ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            
                                            <td class="actions">
                                                <a href="bagirebate.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">monetization_on</i></span> 
                                                </a> 
                                            </td> 
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Rebate Member
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <!-- <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            
                                                                                          
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                            <th>Rebate</th>                                              
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            
                                                                                
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                            <th>Rebate</th>                                                     
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rebate as $row ) : ?> 
                                        <tr>
                                            <td><?= $i ?></td>
                                            
                                            
                                            <td><?= $row["broker"] ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <td>($<?= number_format($row["rebatedollar"],2) ?>) - Rp.<?= number_format($row["rebaterp"]) ?></td>
                                            
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
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>