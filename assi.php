<?php
ob_start("ob_gzhandler");
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];
$area=$datauser['area'];
$level=$_SESSION['level'];	
$bagian=$_SESSION['bagian'];	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="js/popup.css" rel="stylesheet" type="text/css" />
<link href="js/gaya.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  <script type="text/javascript" src="java/nivo.js"></script>
  <script type="text/javascript" src="java/jquery.watermark.min.js"></script>
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/notifikasi.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function($){
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>




<script type="text/javascript">

	

	$(document).ready( function() {

	

		// When site loaded, load the Popupbox First

		loadPopupBox();

	

		$('#popupBoxClose').click( function() {			

			unloadPopupBox();

		});

		

		$('#container').click( function() {

			unloadPopupBox();

		});



		function unloadPopupBox() {	// TO Unload the Popupbox

			$('#popup_box').fadeOut("slow");

			$("#container").css({ // this is just for style		

				"opacity": "1"  

			}); 

		}	

		

		function loadPopupBox() {	// To Load the Popupbox

			$('#popup_box').fadeIn("slow");

			$("#container").css({ // this is just for style

				"opacity": "0.3"  

			}); 		

		}

		/**********************************************************/

		

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
        <p style="margin-bottom:-15px; color : #ED2024">Selamat datang <b>'.$nama_lengkap.' !</b> </p>
	<h3 class="judulok">Data Internal Memo Assignment</h3>
        <table width="600px" border="0px" cellspacing="10px" style="margin:-10px 10px 10px -10px;">
		<tr>
			<td><img src="images/sevenday.png"></td>
		
		
			<td><img src="images/fourday.png"></td>
		
			<td><img src="images/aman.png"></td>
		</tr>
		
		
	</table>
	<form name="pilih" method="GET" action="assiurut.php">

	    <select onchange="this.form.submit()" name="tgl" id="confirmThis" style="margin-top : -10px; margin-bottom:10px">
		<option value="">Tampilkan Berdasarkan</option>
		<option value="rfslama">Tanggal RFS Terlama</option>
		<option value="rfsbaru">Tanggal RFS Terbaru</option>
		<option value="update">Last Update</option>
		</select>
		
	</form>
';
	echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead" width="350px">No FPB / No FPC</td>
				<td class="tdhead" width="300px">Nama Perusahaan</td>
     			<td class="tdhead" width="200px">Tgl RFS</td>
				<td class="tdhead" width="300px">Jenis Pekerjaan</td>
				<td class="tdhead">Order By</td>';
		if($level=='Staff' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Print SPK</td>
				<td class="tdhead">Print BAO</td>';
		}else if($level=='Condev' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Print SPK</td>
				<td class="tdhead">Print BAO</td>				
                                <td class="tdhead">Pelaksana</td>';
		}else if($level=='Engineer' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Pelaksana</td>
		<td class="tdhead">Perangkat</td>';
		}
	echo '

                                <td class="tdhead">Followup</td>
                                <td class="tdhead2">Detail</td>
	</tr>';
		
	if($bagian=='Teknikal' && $level=='Manajer'){
	$sqlCount = "select count(idfpa) from fpa_tb where status_tm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from fpa_tb where status_tm='NOK' order by idfpa DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){

	$dudatepra=substr($dataim['target'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['target'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['target'],-4);


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

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpa'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['target'].'</td>
				<td class="tdisi">'.$dataim['akses_status'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>';
				if($dataim['status']=='Pending' && $dataim['akses_status']=='PSB'){
				echo '<td class="tdisi"><a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a></td>';
				}else if($dataim['status']=='Approve'){
				echo '<td class="tdisi"><a href="folim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else if($dataim['status']=='Pending' && $dataim['akses_status']=='Terminasi'){
				echo '<td class="tdisi"><a href="folfpac.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a></td>';
				}else if($dataim['status']=='Pending' && $dataim['akses_status']=='Survey'){
				echo '<td class="tdisi"><a href="folim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}else{
                                echo '<td class="tdisi"><a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a></td>';
				}
                                if($dataim['akses_status']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '

			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($bagian=='DCO' && $level=='Staff'){
    $termkus="select * from instal_im";
    $ekskus=mysql_query($termkus);
    $daterm=mysql_fetch_array($ekskus);
    if($daterm['jenis_pekerjaan']=='Terminasi'){
    $sqlCount = "select count(id_imin) from instal_im where status_fin='OK' AND status_tm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_fin='OK' AND status_tm='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	
	$pilihfpa="select * from fpa_tb where noim='$noim'";
	$eksfpa=mysql_query($pilihfpa);
	$noimfpa=mysql_fetch_row($eksfpa);
	
	
	}else{
    $sqlCount = "select count(id_imin) from instal_im where status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	
	
	
	}
	while($dataim=mysql_fetch_array($eksim)){
	
	$dudatepra=substr($dataim['tglrfs'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tglrfs'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tglrfs'],-4);


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
	
	$noimpra=$dataim['noim'];
	$pilihfpa="select * from fpa_tb where noim='$noimpra'";
	$eksfpa=mysql_query($pilihfpa);
	$noimfpa=mysql_fetch_row($eksfpa);
	
	echo '
        
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';
                                if($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_im']=='OK'){echo '<a href="formfpac.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
				elseif($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_im']=='NOK'){echo '<img src="images/follow2.png">';}
                elseif($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}				elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='NOK' && $noimfpa<=0){echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
				elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='NOK' && $noimfpa>0){echo '<img src="images/follow2.png">';}
				elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='OK' && $dataim['statvendor']==''){echo '<a href="upvendor.php?noim='.$dataim['noim'].'"><img src="images/editvendor.png"></a>';}
				
                                elseif($dataim['jenis_pekerjaan']=='Instalasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}

			elseif($dataim['jenis_pekerjaan']=='BOD' && $dataim['status_tm']=='NOK' && $noimfpa>0){echo '<img src="images/follow2.png">';}

                                elseif($dataim['jenis_pekerjaan']=='BOD' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}

                                elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='NOK'){echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
								elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='NOK' && $noimfpa>0 ){echo '<img src="images/follow2.png">';}
						        elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='OK' && $noimfpa>0 && $dataim['statvendor']=='' ){echo '<a href="upvendor.php?noim='.$dataim['noim'].'"><img src="images/editvendor.png"></a>';}
								elseif($dataim['jenis_pekerjaan']=='Mutasi' && $dataim['status_tm']=='OK'){echo '<img src="images/follow2.png">';}
				elseif($dataim['jenis_pekerjaan']=='Survey'){echo '<a href="appsur.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
				else{
				echo '<a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
				}
				echo '
				</td>';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Staff' && $bagian=='Finance' || $level=='Manajer' && $bagian=='Finance'){
	$sqlCount = "select count(idfpa) from fpa_tb where status='Pending'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from fpa_tb where status='Pending' order by idfpa limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
    
	while($dataim=mysql_fetch_array($eksim)){
	$dudatepra=substr($dataim['target'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['target'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['target'],-4);


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
	
				
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpa'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['target'].'</td>
				<td class="tdisi">'.$dataim['akses_status'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">';
					if($dataim['akses_status']=='Terminasi'){echo '<a href="folfpac.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
					else{echo '<a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
				echo '
				</td>
                                <td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>
			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Staff' && $bagian=='AR'){
	$sqlCount = "select count(idmemo) from internal_memo where status_im='NOK' AND jenpek='Terminasi'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from internal_memo where status_im='NOK' AND jenpek='Terminasi' order by idmemo limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
    
	while($dataim=mysql_fetch_array($eksim)){
	$dudatepra=substr($dataim['tgl_req'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tgl_req'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tgl_req'],-4);


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
	
				
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">-</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tgl_req'].'</td>
				<td class="tdisi">'.$dataim['jenpek'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi"><a href="cabutim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>
                                ';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Staff' && $bagian=='AP'){
	
	$sqlCount = "select count(idfpa) from fpa_tb where status='Pending'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from fpa_tb where status='Pending' order by idfpa limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
    
	while($dataim=mysql_fetch_array($eksim)){
	
	$dudatepra=substr($dataim['target'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['target'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['target'],-4);


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
	
				
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpa'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['target'].'</td>
				<td class="tdisi">'.$dataim['akses_status'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi">';
					if($dataim['akses_status']=='Terminasi'){echo '<a href="folfpac.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
					else{echo '<a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
				echo '
				</td>';
                                if($dataim['akses_status']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
			</tr>
	';
	}
	
	echo '</table>';
	}
	
	elseif($level=='Engineer' && $bagian=='Teknikal'){
	$sqlCount = "select count(id_imin) from instal_im where area='$area' AND status_close='NOK' or area='Global'  AND status_close='NOK' ";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where area='$area' AND status_close='NOK' or area='Global'  AND status_close='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	$noim=$dataim['noim'];
	$pilihbrt="select * from barang where noim='$noim'";
	$eksbrt=mysql_query($pilihbrt);
	$brt=mysql_fetch_row($eksbrt);
	$dudatepra=substr($dataim['tglrfs'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tglrfs'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tglrfs'],-4);


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

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
                           <td class="tdisi">'.$dataim['tujuan'].'</td>';
				if($brt<=0){
				echo '<td class="tdisi"><img src="images/stop.png"></td>';
				}else{echo '<td class="tdisi"><img src="images/cekok.png"></td>';}
				
				echo '
				<td class="tdisi">';if($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_spk']=='NOK'){echo '<a href="pilih-term.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
				elseif($dataim['jenis_pekerjaan']=='Survey'){echo '<a href="pilih-survey.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
                                elseif($dataim['status_spk']=='OK'){echo '<img src="images/follow2.png">';}
                                elseif($dataim['jenis_pekerjaan']=='Terminasi' && $dataim['status_spk']=='OK'){echo '<img src="images/follow2.png">';}
				else{echo '<a href="folprov.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}echo '
				</td>';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
			</tr>
	';
	}
	
	echo '</table>';
	}
	
	
	elseif($level=='Staff' && $bagian=='Teknikal'){
	$sqlCount = "select count(id_imin) from instal_im where status_close='NOK' AND tujuan='$nama_lengkap'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' AND tujuan='$nama_lengkap' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	$dudatepra=substr($dataim['tglrfs'],0,2);
	$dudateaja=trim($dudatepra);
	$dudate=sprintf("%02s",$dudateaja);
	$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
	$dubln=substr($dataim['tglrfs'],2);
	$dunamebln=substr($dubln,0,-4);
	$dunamebln2=trim($dunamebln);
	$duthn=substr($dataim['tglrfs'],-4);


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

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<a target="_blank" href="print-spkterm.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                }else{echo '<a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                }
                                echo '
				<td class="tdisi"><a target="_blank" href="print-bao.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>';
                                if($dataim['jenis_pekerjaan']=='Instalasi'){
                                echo '<td class="tdisi"><a href="report-bao.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<td class="tdisi"><a href="report-term.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Mutasi'){
                                echo '<td class="tdisi"><a href="report-mut.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Survey'){
                                echo '<td class="tdisi"><a href="report-survey.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='BOD'){
                                echo '<td class="tdisi"><a href="reportbod.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '
				
			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Condev' && $bagian=='Teknikal'){
	$sqlCount = "select count(id_imin) from instal_im where status_close='NOK' AND tujuan='Team Condev'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' AND tujuan='Team Condev' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi"><a target="_blank" href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi"><a target="_blank" href="print-bao.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
                                <td class="tdisi">'.$dataim['tujuan'].'</td>';
                                 if($dataim['jenis_pekerjaan']=='Instalasi'){
                                echo '<td class="tdisi"><a href="report-condev.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Terminasi'){
                                echo '<td class="tdisi"><a href="report-term.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }else if($dataim['jenis_pekerjaan']=='Survey'){
                                echo '<td class="tdisi"><a href="report-survey.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
                                }
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '

			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Manajer' && $bagian=='Sales' || $level=='Staff' && $bagian=='Sales'){
		
	$sqlCount = "select count(id_imin) from instal_im where status='Pending' AND tujuan='Sales' order by noim desc";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status='Pending' AND tujuan='Sales' order by noim desc limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi">';if($dataim['jenis_pekerjaan']=='Terminasi'){
				echo '<a href="appiso.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}else if($dataim['jenis_pekerjaan']=='Isolir'){
				echo '<a href="appiso.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
				}
				echo '
				</td>';
                                if($dataim['jenis_pekerjaan']=='Terminasi'){echo '<td class="tdisi2"><a href="detailiso.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                else{echo '<td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>';}
                                echo '

			</tr>
	';
	}
	
	echo '</table>';
	}
	
	elseif($level=='Super Admin' && $bagian=='Umum' || $level=='BOD' && $bagian=='Umum' ){
	$sqlCount = "select count(id_imin) from instal_im where tujuan='BOD'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where tujuan='BOD' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['jenis_pekerjaan'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi"><a href="folim.php?id_imin='.$dataim['id_imin'].'"><img src="images/follow.png"></a></td>
                                <td class="tdisi2"><a href="detailim.php?noim='.$dataim['noim'].'"><img src="images/detail.png"></a></td>
			</tr>
	';
	}
	
	echo '</table>';
	}
	
	$banyakHalaman = ceil($banyakData / $limit);
				echo '
				<div id="paging_button">
				<ul><p style="font-family:verdana; font-size:12px; margin-top:2px; color:#4e4c47; float:left;">Halaman :</p>';
				  for($i=1; $i<=$banyakHalaman; $i++){
                                  if($page != $i){
				   echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a style='background-color:#d9d9d9'>$i</a>";
				  }				  }
			  echo "</ul></div>";
		
	
	if($level=='Manajer' && $bagian=='Teknikal'){
	echo '
	<h3 class="judulok">Data Request Barang Assignment</h3>
	<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
                                
				<td class="tdhead2">Followup</td>
			</tr>';
	$sqlCount = "select count(id_barang) from barang where statustm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statustm='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				   echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a style='background-color:#d9d9d9'>$i</a>";
				  }				  }
			  echo "</ul></div>";
	
	}
	else if($level=='Manajer' && $bagian=='Finance'){
	echo '
	<h3 class="judulok">Data Request Barang Assignment</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
                                <td class="tdhead">Nama Pelanggan</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead2">Followup</td>
			</tr>';
	$sqlCount = "select count(id_barang) from barang where statusfin='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statusfin='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
        $noember=$dataim['noim'];
        $pilihmber="select * from instal_im where noim='$noember'";
        $eksember=mysql_query($pilihmber);
        $namaber=mysql_fetch_array($eksember);
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
                                <td class="tdisi">'.$namaber['namapers'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				   echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a style='background-color:#d9d9d9'>$i</a>";
				  }				  }
			  echo "</ul></div>";
	
	}
	else if($level=='BOD' && $bagian=='Umum'){
	echo '
	<h3 class="judulok">Data Request Barang Assignment</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead2">Followup</td>
			</tr>';
	$sqlCount = "select count(id_barang) from barang";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statuspo='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbr.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				   echo '<a href="assi.php?page='.$i.'"<li id="'.$i.'">'.$i.'</li></a>';
				  }else {
				  echo "<a style='background-color:#d9d9d9'>$i</a>";
				  }
				  }
			  echo "</ul></div>";
	
	}	
		
			echo '
		<div id="kepala">

			<span id="pesan">

			<span id="viewrec">View Recent Update</span>

			<span id="notifikasi"></span>

			</span>
		<div id="info">
                <div id="close"><a id="close"><img src="images/close.png"></a></div>
			<div id="konten-info">
			<div id="content">';

		$pilihreport="select * from report_pro order by idreport DESC limit 8";
		$eksreport=mysql_query($pilihreport);

		

		while($datarep = mysql_fetch_array($eksreport)){
                $noimfb=$datarep['noim'];
                $pilihnampro="select * from instal_im where noim='$noimfb'"; 
                $eksnampro=mysql_query($pilihnampro);
                $nampro=mysql_fetch_array($eksnampro);

			echo '<p class="resentp2"><b>'.$datarep['nama_user'].'</b>, '.$datarep['tgl'].' </p>';

			echo '<p class="resentp">'.$datarep['isi_report'].'</p>';

                        echo '<p class="resentp">Project Untuk : '.$nampro['namapers'].'</p>
                        <p class="resentp3"><a style="color:#C94133" href="detailim.php?noim='.$nampro['noim'].'" target="_blank">Detail</a></p>
';
			
		}

	?>
        </div>
        </div>
	</div>
	</div>
        <?php
           include "carikotak.php";
        ?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
