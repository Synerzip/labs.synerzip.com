$(document).ready(function() {

	/*---video-cover---*/
	$('.video-cover-common').on('click', function(ev){
		
		var thevid=document.getElementById('thevideo'); 
		thevid.style.display='block'; 
		$('.video-cover-common').hide();
		$("#youtube-video")[0].src += "&autoplay=1";
    	ev.preventDefault();
	});


    $('[data-target = more-menu]').click(function() {
        $('.more-menu').css('display','inline-block');
        return false;
    });
	
	typeWrite('typing');

/*----------------------------for header scroll animation effect---------------------------*/	
	var windowWidth = $(window).width();
	if(windowWidth > 767) {
		
		var $header = $(".header-wrapper"),
        $clone = $header.before($header.clone().addClass("clone"));
	    
	    $(window).on("scroll", function() {
	        var fromTop = $(window).scrollTop();
	        $("body").toggleClass("down", (fromTop > 100));
	    });

	/*------------for highlighting active menu in navbar--------------*/

	var selectedolditem = localStorage.getItem('selectedolditem');
	      if (selectedolditem != null) {
	       	$('.setbar .'+selectedolditem).siblings().find("active").removeClass("active");
            	$('.setbar .'+selectedolditem).addClass("active");
	        localStorage.clear();
            }
		
			$('.setbar li').click(function() {
			var id = $(this).attr("id");
			$('.setbar .'+id).siblings().find("active").removeClass("active");
			localStorage.clear();
			localStorage.setItem("selectedolditem", id);
				var selectedolditem = localStorage.getItem('selectedolditem');
			
    });


$(".navbar-collapse .navbar-nav li").each(function() {      if($(this).hasClass('active')){       $(this).children('.active-menu').toggleClass('no-display');      }  });


	}
	if(windowWidth < 640) {
		$('.navbar-toggle').on('click', function(){
			if($('.navbar-toggle').hasClass('collapsed')){
				$('.navbar-light .navbar-header').css('background-color','#555555');
				$('.navbar-dark .navbar-header').css('background-color','#f9f9f9');
			}
		});
	}
		
/*----------------------------for open-close more nav menu---------------------------------*/	

	$('.close-nav').on('click', function(){
		$('#more-menu').css('height','0%');
		$('.header-wrapper').css('z-index','20');
		$('body').css('overflow','auto');
	});
	$('.open-nav').on('click', function(){
		$('#more-menu').css('height','100%');
		$('.header-wrapper').css('z-index','0');
		$('body').css('overflow','hidden');
	});
	$('.close-search-panel').on('click', function(){
		$('#search-panel').css('height','0%');
	});
	$('.search').on('click', function(){
		$('#search-panel').css('height','100%');
		$('body').css('overflow','hidden');
	});


/*----------------------------for career india/us toggle----------------------------------*/	

$(document).on('change', '.country-opening', function() {
  var target = $(this).data('target');
  var show = $("option:selected", this).data('show');
  $('.career-list').find('.table').addClass('hide');
  $(show).removeClass('hide');
});

$('.country-opening').trigger('change');

/*----------------------------for career apply now form show----------------------------------*/

$('.form-container').hide();
$('.form-btn').on('click', function(){
	$('.form-container').slideDown( "slow" );
})

/*----------------------------for counter effect animation------------------------------*/	

	var a = 0;
    $(window).scroll(function() {

        if ($(window).scrollTop() == 0 || $(window).scrollTop() == $(document).height() - $(window).height()) {
            // do something
            $('.counter-value').each(function() {
                var $startPoint = $(this);
                countReset = $startPoint.attr('data-count') * (90 / 100);
                $startPoint.text(0);
            });
        }

        if ($('.counter').length){
	        var oTop = $('.counter').offset().top - window.innerHeight;
	        if (a == 0 && $(window).scrollTop() > oTop) {
	            $('.counter-value').each(function() {
	                var $this = $(this)
	                  , countTo = $this.attr('data-count');
	                $({
	                    countNum: $this.text()
	                }).animate({
	                    countNum: countTo
	                },
	                {

	                    duration: 2000,
	                    easing: 'swing',
	                    step: function() {
	                        $this.text(Math.floor(this.countNum));
	                    },
	                    complete: function() {
	                        $this.text(this.countNum);
	                        //alert('finished');
	                    }
	                });
	            });
	            //	a = 1;
	        }
        }
    });
	
/*----------------------------for slide in animation----------------------------------*/	
	(function($) {
		$.fn.visible = function(partial) {		
			var $t        = $(this),
			$w            = $(window),
			viewTop       = $w.scrollTop(),
			viewBottom    = viewTop + $w.height(),
			_top          = $t.offset().top,
			_bottom       = _top + $t.height(),
			compareTop    = partial === true ? _bottom : _top,
			compareBottom = partial === true ? _top : _bottom;
			
			return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
		};
	})(jQuery);

	var win = $(window);
	var allMods = $(".scroll-frame");

	allMods.each(function(i, el) {
		var el = $(el);
		if (el.visible(true)) {
			el.addClass("already-visible"); 
		} 
	});

	win.scroll(function(event) {
		allMods.each(function(i, el) {
			var el = $(el);
			if (el.visible(true)) {
				el.addClass("come-in"); 
			} 
		});
	});
		
/*----------------------------for background video-------------------------*/
		
function scaleVideoContainer() {

    var height = $(window).height();
    var unitHeight = parseInt(height) + 'px';
    $('.banner-wrapper').css('height',unitHeight);

}

function initBannerVideoSize(element){
    
    $(element).each(function(){
        $(this).data('height', $(this).height());
        $(this).data('width', $(this).width());
    });

    scaleBannerVideoSize(element);

}

function scaleBannerVideoSize(element){

    var windowWidth = $(window).width(),
        windowHeight = $(window).height(),
        videoWidth,
        videoHeight;
    
    console.log(windowHeight);

    $(element).each(function(){
        var videoAspectRatio = $(this).data('height')/$(this).data('width'),
            windowAspectRatio = windowHeight/windowWidth;

        if (videoAspectRatio > windowAspectRatio) {
            videoWidth = windowWidth;
            videoHeight = videoWidth * videoAspectRatio;
            $(this).css({'top' : -(videoHeight - windowHeight) / 2 + 'px', 'margin-left' : 0});
        } else {
            videoHeight = windowHeight;
            videoWidth = videoHeight / videoAspectRatio;
            $(this).css({'margin-top' : 0, 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});
        }

        $(this).width(videoWidth).height(videoHeight);

        $('.banner-wrapper .banner-video video').addClass('fadeIn animated');
        

    });
}

});

/*----------------------------for typing effect-----------------------------------*/

function randomIntFromInterval(min,max)
{
  return Math.floor(Math.random()*(max-min+1)+min);
}

function typeWrite(span){
  var text = $('.'+span).text();
  var randInt = 0
  for (var i = 0; i < text.length; i++) {
    randInt += parseInt(randomIntFromInterval(40,100));
    var typing = setTimeout(function(y){
		$('.'+span).append(text.charAt(y));
    },randInt, i);
  };
}

