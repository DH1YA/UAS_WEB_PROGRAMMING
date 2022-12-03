<?php 
require 'koneksi.php';
session_start();
 
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>food menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our menu</h3>
   <p><a href="home.php">home </a> <span> / menu</span></p>
</div>

<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

   <?php
         $result = mysqli_query($conn, "SELECT * FROM menu ");
         while ($row = mysqli_fetch_assoc($result)) {?>
      <form accept="" method="post" class="box">
         <a href="detail-produk.php?id=<?php echo $row['id_menu']?>" class="fas fa-eye"></a>
         <a href="tambah-pesanan.php?id=<?php echo $row['id_menu']?>" class="fas fa-shopping-cart"></a>
         <img src="crud/upload_img/<?= $row['foto'] ?>" alt="">
         <div class="name"><?php echo $row['nama']?></div>
         <div class="flex">
            <div class="price"><span>Rp</span><?php echo $row['harga']?><span>/-</span></div>
         </div>
      </form>
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