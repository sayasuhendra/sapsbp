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
$( "#show-optioname" ).tooltip({
show: {
effect: "slideDown",
delay: 250
}
});
$( "#show-optionim" ).tooltip({
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
	<h3 class="judulok">Data Project Progress</h3>
<table width="600px" border="0px" cellspacing="10px" style="margin:-10px 10px 10px -10px;">
		<tr>
			<td><img src="images/sevenday.png"></td>
		
		
			<td><img src="images/fourday.png"></td>
		
			<td><img src="images/aman.png"></td>
		</tr>
		
		
	</table>
	
    <form name="pilih" method="GET" action="reqprodesc.php">
    
	    <select onchange="this.form.submit()" name="tgl" id="confirmThis" style="margin-top : -10px; margin-bottom:10px">
		<option value="">Tampilkan Berdasarkan</option>
		<option value="rfslama">Tanggal RFS Terlama</option>
		<option value="rfsbaru">Tanggal RFS Terbaru</option>
		<option value="update">Last Update</option>
		</select>
		
	</form>';	
    $tglget=$_GET['tgl']; 
	$level=$_SESSION['level'];
	$bagian=$_SESSION['bagian'];
		echo '<table cellspacing="0px" width="1120px">
			<tr>
				<td class="tdhead">No</td>
                <td class="tdhead" width="120px">Time</td>
				<td class="tdhead" width="520px">No IM</td>
				<td class="tdhead" width="550px">Nama Perusahaan</td>
				<td class="tdhead" width="350px">Tgl RFS</td>
				<td class="tdhead" width="350px">Order By</td>
				<td class="tdhead">Pekerjaan</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Inven</td>
				<td class="tdhead">Vendor</td>
				<td class="tdhead">Prov</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
				<td class="tdhead2">Reject</td>
			</tr>';

	if($level=='Staff' && $bagian=='Sales'){
	$sqlCount = "select count(idmemo) from internal_memo where orderby='$namalengkap' AND jenpek='Instalasi' AND status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 5;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	if($tglget=='rfslama'){

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by tglreqok ASC";	
	}else if($tglget=='rfsbaru'){

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by tglreqok DESC";	
	}
	else if($tglget=='update'){

	$pilihim="select * from internal_memo inner join report_pro on internal_memo.noim=report_pro.noim where internal_memo.jenpek='Instalasi' AND status_close='NOK' order by idreport DESC";	
	}
	else{

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by idmemo DESC ";		
	}
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih2=$dataim['tglstart'];
	$delta=$selisih1 - $selisih2;
	
	$dudatepra=substr($dataim['tgl_req'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tgl_req'],2);
    $dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
    $duthn=substr($dataim['tgl_req'],-4);
	
    $bulanaksi=date('F');
	$aneh=date('F');

    switch($dunamebln2)
		{
		case "January" : $namaBln = "01";
					 break;
		case "February" : $namaBln = "02";
					 break;
		case "March" : $namaBln = "03";
					 break;
		case "April" : $namaBln = "04";
					 break;
		case "May" : $namaBln = "05";
					 break;
		case "June" : $namaBln = "06";
					 break;
		case "July" : $namaBln = "07";
					 break;
		case "August" : $namaBln = "08";
					 break;
		case "September" : $namaBln = "09";
					 break;
		case "October" : $namaBln = "10";
					 break;
		case "November" : $namaBln = "11";
					 break;
		case "December" : $namaBln = "12";
					 break;
					 
		}
	
	$batasakhir=$dudate.'-'.$namaBln.'-'.$duthn;
	$warningrsf=strtotime('-0 day',strtotime($batasakhir));
	
	$batasrfslum=$warningrsf-$jatuhtempo;
	$batasrfs = floor($batasrfslum / 86400);
	
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
	
	

	if($batasrfs <= 7){
	echo '
			<tr class="tdgawat">';
	}else if($batasrfs >= 7 && $batasrfs <= 14){
	echo '
			<tr class="tdwarning">';
	}else if($batasrfs > 14){
	echo '
			<tr style="background-color:none;">';
	}
	
	
	echo '
				<td class="tdisi">'.$no.'</td>
				<td class="tdisi"><div class="jam">'.$a.'</div></td>';
                                if($batasrfs <= 7){
                                echo '
                                <td class="tdisi"><a class="nampers2" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers2" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                else if($batasrfs >= 7 && $batasrfs <= 14){
                                echo '
                                <td class="tdisi"><a class="nampers" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                else if($batasrfs > 14){
                                echo '
                                <td class="tdisi"><a class="nampers" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                echo '
				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.substr($dataim['orderby'],0,15).'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisinormal">'; if($dataim['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">';if($dataim['status_tm']=='OK' && $dataim['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($dataim['status_tm']=='OK' && $dataim['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($dataim['status_tm']=='NOK' && $dataim['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				<td class="tdisinormal">'; if($dataim['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$dataim['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($dataim['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$dataim['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$dataim['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>

<td class="tdisinormal">'; if($dataim['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($dataim['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">';
				if($dataim['jenpek']=='Instalasi'){echo '
				<a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				}elseif($dataim['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($dataim['orderby']==$namalengkap){
				echo '<td class="tdisinormal"><a href="editim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else{
				echo '
				<td class="tdisinormal"><img src="images/follow2.png"></td>
				
				';
				}if($level=='BOD'){
				echo '<td class="tdisi2"><a href="rejectpro.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else{echo '<td class="tdisi2"><img src="images/follow2.png"></td>';}
				
				echo '
			</tr>
	';
	}
	}else{
	$sqlCount = "select count(idmemo) from internal_memo where jenpek='Instalasi' AND status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 5;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	if($tglget=='rfslama'){

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by tglreqok ASC";	
	}else if($tglget=='rfsbaru'){

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by tglreqok DESC";	
	}
	else if($tglget=='update'){

	$pilihim="select * from internal_memo inner join report_pro on internal_memo.noim=report_pro.noim where internal_memo.jenpek='Instalasi' AND status_close='NOK' order by idreport DESC";	
	}
	else{

	$pilihim="select * from internal_memo where jenpek='Instalasi' AND status_close='NOK' order by idmemo DESC ";		
	}
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
	$noimbr=$dataim['noim'];
	$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
	$eksbr=mysql_query($pilihbr);
	$hasilbr=mysql_fetch_array($eksbr);
	$selisih1 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih2=$dataim['tglstart'];
	$delta=$selisih1 - $selisih2;
	
	$dudatepra=substr($dataim['tgl_req'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tgl_req'],2);
    $dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
    $duthn=substr($dataim['tgl_req'],-4);
	
    $bulanaksi=date('F');
	$aneh=date('F');

    switch($dunamebln2)
		{
		case "January" : $namaBln = "01";
					 break;
		case "February" : $namaBln = "02";
					 break;
		case "March" : $namaBln = "03";
					 break;
		case "April" : $namaBln = "04";
					 break;
		case "May" : $namaBln = "05";
					 break;
		case "June" : $namaBln = "06";
					 break;
		case "July" : $namaBln = "07";
					 break;
		case "August" : $namaBln = "08";
					 break;
		case "September" : $namaBln = "09";
					 break;
		case "October" : $namaBln = "10";
					 break;
		case "November" : $namaBln = "11";
					 break;
		case "December" : $namaBln = "12";
					 break;
					 
		}
	
	$batasakhir=$dudate.'-'.$namaBln.'-'.$duthn;
	$warningrsf=strtotime('-0 day',strtotime($batasakhir));
	
	$batasrfslum=$warningrsf-$jatuhtempo;
	$batasrfs = floor($batasrfslum / 86400);
	
	
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
	
	
	if($batasrfs <= 7){
	echo '
			<tr class="tdgawat">';
	}else if($batasrfs >= 7 && $batasrfs <= 14){
	echo '
			<tr class="tdwarning">';
	}else if($batasrfs > 14){
	echo '
			<tr style="background-color:none;">';
	}
	
	
	echo '
				<td class="tdisi">'.$no.'</td>
                                <td class="tdisi"><div class="jam">'.$a.'</div></td>';
                                if($batasrfs <= 7){
                                echo '
                                <td class="tdisi"><a class="nampers2" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers2" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                else if($batasrfs >= 7 && $batasrfs <= 14){
                                echo '
                                <td class="tdisi"><a class="nampers" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                else if($batasrfs > 14){
                                echo '
                                <td class="tdisi"><a class="nampers" id="show-optionim" href="#" title="'.$dataim['noim'].'">'.substr($dataim['noim'],0,20).'</a></td>
                                <td class="tdisi"><a class="nampers" id="show-optioname" href="#" title="'.$dataim['namapers'].'">'.substr($dataim['namapers'],0,20).'</a></td>';
                                }
                                echo '				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.substr($dataim['orderby'],0,15).'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisinormal">'; if($dataim['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$dataim['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">';if($dataim['status_tm']=='OK' && $dataim['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($dataim['status_tm']=='OK' && $dataim['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($dataim['status_tm']=='NOK' && $dataim['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$dataim['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				<td class="tdisinormal">'; if($dataim['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$dataim['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($dataim['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$dataim['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$dataim['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
<td class="tdisinormal">'; if($dataim['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">'; if($dataim['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisinormal">';
				if($dataim['jenpek']=='Instalasi'){echo '
				<a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				}elseif($dataim['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($dataim['orderby']==$namalengkap){
				echo '<td class="tdisinormal"><a href="editim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else{
				echo '
				<td class="tdisinormal"><img src="images/follow2.png"></td>
				
				';
				}if($level=='BOD'){
				echo '<td class="tdisi2"><a href="rejectpro.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else{echo '<td class="tdisi2"><img src="images/follow2.png"></td>';}
				
			echo '
			</tr>
	';
	}
	}
	
	
	echo '</table>';

		?>
		
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
