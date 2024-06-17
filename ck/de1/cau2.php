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
    <h1>Thông tin trả xe</h1>
    Họ tên khách hàng 
    <select name="makh" id="">
      <?php 
        $sql = "SELECT * FROM KHACHHANG";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
          echo "<option value='".$row['MAKH']."'>".$row['TENKH']."</option>";
        }
      ?>
    </select><br>
    Số xe <input type="text" name="so_xe">  <br>
    Ngày thuê <input type="date" name="ngthue"> <br>
    Ngày trả<input type="date" name="ngtra"> <br>
    <input name="submit" type="submit" value="Trả xe">
  </form>
</body>
<?php 
  if(isset($_GET['submit'])) {
    $makh = $_GET['makh'];
    $soxe = $_GET['so_xe'];
    $ngthue = $_GET['ngthue'];
    $ngtra = $_GET['ngtra'];
 
    $dongia = mysqli_query($conn, "SELECT DGThue FROM XE WHERE Soxe = '$soxe'");
    $dongia = mysqli_fetch_assoc($dongia)['DGThue'];

    //! date('d',strtotime($ngtra)) - date('d',strtotime($ngthue)) === 1

    if($ngthue === $ngtra) {
      $songaythue = 1;
    } else  {
      $songaythue = mysqli_query($conn, "SELECT DATEDIFF('$ngtra', '$ngthue')");
      $songaythue = mysqli_fetch_assoc($songaythue)["DATEDIFF('$ngtra', '$ngthue')"];
    }    

    $giathue = $dongia * $songaythue;
    $sql = "UPDATE THUE SET NGAYTRA = '$ngtra', GIATHUE = '$giathue' WHERE MAKH = '$makh' AND SOXE = '$soxe' AND NGAYTHUE = '$ngthue'";
    mysqli_query($conn, $sql);
  }
?> 
</html>