jQuery(document).ready(function ($) {


    if ($('.custom-nav-search').length) {
        $('.custom-nav-search .elementor-search-form__container').append('<span class="nav-search-toggler"></span>');

        $('.nav-search-toggler').click(function () {
            $('.custom-nav-search .elementor-search-form').addClass('active');
            $('.custom-nav-search .elementor-search-form__container input').focus();
        });

        $('.custom-nav-search .elementor-search-form__container input').focusout(function () {
            setTimeout(function () {
                $('.custom-nav-search .elementor-search-form').removeClass('active');
            }, 150);
        });
    }

    if ($('.shows-slider').length) {
        $('.shows-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
            arrows: true,
            centerMode: true,
            centerPadding: '15%',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        centerPadding: '0%'
                    }
                }
            ]
        });
    }

    if ($('.custom-post-mob-slider').length) {
        $('.custom-post-mob-slider .ecs-posts').slick({
            mobileFirst: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: "unslick",
                }
            ]
        });
    }

    // $('.custom-post-mob-slider-three-col .ecs-load-more-button').clone().appendTo('.custom-post-mob-slider-three-col .ecs-posts');

    if ($('.custom-post-mob-slider-three-col').length && (window.matchMedia('(max-width: 767px)').matches)) {

        $('.custom-post-mob-slider-three-col .ecs-posts').slick({
            mobileFirst: true,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: "unslick",
                }
            ]
        });


        // $('.custom-post-mob-slider-three-col .ecs-posts .ecs-load-more-button a').click(function () {
        //     var page_link = $(this).attr("href");
        //     function getSliderSettings() {
        //         return {
        //             mobileFirst: true,
        //             infinite: false,
        //             slidesToShow: 3,
        //             slidesToScroll: 1,
        //             arrows: false,
        //             dots: true,
        //         }
        //     }
        //     $(".custom-post-mob-slider-three-col .ecs-posts").load(page_link, function () {
        //         var postItems = $('.custom-post-mob-slider-three-col .ecs-posts > article');
        //         postItems.clone().appendTo('.custom-post-mob-slider-three-col .ecs-posts .slick-track');

        //         $('.custom-post-mob-slider-three-col .ecs-posts').slick('unslick');
        //         $('.custom-post-mob-slider-three-col .ecs-posts').slick(getSliderSettings());

        //     });
        // });

    }



    $('.custom-join-btn a').click(function (e) {
        e.preventDefault();
        $('#wpd-bubble').click();
    });



    //redirect external link  article in new tab
    $(document).on('click', ".dthree-loop-container a", function (e) {

        selector = $(this).closest(".dthree-loop-container").html();
        is_external =  $(selector).find(".dthree-external-link").length;
        external_link = $(selector).find(".dthree-external-link").attr("url");

        if(is_external) {
            e.preventDefault();
            window.open(external_link);
        } else {
            return;
        }
    });


    $(document).on('click', ".dthree-custom-play", function (e) {
        e.preventDefault();

        iframe_src = $(this).attr("data-iframe-src");
        iframe = '<iframe src="'+ iframe_src +'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $("#video-cntr").html(iframe);

    });





    // window.onload = function() {

    //     var target = document.getElementsByTagName('a'); 

    //     var tooltipp = document.getElementById("tooltip-txt");
        
    //     target.addEventListener('mouseover', () => {
    //         tooltipp.style.display = 'block';
    //         tooltip.innerHTML = target.innerHTML;
    //         console.log(this.innerHTML);
    //     }, false);
    
    //     target.addEventListener('mouseleave', () => {
    //         tooltipp.style.display = 'none';
    //     }, false);

    // } 
    


    // var tooltips = document.getElementById("tooltip-txt");
        
    // $("a").on('mouseover', "#tooltip-txt", () => {
    //     console.log(this.innerHTML);

    //     tooltips.innerHTML = this.innerHTML;
    //     tooltips.style.display = 'block';

    //     console.log(tooltips);
    // });

    // $("a").on('mouseleave', () => {
    //     tooltips.innerHTML = "";
    //     tooltips.style.display = 'none';
    // });

    

    // conta = document.createElement('div');
    // conta.setAttribute("id", "tooltip-cont");
    
    // par = document.createElement('p');
    // par.setAttribute("id", "tooltip-txt");

    // $(document).on('mouseover', ".dthree-loop-container a", function (e) {

    //     console.log(this.attr("id"));

    //     // this.innerHTML += "<div id='tooltip-cont'><p id='tooltip-txt'>" + this.innerHTML + "</p></div>";

    //     // (this.attr("id")).tooltip({
    //     //     content: this.innerHTML,
    //     //     track:true
    //     //  });

    //     // par.style.display = 'block';
        
    // });



    // $(document).on('mouseover', function(){
    //     jQuery('#thisId').jQueryUITooltip({
    //         content: this.innerHTML,
    //         track: true
    //     });
    // });


    
    $(document).ready(function(){

        $('a').hover(function(e){ //Mouse Over Event
            
            var titleText = this.textContent;
            // var titleText = $(this).attr('title');

            $(this).data('tiptext', titleText).removeAttr('title');

            $('<p class="tooltip"></p>').text(titleText).appendTo('body').css('top', (e.pageY - 30) + 'px').css('left', (e.pageX + 1) + 'px').fadeIn('slow');
            
        }, function(){ //Mouse Leave Event

            $(this).attr('title', $(this).data('tiptext'));
            $('.tooltip').remove();

        }).mousemove(function(e){ //Mouse Movement

            $('.tooltip').css('top', (e.pageY - 30) + 'px').css('left', (e.pageX + 1) + 'px');

        });

    });


});



