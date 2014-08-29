<?php

class InboundCall {
  public $inbound_number = '';
  public $region;
  public $destination_number = '';

  public function __construct($twilio_params) { 
    $this->inbound_number     = new PhoneNumber($twilio_params['From']);
    $this->region             = new Region($this->inbound_number->area_code);
    $this->destination_number = $this->region->phone_number;
  }
}

?>