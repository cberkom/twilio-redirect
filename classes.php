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
  public $name = '';
  public $phone_number = '';
  
  public $regions = array(
    array(
      'name' => 'West Coast'
      'phone_number' => new PhoneNumber('661-588-7337'),
      'area_codes' => array(
        'CA' => explode(', ', '209, 213, 310, 323, 408, 415, 424, 510, 530, 559, 562, 619, 626, 650, 661, 669, 707, 714, 760, 805, 818, 831, 858, 909, 916, 925, 949, 442, 657, 747, 951'),
        'AZ' => explode(', ', '480, 520, 602, 623, 928'),
        'AS' => explode(', ', '684'),
        'HI' => explode(', ', '670, 671, 684, 808'),
        'NV' => explode(', ', '702, 725, 775'),
        'NP' => explode(', ', '670'),
        'NM' => explode(', ', '505, 575'),
        'UT' => explode(', ', '385, 435, 801'),
      )
    ),
    array(
      'name' => 'Northwest'
      'phone_number' => new PhoneNumber('503-564-0955'),
      'area_codes' => array(
        'OR' => explode(', ', '503, 541, 971, 458'),
        'WA' => explode(', ', '206, 253, 360, 425, 509'),
        'AK' => explode(', ', '907'),
        'ID' => explode(', ', '208'),
        'MT' => explode(', ', '406'),
      )
    ),
    array(
      'name' => 'Mountain'
      'phone_number' => new PhoneNumber('303-997-1397'),
      'area_codes' => array(
        'ID' => explode(', ', '208'), # WARNING: Already appears in Northwest region, will not be used!
        'MT' => explode(', ', '406'), # WARNING: Already appears in Northwest region, will not be used!
        'CO' => explode(', ', '303, 719, 720, 970'),
        'WY' => explode(', ', '307'),
        'ND' => explode(', ', '701'),
        'SD' => explode(', ', '605'),
        'NE' => explode(', ', '308, 531, 402'),
        'MN' => explode(', ', '218, 320, 507, 612, 651, 763, 952'),
        'IA' => explode(', ', '319, 515, 563, 641, 712'),
      )
    ),
    array(
      'name' => 'South Central'
      'phone_number' => new PhoneNumber('254-771-3798'),
      'area_codes' => array(
        'TX' => explode(', ', '210, 214, 254, 325, 430, 432, 469, 512, 682, 737, 806, 817, 830, 903, 915, 940, 956, 972'),
        'AR' => explode(', ', '479, 501, 870'),
        'OK' => explode(', ', '405, 580, 918, 539'),
        'KS' => explode(', ', '316, 620, 785, 913'),
        'Mexico' => array(),
        'Canada' => explode(', ', '204, 226, 236, 249, 250, 289, 306, 343, 365, 403, 416, 418, 431, 437, 438, 450, 506, 514, 519, 579, 581, 587, 604, 613, 639, 647, 705, 709, 778, 780, 807, 819, 867, 873, 902, 905'),
      )
    ),
    array(
      'name' => 'Gulf Coast'
      'phone_number' => new PhoneNumber('713-481-5500'),
      'area_codes' => array(
        'AL' => explode(', ', '256, 938'),
        'FL' => explode(', ', '386, 850'),
        'LA' => explode(', ', '225, 337, 504, 985, 318'),
        'MS' => explode(', ', '228, 601, 662, 769'),
        'TX' => explode(', ', '281, 346 361, 409, 713, 832, 936, 979'),
      )
    ),
    array(
      'name' => 'North Central'
      'phone_number' => new PhoneNumber(''),
      'area_codes' => array(
        
      )
    ),
    array(
      'name' => 'North East'
      'phone_number' => new PhoneNumber('724-342-6501'),
      'area_codes' => array(
        'OH' => explode(', ', '216, 234, 283, 330, 419, 440, 513, 567, 614, 740, 937'),
        'VA' => explode(', ', '276, 434, 540, 571, 703, 757, 804'),
        'WV' => explode(', ', '681, 304'),
        'MI' => explode(', ', '231, 248, 269, 313, 517, 586, 616, 734, 810, 906, 947, 989'),
        'MD' => explode(', ', '240, 301, 410, 443, 667'),
        'DE' => explode(', ', '302'),
        'PA' => explode(', ', '201, 551, 609, 732, 848, 856, 862, 908, 973'),
        'NY' => explode(', ', '212, 315, 347, 516, 518, 585, 607, 631, 646, 716, 718, 845, 914, 917, 929'),
        'CT' => explode(', ', '203, 475, 860, 959'),
        'MA' => explode(', ', '339, 351, 413, 508, 617, 774, 781, 857, 978'),
        'RI' => explode(', ', '401'),
        'VT' => explode(', ', '802'),
        'NH' => explode(', ', '603'),
        'ME' => explode(', ', '207'),
        'DC' => explode(', ', '202'),
        'WI' => explode(', ', '262, 414, 534, 608, 715, 920'),
      )
    ),
    array(
      'name' => 'South East'
      'phone_number' => new PhoneNumber('864-228-4826'),
      'area_codes' => array(
        'TN' => explode(', ', '423, 615, 731, 865, 931'),
        'NC' => explode(', ', '252, 336, 704, 828, 910, 919, 980, 984'),
        'SC' => explode(', ', '803, 843, 864'),
        'GA' => explode(', ', '229, 404, 470, 478, 678, 706, 770, 912, 762'),
        'IL' => explode(', ', '217, 224, 309, 312, 331, 464, 618, 630, 708, 773, 815, 847, 872'),
        'IN' => explode(', ', '219, 260, 317, 574, 765, 812'),
        'KY' => explode(', ', '270, 502, 859'),
        'MO' => explode(', ', '314, 417, 557, 573, 636, 660, 816'),
        'VI' => explode(', ', '340'),
        'The Dominican Republic' => explode(', ', '809'),
      )
    ),
    array(
      'name' => 'Florida'
      'phone_number' => new PhoneNumber('305-396-3679'),
      'area_codes' => array(
        'FL' => explode(', ', '239, 305, 321, 352, 407, 561, 727, 754, 772, 786, 813, 863, 904, 941, 954'),
        'Puerto Rico' => explode(', ', '939, 787'),
      )
    ),
  );

  public $fallback_region = array(
    'name' => 'Default',
    'phone_number' => '333-444-5555',
    'area_codes' => array()
  );
  
  private __construct($area_code) { 
    $region       = find_region($area_code);
    $name         = $region['name'];
    $phone_number = $region['phone_number'];
  }

  public function find_region($area_code) {
    foreach ($regions as $r) {
      foreach ($r['area_codes'] as $state => $list) {
        if (in_array($area_code, $list)) { 
          return $r; 
        }
      }
    }
    // If not found, return a fallback:
    return $fallback_region;
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