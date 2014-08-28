<?php

class InboundCall {
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