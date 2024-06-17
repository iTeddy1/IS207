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
    Tên khách hàng 
    <select name="makh" id="">
      <?php 
      $sql = "SELECT * FROM KHACHHANG";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['MAKH']."'>".$row['TENKH']."</option>";
      }
      ?>
    </select>  <br>
    Mã hóa đơn <input type="text" name="ma"> <br>
    Tên hóa đơn <input type="text" name="tenhd"> <br>
    Tổng tiền <input type="number" name="tong"> <br>

    <input name="submit" type="submit" value="Thêm">
  </form>
</body>
<?php 
  if(isset($_GET['submit'])) {
    $makh = $_GET['makh'];
    $mahd = $_GET['ma'];
    $tenhd = $_GET['tenhd'];
    $tong = $_GET['tong'];

    $sql = "INSERT INTO HOADON (MAKH, MAHD, TENHD, TONGTIEN) VALUES ('$makh', '$mahd', '$tenhd', '$tong')";

   mysqli_query($conn, $sql);
  }
?> 
</html>