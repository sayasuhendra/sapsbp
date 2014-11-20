<?php
	$namapers = $_GET['namapers'];
	include "koneksi.php";
	$pilihcabut="select cirid from customer_data where nama_perusahaan='$namapers'";
	$ekscabut=mysql_query($pilihcabut);
	$databut=mysql_fetch_array($ekscabut);
    echo $databut['cirid'];
?>
