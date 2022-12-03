<?php 
require "koneksi.php";
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="search-form">
   <form action="" method="get">
      <input type="text" class="box" name="keyword" placeholder="search here..." maxlength="100">
      <button type="submit" class="fas fa-search" name="search"></button>
   </form>
</section>

<!-- show products   -->

<?php
   $result = mysqli_query($conn, "SELECT * FROM menu");
   if (isset($_GET['search'])) {
    $keyword=$_GET['keyword'];
    $result = mysqli_query($conn, "SELECT * FROM menu where 
    nama LIKE '%$keyword%' OR harga LIKE '%$keyword%' OR foto LIKE '%$keyword%'");
    } 
    if (mysqli_num_rows($result) === 0){
      echo "<p
        style='
            color: #ffffff;
            font-size: 24px;
            width: 100%;
        '> 
        Oops, Menu Tidak Ditemukan </p>";
    }
?>

<section class="products">
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
<!-- show products  -->



<?php include 'footer.php'; ?>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>