<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
?>
<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> Üye Eylemleri</h1>

		<div class="page-content">
			
			<div class="search-area">
				
				<div class="search-box">
				<form method="POST" action="" id="searchEylemForm" onsubmit="return false;">
					<input type="text" name="src" id="searchEylem" placeholder="&#xf002; Aramak istediğiniz eylem veya kişi...">
				</form>
				</div>

				<div class="search-content user-search-content clearfix">

					<ul class="user-search-container">
						<?php
						$eylemler = $s->query("SELECT * FROM eylemler ORDER BY eylem_id DESC");
						/*
							<li>
								<div class="right eylemright">
									<div class="oneinf"><a class="eylema"><?php echo htmlspecialchars($eylem_yapan); ?></a><span class="eylemspanbir"><?php echo htmlspecialchars($eylem); ?></span> <span class="eylemspaniki">(<?php echo $gun; ?>)</span></div>
								</div>
							</li>
						*/
						while($a = mysqli_fetch_assoc($eylemler)){ 
							$id = $a["eylem_id"];
							$eylem_yapan = $a["eylem_yapan"];
							$eylem = $a["eylem"];
							$eylem_tarih = $a["eylem_tarih"];
							$gun = $s->tr_dateTime($eylem_tarih)." ".date("H:i:s",$eylem_tarih);
						?><li><div class="right eylemright"><div class="oneinf"><a class="eylema"><?php echo htmlspecialchars($eylem_yapan); ?></a><span class="eylemspanbir"><?php echo htmlspecialchars($eylem); ?></span><span class="eylemspaniki">(<?php echo $gun; ?>)</span></div></div></li><?php } //while bitiş ?>

					</ul>

					<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
					<p style="margin-top:-10px">
						<button class="button delbut" onclick="deleteTumEylem();return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; TÜM KAYITLARI SİL</button>
					</p>
					<?php } ?>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>