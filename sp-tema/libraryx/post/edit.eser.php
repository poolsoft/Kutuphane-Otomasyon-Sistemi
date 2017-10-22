<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","350");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$eserid = $s->p("eserid");
	$foto = $_FILES["foto"];
	$a_yer = $s->p("a_yer"); //eser yeri
	$a1 = $s->p("a1"); //ad
	$a2 = $s->p("a2"); //yazar
	$a3 = $s->p("a3"); //yayınevi
	$a4 = $s->p("a4"); //eser kategori
	$a6 = $s->p("a6"); //isbn
	$a7 = $s->p("a7"); //adet
	$asayfa = $s->p("asayfa"); //sayfa
	$afiyat = $s->p("afiyat"); //fiyat
	$kullanimda = $s->p("kullanimda"); //mevcut eser
	$a8 = $s->p("a8"); //not
	$foto_eklenmis = false;

	if(!$a1 || !$a2 || !$a3 || !$a6){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a7) ){
		echo "Lütfen sayısal değer girilmesi gereken yere sayısal değer girin!";
	}elseif( $a4 != "none" && !$s->cat_var_mi($a4) ){
		echo "Böyle bir kategori yok! Lütfen sayfayı yenileyin!";
	}elseif( $a4 != "none" && !is_numeric($a4) ){
		echo "Lütfen sayfayı yenileyin!";
	}elseif( ((int)$a7-(int)$kullanimda) < 0 ){
		echo "Mevcut eserden daha düşük bir adet giremezsiniz!";
	}else{

		$eser_adi = addslashes($s->eser($eserid,"eser_ad"));
		$eser_isbn = addslashes($s->eser($eserid,"eser_isbn"));
		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "$eser_adi adlı eseri düzenledi. (ISBN: $eser_isbn)";

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
						$q = $s->query("UPDATE eserler SET eser_foto='$uniq',
						eser_yer='$a_yer',
						eser_ad='$a1',
						eser_yazar='$a2',
						eser_yayinevi='$a3',
						eser_cat='$a44',
						eser_isbn='$a6',
						eser_adet='$a7',
						eser_not='$a8',
						eser_sayfa='$asayfa',
						eser_fiyat='$afiyat' WHERE eser_id='$eserid'");
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
			$q = $s->query("UPDATE eserler SET eser_ad='$a1',
				eser_yer='$a_yer',
				eser_yazar='$a2',
				eser_yayinevi='$a3',
				eser_cat='$a44',
				eser_isbn='$a6',
				eser_adet='$a7',
				eser_not='$a8',
				eser_sayfa='$asayfa',
				eser_fiyat='$afiyat' WHERE eser_id='$eserid'");
			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo $a8;
			}
		}

	}
}
?>