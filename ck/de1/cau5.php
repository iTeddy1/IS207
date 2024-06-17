<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin xe thuê đã trả</title>
</head>

<body>
  <?php
  require_once ("./index.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'get_returned_cars') {
      $makh = $_POST['makh'];
      $from_date = $_POST['from_date'];
      $to_date = $_POST['to_date'];

      $sql = "SELECT KHACHHANG.TENKH, XE.SOXE, XE.TENXE, XE.HANGXE, XE.NAMSX, XE.SOCHO, XE.DGTHUE, THUE.NGAYTRA 
              FROM THUE 
              JOIN KHACHHANG ON THUE.MAKH = KHACHHANG.MAKH 
              JOIN XE ON THUE.SOXE = XE.SOXE 
              WHERE THUE.MAKH = '$makh' 
              AND THUE.NGAYTRA IS NOT NULL 
              AND THUE.NGAYTRA BETWEEN '$from_date' AND '$to_date'";

      $result = mysqli_query($conn, $sql);
      $returnedCars = [];
      echo "<table>
            <thead>
              <tr>
                <td>Tên khách hàng</td>
                <td>Số xe</td>
                <td>Tên xe</td>
                <td>Hãng xe</td>
                <td>Năm sản xuất</td>
                <td>Số chỗ</td>
                <td>Đơn giá thuê</td>
                <td>Ngày trả</td>
              </tr>
            </thead><tbody>";
      while ($row = mysqli_fetch_assoc($result)) {
        $returnedCars[] = $row;
        echo '<tr>' .
          '<td>' . $row['TENKH'] . '</td>' .
          '<td>' . $row['SOXE'] . '</td>' .
          '<td>' . $row['TENXE'] . '</td>' .
          '<td>' . $row['HANGXE'] . '</td>' .
          '<td>' . $row['NAMSX'] . '</td>' .
          '<td>' . $row['SOCHO'] . '</td>' .
          '<td>' . $row['DGTHUE'] . '</td>' .
          '<td>' . $row['NGAYTRA'] . '</td>' .
          '</tr>';
      }
      echo "</tbody></table>";
      exit;
    }
  }
  ?>

  <h1>Thông tin xe thuê đã trả của khách hàng</h1>
  <label for="makh">Họ tên khách hàng</label>
  <select name="makh" id="makh">
    <?php
    $sql = "SELECT * FROM KHACHHANG";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='" . $row['MAKH'] . "'>" . $row['TENKH'] . "</option>";
    }
    ?>
  </select>

  <label for="from_date">Từ ngày</label>
  <input type="date" id="from_date">

  <label for="to_date">Đến ngày</label>
  <input type="date" id="to_date">

  <button id="search">Tìm kiếm</button>

  <h2>Danh sách các xe đã trả</h2>
  <table id="returned-cars">

  </table>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#search').on('click', function () {
        let makh = $('#makh').val();
        let from_date = $('#from_date').val();
        let to_date = $('#to_date').val();
        console.log(makh, from_date, to_date);
        if (!from_date || !to_date) {
          alert("Vui lòng nhập khoảng thời gian.");
          return;
        }

        $.ajax({
          url: '', // Same file
          type: 'POST',
          data: {
            action: 'get_returned_cars',
            makh: makh,
            from_date: from_date,
            to_date: to_date
          },
          success: function (response) {
            $('#returned-cars').html(response);
            console.log(response);
          }
        });
      });
    });
  </script>
</body>

</html>