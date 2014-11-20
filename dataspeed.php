<?php
	$namapers = $_GET['namapers'];
	include "koneksi.php";
	$pilihcabut="select bandwidth_client from customer_new where nama_perusahaan='$namapers'";
	$ekscabut=mysql_query($pilihcabut);
	$databut=mysql_fetch_array($ekscabut);
    echo $databut['bandwidth_client'];
?>
