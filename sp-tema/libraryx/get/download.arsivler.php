<?php
session_start();
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
  // We'll be outputting an excel file
  header('Content-type: application/vnd.ms-excel');
  // It will be called file.xls
  $uniqad = "arsiv-".uniqid();
  header('Content-Disposition: attachment; filename="'.$uniqad.'.xls"');
  require_once("get.arsivler.php");
}
?>