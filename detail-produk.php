<?php
require 'koneksi.php';
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu = $id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        foreach ($data as $menu)
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $menu['nama']?>
  </title>
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="style-detail.css">
</head>

<body>
  <?php include 'header.php'; ?>

  <!-- detail menu -->
  <!-- <div class = "main-wrapper"> -->
  <div class="container">
    <div class="product-div">
      <div class="product-div-left">
        <div class="img-container">
          <img src="crud/upload_img/<?php echo $menu['foto'];?>" alt="menu">
        </div>
      </div>
      <div class="product-div-right">
        <span class="product-name">
          <?php echo $menu['nama'];?>
        </span>
        <span class="product-price">Rp
          <?php echo number_format($menu['harga'],0,'.','.');?>
        </span>
        <span class="product-description">Deskripsi :
          <?php echo $menu['deskripsi'];?>
        </span>
        <a href="tambah-pesanan.php?id=<?php echo $menu['id_menu'] ?>" class="btn-produk">Beli Sekarang</a>
      </div>
    </div>
  </div>
  <!-- detail menu -->

  <?php include 'footer.php'; ?>


  <div class="loader">
    <img src="images/loader.gif" alt="">
  </div>

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <script src="js/script.js"></script>

  <script>
</body >
</html >