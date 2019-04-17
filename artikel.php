<?php

session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $validasi = query("SELECT * FROM validasi WHERE status=2 ORDER BY id DESC");
    $juhal = "postartikel";

    $artikel = query("SELECT * FROM artikel ORDER BY id DESC");
  

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

                    <!-- Task Info -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Posting Artikel</h2>
                                <!-- <ul class="header-dropdown m-r--5">
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
                                </ul> -->
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Kontent</th>
                                            <th>Gambar</th>        
                                            <th>Action</th>  
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Kontent</th>
                                            <th>Gambar</th>        
                                            <th>Action</th>  
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                     <?php foreach ($artikel as $row ) : ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tang'];
                                                    $ta = substr($t,8,2);
                                                    $bu = substr($t,5,2);
                                                    $tah = substr($t,0,4);
                                                    echo $ta.'-'.$bu.'-'.$tah.' || '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>   
                                            <td><?= $row["judul"] ?></td>
                                            <td><?= $row["kategori"] ?></td>
                                            <td><?=substr ($row["kontent"],0,100) ?></td>
                                            <td><img src="images/<?= $row["gambar"]; ?>" width="50px"></td>
                                            <td class="actions">
                                                <a href="editartikel.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">mode_edit</i></span> 
                                                </a> ||
                                                <a href="add/hapusartikel.php?id=<?= $row["id"] ?> " onClick="if(confirm('Apakah anda yakin akan menghapus data ?')){return true}else{return false}" class="on-default remove-row" class="on-default remove-row">
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
                    </div><!-- #END# Validasi -->

                    
                </div>
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>