<?php

require('require_all.php');

$call = new Call($_POST);
header ("Content-Type:text/xml");

?>

<?xml version="1.0" encoding="UTF-8"?>
<Response>
  <Dial>
    <Number>
      +<?php echo $call->destination_number; ?>
    </Number>
  </Dial>
</Response>