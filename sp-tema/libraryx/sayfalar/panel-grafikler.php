<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$yetkilerx = $s->kullanici($_SESSION["sp_user"],"uye_eylemler");
?>
<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-line-chart" aria-hidden="true"></i> Grafikler</h1>

		<div class="page-content">
			
			<div class="graph">
				<div id="chartContainer1" style="width: 100%; margin:10px auto; height: 250px;display: inline-block;"></div>
				<div id="chartContainer2" style="width: 100%; margin:10px auto; height: 350px;display: inline-block;"></div>
				<div id="chartContainer3" style="width: 100%; margin:10px auto; height: 350px;display: inline-block;"></div>
				</div>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>