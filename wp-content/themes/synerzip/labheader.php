<?php
global $post, $posts, $user_ID;

if(is_search())
 {
   $title='search result';
 } else{
   $title = strtolower($post->post_title);
 }
$bodyClass = $title;

$whiteLogoTitles = array('home','our offerings', 'practices', 'technologies', 'our values', 'webinars', 'our team', 'stories', 'hashtag-homepage', 'careers', 'contact us', 'blogs','thank you','awards','news','event','insights','labs');
$whiteLogoTypes = array('posters', 'jobs', 'webinar','team');
if ((in_array($title, $whiteLogoTitles) || in_array($post->post_type, $whiteLogoTypes)) && !is_tax()) {
    $logoColor = 'header-white-logo.png';
} else
    $logoColor = 'header-black-logo.png';
$darknavBarpages = array('disclaimer', 'hashtag','privacy-policy','cookie-policy');
$darknavBarTypes = array('post', 'story','blog','search','news','event','insights');
if (in_array($title, $darknavBarpages) || in_array($post->post_type, $darknavBarTypes) || is_tax() || is_search() ||is_404() || is_page('cookie-policy')) {
    $navColor = 'navbar-dark';
} else
    $navColor = 'navbar-light';
if ($title == "hashtag-homepage")
    $title = "Home";

$siteUrl = site_url();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php //wp_title('&raquo;',true,'right');
if($title=='home'){echo 'Agile Software Product Development Partner - Synerzip';}else{

echo "Synerzip - " . $post->post_title; }?></title>
<!--        /<link href="<?php //bloginfo('template_url');  ?>/beta_css/style.css" type="text/css" rel="stylesheet" />-->
        <link href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" rel="stylesheet" />
        <link href="<?php bloginfo('template_url'); ?>/beta_css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php bloginfo('template_url'); ?>/beta_css/font-awesome.min.css" type="text/css" rel="stylesheet" />

        <script src="<?php bloginfo('template_url'); ?>/beta_js/jquery-2.1.3.min.js" ></script>
        <script src="//platform-api.sharethis.com/js/sharethis.js#property=5b0b86ef461c9500119099f1&product=sticky-share-buttons">    
        </script>

<?php
if ($post->post_title == 'technologies' || post_type_exists('story')) {
    ?>

            <script src="<?php bloginfo('template_url'); ?>/beta_js/jquery.shuffle.min.js"></script>
        <?php } ?>

        <script src="<?php bloginfo('template_url'); ?>/beta_js/bootstrap.min.js" ></script>
        <!--Latest compiled and minified Bootstrap CSS -->
        <!--
 dont include as added physical path
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" lazyload>



        <!-- Latest compiled and minified JavaScript -->
      <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
        <script src="<?php bloginfo('template_url'); ?>/beta_js/main.js"></script>

        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/beta_js/modernizr.custom.79639.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/beta_css/component.css" />
