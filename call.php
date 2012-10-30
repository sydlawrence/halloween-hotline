<?php
require_once('pusher/lib/Pusher.php');
require_once('config.php');

$pusher = new Pusher($config['pusher']['key'], $config['pusher']['secret'], $config['pusher']['app_id']);

$pusher->trigger('twilio_channel', 'new_call', $_POST);
?>
<Response>
    <Say>Thanks for calling the halloween hotline. Your ghost is now on the screen.</Say>
    <Sms>Thanks for calling the halloween hotline :)</Sms>
</Response>