<?php
get_header();
global $post;
$post_meta = get_post_meta($post->ID);

$videoUrl = $post_meta['video'][0];
if (isset($videoUrl)) {
    $videourl = wp_oembed_get($videoUrl);
    preg_match('/src="([^"]+)"/', $videourl, $match);
    $video = $match[1];
}
//echo "<pre>";print_r($post_meta);exit;
$accomplishment1_title = $post_meta['accomplishment1_title'][0];
$accomplishment1_description = $post_meta['accomplishment1_description'][0];
$accomplishment1_description = explode(':', $accomplishment1_description);
$accomplishment1_number = $accomplishment1_description[0];
$accomplishment1_suffix = $accomplishment1_description[1];
$accomplishment2_title = $post_meta['accomplishment2_title'][0];
$accomplishment2_description = $post_meta['accomplishment2_description'][0];
$accomplishment2_description = explode(':', $accomplishment2_description);
$accomplishment2_number = $accomplishment2_description[0];
$accomplishment2_suffix = $accomplishment2_description[1];

$accomplishment3_title = $post_meta['accomplishment3_title'][0];
$accomplishment3_description = $post_meta['accomplishment3_description'][0];
$accomplishment3_description = explode(':', $accomplishment3_description);
$accomplishment3_number = $accomplishment3_description[0];
$accomplishment3_suffix = $accomplishment3_description[1];

$accomplishment4_title = $post_meta['accomplishment4_title'][0];
$accomplishment4_description = $post_meta['accomplishment4_description'][0];
$accomplishment4_description = explode(':', $accomplishment4_description);
$accomplishment4_number = $accomplishment4_description[0];
$accomplishment4_suffix = $accomplishment4_description[1];

$countaccompleshements = 4;
$counter = 0;
for ($i = 1; $i <= $countaccompleshements; $i++) {
    $title = 'accomplishment' . $i . '_title';

    if (isset($$title) && $$title != '')
        $counter++;
}

$posterimage->thumbnailurl = get_field('image')['url'];
if (!$posterimage || $posterimage->thumbnailurl == '') {
    $posterimage->thumbnailurl = "/wp-content/uploads/2017/11/video-cover.png";
}
//exit;
if ($counter == 4)
    $accomplishmentClass = 'col-sm-3';
elseif ($counter == 3)
    $accomplishmentClass = 'col-sm-4';
elseif ($counter == 2)
    $accomplishmentClass = 'col-sm-6';
?>

<section class="grid-lines-wrapper">
    <div>
        <svg width="" height="" xmlns="http://www.w3.org/2000/svg" version="1.1">
            <!-- Linear gradient defination vertical white to transparent --> 
            <defs>
                <linearGradient id="linear" x1="0%" y1="0%" x2="0%" y2="100%" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:rgba(255,255,255,0);stop-opacity:1"/>
                </linearGradient>
            </defs>
            <g stroke="url(#linear)" class="grid-lines">
                <!-- Draw the vertical lines left to right -->
                <line x1="11.5%" y1="0" x2="11.5%" y2="85%" stroke-width="1px" />
                <line x1="23%" y1="0" x2="23%" y2="85%" stroke-width="1px" />
                <line x1="34.5%" y1="0" x2="34.5%" y2="85%" stroke-width="1px" />
                <line x1="46%" y1="0" x2="46%" y2="85%" stroke-width="1px" />
                <line x1="57.5%" y1="0" x2="57.5%" y2="85%" stroke-width="1px" />
                <line x1="69%" y1="0" x2="69%" y2="85%" stroke-width="1px" />
                <line x1="80.5%" y1="0" x2="80.5%" y2="85%" stroke-width="1px" />
                <line x1="92%" y1="0" x2="92%" y2="85%" stroke-width="1px" />
                <line x1="103.5%" y1="0" x2="103.5%" y2="85%" stroke-width="1px" />
            </g>
        </svg>
    </div>
