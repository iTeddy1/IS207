<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <?php require_once("./index.php"); ?>
  <form action="">
    <h1>Thêm xe</h1>
    Mã xe <input type="text" name="ma"> <br>
    Tên xe <input type="text" name="ten">  <br>
    Hãng xe <input type="text" name="hang"> <br>
    Số chỗ <input type="number" name="so_cho"> <br>
    Năm sản xuất <input type="number" name="nam_sx"> <br>
    Đơn giá thuê <input type="text" name="don_gia"> <br>
    <input name="submit" type="submit" value="Thêm">
  </form>
</body>
<?php 
  if(isset($_GET['submit'])) {
    $ma = $_GET['ma'];
    $ten = $_GET['ten'];
    $hang = $_GET['hang'];
    $so_cho = $_GET['so_cho'];
    $nam_sx = $_GET['nam_sx'];
    $don_gia = $_GET['don_gia'];
    $sql = "INSERT INTO xe (Soxe, TenXe, hangxe, SoCho, NamSX, DGThue, Tinhtrang) VALUES ('$ma', '$ten', '$hang', '$so_cho', '$nam_sx', '$don_gia', 0)";

   mysqli_query($conn, $sql);
  }
?> 
</html>