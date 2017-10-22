<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
?>
	</div><!-- .full-content -->

<script src="<?php echo TEMA_URL; ?>/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/messi.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/jquery.backstretch.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/enquire.min.js"></script>
<script src="<?php echo TEMA_URL; ?>/pickadate/picker.js"></script>
<script src="<?php echo TEMA_URL; ?>/pickadate/picker.date.js"></script>
<script src="<?php echo TEMA_URL; ?>/pickadate/picker.time.js"></script>
<script src="<?php echo TEMA_URL; ?>/pickadate/legacy.js"></script>
<script src="<?php echo TEMA_URL; ?>/pickadate/translations/tr_TR.js"></script>
<script src="<?php echo TEMA_URL; ?>/js/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
//htmlspecialchars
function htmlspecialchars (string, quoteStyle, charset, doubleEncode) {
  var optTemp = 0
  var i = 0
  var noquotes = false
  if (typeof quoteStyle === 'undefined' || quoteStyle === null) {
    quoteStyle = 2
  }
  string = string || ''
  string = string.toString()
  if (doubleEncode !== false) {
    // Put this first to avoid double-encoding
    string = string.replace(/&/g, '&amp;')
  }
  string = string
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  }
  if (quoteStyle === 0) {
    noquotes = true
  }
  if (typeof quoteStyle !== 'number') {
    // Allow for a single string or an array of string flags
    quoteStyle = [].concat(quoteStyle)
    for (i = 0; i < quoteStyle.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quoteStyle[i]] === 0) {
        noquotes = true
      } else if (OPTS[quoteStyle[i]]) {
        optTemp = optTemp | OPTS[quoteStyle[i]]
      }
    }
    quoteStyle = optTemp
  }
  if (quoteStyle & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, '&#039;')
  }
  if (!noquotes) {
    string = string.replace(/"/g, '&quot;')
  }
  return string
}

//htmlspecialchars_decode
function htmlspecialchars_decode (string, quoteStyle) {
  var optTemp = 0
  var i = 0
  var noquotes = false
  if (typeof quoteStyle === 'undefined') {
    quoteStyle = 2
  }
  string = string.toString()
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  }
  if (quoteStyle === 0) {
    noquotes = true
  }
  if (typeof quoteStyle !== 'number') {
    // Allow for a single string or an array of string flags
    quoteStyle = [].concat(quoteStyle)
    for (i = 0; i < quoteStyle.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[quoteStyle[i]] === 0) {
        noquotes = true
      } else if (OPTS[quoteStyle[i]]) {
        optTemp = optTemp | OPTS[quoteStyle[i]]
      }
    }
    quoteStyle = optTemp
  }
  if (quoteStyle & OPTS.ENT_HTML_QUOTE_SINGLE) {
    // PHP doesn't currently escape if more than one 0, but it should:
    string = string.replace(/&#0*39;/g, "'")
    // This would also be useful here, but not a part of PHP:
    // string = string.replace(/&apos;|&#x0*27;/g, "'");
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"')
  }
  // Put this in last place to avoid escape being double-decoded
  string = string.replace(/&amp;/g, '&')
  return string
}
</script>
<script type="text/javascript">
function dondur(){
	window.button_veri = $("button.guncelle").html();
	$("button.guncelle").html('<img width="16" height="16" src="<?php echo TEMA_URL; ?>/images/reload.gif" alt="" /> Lütfen Bekleyin... ');
	$("input,textarea,select").attr("readonly","readonly");
	$("button").attr("disabled","disabled");
}

function devamEttir(){
	$("button.guncelle").html(button_veri);
	$("input,textarea,select").removeAttr("readonly");
	$("button").removeAttr("disabled");
}

var images = [];
function preload() {
    for (var i = 0; i < arguments.length; i++) {
        images[i] = new Image();
        images[i].src = preload.arguments[i];
    }
}
preload(
    "<?php echo TEMA_URL; ?>/images/reload.gif"
);

var now = new Date(<?php echo time() * 1000 ?>);

function startInterval(){  
    setInterval('updateTime();', 1000);  
}

updateTime();
startInterval();//start it right away