</section>

<!--banner section end-->

<!--client-intro section start-->

<section class="f-fix client-intro-wrapper" id="client-intro-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 no-paddingR paddingR-sm-reset">
                <div class="shadow-box"></div>
                <div class="client-intro-left-block content-box">
                    <p><?php echo $post->post_content; ?></p>
                </div>
            </div>
            <div class="col-md-6 no-paddingL paddingL-sm-reset">
                <div class="shadow-box"></div>
                <div class="client-intro-right-block content-box">
                    <div class="client-intro-content">

                        <div class="video-cover-common"  onclick="thevid = document.getElementById('thevideo'); thevid.style.display = 'block'; this.style.display = 'none'"><img src="<?php echo $posterimage->thumbnailurl; ?>" /><img class="youtube-play-icon" src="<?php bloginfo('template_url'); ?>/beta_images/youtube_play.png" /></div>

                        <div id="thevideo" style="display: none;">   <iframe id="youtube-video" class="iframeVedio" src="<?php echo $video; ?>"  frameborder="0" allowfullscreen></iframe></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>           
    </div>
</section>

<!--client-intro section end-->

<!--accomplishment section start-->

<section class="f-fix accomplishments-wrapper" id="accomplishments-wrapper">
    <div class="container">
        <div class="accomplishments-block">
            <div class="page-title"><h3>Accomplishments</h3></div>
            <div class="row">
                <div class="counter">
<?php
for ($i = 1; $i <= $counter; $i++) {
    $title = 'accomplishment' . $i . '_title';
    $sufix = 'accomplishment' . $i . '_suffix';

    $number = 'accomplishment' . $i . '_number';
    $roundedNumber = round($$number * (90 / 100));
    if ($roundedNumber > 10)
        $roundedNumber = $roundedNumber - 10;
    else
        $roundedNumber = 0;
    ?>				
                        <div class="<?php echo $accomplishmentClass; ?> ">
                            <div class="counter-block text-center">
                                <p class="digit-block"><span class="counter-value" data-count="<?php echo $$number; ?>"><?php echo $roundedNumber; ?></span><sub><?php echo $$sufix; ?></sub></p>
                                <p class="text-block"><?php echo ucfirst($$title); ?></p>
                            </div>
                        </div>
<?php } ?>

                </div>
            </div>
        </div>
        <div class="clear"></div>           
    </div>
</section>

<!--accomplishment section end-->	

<?php
$post = get_field('next_webinar', 'option');
$webinar_meta = get_post_meta($post->ID);
$pardotform = $webinar_meta['pardot_form'][0];
$date = $webinar_meta['date'][0];
$time = $webinar_meta['time'][0];
$total = count($post);
$total_iterated = 0;
$block_count = 0;
$offset_set = FALSE;
//$clientImage= get_the_post_thumbnail_src(get_the_post_thumbnail( $webinarId,'large' ));

$webinarLink = get_permalink($webinarId);
//$poster=$post_meta['_feature_blog1'][0];
//$PosterId=$posters->post->ID;
$posterdata = get_the_title($webinar_meta['feature_webinar'][0]);
if ($posterdata) {
    $clientImage = get_the_post_thumbnail_src(get_the_post_thumbnail($webinar_meta['feature_webinar'][0], 'large'));
} else {
    $clientImage = get_the_post_thumbnail_src(get_the_post_thumbnail($webinarId, 'large'));
}
?>
				

