<?php
ob_start("ob_gzhandler");
session_start();
if (isset($_SESSION['username'])){
//session terdaftar, saatnya logout
session_unset();
session_destroy();
echo '<meta http-equiv="refresh" content="1,url=index.php" />';
}

else
{

//variabel session salah, user tidak seharusnya ada dihalaman ini. Kembalikan ke login
echo 'sudah logout silahkan login kembali <a href="index.php">di sini</a>'; 
}
?>