<?php

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


		require 'assi/bulan.php';
	
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

?>