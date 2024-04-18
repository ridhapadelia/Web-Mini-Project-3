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
         <h1><a href="adminpage.php">RynBooks</a></h1>
         <ul>
            <li><a href="admin_page.php">AdminPage</a></li>
            <li><a href="category.php">Kategori</a></li>
            <li><a href="data-buku.php">Produk</a></li>
            <li><a href="logout.php">Keluar</a></li>
         </ul>
      </div>
   </header>

   <div class="section">
      <div class="container2">
         <h3>AdminPage</h3>
         <div class="box">
            <h4>Selamat Datang Admin!</h4>
         </div>
   </div>
   <footer>
      <div class="container1">
         <small>Copyright &copy; 2020 - BookStore.</small>
      </div>
   </footer>
</body>
</html>