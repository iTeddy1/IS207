<?php include ('./nhanvien.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>Document</title>
</head>

<body>
  <main>
    <table>
      <form method="POST">
        <tr>
          <td class="sub">
            <label for="ma">Mã nhân viên</label>
          </td>
          <td class='input'>
            <input type="text" name="ma" required>
          </td>
        </tr>
        <tr>
          <td class="sub">
            <label for="ten">Tên nhân viên</label>
          </td>
          <td class='input'>
            <input type="text" name="ten" required>
          </td>
        </tr>
        <tr>
          <td class="sub">
            <label for="songay">Số ngày làm việc</label>
          </td>
          <td class='input'>
            <input type="text" name="songay" required>
          </td>
        </tr>
        <tr>
          <td class="sub">
            <label for="luongngay">Lương ngày</label>
          </td>
          <td class='input'>
            <input type="text" name="luongngay" required>
          </td>
        </tr>
        <tr>
          <td class="sub">
            <label for="isManager">Nhân viên quản lý</label>
          </td>
          <td class='input'>
            <input type="checkbox" id="" name="isManager">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="btn"><input type="submit" value="Lương tháng" name="submit"></td>
        </tr>
      </form>
    </table>
  </main>
  <div>

    <?php
    if (isset($_POST['submit'])) {
      $ma = $_POST['ma'];
      $ten = $_POST['ten'];
      $songay = $_POST['songay'];
      $luongngay = $_POST['luongngay'];
      $isManager = isset($_POST["isManager"]);

      // Check manager
      $isManager ? $nhanvien = new nhanvienQL() : $nhanvien = new nhanvien();

      $nhanvien->Gan($ma, $ten, $songay, $luongngay);
      $luong = $nhanvien->TinhLuong();
      $nhanvien->InNhanVien();

      echo 'Luong thang' . $luong;
    }

    ?>
  </div>
</body>

</html>