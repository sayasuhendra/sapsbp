<?php

session_start();

include "cek-sesion.php";

include "koneksi.php";

$user=$_SESSION['username'];

$level=$_SESSION['level'];

$pilihuser="select * from usr_tb where username='$user'";

$eksuser=mysql_query($pilihuser);

$datauser=mysql_fetch_array($eksuser);

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
	date_default_timezone_set('Asia/Jakarta');
		$noim=$_POST['noim'];
		$vendor=$_POST['namavendor'];
		$bw=$_POST['bw'];
		$rfs=$_POST['rfs'];
		$ikg=$_POST['ikg'];
		$aktivasi=$_POST['aktivasi'];
		$keterangan=$_POST['keterangan'];
		$namapers=$_POST['namapers'];
		$tanggal=date('d F Y');
		$jam=date('H:i:s');
		$waktu=$tanggal.', Jam : '.$jam;
		$namauser=$datauser['nama_lengkap'];
		
		echo'

		<h3 class="judulok">Update Status Vendor Untuk Pelanggan '.$namapers.'</h3>';
		
								
		$upstat="update instal_im set statvendor='OK' where noim='$noim'";
		$eksupstat=mysql_query($upstat);	
		
		$upstat2="update internal_memo set statvendor='OK' where noim='$noim'";
		$eksupstat2=mysql_query($upstat2);	
		
		$isireport="Pengerjaan oleh vendor (".$vendor.") untuk pelanggan ".$namapers.", dengan Bandwidth ".$bw." telah selesai dilakukan. Adapun keterangan tambahan : ".$keterangan;
		$inputrep="insert into report_pro (nama_user,tgl,isi_report,noim) values ('$namauser','$waktu','$isireport','$noim')";
		$eksrep=mysql_query($inputrep);
		
		$pilihreport="select * from report_pro where noim='$noim' order by idreport DESC limit 5";
		$eksreport=mysql_query($pilihreport);
		
		$pilihrandom="select * from report_pro inner join usr_tb on report_pro.nama_user=usr_tb.nama_lengkap where report_pro.noim='$noim' order by report_pro.idreport DESC";
		$eksrandom=mysql_query($pilihrandom);
		
		while($datarandom=mysql_fetch_array($eksrandom)){
		$emailrandom=$datarandom['email'];
		$ccrand .=$emailrandom.',';
		}
		
		$to='dco@sbp.net.id';
		$from = "SAPSBP";
        $headers  = "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Noim: " .$noim. "\r\n";
        $headers .= "Cc: ".$ccrand."\r\n";		
		$subject = "Update Progress [".$noim."] ".$namapers;
		$message = '<html><body><p style="font-size : 14px; font-family : lucida grande,tahoma,verdana,arial,sans-serif;">Update Report : '.$namapers.' </p>
<p style="font-size : 11px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; margin-bottom : 10px;
color : #3B3B3B; border-top-left-radius: 3px; border-top-right-radius: 3px; "><b>'.$namauser.'</b>, '.$waktu.' </p>
<p style="font-size : 12px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; color : #3B3B3B;
margin-bottom : 15px; background-color : #edebeb; padding : 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; ">"'.$isireport.'"</p>
                <h3 style="font-weight:bold; font-size: 14px;">History Progress</h3><table>';
		
		while($datareport=mysql_fetch_array($eksreport)){
							$message .= '
							<tr>
								<td class="tdcomment">
									<p style="font-size : 11px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; margin-bottom : 10px;
color : #3B3B3B; border-top-left-radius: 3px; border-top-right-radius: 3px; "><b>'.$datareport['nama_user'].'</b>, '.$datareport['tgl'].' </p>
									<p style="font-size : 12px; font-family : lucida grande,tahoma,verdana,arial,sans-serif; color : #3B3B3B;
margin-bottom : 15px; background-color : #edebeb; padding : 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; ">"'.$datareport['isi_report'].'"</p>
									
								</td>
							</tr>';
		}
		
		$message .='
		</body>
		</html>';
		mail($to,$subject,$message,$headers);
		
		
		
	echo '
		
		



	</div>

	

	<div id="footer">';

	?>

		copyright &copy; www.sbp.net.id 2012 condev-team

	</div>

</body>

</html>
