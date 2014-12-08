<?php

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

?>