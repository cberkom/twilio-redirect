<?php

class Region {
  public $name = '';
  public $phone_number = '';
  
  public $regions = array(
    array(
      'name' => 'West Coast',
      'phone_number' => '661-588-7337',
      'area_codes' => array(
        'CA' => array('209', '213', '310', '323', '408', '415', '424', '510', '530', '559', '562', '619', '626', '650', '661', '669', '707', '714', '760', '805', '818', '831', '858', '909', '916', '925', '949', '442', '657', '747', '951'),
        'AZ' => array('480', '520', '602', '623', '928'),
        'AS' => array('684'),
        'HI' => array('670', '671', '684', '808'),
        'NV' => array('702', '725', '775'),
        'NP' => array('670'),
        'NM' => array('505', '575'),
        'UT' => array('385', '435', '801'),
      )
    ),
    array(
      'name' => 'Northwest',
      'phone_number' => '503-564-0955',
      'area_codes' => array(
        'OR' => array('503', '541', '971', '458'),
        'WA' => array('206', '253', '360', '425', '509'),
        'AK' => array('907'),
        'ID' => array('208'),
        'MT' => array('406'),
      )
    ),
    array(
      'name' => 'Mountain',
      'phone_number' => '303-997-1397',
      'area_codes' => array(
        'ID' => array('208'), # WARNING: Already appears in Northwest region, will not be used!
        'MT' => array('406'), # WARNING: Already appears in Northwest region, will not be used!
        'CO' => array('303', '719', '720', '970'),
        'WY' => array('307'),
        'ND' => array('701'),
        'SD' => array('605'),
        'NE' => array('308', '531', '402'),
        'MN' => array('218', '320', '507', '612', '651', '763', '952'),
        'IA' => array('319', '515', '563', '641', '712'),
      )
    ),
    array(
      'name' => 'South Central',
      'phone_number' => '254-771-3798',
      'area_codes' => array(
        'TX' => array('210', '214', '254', '325', '430', '432', '469', '512', '682', '737', '806', '817', '830', '903', '915', '940', '956', '972'),
        'AR' => array('479', '501', '870'),
        'OK' => array('405', '580', '918', '539'),
        'KS' => array('316', '620', '785', '913'),
        'Mexico' => array(),
        'Canada' => array('204', '226', '236', '249', '250', '289', '306', '343', '365', '403', '416', '418', '431', '437', '438', '450', '506', '514', '519', '579', '581', '587', '604', '613', '639', '647', '705', '709', '778', '780', '807', '819', '867', '873', '902', '905'),
      )
    ),
    array(
      'name' => 'Gulf Coast',
      'phone_number' => '713-481-5500',
      'area_codes' => array(
        'AL' => array('256', '938'),
        'FL' => array('386', '850'),
        'LA' => array('225', '337', '504', '985', '318'),
        'MS' => array('228', '601', '662', '769'),
        'TX' => array('281', '346', '361', '409', '713', '832', '936', '979'),
      )
    ),
    array(
      'name' => 'North Central',
      'phone_number' => '',
      'area_codes' => array()
    ),
    array(
      'name' => 'North East',
      'phone_number' => '724-342-6501',
      'area_codes' => array(
        'OH' => array('216', '234', '283', '330', '419', '440', '513', '567', '614', '740', '937'),
        'VA' => array('276', '434', '540', '571', '703', '757', '804'),
        'WV' => array('681', '304'),
        'MI' => array('231', '248', '269', '313', '517', '586', '616', '734', '810', '906', '947', '989'),
        'MD' => array('240', '301', '410', '443', '667'),
        'DE' => array('302'),
        'PA' => array('201', '551', '609', '732', '848', '856', '862', '908', '973'),
        'NY' => array('212', '315', '347', '516', '518', '585', '607', '631', '646', '716', '718', '845', '914', '917', '929'),
        'CT' => array('203', '475', '860', '959'),
        'MA' => array('339', '351', '413', '508', '617', '774', '781', '857', '978'),
        'RI' => array('401'),
        'VT' => array('802'),
        'NH' => array('603'),
        'ME' => array('207'),
        'DC' => array('202'),
        'WI' => array('262', '414', '534', '608', '715', '920'),
      )
    ),
    array(
      'name' => 'South East',
      'phone_number' => '864-228-4826',
      'area_codes' => array(
        'TN' => array('423', '615', '731', '865', '931'),
        'NC' => array('252', '336', '704', '828', '910', '919', '980', '984'),
        'SC' => array('803', '843', '864'),
        'GA' => array('229', '404', '470', '478', '678', '706', '770', '912', '762'),
        'IL' => array('217', '224', '309', '312', '331', '464', '618', '630', '708', '773', '815', '847', '872'),
        'IN' => array('219', '260', '317', '574', '765', '812'),
        'KY' => array('270', '502', '859'),
        'MO' => array('314', '417', '557', '573', '636', '660', '816'),
        'VI' => array('340'),
        'The Dominican Republic' => array('809'),
      )
    ),
    array(
      'name' => 'Florida',
      'phone_number' => '305-396-3679',
      'area_codes' => array(
        'FL' => array('239', '305', '321', '352', '407', '561', '727', '754', '772', '786', '813', '863', '904', '941', '954'),
        'Puerto Rico' => array('939, 787'),
      )
    ),
  );

  public $fallback_region = array(
    'name' => 'Default',
    'phone_number' => '360-718-9934',
    'area_codes' => array()
  );
  
  public function __construct($area_code) { 
    $region = $this->find_region($area_code);
    $this->name = $region['name'];
    $this->phone_number = new PhoneNumber($region['phone_number']);
  }

  private function find_region($area_code) {
    // TESTING:
    return $this->fallback_region;

    foreach ($this->regions as $r) {
      foreach ($r['area_codes'] as $state => $list) {
        if (in_array($area_code, $list)) { 
          return $r; 
        }
      }
    }
    // If not found, return the fallback region:
    return $this->fallback_region;
  }
}

?>