//jQuery to collapse the navbar on scroll
// $(window).scroll(function() {
//     if ($("#nav").offset().top > 150) {
//         // $("#nav").addClass("top-nav-collapse");
//         $('#nav').affix({offset: {top: 150} }); 
//     } else {
//         $("#nav").removeClass("top-nav-collapse");
//     }
// });

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            if ($($anchor).offset().top < 200) {
                $('html, body').stop().animate({                
                    scrollTop: $($anchor.attr('href')).offset().top-275
                }, 1500, 'easeInOutExpo');
            }else{
                $('html, body').stop().animate({                
                    scrollTop: $($anchor.attr('href')).offset().top-55
                }, 1500, 'easeInOutExpo');
            }                
            event.preventDefault();
        });
   
    
});
;