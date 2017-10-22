$(document).ready(function(){
    //solmenu
	$(".left-menu ul li.hasSub a").not(".left-menu ul li.hasSub ul li a").click(function(){
        if($(this).hasClass("opened")){
            $(this).next("ul").slideUp("fast");
            $(this).removeClass("opened");
            $("span.right", this).html('<i class="fa fa-angle-double-right" aria-hidden="true"></i>');
        }else{
            $(this).next("ul").slideDown("fast");
            $(this).addClass("opened");
            $("span.right", this).html('<i class="fa fa-angle-double-down" aria-hidden="true"></i>');
        }
    return false;
    });

    //hamburger icon
    var hamburger_icon_content =  $(".hamburger-icon").html();
    $(".hamburger-icon").click(function(){
        if($(this).hasClass("opened-hamburger")){
            $(".sidebar").hide();
            $(this).removeClass("opened-hamburger");
            $(".hamburger-icon").html(hamburger_icon_content);
        }else{
            $(".sidebar").show();
            $(this).addClass("opened-hamburger");
            $(".hamburger-icon").html('<i class="fa fa-times" aria-hidden="true"></i>');
        }
        return false;
    });

    //sol menu aktif dropdown aç
    $(".left-menu ul li.hasSub a").not(".left-menu ul li.hasSub ul li a").append('<span class="right"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>');
    $(".left-menu ul li.hasSub a.active").addClass("opened");
    $(".left-menu ul li.hasSub a.active").parent("li").find("ul").show();
    $(".left-menu ul li.hasSub a.active span.right").html('<i class="fa fa-angle-double-down" aria-hidden="true"></i>');

    //kullanıcı adına tıklayınca açılan menü
    $("#openUserMenu").click(function(e){
        e.stopPropagation();
        if( $(this).hasClass("opened") ){
            $(".user-menu").hide();
            $(this).removeClass("opened");
        }else{
            $(".user-menu").show();
            $(this).addClass("opened");
        }
        return false;
    });
    $(".user-menu").click(function(e){
        e.stopPropagation();
    });
    $(document).click(function() {
        if( $("#openUserMenu").hasClass("opened") ){
            $(".user-menu").hide();
            $("#openUserMenu").removeClass("opened");
        }
    });
    
});


//enquire
enquire.register("all and (max-width:860px)", {

    // OPTIONAL
    // If supplied, triggered when a media query matches.
    match : function() {
        $(".sidebar").hide();
        $(".full-content").css("margin-left","0");
        $(".hamburger-icon").removeClass("opened-hamburger");
        $(".hamburger-icon").html('<i class="fa fa-bars" aria-hidden="true"></i>');
        $(".hamburger-icon").fadeIn("fast");
    },

    // OPTIONAL
    // If supplied, triggered when the media query transitions
    // *from a matched state to an unmatched state*.
    unmatch : function() {
        $(".sidebar").show();
        $(".full-content").css("margin-left","");
        $(".hamburger-icon").removeClass("opened-hamburger");
        $(".hamburger-icon").html('<i class="fa fa-bars" aria-hidden="true"></i>');
        $(".hamburger-icon").fadeOut("fast");
    },

    // OPTIONAL
    // If supplied, triggered once, when the handler is registered.
    setup : function() {},

    // OPTIONAL, defaults to false
    // If set to true, defers execution of the setup function
    // until the first time the media query is matched
    deferSetup : true,

    // OPTIONAL
    // If supplied, triggered when handler is unregistered.
    // Place cleanup code here
    destroy : function() {}

});