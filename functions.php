<?php
$conn = mysqli_connect("localhost", "root", "", "db_pengajuan");

function hapus_admin($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_admin WHERE username = '$id'");
    return mysqli_affected_rows($conn);
}

function hapus_pengaduan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_pengaduan WHERE users_id = '$id'");
    return mysqli_affected_rows($conn);
}

function image_dir()
{
    $namaFile = time() . '_' . $_FILES['img_dir']['name'];
    $tmpName = $_FILES['img_dir']['tmp_name'];

    move_uploaded_file($tmpName, 'image/' . $namaFile);

    return $namaFile;
}

function avatar($character)
{
    $path = "image/" . time() . ".png";
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);
    $textcolor = imagecolorallocate($image, 255, 255, 255);

    $font = dirname(__FILE__) . "/assets/font/arial.ttf";

    imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}