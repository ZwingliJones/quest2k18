

(function ($) {
    'use strict';

    jQuery(document).ready(function () {

        
       /* Preloader */
		
        $(window).load(function () {
            $('.preloader').delay(200).fadeOut('slow');
        });
		
		
       
       /* Scroll To Top */
		
        $(window).scroll(function(){
        if ($(this).scrollTop() >= 700) {
            $('.scroll-to-top').fadeIn();
         } else {
            $('.scroll-to-top').fadeOut();
         }
	   });
	
	
        $('.scroll-to-top').click(function(){
          $('html, body').animate({scrollTop : 0},800);
          return false;
         });
		
       
	   
       /* CountDown Timer */	
	   	
        $('.countdown').downCount({
            date: '02/10/2018',   // Change the launch date from here
            offset: +5.5
          }, function () {
             alert('Countdown Done, We are just going to launch our Quest 2k18! on Feb 10 2018');
        });
		       
    });

   })(jQuery);