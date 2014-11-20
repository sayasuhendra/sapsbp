<div id="textclose"><a href="#" style="color:#C94133; font-weight:bold; font-style:blink" class="show_hide">Search Project</a></div>
<div class="slidingDiv">
<div id="close"><a href="#" class="show_hide"><img src="images/close.png"></a></div>
		Search Project
		<form action="prosescari.php" method="POST" class="pencarian">
			<table cellspacing="5px">
				<tr>	
					<td width="200px">Kata Kunci</td>
					<td><input type="text" name="keyword" class="cariform"></td>
				</tr>
				<tr>
					<td>Cari Berdasarkan</td>
					<td><select name="dasar">
							<option value="nama">Nama Perusahaan</option>
							<option value="noim">NOIM</option>
                                                        <option value="noc">Pelaksana NOC</option>
							<option value="jenpek">Jenis Pekerjaan</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Submit"></td>
					</td>
				</tr>
			</table>
		</form>
</div>

<script type="text/javascript">
 
$(document).ready(function(){
 
        $(".slidingDiv").hide();
        $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
 
</script>
