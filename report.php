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
<script type="text/javascript" src="jquery-ui-1.8.22.custom.min.js"></script>
<link href="css/ui-lightness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css" />
  <script>
	Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"d MM yy"
		};
		
		$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'd MM yy'
			}
		
		);
				
	});

</script>

<script>
function displayResult()
{
var table=document.getElementById("myTable");
var row=table.insertRow(0);
var row2=table.insertRow(1);
var row3=table.insertRow(2);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row2.insertCell(0);
var cell5=row2.insertCell(1);
var cell6=row2.insertCell(2);
var cell7=row3.insertCell(0);
var cell8=row3.insertCell(1);
var cell9=row3.insertCell(2);

cell1.innerHTML="Tgl. Reminder";
cell2.innerHTML=":";
cell3.innerHTML="<input type='text' name='tglremind' class='selectform' id='datepicker' required>";
cell4.innerHTML="Jam Reminder";
cell5.innerHTML=":";
cell6.innerHTML="<input type='text' name='jamremind' class='selectform' placeholder='ex : 10:20' required>";
cell7.innerHTML="Pesan Reminder";
cell8.innerHTML=":";
cell9.innerHTML="<textarea name='pesanremind' cols='30' rows='10' class='selectform' required></textarea>";
}

Date.format = 'DD/MM/yyyy';
	$(function() {
	var pickerOpts = {
			dateFormat:"d MM yy"
		};
		
		$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'd MM yy'
			}
		
		);
				
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
		<h3 class="judulok">Form Update Progress Report</h3>
		<form method="post" name="formcari" action="prosesreport.php">
		<?php
		$noim=$_GET['noim'];
		$pilihim="select * from instal_im where noim='$noim'";
		$eksnoim=mysql_query($pilihim);
		$dataim=mysql_fetch_array($eksnoim);
		$user=$_SESSION['username'];
		$pilihuser="select * from usr_tb where username='$user'";
		$eksuser=mysql_query($pilihuser);
		$datauser=mysql_fetch_array($eksuser);
		
		echo '
		<table class="tbrule" cellspacing="10px">
			<tr>				
				<td>No IM</td>
				<td>:</td>
				<td><input type="text" name="noim" class="selectform" value="'.$noim.'" readonly="true"></td>
			</tr>
			<tr>				
				<td>No FPB</td>
				<td>:</td>
				<td><input type="text" name="nofpb" class="selectform" value="'.$dataim['nofpb'].'" readonly="true"></td>
			</tr>
			<tr>				
				<td>User Report</td>
				<td>:</td>
				<td><input type="text" name="user_report" class="selectform" value="'.$datauser['nama_lengkap'].'" readonly="true">
				</td>
			</tr>
			<tr>				
				<td valign="top">Isi Report</td>
				<td valign="top">:</td>
				<td><textarea name="isireport" cols="30" rows="10" id="elm1" class="ckeditor"></textarea>
				</td>
			</tr>
			<tr>				
				<td valign="top"></td>
				<td valign="top"></td>
				<td>Lakukan Reminder &nbsp;<input type="checkbox" value="yes" name="remind" id="ncek" onclick="if(this.checked){displayResult()}">
				</td>
			</tr>
			</table>
			<table class="tbrule" cellspacing="10px" id="myTable">
			</table>
			<table class="tbrule" cellspacing="10px">
			<tr>				
				<td></td>
				<td></td>
				<td><input type="image" src="images/cek.png"></td>
			</tr>
			
		</table>';
		
						
					  
		?>
		</form>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
