<?php   
    session_start();

    if (!isset($_SESSION['login'])) {
        if ($_SESSION['login'] != true) {
            header("Location: login.php");
            exit;
        }
    }

    $mysqli = new mysqli('localhost', 'root', '', 'education');
   
   $result = $mysqli->query("SELECT riwayat_pendidikan.id, riwayat_pendidikan.nama_mahasiswa, riwayat_pendidikan.nama_institusi, riwayat_pendidikan.tahun_masuk, riwayat_pendidikan.tahun_keluar  
   FROM riwayat_pendidikan");
    
   $education = [];

    while ($row = $result->fetch_assoc()) {
        array_push($education, $row);
    }

    $no = 1
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat-Pendidikan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container"> 
    <br>
    <h1 class="text-center"> Data Riwayat Pendidikan </h1>
    <?php if (isset($_SESSION['success']) && $_SESSION['success'] == true ) { ?>
       <div class="alert alert-danger text-center" role="alert">
            <?= $_SESSION['message'] ?>
       </div>
    <?php } ?>
    <a href="create.php" class="btn btn-primary"> Tambah </a> 
    <a href="logout.php" class="btn btn-warning"> Logout </a> 
    <br><br>
    <table class="table table-bordered table-hover">
        <tr style="background-color: RosyBrown">
            <th class ="text-center"> No </th>
            <th class ="text-center"> Nama Mahasiswa </th>
            <th class ="text-center"> Nama Institusi </th>
            <th class ="text-center"> Tahun Masuk </th>
            <th class ="text-center"> Tahun Keluar </th>
            <th class ="text-center"> Edit </th>
        </tr>
        <?php foreach ($education as $row ) { ?>
            <tr>
                <td class ="text-center"><?= $no++; ?></td>
                <td><?= $row['nama_mahasiswa']; ?></td>
                <td><?= $row['nama_institusi']; ?></td>
                <td class ="text-center"><?= $row['tahun_masuk']; ?></td>
                <td class ="text-center"><?= $row['tahun_keluar']; ?></td>
                <td class ="text-center">
                    <a href="update.php?id=<?=$row['id']?>" class="btn btn-success">Edit</a>
                    <a href="delete.php?id=<?=$row['id']?>" class="btn btn-danger" onclick="return confirm('Yakin data ini akan dihapus?')">Delete</a>
                </td>
        </tr>
        <?php } ?>
    </table>  
    </div> 
    
</body>
</html>

<?php
unset($_SESSION['success']);
unset($_SESSION['message']);

?>
