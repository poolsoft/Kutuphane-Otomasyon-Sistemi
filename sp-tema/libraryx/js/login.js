$(document).ready(function(){
    $(".login-page").backstretch(THEME_URL+"/images/bg.jpg");

    var form = $("#girisForm");
    form.find("button").click(function(){
        $.ajax({
          type: "POST",
          url: THEME_URL+"/post/giris.php",
          data: form.serialize(),
          beforeSend: function(){
            form.find("input,textarea,button").attr("disabled","disabled");
          },
          success: function(response) {
            form.find("input,textarea,button").removeAttr("disabled");
            if(response=="ok"){
                location.reload();
            }else{
                var dialog = new Messi(
                    response,
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