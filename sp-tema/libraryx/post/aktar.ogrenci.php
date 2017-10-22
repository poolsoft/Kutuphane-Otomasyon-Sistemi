<?php
set_time_limit(0);//max_execution_time değeri olabilecek en üst değere getirliyor
 
include("../../../sp-sistem/Classes/PHPExcel/IOFactory.php");//kullandığımız kütüphane
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $_FILES["a1"]; //dosya
	$a2 = $s->p("a2"); //9. sınıf şube sayısı
	$a3 = $s->p("a3"); //10. sınıf şube sayısı
	$a4 = $s->p("a4"); //11. sınıf şube sayısı
	$a5 = $s->p("a5"); //12. sınıf şube sayısı

	if( !$a1 || !$a2 || !$a3 || !$a4 || !$a5 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}else{

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "öğrencileri içe aktardı.";
		
		$FileType = strtolower(pathinfo($a1["name"],PATHINFO_EXTENSION));
		$target_dir = __DIR__."/../gecici/";
		$uniq = uniqid().".".$FileType;
		$target_file = $target_dir . $uniq;
		if($FileType == "xls" || $FileType == "xlsx") {

			$uploadedfile = $a1["tmp_name"];

			$size = filesize($uploadedfile);

			if($size > MAX_SIZE*1024){
			 echo "Bu dosyanın boyutu çok büyük!";
			}else{
				
				$objPHPExcel = PHPExcel_IOFactory::load($uploadedfile);
				$excel_satirlar = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor

				$xx=0;//sayac
				$sube_sayilari = array();
				array_push($sube_sayilari, (int)$a2);
				array_push($sube_sayilari, (int)$a3);
				array_push($sube_sayilari, (int)$a4);
				array_push($sube_sayilari, (int)$a5);
				$siniflar = array();
				for ($i=1; $i <= $sube_sayilari[0]; $i++) { 
					# 9. sınıf
					$j = $s->sinif_kontrol($i);
					$sinif = "9/".$j;
					array_push($siniflar, $sinif);
				}
				for ($i=1; $i <= $sube_sayilari[1]; $i++) { 
					# 10. sınıf
					$j = $s->sinif_kontrol($i);
					$sinif = "10/".$j;
					array_push($siniflar, $sinif);
				}
				for ($i=1; $i <= $sube_sayilari[2]; $i++) { 
					# 11. sınıf
					$j = $s->sinif_kontrol($i);
					$sinif = "11/".$j;
					array_push($siniflar, $sinif);
				}
				for ($i=1; $i <= $sube_sayilari[3]; $i++) { 
					# 12. sınıf
					$j = $s->sinif_kontrol($i);
					$sinif = "12/".$j;
					array_push($siniflar, $sinif);
				}

				$cur_sinif_no = 0;
				$s->query("DELETE FROM ogrenciler");
				$s->query("ALTER TABLE ogrenciler AUTO_INCREMENT = 1");
				foreach($excel_satirlar as $excel_satir){
					$xx++;
				    //veriler değişkene alınıyor
				    $veri_1 = $excel_satir['A'];
				    $veri_2 = $excel_satir['B'];
				    $veri_3 = $excel_satir['D'];
				    $veri_4 = $excel_satir['I'];
				    $veri_5 = $excel_satir['N'];
				    if($veri_2 == "Öğrenci No"){
				    	$cur_sinif = $siniflar[$cur_sinif_no];
				    	$cur_sinif_no++;
				    	continue;
				    }elseif(is_numeric($veri_5)){
				    	$cur_sinif = $siniflar[$cur_sinif_no];
				    	$cur_sinif_no++;
				    	continue;
				    }elseif(empty($veri_1)){
				    	continue;
				    }else{
					 	$tamad = $veri_3." ".$veri_4;
					 	$s->query("INSERT INTO ogrenciler (ogrenci_ad,ogrenci_no,ogrenci_sinif,ogrenci_cinsiyet) VALUES ('$tamad','$veri_2','$cur_sinif','$veri_5')");
				    }			    
				 	
				}

				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";

			}

		}else{
			echo "Sadece Excel(xls,xlsx) formatında dosya yükleyebilirsiniz!";
		}//else bitiş

	}
}
?>