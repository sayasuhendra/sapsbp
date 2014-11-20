<?php

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


    <link rel="stylesheet" type="text/css" href="js/jquery.gritter.css" />
    <script type="text/javascript" src="js/jquery.gritter.js"></script>
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
	
	<?php
	echo '
	<h3 class="judulok">Data Internal Memo Assignment</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">No FPB / No FPC</td>
				<td class="tdhead">Nama Perusahaan</td>
				<td class="tdhead">Tgl RFS</td>
				<td class="tdhead">Order By</td>';
		if($level=='Staff' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Print SPK</td>
				<td class="tdhead">Print BAO</td>';
		}else if($level=='Engineer' && $bagian=='Teknikal'){
		echo '  <td class="tdhead">Pelaksana</td>';
		}
	echo '
				<td class="tdhead2">Followup</td>
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
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpa'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['target'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>';
				if($dataim['status']=='Pending'){
				echo '<td class="tdisi2"><a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a></td>';
				}else if($dataim['status']=='Approve'){
				echo '<td class="tdisi2"><a href="folim.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>';
				}
				echo '
			</tr>
	';
	}
	
	echo '</table>';
	}
        else if($bagian=='Teknikal' && $level=='Condev'){
	$sqlCount = "select count(id_imin) from instal_im where tujuan='$area' and status_spk='NOK' AND jasa='Colocation' OR jasa='Hosting'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where tujuan='$area' AND status_spk='NOK' AND jasa='Colocation' OR jasa='Hosting' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi2">';if($dataim['jasa']=='Colocation' || $dataim['jasa']=='Hosting' ){
                                  echo '<a href="folprov.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
                                  }else{echo 'Engineer Area Assignment';}
                                 
                               echo '
                               </td>
			</tr>
	';
	}
	
	echo '</table>';
	}
	else if($bagian=='DCO' && $level=='Staff'){
	$sqlCount = "select count(id_imin) from instal_im where status_close='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status_close='NOK' order by id_imin DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi2"><a href="formfpa.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>
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
	echo '
			<tr>
				
				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpa'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['target'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2">';
					if($dataim['akses_status']=='Terminasi' || $dataim['akses_status']=='Isolir'){echo '<a href="createimiso.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
					else{echo '<a href="folfpa.php?idfpa='.$dataim['idfpa'].'"><img src="images/follow.png"></a>';}
				echo '
				</td>
			</tr>
	';
	}
	
	echo '</table>';
	}
	
	elseif($level=='Engineer' && $bagian=='Teknikal'){
	$sqlCount = "select count(id_imin) from instal_im where tujuan='$area' and status_spk='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where tujuan='$area' AND status_spk='NOK' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
                                <td class="tdisi">'.$dataim['tujuan'].'</td>
				<td class="tdisi2">';if($dataim['jasa']=='Colocation' || $dataim['jasa']=='Hosting' ){
                                  echo 'Condev Team Assignment';
                                  }else{echo '<a href="folprov.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}
                                 
                               echo '
                               </td>
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
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi"><a href="print-spk.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi"><a target="_blank" href="print-bao.php?noim='.$dataim['noim'].'"><img src="images/print.png"></a></td>
				<td class="tdisi2"><a href="report-bao.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a></td>
			</tr>
	';
	}
	
	echo '</table>';
	}
	elseif($level=='Manajer' && $bagian=='Sales' || $level=='Staff' && $bagian=='Sales'){
	$sqlCount = "select count(id_imin) from instal_im where status='Pending' AND tujuan='Sales'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from instal_im where status='Pending' AND tujuan='Sales' order by id_imin limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['nofpb'].'</td>
				<td class="tdisi">'.$dataim['namapers'].'</td>
				<td class="tdisi">'.$dataim['tglrfs'].'</td>
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi2">';if($dataim['jenis_pekerjaan']=='Terminasi'){
				echo '<a href="upload-fpc.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';}else if($dataim['jenis_pekerjaan']=='Isolir'){
				echo '<a href="appiso.php?noim='.$dataim['noim'].'"><img src="images/follow.png"></a>';
				}
				echo '
				</td>
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
				<td class="tdisi">'.$dataim['nama_sales'].'</td>
				<td class="tdisi2"><a href="folim.php?id_imin='.$dataim['id_imin'].'"><img src="images/follow.png"></a></td>
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
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
	if($level=='Manajer' && $bagian=='Teknikal'){
	$sqlCount = "select count(id_barang) from barang where statustm='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statustm='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	echo '<h3 class="judulok">Data Request Barang Assignment</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead2">Followup</td>
			</tr>';	

	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbrin.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
	
	}else if($level=='Manajer' && $bagian=='Finance'){
	
	$sqlCount = "select count(id_barang) from barang where statusin='OK' and statusfin='NOK'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 8;  
	$mulai_dari = $limit * ($page - 1);  
	$pilihim="select * from barang where statusin='OK' and statusfin='NOK' order by id_barang limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	echo '<h3 class="judulok">Data Request Barang Assignment</h3>';
	echo '<table cellspacing="0px" width="890px">
			<tr>
				<td class="tdhead">No IM</td>
				<td class="tdhead">Jenis Barang</td>
				<td class="tdhead">Merk</td>
				<td class="tdhead">Jumlah</td>
				<td class="tdhead">Order By</td>
				<td class="tdhead2">Followup</td>
			</tr>';	

	while($dataim=mysql_fetch_array($eksim)){
	echo '
			<tr>

				<td class="tdisi">'.$dataim['noim'].'</td>
				<td class="tdisi">'.$dataim['jenis'].'</td>
				<td class="tdisi">'.$dataim['merk'].'</td>
				<td class="tdisi">'.$dataim['jumlah'].'</td>
				<td class="tdisi">'.$dataim['orderby'].'</td>
				<td class="tdisi2"><a href="folreqbrin.php?id_barang='.$dataim['id_barang'].'"><img src="images/follow.png"></a></td>
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
				  echo "<a>$i</a>";
				  }
				  }
			  echo "</ul></div>";
	
	}
		echo '
	<div id="recent">';
	
	$pilihreport="select * from report_pro order by idreport DESC limit 5";
	$eksreport=mysql_query($pilihreport);
	
	
		echo '
		<div id="popup_box">	<!-- OUR PopupBox DIV--><h3 style="color : #3B3B3B;">RECENT PROGRESS UPDATE</h3>';
		while($datarep=mysql_fetch_array($eksreport)){
                $noimrep=$datarep['noim'];
                $pilihnaper="select * from instal_im where noim='$noimrep'";
                $eksnaper=mysql_query($pilihnaper);
                $arnaper=mysql_fetch_array($eksnaper);
                $naper=$arnaper['namapers'];
		echo '<p class="resentp2"><b>'.$datarep['nama_user'].'</b>, '.$datarep['tgl'].' </p>';
		echo '<p class="resentp">'.$datarep['isi_report'].'</p>
                <p class="resentp3">Untuk Perusahaan <b>'.$naper.'</b></p>'
                ;

	
		}
			echo '

			<a id="popupBoxClose"><img src="images/close.png"></a>
			</div>';

		
	
		echo '
		

		

	';
	?>
	</div>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>