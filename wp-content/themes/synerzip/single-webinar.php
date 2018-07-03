<?php
get_header();
global $post;
$videoUrl = get_post_meta($post->ID, 'video', true);
var_dump($videoUrl);
if (isset($videoUrl)) {
    $videourl = wp_oembed_get($videoUrl);
    preg_match('/src="([^"]+)"/', $videourl, $match);
    $videourl = $match[1];
}
$post_meta = get_post_meta($post->ID);
        $pardotform = $post_meta['pardot_form'][0];
        $date = $post_meta['date'][0];
        $time = $post_meta['time'][0];
        $timestamp = $date . ' 20:00:00';
        $today = date("Y-m-d H:i:s");
        $future = false;
        if (strtotime($timestamp) > strtotime($today) ) {
            $future = true;
        }
//echo $future;exit;
        $presenter1 = $post_meta['presenters1'][0];
        $presenter2 = $post_meta['presenters2'][0];
		$pptdata = $post_meta['ppt'][0];
        $presenter1_photo = get_field('presenter1photo')['url'];
        $presenter2_photo = get_field('presenter2photo')['url'];
        $modrator = $post_meta['modrator'][0];

?>

<!--banner section end-->

<!--webinar section content start-->


<section class="f-fix past-webinar-main-wrapper grey-bg" id="past-webinar-main-wrapper">
    <div class="container">
