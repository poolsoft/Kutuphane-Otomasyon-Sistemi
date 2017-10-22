<?php
include("../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ../index.php");
}else{
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="noindex,nofollow">
	<meta charset="UTF-8">
	<title><?php echo $s->get_site("site_isim"); ?> Yardım Paneli - <?php echo $s->get_site("site_okul"); ?></title>
	<meta name="author" content="seckinpoyraz.com" />

	<!-- icon -->
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMA_URL; ?>/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMA_URL; ?>/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMA_URL; ?>/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMA_URL; ?>/images/favicon-16x16.png">

	<!-- Responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">

	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/yardim/assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/yardim/assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/yardim/assets/style.css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div id="container">

	<div class="title-area">
		<h1>Yardım Paneli</h1>
		<h3><?php echo $s->get_site("site_isim"); ?></h3>
	</div>

	<div class="sidebar">
			
		<nav class="nav-menu">
			<ul>
				<li><a href="#p1"><span>1.</span>Yardım Paneline Hoş Geldiniz
				<ul>
					<li><a href="#p1-1"><span>1.1</span>Sistem</a></li>
				</ul></a></li>
				<li><a href="#p2"><span>2.</span>Tasarım Hakkında
					<ul>
						<li><a href="#p2-1"><span>2.1.</span>Menü</a></li>
						<li><a href="#p2-2"><span>2.2.</span>Üye Paneli</a></li>
						<li><a href="#p2-3"><span>2.3.</span>İçerik</a></li>
					</ul>
				</a></li>
				<li><a href="#p3"><span>3.</span>Sayfalar
					<ul>
						<li><a href="#p3-1"><span>3.1.</span>Anasayfa</a></li>
						<li><a href="#p3-2"><span>3.2.</span>Üyeler</a></li>
						<li><a href="#p3-3"><span>3.3.</span>Öğrenciler</a></li>
						<li><a href="#p3-4"><span>3.4.</span>Eserler</a></li>
						<li><a href="#p3-5"><span>3.5.</span>Teslimler</a></li>
						<li><a href="#p3-6"><span>3.6.</span>İşlemler
							<ul>
								<li><a href="#p3-6-1"><span>3.6.1.</span>Yeni Teslim</a></li>
								<li><a href="#p3-6-2"><span>3.6.2.</span>Eser Ekle</a></li>
								<li><a href="#p3-6-3"><span>3.6.3.</span>Üye Ekle</a></li>
								<li><a href="#p3-6-4"><span>3.6.4.</span>Öğrenci Ekle</a></li>
								<li><a href="#p3-6-5"><span>3.6.5.</span>Eserleri İçe Aktar</a></li>
								<li><a href="#p3-6-6"><span>3.6.6.</span>Öğrencileri İçe Aktar</a></li>
								<li><a href="#p3-6-7"><span>3.6.7.</span>Teslimleri Arşivle</a></li>
							</ul>
						</a></li>
						<li><a href="#p3-7"><span>3.7.</span>Nöbetçiler</a></li>
						<li><a href="#p3-8"><span>3.8.</span>Kategoriler</a></li>
						<li><a href="#p3-9"><span>3.9.</span>Arşivler</a></li>
						<li><a href="#p3-10"><span>3.10.</span>Eylemler</a></li>
						<li><a href="#p3-11"><span>3.11.</span>Ayarlar</a></li>
					</ul>
				</a></li>
				<li><a href="#p4"><span>4.</span>Daha Fazla Yardım</a></li>
			</ul>
		</nav>

	</div><!-- .sidebar -->

	<div class="content">
		
		<div class="one-page" id="p1">
			<h1 class="page-title"><a href="#p1" class="pageid"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>1.</span>Yardım Paneline Hoş Geldiniz</h1>
			<div class="page-content">
				
				<p>Merhaba. Bu dökümanda <b>K</b>ütüphane <b>O</b>tomasyon <b>S</b>istemi'ni <b>("KOS")</b> nasıl kullanmanız gerektiğini ayrıntılı bir şekilde öğreneceksiniz. Eğer öğrenmek istediğiniz sadece bir özellik var ise soldaki menüden o bölümün anlatıldığı yeri seçerek doğrudan aradığınıza ulaşabilirsiniz.</p>

			</div>
		</div>

		<div class="one-page" id="p1-1">
			<h1 class="page-title"><a href="#p1-1" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>1.1.</span>Sistem</h1>
			<div class="page-content">				

				<p>
					sistem
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p2">
			<h1 class="page-title"><a href="#p2" class="pageid"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>2.</span>Tasarım Hakkında</h1>
			<div class="page-content">
				
				<p>
					<div class="boxed-image">
						<img src="assets/images/site-sablon.jpg" alt="Site Şablonu" />
					</div>
				</p>

				<p>
					<i class="fa fa-hand-o-up" aria-hidden="true"></i> Fotoğrafta da görüldüğü gibi tasarım 3 temel kısımdan oluşuyor:
				</p>

				<ul>
					<li>Menü</li>
					<li>Üye Paneli</li>
					<li>İçerik</li>
				</ul>

				<p>
					<i class="fa fa-hand-o-down" aria-hidden="true"></i> Şimdi bu kısımlar ile ilgili biraz bilgi verelim.
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p2-1">
			<h1 class="page-title"><a href="#p2-1" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>2.1.</span>Menü</h1>
			<div class="page-content">
				
				<p>
					<div style="float:left;width:280px">
						<img src="assets/images/menu-fotograf.jpg" width="250" alt="Menü Fotoğrafı" style="display:block;border:solid 3px #E0E0E0" />
					</div>
					<div>
						<p><i class="fa fa-check" aria-hidden="true"></i> 11 kategoriden oluşan menüde istediğiniz herhangi bir eylemi seçip yapabilirsiniz.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i> Eserleri, öğrencileri, üyeleri...vs <b>düzenlemek veya silmek</b> için üzerine tıklayıp görüntülemeniz yeterli.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i> Eserleri, öğrencileri, üyeleri...vs <b>eklemek</b> için "İşlemler" kısmına tıklayıp seçim yapmanız yeterli.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i> Ayrıca tüm üyelerin KOS'ta ne zaman ne yaptığını görmek için "Eylemler" kısmına tıklamanız yeterli.</p>
						<p><i class="fa fa-check" aria-hidden="true"></i> Menüde KOS'taki tüm sayfaların başlıklarını görmenize rağmen bu sayfalara eğer <b>izniniz</b> varsa ulaşabilirsiniz; aksi takdirde sayfa görüntülenmeyecektir.</p>
					</div>
				</p>
				
			<div style="clear:both"></div>
			</div>
		</div>

		<div class="one-page" id="p2-2">
			<h1 class="page-title"><a href="#p2-2" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>2.2.</span>Üye Paneli</h1>
			<div class="page-content">
				
				<p>
					<div class="boxed-image">
						<img src="assets/images/uye-paneli-fotograf.jpg" alt="Üye Paneli Fotoğrafı" />
					</div>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Üye panelinde sol kısımda sistemin tarihini, saatini ve gününü görmektesiniz. Bu kısım kullandığınız cihazın tarih ayarlarından bağımsızdır. KOS, İstanbul saatini kullanmaktadır.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Üye panelinin sağ kısımda ise hesap ayarlarına ve yardım paneline ulaşmanızı sağlayacak butonlar ve çıkış yap butonu bulunmaktadır.
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p2-3">
			<h1 class="page-title"><a href="#p2-3" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>2.3.</span>İçerik</h1>
			<div class="page-content">

				<p>
					İçerik kısmı, bulunduğunuz sayfanın içeriğini gösterir.<br><i>Örn: Öğrenciler sayfasını açtığınızda öğrencileri listeler.</i>
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3">
			<h1 class="page-title"><a href="#p3" class="pageid"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.</span>Sayfalar</h1>
			<div class="page-content">
				
				<p>KOS'ta başlıklar halinde toplam 17 sayfa bulunmaktadır. Bu sayfaları açmak için menüden sayfanın başlığına tıklamanız yeterli. Dökümanın bu kısmında bu sayfaların her birinin içeriğini detaylı bir şekilde inceleyeceğiz.</p>

			</div>
		</div>

		<div class="one-page" id="p3-1">
			<h1 class="page-title"><a href="#p3-1" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.1.</span>Anasayfa</h1>
			<div class="page-content">

				<p>
					<div class="boxed-image">
						<img src="assets/images/anasayfa-pre.jpg" alt="Anasayfa Fotoğrafı" />
					</div>
				</p>

				<p>
					Anasayfa, sistemde en çok ihtiyaç duyulan bilgilerin gösterildiği sayfa olarak tasarlanmıştır. 4 ana kısımdan oluşmaktadır:
				</p>

				<p>
					<ul>
						<li>İstatistikler</li>
						<li>İade Tarihi Geçenler</li>
						<li>İade Tarihi Yaklaşanlar</li>
						<li>Grafikler</li>
					</ul>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> İstatistikler kısmında sisteme kayıtlı tüm eser sayısı, kaç tanesinin teslimde olduğu, kaç tane net eserin bulunduğu gibi bilgilerin yanı sıra <b>en çok okuyan sınıf</b> ve <b>en az okuyan sınıf</b> gibi bir takım istatistikler daha görebilirsiniz.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> İade tarihi geçenler kısmında iade tarihi geçen tüm teslimleri, <b>kaç gün geciktiği bilgisiyle</b> beraber görebilirsiniz. Üzerine tıklayarak o teslimle ilgili detaylı bilgileri öğrenebilirsiniz.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> İade tarihi yaklaşanlar kısmında iade tarihine <b>20 gün ve daha az</b> kalan tüm teslimleri, <b>kaç gün kaldığı bilgisiyle</b> beraber görebilirsiniz. Üzerine tıklayarak o teslimle ilgili detaylı bilgileri öğrenebilirsiniz.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Grafikler kısmında teslim alan tüm öğrenciler arasındaki kız/erkek oranının, sınıf oranlarının...vs grafiklerini görebilirsiniz. <b>"Tümünü Görüntüle"</b> ye tıklayarak tüm grafikleri ayrı bir sayfada görüntüleyebilirsiniz.
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-2">
			<h1 class="page-title"><a href="#p3-2" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.2.</span>Üyeler</h1>
			<div class="page-content">

				<p>
					<div class="boxed-image">
						<img src="assets/images/uyeler-pre.jpg" alt="Üyeler Sayfası Fotoğrafı" />
					</div>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Üyeler sayfasında sisteme kayıtlı tüm üyeler listelenir. <i>Eğer üye sayısı 80'den fazlaysa sadece 80 sonuç gösterilir.</i>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Herhangi bir üyeyi aramak için üstteki arama yerine <b>üyenin adı ve soyadını</b> yazabilirsiniz.</i>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Üyeler başta idareciler, sonra öğretmenler ve sonra öğrenciler olmak üzere 3 grupta sıralanır. Daha sonra gruplar içerisinde ad ve soyada göre alfabetik sıralanır.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Eğer üye düzenleme yetkiniz varsa düzenleme yetkinizin olduğu üye gruplarının yanında -kendiniz hariç- <span><img src="assets/images/but-duzenle.jpg" /></span> butonu çıkar. Eğer bir üyeyi düzenlemek isterseniz bu butona tıklamanız yeterlidir. Kendinizi düzenlemek için üye panelinden "Hesap Ayarları"nı açmanız gerekmektedir.
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Eğer bir üye o gün nöbetçiyse o üyenin isminin yanında <span><img src="assets/images/but-nobet.jpg" /></span> yazısı çıkar. Nöbetçi listeleri <b>Nöbetçiler</b> sayfasından düzenlenebilir veya görüntülenebilir.
				</p>

				<p class="important">
					<i class="fa fa-check" aria-hidden="true"></i> Eğer bir üyeyi silmek isterseniz üyeyi düzenleme sayfasının en altındaki <span><img src="assets/images/but-uyesil.jpg" width="95" height="40" /></span> butonuna tıklamanız yeterlidir. <hr><b><span style="color:#D00000;text-decoration:underline">ÖNEMLİ NOT:</span> Sadece üye grubu <b>"İdareci"</b> veya <b>"Öğretmen"</b> olanlar üyeleri silebilir. <b>"Öğrenci"</b> ler hiçbir üyeyi silemez.</b>
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-3">
			<h1 class="page-title"><a href="#p3-3" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.3.</span>Öğrenciler</h1>
			<div class="page-content">

				<p>
					<div class="boxed-image">
						<img src="assets/images/ogrenciler-pre.jpg" alt="Öğrenciler Sayfası Fotoğrafı" />
					</div>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Öğrenciler sayfasında sisteme kayıtlı tüm öğrenciler listelenir. <i>Eğer öğrenci sayısı 80'den fazlaysa sadece 80 sonuç gösterilir.</i>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Herhangi bir öğrenciyi aramak için üstteki arama yerine <b>öğrencinin adı ve soyadını, numarasını veya sınıfını</b> yazabilirsiniz.</i>
				</p>

				<p>
					<i class="fa fa-check" aria-hidden="true"></i> Eğer öğrencileri düzenleme yetkiniz varsa öğrenci isimlerinin yanında <span><img src="assets/images/but-duzenle.jpg" /></span> butonu çıkar. Eğer bir öğrenciyi düzenlemek isterseniz bu butona tıklamanız yeterlidir.
				</p>

				<p class="important">
					<i class="fa fa-check" aria-hidden="true"></i> Eğer bir öğrenciyi silmek isterseniz öğrenciyi düzenleme sayfasının en altındaki <span><img src="assets/images/but-ogrencisil.jpg" width="100" height="30" /></span> butonuna tıklamanız yeterlidir.
				</p>

				<p class="important">
					<i class="fa fa-check" aria-hidden="true"></i> Eğer tüm öğrencileri tek seferde silmek isterseniz sayfanın en altındaki <span><img src="assets/images/but-tumogrencisil.jpg" width="160" height="40" /></span> butonuna tıklamanız yeterlidir. <hr><b><span style="color:#D00000;text-decoration:underline">ÖNEMLİ NOT:</span> Sadece üye grubu <b>"İdareci"</b> veya <b>"Öğretmen"</b> olanlar öğrencileri silebilir. <b>"Öğrenci"</b> ler hiçbir öğrenciyi silemez.</b>
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-4">
			<h1 class="page-title"><a href="#p3-4" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.4.</span>Eserler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-5">
			<h1 class="page-title"><a href="#p3-5" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.5.</span>Teslimler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-6">
			<h1 class="page-title"><a href="#p3-6" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.6.</span>İşlemler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-7">
			<h1 class="page-title"><a href="#p3-7" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.7.</span>Nöbetçiler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-8">
			<h1 class="page-title"><a href="#p3-8" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.8.</span>Kategoriler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-9">
			<h1 class="page-title"><a href="#p3-9" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.9.</span>Arşivler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-10">
			<h1 class="page-title"><a href="#p3-10" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.10.</span>Eylemler</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p3-11">
			<h1 class="page-title"><a href="#p3-11" class="pageid red"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>3.11.</span>Ayarlar</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

		<div class="one-page" id="p4">
			<h1 class="page-title"><a href="#p4" class="pageid"><i class="fa fa-paragraph" aria-hidden="true"></i></a><span>4.</span>Daha Fazla Yardım</h1>
			<div class="page-content">

				<p>
					üyeler sayfası
				</p>
				
			</div>
		</div>

	</div>

</div><!-- #container -->


<script src="<?php echo URL; ?>/yardim/assets/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo URL; ?>/yardim/assets/js/main.js"></script>
</body>
</html>
<?php } ?>