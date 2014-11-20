<?php
session_start();
session_cache_expire(3600);
if (!isset($_SESSION['username']))
{
        #$path=end(explode('/',$_SERVER['REQUEST_URI']));
	$path= $_SERVER['REQUEST_URI'];
	echo 'Anda Harus Login Terlebih dahulu, klik <a href="index.php?l='. "$path".'">disini</a>';
	exit;
}

date_default_timezone_set("Asia/Jakarta");

?>