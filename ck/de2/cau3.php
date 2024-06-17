<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>


<?php
// The code below is vulnerable to SQL Injection
// Include the database connection
require_once ("./index.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['action']) && $_POST['action'] == 'da_them') {
    $maphong = $_POST['maphong'];
    $makh = $_POST['makh'];
    $ngay_thue = $_POST['ngay_thue'];

    $sql = "UPDATE PHONG SET Tinhtrang = 'dathue' WHERE MAPHONG = $maphong";
    $updateResult = mysqli_query($conn, $sql);
    $sql = "INSERT INTO THUE (MAHD, MAPHONG, NGAYTHUE) VALUES ('$maphong', '$makh', '$ngay_thue')";
    $insertResult = mysqli_query($conn, $sql);
  
    exit;
  }

  if (isset($_POST['action']) && $_POST['action'] == 'trong') {
    $maphong = $_POST['maphong'];

    $sql = "UPDATE XE SET Tinhtrang = 0 WHERE SOXE = $soxe";
    $updateResult = mysqli_query($conn, $sql);

    if ($updateResult) {
      $sql = "DELETE FROM THUE WHERE SOXE = $soxe";
      $deleteResult = mysqli_query($conn, $sql);
      echo $deleteResult ? 'success' : 'failure';
    } else {
      echo 'failure';
    }
    exit;
  }
}
?>

<body>
  <?php require_once ("./index.php"); ?>
  <h1>Thue xe</h1>
  Mã hóa đơn
  <select name="mahd" id="">
    <?php
    $sql = "SELECT * FROM HOADON";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='" . $row['MAHD'] . "'>" . $row['MAHD'] . "</option>";
    }
    ?>
  </select>

  <h2> Danh sách các phòng còn trống</h2>
  <table>
    <thead>
      <tr>
        <td>STT</td>
        <td>Mã phòng</td>
        <td>Tên phòng</td>
        <td>Chức năng</td>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM PHONG WHERE TINHTRANG = 'trong'";
      $result = mysqli_query($conn, $sql);
      $stt = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $stt++ . "</td>";
        echo "<td>" . $row['MAPHONG'] . "</td>";
        echo "<td>" . $row['TENPHONG'] . "</td>";
        echo "<td><button onclick='themPhong(" . $row['MAPHONG'] . ")'>Thêm</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <br>
  <h2> Danh sách các phòng đã thuê</h2>
  <table>
    <thead>
      <tr>
        <td>STT</td>
        <td>Mã phòng</td>
        <td>Tên phòng</td>
        <td>Chức năng</td>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM PHONG WHERE Tinhtrang = 'dathue'";
      $result = mysqli_query($conn, $sql);
      $stt = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $stt++ . "</td>";
        echo "<td>" . $row['MAPHONG'] . "</td>";
        echo "<td>" . $row['TENPHONG'] . "</td>";
        echo "<td><button id='noRent' onclick='xoaPhong(" . $row['MAPHONG'] . ")'>Xóa</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>

<script>
  function themPhong(maphong) {
    let makh = $('#makh').val();
    let ngay_thue = $('#ngay_thue').val();

    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'da_them', maphong: maphong, makh: makh, ngay_thue: ngay_thue},
      success: function (response) {
        console.log(response)
        location.reload();

      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      }
    });
  };

  function xoaPhong(maphong) {
    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'trong', maphong: maphong},
      success: function (response) {
        location.reload();
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      }
    });
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>