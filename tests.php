<?php

require('require_all.php');

class BasicSpec {
  private __construct() { }

  public function assert_equal($subject, $value) {
    if($subject == $value) {
      echo "PASS: '$subject' == '$value'";
    } else {
      echo "FAIL: '$subject' != '$value'!";
    }
  }

  public function assert_is_set($subject, $description) {
    if(isset($subject)) {
      echo "PASS: $description is set";
    } else {
      echo "FAIL: $description is NOT set!";
    }
  }

  public function assert_is_array($subject, $description) {
    if(is_array($subject)) {
      echo "PASS: $description is an array";
    } else {
      echo "FAIL: $description is NOT an array!";
    }
  }

  public function assert_matches($subject, $regex) {
    if(preg_match($regex, $subject)) {
      echo "PASS: '$subject' matches expected pattern";
    } else {
      echo "FAIL: '$subject' does NOT match expected pattern!";
    }
  }
}

class PhoneNumberSpec extends BasicSpec {
  private __construct() { }

  public function run() {
    echo 'Running PhoneNumberSpec...';

    echo "When number includes US country code:"
    $p = new PhoneNumber('+13607189934')
    assert_equal($p->number, '+13607189934');
    assert_equal($p->area_code, '360');

    echo "When number includes foreign country code:"
    echo "TODO: this needs work."

    echo "When number does NOT include country code:"
    $p = new PhoneNumber('(360) 718-9934')
    assert_equal($p->number, '+13607189934');
    assert_equal($p->area_code, '360');
  }
}

class RegionSpec extends BasicSpec {
  private __construct() { }

  public function run() {
    echo 'Running RegionSpec...';

    echo "When area code is known:"
    $r = new Region('360');
    assert_equal($r->name, 'Northwest');
    assert_equal($r->phone_number, '+16615887337');

    echo "When area code NOT known:"
    $r = new Region('000');
    assert_equal($r->name, 'Default');
    assert_matches($r->phone_number, '/\+[0-9]{11}/');

    // All regions are constructed properly
    echo "Validate that regions are constructed property:";
    $r = new Region('000')
    foreach ($r->regions as $region) {
      assert_is_set($region['name'], 'region name');
      assert_is_set($region['phone_number'], 'region phone_number ('.$region['name'].')');
      assert_is_array($region['area_codes'], 'region area_codes ('.$region['name'].')');
    }
  }
}

class InboundCallSpec extends BasicSpec {
  private __construct() { }

  public function run() {
    echo 'Running InboundCallSpec...';

    echo "It responds correctly when passed a valid Florida number:"
    $c = new InboundCall(array('From' => '+13051112222'));
    assert_equals($c->region->name, 'Florida');
    assert_equals($c->destination_number, '+13053963679');

    echo "It degrades gracefully when passed random data:"
    $c = new InboundCall(array('Unexpected Param' => 'random'));
    assert_equals($c->region->name, 'Default');
    assert_matches($c->destination_number, '/\+[0-9]{11}/');
  }
}


echo "<pre>"; // Display each echo statement on new line

new PhoneNumberSpec().run();
new RegionSpec().run();
new InboundCallSpec().run();

?>