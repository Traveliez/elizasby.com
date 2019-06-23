<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $memberwb = query("SELECT * FROM member WHERE aff != 'rti' AND aff != 'oeangkoe' ORDER BY id_member DESC");
    $memberrti = query("SELECT * FROM member WHERE aff = 'rti' ORDER BY id_member DESC");
    $memberoeangkoe = query("SELECT * FROM member WHERE aff = 'oeangkoe' ORDER BY id_member DESC");
    $juhal = "member";
    
    
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
                            <h2>
                                Daftar Member WB
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
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                     <?php foreach ($memberwb as $row ) : ?>
                                        <tr>
                                            
                                            <td><?= $i ?></td>                                                
                                            <td><?= $row["email_member"] ?></td>
                                            <td><?= $row["username_member"] ?></td>
                                            <td><?= $row["aff"] ?></td>
                                            <td><?= $row["id_aff"] ?></td>
                                            
                                            
                                            <td> <a href="profil.php?email=<?= $row["email_member"] ?>" target="_blank" ><span class='label label-primary'>Detail</span></a></td>
                                            <td class="actions">
                                                <a href="javascript:void(0);" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a> ||
                                                <a href="javascript:void(0);" >
                                                    <span class="badge bg-pink"><i class="material-icons">delete</i></span>
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
            </div>
            <!-- #END# Exportable Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Member OEANGKOE
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
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                     <?php foreach ($memberoeangkoe as $row ) : ?>
                                        <tr>
                                            
                                            <td><?= $i ?></td>                                                
                                            <td><?= $row["email_member"] ?></td>
                                            <td><?= $row["username_member"] ?></td>
                                            <td><?= $row["aff"] ?></td>
                                            <td><?= $row["id_aff"] ?></td>
                                            
                                            
                                            <td> <a href="profil.php?email=<?= $row["email_member"] ?>" target="_blank"><span class='label label-primary'>Detail</span></a></td>
                                            <td class="actions">
                                                <a href="javascript:void(0);" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a> ||
                                                <a href="add/memberhapus.php?id=<?= $row["id_member"] ?>" onClick="if(confirm('Apakah anda yakin ingin menghapusnya ?')){return true}else{return false}" >
                                                    <span class="badge bg-pink"><i class="material-icons">delete</i></span>
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
            </div>
            <!-- #END# Exportable Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Member RTI
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
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Affiliasi</th>
                                            <th>ID Affiliasi</th>
                                            
                                            <th>Profil</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                     <?php foreach ($memberrti as $row ) : ?>
                                        <tr>
                                            
                                            <td><?= $i ?></td>                                                
                                            <td><?= $row["email_member"] ?></td>
                                            <td><?= $row["username_member"] ?></td>
                                            <td><?= $row["aff"] ?></td>
                                            <td><?= $row["id_aff"] ?></td>
                                            
                                            
                                            <td> <a href="profil.php?email=<?= $row["email_member"] ?>" target="_blank"><span class='label label-primary'>Detail</span></a></td>
                                            <td class="actions">
                                                <a href="javascript:void(0);" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a> ||
                                                <a href="javascript:void(0);" >
                                                    <span class="badge bg-pink"><i class="material-icons">delete</i></span>
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
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>