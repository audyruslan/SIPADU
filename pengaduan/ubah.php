<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;
    $users_id = $data["users_id"];
    $nama_lengkap = $data['nama_lengkap'];
    $tgl_pengaduan = $data['tgl_pengaduan'];
    $ruang_poli = $data['ruang_poli'];
    $rawat_inap = $data['rawat_inap'];
    $alamat_lengkap = $data['alamat_lengkap'];
    $keluhan = $data['keluhan'];

    $imgLama = $data["imgLama"];

    if ($_FILES['img_dir']['error'] === 4) {
        $query = "UPDATE tb_pengaduan
                SET	
                nama_lengkap = '$nama_lengkap',
                tgl_pengaduan = '$tgl_pengaduan',
                ruang_poli = '$ruang_poli',
                rawat_inap = '$rawat_inap',
                img_dir = '$imgLama',
                alamat_lengkap = '$alamat_lengkap',
                keluhan = '$keluhan'
                WHERE users_id = $users_id
			";
    } else {
        if (file_exists("image/$imgLama")) {
            unlink("image/$imgLama");
        }
        $img_dir = image_dir();
        $query = "UPDATE tb_pengaduan
                SET
				nama_lengkap = '$nama_lengkap',
                tgl_pengaduan = '$tgl_pengaduan',
                ruang_poli = '$ruang_poli',
                rawat_inap = '$rawat_inap',
                img_dir = '$img_dir',
                alamat_lengkap = '$alamat_lengkap',
                keluhan = '$keluhan'
                WHERE users_id = $users_id
			";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Data Pengaduan";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil DiUbah!";
        header("Location: ../pengaduan.php");
    } else {
        $_SESSION['status'] = "Data Pengaduan";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal DiUbah!";
        header("Location: ../pengaduan.php");
    }
}
