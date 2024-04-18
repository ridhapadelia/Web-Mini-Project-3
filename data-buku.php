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
            <li><a href="adminpage.php">AdminPage</a></li>
            <li><a href="category.php">Kategori</a></li>
            <li><a href="data-buku.php">Produk</a></li>
            <li><a href="logout.php">Keluar</a></li>
         </ul>
      </div>
   </header>

   <div class="databuku">
         <h3>Data Buku</h3>
         <div class="box">
            <p><a href="add-buku.php">Tambah Buku</a></p>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th>Judul Buku</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $books =mysqli_query($conn, "SELECT * FROM tb_books LEFT JOIN tb_category USING (category_id) ORDER BY books_id DESC");
                        if(mysqli_num_rows($books) > 0){
                        while($row = mysqli_fetch_array($books)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['book_title'] ?></td>
                        <td><?php echo $row['books_price'] ?></td>
                        <td><a href="produk/<?php echo $row['books_image'] ?>" target="_blank"> <img src="produk/<?php echo $row['books_image'] ?>" width="50px"> </a></td>
                        <td><?php echo $row['books_status'] ?></td>
                        <td>
                            <a href="edit-buku.php?id=<?php echo $row['books_id'] ?>">Edit</a> || <a href="delete-category.php?idp=<?php echo $row['books_id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
   </div>
   <footer>
      <div class="container1">
         <small>Copyright &copy; 2020 - RynBooks.</small>
      </div>
   </footer>
</body>
</html>