<?php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($actual_link, 'sp-tema') == false){
	
	if( $s->giris_yapildi() ){
		require_once("panel.php");
	}else{
		require_once("login.php");
	}
	
}else{
	echo "Yetkiniz yok!";
}

?>