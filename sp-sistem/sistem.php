<?php
clearstatcache();
mb_internal_encoding('UTF-8');
setlocale(LC_TIME, 'tr_TR');
session_set_cookie_params(3600*24*30,"/");
if(!isset($_SESSION)){
    session_start();
}
error_reporting(0);

class Sistem{
	private $baglanti;

	function __construct__(){

	}

	function baglan($host,$kadi,$pass,$database){
		$this->baglanti = new mysqli($host,$kadi,$pass,$database);
		// Bağlantı Kontrol
		if (mysqli_connect_errno()){
			echo "Critical Error: " . mysqli_connect_error();
		}else{
			$this->baglanti->query("SET NAMES utf8");
		}
	}

	function error(){
		return $this->baglanti->error;
	}

	function query($a){
		return $this->baglanti->query($a);
	}

	function get_site($a){
		$cek = mysqli_fetch_array($this->baglanti->query("SELECT * FROM sistem WHERE site_id=1"));
		return $cek[$a];
	}

	function permalink($str, $options = array()){
	    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	    $defaults = array(
	        'delimiter' => '-',
	        'limit' => null,
	        'lowercase' => true,
	        'replacements' => array(),
	        'transliterate' => true
	    );
	    $options = array_merge($defaults, $options);
	    $char_map = array(
	        // Latin
	        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
	        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
	        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
	        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
	        'ß' => 'ss',
	        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
	        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
	        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
	        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
	        'ÿ' => 'y',
	        // Latin symbols
	        '©' => '(c)',
	        // Greek
	        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
	        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
	        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
	        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
	        'Ϋ' => 'Y',
	        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
	        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
	        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
	        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
	        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
	        // Turkish
	        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
	        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
	        // Russian
	        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
	        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
	        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
	        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
	        'Я' => 'Ya',
	        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
	        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
	        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
	        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
	        'я' => 'ya',
	        // Ukrainian
	        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
	        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
	        // Czech
	        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
	        'Ž' => 'Z',
	        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
	        'ž' => 'z',
	        // Polish
	        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
	        'Ż' => 'Z',
	        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
	        'ż' => 'z',
	        // Latvian
	        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
	        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
	        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
	        'š' => 's', 'ū' => 'u', 'ž' => 'z'
	    );
	    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	    if ($options['transliterate']) {
	        $str = str_replace(array_keys($char_map), $char_map, $str);
	    }
	    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	    $str = trim($str, $options['delimiter']);
	    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}

	function giris_yapildi(){
		if( isset($_SESSION["sp_login"]) ){
			return true;
		}else{
			return false;
		}
	}

	function session_giris_yap($a){
		$_SESSION["sp_login"] = true;
		$_SESSION["sp_user"] = $a;
	}

	function p($a){
		return addslashes($_POST[$a]);
	}

	function g($a){
		return addslashes($_GET[$a]);
	}

	function sifrele($a){
		$sifrele = sha1(base64_encode(md5(base64_encode($a))));
		$sonuc = substr($sifrele, 5, 32);
		return $sonuc;
	}

