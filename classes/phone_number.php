<?php

class PhoneNumber {
  public $number = '';

  private __construct($num) { 
    $number = format($num);
  }

  public function area_code() {
    return substr($number, 2, 3) #Ignore the '+1' at the beginning of the number (enforced by format function)
  }

  public function __toString() {
    return $this->number;
  }

  private function format($num)
  {
    $num = strval($num);
    $num = only_digits($num);
    $num = add_country_code($num);
    return '+' . $num;
  }

  private function only_digits($num) {
    return preg_replace("/[^0-9]/","",$num);
  }

  private function add_country_code($num) {
    if($num[0] != '1') { $num = '1' . $num; }
    return $num;
  }
}

?>