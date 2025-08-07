<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    $nama_lengkap   = mysqli_real_escape_string($conn, $data['nama_lengkap']);
    $alamat_lengkap = mysqli_real_escape_string($conn, $data['alamat_lengkap']);
    $tgl_pengaduan  = mysqli_real_escape_string($conn, $data['tgl_pengaduan']);
    $ruang_poli     = mysqli_real_escape_string($conn, $data['ruang_poli']);
    $rawat_inap     = mysqli_real_escape_string($conn, $data['rawat_inap']);

    $filename = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $filename = time() . '_' . $_FILES['foto']['name'];
        $uploadDir = 'image/';
        $uploadPath = $uploadDir . $filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath);
    }

    $img_dir = $filename;

    $query = "INSERT INTO tb_pengaduan 
                (nama_lengkap, alamat_lengkap, tgl_pengaduan, ruang_poli, rawat_inap, img_dir)
              VALUES 
                ('$nama_lengkap', '$alamat_lengkap', '$tgl_pengaduan', '$ruang_poli', '$rawat_inap', '$img_dir')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "Sukses: Data berhasil disimpan!";
    } else {
        echo "Gagal: Data tidak berhasil disimpan.";
    }
} else {
    echo "Gagal: Permintaan tidak valid.";
}
