<?php 

function send_get_request($url) {
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url
  ));
  $result = curl_exec($curl);
  curl_close($curl);
  return $result;
}

?>