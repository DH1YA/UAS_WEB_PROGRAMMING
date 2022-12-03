<?php
include "koneksi.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['pass'];
   $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

      if (mysqli_num_rows($result) === 1){
         $row = mysqli_fetch_assoc($result);
         $level = $row['role'];
         if (password_verify($pass, $row['password']) && $email == $row['email']){
             if ($level == 'admin'){
               $_SESSION['email_admin'] = $email;
               header('Location: crud/tampilkan.php');
               exit();
             } 
             else{
               $_SESSION['email'] = $email;
               header('Location: home.php');
               exit();
             }
         } else {
             echo "<script>
                 alert('email atau password salah');
             </script>";
         }
     }
     else {
         echo "<script>
             alert('email atau password salah');
         </script>";
     }
 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

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
      <h3>login now</h3>
      <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box">
      <input type="password" required maxlength="20" name="pass" placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>




<div id="main">
   <div class="konten">
     <h1>Nikmatnya Cita Rasa Nusantara</h1>
     <h2>Tanpa repot dan cukup menunggu</h2>
   </div>
 </div>

 <div class="paketan">
   <p class="section-title">Dengan Pelayanan Terbaik</p>
   <div class="container">
     <div class="jenis-paketan">
       <img src="images/chef.jpg" alt="">
       <p>Tenaga Ahli</p>
     </div>
     <div class="jenis-paketan">
       <img src="images/aneka menu.jpg">
       <p>Aneka Menu</p>
     </div>
     <div class="jenis-paketan">
       <img src="images/mobil.jpg">
       <p>Pengiriman aman</p>
     </div>
     <div class="jenis-paketan">
       <img src="images/bersih.jpg">
       <p>Kebersihan Terjaga</p>
     </div>
   </div>
 </div>

 <?php include 'footer.php'; ?>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>