<!--client-exp section start-->
        <?php
        /*
          //commented code to pull blogs from hashtag as direct by marketing team
          $taxonomies=array("value","practice","technology");
          $terms = wp_get_object_terms($post->ID,$taxonomies);
          $arrHashtag=array();
          foreach($terms as $term)
          {
          $arrHashtag[]=$term->slug;
          }
          $condition=array();
          $condition['post_type']='post';
          $condition['posts_per_page']='2';
          $Resultblogs=fetch_rulequery($arrHashtag,$condition);
          $blogs=$Resultblogs->posts;
          $i=0;
          $blog=array();
          foreach($blogs as $singleBlog)
          {
          $blog[$i]['blogId']=$singleBlog->ID;
          $blog[$i]['blogLink']=get_permalink($blog[$i]['blogId']);
          $blog[$i]['blogWriter'] = get_field('writer',$blog[$i]['blogId']);
          $i++;
          }

         */

        $posterblog1data = get_the_title($post_meta['section1'][0]);
        $posterblog2data = get_the_title($post_meta['section2'][0]);
        $poster1posttype = get_post_type($post_meta['section1'][0]);
        $poster2posttype = get_post_type($post_meta['section2'][0]);
//echo "<pre>";print_r($posterblog1data);
        if ($posterblog1data) {
            $clientblog1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['section1'][0], 'large'));
            $clientblog1Link = get_permalink($post_meta['section1'][0]);
            $clientblog1Writer = get_field('writer', $post_meta['section1'][0]);
        }
        if ($posterblog2data) {
            $clientblog2Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['section2'][0], 'large'));
            $clientblog2Link = get_permalink($post_meta['section2'][0]);
            $clientblog2Writer = get_field('writer', $post_meta['section2'][0]);
        }

        if (isset($posterblog1data) && !empty($posterblog1data)) {
            ?>
    <section class="f-fix blog-wrapper social-wrapper even-side" id="blog-wrapper">
        <div class="container">

            <div class="col-md-6 col-md-push-6 col-sm-12 clearfix">
                <div class="blog-frame social-frame scroll-frame f-fix">
                    <div class="bg-block f-fix">

                        <div class="img-block">
                            <div class="img-adjust"><img src="<?php echo $clientblog1Image; ?>"/></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-6 col-sm-12 clearfix">
                <div class="blog-content social-content scroll-frame f-fix">
                    <h4><?php echo $poster1posttype; ?></h4>
                    <h2><?php echo $posterblog1data; ?></h2>
    <?php if (isset($clientblog1Writer[0]->post_title) && !empty($clientblog1Writer[0]->post_title)) { ?>	
                        <div class="time">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>by <?php echo $clientblog1Writer[0]->post_title; ?></span>
                        </div>
    <?php } ?>
					<div class="blog-submit">
						<button class="btn blog-submit-btn">
                    		<a href="<?php echo $clientblog1Link; ?>">Learn More</a>		
						<button>
					</div>
                </div>
            </div>
            <div class="clear"></div> 
        </div>
    </section>	

    <!--client-exp section end-->

    <!--webinar section start-->
    <?php }
?>




<!--webinar section end-->

<!--blog section start-->


<?php
if (isset($posterblog2data) && !empty($posterblog2data)) {
    ?>

    <section class="f-fix blog-wrapper social-wrapper odd-side pad-bot-70" id="blog-wrapper1">

        <div class="container">
            <div class="col-md-6 col-sm-12 clearfix">
                <div class="blog-frame social-frame scroll-frame f-fix">
                    <div class="bg-block f-fix">
                        <div class="img-block">
                            <div class="img-adjust">
                                <img src="<?php echo $clientblog2Image; ?>"/> 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 clearfix">
                <div class="blog-content social-content scroll-frame f-fix">
                    <h4><?php echo $poster2posttype; ?></h4>
                    <h2><?php echo $posterblog2data; ?></h2>
    <?php if (isset($clientblog2Writer[0]->post_title) && !empty($clientblog2Writer[0]->post_title)) { ?>	
                        <div class="time">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>by <?php echo $clientblog2Writer[0]->post_title; ?></span>
                        </div>
    <?php } ?>
					<div class="blog-submit">
						<button class="btn blog-submit-btn">
		                    <a href="<?php echo $clientblog2Link; ?>">Learn More</a>	
						</button>
					</div>
                </div>
            </div>
            <div class="clear"></div> 
        </div>
    </section>	
    <!--blog section end-->
    <?php
}?>

