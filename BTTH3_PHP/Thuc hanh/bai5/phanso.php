<?php
class PhanSo {
    public $tu;
    public $mau;

    public function __construct($tu, $mau) {
        $this->tu = $tu;
        $this->mau = $mau;
        
    }

    public function cong($ps) {
        $result_tu = $this->tu * $ps->mau + $ps->tu * $this->mau;
        $result_mau = $this->mau * $ps->mau;
        return new PhanSo($result_tu, $result_mau);
    }

    public function tru($ps) {
        $result_tu = $this->tu * $ps->mau - $ps->tu * $this->mau;
        $result_mau = $this->mau * $ps->mau;
        return new PhanSo($result_tu, $result_mau);
    }

    public function nhan($ps) {
        $result_tu = $this->tu * $ps->tu;
        $result_mau = $this->mau * $ps->mau;
        return new PhanSo($result_tu, $result_mau);
    }

    public function chia($ps) {
        $result_tu = $this->tu * $ps->mau;
        $result_mau = $this->mau * $ps->tu;
        return new PhanSo($result_tu, $result_mau);
    }

    public function donGian() {
        $gcd = $this->gcd($this->tu, $this->mau);
        $this->tu /= $gcd;
        $this->mau /= $gcd;
    }

    private function gcd($a, $b) {
        while ($b != 0) {
            $remainder = $a % $b;
            $a = $b;
            $b = $remainder;
        }
        return abs($a);
    }
    public function in(){
        return "$this->tu . '/' . $this->mau";
    }
}
