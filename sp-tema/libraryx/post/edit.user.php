<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$userid = $s->p("userid");
	$foto = $_FILES["foto"];
	$a1 = $s->p("a1"); //kadi
	$a1_kucuk = mb_strtolower($a1); //kadi küçük
	$a2 = $s->p("a2"); //ad
	$a3 = $s->p("a3"); //email
	$a4 = $s->p("a4"); //şifre
	$a5 = $s->p("a5"); //şifre 2
	$a6 = $s->p("a6"); //sınıf
	$a7 = $s->p("a7"); //okul no
	$a8 = $s->p("a8"); //üye türü
	$a9 = $s->p("a9"); //üye cinsiyeti
	$y1 = $s->p("y1"); //düzenle-eser
	$y2 = $s->p("y2"); //düzenle-teslim
	$y3 = $s->p("y3"); //düzenle-öğrenci
	$y4 = $s->p("y4"); //düzenle-öğretmen
	$y5 = $s->p("y5"); //düzenle-idareci
	$y6 = $s->p("y6"); //düzenle-site ayar
	$sifre_girilmis = false;

	if($a8=="1" || $a8=="2"){
		$a6 = null;
		$a7 = null;
	}

	//yetkiler
	$yetkiler = array();
	if($y1){
		array_push($yetkiler, $y1);
	}
	if($y2){
		array_push($yetkiler, $y2);
	}
	if($y3){
		array_push($yetkiler, $y3);
	}
	if($y4){
		array_push($yetkiler, $y4);
	}
	if($y5){
		array_push($yetkiler, $y5);
	}
	if($y6){
		array_push($yetkiler, $y6);
	}

	if(empty($yetkiler)){
		$yetkiler = "";
	}else{
		$yetkiler = implode(',', $yetkiler);
	}

	if( !$a9 || ( $a8=="3" && (!$a1 || !$a2 || !$a3 || !$a6 || !$a7) ) || ( $a8=="1" && (!$a1 || !$a2 || !$a3) ) || ( $a8=="2" && (!$a1 || !$a2 || !$a3) ) ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( (mb_strtolower($s->kullanici($userid,"uye_kadi")) != $a1) && ($s->kadi_var_mi($a1_kucuk)) ){
		echo "Bu kullanıcı adı başka bir üye tarafından kullanılıyor!";
	}elseif(!filter_var($a3, FILTER_VALIDATE_EMAIL)){
		echo "Lütfen geçerli bir eMail adresi girin!";
	}elseif( strlen($a1)<5 ){
		echo "Kullanıcı adınız 5 karakterden az olamaz!";
	}elseif( ($s->kullanici($userid,"uye_email") != $a3) && ($s->email_var_mi($a3)) ){
		echo "Bu email adresi başka bir üye tarafından kullanılıyor!";
	}elseif( !$s->kadi_kontrol($a1) ){
		echo "Lütfen geçerli bir kullanıcı adı girin!";
	}else{

		$uye_adi = addslashes($s->kullanici($userid,"uye_adsoyad"));
		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "$uye_adi adlı üyeyi düzenledi.";
		
		if($a4){
			//şifre girilmişse
			if($a4 != $a5){
				echo "Şifreler uyuşmuyor!";
			}elseif( strlen($a4)<5 ){
				echo "Şifreniz 5 karakterden az olamaz!";
			}else{
				//her şey tamam

				if(isset( $foto ) && !empty( $foto["name"] )){
					//şifre girilmişse
					//fotoğraf eklenmişse

					$imageFileType = pathinfo($foto["name"],PATHINFO_EXTENSION);
					$target_dir = __DIR__."/../../../uploads/users/";
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
								$sifrele = $s->sifrele($a4);
								$q = $s->query("UPDATE uyeler SET uye_foto='$uniq',
								uye_kadi='$a1',
								uye_adsoyad='$a2',
								uye_email='$a3',
								uye_pass='$sifrele',
								uye_sinif='$a6',
								uye_okulno='$a7',
								uye_tur='$a8',
								uye_cinsiyet='$a9',
								uye_eylemler='$yetkiler' WHERE uye_id='$userid'");
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
					//şifre girilmişse
					//fotoğraf eklenmemişse
					$sifrele = $s->sifrele($a4);
					$q = $s->query("UPDATE uyeler SET uye_kadi='$a1',
							uye_adsoyad='$a2',
							uye_email='$a3',
							uye_pass='$sifrele',
							uye_sinif='$a6',
							uye_okulno='$a7',
							uye_tur='$a8',
							uye_cinsiyet='$a9',
							uye_eylemler='$yetkiler' WHERE uye_id='$userid'");
						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#2";
						}
				}

				
			}
		}else{
			//şifre girilmemişse
			if(isset( $foto ) && !empty( $foto["name"] )){
					//şifre girilmemişse
					//fotoğraf eklenmişse

					$imageFileType = pathinfo($foto["name"],PATHINFO_EXTENSION);
					$target_dir = __DIR__."/../../../uploads/users/";
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
								$q = $s->query("UPDATE uyeler SET uye_foto='$uniq',
								uye_kadi='$a1',
								uye_adsoyad='$a2',
								uye_email='$a3',
								uye_sinif='$a6',
								uye_okulno='$a7',
								uye_tur='$a8',
								uye_cinsiyet='$a9',
								uye_eylemler='$yetkiler' WHERE uye_id='$userid'");
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
					//şifre girilmemişse
					//fotoğraf eklenmemişse
					$q = $s->query("UPDATE uyeler SET uye_kadi='$a1',
							uye_adsoyad='$a2',
							uye_email='$a3',
							uye_sinif='$a6',
							uye_okulno='$a7',
							uye_tur='$a8',
							uye_cinsiyet='$a9',
							uye_eylemler='$yetkiler' WHERE uye_id='$userid'");
						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#4".$s->error();
						}
				}
		}

	}
}
?>