<?php

date_default_timezone_set('Asia/Jakarta');
$tgl=date("j F Y");
$jam=date("G:i");

include "koneksi.php";
$pilihremind="select * from tb_remind where tglremind='$tgl' AND jamremind='$jam'";
$eksremind=mysql_query($pilihremind);
while($remind=mysql_fetch_array($eksremind)){
$nama=$remind['nama'];
$pilihemail="select * from usr_tb where nama_lengkap='$nama'";
$eksemail=mysql_query($pilihemail);
$pesan=$remind['pesanremind'];
$email=mysql_fetch_array($eksemail);
		$to=$email['email'];
		$subject = "Reminder SAP";
		$message = $pesan;
		$from = "SAPSBP";
		$headers  = "From:SAPSBP";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$message,$headers);

$idr=$remind['id_remind'];
$hapusre="delete from tb_remind where id_remind='$idr'";
$ekshapus=mysql_query($hapusre);
}


?>
