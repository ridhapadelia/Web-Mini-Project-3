<?php
    include 'config.php';

    session_start();

    if(!isset($_SESSION['user_name'])){
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
         <h1><a href="index.php">RynBooks</a></h1>
         <ul>
            <li><a href="buku.php">Buku</a></li>
            <li><a href="#genre">Genre</a></li>   
            <li><a href="#detailbuku">Buku Best Seller</a></li>   
            <li><a href="#footer">Contact</a></li>   
            <li><a href="logout.php">Logout</a></li>
         </ul>
      </div>
   </header>

   <!-- search -->
   <div class="search">
            <form action="buku.php">
                <input type="text" name="search" placeholder="Cari Buku">
                <input type="submit" name="cari" value="Cari Buku">
            </form>
        </div>
   </div>

   <div class="genre" id="genre">
        <div class="main"> 
            <h3>Genre</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="buku.php?kat=<?php echo $k['category_id'] ?>"> 
                        <div class ="col-5">
                            <img src="img/icon1category.png" width="50px" style="margin-bottom:5px;">
                            <p><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Genre tidak ada</p>
                <?php } ?>
            </div>
        </div>
   </div>

   <!-- new buku -->
   <div class="detailbuku" id="detailbuku">
        <div class="main"> 
            <h3>Buku Best Seller</h3>
                <?php
                    $books = mysqli_query($conn, "SELECT * FROM tb_books WHERE books_id = 12 ORDER BY books_id DESC LIMIT 1");
                    if(mysqli_num_rows($books) > 0){
                        while($p = mysqli_fetch_array($books)){
                ?>
                    <a href="detail-buku.php?id=<?php echo $p['books_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['books_image'] ?>" width="300">
                            <p class="nama"><?php echo substr($p['book_title'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['books_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Buku Tidak ada</p>
                <?php } ?>
            </div>
        </div>
   </div>   


   <div class="footer" id="footer">
    <div class="container1">
        <h4>Alamat</h4>
        <p>Jl. M. Yamin, Samarinda</p>
        <h4>Email</h4>
        <p>TokoBuku@gmail.com</p>
        <h4>No. HP</h4>
        <p>+6285789769876</p>
        <small>Copyright &copy; 2020 - BookStore.</small>
    </div>
   </div>
</body>
</html>