<?php if (isset($videoUrl) && isset($videourl) && $videourl != '' && $future==false ) {
    ?>
            <div class="past-webinar-video-wrapper">
                <!-- youtube video link 
                <iframe id="past-webinar-video" width="454" height="806" src="<?php echo $videourl; ?>?rel=0?wmode=opaque" frameborder="0" allowfullscreen>
                </iframe> -->
                <div class="video-cover-common no-shaddow" onclick="thevid = document.getElementById('thevideo'); thevid.style.display = 'block'; this.style.display = 'none'">

<center><img width="804" height="453" src="<?php bloginfo('template_url'); ?>/beta_images/video-cover.png" /></center>
<img class="youtube-play-icon" src="/wp-content/themes/synerzip/beta_images/youtube_play.png">
</div>

                <div id="thevideo" style="display: none;"> <center>  <iframe id="youtube-video" width="806" height="454" src="<?php echo $videourl; ?>" frameborder="0" allowfullscreen></iframe></center></div>
            </div>
<?php } ?>
        <div class="row">
        <?php

        if (isset($post) && !empty($post) && $future) {
            ?>
                <div class="col-sm-12 col-md-6 col-md-push-6">
                    <div class="webinar-page-form">
                        <script type="text/javascript">
                            var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                            var eventer = window[eventMethod];
                            var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
                            eventer(messageEvent, function (e) {
                                if (isNaN(e.data))
                                    return;
                                document.getElementById("sizetracker").style.height = e.data + "px";
                            }, false);
                        </script>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.3/iframeResizer.min.js"></script>
                        <iframe src="<?php echo $pardotform; ?>" width="100%"  scrolling="no" id="sizetracker"></iframe>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-md-pull-6">
                    <div class="webinar-page-info">
                       <!-- <h2><?php echo $post->post_title; ?></h2>
                        <p class="time"><?php $date = new DateTime(get_field('date'));
            echo $date->format('j M Y');
            ?></p>-->

                        <p><?php echo $post->post_content; ?></p>
                        <?php if ((isset($presenter1) && !empty($presenter1)) || (isset($presenter2) && !empty($presenter2))) {
                            ?>	
                            <h3 class="push-down-4">About the Presenter(s)</h3>
                            <div class="presenters-block">
                                <img src="<?php echo $presenter1_photo; ?>"/>
                                <div class="presenter-info">
                                    <?php echo $presenter1; ?>
                                </div>
                            </div>
                            <?php if ((isset($presenter2) && !empty($presenter2))) {
                                ?>	
                                <div class="presenters-block">
                                    <img src="<?php echo $presenter2_photo; ?>"/>
                                    <div class="presenter-info">
                                        <?php echo $presenter2; ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                         <?php if(!empty($modrator)){
                             ?>	
         <h3 class="push-down-4">Webinar Modrator</h3>
   	  <p><?php echo $modrator; ?></p>
   <?php }  ?> 
                    </div>
                </div>

            <?php } elseif (!$future) {
                ?>

              <!--  <div class="row">
                    <div class="col-sm-12">
						<div class="webinar-block">
                        <h1><?php echo $post->post_title; ?></h1>
                        <p class="time"><?php $date = new DateTime(get_field('date'));
            echo $date->format('j M Y');
                ?></p>
						</div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-md-push-6">
                        <div class="past-webinar-page-info">
                            <!--this will be added later on
                                 <ul class="webinar-details">
                              <li>
                                 <label>Audience: </label>
                                 <span>Deployment Specialist, IT Implem_Desktop/EndUser Spec, IT Implem_Infrastructure Spec, IT Implem_IT Generalist</span>
                               </li>
                               <li>
                                 <label>Language: </label>
                                 <span>English</span>
                               </li>
                               <li>
                                 <label>Duration:</label>
                                 <span>60 Mins</span>
                               </li>
                             </ul>
                 <div class="seperator"></div>
                            -->

                              <?php
                            if ((isset($presenter1) && !empty($presenter1)) || (isset($presenter2) && !empty($presenter2))) {
                                ?>	
                               <?php if($presenter1&&$presenter2){?>
                                  <h3 class="push-down-4">About the Presenters</h3> 
                              <?php }
                           else{
                                  ?>
                                  <h3 class="push-down-4">About the Presenter</h3> 
                             <?php }
?>
                              
                                <div class="presenters-block">
                                    <img src="<?php echo $presenter1_photo; ?>"/>
                                    <div class="presenter-info">
        <?php echo $presenter1; ?>
                                    </div>
                                </div>
                                <?php if ((isset($presenter2) && !empty($presenter2))) {
                                    ?>	
                                    <div class="presenters-block">
                                        <img src="<?php echo $presenter2_photo; ?>"/>
                                        <div class="presenter-info">
            <?php echo $presenter2; ?>
                                        </div>
                                    </div>
        <?php }
    } ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-md-pull-6">
                        <div class="webinar-page-info">
			<?php if (isset($videoUrl) && isset($videourl) && $videourl != ''){?>
                            <h3></h3>
<?php } else { ?>
<h3></h3><?php }?>
                            <p>
    <?php echo $post->post_content; ?>
                            </p>
    <?php if(!empty($modrator)){
                             ?>	
         <h3 class="push-down-4">Webinar Modrator</h3>
   	  <p><?php echo $modrator; ?></p>
   <?php }  ?>                
   

<div class="blog-submit">
                            <a href="<?php echo $pptdata; ?>" download="<?php echo $pptdata; ?>" class="push-down-4 btn blog-submit-btn"><span class="download-txt">Download Presentation</span></a>
</div>
                        </div>
                    </div>
                </div>
                <?php
            }

            $taxonomies = array("value", "practice", "technology");
            $terms = wp_get_object_terms($post->ID, $taxonomies);
            $arrHashtag = array();
            foreach ($terms as $term) {
                $arrHashtag[] = $term->slug;
            }
            $condition = array();
            $condition['post_type'] = 'webinar';
            $condition['posts_per_page'] = '3';
            $condition['post__not_in'] = array($post->ID);
            $webinar = fetch_rulequery($arrHashtag, $condition);
            $webinars = $webinar->posts;
            $conditionForNextSection['post__not_in'] = array($post->ID);
            ?>					
        </div>
        <div class="row">
            <div class="past-webinar-block">
                <h2>Past Webinars</h2>
                <?php
                foreach ($webinars as $singleWebinar) {
                    $conditionForNextSection['post__not_in'][] = $singleWebinar->ID;
                    $image = get_field('feature_images', $singleWebinar->ID);
                    $singleWebinar->image = get_the_post_thumbnail_src(get_the_post_thumbnail($singleWebinar->ID));
                    $singleWebinar->url = get_permalink($singleWebinar->ID);
                    $singleWebinar->webinarDate = get_post_meta($singleWebinar->ID, 'date', true);
                    ?>
                    <div class="col-md-4">
                        <div class="webinar-list">
                            <a href="<?php echo $singleWebinar->url; ?>">
                                <img src="<?php echo $singleWebinar->image; ?>"/>
                                <div class="past-webinar-details webinar-heading">
                                    <h3><?php echo $singleWebinar->post_title; ?></h3>
                                    <h5><?php $date = new DateTime($singleWebinar->webinarDate);
                    echo $date->format('j M Y');
                    ?></h5>
                                </div>
                            </a>
                        </div>
                    </div>
<?php } ?>
            </div>
        </div>
        <div class="row push-down-5">
            <div class="col-md-12">
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
<tr onclick="document.location='<?php echo $eachWebinar->url; ?>'" style="cursor: pointer;">
                      <!--      <tr href="<?php echo $eachWebinar->url; ?>">-->
                                <td><?php echo $eachWebinar->post_title; ?></td>
                                <td><?php
                                    $date = new DateTime($eachWebinar->webinarDate);
                                    echo $date->format('j M Y');
                                    ?></td>
                                <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
                            </tr>
<?php } ?>
                        <tr class="to-appendlast">
                            <td colspan="3"><div class="loadmoreweb">More webinars</div></td>
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
				<h4><a href="/career">Careers</a></h4>
				<div class="arrow">	
					<a href="/career"><img src="../../wp-content/uploads/2017/11/skype.png"></a>
				</div>
			</div>
		</div>
	</div>
</div>
  </div>
</section>
                <style>
                    
                    .next-img{
                            align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
   
                    }
</style>
<script>
                    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                    var page = 2;
                    jQuery(function ($) {
                        $('body').on('click', '.loadmoreweb', function () {
                            var data = {
                                'action': 'load_posts_by_ajax',
                                'page': page

                            };

                            $.post(ajaxurl, data, function (response) {
                                $('.to-appendlast').before(response);
                                page++;
                                //console.log(response);
                            });
                        });
                    });
</script>						<!--webinar section content end-->

<!--footer section start-->
<?php
get_footer();
?>
