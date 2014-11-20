<?php
ob_start('ob_gzhandler');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Isi Administrator</title>
</head>
<body>
<?php
include "koneksi.php";
//membuat variabel untuk username dan password login
$username=$_POST['user'];
$password=md5($_POST['pass']);
//lakukan query username dan password di database
$query="SELECT * FROM usr_tb WHERE username='$username'";
$hasil=mysql_query($query);
$baris=mysql_fetch_array($hasil);
$level=$baris['level'];
$bagian=$baris['bagian'];
$area=$baris['area'];
//melakukan check password
if(empty($username)||empty($password)){
	header ("Location: index.php");
	}
	elseif
	($username==$baris['username'] && $password==$baris['password']){
	session_start();
	$_SESSION['username']=$username;
    $_SESSION['password']=$password;
	$_SESSION['level']=$level;
	$_SESSION['bagian']=$bagian;
	$_SESSION['area']=$area;
	$reff = $_SERVER['HTTP_REFERER'];
	if (preg_match("/\?l\=/",$reff)) {
		$url = explode('?l=',$reff);
		header ("Location: $url[1]");
		return;
	}
	if($bagian=='Inventory' && $level=='Staff'){
	header ("Location: assi-inven.php");
	}
	else{
	header ("Location: assi.php");
	}
				
	}else
	{ echo '<h1>Maaf Anda tidak di diiznkan mengakses halaman ini</h1>';}	   
?>
</body>
</html>
