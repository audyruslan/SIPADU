<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
$title = "Data Pengaduan";
$menu = "Data Pengaduan";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'functions.php';

$user = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user'");
$admin = mysqli_fetch_assoc($query);
require 'layouts/sidebar.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengaduan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Pengaduan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-table"></i> Tabel Data Pengaduan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover text-center" id="productTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Pengaduan</th>
                                <th>Tanggal Pengaduan</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM tb_pengaduan");
                        while ($row = mysqli_fetch_assoc($sql)) {
                        ?>
                            <tr>
                                <td><?= $i; ?>.</td>
                                <td><img class="img-fluid" src="pengaduan/image/<?= $row['img_dir']; ?>" width="50"
                                        alt="Foto"></td>
                                <td><?= $row['nama_lengkap']; ?></td>
                                <td><?= tgl_indo($row['tgl_pengaduan']); ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm ubah" data-toggle="modal"
                                        data-target="#EditModal<?= $row["users_id"]; ?>"><i class="fas fa-edit"></i> </a>
                                    <a class="btn btn-danger btn-sm hapus_pengaduan"
                                        href="pengaduan/hapus.php?id=<?= $row["users_id"]; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="EditModal<?= $row["users_id"]; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="#EditModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="EditModalLabel">Ubah Pengaduan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="pengaduan/ubah.php" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="users_id" value="<?= $row["users_id"]; ?>">
                                                <input type="hidden" name="imgLama" value="<?= $row["img_dir"]; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_lengkap">Nama Pengaduan</label>
                                                                    <input type="text" autocomplete="off"
                                                                        class="form-control" id="nama_lengkap"
                                                                        name="nama_lengkap"
                                                                        value="<?= $row["nama_lengkap"]; ?>"
                                                                        placeholder="Nama Product">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                                                                    <input type="date" autocomplete="off"
                                                                        class="form-control" id="tgl_pengaduan"
                                                                        name="tgl_pengaduan"
                                                                        value="<?= $row["tgl_pengaduan"]; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ruang_poli">Ruang Poli</label>
                                                                    <select class="form-control" name="ruang_poli"
                                                                        id="ruang_poli">
                                                                        <option value="">--Silahkan Pilih--</option>
                                                                        <option value="THT" <?= ($row['ruang_poli'] == "THT") ? 'selected' : '' ?>>THT</option>
                                                                        <option value="Kulkel" <?= ($row['ruang_poli'] == "Kulkel") ? 'selected' : '' ?>>Kulkel</option>
                                                                        <option value="Penyakit Dalam" <?= ($row['ruang_poli'] == "Penyakit Dalam") ? 'selected' : '' ?>>Penyakit Dalam</option>
                                                                        <option value="Bedah" <?= ($row['ruang_poli'] == "Bedah") ? 'selected' : '' ?>>Bedah</option>
                                                                        <option value="Orthopedi" <?= ($row['ruang_poli'] == "Orthopedi") ? 'selected' : '' ?>>Orthopedi</option>
                                                                        <option value="KIA" <?= ($row['ruang_poli'] == "KIA") ? 'selected' : '' ?>>KIA</option>
                                                                        <option value="Anak" <?= ($row['ruang_poli'] == "Anak") ? 'selected' : '' ?>>Anak</option>
                                                                        <option value="Jantung" <?= ($row['ruang_poli'] == "Jantung") ? 'selected' : '' ?>>Jantung</option>
                                                                        <option value="Saraf" <?= ($row['ruang_poli'] == "Saraf") ? 'selected' : '' ?>>Saraf</option>
                                                                        <option value="Mata" <?= ($row['ruang_poli'] == "Mata") ? 'selected' : '' ?>>Mata</option>
                                                                        <option value="Gigi" <?= ($row['ruang_poli'] == "Gigi") ? 'selected' : '' ?>>Gigi</option>
                                                                        <option value="Rehap Medik" <?= ($row['ruang_poli'] == "Rehap Medik") ? 'selected' : '' ?>>Rehap Medik</option>
                                                                        <option value="Jiwa" <?= ($row['ruang_poli'] == "Jiwa") ? 'selected' : '' ?>>Jiwa</option>
                                                                        <option value="MCU" <?= ($row['ruang_poli'] == "MCU") ? 'selected' : '' ?>>MCU</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label for="rawat_inap">Rawat Inap</label>
                                                                    <select class="form-control" name="rawat_inap"
                                                                        id="rawat_inap">
                                                                        <option value="">--Silahkan Pilih--</option>
                                                                        <option value="Rawat Inap" <?= ($row['rawat_inap'] == "Rawat Inap") ? 'selected' : '' ?>>Rawat Inap</option>
                                                                        <option value="UGD" <?= ($row['rawat_inap'] == "UGD") ? 'selected' : '' ?>>UGD</option>
                                                                        <option value="Satria Balia" <?= ($row['rawat_inap'] == "Satria Balia") ? 'selected' : '' ?>>Satria Balia</option>
                                                                        <option value="ICU" <?= ($row['rawat_inap'] == "ICU") ? 'selected' : '' ?>>ICU</option>
                                                                        <option value="Wijaya Loka" <?= ($row['rawat_inap'] == "Wijaya Loka") ? 'selected' : '' ?>>Wijaya Loka</option>
                                                                        <option value="Satria Nalentora" <?= ($row['rawat_inap'] == "Satria Nalentora") ? 'selected' : '' ?>>Satria Nalentora</option>
                                                                        <option value="Griya Gampiri" <?= ($row['rawat_inap'] == "Griya Gampiri") ? 'selected' : '' ?>>Griya Gampiri</option>
                                                                        <option value="Sando Husada" <?= ($row['rawat_inap'] == "Sando Husada") ? 'selected' : '' ?>>Sando Husada</option>
                                                                        <option value="OK" <?= ($row['rawat_inap'] == "OK") ? 'selected' : '' ?>>OK</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="alamat_lengkap">Alamat Lengkap</label>
                                                                    <textarea class="form-control" name="alamat_lengkap"
                                                                        id="alamat_lengkap"
                                                                        placeholder="Alamat Lengkap"><?= $row["alamat_lengkap"]; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="keluhan">Keluhan</label>
                                                                    <textarea class="form-control" name="keluhan"
                                                                        id="keluhan"
                                                                        placeholder="Keluhan"><?= $row["keluhan"]; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="text-center"><b>Gambar/Foto</b></h6>
                                                        <div class="drop-zone">
                                                            <span class="drop-zone__prompt">Drop file here or click to
                                                                upload</span>
                                                            <input type="file" name="img_dir" class="drop-zone__input">
                                                            <div class="drop-zone__thumb"
                                                                style="background-image: url('pengaduan/image/<?= $row["img_dir"]; ?>')"
                                                                data-label="<?= $row["img_dir"]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>

                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>