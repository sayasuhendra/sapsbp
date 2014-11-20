<?php
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tgl=date("j F Y");
$jam=date("G:i");


$tglkedua=date("d F Y");
$pilihremind2="select * from instal_im where status_close='NOK'";
$eksremind2=mysql_query($pilihremind2);
while($remind2=mysql_fetch_array($eksremind2)){
$nama2=$remind2['nama_sales'];
$nampers=$remind2['namapers'];
$dudatepra=substr($remind2['tglrfs'],0,2);
$dudateaja=trim($dudatepra);
$dudate=sprintf("%02s",$dudateaja);
$jatuhtempo=mktime(date("d"), date("m"), date("Y"));
$dubln=substr($remind2['tglrfs'],2);
$dunamebln=substr($dubln,0,-4);
$dunamebln2=trim($dunamebln);
$duthn=substr($remind2['tglrfs'],-4);


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

if($batasrfs <= 7 &&  $batasrfs > 3){

$pilihemail2="select * from usr_tb where nama_lengkap='$nama2'";
$eksemail2=mysql_query($pilihemail2);
$pesan2="Project untuk ".$nampers." Tinggal tersisa waktu kurang dari satu minggu dari sekarang, silahkan di review dan update terkait project ini melalui SAP";
$email2=mysql_fetch_array($eksemail2);
		$to2=$email2['email'];
		$subject2 = "remind2er SAP";
		$message2 = $pesan2;
		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
		
		mail($to2,$subject2,$message2,$headers2);
	

}else if($batasrfs <= 3 && $batasrfs > 0){
$pilihemail2="select * from usr_tb where nama_lengkap='$nama2'";
$eksemail2=mysql_query($pilihemail2);
$pesan2="Project untuk ".$nampers." Tinggal tersisa waktu kurang dari 3 hari dari sekarang, silahkan di review dan update terkait project ini melalui SAP";
$email2=mysql_fetch_array($eksemail2);
		$to2=$email2['email'];
		$subject2 = "remind2er SAP";
		$message2 = $pesan2;
		$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
		
		mail($to2,$subject2,$message2,$headers2);

}
else if($batasrfs <= 0){
$pilihemail2="select * from usr_tb where nama_lengkap='$nama2'";
$eksemail2=mysql_query($pilihemail2);
$pesan2="Project untuk ".$nampers." telah melewati batas target RFS, silahkan di review dan update terkait project ini melalui SAP";
$email2=mysql_fetch_array($eksemail2);
		$to2=$email2['email'];
		$subject2 = "remind2er SAP";
		$message2 = $pesan2;
                $headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $headers .= "Noim: " .$noim. "\r\n";
		
		mail($to2,$subject2,$message2,$headers2);

}


}

?>