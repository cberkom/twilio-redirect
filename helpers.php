<?php 

function send_get_request($url) {
  $curl = curl_init($url);
  $success = curl_exec($curl);
  curl_close($curl);
  return $success;
}

?>