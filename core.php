<?php
ob_start();
$current_file = $_SERVER['SCRIPT_NAME'];
function sanitize($str) 
{
    $str = @trim($str);
    if(get_magic_quotes_gpc()) 
	{
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}
?>