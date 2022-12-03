<?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header("Location: index.php");
  }

    require 'koneksi.php';
    $email = $_SESSION["email"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    $data = [];
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    foreach ($data as $user);
    $id_user = $user["id_user"];

    $id_menu = $_GET["id"];
    $result = mysqli_query( $conn, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
    $data_menu = [];
    while ($row = mysqli_fetch_array($result)) {
        $data_menu[] = $row;
    }
    foreach ($data_menu as $menu);

    if (isset($_POST["pesan"])){
        $jumlah = $_POST['jumlah'];
        $waktu = $_POST['waktu'];
        $tujuan = $_POST["alamat"];
        $status = "menunggu";
        $hp = $_POST['hp'];

        $sql = "INSERT INTO pesanan 
                VALUES( '0', 
                        '$id_user', 
                        '$id_menu', 
                        '$tujuan', 
                        '$hp', 
                        '$jumlah', 
                        '$waktu', 
                        '$status')";
        $result = mysqli_query($conn, $sql);
        if ( $result ) {
            echo"
                <script>
                    alert('Pesanan berhasil ditambah');
                    document.location.href = 'orders.php';
                </script>
            ";
        }else{
            echo"
                <script>
                    alert('Pesanan gagal ditambah');
                    document.location.href = 'orders.php';
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
    <title>Pesan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

  <section class="form-container">
    <!-- main content -->
    <form action="" method="post">
      <h3>Detail Pesanan</h3>
      <input name="menu" type="text" value="<?php echo $menu['nama'] ?>" class="box" readonly>
      <input type="number" required  name="jumlah" placeholder="masukkan jumlah pesanan " class="box" >
      <input type="number" required maxlength="16" name="hp" placeholder="masukkan kontak"  class="box">
      <input type="datetime-local" required maxlength="50" name="waktu" placeholder="masukkan waktu" class="box" >
      <input type="text" required  name="alamat" value="<?php echo $user['alamat'] ?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Pesan" class="btn" name="pesan">
   </form>
  </section>

  <?php include 'footer.php'; ?>
    <script src="../scriptorder.js"></script>
</body>
</html>
