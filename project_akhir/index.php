<?php
    $daftarJenisKelamin = array("Laki-Laki", "Perempuan");
    $daftarAgama = array("Islam", "Hindu", "Buddha", "Kristen", "Konghucu");
    $daftarJurusan = array("Sains Data", "Teknik Informatika", "Sistem Informasi", "Sistem Komputer", "Akuntansi", "Desain dan Komunikasi Visual", "Bisnis Digital", "Managemen", "Pendidikan Teknologi Informasi", "Desain Interior","Akuntansi");
    $daftarMataKuliah = array("Science Data", "Database Technology", "Organisasi dan Arsitektur Komputer", "Design Grafis Antarmuka", "Pengantar Ilmu Komputer", "Aljabar Linear dan Matriks", "Teori Bahasa dan Otomata", "Bahasa Inggris", "Mobile Programming", "Metodologi penelitian dam Penulisan Ilmiah", "Multimedia", "Kecerdasan Buatan", "Sistem Operasi", );

    // mengambil data file json
    $fileDataMahasiswa = "data/data_mahasiswa.json";
    $isiDataMahasiswa = file_get_contents($fileDataMahasiswa);

    $daftarMahasiswa = array();
    // mengubah data karyawan menjadi ke array associative
    $daftarMahasiswa = json_decode($isiDataMahasiswa, true);

    if(isset($_POST['btnSimpan'])) { // jika btnSimpan di klik

        // get data dari post
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $jurusan = $_POST['jurusan'];
        $mataKuliah = $_POST['mataKuliah'];
        $nilai = $_POST['nilai'];
        $nilaiMutu = hitungNilai($nilai);
        $lulus = kelulusan($nilai);
        
        // data karyawan yang diinput ke dalam array
        $dataMahasiswa = array(
            "nim" => $nim,
            "nama" => $nama,
            "jenisKelamin" => $jenisKelamin,
            "jurusan" => $jurusan,
            "mataKuliah" => $mataKuliah,
            "nilai" => $nilai,
            "nilaiMutu" => $nilaiMutu,
            "lulus" => $lulus
        );

        // memasukkan array data karyawan yang baru, ke daftar karyawan sebelumnya
        array_push($daftarMahasiswa, $dataMahasiswa);

        // mengubah array data karyawan ke json format
        $dataYangInginDitulisKeFile = json_encode($daftarMahasiswa, JSON_PRETTY_PRINT);

        // tulis ke file data ke json
        file_put_contents($fileDataMahasiswa, $dataYangInginDitulisKeFile);
    }

    function hitungNilai($nilai) {
        if ($nilai > 90 ) {
            return "A";
        }else if($nilai > 80 ) {
            return "B";
        }else if($nilai > 70 ) {
            return "C";
        }else if($nilai > 60 ) {
            return "D";
        }else {
            return "E" ;
        }
    }

    function kelulusan($nilai) {
        if ($nilai > 71 ) {
            return "Lulus";
        }else {
            return "Tidak Lulus";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Akhir VSGA G5 - JWD C</title>

    <!-- Memanggil CSS Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        .container {
            max-width: 700px; /* mengurangi lebar tertinggi container */
            margin: 0 auto;
            padding: 15px; /* mengurangi padding container */
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        body {
            font-family: 'Times New Roman', Times, serif;/* mengubah jenis huruf menjadi times new roman */
        }

        img {
            width: 100px;
            height: 100px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
        }

        h4 {
            font-family: 'Playfair Display', serif;
            text-align: center;
            background-color: #70c0d7;
        }
             
        ::placeholder  {
            font-size: 20px;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">  
        <div class="container" style="background-color:white">
            <h1 class="navbar-brand" style="font-size:40px">
                <img src="img/download.png" class="d-inline-block align-text-bot">
                Tugas Akhir VSGA G5 - JWD C
            </h1>
        </div>
    </nav>
    <!-- / Navbar -->

    <!-- Content -->
    <div class="container">
        <h4>Form Mahasiswa</h4>
        <form action="#" method="post" class="row g-3">
            <div class="col-md-5">
                <label for="nim" class="form-label">NIM</label>
                <input type="number" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM Anda" required>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Anda" required>
            </div>
            <div class="col-md-5">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="nomorTelpon" class="form-label">Nomor Telepon</label>
                <input type="integer" name="nomorTelpon" id="nomorTelpon" class="form-control" placeholder="Masukkan No. Telpon Anda" required>
            </div>
            <div class="col-md-5">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenisKelamin" id="jenisKelamin" class="form-select" required>
                    <?php
                    // menampilkan isi array kedalam combobox
                    foreach($daftarJenisKelamin as $djk) {
                        echo "<option value='$djk'> $djk </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="email" class="form-label">Gmail</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="col-md-5">
                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempatLahir" id="tempatLahir" class="form-control" placeholder="Masukkan Tempat Lahir Anda" required>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="jurusan" class="form-label">Jurusan</label>
                 <select name="jurusan" id="jurusan" class="form-select" placeholder="Masukkan Jurusan Anda" required>
                    <?php
                    // menampilkan isi array kedalam combobox
                    foreach($daftarJurusan as $dj) {
                        echo "<option value='$dj'> $dj </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-5">
                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" id="tanggalLahir" class="form-control" required>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="mataKuliah" class="form-label">Mata Kuliah</label>
                <select name="mataKuliah" id="mataKuliah" class="form-select" >
                    <?php
                    // menampilkan isi array kedalam combobox
                    foreach($daftarMataKuliah as $dmk) {
                        echo "<option value='$dmk'> $dmk </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-5">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" id="agama" class="form-select" required>
                    <?php
                    // menampilkan isi array kedalam combobox
                    foreach($daftarAgama as $da) {
                        echo "<option value='$da'> $da </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="text" name="nilai" id="nilai" class="form-control" placeholder="Masukkan Nilai Anda" required>
            </div>
            <div class="mb-3">
                    <button type="submit" class="col-md-3 btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
                </div>
            </form>
        </div>
        <br>
        <div class="container">
            <h4>Daftar Mahasiswa</h4>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Jenis Kelamin</td>
                        <td>Jurusan</td>
                        <td>Mata Kuliah</td>
                        <td>Nilai</td>
                        <td>NH</td>
                        <td>KET</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($daftarMahasiswa as $mahasiswa) {
                        echo "<tr>";
                        echo "<td>". $mahasiswa['nim']. "</td>";
                        echo "<td>". $mahasiswa['nama']. "</td>";
                        echo "<td>". $mahasiswa['jenisKelamin']. "</td>";
                        echo "<td>". $mahasiswa['jurusan']. "</td>";
                        echo "<td>". $mahasiswa['mataKuliah']. "</td>";
                        echo "<td>". $mahasiswa['nilai']. "</td>";
                        echo "<td>". $mahasiswa['nilaiMutu']. "</td>";
                        echo "<td>". $mahasiswa['lulus']. "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    <!-- / Content -->

    <!-- Memanggil JS Bootstrap-->
    <script src="js/bootstrap.js"></script>
</body>
</html>