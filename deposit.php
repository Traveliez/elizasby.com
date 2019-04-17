<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $deposit = query("SELECT * FROM deposit ORDER BY id DESC");

    $juhal = "transaksi";
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
                                Deposit Akun Trading
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
                                            <th>Tgl</th>        
                                            <!-- <th>Email</th> -->
                                            <th>No Akun</th>
                                            <th>Nama</th>
                                            <th>Broker</th>
                                            
                                            <th>Deposit</th>
                                            <th>Bank</th>  
                                            <th>Total</th>                                              
                                            <th>Status</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl</th>        
                                            <!-- <th>Email</th> -->
                                            <th>No Akun</th>
                                            <th>Nama</th>
                                            <th>Broker</th>
                                            
                                            <th>Deposit</th>
                                            <th>Bank</th>  
                                            <th>Total</th>                                              
                                            <th>Status</th>
                                            <th>Action</th> 
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($deposit as $row ) : ?> 
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tang'];
                                                    $ta = substr($t,8,2);
                                                    $bu = substr($t,5,2);
                                                    $tah = substr($t,2,2);
                                                    if ($bu === '01' ) {
                                                        $bul = "Jan";
                                                    }elseif ($bu === '02' ) {
                                                        $bul = "Feb";
                                                    }elseif ($bu === '03' ) {
                                                        $bul = "Maret";
                                                    }elseif ($bu === '04' ) {
                                                        $bul = "April"; 
                                                    }elseif ($bu === '05' ) {
                                                        $bul = "Mei";
                                                    }elseif ($bu === '06' ) {
                                                        $bul = "Juni";
                                                    }elseif ($bu === '07' ) {
                                                        $bul = "Juli";
                                                    }elseif ($bu === '08' ) {
                                                        $bul = "Agust";
                                                    }elseif ($bu === '09' ) {
                                                        $bul = "Sept";
                                                    }elseif ($bu === '10' ) {
                                                        $bul = "Okt";
                                                    }elseif ($bu === '11' ) {
                                                        $bul = "Nov";
                                                    }else{
                                                        $bul = "Des";
                                                    }
                                                    echo $ta.'-'.$bul.'-'.$tah.' || '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>   
                                            <td><?= $row["no_akun"] ?></td>
                                            <td><?= ucwords($row["namaakun"]) ?></td>
                                            <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                            <td><?= strtoupper($row["broker"]) ?></td>
                                            <?php else: ?>
                                            <td><?= ucwords($row["broker"]) ?></td>
                                            <?php endif; ?>
                                                                                            
                                            <td>$ <?= number_format($row["deposit"],2) ?></td>

                                            <?php if ($row["bank"]==="mandiri" ) : ?>
                                            <td><?= "<b>" . ucwords($row["bank"]) . " </b>" ?></td>
                                            <?php else: ?>
                                            <td><?= "<b>" . strtoupper($row["bank"]) . " </b>" ?></td>
                                            <?php endif; ?>
                                            
                                            <td>Rp. <?= "<b>" . number_format($row["total"]) . " </b>" ?></td>
                                            <td>
                                            <?php
                                            $p = "<span class='label label-primary'>Proses</span>";
                                            $s = "<span class='label label-success'>Sukses</span>";
                                            $g = "<span class='label label-danger'>Gagal</span>";
                                                if($row['status'] == '1'){

                                                echo $p ;

                                                } elseif ($row['status'] == '2'){

                                                echo $s ;

                                                } elseif ($row['status'] == '3'){
                                                echo $g ;
                                                }
                                            ?>
                                            </td>
                                            <td class="actions">
                                                <a href="add/depositpro.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a>
                                                <a href="add/depositga.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin deposit gagal ?')){return true}else{return false}" >
                                                    <span class="badge bg-orange"><i class="material-icons">close</i></span>
                                                </a>
                                                <a href="add/hapusdepo.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus transaksi deposit ?')){return true}else{return false}" >
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