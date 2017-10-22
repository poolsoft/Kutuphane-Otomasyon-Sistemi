<?php
session_start();
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
?>
<?php require_once("panel-header.php"); ?>

<?php
$getPage = $s->g("sayfa");
if(!empty($getPage)){
	$dosya = __DIR__."/sayfalar/panel-".$getPage.".php";
	if(!file_exists($dosya)){
		$dosya = __DIR__."/sayfalar/panel-404.php";
	}
}else{
	$getPage = "anasayfa";
	$dosya = __DIR__."/sayfalar/panel-anasayfa.php";
}

require_once($dosya);
?>

<?php require_once("panel-footer.php"); ?>
<?php } ?>