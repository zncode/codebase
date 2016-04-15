<?php

$file = popen("/usr/local/php/bin/php /export/webapps/inner/script/server_pub.php '{$mac}' '{$msg}' '{$id}'", 'w');

pclose($file);
