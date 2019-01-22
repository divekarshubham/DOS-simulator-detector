<?php
session_start();
echo "Your I.P. address: ".$_SESSION['block']." has been blocked for malicious use!";
?>