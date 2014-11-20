<?php
include "koneksi.php";

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT nama_perusahaan as nama_perusahaan from customer_new where nama_perusahaan LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
$cname = $rs['nama_perusahaan'];
echo "$cname\n";
}
?>