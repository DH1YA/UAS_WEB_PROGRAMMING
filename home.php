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
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Masakan Favorit</span>
               <h3>RENDANG SAPI</h3>
               <a href="menu.php" class="btn">lihat menu</a>
            </div>
            <div class="image">
               <img src="images/rendang.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Masakan Favorit</span>
               <h3>AYAM BAKAR</h3>
               <a href="menu.php" class="btn">lihat menu</a>
            </div>
            <div class="image">
               <img src="images/ayambakar.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Masakan Favorit</span>
               <h3>BAKSO DAGING</h3>
               <a href="menu.php" class="btn">lihat menu</a>
            </div>
            <div class="image">
               <img src="images/bakso.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>


<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
            $result = mysqli_query($conn, "SELECT * FROM menu LIMIT 6");
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


   <div class="more-btn">
      <a href="menu.php" class="btn">veiw all</a>
   </div>

</section>


<?php include 'footer.php'; ?>



<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   grabCursor:true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>