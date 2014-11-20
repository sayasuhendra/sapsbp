<?php
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$namauser=$datauser['nama_lengkap'];
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
	
	?>
	<?php
	echo '
	<div id="isi">
		<h3 class="judulok">Hasil Pencarian </h3>';
		
	$key=$_POST['keyword'];			
	$dasar=$_POST['dasar'];			
	
	if($dasar=='nama'){
	$pilihcari="SELECT * from internal_memo inner join instal_im ON internal_memo.noim=instal_im.noim WHERE internal_memo.namapers LIKE '%$key%' AND instal_im.status!='Rejected'";
	$ekscari=mysql_query($pilihcari);
	$rowcari=mysql_fetch_row($ekscari);
		if($rowcari > 0){
		$eksdatcar=mysql_query($pilihcari);
		echo '<table cellspacing="0px" width="1250px">
			<tr>
				<td class="tdhead" width="550px">No IM</td>
				<td class="tdhead" width="550px">Nama Perusahaan</td>
				<td class="tdhead" width="350px">Tgl RFS</td>
				<td class="tdhead" width="300px">Order By</td>
				<td class="tdhead">Pekerjaan</td>
                                <td class="tdhead">Pelaksana</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Inven</td>
				<td class="tdhead">Vendor</td>
				<td class="tdhead">Prov</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
                                <td class="tdhead2">Edit Pelaksana</td>
			</tr>';
		while($datacari=mysql_fetch_array($eksdatcar)){
		$noimbr=$datacari['noim']; 
		$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
		$eksbr=mysql_query($pilihbr);
		$hasilbr=mysql_fetch_array($eksbr);
		echo '	<tr>
				
				<td class="tdisi">'.$datacari['noim'].'</td>
				<td class="tdisi">'.$datacari['namapers'].'</td>
				<td class="tdisi">'.$datacari['tgl_req'].'</td>
				<td class="tdisi">'.$datacari['orderby'].'</td>
				<td class="tdisi">'.$datacari['jenpek'].'</td>';
                                if($datacari['status_spk']=='NOK'){
                                echo '
				<td class="tdisi">Engineer</td>';
                                }else{
                echo '
				<td class="tdisi">'.$datacari['tujuan'].'</td>';
                }
				echo '
				<td class="tdisi">'; if($datacari['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$datacari['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';if($datacari['status_tm']=='OK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='OK' && $datacari['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='NOK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				
				<td class="tdisi">'; if($datacari['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$datacari['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$datacari['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$datacari['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td><td class="tdisi">';

if($datacari['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';
				if($datacari['jenpek']=='Instalasi' || $datacari['jenpek']=='BOD' || $datacari['jenpek']=='Mutasi'){echo '
				<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Survey'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Terminasi'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($datacari['orderby']==$namauser && $datacari['jenpek']=='Instalasi'){
				echo '<td class="tdisi2"><a href="editim.php?noim='.$datacari['noim'].'"><img src="images/follow.png"></a></td>';
				}else{
				echo '
				<td class="tdisi2"><img src="images/follow2.png"></td>';
				}
                                if($datauser['level']=='Engineer'){
				echo '<td class="tdisi2">';
                                if($datacari['status_close']=='NOK'){
                                  echo '<a href="editpelaksana.php?noim='.$datacari['noim'].'"><img src="images/follow.png"></a></td>';
                                }else{
                                  echo '<img src="images/follow2.png"></td>';
                                } 
                                
				}else{
				echo '
				<td class="tdisi2"><img src="images/follow2.png"></td>';
				}
				
			echo '
			</tr>
	';
		}
	
		}else{
	echo 'Maaf Data Tidak Ditemukan';	
	}
	
	}elseif($dasar=='noim'){
	$pilihcari="SELECT * from internal_memo inner join instal_im ON internal_memo.noim=instal_im.noim WHERE internal_memo.noim LIKE '%$key%' AND instal_im.status!='Rejected'";
	$ekscari=mysql_query($pilihcari);
	$rowcari=mysql_fetch_row($ekscari);
		if($rowcari > 0){
		$eksdatcar=mysql_query($pilihcari);
		echo '<table cellspacing="0px" width="1024px">
			<tr>
                                <td class="tdhead" width="550px">No IM</td>
				<td class="tdhead" width="550px">Nama Perusahaan</td>
				<td class="tdhead" width="350px">Tgl RFS</td>
				<td class="tdhead" width="300px">Order By</td>
				<td class="tdhead">Pekerjaan</td>
                                <td class="tdhead">Pelaksana</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Inven</td>
				<td class="tdhead">Vendor</td>
				<td class="tdhead">Prov</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
			</tr>';
		while($datacari=mysql_fetch_array($eksdatcar)){
		$noimbr=$datacari['noim']; 
		$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
		$eksbr=mysql_query($pilihbr);
		$hasilbr=mysql_fetch_array($eksbr);
		echo '	<tr>
				
				<td class="tdisi">'.$datacari['noim'].'</td>
				<td class="tdisi">'.$datacari['namapers'].'</td>
				<td class="tdisi">'.$datacari['tgl_req'].'</td>
				<td class="tdisi">'.$datacari['orderby'].'</td>
				<td class="tdisi">'.$datacari['jenpek'].'</td>';
                                if($datacari['status_spk']=='NOK'){
                                echo '
				<td class="tdisi">Engineer</td>';
                                }else{
                                echo '
				<td class="tdisi">'.$datacari['tujuan'].'</td>';
                                 }
                                echo '
				<td class="tdisi">'; if($datacari['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$datacari['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';if($datacari['status_tm']=='OK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='OK' && $datacari['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='NOK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				
				<td class="tdisi">'; if($datacari['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$datacari['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$datacari['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$datacari['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td><td class="tdisi">';

if($datacari['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>

				<td class="tdisi">'; if($datacari['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';
				if($datacari['jenpek']=='Instalasi'){echo '
				<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Survey'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Terminasi'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($datacari['orderby']=='$namauser'){
				echo '<td class="tdisi2"><img src="images/follow.png"></td>';
				}else{
				echo '
				<td class="tdisi2"><img src="images/follow2.png"></td>';
				}
				
			echo '
			</tr>
	';
		}
	
		}else{
	echo 'Maaf Data Tidak Ditemukan';	
	}	
	}elseif($dasar=='noc'){
	$pilihcari="SELECT * from internal_memo inner join instal_im ON internal_memo.noim=instal_im.noim WHERE instal_im.tujuan LIKE '%$key%' AND instal_im.status!='Rejected'";
	$ekscari=mysql_query($pilihcari);
	$rowcari=mysql_fetch_row($ekscari);
		if($rowcari > 0){
		$eksdatcar=mysql_query($pilihcari);
		echo '<table cellspacing="0px" width="1024px">
			<tr>
				<td class="tdhead" width="550px">No IM</td>
				<td class="tdhead" width="550px">Nama Perusahaan</td>
				<td class="tdhead" width="350px">Tgl RFS</td>
				<td class="tdhead" width="300px">Order By</td>
				<td class="tdhead">Jenis Pekerjaan</td>
                                <td class="tdhead">Pelaksana</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Vendor</td>
				<td class="tdhead">Inven</td>
				<td class="tdhead">Prov</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
			</tr>';
		while($datacari=mysql_fetch_array($eksdatcar)){
		$noimbr=$datacari['noim']; 
		$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
		$eksbr=mysql_query($pilihbr);
		$hasilbr=mysql_fetch_array($eksbr);
		echo '	<tr>
				
				<td class="tdisi">'.$datacari['noim'].'</td>
				<td class="tdisi">'.$datacari['namapers'].'</td>
				<td class="tdisi">'.$datacari['tgl_req'].'</td>
				<td class="tdisi">'.$datacari['orderby'].'</td>
				<td class="tdisi">'.$datacari['jenpek'].'</td>';
                                if($datacari['status_spk']=='NOK'){
                                echo '
				<td class="tdisi">Engineer</td>';
                                }else{
                                echo '
				<td class="tdisi">'.$datacari['tujuan'].'</td>';
                                 }
                                echo '
				<td class="tdisi">'; if($datacari['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$datacari['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';if($datacari['status_tm']=='OK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='OK' && $datacari['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='NOK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				
				<td class="tdisi">'; if($datacari['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$datacari['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$datacari['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$datacari['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td><td class="tdisi">';

if($datacari['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';
				if($datacari['jenpek']=='Instalasi'){echo '
				<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Survey'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Terminasi'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($datacari['orderby']=='$namauser'){
				echo '<td class="tdisi2"><img src="images/follow.png"></td>';
				}else{
				echo '
				<td class="tdisi2"><img src="images/follow2.png"></td>';
				}
				
			echo '
			</tr>
	';
		}
	
		}else{
	echo 'Maaf Data Tidak Ditemukan';	
	}	
	}elseif($dasar=='jenpek'){
	$pilihcari="SELECT * from internal_memo inner join instal_im ON internal_memo.noim=instal_im.noim WHERE internal_memo.jenpek LIKE '%$key%' AND instal_im.status!='Rejected'";
	$ekscari=mysql_query($pilihcari);
	$rowcari=mysql_fetch_row($ekscari);
		if($rowcari > 0){
		$eksdatcar=mysql_query($pilihcari);
		echo '<table cellspacing="0px" width="1024px">
			<tr>
                                <td class="tdhead" width="550px">No IM</td>
				<td class="tdhead" width="550px">Nama Perusahaan</td>
				<td class="tdhead" width="350px">Tgl RFS</td>
				<td class="tdhead" width="300px">Order By</td>
				<td class="tdhead">Pekerjaan</td>
                                <td class="tdhead">Pelaksana</td>
				<td class="tdhead">IM</td>
				<td class="tdhead">FPA</td>
				<td class="tdhead">PO</td>
				<td class="tdhead">SPK</td>
				<td class="tdhead">Vendor</td>
				<td class="tdhead">Inven</td>
				<td class="tdhead">Prov</td>
				<td class="tdhead">Detail</td>
				<td class="tdhead2">Edit</td>
			</tr>';
		while($datacari=mysql_fetch_array($eksdatcar)){
		$noimbr=$datacari['noim']; 
		$pilihbr="SELECT SUM(status) as jumstat FROM barang where noim='$noimbr'";
		$eksbr=mysql_query($pilihbr);
		$hasilbr=mysql_fetch_array($eksbr);
		echo '	<tr>
				
				<td class="tdisi">'.$datacari['noim'].'</td>
				<td class="tdisi">'.$datacari['namapers'].'</td>
				<td class="tdisi">'.$datacari['tgl_req'].'</td>
				<td class="tdisi">'.$datacari['orderby'].'</td>
				<td class="tdisi">'.$datacari['jenpek'].'</td>';
                                if($datacari['status_spk']=='NOK'){
                                echo '
				<td class="tdisi">Engineer</td>';
                                }else{
                                echo '
				<td class="tdisi">'.$datacari['tujuan'].'</td>';
                                 }
                                echo '
				<td class="tdisi">'; if($datacari['status_im']=='OK'){echo '<a id="show-option" href="#" title="'.$datacari['tglupim'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';if($datacari['status_tm']=='OK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='OK' && $datacari['status_fin']=='NOK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok.png"></a>';}
				else if($datacari['status_tm']=='NOK' && $datacari['status_fin']=='OK'){echo '<a id="show-option2" href="#" title="'.$datacari['tglupfpa'].'"><img src="images/cekok2.png"></a>';}
				else{echo '<img src="images/stop.png">';} 
				echo '</td>
				
				<td class="tdisi">'; if($datacari['status_fin']=='OK'){echo '<a id="show-option3" href="#" title="'.$datacari['tgluppo'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_spk']=='OK'){echo '<a id="show-option4" href="#" title="'.$datacari['tglupspk'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($hasilbr['jumstat']==0){echo '<a id="show-option1" href="#" title="'.$datacari['tglupinven'].'"><img src="images/cekok.png"></a>';}else{echo '<img src="images/stop.png">';} echo '</td><td class="tdisi">';

if($datacari['statvendor']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">'; if($datacari['status_close']=='OK'){echo '<img src="images/cekok.png">';}else{echo '<img src="images/stop.png">';} echo '</td>
				<td class="tdisi">';
				if($datacari['jenpek']=='Instalasi'){echo '
				<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Isolir'){
				echo '<a href="detailiso.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Survey'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}elseif($datacari['jenpek']=='Terminasi'){
				echo '<a href="detailim.php?noim='.$datacari['noim'].'"><img src="images/detail.png"></a>';
				}
				echo '</td>';
				if($datacari['orderby']=='$namauser'){
				echo '<td class="tdisi2"><img src="images/follow.png"></td>';
				}else{
				echo '
				<td class="tdisi2"><img src="images/follow2.png"></td>';
				}
				
			echo '
			</tr>
	';
		}
	
		}else{
	echo 'Maaf Data Tidak Ditemukan';	
	}	
	}
						 
	echo '		
			
	</div>';
	?>
	
	<div id="footer">copyright &copy; www.sbp.net.id 2012 condev-team</div>
</body>
</html>
