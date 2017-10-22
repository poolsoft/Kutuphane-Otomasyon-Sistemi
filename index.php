<?php
include("sp-sistem/baglanti.php");
if( $s->get_site("site_durum") == 1 ){
	//site açıksa
	$tema = $s->get_site("site_tema");
	require_once("sp-tema/".$tema."/index.php");

}else{
	//site bakımda
	echo "<h1>Under Construction</h1>";
}
?>