<script type="text/javascript">
    var themeColor, buttonColor;
    $(window).on('load', function() {
        $('#loadingDiv').fadeOut('fast');
        $('.templateSec .templateView, .controls').css('min-height', `calc(100vh - ${$('header').outerHeight()}px)`);
        $('.controls').css('height', `calc(100vh - ${$('header').outerHeight()}px)`);
    });
    $(document).ready(function(e){
        $('#cpColor').ColorPicker({
            onShow: function (e) {
                $(e).fadeIn(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                themeColor = '#'+hex;

                $('[name=theme_color]').val(themeColor);

                $('.templateSec .templateView').css('background-color', themeColor);
            },
        });
        $('#cpButton').ColorPicker({
            onShow: function (e) {
                $(e).fadeIn(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                buttonColor = '#'+hex;

                $('[name=theme_button]').val(buttonColor);
                $('[name=theme_border]').val(darken(buttonColor, 15));

                $('.btnColor').css('background-color', buttonColor);
                $('.btnColor').css('border-color', darken(buttonColor, 15));
                $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('background-color', buttonColor);
                $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('border-color', darken(buttonColor, 15));
            },
        });
    });
    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
    $(document).on('click','.toggleSide', function(e){
        e.preventDefault();
        var x = $('#mainCont');
        if(!x.is(':visible')){
            $('.controls').hide();
            $('.templateView').addClass('quartWidth');
            setTimeout(function() {
                $('#mainCont').fadeIn();
            }, 500);
        }else{
            var ctn = 0;
            $('.controls').fadeOut(500, function() {
                ctn++;
                if (ctn == 6) {
                    $('.templateView').removeClass('quartWidth');
                }
            });
        }
    });
    $(document).on('click','.backBtn', function(e){
        e.preventDefault();
        var x = $(this).parents('.controls');
        if(x.is(':visible')){
            x.hide();
            $('#mainCont').fadeIn();
            $('.toggleSide').show();
        }
    });
    $(document).on('click','.colorItem', function(){
        var color = $(this).data('id');
        var shades = $(this).parents('.colorPicker').find('.colorShadeItem');
        for(i = 1; i <= 5; i++){
            shades.removeClass('color' + i);
        }
        shades.addClass('color' + color);
        if($(this).parents('#color').length){
            $('#color .colorList .colorItem').removeClass('selected');
            $(this).addClass('selected');
            bgColor = $(this).css('background-color');
            themeColor = rgbToHex(bgColor);

            $('[name=theme_color]').val(themeColor);

            $('.templateSec .templateView').css('background-color', themeColor);

        }else{
            $('#button .colorList .colorItem').removeClass('selected');
            $(this).addClass('selected');
            bgColor = $(this).css('background-color');
            buttonColor = rgbToHex(bgColor);

            $('[name=theme_button]').val(buttonColor);
            $('[name=theme_border]').val(darken(buttonColor, 15));

            $('.btnColor').css('background-color', buttonColor);
            $('.btnColor').css('border-color', darken(buttonColor, 15));

            $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('background-color', buttonColor);
            $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('border-color', darken(buttonColor, 15));
        }
    });
    $(document).on('click','.colorShadeItem', function(){
        if($(this).parents('#color').length){
            $('#color .colorShade .colorShadeItem').removeClass('selected');
            $(this).addClass('selected');
            themeColor = rgbToHex($(this).css('background-color'));

            $('[name=theme_color]').val(themeColor);

            $('.templateSec .templateView').css('background-color', themeColor);
        }else{
            $('#button .colorShade .colorShadeItem').removeClass('selected');
            $(this).addClass('selected');
            buttonColor = rgbToHex($(this).css('background-color'));

            $('[name=theme_button]').val(buttonColor);
            $('[name=theme_border]').val(darken(buttonColor, 15));

            $('.btnColor').css('background-color', buttonColor);
            $('.btnColor').css('border-color', darken(buttonColor, 15));

            $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('background-color', buttonColor);
            $('.templateView.bg-bluee.t3 .d-flex .profileContents .textContents ul').css('border-color', darken(buttonColor, 15));
        }
    });
    $(document).on('click','.sideA', function(e){
        e.preventDefault();
        sec = $(this).data('name');
        var x = $('.' + sec);
        if(!x.is(':visible')){
            $('.controls').hide();
            $('.toggleSide').hide();
            $('#' + sec).fadeIn();
        }
    });
    $(document).on('click','.socialItem', function(){
        provider = $(this).data('provider');
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
            $('#'+provider).remove();
        }else{
            $(this).addClass('selected');
            $('#appendSocial').append(`<div class="form-group" id="${provider}">
                <label>${provider} Link:</label>
                <input type="hidden" name="social_provider[]" value="${provider}">
                <input type="text" class="form-control" name="social_url[]" value="">
            </div>`);
        }
    });
    $(document).on('click', '.item-theme', function () {
        $('.item-theme').removeClass('active');
        $(this).addClass('active');
        $(this).find('[name=template]').prop('checked', true);
        $.ajax({
            type: "get",
            url: "{{route('append.template')}}",
            data: {
                id: $('[name=template]:checked').val(),
                url: '{{$user->url}}',
            },
            dataType: "json",
            success: function (response) {
                if(response.result == 'success'){
                    $('.templateView').replaceWith(response.html);
                    $('.templateSec .templateView, .controls').css('min-height', `calc(100vh - ${$('header').outerHeight()}px)`);
                    $('.templateView').addClass('quartWidth');
                    setTimeout(function() {
                        $('#loadingDiv').fadeOut();
                    }, 500);
                }
            },
            beforeSend: function (response) {
                $('#loadingDiv').show();
            }
        });
    });
    @if(isset($user))
    $(document).on('submit', '.nav-form', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "post",
            url: "{{route('profile.savepage', $user->id)}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.result == 'success'){
                    Swal.fire({
                        type: 'success',
                        title: 'Good Job!',
                        text: 'Profile page have been successfully updated.',
                        allowOutsideClick: false,
                    }).then(function (result) {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }else if(response.result == 'nothing'){
                    Swal.fire({
                        type: 'warning',
                        title: 'Nothing has changed!',
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            },
            beforeSend: function (response) {
                $('#loadingDiv').show();
            },
            complete: function (response) {
                $('#loadingDiv').fadeOut('fast');
            },
            error: function (errors) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            },
        });
    });
    @endif()
    // JS Functions //
    const subtractLight = function(color, amount){
        let cc = parseInt(color,16) - amount;
        let c = (cc < 0) ? 0 : (cc);
        c = (c.toString(16).length > 1 ) ? c.toString(16) : `0${c.toString(16)}`;
        return c;
    }
    const darken = (color, amount) => {
        color = (color.indexOf("#") >= 0) ? color.substring(1, color.length) : color;
        amount = parseInt((255 * amount) / 100);
        return color = `#${subtractLight(color.substring(0,2), amount)}${subtractLight(color.substring(2,4), amount)}${subtractLight(color.substring(4,6), amount)}`;
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image-upload-wrap').hide();
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();
                $('.image-title').html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            changeOrRemoveUpload(type);
        }
    }
    function changeOrRemoveUpload(type) {
        if(type == 'remove'){
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }else{
            $('[name=image]').trigger('click');
        }
    }
    function rgbToHex(rgb) {
        var hexDigits = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f"];
        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

        function hex(x) {
            return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
        }
        return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
    // End JS Functinos //
</script>
