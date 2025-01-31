
<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        if ($_SESSION['login'] != true) {
            header("Location: login.php");
            exit;
        }
    }


    $mysqli = new mysqli('localhost', 'root', '', 'education');


    if (isset($_POST['nama_mahasiswa'])) {
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $nama_institusi = $_POST['nama_institusi'];
        $tahun_masuk = $_POST['tahun_masuk'];
        $tahun_keluar = $_POST['tahun_keluar'];

        $insert = $mysqli->query("INSERT INTO riwayat_pendidikan(nama_mahasiswa, nama_institusi, tahun_masuk, tahun_keluar) VALUES ('$nama_mahasiswa','$nama_institusi',$tahun_masuk,$tahun_keluar)");
        if ($insert) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Data Berhasil Ditambahkan';
            header("Location: index.php");
            exit();
        }
    }


?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Form Riwayat Pendidikan </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
        background-color: LavenderBlush;
        }
    </style>
</head>
<body>
    <div class ="container">
    <br>
    <h1 class="text-center" style="color:RosyBrown">Form Tambah Riwayat Pendidikan</h1>
    <br>
    <form method ="POST">
        <div class="row mb-3">
            <label for="nama_mahasiswa" class="col-sm-2 col-form-label" style="color:RosyBrown"> Nama Mahasiswa</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" >
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_institusi" class="col-sm-2 col-form-label" style="color:RosyBrown"> Nama Institusi</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" >
            </div>
        </div>
        <div class="row mb-3">
            <label for="tahun_masuk" class="col-sm-2 col-form-label" style="color:RosyBrown"> Tahun Masuk </label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" >
            </div>
        </div>
        <div class="row mb-3">
            <label for="tahun_keluar" class="col-sm-2 col-form-label" style="color:RosyBrown"> Tahun Keluar </label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="tahun_keluar" name="tahun_keluar" >
            </div>
        </div>
        <div class="mt-3">
                <button type="submit" class="btn btn-secondary">Sumbit</button>
                <a href="index.php" class="btn btn-link" style="color:black" >Cancel</a>
         </div>
    </form>
    
</body>
</html>