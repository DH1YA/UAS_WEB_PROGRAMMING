<?php
include '../koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT pesanan.id_pesanan,pesanan.id_user, pesanan.id_menu, pesanan.waktu, pesanan.status, pesanan.hp, pesanan.jumlah, pesanan.tujuan, pesanan.jumlah, user.username, menu.nama, menu.harga 
                        FROM pesanan JOIN menu ON (pesanan.id_menu=menu.id_menu) JOIN user USING(id_user) WHERE pesanan.id_pesanan = '$id'");

$pesanan_awal = [];

while ($row = mysqli_fetch_assoc($result)) {
    $pesanan_awal[] = $row;
}




if (isset($_POST["Update"])) {
  $jumlah = $_POST['jumlah'];
  $waktu = $_POST['waktu'];
  $tujuan = $_POST["alamat"];
  $status = "menunggu";
  $hp = $_POST['hp'];
  $status = $_POST['status'];

    $sql = "UPDATE pesanan SET
            jumlah = '$jumlah',
            waktu = '$waktu',
            tujuan = '$tujuan',
            jumlah = '$jumlah',
            hp = '$hp',
            status = '$status'
            WHERE id_pesanan = $id";

    $result = mysqli_query($conn, $sql);

    if ( $result ) {
        echo"
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'tampilkan.php';
            </script>
        ";
    }else{
        echo"
            <script>
                alert('Data gagal diubah');
                document.location.href = 'edit.php';
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
    <title>Edit Data</title>
    <link rel="stylesheet" href="crud-style.css">
</head>
<body>
     <!-- formulir pemesann -->
     <?php include "crud-header.php"; ?>

<section class="add-products">
<?php foreach ($pesanan_awal as $psn)?>
<form action="" method="post">
      <h3>Detail Pesanan</h3>
      <input name="menu" type="text" value="<?php echo $psn['nama'] ?>" class="box" readonly>
      <input type="number" required  name="jumlah" placeholder="masukkan jumlah pesanan " value="<?php echo $psn['jumlah'] ?>" class="box" >
      <input type="number" required maxlength="16" name="hp" placeholder="masukkan kontak" value="<?php echo $psn['hp'] ?>" class="box">
      <input type="datetime-local" required maxlength="50" name="waktu" placeholder="masukkan waktu" value="<?php echo $psn['waktu'] ?>" class="box" >
      <input type="text"  name="alamat" placeholder="alamat" value="<?php echo $psn['tujuan'] ?>" class="box">
      <input type="text"  name="status" placeholder="status" value="<?php echo $psn['status'] ?>" class="box">
      
      <input type="submit" value="Update" class="btn" name="Update">
   </form>

</section>
<?php include "crud-footer.php"; ?>
</body>
</html>