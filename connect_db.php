<?php
$addr="localhost";
$username="sarvesh1";
$password="sarvesh123";
mysql_connect($addr,$username,$password) or die('error establishing connection');
mysql_select_db("virtualbank");
?>