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

$idd = $_GET["id"];

$dam = query("SELECT * FROM artikel WHERE id = $idd") [0];


//cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["editposting"]) ) {
    $id = $idd;
    $tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    $judul = htmlspecialchars($_POST["judul"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $gambar = htmlspecialchars($_POST["gambar"]);    
    $kontent = $_POST["kontent"];

    //query edit data
    $query = "UPDATE artikel SET
                tang = '$tang',
                jam = '$jam',
                judul = '$judul',
                kategori = '$kategori',
                gambar = '$gambar',
                kontent = '$kontent'
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    //cek apakah data berhasil di edit
    if(  mysqli_affected_rows($conn) > 0 ) {
        echo "          
            <script>
                alert('edit berhasil');
                document.location.href = 'artikel';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('edit gagal');
                document.location.href = 'artikel';
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

                    <!-- Task Info -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Artikel</h2>
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
                                <form class="form-horizontal" action=""  method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                    <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="judul">Judul :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="judul" name="judul" class="form-control" value="<?= $dam['judul']  ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="kategori">Kategori :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control" type="text" name="kategori" id="kategori" >
                                                        <option><?= $dam['kategori']  ?></option>
                                                        <?php if ($dam['kategori']==="Teknikal") : ?>
                                                        <option>Fundamental</option>
                                                        <?php else : ?>
                                                        <option>Teknikal</option>
                                                        <?php endif ; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="gambar">Gambar :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input  type="text" id="gambar" name="gambar" class="form-control" value="<?= $dam['gambar']  ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="body">
                                        
                                        <textarea class="ckeditor" name="kontent" id="kontent" style="height: 800px;"><?= $dam['kontent']  ?></textarea>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-1 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" name="editposting" class="btn btn-primary m-t-15 waves-effect" >Posting Artikel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- #END# Validasi -->

                    
                </div>
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>