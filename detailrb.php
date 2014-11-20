<?php
$pilihbrim="select * from barang where noim='$noimber'";
$eksbrim=mysql_query($pilihbrim);
echo '
<h3>Perangkat Tambahan</h3>
			<div>
			<table class="tbrule" cellspacing="0px">
                        <tr>
                                <td class="td2">No.</td>
                                <td class="td2">Jenis</td>
                                <td class="td2">Merk</td>
                                <td class="td2">Type</td>
                                <td class="td2">Jumlah</td>
                                <td class="td2">Status</td>
                        </tr>
  ';                   $nobri=0;
                       while($databrim=mysql_fetch_array($eksbrim)){$nobri++;
                       echo '	
                       <tr>
                                <td class="td1">'.$nobri.'</td>
                                <td class="td1">'.$databrim['jenis'].'</td>
                                <td class="td1">'.$databrim['merk'].'</td>
                                <td class="td1">'.$databrim['type'].'</td>
                                <td class="td1">'.$databrim['jumlah'].'</td>
                                <td class="td1">'; if($databrim['status']==0){echo 'OK';}else if($databrim['jumlah']==1){echo 'Progress';}else if($databrim['jumlah']=='Pending'){echo 'Pending';}else{echo 'Reject';}  echo'</td>
                        </tr>';
}echo '
				</table><a href="formreqbreng.php?noim='.$datapro['noim'].'" class="butfol">Request Barang Tambahan</a>
					</div>';
					
?>