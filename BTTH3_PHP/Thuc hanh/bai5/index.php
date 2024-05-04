<?php include 'phanso.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <main>

        <h2>Chương trình cộng, trừ, nhân, chia hai phân số</h2>
        <form action="" method="post">
            <section>
                <label for="tu_so1">Tử số phân số 1:</label>
                <input type="text" id="tu_so1" name="tu_so1" required required><br>
                <label for="mau_so1">Mẫu số phân số 1:</label>
                <input type="text" id="mau_so1" name="mau_so1" required><br>

                <label for="tu_so2">Tử số phân số 2:</label>
                <input type="text" id="tu_so2" name="tu_so2" required><br>
                <label for="mau_so2">Mẫu số phân số 2:</label>
                <input type="text" id="mau_so2" name="mau_so2" required><br>
                <input type="submit" name="submit" value="=">
                <p><?php

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phep_tinh'])) {
                    $tu_so1 = $_POST['tu_so1'];
                    $mau_so1 = $_POST['mau_so1'];
                    $tu_so2 = $_POST['tu_so2'];
                    $mau_so2 = $_POST['mau_so2'];
                    $phep_tinh = $_POST['phep_tinh'];

                    $ps1 = new PhanSo($tu_so1, $mau_so1);
                    $ps2 = new PhanSo($tu_so2, $mau_so2);
                    $a = '';
                    switch ($phep_tinh) {
                        case 'cong':
                            $ket_qua = $ps1->cong($ps2);
                            $a = 'Tổng:';
                            break;
                        case 'tru':
                            $ket_qua = $ps1->tru($ps2);
                            $a = 'Hiệu:';

                            break;
                        case 'nhan':
                            $ket_qua = $ps1->nhan($ps2);
                            $a = 'Tích:';
                            break;
                        case 'chia':
                            $ket_qua = $ps1->chia($ps2);
                            $a = 'Thương:';
                            break;
                        default:
                            echo "Vui lòng chọn phép tính.";
                    }

                    $ket_qua->donGian();
                    echo $a . $ps1->tu . "/" . $ps1->mau . " và " . $ps2->tu . '/' . $ps2->mau . " là " . $ket_qua->tu . $ket_qua->mau;
                }
                ?>
                </p>
            </section>

            <section class="option" required>
                <p>Phép tính</p>
                <input type="radio" id="cong" name="phep_tinh" value="cong">
                <label for="cong">+</label><br>
                <input type="radio" id="tru" name="phep_tinh" value="tru">
                <label for="tru">-</label><br>
                <input type="radio" id="nhan" name="phep_tinh" value="nhan">
                <label for="nhan">*</label><br>
                <input type="radio" id="chia" name="phep_tinh" value="chia">
                <label for="chia">/</label><br>
            </section>

        </form>
    </main>


</body>

</html>