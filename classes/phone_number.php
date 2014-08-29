<?php

// PhoneNumber Class
//
// NOTE: only supports +1 country code right now (US, Canada, Puerto Rico, Dominican Republic)
// TODO: Support Mexico's country code (+52)
class PhoneNumber {
  public $number = '';
  public $area_code = '';

  public function __construct($num) { 
    $this->number = $this->format($num);
    $this->area_code = $this->get_area_code($this->number);
  }

  public function get_area_code($num) {
    return substr($num, 2, 3); #Ignore the '+1' at the beginning of the number (enforced by format function)
  }

  public function __toString() {
    return $this->number;
  }

  private function format($num)
  {
    $num = strval($num);
    $num = $this->only_digits($num);
    $num = $this->add_country_code($num);
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