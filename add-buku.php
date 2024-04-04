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
         <h3>Tambah Buku</h3>
         <div class="box">
            <form action="" method="POST" enctype="multipart/form-data"> 
                <select class="input-control" name="kategori" required>
                    <option value="">--Pilih--</option>
                    <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while($r = mysqli_fetch_array($kategori)){
                    ?>
                    <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                    <?php } ?>
                </select>

                <input type="text" name="nama" class="input-control" placeholder="Judul Buku" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                <input type="file" name="gambar" class="input-control" required>
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                <select class="input-control" name="status">
                <option value="">--Pilih--</option>
                <option value="1">--Aktif--</option>
                <option value="0">--Tidak Aktif--</option>
                </select>
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){
                   // print r($_FILES['gambar']);
                   // menampung inputan form
                   $kategori = $_POST['kategori'];
                   $nama = $_POST['nama'];
                   $harga = $_POST['harga'];
                   $deskripsi = $_POST['deskripsi'];
                   $status = $_POST['status'];

                   //menampung data file yang diupload 
                   $filename = $_FILES['gambar']['name'];
                   $tmp_name = $_FILES['gambar']['tmp_name'];

                   $type1 = explode('.', $filename);
                   $type2 = $type1[1];

                   $newname = 'produk'.time().'.'.$type2;

                   //menampung data format yang diizinkan
                   $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                   // validasi format file
                   if(!in_array($type2, $tipe_diizinkan)){
                        // jika format file tidak ada di dalam tipe diizinkan
                        echo '<script>alert("Format file tidak didukung")</script>';

                   }else{

                        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan 
                        // proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './produk/'.$newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_books VALUES (
                            null,
                            '".$kategori."',
                            '".$nama."',
                            '".$harga."',
                            '".$deskripsi."',
                            '".$newname."',
                            '".$status."',
                            null
                                ) ");

                        if($insert){
                            echo 'simpan data berhasil';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
                   }
                }
            ?>
         </div>
   </div>


   <footer>
      <div class="container1">
         <small>Copyright &copy; 2020 - BookStore.</small>
      </div>
   </footer>
</body>
</html>