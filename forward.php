<?php
//error_reporting(E_ALL);
//require('require_all.php');
//$site_domain = 'http://' . $_SERVER["SERVER_NAME"];

//$call = new InboundCall($_POST);
//header ("Content-Type: text/xml");

?>Hello
<Response>
  <Dial timeout="45" action="<?php echo $site_domain . '/track.php'; ?>">
    <Number>
      <?php echo "World"; //$call->destination_number; ?>
    </Number>
  </Dial>
</Response>