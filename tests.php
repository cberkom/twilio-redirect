<?php

require('classes.php');

class BasicSpec {
  private __construct() { }

  public function assert_equal($subject, $value) {
    if($subject == $value) {
      echo "PASS: $subject == $value";
    } else {
      echo "FAIL: $subject != $value!";
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
}

class PhoneNumberSpec extends BasicSpec {
  private __construct() { }

  public function run() {
    echo "When number includes country code:"
    $p = new PhoneNumber('+13607189934')
    assert_equal($p->number, '+13607189934');
    assert_equal($p->area_code, '360');

    echo "When number does NOT include country code:"
    $p = new PhoneNumber('(360) 718-9934')
    assert_equal($p->number, '+13607189934');
    assert_equal($p->area_code, '360');
  }
}

class RegionSpec extends BasicSpec {
  private __construct() { }

  public function run() {
    echo "When area code is known:"
    $r = new Region('360');
    assert_equal($r->name, 'Northwest');
    assert_equal($r->phone_number, '+16615887337');

    echo "When area code NOT known:"
    $r = new Region('000');
    assert_equal($r->name, 'Unknown');
    assert_equal($r->phone_number, '+13334445555');

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

?>