function updateTime(){
    var nowMS = now.getTime();
    nowMS += 1000;
    now.setTime(nowMS);
    var s=now.getSeconds();
    var m=now.getMinutes();
    var h=now.getHours();
    var day=now.getDay();
    var date=now.getDate();
    var month=now.getMonth();
    var year=now.getFullYear();
    var days=new Array("Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
    var months=new Array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    if (s<10) {s="0" + s}
    if (m<10) {m="0" + m}
    if (h<10) {h="0" + h}
    document.getElementById("gunumuz").innerHTML= date + " " + months[month] + " " + year + "<span>" + h + ":" + m + ":" + s + " / "+ days[day] +"</span>";
} 
</script>
<script src="<?php echo TEMA_URL; ?>/js/panel.js"></script>
<script type="text/javascript">
<?php if($getPage=="anasayfa" || $getPage=="grafikler"){ ?>
$(document).ready(function(){
	CanvasJS.addCultureInfo("tr",
    {
        decimalSeparator: ".",
        digitGroupSeparator: ",",
        zoomText: "Yakınlaştır",
        panText: "Pan",
        savePNGText: "PNG olarak kaydet",
        saveJPGText: "JPG olarak kaydet",
        menuText: "Diğer Ayarlar",
        days: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
        shortDays: ["Pzt","Sal","Çar","Per","Cum","Cmt","Paz"],
        months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
        shortMonths: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"]
   });
	var chart = new CanvasJS.Chart("chartContainer1", {
		culture:  "tr",
		exportEnabled: true,
		title: {
			text: "Teslimler - aya göre"
		},
		animationEnabled: true,
		axisX: {
			interval: 1,
			intervalType: "month",
			labelAngle: -30,
		},
		axisY: {
			includeZero: true,
		},
		data: [{
			type: "line",
			lineThickness: 3,
			minimum: 0,
			dataPoints: [
			<?php
			/*
			for ($i = 1; $i <= 12; $i++) {
				//aylar loop
				$ayjava = $i-1;
				$kontrolx = $s->query("SELECT * FROM ( SELECT teslim_verim_tarihi, DATE_FORMAT(FROM_UNIXTIME(teslim_verim_tarihi), '%Y-%m-%d') AS val FROM teslimler ) q WHERE YEAR(val)='$yil' && MONTH(val)='$i' ORDER BY teslim_verim_tarihi ASC");

					while($aa = mysqli_fetch_assoc($kontrolx)){
						$gun = date("d",$aa["teslim_verim_tarihi"]);
						$sayisi = $s->query("SELECT * FROM ( SELECT teslim_verim_tarihi, DATE_FORMAT(FROM_UNIXTIME(teslim_verim_tarihi), '%Y-%m-%d') AS val FROM teslimler ) q WHERE YEAR(val)='$yil' && DAY(val)='$gun' && MONTH(val)='$i'")->num_rows;
						echo "{ x: new Date($yil, $ayjava, $gun), y: $sayisi },";
					}
				
			}
			*/
			$kontrolx = $s->query("SELECT * FROM teslimler ORDER BY teslim_verim_tarihi ASC");
			while($aa = mysqli_fetch_assoc($kontrolx)){
				$gun = date("d",$aa["teslim_verim_tarihi"]);
				$ay = date("m",$aa["teslim_verim_tarihi"]);
				$yil = date("Y",$aa["teslim_verim_tarihi"]);
				$sayisi = $s->query("SELECT * FROM ( SELECT teslim_verim_tarihi, DATE_FORMAT(FROM_UNIXTIME(teslim_verim_tarihi), '%Y-%m-%d') AS val FROM teslimler ) q WHERE YEAR(val)='$yil' && DAY(val)='$gun' && MONTH(val)='$ay'")->num_rows;
				echo "{ x: new Date($yil, $ay, $gun), y: $sayisi },";
			}
			?>
			]
		}
		]
	});

	<?php
	$toplam_teslim = $s->query("SELECT teslim_id FROM teslimler")->num_rows;
	$kitap_alan_erkek = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE LOWER(a.ogrenci_cinsiyet) = 'erkek'")->num_rows;
	$kitap_alan_kiz = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE LOWER(a.ogrenci_cinsiyet) = 'kız'")->num_rows;
	if($toplam_teslim==0){
    	$erkek_yuzde = 0;
    	$kiz_yuzde = 0;
    }else{
	    $erkek_bol = $kitap_alan_erkek/$toplam_teslim;
		$erkek_yuzde = round($erkek_bol*100);
		$kiz_bol = $kitap_alan_kiz/$toplam_teslim;
		$kiz_yuzde = round($kiz_bol*100);
    }
	?>

	var chart2 = new CanvasJS.Chart("chartContainer2", {
				culture: "tr",
				exportEnabled: true,
				animationEnabled: true,
				title: {
					text: "Okuyanların Yüzdeleri (Erkek-Kız)"
				},
				data: [{
					type: "pie",
					axisYType: "secondary",
					indexLabel: "%{y} {label}",
					toolTipContent: "{sayi} teslim (%{y})",
					dataPoints: [
						{ y: <?php echo $erkek_yuzde; ?>, sayi: <?php echo $kitap_alan_erkek; ?>, label: "Erkek" },
						{ y: <?php echo $kiz_yuzde; ?>, sayi: <?php echo $kitap_alan_kiz; ?>, label: "Kız" },
					]
				}]
	});

	<?php
	$siniflar = array();
	$cek_siniflar_q = $s->query("SELECT ogrenci_sinif FROM ogrenciler");
	while($ccc = mysqli_fetch_assoc($cek_siniflar_q)){
		if(!in_array($ccc["ogrenci_sinif"], $siniflar)){
			array_push($siniflar, $ccc["ogrenci_sinif"]);
		}else{
			continue;
		}
	}
	?>

	var chart3 = new CanvasJS.Chart("chartContainer3", {
				culture: "tr",
				exportEnabled: true,
				animationEnabled: true,
				title: {
					text: "Okuyanların Yüzdeleri (Sınıflar)"
				},
				axisX:{
				   interval: 1,
				   labelAngle: 90
				 },
				dataPointWidth: 10,
				data: [{
					type: "column",
					indexLabel: "%{y}",
					toolTipContent: "{sayi} teslim (%{y})",
					dataPoints: [
						<?php
						foreach ($siniflar as $sinif){
							$kitap_alan = $s->query("SELECT p.teslim_alan_no, a.ogrenci_no, a.ogrenci_sinif FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE a.ogrenci_sinif = '$sinif'")->num_rows;
							if($toplam_teslim==0){
							    $sinif_yuzde = 0;
							  }else{
							    $yuzde_bol = $kitap_alan/$toplam_teslim;
								$sinif_yuzde = round($yuzde_bol*100);
							  }
							
						?>
							{ y: <?php echo $sinif_yuzde; ?>, sayi: <?php echo $kitap_alan; ?>, label: "<?php echo htmlspecialchars($sinif); ?>" },
						<?php 
						}
						?>
					]
				}]
	});

	chart.render();
	chart2.render();
	chart3.render();

	$("#your_isbn").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-boxa1").hide();
				$(".es-search-boxa1 ul").html("");
			}else{
				$(".es-search-boxa1").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.eser.from.isbn.php",
				  data: {
				    q: $("#your_isbn").val()
				  },
				  success: function(data) {
				    $(".es-search-boxa1 ul").html(data);
				  }
				});
			}
		});

	$("#your_username2").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-boxa2").hide();
				$(".es-search-boxa2 ul").html("");
			}else{
				$(".es-search-boxa2").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.ogrenci.from.ad.php",
				  data: {
				    q: $("#your_username2").val()
				  },
				  success: function(data) {
				    $(".es-search-boxa2 ul").html(data);
				  }
				});
			}
		});

	jQuery('#datetimepicker').pickadate({
		formatSubmit: 'dd.mm.yyyy',
		hiddenName: true
	});
	jQuery('#datetimepicker2').pickadate({
		formatSubmit: 'dd.mm.yyyy',
		hiddenName: true
	});

	//addQuickTeslim
	var but = "form#addQuickTeslim button.ilk";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/add.teslim.php",
		  data: $("form#addQuickTeslim").serialize(),
		  success: function(data) {
		  	devamEttir();
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla eklendi!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});

});
function addISBN(isbn){
	$("#your_isbn").val(isbn);
	$(".es-search-boxa1").hide();
	$(".es-search-boxa1 ul").html("");
}
function addOgrenci(no){
	$("#your_username2").val(no);
	$(".es-search-boxa2").hide();
	$(".es-search-boxa2 ul").html("");
}
<?php } ?>
$(document).ready(function(){

	var cur_sayfa = "?sayfa=<?php echo $getPage; ?>";
	$(".left-menu ul li a[href='"+cur_sayfa+"']").addClass("active");
	$(".left-menu ul li ul li a[href='"+cur_sayfa+"']").addClass("active");
	$(".left-menu ul li ul li a[href='"+cur_sayfa+"']").parent().parent().parent().find("a:first").addClass("active");
	$(".left-menu ul li ul li a[href='"+cur_sayfa+"']").parent().parent().parent().find("a:first").addClass("opened");
	$(".left-menu ul li ul li a[href='"+cur_sayfa+"']").parent().parent().parent().find("ul:first").show();
	$(".left-menu ul li ul li a[href='"+cur_sayfa+"']").parent().parent().parent().find(".right").html('<i class="fa fa-angle-double-down" aria-hidden="true"></i>');

	<?php if($getPage=="uyeler"){ ?>
	//searchUser
	});
		function nobetciYap(id){
			var dialog = new Messi(
			    'Bu üyeyi nöbetçi yapmak istediğinize emin misiniz?',
			    {
			        title: 'Nöbetçi Yap',
			        titleClass: 'anim',
			        buttons: [
			            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
			            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
			        ],
			        modal: true,
			        callback: function(val) {
			        	if(val=="Y"){
							$.ajax({
							  type: "POST",
							  url: "<?php echo TEMA_URL; ?>/post/nobetci.user.php",
							  data: { a1: id },
							  success: function(data) {
							    if(data=="ok"){
							    	window.location.href = '<?php echo URL; ?>/?sayfa=uyeler';
							    }else{
							    	var dialog = new Messi(
								    data,
									    {
									        title: 'HATA!',
									        titleClass: 'anim error',
									        modal: true,
									        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
									    }
									);
						    	}
							  }
							});
			        	}else{
			        		null;
			        	}
			        }
			    }
			);
			return false;
		}

	$(document).ready(function(){
	var user_real_data = $(".user-search-content").html();
	var gosterilen_sayi = $("#gosterilen_sayi").html();

	$("#searchUser").keyup(function () {
		if($(this).val() == ""){
			$(".user-search-content").html(user_real_data);
			$("#gosterilen_sayi").html(gosterilen_sayi);
		}else{
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/search.user.php",
			  data: {
			    q: $("#searchUser").val()
			  },
			  success: function(data) {
			    $(".user-search-container").html(data);
			    $("#gosterilen_sayi").html($('.user-search-container li').length);
			  }
			});
		}
	});
	<?php } ?>

	<?php if($getPage=="ogrenciler"){ ?>
	//searchUser
	});
	<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
	function deleteTumOgrenci(){
		var dialog = new Messi(
		    'Tüm öğrencileri silmek istediğinize emin misiniz?',
		    {
		        title: 'Tüm Öğrencileri Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.all.ogrenci.php",
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	} 
	<?php } ?>
	$(document).ready(function(){
	var user_real_data = $(".user-search-content").html();
	var gosterilen_sayi = $("#gosterilen_sayi").html();

	$("#searchOgrenci").keyup(function () {
		if($(this).val() == ""){
			$(".user-search-content").html(user_real_data);
			$("#gosterilen_sayi").html(gosterilen_sayi);
		}else{
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/search.ogrenci.php",
			  data: {
			    q: $("#searchOgrenci").val()
			  },
			  success: function(data) {
			    $(".user-search-container").html(data);
			    $("#gosterilen_sayi").html($('.user-search-container li').length);
			  }
			});
		}
	});
	<?php } ?>

	<?php if($getPage=="eser-kategori" && ($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2) ){ ?>

	});
		<?php
		if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
			echo 'var admin_mi = true;';
		}else{
			echo 'var admin_mi = false;';
		}
		?>

		function addCateg(){
			$("#addCat").attr("readonly","readonly");
			$("#addCatBut").attr("disabled","disabled");
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/add.cat.php",
			  data: {
			    a1: $("#addCat").val()
			  },
			  success: function(data) {
			  	$("#addCat").removeAttr("readonly");
				$("#addCatBut").removeAttr("disabled");
				$("#addCat").val("");
			  	if(data.indexOf("okeyto") >= 0){
			    	var ayir = data.split("******");
			    	var cid = ayir[1];
			    	var yeniad = htmlspecialchars(ayir[2]);
			    	var duzenle;
					if(admin_mi){
						duzenle = '<a href="#" onclick=\'editCat("'+cid+'","'+yeniad+'","0");return false;\'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
					}else{
						duzele = "";
					}
			    	$(".user-search-container").prepend('<li id="cat_'+cid+'">\
						<div class="right" style="margin:20px;margin-bottom: 0">\
							<div class="oneinf" id="cat_ad_'+cid+'">'+yeniad+'</div>\
							<div class="oneinf"><span>(0 Eser)</span>'+duzenle+'</div>\
						</div>\
					</li>');
			    }else{
			    	var dialog = new Messi(
						    data,
							    {
							        title: 'HATA!',
							        titleClass: 'anim error',
							        modal: true,
							        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
							    }
							);
			    }
			  }
			});
			return false;
		}

		function deleteCat(cid){
			var dialog = new Messi(
			    'Bu kategoriyi kaldırmak istediğinize emin misiniz?',
			    {
			        title: 'Kategoriyi Sil',
			        titleClass: 'anim error',
			        buttons: [
			            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
			            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
			        ],
			        modal: true,
			        callback: function(val) {
			        	if(val=="Y"){
							$.ajax({
							  type: "POST",
							  url: "<?php echo TEMA_URL; ?>/post/delete.cat.php",
							  data: { a1: cid },
							  success: function(data) {
							    $("#cat_"+cid).fadeOut();
							  }
							});
			        	}else{
			        		null;
			        	}
			        }
			    }
			);
			return false;
		}

		function updateCat(cid,kaceser){
			var asil = $("#but_"+cid).attr("onclick");
			$("#but_"+cid).attr("onclick","");
			$("#inp_"+cid).attr("readonly","readonly");
			var form_verileri = $("#updateCatForm_"+cid).serialize();
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/edit.cat.php",
			  data: form_verileri,
			  success: function(data) {
			  	$("#but_"+cid).attr("onclick",asil);
			  	$("#inp_"+cid).removeAttr("readonly");
			    if(data.indexOf("okeyto") >= 0){
			    	var ayir = data.split("******");
			    	var yeniad = htmlspecialchars(ayir[1]);
			    	stopeditCat(cid,yeniad,kaceser);
			    }else{
			    	var dialog = new Messi(
						    data,
							    {
							        title: 'HATA!',
							        titleClass: 'anim error',
							        modal: true,
							        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
							    }
							);
			    }
			  }
			});
			return false;
		}

		function editCat(cid,ad,kaceser){

			var div = $("#cat_"+cid);

			div.addClass("editing");

			div.find(".right").html('<div class="oneinf">\
				<form method="post" action="" id="updateCatForm_'+cid+'" onsubmit="return false;" autocomplete="off">\
				<input type="hidden" name="cid" value="'+cid+'" />\
				<input type="hidden" name="eskiad" value="'+htmlspecialchars(ad)+'" />\
				<input type="text" name="a1" id="inp_'+cid+'" value="'+htmlspecialchars(ad)+'" style="padding:4px" />\
				</form>\
				<a href="#" onclick=\'updateCat("'+cid+'","'+kaceser+'");return false;\' id="but_'+cid+'" return false;\'><i class="fa fa-paper-plane" aria-hidden="true"></i> Güncelle</a>\
				<a style="background-color:#951919" href="#" onclick=\'stopeditCat("'+cid+'","'+htmlspecialchars(ad)+'","'+kaceser+'"); return false;\'><i class="fa fa-times" aria-hidden="true"></i> Vazgeç</a>\
				&nbsp;&nbsp;&nbsp;<a style="background-color:#C42020" href="#" onclick=\'deleteCat("'+cid+'"); return false;\'><i class="fa fa-trash" aria-hidden="true"></i> SİL</a>\
			</div>');
			return false;
		}

		function stopeditCat(cid,ad,kaceser){
			var div = $("#cat_"+cid);
			div.removeClass("editing");
			var duzenle;
			if(admin_mi){
				duzenle = '<a href="#" onclick=\'editCat("'+cid+'","'+htmlspecialchars(ad)+'","'+kaceser+'");return false;\'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
			}else{
				duzele = "";
			}
			div.html('<li id="cat_'+cid+'">\
						<div class="right" style="margin-left:0;padding:17px">\
							<div class="oneinf" id="cat_ad_'+cid+'">'+htmlspecialchars(ad)+'</div>\
							<div class="oneinf"><span>('+kaceser+' Eser)</span>'+duzenle+'</div>\
						</div>\
					</li>');
			return false;
		}

	$(document).ready(function(){

	<?php } ?>

	<?php if($getPage=="eserler"){ ?>

	});

	function getEserBelirli(indir){
		var indirme_sayfasi = false;
		if(indir=="indir"){
			indirme_sayfasi = true;
		}

		if(indirme_sayfasi){

			Messi.load('<?php echo TEMA_URL; ?>/get/goToBelirliEser.php', {
				params: {download: 'yes'},
				modal: true,
			    title: 'Kriterler'
			});

		}else{

			Messi.load('<?php echo TEMA_URL; ?>/get/goToBelirliEser.php', {
				modal: true,
			    title: 'Kriterler'
			});

		}

		

		return false;
	}

	$(document).ready(function(){
	//searchEser
	var eser_real_data = $(".eser-search-content").html();
	var gosterilen_sayi = $("#gosterilen_sayi").html();

	$("#searchEser").keyup(function () {
		if($(this).val() == ""){
			$(".eser-search-content").html(eser_real_data);
			$("#gosterilen_sayi").html(gosterilen_sayi);
		}else{
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/search.eser.php",
			  data: {
			    q: $("#searchEser").val()
			  },
			  success: function(data) {
			    $(".eser-search-container").html(data);
			    $("#gosterilen_sayi").html($('.eser-search-container li').length);
			  }
			});
		}
	});
	<?php } ?>

	<?php if($getPage=="uye-duzenle"){ ?>
	//updateUye
	});
	function user_foto_kaldir(id){
		var dialog = new Messi(
		    'Bu fotoğrafı kaldırmak istediğinize emin misiniz?',
		    {
		        title: 'Fotoğrafı Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.user.foto.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	function uye_sil(id){
		var dialog = new Messi(
		    'Bu üyeyi silmek istediğinize emin misiniz?',
		    {
		        title: 'Üyeyi Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.user.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.href = '<?php echo URL; ?>/?sayfa=uyeler';
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	$(document).ready(function(){
	$("form#updateUye").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/edit.user.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla güncelleştirildi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="arsiv-duzenle"){ ?>
	});
	function arsiv_sil(id){
		var dialog = new Messi(
		    'Bu arşivi silmek istediğinize emin misiniz?',
		    {
		        title: 'Arşivi Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.arsiv.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.href = '<?php echo URL; ?>/?sayfa=arsivler';
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}
	$(document).ready(function(){
	$("form#updateArsiv").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/edit.arsiv.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla güncelleştirildi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="ogrenci-ice-aktar"){ ?>
	$("form#ogrenciAktar").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/aktar.ogrenci.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla aktarıldı!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="eser-ice-aktar"){ ?>
	$("form#eserAktar").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/aktar.eser.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla aktarıldı!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="ogrenci-duzenle"){ ?>
	//updateOgrenci
	});

	function ogrenci_sil(id){
		var dialog = new Messi(
		    'Bu öğrenciyi silmek istediğinize emin misiniz?',
		    {
		        title: 'Öğrenciyi Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.ogrenci.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.href = '<?php echo URL; ?>/?sayfa=ogrenciler';
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	$(document).ready(function(){
	$("form#updateOgrenci").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/edit.ogrenci.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla güncelleştirildi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="eser-duzenle"){ ?>
	});

	function fillISBN(){
		var isbn_ham = $("#your_isbn").val();
		var isbn = isbn_ham.replace(/-/g,"");

		var urlx = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
		  $.getJSON(urlx, function(a){
		    
			    // There'll be only 1 book per ISBN
			    var totalItems = a["totalItems"];
			    if(isbn_ham && totalItems>0){

			    	var book = a.items[0];
				    var title = (book["volumeInfo"]["title"]);
				    var subtitle = (book["volumeInfo"]["subtitle"]);
				    var authors = (book["volumeInfo"]["authors"][0]);
				    var printType = (book["volumeInfo"]["printType"]);
				    var pageCount = (book["volumeInfo"]["pageCount"]);
				    var publisher = (book["volumeInfo"]["publisher"]);
				    var publishedDate = (book["volumeInfo"]["publishedDate"]);
				    var webReaderLink = (book["accessInfo"]["webReaderLink"]);
				    var imageLing = (book["volumeInfo"]["imageLinks"]["thumbnail"]);
				    
				    // For debugging
				    // console.log(title);
				    // console.log(authors);
				    // console.log(publisher);
				  	// console.log(publishedDate);
				  	// console.log(imageLing);

				  	//doldur
				  	$("#your_username").val(title);
				  	$("#your_name").val(authors);
				  	$("#your_email").val(publisher);

				}else{
					alert("Eser bulunamadı!");
				}

		  });
	}

	function downloadISBN(){
		var isbn_ham = $("#your_isbn").val();
		var isbn = isbn_ham.replace(/-/g,"");

		var urlx = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
		  $.getJSON(urlx, function(a){
		    
			    // There'll be only 1 book per ISBN
			    var totalItems = a["totalItems"];
			    if(isbn_ham && totalItems>0){
			    
			    	var book = a.items[0];
				    var title = (book["volumeInfo"]["title"]);
				    var subtitle = (book["volumeInfo"]["subtitle"]);
				    var authors = (book["volumeInfo"]["authors"][0]);
				    var printType = (book["volumeInfo"]["printType"]);
				    var pageCount = (book["volumeInfo"]["pageCount"]);
				    var publisher = (book["volumeInfo"]["publisher"]);
				    var publishedDate = (book["volumeInfo"]["publishedDate"]);
				    var webReaderLink = (book["accessInfo"]["webReaderLink"]);
				    var imageLing = (book["volumeInfo"]["imageLinks"]["thumbnail"]);
				    
				    // For debugging
				  	//console.log(imageLing);

				  	//doldur
				  	var link = document.createElement('a');
					link.href = imageLing;
					link.download = isbn+".jpg";
					document.body.appendChild(link);
					link.click();

				}else{
					alert("Eser bulunamadı!");
				}

		  });
	}

	function eser_foto_kaldir(id){
		var dialog = new Messi(
		    'Bu fotoğrafı kaldırmak istediğinize emin misiniz?',
		    {
		        title: 'Fotoğrafı Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.eser.foto.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	function eser_sil(id){
		var dialog = new Messi(
		    'Bu eseri silmek istediğinize emin misiniz?',
		    {
		        title: 'Eseri Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.eser.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.href = '<?php echo URL; ?>/?sayfa=eserler';
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	$(document).ready(function(){
	//updateEser
	$("form#updateEser").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/edit.eser.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla güncelleştirildi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

	<?php if($getPage=="teslimler"){ ?>
	});
	function iade_onay(teslimid,alanid){
			var dialogx = new Messi(
			    'İadeyi Onayla?',
			    {
			        title: 'Emin misiniz?',
			        titleClass: 'anim',
			        buttons: [
			            {id: 2, label: 'Evet', val: 'Y', class: 'btn-success'},
			            {id: 3, label: 'Hayır', val: 'N', class: 'btn-danger'},
			        ],
			        modal: true,
			        callback: function(val) {
			        	if(val=="Y"){
							$.ajax({
							  type: "POST",
							  url: "<?php echo TEMA_URL; ?>/post/iade.eser.php",
							  data: { a1: teslimid, a2: alanid },
							  success: function(data) {
							    if(data=="ok"){
							    	window.location.reload();
							    }else{
							    	alert(data);
						    	}
							  }
							});
			        	}else{
			        		null;
			        	}
			        }
			    }
			);
		}
	$(document).ready(function(){
	//searchTeslim
	var teslim_real_data = $(".teslim-search-content").html();
	var gosterilen_sayi = $("#gosterilen_sayi").html();

	$("#searchTeslim").keyup(function () {
		if($(this).val() == ""){
			$(".teslim-search-content").html(teslim_real_data);
			$("#gosterilen_sayi").html(gosterilen_sayi);
		}else{
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/search.teslim.php",
			  data: {
			    q: $("#searchTeslim").val()
			  },
			  success: function(data) {
			    $(".teslim-search-container").html(data);
			    $("#gosterilen_sayi").html($('.teslim-search-container li').length);
			  }
			});
		}
	});
	<?php } ?>

	<?php if($getPage=="nobet-duzenle"){ ?>
	//nöbet düzenle
	});
	<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
	function nobet_sil(id){
		var dialog = new Messi(
		    'Bu nöbet kaydını silmek istediğinize emin misiniz?',
		    {
		        title: 'Nöbet Kaydını Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.nobet.php",
						  data: {a1:id},
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.href = '<?php echo URL; ?>/?sayfa=nobetci-kayit';
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	} 
	<?php } ?>
	$(document).ready(function(){
	jQuery('.nobettarih').pickadate({
			editable: true,
			formatSubmit: 'dd.mm.yyyy',
			hiddenName: true
		}).attr('readonly', 'readonly');

	var but = "form#updateNobet button.guncelle";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/edit.nobet.php",
		  data: $("form#updateNobet").serialize(),
		  success: function(data) {
		  	devamEttir();
		  	$(".nobettarih").attr("readonly","readonly");
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla güncelleştirildi!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});
	<?php } ?>

	<?php if($getPage=="nobetci-kayit"){ ?>
	//searchTeslim
	});
	<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
	function deleteTumNobet(){
		var dialog = new Messi(
		    'Tüm nöbet kaydını silmek istediğinize emin misiniz?',
		    {
		        title: 'Tüm Nöbet Kaydını Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.all.nobet.php",
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	} 
	function nobet_ekle(){
		var form = $("#addNobetForm");
		var veriler = form.serialize();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/add.nobet.php",
		  data: veriler,
		  success: function(data) {
		    if(data=="ok"){
		    	window.location.reload();
		    }else{
		    	var dialog = new Messi(
			    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
	    	}
		  }
		});
	}
	<?php } ?>
	$(document).ready(function(){
	<?php } ?>

	<?php if($getPage=="eylemler"){ ?>
	//searchTeslim
	});
	<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
	function deleteTumEylem(){
		var dialog = new Messi(
		    'Tüm eylem kaydını silmek istediğinize emin misiniz?',
		    {
		        title: 'Tüm Eylem Kaydını Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.all.eylem.php",
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	} 
	<?php } ?>
	$(document).ready(function(){
	var teslim_real_data = $(".user-search-content").html();

	$("#searchEylem").keyup(function () {
		if($(this).val() == ""){
			$(".user-search-content").html(teslim_real_data);
		}else{
			var first_veri = $("#searchEylem").val();
			var second_veri = $(".lastData").attr("id");
			$.ajax({
			  type: "POST",
			  url: "<?php echo TEMA_URL; ?>/post/search.eylem.php",
			  data: { q: first_veri, qx: second_veri },
			  success: function(data) {
			    $(".user-search-container").html(data);
			  }
			});
		}
	});
	<?php } ?>

	<?php if($getPage=="teslim-duzenle"){ ?>
		
		jQuery('#datetimepicker').pickadate({
			formatSubmit: 'dd.mm.yyyy',
			hiddenName: true
		});
		jQuery('#datetimepicker2').pickadate({
			formatSubmit: 'dd.mm.yyyy',
			hiddenName: true
		});

		});
		function iade_onay(teslimid,alanid){
			var dialogx = new Messi(
			    'İadeyi Onayla?',
			    {
			        title: 'Emin misiniz?',
			        titleClass: 'anim',
			        buttons: [
			            {id: 2, label: 'Evet', val: 'Y', class: 'btn-success'},
			            {id: 3, label: 'Hayır', val: 'N', class: 'btn-danger'},
			        ],
			        modal: true,
			        callback: function(val) {
			        	if(val=="Y"){
							$.ajax({
							  type: "POST",
							  url: "<?php echo TEMA_URL; ?>/post/iade.eser.php",
							  data: { a1: teslimid, a2: alanid },
							  success: function(data) {
							    if(data=="ok"){
							    	window.location.reload();
							    }else{
							    	alert(data);
						    	}
							  }
							});
			        	}else{
			        		null;
			        	}
			        }
			    }
			);
		}
		function delete_teslim(teslimid){
			var dialogx = new Messi(
			    'Bu teslimi silmek istediğinizden emin misiniz?',
			    {
			        title: 'Emin misiniz?',
			        titleClass: 'anim error',
			        buttons: [
			            {id: 4, label: 'Evet', val: 'Y', class: 'btn-success'},
			            {id: 5, label: 'Hayır', val: 'N', class: 'btn-danger'},
			        ],
			        modal: true,
			        callback: function(val) {
			        	if(val=="Y"){
							$.ajax({
							  type: "POST",
							  url: "<?php echo TEMA_URL; ?>/post/delete.teslim.php",
							  data: { a1: teslimid },
							  success: function(data) {
							    if(data=="ok"){
							    	window.location.href = '<?php echo URL; ?>/?sayfa=teslimler';
							    }else{
							    	alert(data);
						    	}
							  }
							});
			        	}else{
			        		null;
			        	}
			        }
			    }
			);
		}
		function addISBN(isbn){
			$("#your_isbn").val(isbn);
			$(".es-search-box1").hide();
			$(".es-search-box1 ul").html("");
		}
		function addOgrenci(no){
			$("#your_username2").val(no);
			$(".es-search-box2").hide();
			$(".es-search-box2 ul").html("");
		}

	$(document).ready(function(){

		$("#your_isbn").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-box1").hide();
				$(".es-search-box1 ul").html("");
			}else{
				$(".es-search-box1").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.eser.from.isbn.php",
				  data: {
				    q: $("#your_isbn").val()
				  },
				  success: function(data) {
				    $(".es-search-box1 ul").html(data);
				  }
				});
			}
		});

		$("#your_username2").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-box2").hide();
				$(".es-search-box2 ul").html("");
			}else{
				$(".es-search-box2").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.ogrenci.from.ad.php",
				  data: {
				    q: $("#your_username2").val()
				  },
				  success: function(data) {
				    $(".es-search-box2 ul").html(data);
				  }
				});
			}
		});

	//updateTeslim
	var but = "form#updateTeslim button.ilk";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/edit.teslim.php",
		  data: $("form#updateTeslim").serialize(),
		  success: function(data) {
		  	devamEttir();
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla güncelleştirildi!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});
	<?php } ?>

	<?php if($getPage=="uye-ekle"){ ?>

		$("form#addUye").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/add.user.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla eklendi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));

	<?php } ?>

	<?php if($getPage=="ogrenci-ekle"){ ?>

		$("form#addOgrenci").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/add.ogrenci.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla eklendi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));

	<?php } ?>

	<?php if($getPage=="eser-ekle"){ ?>

	});

	function fillISBN(){
		var isbn_ham = $("#your_isbn").val();
		var isbn = isbn_ham.replace(/-/g,"");

		var urlx = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
		  $.getJSON(urlx, function(a){
		    
			    // There'll be only 1 book per ISBN
			    var totalItems = a["totalItems"];
			    if(isbn_ham && totalItems>0){

			    	var book = a.items[0];
				    var title = (book["volumeInfo"]["title"]);
				    var subtitle = (book["volumeInfo"]["subtitle"]);
				    var authors = (book["volumeInfo"]["authors"][0]);
				    var printType = (book["volumeInfo"]["printType"]);
				    var pageCount = (book["volumeInfo"]["pageCount"]);
				    var publisher = (book["volumeInfo"]["publisher"]);
				    var publishedDate = (book["volumeInfo"]["publishedDate"]);
				    var webReaderLink = (book["accessInfo"]["webReaderLink"]);
				    var imageLing = (book["volumeInfo"]["imageLinks"]["thumbnail"]);
				    
				    // For debugging
				    // console.log(title);
				    // console.log(authors);
				    // console.log(publisher);
				  	// console.log(publishedDate);
				  	// console.log(imageLing);

				  	//doldur
				  	$("#your_username").val(title);
				  	$("#your_name").val(authors);
				  	$("#your_email").val(publisher);

				}else{
					alert("Eser bulunamadı!");
				}

		  });
	}

	function downloadISBN(){
		var isbn_ham = $("#your_isbn").val();
		var isbn = isbn_ham.replace(/-/g,"");

		var urlx = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
		  $.getJSON(urlx, function(a){
		    
			    // There'll be only 1 book per ISBN
			    var totalItems = a["totalItems"];
			    if(isbn_ham && totalItems>0){
			    
			    	var book = a.items[0];
				    var title = (book["volumeInfo"]["title"]);
				    var subtitle = (book["volumeInfo"]["subtitle"]);
				    var authors = (book["volumeInfo"]["authors"][0]);
				    var printType = (book["volumeInfo"]["printType"]);
				    var pageCount = (book["volumeInfo"]["pageCount"]);
				    var publisher = (book["volumeInfo"]["publisher"]);
				    var publishedDate = (book["volumeInfo"]["publishedDate"]);
				    var webReaderLink = (book["accessInfo"]["webReaderLink"]);
				    var imageLing = (book["volumeInfo"]["imageLinks"]["thumbnail"]);
				    
				    // For debugging
				  	//console.log(imageLing);

				  	//doldur
				  	var link = document.createElement('a');
					link.href = imageLing;
					link.download = isbn+".jpg";
					document.body.appendChild(link);
					link.click();

				}else{
					alert("Eser bulunamadı!");
				}

		  });
	}

	$(document).ready(function(){

		$("form#addEser").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/add.eser.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla eklendi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));

	<?php } ?>

	<?php if($getPage=="teslim-ekle"){ ?>

		jQuery('#datetimepicker').pickadate({
			formatSubmit: 'dd.mm.yyyy',
			hiddenName: true
		});
		jQuery('#datetimepicker2').pickadate({
			formatSubmit: 'dd.mm.yyyy',
			hiddenName: true
		});

		});

	function addISBN(isbn){
		$("#your_isbn").val(isbn);
		$(".es-search-box1").hide();
		$(".es-search-box1 ul").html("");
	}
	function addOgrenci(no){
		$("#your_username2").val(no);
		$(".es-search-box2").hide();
		$(".es-search-box2 ul").html("");
	}

	$(document).ready(function(){

		$("#your_isbn").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-box1").hide();
				$(".es-search-box1 ul").html("");
			}else{
				$(".es-search-box1").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.eser.from.isbn.php",
				  data: {
				    q: $("#your_isbn").val()
				  },
				  success: function(data) {
				    $(".es-search-box1 ul").html(data);
				  }
				});
			}
		});

		$("#your_username2").keyup(function () {
			if($(this).val() == ""){
				$(".es-search-box2").hide();
				$(".es-search-box2 ul").html("");
			}else{
				$(".es-search-box2").show();
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.ogrenci.from.ad.php",
				  data: {
				    q: $("#your_username2").val()
				  },
				  success: function(data) {
				    $(".es-search-box2 ul").html(data);
				  }
				});
			}
		});

	//addTeslim
	var but = "form#addTeslim button.ilk";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/add.teslim.php",
		  data: $("form#addTeslim").serialize(),
		  success: function(data) {
		  	devamEttir();
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla eklendi!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});
	<?php } ?>

	<?php if($getPage=="teslimler-arsiv"){ ?>
	//editSistem
	var but = "form#arsivOlustur button";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/add.arsiv.php",
		  data: $("form#arsivOlustur").serialize(),
		  success: function(data) {
		  	devamEttir();
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla oluşturuldu!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});
	
	<?php } ?>

	<?php if($getPage=="arsivler"){ ?>
		var user_real_data = $(".user-search-content").html();
		var gosterilen_sayi = $("#gosterilen_sayi").html();

		$("#searchArsiv").keyup(function () {
			if($(this).val() == ""){
				$(".user-search-content").html(user_real_data);
				$("#gosterilen_sayi").html(gosterilen_sayi);
			}else{
				$.ajax({
				  type: "POST",
				  url: "<?php echo TEMA_URL; ?>/post/search.arsiv.php",
				  data: {
				    q: $("#searchArsiv").val()
				  },
				  success: function(data) {
				    $(".user-search-container").html(data);
				    $("#gosterilen_sayi").html($('.user-search-container li').length);
				  }
				});
			}
		});
	<?php } ?>

	<?php if($getPage=="site-ayarlari"){ ?>

		//editSistem
	var but = "form#editSistem button.ilk";
	$(but).click(function(){
		dondur();
		$.ajax({
		  type: "POST",
		  url: "<?php echo TEMA_URL; ?>/post/edit.sistem.php",
		  data: $("form#editSistem").serialize(),
		  success: function(data) {
		  	devamEttir();
		    if(data=="ok"){
		    	var dialog = new Messi(
				    "Başarıyla güncelleştirildi!",
				    {
				        title: 'BAŞARI!',
				        titleClass: 'anim success',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
				        callback: function(val) { window.location.reload(); }
				    }
				);
		    }else{
		    	var dialog = new Messi(
				    data,
				    {
				        title: 'HATA!',
				        titleClass: 'anim error',
				        modal: true,
				        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
				    }
				);
		    }
		  }
		});
	});

	<?php } ?>

	<?php if($getPage=="arsiv-duzenle"){ ?>
$(document).ready(function(){
	CanvasJS.addCultureInfo("tr",
    {
        decimalSeparator: ".",
        digitGroupSeparator: ",",
        zoomText: "Yakınlaştır",
        panText: "Pan",
        savePNGText: "PNG olarak kaydet",
        saveJPGText: "JPG olarak kaydet",
        menuText: "Diğer Ayarlar",
        days: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
        shortDays: ["Pzt","Sal","Çar","Per","Cum","Cmt","Paz"],
        months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
        shortMonths: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"]
   });
	var chart = new CanvasJS.Chart("chartContainer1", {
		culture:  "tr",
		exportEnabled: true,
		title: {
			text: "Teslimler - aya göre"
		},
		animationEnabled: true,
		axisX: {
			interval: 1,
			intervalType: "month",
			labelAngle: -30,
		},
		axisY: {
			includeZero: true,
		},
		data: [{
			type: "line",
			lineThickness: 3,
			minimum: 0,
			dataPoints: [
			<?php
			$kontrolx = $s->query("SELECT * FROM teslimler_arsiv WHERE arsiv_id='$getArsiv' ORDER BY teslim_verim_tarihi ASC");
			while($aa = mysqli_fetch_assoc($kontrolx)){
				$gun = date("d",$aa["teslim_verim_tarihi"]);
				$ay = date("m",$aa["teslim_verim_tarihi"]);
				$yil = date("Y",$aa["teslim_verim_tarihi"]);
				$sayisi = $s->query("SELECT * FROM ( SELECT teslim_verim_tarihi, DATE_FORMAT(FROM_UNIXTIME(teslim_verim_tarihi), '%Y-%m-%d') AS val FROM teslimler_arsiv WHERE arsiv_id='$getArsiv') q WHERE YEAR(val)='$yil' && DAY(val)='$gun' && MONTH(val)='$ay'")->num_rows;
				echo "{ x: new Date($yil, $ay, $gun), y: $sayisi },";
			}
			?>
			]
		}
		]
	});

	<?php
	$toplam_teslim = $s->query("SELECT id FROM teslimler_arsiv WHERE arsiv_id='$getArsiv'")->num_rows;
	$kitap_alan_erkek = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet) = 'erkek' && arsiv_id='$getArsiv'")->num_rows;
	$kitap_alan_kiz = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet) = 'kız' && arsiv_id='$getArsiv'")->num_rows;
	if($toplam_teslim==0){
    	$erkek_yuzde = 0;
    	$kiz_yuzde = 0;
    }else{
	    $erkek_bol = $kitap_alan_erkek/$toplam_teslim;
		$erkek_yuzde = round($erkek_bol*100);
		$kiz_bol = $kitap_alan_kiz/$toplam_teslim;
		$kiz_yuzde = round($kiz_bol*100);
    }
	?>

	var chart2 = new CanvasJS.Chart("chartContainer2", {
				culture: "tr",
				exportEnabled: true,
				animationEnabled: true,
				title: {
					text: "Okuyanların Yüzdeleri (Erkek-Kız)"
				},
				data: [{
					type: "pie",
					axisYType: "secondary",
					indexLabel: "%{y} {label}",
					toolTipContent: "{sayi} teslim (%{y})",
					dataPoints: [
						{ y: <?php echo $erkek_yuzde; ?>, sayi: <?php echo $kitap_alan_erkek; ?>, label: "Erkek" },
						{ y: <?php echo $kiz_yuzde; ?>, sayi: <?php echo $kitap_alan_kiz; ?>, label: "Kız" },
					]
				}]
	});

	<?php

	$siniflar = array();
	$siniflar_cek = $s->query("SELECT * FROM arsivler WHERE id='$getArsiv'");
	while($xyz = mysqli_fetch_assoc($siniflar_cek)){
		$arsiv_siniflar = $xyz["arsiv_siniflar"];
		$parcala = explode(",",$arsiv_siniflar);
		foreach($parcala as $parca){
			array_push($siniflar,$parca);
		}
	}

	?>

	var chart3 = new CanvasJS.Chart("chartContainer3", {
				culture: "tr",
				exportEnabled: true,
				animationEnabled: true,
				title: {
					text: "Okuyanların Yüzdeleri (Sınıflar)"
				},
				axisX:{
				   interval: 1,
				   labelAngle: 90
				 },
				dataPointWidth: 13,
				data: [{
					type: "column",
					indexLabel: "%{y}",
					toolTipContent: "{sayi} teslim (%{y})",
					dataPoints: [
						<?php
						foreach ($siniflar as $sinif){
							$parcala = explode("-",$sinif);
							$sinifimiz = $parcala[0];
							$sinif_kiz = $parcala[1];
							$sinif_erkek = $parcala[2];
							$kitap_alan_kiz = $s->query("SELECT * FROM teslimler_arsiv WHERE teslim_alan_sinif='$sinifimiz' && LOWER(teslim_alan_cinsiyet)='kız' && arsiv_id='$getArsiv'")->num_rows;
							$kitap_alan_erkek = $s->query("SELECT * FROM teslimler_arsiv WHERE teslim_alan_sinif='$sinifimiz' && LOWER(teslim_alan_cinsiyet)='erkek' && arsiv_id='$getArsiv'")->num_rows;
							$sinif_toplam = (int)$kitap_alan_kiz+(int)$kitap_alan_erkek;
							$kitap_alan = $s->query("SELECT * FROM teslimler_arsiv WHERE teslim_alan_sinif='$sinifimiz' && arsiv_id='$getArsiv'")->num_rows;
							if($toplam_teslim==0){
							    $sinif_yuzde = 0;
							  }else{
							    $yuzde_bol = $kitap_alan/$toplam_teslim;
								$sinif_yuzde = round($yuzde_bol*100);
							  }
							
						?>
							{ y: <?php echo $sinif_yuzde; ?>, sayi: <?php echo $sinif_toplam; ?>, label: "<?php echo htmlspecialchars($sinifimiz); ?>" },
						<?php 
						}
						?>
					]
				}]
	});

	chart.render();
	chart2.render();
	chart3.render();

});
<?php } ?>

	<?php if($getPage=="hesap-ayarlari"){ ?>
	//updateYourself
	});
	function user_foto_kaldir(id){
		var dialog = new Messi(
		    'Bu fotoğrafı kaldırmak istediğinize emin misiniz?',
		    {
		        title: 'Fotoğrafı Sil',
		        titleClass: 'anim error',
		        buttons: [
		            {id: 0, label: 'Evet', val: 'Y', class: 'btn-success'},
		            {id: 1, label: 'Hayır', val: 'N', class: 'btn-danger'},
		        ],
		        modal: true,
		        callback: function(val) {
		        	if(val=="Y"){
						$.ajax({
						  type: "POST",
						  url: "<?php echo TEMA_URL; ?>/post/delete.yourself.foto.php",
						  data: { a1: id },
						  success: function(data) {
						    if(data=="ok"){
						    	window.location.reload();
						    }else{
						    	var dialog = new Messi(
							    data,
								    {
								        title: 'HATA!',
								        titleClass: 'anim error',
								        modal: true,
								        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
								    }
								);
					    	}
						  }
						});
		        	}else{
		        		null;
		        	}
		        }
		    }
		);
	}

	$(document).ready(function(){
	$("form#updateYourself").on('submit',(function(e) {
		e.preventDefault();
		dondur();
		$.ajax({
			url: "<?php echo TEMA_URL; ?>/post/edit.yourself.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				devamEttir();
				if(data=="ok"){
			    	var dialog = new Messi(
					    "Başarıyla güncelleştirildi!",
					    {
					        title: 'BAŞARI!',
					        titleClass: 'anim success',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ],
					        callback: function(val) { window.location.reload(); }
					    }
					);
			    }else{
			    	var dialog = new Messi(
					    data,
					    {
					        title: 'HATA!',
					        titleClass: 'anim error',
					        modal: true,
					        buttons: [ {id: 0, label: 'Kapat', val: 'X'} ]
					    }
					);
			    }
			}
		});
	}));
	<?php } ?>

});
</script>
</body>
</html>
<?php } ?>