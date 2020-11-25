$('#footer').css('margin-top',$(document).height() - ($('#header').height() + $('#content').height()  ) - $('#footer').height());


$('#back-to-top').on('click', function (e) {
    e.preventDefault();
    $('html,body').animate({
        scrollTop: 0
    }, 700);
});

$(window).on("load",function() {
    $(".se-pre-con").fadeOut("slow");
    $('.contact-page').css('paddingTop', $('header').outerHeight());
});

$(window).resize(function(){
    $('.contact-page').css('paddingTop', $('header').outerHeight());
});

$(window).scroll(function(){
	if ($(window).scrollTop() >= 250) {
        if(!$('header').hasClass('header-iframe')){
            $('.navigation').addClass('fixed-header');
        }
	}
	else {
        if(!$('header').hasClass('header-iframe')){
            $('.navigation').removeClass('fixed-header');
        }
	}
});

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    var owl = $('.owl-profile-theme');
    owl.owlCarousel({
        margin: 28,
        nav: true,
        autoplay:false,
        loop: false,
        navText : ["<img src='frontend/img/arrow-left.png'>","<img src='frontend/img/arrow-right.png'>"],
        responsive: {
            0: {
                items: 1,
                // loop: owl.find('.item').length > 1 ? true:false,
            },
            767: {
                items: 2,
                // loop: owl.find('.item').length > 2 ? true:false,
            },
            992: {
                items: 3,
                // loop: owl.find('.item').length > 3 ? true:false,
            }
        },
    });

    $('.DataTableID').DataTable();
})

$(function() {
  	$(".navbar-toggler").click(function() {
    	x=$('#navbarCollapse');
        if(x.is(':visible')){
            $("header").removeClass("headerWhite");
        } else {
            $("header").addClass("headerWhite");
        }
    });

    $('.btn-create-page').click(function(e) {
        e.preventDefault();
        $(".firstPage").css('display','none');
        $(".secondPage").css('display','block');
    });

    $('.saveNext').click(function(e) {
        e.preventDefault();
        $input1 = $('.secondPage [name="templateName"]').val();
        $input2 = $('.secondPage [name="templateTag"]').val();
        $input3 = $('.secondPage [name="fullName"]').val();
        if($input1!='' && $input2!='' && $input3!=''){
            $(".secondPage").css('display','none');
            $(".thirdPage").css('display','block');
        }else{
            Swal.fire({
                type: 'error',
                title: 'Some fields are blank',
                text: 'Please fill up all the blank fields.',
            }).then(function (result) {
                if (result.value) {
                }
            });
        }
    });

    $(".next-1").click(function(e) {
        e.preventDefault();
        $(".pb-item").removeClass("active");
        $(".pb-item-1").addClass("done");
        $(".pb-item-2").addClass("active");
        $("#step-1").css('display','none');
        $("#step-2").css('display','block');
    });

    $(".next-2").click(function(e) {
        e.preventDefault();
        $(".pb-item").removeClass("active");
        $(".pb-item-2").addClass("done");
        $(".pb-item-3").addClass("active");
        $("#step-2").css('display','none');
        $("#step-3").css('display','block');
    });

    $(".next-3").click(function(e) {
        e.preventDefault();
        $(".pb-item").removeClass("active");
        $(".pb-item-3").addClass("done");
        $(".pb-item-4").addClass("active");
        $("#step-3").css('display','none');
        $("#step-4").css('display','block');
    });

    $(".next-4").click(function(e) {
        e.preventDefault();
        $(".pb-item").removeClass("active");
        $(".pb-item-4").addClass("done");
        $(".pb-item-5").addClass("active");
        $("#step-4").css('display','none');
        $("#step-5").css('display','block');
    });

    $(".prev-1").click(function(e) {
        e.preventDefault();
        $(".pb-item-1").addClass("active");
        $(".pb-item-1").removeClass("done");
        $(".pb-item-2").removeClass("active");
        $("#step-1").css('display','block');
        $("#step-2").css('display','none');
    });

    $(".prev-2").click(function(e) {
        e.preventDefault();
        $(".pb-item-2").addClass("active");
        $(".pb-item-2").removeClass("done");
        $(".pb-item-3").removeClass("active");
        $("#step-2").css('display','block');
        $("#step-3").css('display','none');
    });

    $(".prev-3").click(function(e) {
        e.preventDefault();
        $(".pb-item-3").addClass("active");
        $(".pb-item-3").removeClass("done");
        $(".pb-item-4").removeClass("active");
        $("#step-3").css('display','block');
        $("#step-4").css('display','none');
    });

    $(".prev-4").click(function(e) {
        e.preventDefault();
        $(".pb-item-4").addClass("active");
        $(".pb-item-4").removeClass("done");
        $(".pb-item-5").removeClass("active");
        $("#step-4").css('display','block');
        $("#step-5").css('display','none');
    });

    $(".btn-upload-photo, .profile").click(function(e) {
        e.preventDefault();
        $(".image-upload").click();
    });
});
