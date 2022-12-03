<?php 
require "koneksi.php";
session_start();
 
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}
 
$email = $_SESSION["email"];
$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
$data = [];
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}
foreach ($data as $user);
$id_user = $user["id_user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>my orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p><a href="home.html">home </a> <span> / orders</span></p>
</div>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
   <?php
         $result = mysqli_query($conn, "SELECT pesanan.waktu, pesanan.status, pesanan.hp, pesanan.jumlah, pesanan.tujuan, pesanan.jumlah, user.username, menu.nama, menu.harga 
                              FROM pesanan JOIN menu ON (pesanan.id_menu=menu.id_menu) JOIN user USING(id_user) where id_user = '$id_user'");
         while ($row = mysqli_fetch_assoc($result)) {?>
      <div class="box">
         <p> waktu : <span><?php echo$row['waktu']?></span> </p>
         <p> nama : <span><?php echo$row['username']?></span> </p>
         <p> nomor : <span><?php echo$row['hp']?></span> </p>
         <p> jumlah : <span><?php echo$row['jumlah']?></span> </p>
         <p> alamat : <span><?php echo$row['tujuan']?></span> </p>
         <p> pesanan anda : <span><?php echo$row['nama']?> -</span> </p>
         <p> harga : <span>Rp <?php echo($row['jumlah']*$row['harga'])?>/-</span> </p>
         <p> status : <span><?php echo$row['status']?>/-</span> </p>
      </div>
   <?php }?>
   </div>

</section>

<?php include 'footer.php'; ?>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>