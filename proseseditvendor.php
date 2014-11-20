<?php
require 'start.php';
include "cek-sesion.php";

$usersesi = $_SESSION['username'];
$useraktif = User::where('username', $usersesi)->first();

$usersesi = $_SESSION['username'];
$useraktif = User::where('username', $usersesi)->first();

$noim = $_POST['noim'];
$namavendor = $_POST['namavendor'];
$fpa = Fpa::where('noim', $noim)->first();

$namavendorlama = $fpa->akses_pro;

date_default_timezone_set("Asia/Jakarta");
$tanggal=date('d F Y');
$jam=date('H:i:s');
$waktu=$tanggal.', Jam '.$jam;

$fpa->akses_pro = $namavendor;
$fpa->status = "Pending";
$fpa->save();

$instal = Instal::where('noim', $noim)->first();
$instal->status_fin = "NOK";
$instal->save();

$memo = Memo::where('noim', $noim)->first();
$memo->status_fin = "NOK";
$memo->save();

$pilihtm = User::where('bagian', 'AP')->lists('email', 'username');
$to = "";
foreach ($pilihtm as $user => $email) {
	$to .= $email . ", ";
}

$to .= "suhendra@sbp.net.id";

$namapers = $instal->namapers;

$from = "SAPSBP";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: SAP Notification <sap@sbp.net.id>" . "\r\n";
$headers .= "Noim: " .$noim. "\r\n";
$subject = "Perubahan Vendor nomer IM " . $noim;
$message = "Ada perubahan vendor untuk " . $namapers . ", dengan Nomer IM " . $noim . ". Dari Vendor " . $namavendorlama . " menjadi " . $namavendor;

mail($to,$subject,$message,$headers);

$report = new Report;
$report->nofpb = $instal->nofpb;
$report->nama_user = $useraktif->nama_lengkap;
$report->tgl = $waktu;
$report->isi_report = $message;
$report->noim = $noim;
$report->save();

header('Location:detailim.php?noim=' . $noim);

?>