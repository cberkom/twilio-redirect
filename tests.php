<?php

require('require_all.php');

error_reporting(E_ALL);

class BasicSpec {
  public $failures = 0;

  public function __construct() { }

  public function assert_equal($subject, $value) {
    if($subject == $value) {
      echo "PASS: '$subject' == '$value' \n";
    } else {
      echo "FAIL: '$subject' != '$value'! \n";
      $this->failures ++;
    }
  }

  public function assert_is_set($subject, $description) {
    if(isset($subject)) {
      echo "PASS: $description is set \n";
    } else {
      echo "FAIL: $description is NOT set! \n";
      $this->failures ++;
    }
  }

  public function assert_is_array($subject, $description) {
    if(is_array($subject)) {
      echo "PASS: $description is an array \n";
    } else {
      echo "FAIL: $description is NOT an array! \n";
      $this->failures ++;
    }
  }

  public function assert_matches($subject, $regex) {
    if(preg_match($regex, $subject)) {
      echo "PASS: '$subject' matches expected pattern \n";
    } else {
      echo "FAIL: '$subject' does NOT match expected pattern! \n";
      $this->failures ++;
    }
  }
}

class PhoneNumberSpec extends BasicSpec {
  public function __construct() { }

  public function run() {
    echo "Running PhoneNumberSpec... \n";

    echo "When number includes US country code: \n";
    $p = new PhoneNumber('+13607189934');
    $this->assert_equal($p->number, '+13607189934');
    $this->assert_equal($p->area_code, '360');

    echo "When number does NOT include country code: \n";
    $p = new PhoneNumber('(360) 718-9934');
    $this->assert_equal($p->number, '+13607189934');
    $this->assert_equal($p->area_code, '360');

    echo ($this->failures > 0) ? "$this->failures FAILED TESTS!" : "All tests passed!";
  }
}

class RegionSpec extends BasicSpec {
  public function __construct() { }

  public function run() {
    echo "Running RegionSpec... \n";

    echo "When area code is known: \n";
    $r = new Region('360');
    $this->assert_equal($r->name, 'Northwest');
    $this->assert_equal($r->phone_number, '+15035640955');

    echo "When area code NOT known: \n";
    $r = new Region('000');
    $this->assert_equal($r->name, 'Default');
    $this->assert_matches($r->phone_number, '/\+[0-9]{11}/');

    // All regions are constructed properly
    echo "Validate that regions are constructed property: \n";
    $r = new Region('000');
    foreach ($r->regions as $region) {
      $this->assert_is_set($region['name'], 'region name');
      $this->assert_is_set($region['phone_number'], 'region phone_number ('.$region['name'].')');
      $this->assert_is_array($region['area_codes'], 'region area_codes ('.$region['name'].')');
    }

    echo ($this->failures > 0) ? "$this->failures FAILED TESTS!" : "All tests passed!";
  }
}

class InboundCallSpec extends BasicSpec {
  public function __construct() { }

  public function run() {
    echo "Running InboundCallSpec... \n";

    echo "It responds correctly when passed a valid Florida number: \n";
    $c = new InboundCall(array('From' => '+13051112222'));
    $this->assert_equal($c->region->name, 'Florida');
    $this->assert_equal($c->destination_number, '+13053963679');

    echo "It degrades gracefully when passed random data: \n";
    $c = new InboundCall(array('Unexpected Param' => 'random'));
    $this->assert_equal($c->region->name, 'Default');
    $this->assert_matches($c->destination_number, '/\+[0-9]{11}/');

    echo ($this->failures > 0) ? "$this->failures FAILED TESTS!" : "All tests passed!";
  }
}

echo "<h1>Twilio-Redirect Test Suite</h1> \n";
echo "<pre>"; // Display each echo statement on new line

$spec = new PhoneNumberSpec();
$spec->run();
echo "\n\n";
$spec = new RegionSpec();
$spec->run();
echo "\n\n";
$spec = new InboundCallSpec();
$spec->run();

echo "</pre>";

?>