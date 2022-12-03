<?php
require '../koneksi.php';
if(isset($_GET['delete'])){

   $id = $_GET['delete'];

   $result = mysqli_query($conn, "DELETE FROM menu WHERE id_menu = $id");
   
   if ( $result ) {
       echo"
           <script>
               alert('Data berhasil dihapus');
               document.location.href = 'produk.php';
           </script>
       ";
   }else{  
       echo"
           <script>
               alert('Data gagal dihapus');
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
   <title>products</title>
   <link rel="stylesheet" href="crud-style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
    .search {
  width: 100%;
  position: fixed;
  display: flex;
  }

  .searchTerm {
    width: 100%;
    border: 3px solid #04AA6D;
    border-right: none;
    padding: 5px;
    height: 40px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #9DBFAF;
  }

  .searchTerm:focus{
    color: #04AA6D;
  }

  .searchButton {
    width: 40px;
    height: 40px;
    border: 1px solid #04AA6D;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
  }
  .button1 {background: #04AA6D;} 
  .button2 {background: #008CBA;} 

  .wrap{
    width: 30%;
    padding:70px 0 0 0;
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

    .tabel-produk {
      margin:90px auto;
      height:40rem;
    }

    table {
      font-size:20px;
      border-collapse: collapse;
      width: 100%;
      border:2px solid;
    }
    
    th {
    background-color: #04AA6D;
    color: white;
    height:70px;
     }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {background-color: #f2f2f2;}
    tr:hover {background-color: coral;}
</style>
</head>
<body>
<?php include "crud-header.php"; ?>

<!-- search bar -->
<form action="" method="GET">
<div class="wrap">
<div class="search">
    <input type="text" class="searchTerm" name="keyword" placeholder="Cari di sini...">
    <button type="submit" class="searchButton button1" name="search">
    <i class='fas fa-search' ></i>
    </button><button type="submit" class="searchButton button2" name="all">All</button>
</div>
</div>    
</form>
<!-- search bar -->

<!-- show products   -->
<?php
   $result = mysqli_query($conn, "SELECT * FROM menu");
   if (isset($_GET['search'])) {
    $keyword=$_GET['keyword'];
    $result = mysqli_query($conn, "SELECT * FROM menu where 
    nama LIKE '%$keyword%' OR harga LIKE '%$keyword%' OR foto LIKE '%$keyword%'");
    if (mysqli_num_rows($result) === 0){
      echo "<p
        style='
            color: #ffffff;
            font-size: 24px;
            width: 100%;
        '> 
        Oops, Menu Tidak Ditemukan </p>";}
    }
   if (isset($_GET['all'])) {
        $result = mysqli_query($conn, "SELECT * FROM menu");
    } 
   $produk = [];

   while ($row = mysqli_fetch_assoc($result)) {
      $produk[] = $row;
   }
?>
<section class="show-products" style="padding-top: 0;">

<div class="tabel-produk">
  <table border=1px>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>DESKRIPSI</th>
            <th>FOTO</th>
            <th>UTAK ATIK</th>
    
        </tr>
        <?php $i = 1; foreach ($produk as $menu):?>
        <tr>
            <td><?php echo $i ;?></td>
            <td><?php echo $menu["nama"]; ?></td>
            <td>Rp <?php echo $menu["harga"] ;?></td>
            <td><?php echo $menu["deskripsi"] ;?></td>
            <td><img src="upload_img/<?= $menu['foto'] ?>" width="50px" height="50px"></td>
            <td><a href="edit-produk.php?update=<?php echo $menu["id_menu"]; ?>">Edit</a> 
                <a href="produk.php?delete=<?php echo $menu["id_menu"]; ?>" onclick = "return confirm('And yakin ingin menghapus data ini ?')">Hapus</a></td>
        </tr>
        <?php $i++; endforeach;?>
    </table>
  </div>

</section>

<!-- show products  -->









</body>
</html>