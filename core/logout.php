<?php
if($_GET['item'] == 'logout'){
session_start();
unset($_SESSION['auth']);
session_destroy();
}
?>