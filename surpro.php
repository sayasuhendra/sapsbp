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
<link href="js/gaya.css" rel="stylesheet" type="text/css" />
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
  $(document).ready(function() {
    setInterval(function() {
         $('.jam');
    }, 1000);
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
	<h3 class="judulok">Data Project Progress</h3>';
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
	echo '<table cellspacing="0px" width="1120px">
			<tr>
				<td class="tdhead" width="30px">No</td>
				<td class="tdhead" width="100px">Time</td>
				<td class="tdhead" width="550px">No IM</td>
				<td class="tdhead" width="500px">Nama Perusahaan</td>
				<td class="tdhead" width="200px">Tgl RFS</td>
				<td class="tdhead" width="300px">Order By</td>
				<td class="tdhead">Pekerjaan</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">Status</td>
				<td class="tdhead">Keterangan</td>
                                <td class="tdhead">Print SPK</td>
				<td class="tdhead2">Detail</td>
				
			</tr>';
	if($level=='Staff' && $bagian=='Sales'){
	$sqlCount = "select count(idmemo) from internal_memo where orderby='$namalengkap' AND jenpek='Survey' AND status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 7;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from internal_memo where orderby='$namalengkap' AND jenpek='Survey' AND status_close='NOK' order by idmemo DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih2=$dataim['tglstart'];
	$delta=$selisih1 - $selisih2;
	// proses mencari jumlah hari
	$a = floor($delta / 86400);

	// proses mencari jumlah jam
	$sisa = $delta % 86400;
	$b  = floor($sisa / 3600);

	// proses mencari jumlah menit
	$sisa = $sisa % 3600;
	$c = floor($sisa / 60);

	// proses mencari jumlah detik
	$sisa = $sisa % 60;
	$d = floor($sisa / 1);
	
	

	echo '
			<tr>
				<td class="tdisi" width="30px">'.$no.'</td>
				<td class="tdisi"><div class="jam">'.$a.' Day</div></td>
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisi">'; if($dataim['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_tm']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_im']=='OK' && $dataim['status_tm']=='OK'){echo 'OK';}elseif($dataim['status_im']=='NOK' && $dataim['status_tm']=='NOK'){echo 'Reject';}else{echo '-';} echo '</td>
       				<td class="tdisi"><a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				
				echo '</td>
			</tr>
	';
	}
	}else{
	$sqlCount = "select count(idmemo) from internal_memo where jenpek='Survey' AND status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 7;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from internal_memo where jenpek='Survey' AND status_close='NOK' order by idmemo DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih2=$dataim['tglstart'];
	$delta=$selisih1 - $selisih2;
	// proses mencari jumlah hari
	$a = floor($delta / 86400);

	// proses mencari jumlah jam
	$sisa = $delta % 86400;
	$b  = floor($sisa / 3600);

	// proses mencari jumlah menit
	$sisa = $sisa % 3600;
	$c = floor($sisa / 60);

	// proses mencari jumlah detik
	$sisa = $sisa % 60;
	$d = floor($sisa / 1);
	
	
	
	echo '
			<tr>
				<td class="tdisi" width="30px">'.$no.'</td>
				<td class="tdisi"><div class="jam">'.$a.' Day</div></td>
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisi">'; if($dataim['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_tm']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($dataim['status_im']=='OK' && $dataim['status_tm']=='OK'){echo 'OK';}elseif($dataim['status_im']=='NOK' && $dataim['status_tm']=='NOK'){echo 'Reject';}else{echo '-';} echo '</td>
				<td class="tdisi"><a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				
				echo '</td>
			</tr>
	';
	}
	}
	
	
	echo '</table>';
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
				   if($page != $i){
				   echo '<a href="surpro.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a style='background-color:#d9d9d9'>$i</a>";
				  }
				  }
			  echo "</ul></div>";
		
		?>
		
	</div>
	
        <?php
            include "carikotak.php";
        ?>
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
