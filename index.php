<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Kuisioner Pengaduan - SIPANDURUMKIT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <style>
        .dropzone {
            border: 3px dashed #5a5959;
            padding: 20px;
            text-align: center;
        }

        
        .dropzone.is-invalid {
            border-color: red !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row">
        <div class="col-sm-12 col-md-4 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Form Kuisioner Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <form id="kuisionerForm" action="#" method="POST" enctype="multipart/form-data" novalidate>

                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    placeholder="Nama Lengkap">
                                <span class="invalid-feedback">Mohon Masukkan Nama Lengkap.</span>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap"
                                    placeholder="Alamat : ..."></textarea>
                                <span class="invalid-feedback">Mohon Masukkan Alamat Lengkap.</span>
                            </div>

                            <div class="mb-3">
                                <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                                <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan">
                                <span class="invalid-feedback">Mohon Pilih Tanggal Pengaduan.</span>
                            </div>

                            <div class="mb-3">
                                <label for="ruang_poli" class="form-label">Ruangan Poli</label>
                                <select class="form-select" id="ruang_poli" name="ruang_poli">
                                    <option value="" selected disabled>--Pilih Poli--</option>
                                    <option value="THT">THT</option>
                                    <option value="Kulkel">Kulkel</option>
                                    <option value="Penyakit Dalam">Penyakit Dalam</option>
                                    <option value="Bedah">Bedah</option>
                                    <option value="Orthopedi">Orthopedi</option>
                                    <option value="KIA">KIA</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Jantung">Jantung</option>
                                    <option value="Saraf">Saraf</option>
                                    <option value="Mata">Mata</option>
                                    <option value="Gigi">Gigi</option>
                                    <option value="Rehap Medik">Rehap Medik</option>
                                    <option value="Jiwa">Jiwa</option>
                                    <option value="MCU">MCU</option>
                                </select>
                                <span class="invalid-feedback">Mohon Pilih Salah Satu Poli.</span>
                            </div>

                            <div class="mb-3">
                                <label for="rawat_inap" class="form-label">Rawat Inap / UGD</label>
                                <select class="form-select" id="rawat_inap" name="rawat_inap">
                                    <option value="" selected disabled>--Pilih Rawat Inap/UGD--</option>
                                    <option value="Rawat Inap">Rawat Inap</option>
                                    <option value="UGD">UGD</option>
                                    <option value="Satria Balia">Satria Balia</option>
                                    <option value="ICU">ICU</option>
                                    <option value="Wijaya Loka">Wijaya Loka</option>
                                    <option value="Satria Nalentora">Satria Nalentora</option>
                                    <option value="Griya Gampiri">Griya Gampiri</option>
                                    <option value="Sando Husada">Sando Husada</option>
                                    <option value="OK">OK</option>
                                </select>
                                <span class="invalid-feedback">Mohon Pilih Salah Satu Unit Rawat.</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Foto</label>
                                <div class="dropzone" id="my-dropzone"></div>
                                <span id="dropzone-error" class="text-danger small d-none">Mohon Untuk Upload Foto.</span>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-success">Kirim Pengaduan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "pengaduan/add.php", 
        autoProcessQueue: false,
        maxFiles: 1,
        acceptedFiles: ".jpg,.jpeg,.png",
        addRemoveLinks: true
    });

    document.getElementById("kuisionerForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        let isValid = true;

        const fields = [
            "nama_lengkap", "alamat_lengkap", "tgl_pengaduan", "ruang_poli", "rawat_inap"
        ];

        fields.forEach(id => {
            const el = document.getElementById(id);
            if (!el.value.trim()) {
                el.classList.add("is-invalid");
                isValid = false;
            } else {
                el.classList.remove("is-invalid");
            }
        });

        const dropzoneContainer = document.getElementById("my-dropzone");
        const dropzoneError = document.getElementById("dropzone-error");

        if (myDropzone.files.length === 0) {
            dropzoneContainer.classList.add("is-invalid");
            dropzoneError.classList.remove("d-none");
            isValid = false;
        } else {
            dropzoneContainer.classList.remove("is-invalid");
            dropzoneError.classList.add("d-none");
        }

        if (!isValid) return;

        const file = myDropzone.files[0];
        const formData = new FormData();
        formData.append('foto', file);
        formData.append('nama_lengkap', document.getElementById("nama_lengkap").value);
        formData.append('alamat_lengkap', document.getElementById("alamat_lengkap").value);
        formData.append('tgl_pengaduan', document.getElementById("tgl_pengaduan").value);
        formData.append('ruang_poli', document.getElementById("ruang_poli").value);
        formData.append('rawat_inap', document.getElementById("rawat_inap").value);
        formData.append('tambah', true);

        const response = await fetch("pengaduan/add.php", {
            method: "POST",
            body: formData
        });

        const result = await response.text();
        // alert(result);
        window.location.href = "success.php";
    });
</script>


</body>

</html>