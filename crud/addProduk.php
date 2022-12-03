<?php 
require '../koneksi.php';

if(isset($_POST['add_product'])){

   $nama = $_POST['nama'];
   $nama = filter_var($nama, FILTER_SANITIZE_STRING);
   $harga = $_POST['harga'];
   $deskripsi = $_POST['deskripsi'];



   $gambar = $_FILES['gambar']['name'];
   $gambar = filter_var($gambar, FILTER_SANITIZE_STRING);
   $x = explode('.', $gambar);
   $extensi = strtolower(end($x));
   $gambar_baru = "$nama.$extensi";
   $tmp = $_FILES['gambar']['tmp_name'];
   $image_folder = 'upload_img/'.$gambar_baru;

    

   if (move_uploaded_file($tmp, $image_folder)) {
      $result = mysqli_query($conn, "INSERT INTO menu VALUES ('0','$nama','$gambar_baru','$harga','$deskripsi')");
      if ($result) {
          echo"
              <script>
                  alert('File berhasil diupload');
                  href.location = 'read_file.php';
              </script>
          ";
      }else{
          echo"
              <script>
                  alert('File gagal diupload');
              </script>
          ";
      }
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tambah produk</title>
  <link rel="stylesheet" href="crud-style.css">
</head>
<body>
<?php include "crud-header.php"; ?>

<!--   tambah produk  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Tambah produk</h3>
      <input type="text" required placeholder="masukkan nama produk" name="nama" maxlength="100" class="box">
      <input type="file" name="gambar" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="number" required placeholder="harga" name="harga" class="box">
      <textarea name="deskripsi" id="" cols="30" rows="10" placeholder="Deskripsi menu" class="box"></textarea>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<!-- tambah produk -->
</body>
</html>