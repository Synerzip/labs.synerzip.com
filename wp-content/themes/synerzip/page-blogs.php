<?php
get_header();
?>
<!--header section end-->

<!--blog-banner-section-start-->
<?php
$post_object = get_field('feature_blog', 'option');
$time = estimate_reading_time($post_object[0]->post_content);
$bannerImage = get_the_post_thumbnail_src(get_the_post_thumbnail($post_object[0]),array(500,500));
$posterLink = get_permalink($post_object[0]->ID);
if (!isset($bannerImage) || $bannerImage == '')
    $bannerImage = '../wp-content/themes/synerzip/beta_images/blogpagebanner.png';
$blogdate = $post_object[0]->post_date;
                
$posterTime = date("F j Y", strtotime($blogdate));
$posterTimeAgo = humanTiming(strtotime($post_object[0]->post_date));
?>
<style>
    .grid li{
        opacity: inherit;
    }
    /*.blog-banner-wrapper .main-blog {
        margin-top: -25%;
        position: relative;
    }*/
</style>
<!--blog-banner-section-start-->

<section class="f-fix  blog-banner-wrapper" id="blog-banner-wrapper">
    <div class="container">
	   <div class="page-intro-block-blogs">
<p>Blogs are posts that help spread knowledge that individuals gather through their work or personal experiences. At Synerzip, we celebrate the individuality of our people and respect their opinions. Get some of the latest insights into the beautiful world of software development through the eyes of our authors.</p></div>

		
		<div class="main-blog">
            <div class="banner-image">
                <img src="<?php echo $bannerImage; ?>">
            </div>
            <div class="banner-content">
                <h1 class="event-name"><?php echo $post_object[0]->post_title; ?></h1>
                <p class="event-desc push-down-2"><?php echo $content=wp_trim_words($post_object[0]->post_content, 60); ?></p>
                <div class="event-btn-container push-down-3">
                    <a class="btn event-register-btn" href="<?php echo $posterLink; ?>">Read More</a>
                    <div class="pull-right hidden-sm hidden-xs">
                        <span class="blog-time time-span"><?php echo $posterTimeAgo; ?></span>
                         <span class="blog-time time-read"><?php echo $posterTime; ?></span>
                    </div>          
                </div>
            </div>
		
    </div>

</section>

<!--blog-banner-section-end-->

<!--popular-on-synerzip-section-start-->
<?php
$condition = array();
$condition['post_type'] = 'blog';
$condition['posts_per_page'] = '9';
$passhash = 'showAll';
$posts = fetch_rulequery($passhash, $condition);
$allPosts = $posts->posts;
?>
<section class="f-fix popular-event-wrapper push-down-6" id="popular-event-wrapper">
    <div class="container">
        <ul class="grid effect-2" id="grid">

            <?php
            foreach ($allPosts as $post) {
                //echo "<pre>";print_r($post);exit;
                $post->postLink = get_permalink($post->ID);
                // $post->post_title =  wp_trim_words($post->post_title, 7);

                $post->time = estimate_reading_time($post->post_content);
              $trimmed_content = wp_trim_words($post->post_content, 50);
//$trimmed_content = trim_content(preg_replace("#\[[^\]]+\]#", '', $trimmed_content),150);
                $post->image = get_the_post_thumbnail_src(get_the_post_thumbnail($thePost->ID));
                if (!isset($post->image) || $post->image == '')
                    //$post->image = '../wp-content/themes/synerzip/beta_images/placeholder.png';
					 $post->image = '../wp-content/uploads/2018/01/rsz_1placeholder.png';
                if ($post->ID != $post_object->ID) {
                    ?>
                    <li class="grid-item card">
                        <div class="card-img">
                            <a href="<?php echo $post->postLink; ?>"><img src="<?php echo $post->image; ?>"></a>
                        </div>
                        <div class="card-details">
                            <a href="<?php echo $post->postLink; ?>"><h5 class="card-title"><?php echo $post->post_title; ?></h5></a>
                            <p class="card-content"><?php echo $trimmed_content; ?> </p>
                            <div class="card-action push-down-5">
                                <span><?php 
				$date = new DateTime($post->post_date);echo $date->format('j M Y');
				?></span>
                             <span class="right"><?php echo $post->time; ?></span>    
                            </div>
                        </div>
                    </li>
                <?php
                }
            }
            ?> 
          <li class="to-append"></li>          
       </ul>
       
    </div>    
<div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4"></div>
            <div class="col-md-4 col-sm-4">
                <button class="btn home-page-btn loadmore"> 
                    More blogs<i id= "loading" class="fa fa-refresh fa-spin" style="padding:10px"></i>
                </button>
            </div>
        </div>
   </div>
	<div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/event">Events</a></h4>
					<div class="arrow">
						<a href="/event"><img src="../wp-content/uploads/2017/11/skype.png"></a>
					</div>
			</div>
	   </div>
   </div>
    
   

</section>

<!--popular-on-synerzip-section-end-->
<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var page =1;
    jQuery(function($){
        $('#loading').hide();
        $('body').on('click', '.loadmore', function(){
            var data = {
                'action': 'load_blogs_by_ajax',
                'page': page                
            };
            $('#loading').show();
            $.post(ajaxurl, data, function(response){
                $('.to-append').before(response);
                page++;
                $('#loading').hide();
                animateOnScroll();
                //console.log(response);
            });
        });
    });

</script>


<!--popular-on-synerzip-section-end-->

<!--footer-section-start-->                
<?php
get_footer();
?>
