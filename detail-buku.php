<?php
    error_reporting(0);
    include 'config.php';
    $books = mysqli_query($conn, "SELECT * FROM tb_books WHERE books_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($books);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BookStore</title>
   <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    
   <!-- detail produk -->
   <div class="detailbuku">
        <h3>Detail Buku</h3>
        <div class="box">
            <div class="col-6">
                <img src="produk/<?php echo $p->books_image ?>" width="100%">
            </div>
            <div class="col-6">
                <h3><?php echo $p->book_title ?></h3>
                <h4>Rp. <?php echo number_format($p->books_price) ?></h4>
                <p>Deskripsi :<br>
                    <?php echo $p->books_description?>
                </p>
                <p><a href="https://api.whatsapp.com/send?phone=6285161027716&text=Hai%20Saya%20ingin%20memesan%20buku%20ini" target="_blank">Pesan Buku</a></p>
            </div>
        </div>
    </div>

   <div class="footer">
    <div class="container1">
        <h4>Alamat</h4>
        <p>Jl. M. Yamin, Samarinda</p>
        <h4>Email</h4>
        <p>TokoBuku@gmail.com</p>
        <h4>No. HP</h4>
        <p>+6285789769876</p>
        <small>Copyright &copy; 2020 - RynBooks.</small>
    </div>
   </div>
</body>
</html>