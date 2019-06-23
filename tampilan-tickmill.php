<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $juhal = "rebate_xls";

    //query filter berdasarkan nama broker
    $nama_broker = "tickmill";
    $tampil_tickmill = query("SELECT * FROM data_fbs WHERE nama_broker = '$nama_broker' ORDER BY id DESC");
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
                                Data XLS Tickmill
                            </h1>
                            <form action='upload-fbs.php' method='post' enctype='multipart/form-data'>
                            <!-- filter untuk nama broker -->
                                <input type="hidden" name="broker" value="tickmill">
                            <!--  -->
                                <input class="custom-file-upload" id="file-upload" type="file" name="file"/>
                                <input class="custom-file-submit" id="file-submit" type="submit" value="Upload"/> 
                    		</form>
                        </div>
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                          
                                            <!-- <th>Email</th> -->
                                            <th>Tanggal</th>
                                            <th>Periode</th>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Auto Rebate</th>
                                            <th>Rebate Client($)</th>  
                                            <th>Rebate Client(Rp)</th>
                                            <th>LOT</th>
                                            <th>No Rekening</th>
                                            <th>Bank</th>
                                            <th>Bukti Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tampil_tickmill as $row ) : ?> 
                                        <tr>
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
                                                    echo $ta.'-'.$bul.'-'.$tah;
                                                ?>
                                            </td>
                                            <td><?= $row["periode"] ?></td>                          
                                            <td><?= $row["no_akun"] ?></td>                          
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["auto_rebate"] ?></td>
                                            <td><?= $row["rebate_dollar"] ?></td>
                                            <td><?= $row["rebate_rupiah"] ?></td>
                                            <td><?= $row["lot"] ?></td>
                                            <td><?= $row["norek"] ?></td>
                                            <td><?= $row["bank"] ?></td>
                                            <td>
                                        
                                            <?php 
                                            $idbukti = $row['id'];
                                            
                                            $query = query("SELECT * FROM data_fbs WHERE id='$idbukti' AND nama_broker='$nama_broker'");
											foreach ($query as $row ) {
												if($row['bukti_transaksi'] != ""){
													echo '<img class="zoom"  src="bukti_transfer/'.$row['bukti_transaksi'].'" style="width:80%; max-width:200px; height:100%; max-height:200px">';
													echo "<form action='upload_bukti_tf_fbs.php?id=$idbukti' method='post' enctype='multipart/form-data'>
													<input class='custom-file-upload' id='file-upload' type='file' name='file'>
	 
													<input class='custom-file-submit' id='file-submit' type='submit' name='edit' value='Edit'>
													</form>
													";
												} else {
													echo "<form action='upload_bukti_tf_fbs.php?id=$idbukti' method='post' enctype='multipart/form-data'>

													<input class='custom-file-upload' type='file' name='file'>
	 
													<input class='custom-file-submit' type='submit' name='upload' value='Upload'>
													</form>
													";
												}
                                                
											}
                    		                ?>
                    		                </td>
                    		                
                    		                
                                            <td class="actions">
                                                <a href="add/fbs/accept.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a> ||
                                                <a href="add/fbs/cancel.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin ?')){return true}else{return false}" >
                                                    <span class="badge bg-orange"><i class="material-icons">close</i></span>
                                                </a> ||
                                                <a href="add/fbs/delete.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin ingin menghapusnya ?')){return true}else{return false}" >
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
    </section>

    <?php require 'include/scripts.php'; ?>