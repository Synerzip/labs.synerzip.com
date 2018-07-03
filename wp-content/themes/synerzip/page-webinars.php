<?php
get_header();
?>

<!--banner section end-->

<!--webinar section content start-->

<section class="f-fix webinar-page-wrapper grey-bg" id="webinar-page-wrapper">
    <div class="container">
       
            <?php
            $post = get_field('next_webinar', 'option');
            var_dump($post);
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
             <p>Learning strategies to complex business problems from experiences keep us ahead of our competition. Lead the way with our webinars. Gain valuable insights into how new developments in software is affecting the way we do business.
             </p>
             </div>
         <div class="row">

             <div class="top-webinar-block">
			<h2 style="padding:0px 0px 0px 18px">Upcoming Webinars</h2>
            <?php foreach ($post as $topwebinar) {
                $offset = '';
  $conditionForNextSection['post__not_in'][] = $topwebinar->ID;

    if($block_count == 0){
       
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
    if($block_count == 4 || $total - $total_iterated == 1){
        
        $block_ = 0;
    }
    $total_iterated++;
            }
?>
      </div>
        </div> 
        <?php
            $taxonomies = array("value", "practice", "technology");
            $terms = wp_get_object_terms($post->ID, $taxonomies);
            $arrHashtag = array();
            foreach ($terms as $term) {
                $arrHashtag[] = $term->slug;
            }
            $condition = array();
            $condition['post_type'] = 'webinar';
            $condition['posts_per_page'] = '3';
         
$condition['post__not_in'] = $conditionForNextSection['post__not_in'];
            $webinar = fetch_rulequery($arrHashtag, $condition);
            $webinars = $webinar->posts;
      
 		
            ?>					
       
    <!--    <div class="row">
            <div class="past-webinar-block push-down-8">
                <h2>Related Webinars</h2>
                <?php
                foreach ($webinars as $singleWebinar) {
                    $conditionForNextSection['post__not_in'][] = $singleWebinar->ID;

                    $image = get_field('feature_images', $singleWebinar->ID);
                    $singleWebinar->image = get_the_post_thumbnail_src(get_the_post_thumbnail($singleWebinar->ID));
                    $singleWebinar->webinarDate = get_post_meta($singleWebinar->ID, 'date', true);
					$singleWebinar->url = get_permalink($singleWebinar->ID);
                    ?>
                    <div class="col-md-4 col-sm-4">
                        <div class="webinar-list">
                            <a href="#">
                                <img src="<?php echo $singleWebinar->image; ?>"/>
                                <div class="past-webinar-details webinar-heading">
                                    <h3><a href="<?php echo $singleWebinar->url; ?>"><?php echo $singleWebinar->post_title; ?></a></h3>
                                    <p><?php  $date = new DateTime($singleWebinar->webinarDate);
                                        echo $date->format('j M Y'); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>-->

        <div class="row">
            <div class="col-md-12 push-down-8">
			<h2>Past Webinars</h2>
                <table class="table more-webinar-list syn-table-style">
                    <tbody>
                     
                        <?php
                        $condition = array();
                        $condition['post_type'] = 'webinar';
                        $condition['posts_per_page'] = '3';
                        $condition['post__not_in'] = $conditionForNextSection['post__not_in'];
                        $passhash = 'showAll';
                        $listwebinar = fetch_rulequery($passhash, $condition);

                        $listwebinars = $listwebinar->posts;

                        //echo "<pre>";print_r($listwebinars);
                        foreach ($listwebinars as $eachWebinar) {
                            $eachWebinar->webinarDate = get_post_meta($eachWebinar->ID, 'date', true);
                            $eachWebinar->url = get_permalink($eachWebinar->ID);
                            ?>
                       <!--     <tr href="<?php echo $eachWebinar->url; ?>">-->

                               <tr onclick="document.location='<?php echo $eachWebinar->url; ?>'" style="cursor: pointer;">                                
                                 <td><?php echo $eachWebinar->post_title; ?></td>
                                <td><?php  $date = new DateTime($eachWebinar->webinarDate);
                                        echo $date->format('j M Y'); ?></td>
                                <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
                              
                            </tr>
                        <?php } ?>
                       <tr class="to-append">
                            <td colspan="3"><div class="loadmore">More webinars<i id= "loading" class="fa fa-refresh fa-spin" style="padding:10px"></i></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid no-padding">
    <div class="next-page-wrapper">



		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/blogs">Blogs</a></h4>
				<div class="arrow">
					<a href="/blogs"><img src="../wp-content/uploads/2017/11/skype.png"></a>
				</div>
			</div>
		</div>
    </div>
  </div>
</section>
                 
<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var page =2;
    jQuery(function($){
        $('#loading').hide();
        $('body').on('click', '.loadmore', function(){
            var data = {
                'action': 'load_webinars_by_ajax',
                'page': page
                             
            };
            $('#loading').show();
            $.post(ajaxurl, data, function(response){
                $('.to-append').before(response);
                page++;
                $('#loading').hide();
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
.button{

position: absolute;
    bottom: 20px;
    /* top: 50px; */
    width: 70%;
    margin: 0 auto;
}
.top-webinar-block h3{font-size:36px;line-height: 48px;color: #373A3C;padding: 15px 15px 20px;}
#td{
    color:grey;
    font-size:large;
}
.next-img{
                            align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
   
                    }
    </style>
  
<!--footer section start-->

<?php get_footer(); ?>
<!--footer section end-->	

