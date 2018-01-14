<?php
include("connect_db.php");
include("core.php");
session_start();
$user_id=$_SESSION['user_id'];
$bank_approval=0;
$trans_approval=0;
$descrip="Payment to Admin";
$date=$_POST['cleardebtdate'];
$type_bank=$_POST['cleardebtmode'];
$amount=$_POST['cleardebtamt'];
$type_trans="receivable";

$bank_query="INSERT INTO `bank`( `id`, `date`, `descrip`, `amount`, `type`, `approval`) VALUES ('$user_id','$date','$descrip','$amount','$type_bank','$bank_approval')";
$bank_query_run=mysql_query($bank_query);

$ref_transid=mysql_insert_id();

$trans_query="INSERT INTO `transaction`( `id`, `ref_transid`, `date`, `descrip`, `type`, `amount`, `approval`) VALUES ('$user_id','$ref_transid','$date','$descrip','$type_trans','$amount','$trans_approval')";
$trans_query_run=mysql_query($trans_query);
?>