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
	<div id="header">
		<div class="logo">
			<img src="images/saplogo.png">
		</div>
	</div>
	<?php
	include "menu.php";
	
	?>
	<div id="isi">
		<table cellspacing="15px" >
			<tr>
				
				<td class="tdimg">
					<img src="images/imlogo.png">
					<P class="textbut">Internal Memo</P>
				</td>
				<td class="tdimg">
					<img src="images/fpalogo.png">
					<P class="textbut">Form Penggunaan Akses</P>
				</td>
				<td class="tdimg">
					<img src="images/prog.png">
					<P class="textbut">Progress Harian</P>
				</td>
				
			</tr>
			<tr>
				
				<td class="tdimg">
					<img src="images/bodlogo.png">
					<P class="textbut">BOD Approval</P>
				</td>
				<td class="tdimg">
					<img src="images/baologo.png">
					<P class="textbut">BAO</P>
				</td>
				<td class="tdimg">
					<a href="logout.php">
					<img src="images/logout.png">
					</a>
					<P class="textbut">Logout</P>
					
				</td>
				
			</tr>
		</table>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>