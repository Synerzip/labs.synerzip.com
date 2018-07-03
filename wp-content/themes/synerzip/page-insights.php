<?php
get_header();
?>
<!--banner section end-->
<!--webinar section content start-->
<section class="f-fix webinar-page-wrapper grey-bg" id="webinar-page-wrapper">
    <div class="container">
        <?php
        $post = get_field('next_webinar', 'option');
        $post_meta = get_post_meta($post->ID);
        $pardotform = $post_meta['pardot_form'][0];
        $date = $post_meta['date'][0];
        $time = $post_meta['time'][0];
        $total = count($post);
        $total_iterated = 0;
        $block_count = 0;
        $offset_set = FALSE;
         ?>
        <div class="page-intro-block">
            <p>Knowledge is key to keeping ahead. At Synerzip, we share what it learns from our experience working with customers, partners, followers and industry experts. Get a snapshot of what's in-store for you.
            </p>
        </div>
        <div class="row">
            <div class="top-webinar-block">
                <h2 style="padding:0px 0px 0px 18px">Latest Webinars</h2>
                <?php 
                foreach ($post as $topwebinar) {
                    $offset = '';
                    $conditionForNextSection['post__not_in'][] = $topwebinar->ID;
                    if($block_count == 0)
                    {
                        $left = $total - $total_iterated;
                        if($left < 4 && !$offset_set){
                            if($left == 3) $offset = 'col-sm-offset-0';
                            elseif($left == 2) $offset = 'col-sm-offset-2';
                            elseif ($left == 1) $offset = 'col-sm-offset-4';
                            $offset_set = TRUE;
                        }
                    }
                    $image = get_field('feature_images', $topwebinar->ID);
                    $topwebinar->image = get_the_post_thumbnail_src(get_the_post_thumbnail($topwebinar->ID));
                    $topwebinar->url = get_permalink($topwebinar->ID);
					 $today = strtoupper(date('M j, Y'));
					$date = new DateTime(get_post_meta($singleWebinar->ID, 'date', true));
					$webdate = strtoupper($date->format('M j,  Y'));
					if ($webdate <= $today) 
					{
					$text = "View Now";
					} else 
					{
					$text = "Register Now";
					}
                   ?>
                    <div class="col-sm-4 push-down-2 <?php echo $offset ?>">
                        <div class="webinar-list">
                            <img src="<?php echo $topwebinar->image; ?>">
                            <div class="past-webinar-details webinar-heading">
                                <h3><?php echo $topwebinar->post_title; ?></h3>
                                <h5><?php
                                $date = new DateTime(get_post_meta($topwebinar->ID,'date',true)); ?>
                            </h5>
                                <h5> <?php
                                echo $date->format('F j, Y'); ?>   <?php  the_field('time', $topwebinar->ID);?>
                                </h5>
                                <h5>
                                
                               <button class="btn home-page-btn"><a href="<?php echo $topwebinar->url; ?>"><?php echo $text; ?></a>
                            </button>
                            </h5>
                            </div>
                        </div>
                    </div>
                    <?php
                    $block_count++;
                    if($block_count == 4 || $total - $total_iterated == 1)
                    {
                        $block_ = 0;
                    }
                    $total_iterated++;
                }
                ?>
            </div>
        </div>
	<button class="col-sm-offset-4 col-sm-4 btn home-page-btn view-all-blogs-btn" href="/webinars">
            <a href="/webinars">More Webinars</a>
        </button>
        <!--- For Future  Blogs -->
        <?php
        $post2 = get_field('feature_blog', 'option');
        $total = count($post2);
        //print_r($post2);
        $blog1 = $post2[0];
        $title1=$blog1->post_title;
        $clientblog1Writer = get_field('writer', $post2[0]);
        $clientblog1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post2[0], 'large'));
        $blog1date = $post2[0]->post_date;
        $newDate1 = date("F j Y", strtotime($blog1date));
                            
        $blog2 = $post2[1];
        $title2=$blog2->post_title;
        $clientblog2Writer = get_field('writer', $post2[1]);
        $clientblog2Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post2[1], 'large'));
        $blog2date = $post2[1]->post_date;
        $newDate2 = date("F j Y", strtotime($blog2date));
        $total_iterated = 0;
        $block_count = 0;
        $offset_set = FALSE;
        ?>
        <div class="row">
            <div class="top-webinar-block push-down-8">
                <h2 style="padding:18px 0px 0px 18px">Latest Blogs</h2>
                <?php 
                foreach ($post2 as $topblog) 
                {
                    $offset = '';
                    $conditionForNextSection['post__not_in'][] = $topblog->ID;
                    if($block_count == 0){
                        $left = $total - $total_iterated;
                        if($left < 4 && !$offset_set){
                            if($left == 3) $offset = 'col-sm-offset-0';
                            elseif($left == 2) $offset = 'col-sm-offset-2';
                            elseif ($left == 1) $offset = 'col-sm-offset-4';
                            $offset_set = TRUE;
                        }
                    }
                    $image = get_field('feature_images', $topblog->ID);
                    $topblog->image = get_the_post_thumbnail_src(get_the_post_thumbnail($topblog->ID));
                    $topblog->url = get_permalink($topblog->ID);
                    $topblogate = date("F j Y", strtotime($topblog->post_date));
                    ?>
                    <div class="col-sm-4 push-down-2 <?php echo $offset ?>">
                        <div class="webinar-list">
                            <a href="<?php echo $topblog->url ?>">
                                <img src="<?php echo $topblog->image; ?>">
                            </a>
                            <div class="past-webinar-details webinar-heading">
                            <a href="<?php echo $topblog->url ?>">
                                <h3><?php echo $topblog->post_title; ?></h3>
                            </a>
                            <h5> <?php echo $topblogate ?>   <?php  the_field('time', $topblog->ID);?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                    $block_count++;
                    if($block_count == 4 || $total - $total_iterated == 1){
                        $block_ = 0;
                    }
                    $total_iterated++;
                }
                ?>
            </div>
        </div>
	<button class="col-sm-offset-4 col-sm-4 btn home-page-btn view-all-blogs-btn" href="/blogs">
            <a href="/blogs">More Blogs</a>
        </button>
        <?php
        $post2 = get_field('upcoming news', 'option');
        $total = count($post2);
        
        $blog1 = $post2[0];
        $title1=$blog1->post_title;
        $clientblog1Writer = get_field('writer', $post2[0]);
        $clientblog1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post2[0], 'large'));
        $blog1date = $post2[0]->post_date;
        $newDate1 = date("F j Y", strtotime($blog1date));
        $total_iterated = 0;
        $block_count = 0;
        $offset_set = FALSE;
        ?>
        <div class="row">
            <div class="top-webinar-block push-down-8">
                <h2 style="padding:18px 0px 0px 18px">Latest News</h2>
                <?php foreach ($post2 as $topnews) {
                    $offset = '';
                    $conditionForNextSection['post__not_in'][] = $topnews->ID;
                    if($block_count == 0){
                        $left = $total - $total_iterated;
                        if($left < 4 && !$offset_set){
                            if($left == 3) $offset = 'col-sm-offset-0';
                            elseif($left == 2) $offset = 'col-sm-offset-2';
                            elseif ($left == 1) $offset = 'col-sm-offset-4';
                            $offset_set = TRUE;
                        }
                    }
                    
                    $image = get_field('feature_images', $topnews->ID);
                    $topnews->image = get_the_post_thumbnail_src(get_the_post_thumbnail($topnews->ID));
                    $topnews->url = get_permalink($topnews->ID);
                    $topnewsDate = date("F j Y", strtotime($topnews->post_date));
                    ?>
                    <div class="col-sm-4 push-down-2 <?php echo $offset ?>">
                        <div class="webinar-list">
                            <a href="<?php echo $topnews->url ?>">
                                <img src="<?php echo $topnews->image; ?>">
                            </a>
                            <div class="past-webinar-details webinar-heading">
                                <a href="<?php echo $topnews->url ?>">
                                    <h3><?php echo $topnews->post_title; ?></h3>
                                </a>
                                <h5> 
                                    <?php echo $topnewsDate; ?>   <?php  the_field('time', $topnews->ID);?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <?php
                    $block_count++;
                    if($block_count == 4 || $total - $total_iterated == 1){
                        $block_ = 0;
                    }
                        $total_iterated++;
                    }
                ?>
            </div>
        </div>

    <button class="col-sm-offset-4 col-sm-4 btn home-page-btn view-all-blogs-btn" href="/news">
        <a href="/news">More News</a>
    </button>
    </div>
    <div class="container-fluid no-padding">
        <div class="next-page-wrapper">
            <div class="send-enquiry">
                <div class="enquiry-section">
                    <h4><a href="/webinars">Webinars</a></h4>
                    <div class="arrow">
                        <a href="/webinars"><img src="../wp-content/uploads/2017/11/skype.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var page = 2;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_webinars_by_ajax',
            'page': page

        };

        $.post(ajaxurl, data, function(response) {
            $('.to-append').before(response);
            page++;
            //console.log(response);
        });
    });
});
</script>
<!--webinar section content end-->
<style>
.web-list {
    border-radius: 5px;
    box-shadow: 0 5px 15px 0 rgba(109, 109, 109, 0.3);
}

.web-list img {
    height: 200px;
    width: 100%;
    background-color: #D8D8D8;
    border: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    object-fit: cover;
}

.web-list .top-webinar-details {

    background: #fff;
    border-radius: 5px;
    min-height: 332px;
    display: flex;
    /* place-items: center; */
    flex-direction: column;
    padding: 20px 45px;
    place-content: start;
}

.web-list .top-webinar-details h2 {
    color: #4A4A4A;
    font-size: 22px;
    font-weight: 500;
    line-height: 26px;
}

.web-list .top-webinar-details p {
    color: #4A4A4A;
    font-size: 12px;
    line-height: 16px;
}

.button {

    position: absolute;
    bottom: 20px;
    /* top: 50px; */
    width: 70%;
    margin: 0 auto;
}

.top-webinar-block h3 {
    font-size: 36px;
    line-height: 48px;
    color: #373A3C;
    padding: 15px 15px 20px;
}

#td {
    color: grey;
    font-size: large;
}

.next-img {
    align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
}
</style>
<!--footer section start-->
<?php get_footer(); ?>
<!--footer section end-->
