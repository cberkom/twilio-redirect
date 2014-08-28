<?php

require('classes.php');

class BasicSpec {
  private __construct() { }

  public function assert_equal($subject, $value) {
    if($subject == $value) {
      echo "PASS: $subject == $value";
    } else {
      echo "FAIL: $subject != $value";
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
    assert_equal($r->state, 'wa');
    assert_equal($r->region, 'west');
    assert_equal($r->phone_number, '+12223334444');

    echo "When area code NOT known:"
    $r = new Region('000');
    assert_equal($r->state, 'Unknown');
    assert_equal($r->region, 'Unknown');
    assert_equal($r->phone_number, '+13334445555');
  }
}

?>