<?php
session_start();
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
	function g($a){
		return addslashes(htmlspecialchars($_GET[$a]));
	}
	$action = g("action");
	if(empty($action)){
		$action = "tum";
	}
	// We'll be outputting an excel file
	header('Content-type: application/vnd.ms-excel');
	// It will be called file.xls
	$tarih = date("d.m.Y");
    $uniqad = "teslimler-".$action."-".$tarih;
	header('Content-Disposition: attachment; filename="'.$uniqad.'.xls"');
	require_once("get.teslimler.php");
}
?>