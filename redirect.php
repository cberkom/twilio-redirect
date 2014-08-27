<?php

class PhoneNumber {
	public $number = '';

	private __construct($num) {	
		$number = only_digits($num);
	}

	public function area_code() {
		if($number[0] == '1') {
			return substr($number, 1, 3) #Ignore an initial 1 (it is the US country code)
		} else {
			return substr($number, 0, 3)
		}
	}

	private function only_digits($num)
	{
		return preg_replace("/[^0-9]/","",$num);
	}
}

class Region {
	public $area_code = '';
	public $state = '';
	public $region = '';
	public $phone_number = '';
	
	private $states = array(
		'ak' => array('123', '234', '345'),
	);
	private $regions = array(
		'west' => array('ak', 'al')
	);
	private $phone_numbers = array(
		'+12223334444' => array('west')
	);
	private $fallback_number = '+13334445555';

	private function __construct($code) {	
		$area_code    = $code;
		$state        = lookup($code, $states, 'Unknown');
		$region       = lookup($state, $regions, 'Unknown');
		$phone_number = lookup($region, $phone_numbers, $fallback_number);
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

$call = new Call($_POST);
header ("Content-Type:text/xml");

?>

<?xml version="1.0" encoding="UTF-8"?>
<Response>
  <Dial>
    <Number>
      <?php echo $call->destination_number; ?>
    </Number>
  </Dial>
</Response>