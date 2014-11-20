if($level=='Staff' && $bagian=='Sales'){
	$sqlCount = "select count(idmemo) from internal_memo where orderby='$namalengkap' AND jenpek='Instalasi'";  
	$rsCount = mysql_fetch_array(mysql_query($sqlCount));  
	$banyakData = $rsCount[0];  
	$page = isset($_GET['page']) ? $_GET['page'] : 1;  
	$limit = 7;  
	$mulai_dari = $limit * ($page - 1);
	$no=0;
	$pilihim="select * from internal_memo where orderby='$namalengkap' AND jenpek='Instalasi' order by idmemo DESC limit $mulai_dari, $limit";
	$eksim=mysql_query($pilihim);
	while($dataim=mysql_fetch_array($eksim)){$no++;
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
	
}	