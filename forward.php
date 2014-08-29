<?php
error_reporting(E_ALL);
require('require_all.php');

$call = new InboundCall($_POST);
header ("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>'
?>
<Response>
  <Dial timeout="45" action="<?php echo url_to('/track.php'); ?>">
    <Number>
      <?php echo $call->destination_number; ?>
    </Number>
  </Dial>
</Response>