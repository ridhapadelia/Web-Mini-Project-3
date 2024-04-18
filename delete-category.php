<?php

@include 'config.php';
    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="category.php"</script>';
    }

    if(isset($_GET['idp'])){
        $books = mysqli_query($conn, "SELECT books_image FROM tb_books WHERE books_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($books);

        unlink('./produk/'.$p->books_image);

        $delete = mysqli_query($conn, "DELETE FROM tb_books WHERE books_id = '".$_GET['idp']."' ");
        echo '<script>window.location="data-buku.php"</script>';
    }




?>