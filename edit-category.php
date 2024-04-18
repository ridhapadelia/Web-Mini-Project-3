<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
if(mysqli_num_rows($kategori) == 0){
    echo '<script>window.location="category.php"</script>';
}
$k = mysqli_fetch_object($kategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BookStore</title>
   <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css">
</head>
<body>

   <header>
      <div class="container1">
         <h1><a href="adminpage.php">RynBooks</a></h1>
         <ul>
            <li><a href="adminpage.php">AdminPage</a></li>
            <li><a href="category.php">Kategori</a></li>
            <li><a href="data-produk.php">Produk</a></li>
            <li><a href="logout.php">Keluar</a></li>
         </ul>
      </div>
   </header>

   <div class="section">
      <div class="container1">
         <h3>Edit Kategori</h3>
         <div class="box">
            <form action="" method="POST"> 
                <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->category_name ?>" required>
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);
                    $update = mysqli_query($conn, "UPDATE tb_category SET 
                                            category_name = '".$nama."'
                                            WHERE category_id= '".$k->category_id."'");

                    if($update){
                        echo '<script>alert("Edit data berhasil!")</script>';
                        echo '<script>window.location="category.php"</script>';
                    }else{
                        echo 'gagal' .mysqli_error($conn);
                    }
                }
            ?>
         </div>
   </div>


   <footer>
      <div class="container1">
         <small>Copyright &copy; 2020 - RynBooks.</small>
      </div>
   </footer>
</body>
</html>