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
 <div class="col-xs-12  col-sm-3 col-md-3">
       <h4 style="margin-left: 16px;"><span>Contact</span> Us</h4>
        <?php echo do_shortcode( '[contact-form-7 id="32277" title="Contact Us"]' ); ?>
   </div>
   <div class="col-xs-12  col-sm-3 col-md-3">
        <!-- <h4><span class="add">TEXAS</span></h4> -->
        <p class="add">4100 Spring Valley Road<br>
                       Suite 308<br>
                       Dallas, TX&nbsp; 75244</p>
             <p class="add">Tel: +1.469.374.0500<br>
              Fax: +1.469.322.0490</p>
   </div>
   <div class="col-xs-12  col-sm-3 col-md-3">
       
        <div class="socialicon">
            <p>
                <a href="https://www.linkedin.com/company/synerzip"><img class="alignnone size-full wp-image-27108" src="https://www.synerzip.com/wp-content/uploads/2016/11/SoMe-LinkedIn.png" alt="some-linkedin" width="57" height="57"></a><a href="https://twitter.com/Synerzip"><img class="alignnone size-full wp-image-27109" src="https://www.synerzip.com/wp-content/uploads/2016/11/SoMe-Twitter.png" alt="some-twitter" width="58" height="57"></a><a href="https://www.youtube.com/user/SynerzipWebiChannel/"><img class="alignnone size-full wp-image-27110" src="https://www.synerzip.com/wp-content/uploads/2016/11/SoMe-YouTube.png" alt="some-youtube" width="58" height="57"></a><a href="https://www.facebook.com/Synerzip/"><img class="alignnone size-full wp-image-27107" src="https://www.synerzip.com/wp-content/uploads/2016/11/SoMe-Facebook.png" alt="some-facebook" width="57" height="57"></a></p>

        </div>
    
   </div>
   <div class="col-xs-12  col-sm-3 col-md-3">
        <div class="logo-block">
            <h4><span>About</span> Us</h4>
            <p class="footer-desc">There’s a reason clients chose Synerzip. Not only do we help them scale their engineering capacity and accelerate their roadmap, we become their long-term partner and trusted advisor. We can rapidly scale your engineering team, decrease time to market and save at least 50 percent with on Agile software product development teams in India.</p>
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
.add
{
   margin: 47px 0px 0px 25px;
   padding: 0;
   font-size: 1em;
   line-height: 1.6em;
}


.wpcf7 input[type=text],
.wpcf7 input[type=email],
.wpcf7 input[type=tel],
.wpcf7 textarea {
 background-color: white;
 border: none;
 width: 100% !important;
 -moz-border-radius: 0 !important;
 -webkit-border-radius: 0 !important;
 border-radius: 4px !important;
 font-size: 14px;
 color: #736F6F !important;
 padding: 8px !important;
 margin-top: 5px;
 -moz-box-sizing: border-box;
 -webkit-box-sizing: border-box;
 box-sizing: border-box;
}
.wpcf7-form-control-wrap  textarea {
  height:70px;       
}

.wpcf7-submit {
    background-color: #FED427;
    border: 0;
    border-radius: 0 !important;
    color: #4A4A4A;
    font-size: 14px;
    line-height: 26px;
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    padding: 7px 27px;
    margin-left: 84px;
    margin-top:6px;
}
.wpcf7-submit:hover {
    background-color: #FED427  !important;
    color: black !important;
    -moz-transition: all 0.2s;
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
}
/* ------------   form GROUPING ------------  */
.group:before,
.group:after { content:""; display:table; }
.group:after { clear:both;}
.group { zoom:1; /* For IE 6/7 */ }
/*  GRID OF TWO  */
.span_2_of_2 {
    width: 100%;
}
.span_1_of_2 {
    width: 49.2%;
}
.span_1_of_3 {
    width: 23.8%;
}
/* ------------ form SECTIONS ------------  */
.section {
    clear: both;
    padding: 0px;
    margin: 0% 0;
}

/* ------------  form COLUMN SETUP ------------  */
.col {
    display: block;
    float:left;
    margin: 0.5% 0 0.5% 1.6%;
}
.col:first-child { margin-left: 0; }
.socialicon {
    margin: 72px 0px 0px -75px;
}
.socialicon a {
    margin: 11px;
} 

.wpcf7-form-control-wrap{
  
  margin-left: 15px;
}


/* ------------ form GO FULL WIDTH AT LESS THAN 480 PIXELS ------------  */

@media only screen and (max-width: 480px) {
    .col { 
        margin: 1% 0 1% 0%;
    }
    .socialicon {
        margin: 72px 0px 0px 0px;
    }
    .wpcf7-form-control-wrap{
       margin-left: 0px;
      
    }
    .socialicon a {
      margin: 8px;
    }
}

@media only screen and (max-width: 480px) {
    .span_2_of_2, .span_1_of_2 { width: 100%; }

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

