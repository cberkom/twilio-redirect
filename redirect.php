<?php

require('require_all.php');
$site_domain = 'http://' . $_SERVER["SERVER_NAME"];

$call = new InboundCall($_POST);
header ("Content-Type:text/xml");

?><?xml version="1.0" encoding="UTF-8"?>
<Response>
  <Dial timeout="45" action="<?php echo $site_domain . '/track.php' ?>">
    <Number>
      <?php echo $call->destination_number; ?>
    </Number>
  </Dial>
</Response>