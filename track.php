<?php 
require('require_all.php');

// Log Completed Calls to Google Analytics
// http://dbgonz.com/tutorials/phone-call-attribution-with-twilio-and-google-universal-analytics/
 
//Fill in your Google Analytics Tracking ID (looks like with UA-XXXXXXX-X)
//This can be found in the property settings of your Google Analytics account
$gatid = 'UA-XXXXXXX-X';
 
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
 
header("Location: http://www.google-analytics.com/collect?v=1&tid=$gatid&cid=$uuid&t=event&ec=Twilio&ea=Call&el=$callStatus&ev=$callDuration&cs=$campaignSource&cn=$campaignName&cm=$campaignMedium");
 
exit;
?>