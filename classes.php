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

class Region {
  public $area_code = '';
  public $state = '';
  public $region = '';
  public $phone_number = '';
  
  private $states = array(
    'ak' => array('123', '234', '345'),
    'wa' => array('360')
  );
  private $regions = array(
    'west' => array('ak', 'wa')
  );
  private $phone_numbers = array(
    '+12223334444' => array('west')
  );
  private $fallback_number = '+13334445555';

  private __construct($code) { 
    $area_code    = $code;
    $state        = lookup($code, $states) ?: 'Unknown';
    $region       = lookup($state, $regions) ?: 'Unknown';
    $phone_number = new PhoneNumber(lookup($region, $phone_numbers) ?: $fallback_number);
  }

  private function lookup($val, $assoc, $fallback) {
    foreach ($assoc as $key => $values) {
      if(in_array($val, $values)) {
        return $key;
      }
    }
    return $fallback;
  }
}

class Call {
  public $inbound_number = '';
  public $region;
  public $destination_number = '';

  private __construct($twilio_params) { 
    $inbound_number = new PhoneNumber($twilio_params['From']);
    $region = Region.new($inbound_number->area_code);
    $destination_number = $region->phone_number;
  }
}

?>