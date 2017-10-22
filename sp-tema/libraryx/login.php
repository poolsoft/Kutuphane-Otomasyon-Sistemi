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
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA_URL; ?>/login.css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="login-page">

	<div class="login-box-all"><!-- login-box-all Start -->
		
		<h1 class="big-title"><i class="fa fa-book" aria-hidden="true"></i> <?php echo $s->get_site("site_isim"); ?></h1>
		<h3 class="small-title"><?php echo $s->get_site("site_okul"); ?></h3>

		<div class="login-box">
			
			<form id="girisForm" method="POST" action="" autocomplete="off" onsubmit="return false;">
				<div class="one">
					<div class="alt"><input type="text" name="a1" placeholder="&#xf2c3; Kullanıcı adınız..." class="input"></div>
				</div>
				<div class="one">
					<div class="alt"><input type="password" name="a2" placeholder="&#xf023; Şifreniz..." class="input"></div>
				</div>
				<div class="one" style="text-align:center;margin-top:15px">
					<div class="ust"><button class="btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Giriş Yap</button></div>
				</div>
			</form>

		</div>

	</div><!-- login-box-all End -->

	<div class="copyright">
		<div><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date("Y"); ?> <?php echo $s->get_site("site_okul"); ?>.</div>
		<div>by <a href="http://seckinpoyraz.com" target="_blank">Seçkin Poyraz</a></div>
	</div>

<script src="<?php echo TEMA_URL; ?>/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/messi.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
var URL = '<?php echo URL; ?>';
	THEME_URL = '<?php echo TEMA_URL; ?>';
</script>
<script src="<?php echo TEMA_URL; ?>/js/login.js"></script>
</body>
</html>