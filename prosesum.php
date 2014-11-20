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
	
	?>
	<div id="isi">
		<h3 class="judulok">Form Management User SAPSBP</h3>
		<?Php
		$username=$_POST['username'];
		$pass=md5($_POST['pass']);
		$nama=$_POST['nama'];
		$level=$_POST['level'];
		$bagian=$_POST['bagian'];
		$area=$_POST['area'];
		$email=$_POST['email'];
                $pass2=$_POST['pass'];

		$to=$email;
		$subject = "Selamat Datang di SAP SBP";
		$message = "Selamat Bergabung di SAP SBP, ".$nama.". Silahkan login Melalui URL sap.sbp.net.id/ dengan User : ".$username." dan Password : ".$pass2." Untuk Masuk Ke SAP SBP. ";
		$from = "SAPSBP";
		$headers  = "From:SAPSBP";
		$headers .= " : Notifikasi";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$message,$headers);
		$inputuser="insert into usr_tb (bagian,email,area,username,password,nama_lengkap,level) values ('$bagian','$email','$area','$username','$pass','$nama','$level')";
		$excute=mysql_query($inputuser);
		header ('location:um.php');
		
		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>