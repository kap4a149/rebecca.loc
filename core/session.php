<?php
$expireTime = 60*60*24*100; // 100 days
session_set_cookie_params($expireTime);
session_start();
?>