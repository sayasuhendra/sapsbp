<?php
ob_start("ob_gzhandler");
include "cek-sesion.php";
include "koneksi.php";
$user=$_SESSION['username'];
$pilihuser="select * from usr_tb where username='$user'";
$eksuser=mysql_query($pilihuser);
$datauser=mysql_fetch_array($eksuser);
$nama_lengkap=$datauser['nama_lengkap'];
$area=$datauser['area'];
$level=$_SESSION['level'];	
$bagian=$_SESSION['bagian'];	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "title.php";
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="js/popup.css" rel="stylesheet" type="text/css" />
<link href="js/gaya.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
  <script type="text/javascript" src="java/nivo.js"></script>
  <script type="text/javascript" src="java/jquery.watermark.min.js"></script>
  <script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
  <script type="text/javascript" src="js/jquery.dcmegamenu.1.3.3.js"></script>
  <link href="css/skins/white.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/notifikasi.js"></script>
  <script type="text/javascript" src="js/assi.js"></script>
    
</head>

<body>

	
	<?php

	    include "header.php";

		include "menu.php";
	
	?>


	<div id="isi">

	
	<?php


	include 'assi/views/beforetable.php';

	include 'assi/views/tableheader.php';


	if($bagian=='Teknikal' && $level=='Manajer'){

		require 'assi/manajer/teknikalup.php';

	}


	elseif($bagian=='DCO' && $level=='Staff'){

		require 'assi/dco.php';

	}


	elseif($level=='Staff' && $bagian=='Finance' || $level=='Manajer' && $bagian=='Finance'){

		require 'assi/finance.php';

	}


	elseif($level=='Staff' && $bagian=='AR'){
	
		require 'assi/ar.php';

	}


	elseif($level=='Staff' && $bagian=='AP'){
	
		require 'assi/ap.php';
	
	}
	

	elseif($level=='Engineer' && $bagian=='Teknikal'){
	
		require 'assi/engineer.php';

	}
	
	
	elseif($level=='Staff' && $bagian=='Teknikal'){

		require 'assi/teknikal.php';
	
	}


	elseif($level=='Condev' && $bagian=='Teknikal'){

		require 'assi/condev.php';

	}


	elseif($level=='Manajer' && $bagian=='Sales' || $level=='Staff' && $bagian=='Sales'){
		
		require 'assi/manajer/sales.php';
	
	}

	
	elseif($level=='Super Admin' && $bagian=='Umum' || $level=='BOD' && $bagian=='Umum' ){
		
		require 'assi/umum/supernbod.php';

		}


	if($level=='Manajer' && $bagian=='Teknikal'){
		
		require 'assi/manajer/teknikal.php';
	
		}


	else if($level=='Manajer' && $bagian=='Finance'){
		
		require 'assi/manajer/finance.php';
	
		}


	else if($level=='BOD' && $bagian=='Umum'){

		require 'assi/bod.php';
			
		}


	?>
        </div>
        </div>
	</div>
	</div>


    <?php
       include "carikotak.php";
    ?>
	
	<div id="footer">
		copyright &copy; www.sbp.net.id 2012 condev-team
	</div>
</body>
</html>
