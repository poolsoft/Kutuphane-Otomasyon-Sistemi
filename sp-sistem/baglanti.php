<?php
header("Content-type:text/html; charset=UTF-8");
date_default_timezone_set('Europe/Istanbul');
include("sistem.php");
$s = new Sistem();
$s->baglan("localhost","root","","kutuphane");
define("URL", $s->get_site("site_url"));
define("TEMA_URL", $s->get_site("site_url")."/sp-tema/".$s->get_site("site_tema"));
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>