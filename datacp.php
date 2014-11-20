<?php
	$namapers = $_GET['namapers'];
	include "koneksi.php";
	$pilihcabut="select cp_finance from customer_new where nama_perusahaan='$namapers'";
	$ekscabut=mysql_query($pilihcabut);
	$databut=mysql_fetch_array($ekscabut);
    echo $databut['cp_finance'];
?>
