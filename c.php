<?php
set_time_limit(0);//max_execution_time değeri olabilecek en üst değere getirliyor
 
include 'sp-sistem/Classes/PHPExcel/IOFactory.php';//kullandığımız kütüphane
$inputFileName = 'liste.xls';//işlenecek dosya
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$excel_satirlar = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor
 
$ax = new mysqli("localhost","root","","kutuphane");
$ax->query("SET NAMES utf8");
$ax->query("DELETE FROM ogrenciler");

function sinif_kontrol($abc){
	$abc = (int)$abc;
	if($abc==1){
		$s = "A";
	}elseif($abc==2){
		$s = "B";
	}elseif($abc==3){
		$s = "C";
	}elseif($abc==4){
		$s = "D";
	}elseif($abc==5){
		$s = "E";
	}elseif($abc==6){
		$s = "F";
	}
	return $s;
}

$i=0;//sayac
$sube_sayilari = array(4,5,5,4);
$siniflar = array();
for ($i=1; $i <= $sube_sayilari[0]; $i++) { 
	# 9. sınıf
	$s = sinif_kontrol($i);
	$sinif = "9/".$s;
	array_push($siniflar, $sinif);
}
for ($i=1; $i <= $sube_sayilari[1]; $i++) { 
	# 10. sınıf
	$s = sinif_kontrol($i);
	$sinif = "10/".$s;
	array_push($siniflar, $sinif);
}
for ($i=1; $i <= $sube_sayilari[2]; $i++) { 
	# 11. sınıf
	$s = sinif_kontrol($i);
	$sinif = "11/".$s;
	array_push($siniflar, $sinif);
}
for ($i=1; $i <= $sube_sayilari[3]; $i++) { 
	# 12. sınıf
	$s = sinif_kontrol($i);
	$sinif = "12/".$s;
	array_push($siniflar, $sinif);
}

$cur_sinif_no = 0;
foreach($excel_satirlar as $excel_satir){
    //veriler değişkene alınıyor
    $veri_1 = $excel_satir['A'];
    $veri_2 = $excel_satir['B'];
    $veri_3 = $excel_satir['D'];
    $veri_4 = $excel_satir['I'];
    $veri_5 = $excel_satir['N'];
    if($veri_2 == "Öğrenci No"){
    	$cur_sinif = $siniflar[$cur_sinif_no];
    	echo "<h1>$cur_sinif</h1>";
    	$cur_sinif_no++;
    	continue;
    }elseif(is_numeric($veri_5)){
    	$cur_sinif = $siniflar[$cur_sinif_no];
    	echo "<h1>$cur_sinif</h1>";
    	$cur_sinif_no++;
    	continue;
    }elseif(empty($veri_1)){
    	continue;
    }else{
    	echo $cur_sinif."<br />";
    	echo $veri_2."<br />";
	 	echo $veri_3." ";
	 	echo $veri_4."<br />";
	 	echo $veri_5."<br /><hr />";
	 	$tamad = $veri_3." ".$veri_4;
	 	$ax->query("INSERT INTO ogrenciler (ogrenci_ad,ogrenci_no,ogrenci_sinif,ogrenci_cinsiyet) VALUES ('$tamad','$veri_2','$cur_sinif','$veri_5')");
    }
 	
    //bu kısımdan sonra verileri nasıl işlemek istiyorsanız ona göre kodları yazmamış gerekiyor. örneğin veri tabanına kaydetmek.
}


?>