<?php
session_start();
$title = "Dashboard";
$menu = "Dashboard";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'functions.php';

if (isset($_SESSION["login"])) {
    $user = $_SESSION["username"];
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user'");
    $admin = mysqli_fetch_assoc($query);
}

// Total Data Pengaduan
$totPengaduan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengaduan"));
// Total Data Admin
$totAdmin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_admin"));

require 'layouts/sidebar.php';

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totPengaduan ?> Pengaduan</h3>

                            <p>Total Pengaduan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="pengaduan.php" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3><?= $totAdmin ?> Admin</h3>

                            <p>Data Admin</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="profile.php" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>

<?php
require 'layouts/footer.php';
?>