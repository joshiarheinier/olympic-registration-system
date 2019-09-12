$(document).ready(function(){
    $("form#participant-data").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: $('input[name="link"]').val(),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (response) {
                $("div#error-msg p").html('');
                var JSONResponse = JSON.parse(response);
                if (JSONResponse.status == "success") {
                    var updateHtml = '<div class="row"><div class="col-lg-9 col-md-9"><div class="row"><div class="col-lg-4 col-md-4"><h4>NPM</h4></div><div class="col-lg-8 col-md-8"><h5>';
                    updateHtml += JSONResponse.id;
                    updateHtml += '</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Nama Lengkap</h4></div><div class="col-lg-8 col-md-8"><h5>';
                    updateHtml += JSONResponse.name;
                    updateHtml += '</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Jurusan</h4></div><div class="col-lg-8 col-md-8"><h5>';
                    updateHtml += JSONResponse.major;
                    updateHtml += '</h5></div></div></div><div class="col-lg-3 col-md-3"><img src="';
                    updateHtml += JSONResponse.image_link;
                    updateHtml += '" height="175" width="135"></div></div><hr>';
                    $("div#participant-detail").append(updateHtml);
                } else {
                    $("div#error-msg p").append(JSONResponse.message);
                    $("div#error-msg p").css({"color": "#ff0000"});
                }
            }
        });
    });
});