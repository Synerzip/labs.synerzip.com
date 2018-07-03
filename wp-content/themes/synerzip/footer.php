<!--footer section start-->
<?php
wp_enqueue_script( 'script', get_template_directory_uri() . '/js/clamp.min.js', array ( 'jquery' ), 1.1, true);
?>
<script src="<?php bloginfo('template_url'); ?>/beta_js/masonry.pkgd.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/beta_js/imagesloaded.js"></script>
<script src="<?php bloginfo('template_url'); ?>/beta_js/classie.js"></script>
<script src="<?php bloginfo('template_url'); ?>/beta_js/AnimOnScroll.js"></script>
<script>
    function animateOnScroll(){
        if (document.getElementById('grid'))
        {
            new AnimOnScroll(document.getElementById('grid'), {
                minDuration: 0.4,
                maxDuration: 0.7,
                viewportFactor: 0.2
            });
            initBlogClamJS();
        }
    }
    //Blog lisitng of blogs page
    function initBlogClamJS(){
        $(".blogs ul#grid .grid-item.card .card-title").each(function(i,elem){
            $clamp(elem, {clamp: 2});
        });
        $(".blogs ul#grid .grid-item.card .card-content").each(function(i,elem){
            $clamp(elem, {clamp: 4});
        });
    }
    jQuery(document).ready(function(){
        animateOnScroll();
    })
</script>
<section class="f-fix footer-wrapper base-theme" id="footer-wrapper">




        <div class="row push-down-6">
           <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="col-xs-12 col-md-8 col-sm-12 col-md-push-2"> 
                <div class="links-block">
                   
                </div>
                </div> 
            </div>
                  <div class="col-xs-12  col-sm-3 col-md-3">
        <div class="logo-block">
                    <h4><span>About</span> Us</h4>
                    
                    <p class="footer-desc">There’s a reason clients chose Synerzip. Not only do we help them scale their engineering capacity and accelerate their roadmap, we become their long-term partner and trusted advisor. We can rapidly scale your engineering team, decrease time to market and save at least 50 percent with on Agile software product development teams in India.</p>
                </div>
            </div>
        </div>
    </div>

 <div class="container-fluid">
    <div class="row push-down-2">
        <div class="container">
            <div class="row">
                <div class="copyright">
                    <div class="col-md-8">
                        <div class="col-xs-12 col-md-8 col-md-push-2">
                          <div class=" text-center">
                              <div class="social-media">
                              
                              <ul>
            <li><a href="https://www.linkedin.com/company/synerzip"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                
                        <li><a href="https://twitter.com/Synerzip"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="https://www.youtube.com/user/SynerzipWebiChannel/"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
    <li><a href="https://www.facebook.com/Synerzip/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="col-sm-12">
                          <p>© 2018 Synerzip, LLC. All Rights Reserved.  //  <a href="/privacy-policy">Privacy Policy</a>  //  <a href="/disclaimer">Disclaimer</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>           
  </div>
<style>
.back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
    margin: 0 10px 80px 0;
}

.go-to-top-btn{
    background:#fed42638;
    border:1px solid #fed42638;
    border-radius:50%;
    color:#303030;
    padding: 7px 0;
    height: 40px;
    width: 40px;
}
.go-to-top-btn:hover{
    background:#fed426f2;
    border:1px solid #fed426f2;
    border-radius:50%;
    color:#303030;
    padding: 7px 0;
    height: 40px;
    width: 40px;
}

#back-to-left1
{
  cursor: pointer;
    position: fixed;
    bottom: 20px;
    background: #efede591;
    border: 1px solid #e4e2d638;
    border-radius: 51%;
    color: #303030ba;
    padding-left: 20px;
    padding-top: 3px;
    font-size: 30px;
    height: 50px;
    left:-16px;
    width: 50px;
  
   
}
</style>
</section>
<!--footer section end-->
<a id="back-to-top" href="#" class="btn go-to-top-btn btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="fa fa-chevron-up"></span></a>

<?php if(is_page('home')): ?>

<a id="back-to-left1"   class="show-on-mobile1" role="button" ><span class="fa fa-angle-double-right"></span></a>

<?php endif; ?>




<script>
$(window).scroll(function () {
            if ($(this).scrollTop() > 150) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });


        $('#back-to-top').tooltip('show');
     

// career page click on current opening

 /*$('.more-webinar-list tr:not(:last-child), .india-career tr, .us-career tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });*/
</script>

<script>


   $(document).ready(function(){
        $(".register-to-webinar1").hide();
        $("#back-to-left1").click(function(){
            $(".register-to-webinar1").animate({
                height: '180px',
                width: 'toggle'
            },function(){
                $('body').toggleClass('activeCarousel')
            });
        });

        $('.webinar-close').click(function() {
            $('.register-to-webinar,.register-to-webinar1').fadeOut(500);
            $('body').removeClass('activeCarousel');
        });

        // Home page carousel
        function clampjsInit(){
            $("#text-carousel .item").addClass('active').css('visiblity', 'hidden');
            $(".clampjs").each(function(i,elem){
                $clamp(elem, {clamp: 2});
            });
            $("#text-carousel .item:not(:first-child)").removeClass('active').css('visiblity', '');
        }
        clampjsInit();

        function setIntroTextNextElemMargin()
        {
            var $firstElem = $('.page-intro-block, .page-intro-block-blogs, .page-intro-block-awards, .page-intro-block-news').first()
            if ($firstElem.length){
                $firstElem.next().css('margin-top', '-' + (($firstElem.outerHeight() / 2) - 40) +'px')
            }
        }
        setIntroTextNextElemMargin();
        $(window).resize(function(){
            setIntroTextNextElemMargin();
        });
    });
</script>
<?php wp_footer(); ?>
</body>
</html>

