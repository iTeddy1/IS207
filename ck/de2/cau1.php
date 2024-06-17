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
    Mã khách hàng <input type="text" name="ma"> <br>
    Tên khách hàng <input type="text" name="ten">  <br>
    Số điện thoại <input type="text" name="sdt"> <br>
    Căn cước công dân <input type="text" name="cccn"> <br>

    <input name="submit" type="submit" value="Thêm">
  </form>
</body>
<?php 
  if(isset($_GET['submit'])) {
    $ma = $_GET['ma'];
    $tenkh = $_GET['ten'];
    $sdt = $_GET['sdt'];
    $cccn = $_GET['cccn'];

    $sql = "INSERT INTO KHACHHANG (MAKH, TENKH, SDT, CCCN) VALUES ('$ma', '$tenkh', '$sdt', '$cccn')";

   mysqli_query($conn, $sql);
  }
?> 
</html>