<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

$sql = mysqli_query($conn, "SELECT * FROM tb_pengaduan
                    WHERE users_id = '$id'");
$row = mysqli_fetch_assoc($sql);

$img_dir = $row["img_dir"];
if (file_exists("image/$img_dir")) {
    unlink("image/$img_dir");
}

if (hapus_pengaduan($id) > 0) {
    $_SESSION['status'] = "Data Pengaduan";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus!";
    header("Location: ../pengaduan.php");
} else {
    $_SESSION['status'] = "Data Pengaduan";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus!";
    header("Location: ../pengaduan.php");
}
