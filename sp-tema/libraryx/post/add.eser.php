<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","350");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$foto = $_FILES["foto"];
	$a_yer = $s->p("a_yer"); //yeri
	$a1 = $s->p("a1"); //ad
	$a2 = $s->p("a2"); //yazar
	$a3 = $s->p("a3"); //yayınevi
	$a4 = $s->p("a4"); //eser kategori
	$a6 = $s->p("a6"); //isbn
	$a7 = $s->p("a7"); //adet
	$a8 = $s->p("a8"); //not
	$asayfa = $s->p("asayfa"); //sayfa
	$afiyat = $s->p("afiyat"); //fiyat
	$foto_eklenmis = false;

	$eservarmi = $s->query("SELECT * FROM eserler WHERE eser_isbn='$a6'")->num_rows;

	if(!$a1 || !$a2 || !$a3 || !$a6){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a7) ){
		echo "Lütfen sayısal değer girilmesi gereken yere sayısal değer girin!";
	}elseif( $eservarmi>0 ){
		echo "Bu eser zaten mevcut! Eser düzenleme sayfasından eserin adetini arttırın.";
	}elseif( $a4 != "none" && !$s->cat_var_mi($a4) ){
		echo "Böyle bir kategori yok! Lütfen sayfayı yenileyin!";
	}elseif( $a4 != "none" && !is_numeric($a4) ){
		echo "Lütfen sayfayı yenileyin!";
	}else{

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "$a1 adında yeni bir eser ekledi. (ISBN: $a6)";

		$a44 = 0;
		if($a4=="none"){
			$a44 = 0;
		}else{
			$a44 = (int)$a4;
		}

		if(isset( $foto ) && !empty( $foto["name"] )){
			//fotoğraf eklenmişse

			$imageFileType = pathinfo($foto["name"],PATHINFO_EXTENSION);
			$target_dir = __DIR__."/../../../uploads/eserler/";
			$uniq = uniqid().".".$imageFileType;
			$target_file = $target_dir . $uniq;
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    echo "Fotoğraf olarak sadece JPG, JPEG, PNG & GIF dosyaları yükleyebilirsiniz.";
			}else{
				$uploadedfile = $foto["tmp_name"];

				$size = filesize($uploadedfile);

				if($size > MAX_SIZE*1024){
				 echo "Bu fotoğrafın boyutu çok büyük!";
				}else{
					$a = $s->CreateThumbnail($imageFileType,$uploadedfile,$target_file,NEW_WIDTH);
					if($a){
						$q = $s->query("INSERT INTO eserler(eser_foto,
						eser_yer,
						eser_ad,
						eser_yazar,
						eser_yayinevi,
						eser_cat
						eser_isbn,
						eser_adet,
						eser_not,
						eser_sayfa,
						eser_fiyat) VALUES('$uniq',
						'$a_yer',
						'$a1',
						'$a2',
						'$a3',
						'$a44',
						'$a6',
						'$a7',
						'$a8',
						'$asayfa',
						'$afiyat')");
						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
						}
					}else{
						echo "Fotoğraf yüklenemedi!";
					}
					
				}

			}

		}else{
			//fotoğraf eklenmemişse
			$q = $s->query("INSERT INTO eserler(eser_ad,
						eser_yer,
						eser_yazar,
						eser_yayinevi,
						eser_cat,
						eser_isbn,
						eser_adet,
						eser_not,
						eser_sayfa,
						eser_fiyat) VALUES('$a1',
						'$a_yer',
						'$a2',
						'$a3',
						'$a44',
						'$a6',
						'$a7',
						'$a8',
						'$asayfa',
						'$afiyat')");
			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}
		}

	}
}
?>