	function uye_var($kadi,$sifre){
		$q = $this->baglanti->query("SELECT * FROM uyeler WHERE uye_kadi='$kadi' && uye_pass='$sifre'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function uye_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM uyeler WHERE uye_id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function ogrenci_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM ogrenciler WHERE id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function cat_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM eserler_kategoriler WHERE cat_id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function nobet_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM nobetler_aylik WHERE nobet_id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function ogrenci_var_mi_no($no){
		$q = $this->baglanti->query("SELECT * FROM ogrenciler WHERE ogrenci_no='$no'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function uye_tur($a){
		if($a==1 || $a=="1"){
			return "İdareci";
		}elseif($a==2 || $a=="2"){
			return "Öğretmen";
		}elseif($a==3 || $a=="3"){
			return "Öğrenci";
		}else{
			return "Öğrenci";
		}
	}

	function kullanici($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM uyeler WHERE uye_id='$id'"));
		return $q[$ne];
	}

	function cat($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM eserler_kategoriler WHERE cat_id='$id'"));
		return $q[$ne];
	}

	function ogrenci($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM ogrenciler WHERE id='$id'"));
		return $q[$ne];
	}

	function arsiv($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM arsivler WHERE id='$id'"));
		return $q[$ne];
	}

	function nobet_aylik($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM nobetler_aylik WHERE nobet_id='$id'"));
		return $q[$ne];
	}

	function ogrencino($no,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM ogrenciler WHERE ogrenci_no='$no'"));
		return $q[$ne];
	}

	function yetkisi_var($neye,$yetkiler){
		if (strpos($yetkiler, $neye) !== false) {
		    return true;
		}else{
			return false;
		}
	}

	function eser($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM eserler WHERE eser_id='$id'"));
		return $q[$ne];
	}

	function eserisbn($isbn,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM eserler WHERE eser_isbn='$isbn'"));
		return $q[$ne];
	}

	function teslim($id,$ne){
		$q = mysqli_fetch_array($this->baglanti->query("SELECT * FROM teslimler WHERE teslim_id='$id'"));
		return $q[$ne];
	}

	function eser_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM eserler WHERE eser_id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function arsiv_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM arsivler WHERE id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function teslim_var_mi($id){
		$q = $this->baglanti->query("SELECT * FROM teslimler WHERE teslim_id='$id'")->num_rows;
		if($q==1){
			return true;
		}else{
			return false;
		}
	}

	function kadi_kontrol($a){
		if (ctype_alnum($a)) {
		   // Username is valid
			return true;
		}else{
			return false;
		}
	}

	function kadi_var_mi($a){
		$q = $this->baglanti->query("SELECT * FROM uyeler WHERE uye_kadi='$a'")->num_rows;
		if($q>0){
			return true;
		}else{
			return false;
		}
	}

	function email_var_mi($a){
		$q = $this->baglanti->query("SELECT * FROM uyeler WHERE uye_email='$a'")->num_rows;
		if($q>0){
			return true;
		}else{
			return false;
		}
	}

	function validateDate($date){
	    $d = DateTime::createFromFormat('d.m.Y', $date);
	    return $d && $d->format('d.m.Y') === $date;
	}

	function tr_dateTime($objtarih,$gunvarmi=true){
	    $gunler = array(
		    'Pazartesi',
		    'Salı',
		    'Çarşamba',
		    'Perşembe',
		    'Cuma',
		    'Cumartesi',
		    'Pazar'
		);
		 
		$aylar = array(
		    'Ocak',
		    'Şubat',
		    'Mart',
		    'Nisan',
		    'Mayıs',
		    'Haziran',
		    'Temmuz',
		    'Ağustos',
		    'Eylül',
		    'Ekim',
		    'Kasım',
		    'Aralık'
		);
		 
		$ay = $aylar[date('m',$objtarih) - 1];
		if($gunvarmi){
			$gun = " ".$gunler[date('N',$objtarih) - 1];
		}else{
			$gun = "";
		}
		 
		return date('j',$objtarih). " " . $ay . date(' Y',$objtarih) . $gun;
		// Örnek Sonuç: 3 Ağustos 2013 Cumartesi 02:19:18
	}

	function tr_Ay($aysirasi){
		 
		$aylar = array(
		    'Ocak',
		    'Şubat',
		    'Mart',
		    'Nisan',
		    'Mayıs',
		    'Haziran',
		    'Temmuz',
		    'Ağustos',
		    'Eylül',
		    'Ekim',
		    'Kasım',
		    'Aralık'
		);
		 
		$ay = $aylar[(int)$aysirasi - 1];
		 
		return $ay;
		// Örnek Sonuç: Ağustos
	}

	function CreateThumbnail($imageFileType,$pic,$thumb,$thumbwidth, $quality = 90){

		if($imageFileType=="jpg" || $imageFileType=="jpeg" ){
			$im1 = imagecreatefromjpeg($pic);
		}elseif($imageFileType=="png"){
			$im1 = imagecreatefrompng($pic);
		}else{
			$im1 = imagecreatefromgif($pic);
		}

        //if(function_exists("exif_read_data")){
                $exif = exif_read_data($pic);
                if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']) {
                case 8:
                    $im1 = imagerotate($im1,90,0);
                    break;
                case 3:
                    $im1 = imagerotate($im1,180,0);
                    break;
                case 6:
                    $im1 = imagerotate($im1,-90,0);
                    break;
                } 
                }
        //}
        $info = @getimagesize($pic);

        $width = $info[0];

        $w2=ImageSx($im1);
        $h2=ImageSy($im1);
        $w1 = ($thumbwidth <= $info[0]) ? $thumbwidth : $info[0]  ;

        $h1=floor($h2*($w1/$w2));
        $im2=imagecreatetruecolor($w1,$h1);

        imagecopyresampled ($im2,$im1,0,0,0,0,$w1,$h1,$w2,$h2); 
        $path=addslashes($thumb);
        $a = ImageJPEG($im2,$path,$quality);
        ImageDestroy($im1);
        ImageDestroy($im2);
        return $a;
	}

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

	function eylem($eylem_yapan,$eylem_icerik){
		$now = time();
		$q = $this->baglanti->query("INSERT INTO eylemler(eylem_yapan,eylem,eylem_tarih) VALUES('$eylem_yapan','$eylem_icerik','$now')");
		return $q;
	}

}

?>