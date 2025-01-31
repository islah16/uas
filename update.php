<?php
    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'education');

    $id = $_GET['id'];
    $sql = $mysqli->query("SELECT * FROM riwayat_pendidikan WHERE id='$id'");
    $data = $sql->fetch_assoc();     
    
    if (isset($_POST['nama_mahasiswa'])) {
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $nama_institusi = $_POST['nama_institusi'];
        $tahun_masuk = $_POST['tahun_masuk'];
        $tahun_keluar = $_POST['tahun_keluar'];
       
        $update = $mysqli->query("UPDATE riwayat_pendidikan SET nama_mahasiswa='$nama_mahasiswa', nama_institusi='$nama_institusi', tahun_masuk=$tahun_masuk, tahun_keluar=$tahun_keluar WHERE id=$id");

        if($update) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Data Berhasil Diubah';
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
    <title>Form Riwayat Pendidikan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class ="container">
    <br>
    <h1 class="text-center" style="color:RosyBrown">Update Riwayat Pendidikan</h1>
    <br>
    <form method ="POST">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label" style="color:RosyBrown"> id </label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="id" name="id" value="<?= $data['id']?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_mahasiswa" class="col-sm-2 col-form-label" style="color:RosyBrown"> Nama Mahasiswa</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"value="<?= $data['nama_mahasiswa']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama_institusi" class="col-sm-2 col-form-label" style="color:RosyBrown"> Nama Institusi</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" value="<?= $data['nama_institusi']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tahun_masuk" class="col-sm-2 col-form-label" style="color:RosyBrown"> Tahun Masuk </label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" value="<?= $data['tahun_masuk']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tahun_keluar" class="col-sm-2 col-form-label" style="color:RosyBrown"> Tahun Keluar </label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="tahun_keluar" name="tahun_keluar" value="<?= $data['tahun_keluar']?>">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-secondary">Sumbit</button>
            <a href="index.php" class="btn btn-link" style="color:black" >Cancel</a>
        </div>
    </form>   
</body>
</html>