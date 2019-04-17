<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $broker = query("SELECT * FROM broker ");
    
    $juhal = "Broker";


//cek apakah tombol input sudah di tekan atau belum
if( isset($_POST["updatebroker"]) ) {
    $kodebroker = $_POST["idbroker"];
    $linkbroker = htmlspecialchars($_POST["linkbroker"]);
    
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    

    $query = "UPDATE broker SET
                link = '$linkbroker',
                
                deskripsi = '$deskripsi'
        WHERE kode_broker = '$kodebroker'
    ";
    mysqli_query($conn, $query);
    
    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
            <script>
                alert('Edit broker  berhasil');
                document.location.href = 'broker';                
            </script>
            ";
  
        
    } else {
        echo "
            <script>
                alert('Edit broker gagal');                
                document.location.href = 'broker';                
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
                            <h2>
                                Daftar Broker
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
                                            <th>Nama Broker</th>
                                            <th>Link</th>
                                            <!-- <th>Warna Dasar</th> -->
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Broker</th>
                                            <th>Link</th>
                                            <!-- <th>Warna Dasar</th> -->
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                     <?php foreach ($broker as $row ) : ?>
                                        <tr>
                                            
                                            <td><?= $i ?></td> 
                                            <td><?= $row["nama_broker"] ?></td>                                               
                                            <td><?= $row["link"] ?></td>
                                            <!-- <td><?php // $row["warnadasar"] ?></td> -->
                                            <td><?= $row["deskripsi"] ?></td>
                                            
                                            
                                            
                                            <td> <button type="button" data-color="blue" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#edit<?= $row["kode_broker"] ?>"><i class="material-icons">build</i></button></td>
                                            
                                            <!-- For Material Design Colors -->
                                                <div class="modal fade" id="edit<?= $row["kode_broker"] ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="defaultModalLabel">Edit Broker</h4>
                                                            </div>
                                                            <form class="form-horizontal" action=""  method="post">
                                                            <div class="modal-body">
                                                                    
                                                                    <input type="hidden" class="form-control" id="idbroker" name="idbroker" value="<?= $row["kode_broker"] ?>">
                                                                    <div class="row clearfix">
                                                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                            <label for="password_2">Nama Broker</label>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                                            <div class="form-group">
                                                                                <div class="form-line">
                                                                                    <input type="text" id="namabroker" name="namabroker" class="form-control" value="<?= $row["nama_broker"] ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                            <label for="password_2">Link Broker</label>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                                            <div class="form-group">
                                                                                <div class="form-line">
                                                                                    <input type="text" id="linkbroker" name="linkbroker" class="form-control" value="<?= $row["link"] ?>" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="row clearfix">
                                                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                            <label for="wd">Warna Dasar</label>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                                            <div class="form-group" >           
                                                                                <select class="form-control" name="kolor"  >
                                                                                    <option value="">-- Please Warna --</option>
                                                                                    <option value="success">Hijau</option>
                                                                                    <option value="warning">Kuning</option>
                                                                                    <option value="danger">Merah</option>
                                                                                    <option value="dark">Hitam</option>
                                                                                    <option value="info">Biru</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="row clearfix">
                                                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                            <label for="password_2">Deskripsi</label>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                                                            <div class="form-group">
                                                                                <div class="form-line">
                                                                                    <textarea name="deskripsi" id="deskripsi" cols="50" rows="7" ><?= $row["deskripsi"] ?>"</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-link waves-effect" name="updatebroker">UPDATE BROKER</button>
                                                               
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
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

            
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>