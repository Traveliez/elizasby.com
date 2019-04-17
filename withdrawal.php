<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $juhal = "transaksi";
    $withdraw = query("SELECT * FROM withdraw ORDER BY id DESC");
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
                                Withdrawal Akun Trading
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
                                            <th>Broker</th>
                                            
                                            <th>Withdrawal</th>
                                            <th>Bank</th>  
                                            <th>Total</th>                                              
                                            <th>Status</th>
                                            <th>Bukti Transfer</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl</th>        
                                            <!-- <th>Email</th> -->
                                            <th>No Akun</th>
                                            <th>Broker</th>
                                            
                                            <th>Withdrawal</th>
                                            <th>Bank</th>  
                                            
                                            <th>Total</th>                                              
                                            <th>Status</th>
                                            <th>Bukti Transfer</th>
                                            <th>Action</th> 
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($withdraw as $row ) : ?> 
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tanggal'];
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
                                                    echo $ta.'-'.$bul.'-'.$tah.' || '.'<br>'.substr($row["jam"],0,5) 
                                                ?>
                                            </td>   
                                            <td><?= $row["no_akun"] ?></td>
                                            <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                            <td><?= strtoupper($row["broker"]) ?></td>
                                            <?php else: ?>
                                            <td><?= ucwords($row["broker"]) ?></td>
                                            <?php endif; ?>
                                                                                            
                                            <td>$ <?= number_format($row["withdrawal"],2) ?></td>

                                            <?php if ($row["status"]==4 ) : ?>
                                                <?php if ($row["bank"]==="mandiri" ) : ?>
                                                <td><?= "<b>" . ucwords($row["bank"]) . " </b>" ?></td>
                                                <?php else: ?>
                                                <td><?= "<b>" . strtoupper($row["bank"]) . " </b>" ?></td>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($row["bank"]==="mandiri" ) : ?>
                                                <td>
                                                    <?= "<b>" . ucwords($row["bank"]) . " </b>" ?> - <?= "<b>" . ucwords($row["namarek"]) . " </b>" ?>
                                                    <br>
                                                    <?= "<b>" . $row["norek"] . " </b>" ?>
                                                </td>
                                                <?php else: ?>
                                                <td>
                                                    <?= "<b>" . strtoupper($row["bank"]) . " </b>" ?> - <?= "<b>" . ucwords($row["namarek"]) . " </b>" ?>
                                                    <br>
                                                    <?= "<b>" . $row["norek"] . " </b>" ?>
                                                </td>
                                                <?php endif; ?>
                                            <?php endif; ?>


                                            <td>Rp. <?= "<b>" . number_format($row["total"]) . " </b>" ?></td>
                                            <td>
                                            <?php
                                            $p = "<span class='label label-primary'>Proses</span>";
                                            $s = "<span class='label label-success'>Sukses</span>";
                                            $g = "<span class='label label-danger'>Gagal</span>";
                                            $w = "<span class='label label-warning'>Confirm</span>";
                                            $in = "<span class='label label-info'>Confirmed</span>";
                                                if($row['status'] == '1'){

                                                echo $p ;

                                                } elseif ($row['status'] == '2'){

                                                echo $s ;

                                                } elseif ($row['status'] == '3'){
                                                echo $g ;
                                                }elseif ($row['status'] == '4'){
                                                echo $w ;
                                                }else{echo $in;}
                                            ?>
                                            </td>
                                            <td>
                                        
                                            <?php 
                                            $idbukti = $row['id'];
                                            
                                            $query = query("SELECT * FROM bukti_transfer WHERE id='$idbukti'");
                                            if(isset($query[0]['bukti_transfer'])){
                                                echo '<img class="zoom"  src="bukti_transfer/'.$query[0]['bukti_transfer'].'" style="width:80%; max-width:200px; height:100%; max-height:200px">';
                                                echo "<form action='edit_bukti_transfer.php?id=$idbukti' method='post' enctype='multipart/form-data'>
                    		                    <input class='custom-file-upload' id='file-upload' type='file' name='file'>
 
                    		                    <input class='custom-file-submit' id='file-submit' type='submit' name='edit' value='Edit'>
                    		                    </form>
                    		                    ";
                                            } else {
                                                echo "<form action='bukti_transfer.php?id=$idbukti' method='post' enctype='multipart/form-data'>

                    		                    <input class='custom-file-upload' type='file' name='file'>
 
                    		                    <input class='custom-file-submit' type='submit' name='upload' value='Upload'>
                    		                    </form>
                    		                    ";
                                            }
                                                
                    		                ?>
                    		                </td>
                    		                
                    		                
                                            <td class="actions">
                                                <a href="add/withdrawalpro.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a> ||
                                                <a href="add/withdrawalga.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin withdrawal gagal ?')){return true}else{return false}" >
                                                    <span class="badge bg-orange"><i class="material-icons">close</i></span>
                                                </a> ||
                                                <a href="add/withdrawalhapus.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin ingin menghapusnya ?')){return true}else{return false}" >
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
            <!-- Small Size -->
            <div class="modal fade" id="bank" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form action="" method="post" class="" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Detail Withdrawal</h4>
                        </div>
                        <div class="modal-body">
                            <select class="form-control show-tick" data-live-search="true">
                                        <option>Hot Dog, Fries and a Soda</option>
                                        <option>Burger, Shake and a Smile</option>
                                        <option>Sugar, Spice and all things nice</option>
                                    </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-blue waves-effect" name="foto">Update</button>
                            <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>