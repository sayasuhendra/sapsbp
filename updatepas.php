<?php
ob_start('ob_gzhandler');
include "cek-sesion.php";
include "koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  
  
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
  $(document).ready(function($){
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>
</head>

<body>
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	
	<?php
	include "menu.php";
	
	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	
	$updatepas="update usr_tb SET password='$pass' where username='$user'";
	$eksupdatepas=mysql_query($updatepas);
	
	echo '
	<div id="isi">
	<p style="font-family:arial; font-size:14px; margin-top:15px;">
	Password telah berhasil di ubah, klik <a href="logout.php">disini</a> untuk logout. Dan silahkan login kembali dengan password yang baru	</p>
	</div>';
			
	?>
	
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>