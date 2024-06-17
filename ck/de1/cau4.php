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

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td id='car-" . $row['MAT'] . "'>" . $row['MAT'] . "</td>";
      echo "<td>" . $row['TENKH'] . "</td>";
      echo "<td>" . $row['SOXE'] . "</td>";
      echo "<td>" . $row['TENXE'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
}
?>

<body>
  <?php require_once ("./index.php"); ?>
  Chọn ngày
  <input type="date" type="submit" name="ngay_thue" id="ngay_thue">
  <div id="render"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $('#ngay_thue').keypress(function (e) {
      $('#render').html('');
      if (e.key === 'Enter') {
        $('#rent').click();
      }
      let ngay_thue = $('#ngay_thue').val();
      $.ajax({
        url: '', // Same file
        type: 'POST',
        data: { action: 'print', ngay_thue: ngay_thue },
        success: function ( response) {
          $('#render').html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", status, error);
        }
      });
    });
</script>

</html>