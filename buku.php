<?php
    error_reporting(0);
    include 'config.php';
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
         <h1><a href="index.php">RynBooks</a></h1>
         <ul>
            <li><a href="buku.php">Buku</a></li>
            <li><a href="logout.php">Keluar</a></li>
         </ul>
      </div>
   </header>

   <!-- search -->
   <div class="search">
            <form action="buku.php">
                <input type="text" name="search" placeholder="Cari Buku" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Buku">
            </form>
        </div>
   </div>

   <!-- new buku -->
   <div class="buku">
    <h3>Buku</h3>
    <div class="box">
        <?php
            if($_GET['search'] != '' || $_GET['kat'] != ''){
                $where = "AND book_title LIKE '%".$_GET['search']."%' AND books_id LIKE '%".$_GET['kat']."%' ";
            }
            $books = mysqli_query($conn, "SELECT * FROM tb_books WHERE books_status = 1 $where ORDER BY books_id DESC");
            if(mysqli_num_rows($books) > 0){
                while($p = mysqli_fetch_array($books)){
        ?>
            <a href="detail-buku.php?id=<?php echo $p['books_id'] ?>" class="item">
                <img src="produk/<?php echo $p['books_image'] ?>" width="300">
                <p class="nama"><?php echo substr($p['book_title'], 0, 30) ?></p>
                <p class="harga">Rp. <?php echo number_format($p['books_price']) ?></p>
            </a>
        <?php }}else{ ?>
            <p>Buku Tidak ada</p>
        <?php } ?>
    </div>
</div>


   <div class="footer">
    <div class="container1"></div>
        <h4>Alamat</h4>
        <p>Jl. M. Yamin, Samarinda</p>
        <h4>Email</h4>
        <p>TokoBuku@gmail.com</p>
        <h4>No. HP</h4>
        <p>+6285789769876</p>
        <small>Copyright &copy; 2024 - RynBooks.</small>
    </div>
   </div>
</body>
</html>