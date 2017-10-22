function checkScroll(){
    if( $(window).scrollTop() >= 100 ){
		$(".sidebar").css({
			"position": "fixed",
			"top": "3%"
		});
	}else{
		$(".sidebar").css({
			"position": "",
			"top": ""		
		});
	}
}

$(document).ready(function(){

	checkScroll();
	$(window).scroll(checkScroll);

});