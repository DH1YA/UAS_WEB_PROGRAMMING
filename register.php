<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<header class="header">

<section class="flex">

   <a href="index.php" class="logo">Nusantara<i>Catering</i></a>

   <div class="icons">
      <div id="user-btn" class="fas fa-user"></div>
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>

   <div class="profile">
      <p class="name">Halo</p>
      <p class="account"><a href="index.php">login</a> or <a href="register.php">register</a></p>
   </div>

</section>

</header>

<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" required maxlength="50" name="username" placeholder="enter your name" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required maxlength="20" name="pass" placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required maxlength="20" name="cpass" placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" required maxlength="16" name="hp" placeholder="enter your number" class="box">
      <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" required  name="alamat" placeholder="enter your address" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>

</section>

<?php
        if (isset($_POST['submit'])){
            $username = $_POST["username"];
            $password = $_POST["pass"];
            $cpassword = $_POST["cpass"];
            $hp = $_POST["hp"];
            $email = $_POST["email"];
            $alamat = $_POST["alamat"];

            if ($password === $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $result = mysqli_query($conn, "SELECT email from user where email = '$email'");
                
                if (mysqli_fetch_assoc($result)){
                    echo "<script>
                        alert('Email Telah Digunakan, Silahkan Gunakan Username Yang Lain');
                    </script>";
                } else {
                    $result = mysqli_query($conn, " INSERT INTO `user` VALUES ('0','$username','$password','$email','$hp','$alamat','user')");
                    if (mysqli_affected_rows($conn) > 0){
                        echo "<script>
                            alert('Registrasi Berhasil');
                            document.location.href = 'index.php';
                        </script>";
                    } else {
                        echo "<script>
                            alert('Registrasi Gagal');
                        </script>";
                    }
                }
            } else {
                echo "<script>
                    alert('Konfirmasi Password Tidak Sesuai');
                </script>";
            }

        }
        
    ?> 


<?php include 'header.php'; ?>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>