        <?php 
            $user = query("SELECT * FROM admin WHERE username = '".$_SESSION['username']."'") [0];

            if( isset($_POST["foto"]) ) {
                

                //cek apakh data berhasil di tambahkan
                if( postfoto($_POST) > 0 ) {
                    echo "          
                        <script>
                            alert('update foto berhasil');
                            document.location.href = 'dashboard';
                        </script>
                        ";
                } else {
                    echo "
                        <script>
                            alert('update foto gagal');
                            document.location.href = 'dashboard';
                        </script>
                        ";
                }
              
            }

            //cek apakah tombol submit sudah di tekan atau belum
            if( isset($_POST["gantipassword"]) ) {
                $kode_admin = $user['kode_admin'];
                 
                
                $passwordb = mysqli_real_escape_string($conn, $_POST["passwordb"]);
                $passwordb2 = mysqli_real_escape_string($conn, $_POST["passwordb2"]);

                //cek username  email sudah ada atau belum
                $cekemail = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
                if( mysqli_num_rows($cekemail) === 1 ) {
                    
                    
                    // cek konfirmasi passqord
                    if ( $passwordb !== $passwordb2) {
                        echo "<script>
                                alert('konfirmasi password tidak sesuai');
                                document.location.href = 'staff';
                            </script>
                            ";
                        return false;
                    }

                }

                

                //$error = true;
                
                //enskripsi password
                $passwordb = password_hash($passwordb, PASSWORD_DEFAULT);


                //query edit data
                $query = "UPDATE admin SET
                            
                            password = '$passwordb'                
                            WHERE kode_admin = '$kode_admin'
                        ";
                mysqli_query($conn, $query);

                //cek apakah data berhasil di edit
                if(  mysqli_affected_rows($conn) > 0 ) {
                    echo "          
                        <script>
                            alert('password berhasil diperbarui');
                            document.location.href = 'dashboard';
                        </script>
                        ";
                } else {
                    echo "
                        <script>
                            alert('ubah password gagal');
                            document.location.href = 'dashboard';
                        </script>
                        ";
                }
              
            }
        ?>
        <!--<Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <a href="#foto" data-toggle="modal" data-target="#foto" ><img src="images/<?= $user['foto'] ; ?>" width="48" height="48" alt="User" /></a>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $user['username'] ; ?></div>
                    <div class="email"><?= $user['email'] ; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li> -->
                            <li><a href="#gp" data-toggle="modal" data-target="#gp"><i class="material-icons">lock</i>Ganti Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php if ($juhal == "dashboard") : ?>
                    <li class="active">
                        <a href="dashboard">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php else : ?>
                    <li class="">
                        <a href="dashboard">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>    
                    <?php endif ; ?>

                    <?php if ($juhal == "Broker") : ?>
                    <li class="active">
                        <a href="broker">
                            <i class="material-icons">home</i>
                            <span>Broker</span>
                        </a>
                    </li>
                    <?php else : ?>
                    <li class="">
                        <a href="broker">
                            <i class="material-icons">home</i>
                            <span>Broker</span>
                        </a>
                    </li>    
                    <?php endif ; ?>

                    <?php if ($juhal == "laporan") : ?>
                    <li class="active">
                        <a href="laporanrebate">
                            <i class="material-icons">text_fields</i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="laporanrebate">
                            <i class="material-icons">text_fields</i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <?php endif ; ?>
                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">text_fields</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="member">Laporan Rebate</a>
                            </li>
                            <li>
                                <a href="bankmember">Laporan WB</a>
                            </li>
                           
                        </ul>
                    </li> -->
                    <?php if ($juhal == "ratebank") : ?>
                    <li class="active">
                        <a href="ratebank">
                            <i class="material-icons">layers</i>
                            <span>Rate Bank</span>
                        </a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="ratebank">
                            <i class="material-icons">layers</i>
                            <span>Rate Bank</span>
                        </a>
                    </li>
                    <?php endif ; ?>

                    <?php if ($juhal == "member") : ?>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Member</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="member">Daftar Member</a>
                            </li>
                            <li>
                                <a href="bankmember">Bank Member</a>
                            </li>
                            <li>
                                <a href="saku">Saku</a>
                            </li>
                            <!-- <li>
                                <a href="affiliasi">Affiliasi</a>
                            </li> -->
                        </ul>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Member</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="member">Daftar Member</a>
                            </li>
                            <li>
                                <a href="bankmember">Bank Member</a>
                            </li>
                            <li>
                                <a href="saku">Saku</a>
                            </li>
                            <!-- <li>
                                <a href="affiliasi">Affiliasi</a>
                            </li> -->
                        </ul>
                    </li>
                    <?php endif ; ?>

                    <?php if ($juhal == "transaksi") : ?>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Transaksi</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="validasi">Validasi</a>
                            </li>
                            <li>
                                <a href="deposit">Deposit</a>
                            </li>
                            <li>
                                <a href="withdrawal">Withdrawal</a>
                            </li>

                            <li>
                                <a href="rebate">Rebate</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php else : ?>
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Transaksi</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="validasi">Validasi</a>
                            </li>
                            <li>
                                <a href="deposit">Deposit</a>
                            </li>
                            <li>
                                <a href="withdrawal">Withdrawal</a>
                            </li>

                            <li>
                                <a href="rebate">Rebate</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php endif ; ?>
                    
                    <?php if ($juhal == "rebate_xls") : ?>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_up</i>
                            <span>Rebate XLS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="tampilan-fbs">FBS</a>
                            </li>
                            <li>
                                <a href="tampilan-firewood">Firewood</a>
                            </li>
                            <li>
                                <a href="tampilan-instaforex">InstaForex</a>
                            </li>
                            <li>
                                <a href="tampilan-justforex">JustForex</a>
                            </li>
                            <li>
                                <a href="tampilan-octa">Octa</a>
                            </li>
                            <li>
                                <a href="tampilan-tickmill">Tickmill</a>
                            </li>
                            <li>
                                <a href="tampilan-tifia">Tifia</a>
                            </li>
                            <li>
                                <a href="tampilan-welltrade">Welltrade</a>
                            </li>
                            <li>
                                <a href="tampilan-xm">XM</a>
                            </li>
                            <li>
                                <a href="tampilan-xmrebate">XM Rebate $16</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php else : ?>
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_up</i>
                            <span>Rebate XLS</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="tampilan-fbs">FBS</a>
                            </li>
                            <li>
                                <a href="tampilan-firewood">Firewood</a>
                            </li>
                            <li>
                                <a href="tampilan-instaforex">InstaForex</a>
                            </li>
                            <li>
                                <a href="tampilan-justforex">JustForex</a>
                            </li>
                            <li>
                                <a href="tampilan-octa">Octa</a>
                            </li>
                            <li>
                                <a href="tampilan-tickmill">Tickmill</a>
                            </li>
                            <li>
                                <a href="tampilan-tifia">Tifia</a>
                            </li>
                            <li>
                                <a href="tampilan-welltrade">Welltrade</a>
                            </li>
                            <li>
                                <a href="tampilan-xm">XM</a>
                            </li>
                            <li>
                                <a href="tampilan-xmrebate">XM Rebate $16</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php endif ; ?>
                    

                    <?php if ($juhal == "postartikel") : ?>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Post</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="copytrading">Copy Trading</a>
                            </li>
                            <li>
                                <a href="postartikel">Posting Artikel</a>
                            </li>
                            <li>
                                <a href="artikel">Artikel</a>
                            </li>
                            <li>
                                <a href="kontes">Kontes Rebate</a>
                            </li>
                            <li>
                                <a href="postpromo">Promo</a>
                            </li>
                        </ul>
                    </li>
                    <?php else : ?>
                    <li >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Post</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="copytrading">Copy Trading</a>
                            </li>
                            <li>
                                <a href="postartikel">Posting Artikel</a>
                            </li>
                            <li>
                                <a href="artikel">Artikel</a>
                            </li>
                            <li>
                                <a href="kontes">Kontes Rebate</a>
                            </li>
                            <li>
                                <a href="postpromo">Promo</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif ; ?>
                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/medias/image-gallery.html">Image Gallery</a>
                            </li>
                            <li>
                                <a href="pages/medias/carousel.html">Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Charts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/charts/morris.html">Morris</a>
                            </li>
                            <li>
                                <a href="pages/charts/flot.html">Flot</a>
                            </li>
                            <li>
                                <a href="pages/charts/chartjs.html">ChartJS</a>
                            </li>
                            <li>
                                <a href="pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li>
                                <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Multi Level Menu</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li> -->
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                     <a href="#">WarungBroker.com</a> &copy; 2017-2018
                </div>
                <div class="version">
                    Powered by <b>javaXcode </b> 
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
            <!-- Small Size -->
            <div class="modal fade" id="foto" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form action="" method="post" class="" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Update Foto</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="form-control" id="gambar" name="gambar"></input>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-blue waves-effect" name="foto">Update</button>
                            <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Small Size -->
            <div class="modal fade" id="gp" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="post" class="" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Ganti Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 form-control-label">
                                <label for="password">Password :</label>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="passwordb" name="passwordb" class="form-control" placeholder="Password" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 form-control-label">
                                <label for="password">Konfirmasi Password :</label>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="passwordb2" name="passwordb2" class="form-control" placeholder="Konfirmasi Password" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-blue waves-effect" name="gantipassword">Update Password</button>
                            <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>