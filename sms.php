<?php
require_once('pusher/lib/Pusher.php');
require_once('config.php');

$pusher = new Pusher($config['pusher']['key'], $config['pusher']['secret'], $config['pusher']['app_id']);

$pusher->trigger('twilio_channel', 'new_sms', $_POST);
?>
<Response>
    <Say>Thanks for texting the halloween hotline. Your ghost is now on the screen.</Say>
</Response>