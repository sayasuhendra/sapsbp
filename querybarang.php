<?php

include "koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
$sql = "select * from tb_stbarang where serial_num LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
$sernum = $rs['serial_num'];
echo "$sernum\n";
}
?>
