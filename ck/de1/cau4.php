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
  if (isset($_POST['action']) && $_POST['action'] == 'print') {
    $ngay_thue = $_POST['ngay_thue'];

    $sql = "SELECT * FROM KHACHHANG kh, XE xe, THUE thue WHERE kh.MAKH = thue.MAKH AND xe.SOXE = thue.SOXE AND thue.NGAYTHUE = '$ngay_thue'";
    $result = mysqli_query($conn, $sql);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<td>STT</td>";
    echo "<td>Tên khách hàng</td>";
    echo "<td>Số xe</td>";
    echo "<td>Tên xe</td>";
    echo "</tr>";
    echo "</thead>";

    $stt = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $stt++ .  "</td>";
      echo "<td>" . $row['TENKH'] . "</td>";
      echo "<td>" . $row['SOXE'] . "</td>";
      echo "<td>" . $row['TENXE'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  exit;
}
?>

<body>
  <?php require_once ("./index.php"); ?>
  Chọn ngày
  <form id="form" action="">
    <input type="date" type="submit" name="ngay_thue" id="ngay_thue">
    <button type="submit">Theem</button>
  </form>
  <div id="render"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $('#form').submit(function (e) {
      e.preventDefault();
      $('#render').html('');
  
      let ngay_thue = $('#ngay_thue').val();
      $.ajax({
        url: '', // Same file
        type: 'POST',
        data: { action: 'print', ngay_thue: ngay_thue },
        success: function ( response) {
          $('#render').html(response);
        },
      });
    });
</script>

</html>