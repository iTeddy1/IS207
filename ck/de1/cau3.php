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
  if (isset($_POST['action']) && $_POST['action'] == 'rent') {
    $soxe = $_POST['soxe'];
    $makh = $_POST['makh'];
    $ngay_thue = $_POST['ngay_thue'];

    $sql = "UPDATE XE SET Tinhtrang = 1 WHERE SOXE = $soxe";
    $updateResult = mysqli_query($conn, $sql);
    echo $updateResult;
    if ($updateResult) {
      $sql = "INSERT INTO THUE (MAKH, SOXE, NGAYTHUE) VALUES ('$makh', '$soxe', '$ngay_thue')";
      $insertResult = mysqli_query($conn, $sql);
      echo $insertResult ? 'success' : 'failure';
    } else {
      echo 'failure';
    }
    exit;
  }

  if (isset($_POST['action']) && $_POST['action'] == 'no_rent') {
    $soxe = $_POST['soxe'];

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
  Họ tên khách hàng
  <select name="makh" id="makh">
    <?php
    $sql = "SELECT * FROM KHACHHANG";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='" . $row['MAKH'] . "'>" . $row['TENKH'] . "</option>";
    }
    ?>
  </select>
  Ngày thuê xe
  <input type="date" name="ngay_thue" id="ngay_thue">

  <h2> Danh sách các xe chưa thuê</h2>
  <table>
    <thead>
      <tr>
        <td>Số xe</td>
        <td>Tên xe</td>
        <td>Hãng xe</td>
        <td>Năm sản xuất</td>
        <td>Số chỗ</td>
        <td>Đơn giá thuê</td>
        <td>Chọn thuê</td>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM XE WHERE TINHTRANG = 0";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td id='car-" . $row['SOXE'] . "'>" . $row['SOXE'] . "</td>";
        echo "<td>" . $row['TENXE'] . "</td>";
        echo "<td>" . $row['HANGXE'] . "</td>";
        echo "<td>" . $row['NAMSX'] . "</td>";
        echo "<td>" . $row['SOCHO'] . "</td>";
        echo "<td>" . $row['DGTHUE'] . "</td>";
        echo "<td><button id='rent' onclick='rentCar(" . $row['SOXE'] . ")'>Thuê</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <br>
  <h2> Danh sách các xe đang thuê</h2>
  <table>
    <tbody>
      <?php
      $sql = "SELECT * FROM XE WHERE Tinhtrang = 1";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td id='car-" . $row['SOXE'] . "'>" . $row['SOXE'] . "</td>";
        echo "<td>" . $row['TENXE'] . "</td>";
        echo "<td>" . $row['HANGXE'] . "</td>";
        echo "<td>" . $row['NAMSX'] . "</td>";
        echo "<td>" . $row['SOCHO'] . "</td>";
        echo "<td>" . $row['DGTHUE'] . "</td>";
        echo "<td><button id='noRent' onclick='noRentCar(" . $row['SOXE'] . ")'>Không Thuê</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>
<!-- <script>
  function rentCar(soxe) {
    console.log('hello');
    let makh = document.getElementById('makh').value;
    let ngay_thue = document.getElementById('ngay_thue').value;
    if (!ngay_thue) {
      alert("Vui lòng chọn ngày thuê.");
      return;
    }

    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'rent', soxe: soxe, makh: makh, ngay_thue: ngay_thue },
      success: function (response) {
        if (response == 'success') {
          location.reload();
        } else {
          alert('Thuê xe thất bại.');
        }
      }
    });
  };

  function noRentCar(soxe) {
    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'no_rent', soxe: soxe },
      success: function (response) {
        if (response == 'success') {
          location.reload();
        } else {
          alert('Không thuê xe thất bại.');
        }
      }
    });
  }
</script> -->
<script>
  function rentCar(soxe) {
    let makh = $('#makh').val();
    let ngay_thue = $('#ngay_thue').val();

    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'rent', soxe: soxe, makh: makh, ngay_thue: ngay_thue},
      success: function (response) {
        console.log(response)
        location.reload();

      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      }
    });
  };

  function noRentCar(soxe) {
    $.ajax({
      url: '', // Same file
      type: 'POST',
      data: { action: 'no_rent', soxe: soxe },
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