<?php
ob_start('ob_gzhandler');

include "koneksi.php";

$noim=$_GET['noim'];
$status='OK';

$proses="update instal_im set statbil='$status' where noim='$noim'";
$ekspro=mysql_query($proses);

header ("location:billpro.php");

?>