<?php
session_start();
require '../functions.php';

require '../vendor/ultramsg/whatsapp-php-sdk/ultramsg.class.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

function tambah($data)
{   
    global $conn;

    $nama_lengkap   = mysqli_real_escape_string($conn, $data['nama_lengkap']);
    $email          = mysqli_real_escape_string($conn, $data['email']);
    $no_hp          = mysqli_real_escape_string($conn, $data['no_hp']);
    $alamat_lengkap = mysqli_real_escape_string($conn, $data['alamat_lengkap']);
    $tgl_pengaduan  = mysqli_real_escape_string($conn, $data['tgl_pengaduan']);
    $ruang_poli     = mysqli_real_escape_string($conn, $data['ruang_poli']);
    $rawat_inap     = mysqli_real_escape_string($conn, $data['rawat_inap']);
    $keluhan        = mysqli_real_escape_string($conn, $data['keluhan']);

    $filename = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $filename = time() . '_' . basename($_FILES['foto']['name']);
        $uploadDir = 'image/';
        $uploadPath = $uploadDir . $filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath);
    }

    $img_dir = $filename;

    $query = "INSERT INTO tb_pengaduan 
                (nama_lengkap, email, no_hp, alamat_lengkap, tgl_pengaduan, ruang_poli, rawat_inap, keluhan, img_dir)
              VALUES 
                ('$nama_lengkap', '$email', '$no_hp', '$alamat_lengkap', '$tgl_pengaduan', '$ruang_poli', '$rawat_inap', '$keluhan', '$img_dir')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // ===================== KIRIM PESAN WA =====================
        $ultramsg_token = "0t640nb0cowx97ep";   // ganti dengan API Token Ultramsg
        $instance_id    = "instance139348";     // ganti dengan Instance ID Ultramsg

        $wa = new WhatsAppApi($ultramsg_token, $instance_id);

        $pesan = "Halo $nama_lengkap,\n\nTerima kasih telah mengisi form pengaduan.\n\nDetail pengaduan:\n- Nama: $nama_lengkap\n- No HP: $no_hp\n- Tanggal: $tgl_pengaduan\n- Poli: $ruang_poli\n- Rawat Inap: $rawat_inap\n- Keluhan: $keluhan\n\nKami akan segera menindaklanjuti laporan Anda.";

        try {
            $wa->sendChatMessage($no_hp, $pesan);
        } catch (Exception $e) {
            echo "WA Error: " . $e->getMessage();
        }

        // ===================== KIRIM EMAIL =====================
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;           
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sipandurumkit@gmail.com';
            $mail->Password   = 'yest bwco wixd yeco'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('sipandurumkit@gmail.com', 'Tim Pengaduan RS');
            $mail->addAddress($email, $nama_lengkap);

            $mail->isHTML(true);
            $mail->Subject = 'Konfirmasi Pengaduan Anda';
            $mail->Body    = "
                <p>Halo <b>$nama_lengkap</b>,</p>
                <p>Terima kasih telah mengirimkan pengaduan. Berikut detailnya:</p>
                <ul>
                    <li><b>Nama:</b> $nama_lengkap</li>
                    <li><b>No HP:</b> $no_hp</li>
                    <li><b>Tanggal Pengaduan:</b> $tgl_pengaduan</li>
                    <li><b>Ruang Poli:</b> $ruang_poli</li>
                    <li><b>Rawat Inap:</b> $rawat_inap</li>
                    <li><b>Keluhan:</b> $keluhan</li>
                </ul>
                <p>Kami akan segera menindaklanjuti laporan Anda.</p>
                <p>Hormat kami,<br>Tim Pengaduan Rumah Sakit</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }

    return mysqli_affected_rows($conn);
}

if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "✅ Sukses: Data berhasil disimpan, WA & Email terkirim!";
    } else {
        echo "❌ Gagal: Data tidak berhasil disimpan.";
    }
} else {
    echo "❌ Gagal: Permintaan tidak valid.";
}
