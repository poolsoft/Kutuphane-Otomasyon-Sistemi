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
	$teslim_var_mi = $s->query("SELECT * FROM teslimler")->num_rows;

	if( !$a1 ){
		echo "Lütfen bir dosya seçin!";
	}elseif($teslim_var_mi>0){
		echo "Teslimler var! Eserleri içe aktarmak için önce teslimleri kaldırmanız veya arşivlemeniz gerek!";
	}else{

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "eserleri içe aktardı.";
		
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

				if(!isset($_SESSION["isbnrandoma"])){
					$_SESSION["isbnrandoma"] = 0;
				}

				$s->query("DELETE FROM eserler_temp");
				
				$objPHPExcel = PHPExcel_IOFactory::load($uploadedfile);
				$excel_satirlar = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor

				//$s->query("DELETE FROM eserler");
				//$s->query("ALTER TABLE eserler AUTO_INCREMENT = 1");
				$sayac = 0;
				foreach($excel_satirlar as $excel_satir){
					$sayac++;
				    //veriler değişkene alınıyor
				    $veri_1 = $excel_satir['A'];//yer
				    $veri_2 = $excel_satir['B'];//isbn
				    $veri_3 = $excel_satir['C'];//ad
				    $veri_4 = $excel_satir['D'];//yazar
				    $veri_5 = $excel_satir['E'];//yayınevi
				    $veri_6 = $excel_satir['F'];//kategori
				    $veri_7 = $excel_satir['G'];//adet
				    $veri_8 = $excel_satir['H'];//not
				    $veri_9 = $excel_satir['I'];//sayfa sayısı
				    $veri_10 = $excel_satir['J'];//fiyatı
				    if($sayac>1){

				    	if( empty($veri_2) || $veri_2=="-" ){
				    		$veri_2 = "a".$_SESSION["isbnrandoma"];
				    		$_SESSION["isbnrandoma"] = $_SESSION["isbnrandoma"]+1;
				    	}

				    	if( empty($veri_7) ){
				    		$veri_7 = "1";
				    	}

				    	if( empty($veri_3) ){
				    		continue;
				    	}

				    	/*if(empty($veri_1)){
					    	continue;
					    }else{
						 	
					    	$cat_ara = $s->query("SELECT * FROM eserler_kategoriler WHERE cat_ad LIKE '%".$veri_6."%'")->num_rows;

					    	if($cat_ara>0){
					    		$cat_cek = mysqli_fetch_array($s->query("SELECT * FROM eserler_kategoriler WHERE cat_ad LIKE '%".$veri_6."%' LIMIT 1"));
					    		$cat = $cat_cek["cat_id"];
					    	}else{
					    		$now = time();
					    		$yap = $s->query("INSERT INTO eserler_kategoriler(cat_ad,cat_olusturma_tarihi) VALUES('$veri_6','$now')");
					    		if($yap){
					    			$cat_cekk = mysqli_fetch_array($s->query("SELECT * FROM eserler_kategoriler WHERE cat_ad LIKE '%".$veri_6."%' LIMIT 1"));
					    			$cat = $cat_cekk["cat_id"];
					    		}else{
					    			$cat = 0;
					    		}				    		
					    	}*/

					    	$s->query("INSERT INTO eserler(eser_cat,
					    		eser_yer,
					    		eser_ad,
					    		eser_yazar,
					    		eser_yayinevi,
					    		eser_isbn,
					    		eser_adet,
					    		eser_not,
					    		eser_sayfa,
					    		eser_fiyat) VALUES(0,
					    		'',
					    		'$veri_3',
					    		'$veri_4',
					    		'$veri_5',
					    		'$veri_2',
					    		'$veri_7',
					    		'$veri_8',
					    		'$veri_9',
					    		'$veri_10')");


					    	/*echo $s->error();*/

					    /*}*/	

				    }else{
				    	continue;
				    }		    
				 	
				}

				/*$s->eylem($eylem_yapan,$eylem_icerik);*/
				echo "ok";

			}

		}else{
			echo "Sadece Excel(xls,xlsx) formatında dosya yükleyebilirsiniz!";
		}

	}
}
?>