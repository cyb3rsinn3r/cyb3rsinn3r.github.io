<?php
$ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $referrer = $_SERVER['HTTP_REFERER'];
    $date = new DateTime('now');
    $timestamp = $date->format('Y-m-d\TH:i:s.u');
    if ($referrer == "")
        $referrer = "Location(http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']})";
    error_log("$timestamp\nVisitor IP address: $ip\nBrowser: $browser\nReferrer: $referrer\n\n", 3, "log.txt");
?>
<html>
<h1>Welcome!</h1>
</html>
