<?php
include("../../sp-sistem/baglanti.php");
$a = session_destroy();
if($a){
	header("Location: ".URL."");
}
?>