<?php
    session_start();
    if (isset($_COOKIE['remember'])) {
        if($_COOKIE['remember'] == 'true') {
            $_SESSION['login'] = true;
        }
    }

    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] == true) {
            header("Location: index.php");
            exit;
        }
    }

   $mysqli = new mysqli('localhost', 'root', '', 'education');
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
        $result = $sql->fetch_assoc();
    
    
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if ($result == null) {
            echo "email tidak terdaftar";
            exit;
        }
        if ($_POST['password'] != $result['password']) {
            echo "password salah";
            exit;
        }
        if ($_POST['email'] == $result['email'] && $_POST['password'] == $result['password']) {
            if (isset($_POST['remember'])) {
                setcookie('remember', 'true', time() + 60);
            }
            $_SESSION['login'] = true; 
            header("Location: index.php");
            exit;    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle w-75">
        <div class="card p-5 bg-bright" style="background-color:LavenderBlush">
            <h1 class="text-center" style="color:RosyBrown"> Login </h1>
            <form method="POST">
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label" style="color:RosyBrown"> Email </label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label" style="color:RosyBrown"> Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                    <label class="form-check-label" for="exampleCheck1" style="color:RosyBrown">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>