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

		<h1 class="page-title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Oops!</h1>

		<div class="page-content">
			<?php echo $dosyax; ?>
			Aradığınız sayfa bulunamadı. Lütfen menüden açmak istediğiniz bölümü seçin.

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>