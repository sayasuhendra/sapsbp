<?php
	$cirid = $_GET['cirid'];
	include "koneksi.php";
	$pilihcabut="select nama_perusahaan from customer_data where cirid='$cirid'";
	$ekscabut=mysql_query($pilihcabut);
	$databut=mysql_fetch_array($ekscabut);
    echo $databut['nama_perusahaan'];
?>
