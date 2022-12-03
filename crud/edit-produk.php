<?php
include '../koneksi.php';
$id = $_GET['update'];

$result = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu=$id");

$menu = [];

while ($row = mysqli_fetch_assoc($result)) {
    $menu[] = $row;
}




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

    $sql = "UPDATE menu SET
            nama = '$nama',
            harga = '$harga',
            foto = '$gambar_baru',
            deskripsi = '$deskripsi'
            WHERE id_menu = $id";

    $result = mysqli_query($conn, $sql);

    if ( $result && move_uploaded_file($tmp, $image_folder)) {
        echo"
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'produk.php';
            </script>
        ";
    }else{
        echo"
            <script>
                alert('Data gagal diubah');
                document.location.href = 'produk.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit menu</title>
  <link rel="stylesheet" href="crud-style.css">
</head>
<body>
<?php include "crud-header.php"; ?>

  <section class="add-products">
<?php foreach ($menu as $mn)?>
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>Edit produk</h3>
      <input type="text" required placeholder="masukkan nama produk" value="<?php echo$mn['nama']?>" name="nama" maxlength="100" class="box">
      <input type="file" name="gambar" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="number" required placeholder="harga" value="<?php echo$mn['harga']?>" name="harga" class="box">
      <textarea name="deskripsi" id="" cols="30" rows="10" placeholder="Deskripsi menu" value="<?php echo$mn['deskripsi']?>" class="box"></textarea>
      <input type="submit" value="update product" name="add_product" class="btn">
    </form>

  </section>
  <?php include "crud-footer.php"; ?>
</body>
</html>