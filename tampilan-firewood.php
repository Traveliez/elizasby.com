<?php 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $juhal = "rebate_xls";
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
                                Data XLS FireWood
                            </h1>
                            <form action='' method='post' enctype='multipart/form-data'>
                            <label for="file-upload" class="custom-file-upload">
                                <i class="material-icons">search</i> Browse File
                            </label>
                              <input id="file-upload" name="upload-firewood" type="file"/>
                              
                            <label for="file-submit" class="custom-file-submit">
                                <i class="material-icons">cloud_upload</i> Upload
                            </label>
                              <input id="file-submit" name="submit-firewood" type="submit"/>
                    		</form>
                        </div>
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>        
                                            <!-- <th>Email</th> -->
                                            <th>Account</th>
                                            <th>Nama Client</th>
                                            
                                            <th>Auto Rebate</th>
                                            <th>Rebate Client($)</th>  
                                            <th>Rebate Client(Rp)</th>                                              
                                            <th>LOT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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