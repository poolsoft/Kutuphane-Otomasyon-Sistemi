<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="noindex,nofollow">
	<meta charset="UTF-8">
	<title><?php echo $s->get_site("site_isim"); ?> - <?php echo $s->get_site("site_okul"); ?></title>
	<meta name="author" content="seckinpoyraz.com" />

	<!-- icon -->
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMA_URL; ?>/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMA_URL; ?>/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMA_URL; ?>/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMA_URL; ?>/images/favicon-16x16.png">

	<!-- Responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">

	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/css/messi.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/pickadate/themes/default.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/pickadate/themes/default.date.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/pickadate/themes/default.time.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/style.css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="panel-page">
	<a href="#" class="hamburger-icon"><i class="fa fa-bars" aria-hidden="true"></i></a>
	<div class="sidebar">
		<h1 class="side-title"><i class="fa fa-book" aria-hidden="true"></i> <?php echo $s->get_site("site_isim"); ?></h1>
		<nav class="left-menu">
			<ul>
				<li><a href="?sayfa=anasayfa"><span class="left"><i class="fa fa-home" aria-hidden="true"></i></span> Ana Sayfa</a></li>
				<li><a href="?sayfa=uyeler"><span class="left"><i class="fa fa-user" aria-hidden="true"></i></span> Üyeler</a></li>
				<li><a href="?sayfa=ogrenciler"><span class="left"><i class="fa fa-id-badge" aria-hidden="true"></i></span> Öğrenciler</a></li>
				<li><a href="?sayfa=eserler"><span class="left"><i class="fa fa-book" aria-hidden="true"></i></span> Eserler</a></li>
				<li><a href="?sayfa=teslimler"><span class="left"><i class="fa fa-recycle" aria-hidden="true"></i></span> Teslimler</a></li>
				<li class="hasSub"><a href="#"><span class="left"><i class="fa fa-retweet" aria-hidden="true"></i></span> İşlemler</a>
				<ul>
					<li><a href="?sayfa=teslim-ekle"><i class="fa fa-plus-square" aria-hidden="true"></i> Yeni Teslim</a></li>
					<li><a href="?sayfa=eser-ekle"><i class="fa fa-plus-square" aria-hidden="true"></i> Eser Ekle</a></li>
					<li><a href="?sayfa=uye-ekle"><i class="fa fa-plus-square" aria-hidden="true"></i> Üye Ekle</a></li>
					<li><a href="?sayfa=ogrenci-ekle"><i class="fa fa-plus-square" aria-hidden="true"></i> Öğrenci Ekle</a></li>
					<li><a href="?sayfa=eser-ice-aktar"><i class="fa fa-upload" aria-hidden="true"></i> Eserleri İçe Aktar</a></li>
					<li><a href="?sayfa=ogrenci-ice-aktar"><i class="fa fa-upload" aria-hidden="true"></i> Öğrencileri İçe Aktar</a></li>
					<li><a href="?sayfa=teslimler-arsiv"><i class="fa fa-archive" aria-hidden="true"></i> Teslimleri Arşivle</a></li>
				</ul></li>
				<li><a href="?sayfa=nobetci-kayit"><span class="left"><i class="fa fa-calendar" aria-hidden="true"></i></span> Nöbetçiler</a></li>
				<li><a href="?sayfa=eser-kategori"><span class="left"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span> Kategoriler</a></li>
				<li><a href="?sayfa=arsivler"><span class="left"><i class="fa fa-archive" aria-hidden="true"></i></span> Arşivler</a></li>
				<li><a href="?sayfa=eylemler"><span class="left"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span> Eylemler</a></li>
				<li><a href="?sayfa=site-ayarlari"><span class="left"><i class="fa fa-wrench" aria-hidden="true"></i></span> Ayarlar</a></li>
			</ul>
		</nav>
		<footer class="footer">
			<div>Copyright &copy; <?php echo $s->get_site("site_okul"); ?>.</div>
			<div>Tüm hakları saklıdır.</div>
			<br />
			<div>by <a href="http://seckinpoyraz.com" target="_blank">Seçkin Poyraz</a>.</div>
		</footer>
	</div>

	<div class="full-content">
		
		<div class="user-panel">
			<div class="hizala">
				<div class="date" id="gunumuz"></div>
				<div class="name">
					
					<?php 
					$cek_user_foto = $s->kullanici($_SESSION["sp_user"],"uye_foto");
					$cinsiyet = mb_strtolower(trim($s->kullanici($_SESSION["sp_user"],"uye_cinsiyet")));
					$def_foto = "user";
					if($cinsiyet=="erkek"){
						$def_foto = "user";
					}else{
						$def_foto = "user2";
					}
					if(!$cek_user_foto){
						$user_foto = TEMA_URL."/images/$def_foto.png";
					}else{
						$user_foto = URL."/uploads/users/".$cek_user_foto;
					}
					$adsoyad = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
					if(strlen($adsoyad)>21){
						$adsoyad = mb_substr($adsoyad, 0, 18);
						$adsoyad .= "...";
					}
					?>
					<span>Hoş geldiniz,</span><span><a href="#" id="openUserMenu"><img src="<?php echo $user_foto; ?>"><span><?php echo htmlspecialchars($adsoyad); ?></span></a></span>
					
					<div class="user-menu">
						<ul>
							<li><a href="?sayfa=hesap-ayarlari"><i class="fa fa-cog" aria-hidden="true"></i> Hesap Ayarları</a></li>
							<li><a href="<?php echo URL; ?>/yardim/index.php" target="_blank"><i class="fa fa-question" aria-hidden="true"></i> Yardım</a></li>
							<li><a href="<?php echo TEMA_URL; ?>/cikis.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Çıkış Yap</a></li>
						</ul>
					</div>

				</div><!-- .name -->
				
			</div><!-- .hizala -->
		</div><!-- .user-panel -->
<?php } ?>