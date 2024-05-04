<?php
class nhanvien
{
  private $ma, $ten, $songay, $luongngay;

  public function Gan($ma, $ten, $songay, $luongngay)
  {
    $this->ma = $ma;
    $this->ten = $ten;
    $this->songay = $songay;
    $this->luongngay = $luongngay;
  }
  public function InNhanVien()
  {
    echo "Ma: " . $this->ma . "<br>";
    echo "Ten: " . $this->ten . "<br>";
    echo "So Ngay: " . $this->songay . "<br>";
    echo "Luong Ngay: " . $this->luongngay . "<br>";
  }
  public function TinhLuong()
  {
    return $this->luongngay * $this->songay;
  }
}

class nhanvienQL extends nhanvien
{
  private $PhuCap = 2000;
  public function TinhLuong()
  {
    return parent::TinhLuong() + $this->PhuCap;
  }
  public function InNhanVien()
  {
    parent::InNhanVien();
    echo "Phu cap: " . $this->PhuCap . "<br>";
  }
}
