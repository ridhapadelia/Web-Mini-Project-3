<?php

@include 'config.php';

        session_start();

        if(!isset($_SESSION['admin_name'])){
        header('location:login_form.php');
        }

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

   <div class="section">
      <div class="container1">
         <h3>Edit Buku</h3>
         <div class="box">
            <form action="" method="POST" enctype="multipart/form-data"> 
                <select class="input-control" name="kategori" required>
                    <option value="">--Pilih--</option>
                    <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while($r = mysqli_fetch_array($kategori)){
                    ?>
                    <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
                    <?php } ?>
                </select>

                <input type="text" name="nama" class="input-control" placeholder="Judul Buku" value="<?php echo $p-> book_title ?>" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p-> books_price ?>" required>
                <img src="produk/<?php echo $p->books_image ?>"width="100px">
                <input type="hidden" name="foto" value="<?php echo $p->books_image ?>">
                <input type="file" name="gambar" class="input-control">
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p-> books_description ?></textarea>
                <select class="input-control" name="status">
                <option value="">--Pilih--</option>
                <option value="1" <?php echo ($p->books_status == 1)? 'selected':''; ?>>Aktif</option>
                <option value="0" <?php echo ($p->books_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                </select>
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){
                  // data inputan dari form
                  $kategori = $_POST['kategori'];
                  $nama = $_POST['nama'];
                  $harga = $_POST['harga'];
                  $deskripsi = $_POST['deskripsi'];
                  $status = $_POST['status'];
                  $foto = $_POST['foto'];

                  // data gambar yang baru
                  $filename = $_FILES['gambar']['name'];
                  $tmp_name = $_FILES['gambar']['tmp_name'];


                  // jika admin ganti gambar
                  if($filename != ''){
                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];
  
                    $newname = 'produk'.time().'.'.$type2;
  
                    // menampung data format file yang diizinkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    // validasi format file
                    if(!in_array($type2, $tipe_diizinkan)){
                            // jika format file tidak ada di dalam tipe diizinkan
                            echo '<script>alert("Format file tidak didukung")</script>';
                    }else{
                        unlink('./produk/' .$foto);
                        move_uploaded_file($tmp_name, './produk/'.$newname);
                        $namagambar = $newname;
                    }

                  }else{
                    // jika admin tidak ganti gambar
                    $namagambar = $foto;
                  }

                  // query update data buku
                  $update = mysqli_query($conn, "UPDATE tb_books SET 
                                            category_id = '".$kategori."',
                                            book_title = '".$nama."',
                                            books_price = '".$harga."',
                                            books_description = '".$deskripsi."',
                                            books_image = '".$namagambar."', 
                                            books_status = '".$status."'
                                            WHERE books_id = '".$p->books_id."' ");
                if($update){
                    echo '<script>alert("Ubah data berhasil")</script>';
                }else{
                    echo 'gagal'.mysqli_error($sconn);
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