<?php
if (is_tax()) {
    ?>
            <script src="<?php bloginfo('template_url'); ?>/beta_js/modernizr.custom.js"></script>
        <?php } ?>
        <!--- below script needed only for values page-->
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/beta_js/jquery.pfold.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/beta_css/pfold.css" />
   <script>

            jQuery(document).ready(function () {
                jQuery('.menuBox').click(function () {
                    if (jQuery('#menuInnner').is(":hidden")) {
                        jQuery('#menuInnner').slideDown("fast");
                    } else {
                        jQuery('#menuInnner').slideUp("fast");
                    }
                    return false;
                });
<?php if ($post->post_title == 'technologies') { ?>
                    var $grid = $('#techgrid');

                    $grid.shuffle('shuffle', Number(423));

                    $grid.shuffle({
                        itemSelector: '.item' // the selector for the items in the grid
                    });


                    $('.techmenu').click(function (e) {

                        e.preventDefault();

                        // set active class
                        $('.techmenu').removeClass('active');
                        $(this).addClass('active');

                        // get group name from clicked item
                        var groupName = $(this).attr('data-group');

                        // reshuffle grid
                        $grid.shuffle('shuffle', Number(groupName));
                    });
<?php } ?>
<?php if (post_type_exists('story')) { ?>
                    var $storygrid = $('#storygrid');
                    $('#storygrid').shuffle({
                        group: 444,
                        speed: 1000,
                        easing: 'ease-out'
                    });
                    $("ul.success-stories-sort").find("[data-group=444]").parent('li').addClass('active');
$('li').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');
      


});

                    $('.storymenu').click(function (e) {

                        e.preventDefault();

                        // set active class
                        $('.storymenu').removeClass('active');
                        $(this).addClass('active');

                        // get group name from clicked item
                        var groupName1 = $(this).attr('data-group');

                        // reshuffle grid
                        $storygrid.shuffle('shuffle', Number(groupName1));
                        $(".success-stories-sort li").first().css("text-decoration", "none");
                    });

<?php } ?>
            });

            $(function () {

                // say we want to have only one item opened at one moment
                var opened = false;

                $('#grid > div.uc-container1').each(function (i) {

                    var $item = $(this), direction;

                    switch (i) {
                        case 0 :
                            direction = ['right', 'bottom'];
                            break;
                        case 1 :
                            direction = ['right', 'bottom'];
                            break;
                        case 2 :
                            direction = ['left', 'bottom'];
                            break;
                        case 3 :
                            direction = ['right', 'bottom'];
                            break;
                        case 4 :
                            direction = ['right', 'bottom'];
                            break;
                        case 5 :
                            direction = ['left', 'bottom'];
                            break;
                        case 6 :
                            direction = ['right', 'bottom'];
                            break;
                        case 7 :
                            direction = ['right', 'bottom'];
                            break;
                        case 8 :
                            direction = ['left', 'bottom'];
                            break;
                        case 9 :
                            direction = ['right', 'bottom'];
                            break;
                        case 10 :
                            direction = ['right', 'bottom'];
                            break;
                    }

                    var pfold = $item.pfold({
                        folddirection: direction,
                        speed: 300,
                        onEndFolding: function () {
                            opened = false;
                        },
                    });

                    $item.find('.uc-initial-content').on('click', function () {

                        /*if(opened) {
                         //console.log($('.uc-current').find('.uc-initial-content'));
                         var $test = $('.uc-current');
                         $test.pfold().fold();
                         pfold.unfold();
                         }*/

                        if (!opened) {
                            opened = true;
                            pfold.unfold();
                        }
                    }).end().find('span.icon-cancel').on('click', function () {

                        pfold.fold();

                    });

                });

            });
        </script>
<?php wp_head(); ?>


<style>
  .navigation-bar {
  background-color: GhostWhite;
  border: 1px solid Gainsboro;
  left: 0;
  right: 0;
  top: 0;
  z-index: 1000;
}
  .navigation-bar.is-hidden {
  opacity: 0;
  -webkit-transform: translate(0, -60px);
  -webkit-transition: -webkit-transform .2s,background .3s,color .3s,opacity 0 .3s;
}
.navigation-bar.is-visible {
  opacity: 1;
  -webkit-transform: translate(0, 0);
  -webkit-transition: -webkit-transform .2s,background .3s,color .3s;
  background:rgba(0,0,0,0.7)
}
</style>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-5881809-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag()

{dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-5881809-1');
</script>

    </head>
<?php
if (is_tax()) {
    $title = "hashtag";
    $bodyClass = "hashtag";
} elseif ($post->post_type == "job") {
    $location = get_the_terms($post->ID, 'location');

    $locationName = $location[0]->name;
    $years_of_experience = get_field('years_of_experience', $post->ID);
    $bodyClass = "career-single";
    $banner_image = get_bloginfo('template_url') . "/beta_images/careers banner.png";
    $logoColor = 'header-white-logo.png';
} elseif ($title == "our offerings") {
    $bodyClass = "our-offerings";
} elseif ($title == "practices") {
    $bodyClass = "best-practices";
} elseif ($title == "success stories") {
    $bodyClass = "success-stories";
} elseif ($title == "contact us") {
    $bodyClass = "contact-us";
} elseif ($title == "our team") {
    $bodyClass = "our-team";
}
elseif ($post->post_type == "posters") {
    $bodyClass = get_post_meta($post->ID, 'background_gradient', true);
} elseif (is_page('hashtag-homepage')) {
/* temporary commented to have different poster on every refresh
   $post = get_field('hashtagged_home_page', 'option');
    $bodyClass = get_post_meta($post->ID, 'background_gradient', true);
    $title = $post->post_title;
*/
//remove below code after demo
$Allpost= get_field('hashtagged_home_page', 'option');
    $currentpost=array_rand($Allpost,1);
    $post=$Allpost[$currentpost];
    $bodyClass= get_post_meta($post->ID,'background_gradient',true);
    $title=$post->post_title;

} elseif ($post->post_type == 'blog') {
    $bodyClass = 'blog';
 $logoColor = 'header-black-logo.png';
}
elseif(is_search()){
    $bodyClass = 'blog';
 $logoColor = 'header-black-logo.png';
}
elseif ($post->post_type == 'webinar') {
   $bodyClass = 'past-webinar';

}
?>



 <body class="<?php echo $bodyClass; ?>">

        <div id="more-menu" class="overlay">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header ">
                        <a href="<?php echo $siteUrl;?>/"><img src="<?php bloginfo('template_url'); ?>/beta_images/header-white-logo.png" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right actions">
                        <li><a href="#" class="search"><i class="fa fa-search" aria-hidden="true"></i></a></li>

                        <li><a href="#" class="close-nav"><i class="fa fa-times" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </nav>
            <div class="overlay-content">
                <div class="container">
                    <ul class="setbar navigation-links">
                        <li id="offerings" class="offerings"><a href="<?php echo $siteUrl;?>/offering" title="Our Offerings">Our Offerings</a></li>
                        <li id="technologies" class="technologies"><a href="<?php echo $siteUrl;?>/technology" title="Technologies">Technologies</a></li>
                        <li id="values" class="values"><a href="<?php echo $siteUrl;?>/values" title="Our Values">Our Values</a></li>
                        <li id="webinars" class="webinars"><a href="<?php echo $siteUrl;?>/webinars" title="Webinars">Webinars</a></li>
                        <li id="practices" class="practices"><a href="<?php echo $siteUrl;?>/practices" title="Practices">Practices</a></li>
                    </ul>
                    <ul class="navigation-links">
                        <li class="team-pg"><a href="<?php echo $siteUrl;?>/team" title="Our Team">Our Team</a></li>
                        <li class="career-pg"><a href="<?php echo $siteUrl;?>/career" title="Career">Careers</a></li>
                        <li class="stories"><a href="<?php echo $siteUrl;?>/success-stories" title="Success Stories">Success Stories</a></li>
                        <li class="blog-pg"><a href="<?php echo $siteUrl;?>/blogs" title="Blog">Blogs</a></li>
                        <li class="contact-pg"><a href="<?php echo $siteUrl;?>/contact" title="Contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="search-panel" class="overlay">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?php echo $siteUrl;?>/"><img src="<?php bloginfo('template_url'); ?>/beta_images/header-black-logo.png" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right actions">
                        <li><a href="#" class="close-search-panel"><i class="fa fa-times" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </nav>
            <div class="search-content">
                <div class="container">
                    <div class="input-group input-group-lg">
                        <form role="search" method="get" id="site_search" action="/">
                            <div class="input-group input-group-lg">
                                <input name="s" id="s" class="form-control" aria-describedby="search" type="text">
                                <span class="input-group-addon" id="search"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="f-fix header-wrapper ">
            <nav class="navbar navbar-default navigation-bar <?php echo $navColor; ?>" data-nav-status="toggle">
                <div class="container">
                    <nav>
                      
                    </nav>
                    <div class="navbar-header" >
                      <a href="<?php echo $siteUrl;?>/" class="navbar-brand"><img src="<?php bloginfo('template_url'); ?>/beta_images/<?php echo $logoColor; ?>" title="Synerzip" alt="Synerzip" width="190" /></a>
                    </div>


                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="setbar nav navbar-nav navbar-right">
                           <li class="show-on-mobile" >
                                <form class="navbar-form navbar-left "  style="border-color:transparent;" action="/"  role="search" method="get" id="site_search" >
                                <div class="input-group search-content" style="margin-left: 11%;">
                                    <input name="s" id="s" type="text" class="form-control" placeholder="Search" >
                                        <div class="input-group-btn">
                                            <button class="btn btn-default-search " type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                 </div>
                            </form>
                            </li>
					
                        </ul>
                    </div>
                </div>
            </nav>
        </section>

        <!--header section end-->

        <!--banner section start-->
<?php

if (has_post_thumbnail() && !is_tax() &&  !is_search() && ($post->post_type != 'post' && $post->post_type != 'blog' && $post->post_type != 'news' && $post->post_type != 'story') || isset($banner_image)) {

    if (isset($banner_image))
        $large_image_url[0] = $banner_image;
     else
        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
     if($post->post_type == 'webinar'){
        $large_image_url[0] = "/wp-content/uploads/2018/01/Webinar-Home-Page-Hero-Image1-600x338.jpg";
     }
	if($post->post_type == 'team'){
	   $large_image_url[0] = "/wp-content/uploads/2018/04/Our-Team-Banner-5.jpg";
	}
    
    if (isset($large_image_url) && !empty($large_image_url)) {
        ?>
                <section class="banner-wrapper" id="banner-wrapper">

                    <script>
                        (function () {
                            var get_the_box = document.getElementById('banner-wrapper');
                            var some_fancy_gradient = 'linear-gradient(#333 0%, #555 0%)';
                            var some_fancy_image = '<?php echo $large_image_url[0]; ?>';

                            get_the_box.style.background = 'url(' + some_fancy_image + ') center center / cover no-repeat,' + some_fancy_gradient + ' no-repeat';
                        })();
                    </script>
                    <div class="container v-align">

        <?php if ($post->post_type == "job") {
            ?>
                            <div class="banner-text text-center">
                                <p>Careers</p><span> <?php echo $locationName; ?></span>
                                <h2 class="num-results"><?php echo $post->post_title; ?></h2>
                                <h4><?php echo $years_of_experience; ?> years of experience</h4></div>
                    <?php
                } elseif ($post->post_type == 'webinar') {
                    $upcomingpost = $post;
                    $post_meta = get_post_meta($upcomingpost->ID);
                    $webinarTitle = $upcomingpost->post_title;
                    $date = new DateTime($post_meta['date'][0]);
                    $time = $post_meta['time'][0];
                    if (isset($time) && $time != '')
                        $formatDate = $date->format('M d') . '/' . $time;
                    else
                        $formatDate = $date->format('D d');
                    ?>
                            <div class="banner-text text-center">
                                <p>Webinar/Events</p>
                                <h2 class="num-results"><?php echo $webinarTitle; ?></h2>
                                <h4><?php echo $formatDate; ?></h4></div>
            <?php
        }
        elseif (is_page('hashtag-homepage')) {
            $bannertitle=ucwords($post->post_title);
            ?>
                            <div class="banner-text"> <p class="typing"><noscript><?php echo $bannertitle; ?></noscript></p></div>
            <?php
        }

        else {
             $bannertitle=ucwords($post->post_title);
            ?>
                                  
            <div class="banner-text text-center">  <input type="search" id="container-search" value="" class="form-control"  placeholder="Search..."  style=" height: 50px;width: 40%;font-size: 15px;margin-left: 30%"></div>
                        </div>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                </section>
                    <?php
                    }
                }
                ?>

<?php
if (is_page('life-at-synerzip'))
 header('Location: ' . site_url() . '/careers/');
?>

<style>
@media screen and (max-width: 600px) {
.show-on-mobile1
{
 padding-left:15px;

}
.dropdown:hover .dropdown-menu {
    display: none;
}


#custom-search-input {
        margin:0;
        margin-top: 10px;
        padding: 0;
    }
 
    #custom-search-input .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    #custom-search-input button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color:#D9230F;
    }
 
    .search-query:focus + button {
        z-index: 3;   
    }
}

</style>
<script>
    var windowWidth = $(window).width();

    if(windowWidth < 640) {
        $('.navbar-toggle').on('click', function(){
            $('.navbar-header ').css({
             'background-color':'transparent'
            });

            $('#bs-example-navbar-collapse-1').css({
              'overflow': 'scroll'
            });
        });


            $(window).scroll(function(event){
            var mobileScroll = $(this).scrollTop();
            if(mobileScroll > 0){
                $('.header-wrapper').css({
                 'position': 'fixed',
                 'height':'8%',
                 'background': 'rgba(0,0,0,0.7)'
                });
            } else if(mobileScroll == 0) {
                $('.header-wrapper').css({
                  'background': 'transparent'
                });
            }
        });
    }
</script>
<script>
  $(document).ready(function(){
  $("#field_12_7").hide();
$('#label_12_4_2').click(function() {
    $('#field_12_7').toggle();
});
});
</script>

<script>
$(function() {
$('#label_12_4_1').click(function() {
    $('#field_12_7').hide();
});
});
</script>
<script>
$(function() {
$('#label_12_4_3').click(function() {
    $('#field_12_7').hide();
});
});
</script>

        <!--banner section end-->
