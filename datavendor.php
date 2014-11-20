<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namalengkap=$datauser['nama_lengkap'];
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
  <link rel="stylesheet" href="js/jquery-ui.css" />
  <script src="js/jquery-ui.js"></script>
  
  
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
<script>
$(function() {
$( "#show-option" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#show-option2" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#show-option3" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#show-option4" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#show-option1" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#hide-option" ).tooltip({
show: {
effect: "explode",
delay: 250
}
});
$( "#open-event" ).tooltip({
show: null,
position: {
my: "left top",
at: "left bottom"
},
open: function( event, ui ) {
ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
}
});
});
</script>

</head>

<body>
	<?php
        include "header.php";
	include "menu.php";
	
	?>
	<div id="isi">
	
	<?php
	echo '
	<h3 class="judulok">Data Vendor SBP</h3>';
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
        echo ' <a href="formvendor.php"><img style="margin-top:-15px; margin-bottom:10px;" src="images/addven.png" border="0px"></a>
	<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead" width="30px">No</td>
				<td class="tdhead" width="600px">Nama Vendor</td>
				<td class="tdhead2">Delete</td>
			</tr>';
	
	$sqlCount = "select count(id_vendor) from vendor_tb order by nama_vendor ASC";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 7;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from vendor_tb order by nama_vendor ASC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;	
	
	
	echo '
			<tr>
				<td class="tdisi" width="30px">'.$no.'</td>
				<td class="tdisi">'.$dataim['nama_vendor'].'</td>
				<td class="tdisi2"><a onClick="return confirm(\'Apakah Anda Yakin Akan Menghapus Vendor Ini ?\')" href="hapusvendor.php?id_vendor='.$dataim['id_vendor'].'"><img src="images/delete.png"></a>';
				
				echo '</td>
			</tr>
	';
	}
	
	
	
	echo '</table>';
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
				   if($page != $i){
				   echo '<a href="datavendor.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
		
		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>