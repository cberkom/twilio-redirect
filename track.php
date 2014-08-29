<?php 
require('require_all.php');
error_reporting(E_ALL);

// Log Completed Calls to Google Analytics
// http://dbgonz.com/tutorials/phone-call-attribution-with-twilio-and-google-universal-analytics/
 
//Fill in your Google Analytics Tracking ID (looks like with UA-XXXXXXX-X)
//This can be found in the property settings of your Google Analytics account
$gatid = 'UA-462890-1';
 
//Create a unique ID (required for all measurement protocol hits)
$uuid = uniqid();
 
//Leave these alone. Twilio is providing the POST variables with the call data
$callStatus = $_POST['CallStatus'];
$callDuration = $_POST['CallDuration'];

//The dimensions included (source, medium, campaign name) are only a few of the available dimensions you can send to GA
//See full list of parameters available in measurement protocol here:
//https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters

$call = new InboundCall($_POST);

$campaignSource = 'sales number';
$campaignMedium = 'call in';
$campaignName = $call->region->name;

$ga_params = array(
  'v'   => 1,
  'tid' => $gatid,
  'cid' => $uuid,
  't'   => 'event',
  'ec'  => 'Twilio',         // Event category
  'ea'  => 'Call',           // Event action
  'el'  => $callStatus,      // Event label
  'ev'  => $callDuration,    // Event value
  'cs'  => $campaignSource,  // Campaign source
  'cn'  => $campaignName,    // Campaign name
  'cm'  => $campaignMedium   // Campaign medium
);

$ga_url = "http://www.google-analytics.com/collect?" . http_build_query($ga_params);
$ga_response = send_get_request($ga_url);

echo "<p> REQUEST: $ga_url </p>";
echo "<div> RESPONSE: $ga_response </div>";

exit;
?>