<!--webinar section start-->

 <?php
       $posterwebinar1data = get_the_title($post_meta['section3'][0]);
       $posterwebinar1posttype = get_post_type($post_meta['section3'][0]);
       $posterwebinar2data = get_the_title($post_meta['section4'][0]);
       $posterwebinar2posttype = get_post_type($post_meta['section4'][0]);

            if ($posterwebinar1data ) {
                $clientwebinar1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['section3'][0], 'large'));
                $clientwebinar1Link = get_permalink($post_meta['section3'][0]);
                $clientwebinar1Writer = get_field('writer', $post_meta['section3'][0]);
               
            }
            if ($posterwebinar2data ) {
                $clientwebinar2Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['section4'][0], 'large'));
                $clientwebinar2Link = get_permalink($post_meta['section4'][0]);
                $clientwebinar2Writer = get_field('writer', $post_meta['section4'][0]);
                
            }

        if (!empty($posterwebinar1data )) {
            ?>
            <section class="f-fix blog-wrapper social-wrapper even-side" id="blog-wrapper">
                    <div class="container">
                        <div class="col-md-6 col-md-push-6 col-sm-12 clearfix">
                            <div class="blog-frame social-frame scroll-frame f-fix">
                                <div class="bg-block f-fix">

                                    <div class="img-block">
                                        <div class="img-adjust"><img src="<?php echo $clientwebinar1Image ; ?>"/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-pull-6 col-sm-12 clearfix">
                            <div class="blog-content social-content scroll-frame f-fix">
                               <h4><?php echo $posterwebinar1posttype ; ?></h4>
                               <h2><?php echo $posterwebinar1data ; ?></h2>
                                <?php if (isset($clientwebinar1Writer[0]->post_title) && !empty($clientwebinar1Writer[0]->post_title)) { ?>   
                                    <div class="time">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span>by <?php echo $clientwebinar1Writer[0]->post_title; ?></span>
                                    </div>
                                <?php } ?>
                                <div class="blog-submit">
                                    <button class="btn blog-submit-btn">
                                                  <a href="<?php echo $clientwebinar1Link ; ?>">Learn More</a>  
                                   <button>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div> 
                    </div>
            </section> 

    <!--client-exp section end-->

    <!--webinar section start-->
    <?php }
?>

<!--webinar section4 start -->
<?php
    if (!empty($posterwebinar2data )) {
        ?>

    <section class="f-fix blog-wrapper social-wrapper odd-side pad-bot-70" id="blog-wrapper1">

            <div class="container">
                <div class="col-md-6 col-sm-12 clearfix">
                    <div class="blog-frame social-frame scroll-frame f-fix">
                        <div class="bg-block f-fix">
                            <div class="img-block">
                                <div class="img-adjust">
                                    <img src="<?php echo $clientwebinar2Image ; ?>"/> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 clearfix">
                    <div class="blog-content social-content scroll-frame f-fix">
                        <h4><?php echo $posterwebinar2posttype ; ?></h4>
                        <h2><?php echo $posterwebinar2data ; ?></h2>
                        <?php if (isset($clientwebinar2Writer[0]->post_title) && !empty($clientwebinar2Writer[0]->post_title)) { ?>   
                            <div class="time">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>by <?php echo $clientwebinar2Writer[0]->post_title; ?></span>
                            </div>
                        <?php } ?>
         <div class="blog-submit">
          <button class="btn blog-submit-btn">
                          <a href="<?php echo $clientwebinar2Link ; ?>">Learn More</a> 
          </button>
         </div>
                    </div>
                </div>
                <div class="clear"></div> 
            </div>
    </section> 
    <!--webinar section4 end-->
    <?php
}

get_footer();
?>
