<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

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
         <h1><a href="adminpage.php">BookStore</a></h1>
         <ul>
            <li><a href="adminpage.php">AdminPage</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="category.php">Kategori</a></li>
            <li><a href="data-buku.php">Produk</a></li>
            <li><a href="logout.php">Keluar</a></li>
         </ul>
      </div>
   </header>

   <div class="section">
      <div class="container1">
         <h3>Data Kategori</h3>
         <div class="box">
            <p><a href="add-category.php">Tambah Kategori</a></p>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $kategori =mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while($row = mysqli_fetch_array($kategori)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td>
                            <a href="edit-category.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="delete-category.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
   </div>
   <footer>
      <div class="container1">
         <small>Copyright &copy; 2020 - BookStore.</small>
      </div>
   </footer>
</body>
</html>