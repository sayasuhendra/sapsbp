<?php
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
	
	<?php
        include "header.php";
	include "menu.php";
	$user=$_SESSION['username'];
	$username=$_GET['username'];
	
	if($username==$user){
	$useredit="select * from usr_tb where username='$username'";
	$eksedit=mysql_query($useredit);
	$edituser=mysql_fetch_array($eksedit);
	echo '
	<div id="isi">
		<h3 class="judulok">Edit Password User : '.$edituser['username'].'</h3>
		<form method="post" name="formum" action="updatepas.php">
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="user" class="selectform" value="'.$edituser['username'].'">
				</td>
			</tr>
			<tr>				
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="pass" class="selectform">
				</td>
			</tr>
			<tr>				
				<td></td>
				<td></td>
				<td><input type="hidden" name="usrid" value="'.$edituser['usrid'].'"><input type="image" src="images/cek.png"></td>
			</tr>
		</table>
		</form>
		
		
		
	</div>';
	
	}
	else{
	header ('location :isi-admin.php');
	}
	
	?>
	
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>