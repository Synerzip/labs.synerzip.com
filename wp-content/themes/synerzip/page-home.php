<?php
get_header();
global $post;
$Allpost= get_field('hashtagged_home_page','option');
$post_meta = get_post_meta($post->ID);
$carouselStories = get_field('Stories','option');
$carouselItems = get_field('home_page_carousel_items','option');
 ?>
<!--banner first section start-->
<?php
	$post=$Allpost[0];	
	$bodyClass= get_post_meta($post->ID,'background_gradient',true);
    //$firsttitle= wp_trim_words($post->post_title,8);
    $firsttitle= $post->post_title;
    $url1=$post->guid;
    $desc1=wp_trim_words($post->post_content,20);
    //$desc1=$post->post_content;
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<?php if (!empty($firsttitle)){?>
<section class="f-fix banner-wrapper-first" id="banner-wrapper" style="background-image: url(<?php echo $feat_image;?>),linear-gradient(135deg, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); -ms-linear-gradient(135deg, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%);">
    <div class="container v-align">
         <div class="banner-text banner-caption">
            <h3 class="line-height">              
	<?php echo $firsttitle;?>   
               </h3>
            <p class="ft-300">
        <?php echo $desc1; ?>
                 </p>
            <div class="banner-button">
                <button class="btn banner-btn" onclick="location.href = '<?php echo $url1; ?>'">Read more</button>
            </div> </div>
        <div class="clear"></div>           
    </div>
<?php 
// var_dump($carouselItems);exit;
	if($carouselItems){
	?>
<div class="hide-on-mobile1" id="hide-on-mobile-carousel">
      <div class="register-to-webinar">
  		<div id="text-carousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
				<div class="row">
                    <div class="webinar-close">
            		   <i class="fa fa-times"></i>
        			</div>
					<div class="col-xs-offset-1 col-xs-11 carousel-container">
						<div class="carousel-inner">
							<?php 
							foreach($carouselItems as $key => $citem)
							{
								$itemclass = 'item ';
								$itemclass .= !$key ? ' active' : '';
								?>
								<div class="<?php echo $itemclass ?>">
		                             <div class="carousel-content">
		                                <div class="webinar-txt">
		                                   	<h4><?php echo ucfirst($citem->post_type);?></h4>
		                                   	<p class="clampjs">
	                                   		<?php 
	                                   			echo $citem->post_title;
	                                   		?>
		                                   	</p>
		                                   	<?php
		                                   	$web_date   = '';
		                                   	$buttonLink = get_permalink($citem);
		                                   	$buttonText = 'Read more';
		                                   	if ($citem->post_type == "webinar" && $citem->date){
		                                   		$web_date =  date("F j Y", strtotime($citem->date));
		                                   		$buttonLink   = "/webinars/', '_blank";
		                                   		$buttonText   = 'Register';
		                                   	}
		                                   	?>
		                                   	<p>
	                                   			<?php echo $web_date;?>
		                                   	</p>
		                                   	<p class="absbutton">
		                                   		<button class="btn register-btn" 
		                                   			onclick="location.href ='<?php echo $buttonLink;?>'"
		                                   			>
		                                   			<?php echo $buttonText;?>
		                                   		</button>
		                                   	</p>
		                                </div>
		                          	</div>
		                       </div>
                          <?php } ?>
                      </div> <!--item active-->
                 	</div>
					</div>
				</div>
				    <!-- Controls --> <a class="left carousel-control" href="#text-carousel" data-slide="prev" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) -12%);" >
					<span class="fa fa-angle-left" style="padding-top: 200% ;color: black;"></span>
					</a>
					<a class="right carousel-control" href="#text-carousel" data-slide="next" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 2000%); margin-top: 43px;">
					<span class="fa fa-angle-right" style="padding-top: 108% ;color: black;" ></span>
					</a>
	   </div>
    </div>
 </div>

<div class="show-on-mobile1" id="register-to-webinar1">
      <div class="register-to-webinar1">
  		<div id="text-carousel2" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
				<div class="row">
                    <div class="webinar-close">
            		   <i class="fa fa-times"></i>
        			</div>
					<div class="col-xs-offset-1 col-xs-10">

						<div class="carousel-inner">
							<?php 
							foreach($carouselItems as $key => $citem)
							{
								$itemclass = 'item ';
								$itemclass .= !$key ? ' active' : '';
								?>
								<div class="<?php echo $itemclass ?>">
		                             <div class="carousel-content">
		                                <div class="webinar-txt">
		                                   	<h4><?php echo ucfirst($citem->post_type);?></h4>
		                                   	<p class="clampjs2">
	                                   		<?php 
	                                   			echo $citem->post_title;
	                                   		?>
		                                   	</p>
		                                   	<?php
		                                   	if ($citem->post_type == "webinar" && $citem->date){?>
		                                   	<p>
	                                   		<?php
	                                      		echo date("F j Y", strtotime($citem->date));
	                                      	?>
		                                   	</p>
		                                   	<p>
		                                   		<button class="btn register-btn" onclick="location.href ='/webinars/', '_blank'">Register</button>
		                                   	</p>
			                                <?php }else{?>
			                                <p></p>
											<p>
		                                   		<button class="btn register-btn" onclick="location.href ='<?php echo get_permalink($citem)?>'">Read more</button>
		                                   	</p>
			                                <?php } ?>
		                                </div>
		                          	</div>
		                       </div>
                          <?php } ?>
                      </div> <!--item active-->
             
                 	</div>
					</div>
				</div>
				    <!-- Controls --> 
				    <a class="left carousel-control" href="#text-carousel2" data-slide="prev">
						<span class="fa fa-angle-left"></span>
					</a>
					<a class="right carousel-control" href="#text-carousel2" data-slide="next">
						<span class="fa fa-angle-right"></span>
					</a>
	   </div>
    </div>
 </div>
<?php } 
?>



</section>
<?php } 
?>
<!--banner first section end-->
<!--banner second section start-->
<?php 
    
     	$post=$Allpost[1];
     	//$title2= wp_trim_words($post->post_title,8);
     	$title2= $post->post_title;
     	$url2=$post->guid;
     	$desc2=wp_trim_words($post->post_content,20);
     	//$desc2=$post->post_content;
     	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    
?>
<?php if (!empty($title2)){?>
<section class="f-fix banner-wrapper-second" id="banner-wrapper">
    <div class="container v-align">
        <div class="banner-img banner-lef-icon">
            <img src="<?php echo $feat_image;?>" title="Banner" alt="Banner">
        </div>
        <div class="banner-text	 banner-caption-img-txt">
            <h3>
               <?php 
               echo $title2;
?>      
</h3>
            <p class="ft-300">
       <?php echo $desc2; ?>
               </p>
            <div class="banner-second-section">
                <button class="btn banner-btn" onclick="location.href = '<?php echo $url2; ?>'">Read more</button>
            </div></div>
        <div class="clear"></div>           
    </div>
</section>
<?php } 
?>
<!--banner second section end-->


<!--banner third section start-->
 <?php $post=$Allpost[2];
//$title3=wp_trim_words($post->post_title,8);
$title3=$post->post_title;
$url3=$post->guid;
$desc3=wp_trim_words($post->post_content,20);
//$desc3=$post->post_content;
$feat_image1 = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
?>
<?php if (!empty($title3)){?>
<section class="f-fix banner-wrapper-third" id="banner-wrapper" style="background-image: url(<?php echo $feat_image1;?>),linear-gradient(40deg,#6110a2 20%,#1249a7 100%);">
    <div class="container v-align">
        <div class="banner-text banner-caption">
            <h3>
       <?php 
             echo $title3;
?>
                </h3>
            <p class="ft-300">
       <?php echo $desc3; ?>
               </p>
            <div class="banner-button">
                <button class="btn banner-btn" onclick="location.href = '<?php echo $url3; ?>'">Read more</button>
            </div></div>
        <div class="clear"></div>           
    </div>
</section>
<?php } 
?>
<!--banner third section end-->
<!--banner forth section start-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="roadmap">
					<h3>Accelerate your product roadmap </h3>
					<p>
						Perhaps the most under utilized assest in most companies are ideas in their employee's heads. While the idea of Eric Ries(in his book The lean Startup)are well established and ardently followed by the tech startup community.
					</p>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									1
								</div> -->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/Development_Partner.png">
                                </div>
                            

                            <div class="offering-desc-home"> 
							<h4>
								<a href="/practices/#developmentpartner">Develpment Center</a>
							</h4>
								<p>
									Rapidly scale your engineering capacity for ongoing software product development.
								</p>
                            </div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									2
								</div>-->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/Pilot_Engagement.png">
                                </div>
                                <div class="offering-desc-home"> 
								<h4><a href="/practices/#Pilot Engagement">Pilot Engagement</a></h4>
								<p>
									Experience what it's like working with Synerzip. In a few short weeks, we'll deliver a defined scope of work.
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									3
								</div>-->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/Lean Start up.png">
                                </div>
                                 <div class="offering-desc_len-home "> 
								<h4><a href="/practices/#Lean start up MVP">Lean start up MVP</a></h4>
								<p>
									Take your idea to MVP using our lean approach to agile product devvelopment.
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									4
								</div>-->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/Technology_Refresh.png">
                                </div>
                                <div class="offering-desc-home"> 
							<h4><a href="/practices/#Technology refresh">Technology refresh</a></h4>
								<p>
									Transition to a new technology platform using skilled technologists at a faster pace and with less risk.
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									5
								</div>-->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/DevOps.png">
                                </div>
                                <div class="offering-desc-home"> 
						<h4><a href="/practices/#DevOps">DevOps</a></h4>
								<p>
									Automate the process of software delivery, reducing cost and risk, with Synerzip's DevOps experience.
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-blocks">
							<div class="number-container">
								<!--<div class="number-with-circle">
									6
								</div>-->
							</div>
							<div class="roadmap-txt-sec">
								<div class="offering-img">
                                    <img src="../wp-content/uploads/2018/05/Quality_Assurance.png">
                                </div>
                             <div class="offering-desc_len-home">    
							<h4><a href="/practices/#Quality Assurance">QA Testing / automation</a></h4>
								<p>
									Increase the effectiveness and efficiency of your software testing while saving time and money.
								</p>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
// var_dump($carouselItems);exit;
 if($carouselStories) {
 ?>
<div class="col-md-1 col-sm-12">
    <div class="small-line2">
    	<div class="blog-name1">
        <h3 style="margin-top:1px">Stories</h3>
        </div>
    </div>
</div>
<section class="f-fix past-webinar-main-wrapper grey-bg" id="past-webinar-main-wrapper" style="margin-bottom:10%;">

    <div class="container">
	       <div id="text-carousel1" class="carousel slide" data-ride="carousel" data-interval="false">
	         <!-- Wrapper for slides -->
	               
	     
		    <div class="carousel-inner">
		       <?php 
		       foreach($carouselStories as $key => $citem)
		       {
		        $itemclass = 'item ';
		        $itemclass .= !$key ? ' active' : '';
		        $sucessStoryUrl = get_permalink($citem);
		        $implodeTitle = explode(",",$citem->post_title);
		        $videoUrl = get_post_meta($carouselStories[$key]->ID, 'vedio', true);// pulling videourl from custom field.
                if (isset($videoUrl)) {
                      $videourl = wp_oembed_get($videoUrl);
                      preg_match('/src="([^"]+)"/', $videourl, $match);
                      $video = $match[1];
                     
                }

		        ?>
		        <div class="<?php echo $itemclass ?>">
		        <div class="row">
		        <div class="col-md-6 col-sm-6">
			        <div>
			       	    <div id="thevideo" >
			        	 <div class="embed-responsive embed-responsive-16by9" >
			 				 <iframe id="youtube-video" class="iframeVedio" src="<?php echo $video; ?>"  frameborder="0" allowfullscreen></iframe>
						</div>
						</div>
			        </div>
		     	</div>

		    <div class="col-md-6 col-sm-12 col-xs-12 big_con">
		    <div class="col-md-1 col-sm-12">
		    <div class="small-line1">
		    </div>
		    </div>
		        <div class="blog-heading">
		            <h3><?php 
		                echo $implodeTitle[0];
		            ?></h3>
		            <h5><?php 
		                echo $implodeTitle[1],"",$implodeTitle[2];
		            ?></h5>
		            <p>
		            	<?php 
		                	echo wp_trim_words($citem->post_content,20);
		                ?>
		            </p>
		        <button class="btn banner-btn1" onclick="window.location.href = '<?php echo $sucessStoryUrl ?>'">Read more
		        </button>
		        </div>
		        </div>
		   </div>
		   
		   
		   
		   </div>
		 <?php } ?>
		                      </div> <!--item active-->
		                 
		   <div class="hide-on-mobile1">
		        <!-- Controls --> <a class="left carousel-control" href="#text-carousel1" data-slide="prev" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) -12%); margin-left: -8% !important;width: 6%;
    margin-top: 7%;" >
		     <span class="fa fa-angle-left" style="padding-top: 80% ;color: black; font-size:40px;margin-left:-60%;"></span>
		     </a>
		     <a class="right carousel-control" href="#text-carousel1" data-slide="next" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,-2.5) 2000%); margin-top: 43px;">
		     <span class="fa fa-angle-right" style="padding-top: 60% ;color: black;font-size:40px;margin-right:-60%;" ></span>
		     </a>
	    </div>
		<div class="show-on-mobile1">
		        <!-- Controls --> <a class="left carousel-control" href="#text-carousel1" data-slide="prev" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) -12%); margin-left: -3% !important;margin-top: 60%;" >
		     <span class="fa fa-angle-left" style="padding-top: 135% ;color: black; font-size:40px;margin-left:-60%;"></span>
		     </a>
		     <a class="right carousel-control" href="#text-carousel1" data-slide="next" style="background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,-2.5) 2000%); margin-top: 43px;">
		     <span class="fa fa-angle-right" style="margin-top: 448% ;color: black;font-size:42px;margin-right: -8%;" ></span>
		     </a>
	    </div>
		
		
		</div>
		  
		</div>
		
    
</section>
 <?php } ?>

<section class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">	
			<div class="row">
				<div class="send-enquiry">
					<div class="enquiry-section">
						<h4>have a project in mind ?</h4>
						<div class="arrow">
						<a href="/contact">	<img src="https://beta.website.synerzip.com/wp-content/uploads/2017/11/skype.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--banner forth section end-->
<!--banner end section end-->
<!--Top webinar section start-->
<?php $post = get_field('next_webinar', 'option');
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
<section class="f-fix past-webinar-main-wrapper grey-bg" id="past-webinar-main-wrapper">
    <div class="space">
    <div class="container">
        <div class="past-webinar-info-wrapper">
            <h2>Top Webinars</h2>
            
        <div class="row">
        <div class="past-webinar-block">
        <?php
        foreach ($post as $singleWebinar) {
            $offset = '';
            if ($block_count == 0) {

                $left = $total - $total_iterated;
                if ($left < 4 && !$offset_set) {
                    if ($left == 3)
                        $offset = 'col-sm-offset-0';
                    elseif ($left == 2)
                        $offset = 'col-sm-offset-2';
                    elseif ($left == 1)
                        $offset = 'col-sm-offset-4';
                    $class = webinar - active;
                    $offset_set = TRUE;
                }
            }
            $image = get_field('feature_images', $singleWebinar->ID);
            $singleWebinar->image = get_the_post_thumbnail_src(get_the_post_thumbnail($singleWebinar->ID));
            $singleWebinar->url = get_permalink($singleWebinar->ID);
            $today = strtoupper(date('M j, Y'));
            $date = new DateTime(get_post_meta($singleWebinar->ID, 'date', true));
            $webdate = strtoupper($date->format('M j,  Y'));
            if ($webdate <= $today) {
                $text = "View Now";
            } else {
                $text = "Register Now";
            }
            ?>
            <div class="col-sm-6 col-md-4 push-down-2 <?php echo $offset ?>">
                <div class="webinar-list">
                    <a href="#">
                        <img src="<?php echo $singleWebinar->image; ?>"/>
                        <div class="past-webinar-details webinar-heading">
                            <h3><a href="<?php echo $singleWebinar->url; ?>"><?php echo $singleWebinar->post_title; ?></a></h3>
                            <h5><span><?php echo $webdate; ?> </span> <span><?php the_field('time', $singleWebinar->ID); ?></span></h5>
                            
                            <h5>
                               <a onclick="window.location.href = '<?php echo $singleWebinar->url?>'"> <button class="btn home-page-btn" onclick="window.location.href = '<?php echo $singleWebinar->url?>'"><?php echo $text; ?></a></button>
                            </h5>
                        </div>
                    </a>

                </div>

            </div>
        <?php } ?>
    </div>
        </div>
     
    </div>
  </div>
</div>
</section>	
<!--top webinar section end-->								
<!--blog right image and left text section start-->
<?php
 //$posterblog1data = get_the_title($post_meta['feature_blog1'][0]);
//$posterblog2data = get_the_title($post_meta['feature_blog2'][0]);
//
//if ($posterblog1data) {
//    $clientblog1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['feature_blog1'][0], 'large'));
//    $clientblog1Link = get_permalink($post_meta['feature_blog1'][0]);
//    $clientblog1Writer = get_field('writer', $post_meta['feature_blog1'][0]);
//}
//if ($posterblog2data) {
//    $clientblog2Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post_meta['feature_blog2'][0], 'large'));
//    $clientblog2Link = get_permalink($post_meta['feature_blog2'][0]);
//    $clientblog2Writer = get_field('writer', $post_meta['feature_blog2'][0]);
//}
//
//if (isset($posterblog1data) && !empty($posterblog1data)) {
$post2 = get_field('feature_blog', 'option');
//print_r($post2);
$blog1 = $post2[0];
$title1=$blog1->post_title;
$clientblog1Writer = get_field('writer', $post2[0]);
$clientblog1Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post2[0], 'large'));
$blog1date = $post2[0]->post_date;
$newDate1 = date("F j Y", strtotime($blog1date));
$blog1Link = get_permalink($blog1);

$blog2 = $post2[1];
$title2=$blog2->post_title;
$clientblog2Writer = get_field('writer', $post2[1]);
$clientblog2Image = get_the_post_thumbnail_src(get_the_post_thumbnail($post2[1], 'large'));
$blog2date = $post2[1]->post_date;
$newDate2 = date("F j Y", strtotime($blog2date));
$blog2Link = get_permalink($blog2);


    ?>

    <section class="f-fix past-webinar-main-wrapper grey-bg reorder-first-blog" id="past-webinar-main-wrapper">
        <div class="space pd-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-sm-12">
                        <div class="blog-box-modal-left">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-12">
                                    <div class="small-line"></div>
                                </div>
                                <div class="col-md-11 col-sm-12">
                                    <div class="blog-name">
                                        <span>Blog</span>
                                    </div>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="blog-heading">
                                            <h3><?php echo $title1; ?></h3>
                                        </div>
                                        <div class="blog-details">
                                            
                                                <p>
                                                    Written by <?php echo $clientblog1Writer[0]->post_title; ?>
                                                </p>
                                               
                                                <p>
                                                    <!--June 01, 2017--><?php echo $newDate1;?>
                                                </p>
                                            </div>
                                            <div class="blog-submit">
                                                <button class="btn blog-submit-btn" onclick="window.location.href = '<?php echo $blog1Link?>'">Read Article</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="blog-right-image">
                                <img src="<?php echo $clientblog1Image; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <!--blog right image and left text section end-->


    <!-- blog section right text start-->
    <!--blog right image and left text section start-->
 
    <section class="f-fix past-webinar-main-wrapper grey-bg reoder-blog" id="past-webinar-main-wrapper">
        <div class="space pd-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="blog-left-image">
                            <img src="<?php echo $clientblog2Image; ?>"/> 
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-sm-12">
                        <div class="blog-box-modal-right">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-12">
                                    <div class="small-line"></div>
                                </div>
                                <div class="col-md-11 col-sm-12">
<div class="right-blog-text">
                                    <div class="blog-name">
                                        <span>Blog</span>

                                    </div>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="blog-heading">
                                            <h3><?php echo $title2; ?></h3>
                                        </div>
                                        <div class="blog-details">
                                            
                                            <p>
                                                Written by <?php echo $clientblog2Writer[0]->post_title; ?>
                                            </p>
                                            
                                            <p>
                                                <!--June 01, 2017--><?php echo $newDate2;?>
                                            </p>
                                        </div>
                                        <div class="blog-submit">
                                            <button class="btn blog-submit-btn" onclick="window.location.href = '<?php echo $blog2Link?>'">Read Article</button>
                                        </div>
                                    </div>
</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="fnp-box-right"><div class="fnp-content-right" style="right: -235px;"><div class="fnp-content-border"></div><div class="fnp-nav-title" style="opacity: 0;">Next article</div><div class="fnp-nav-link" style="opacity: 0;">Is Objective-C's NSMutableArray thread-safe?</div></div></div>
    </section>

#127.0.0.1        localbeta.synerzip.com

<!-- blog section right text end-->		
<?php
get_footer();
?>

<style>
.blog-heading {
    margin-left: 0%;
    margin-right: 14%;
}
a.right.carousel-control {
    margin-right: -3%;
}
p {
    font-weight: 100;
    margin-right: 10%;
    font-size: 16px;
}

a.left.carousel-control {
    margin-left: -3%;
}
.small-line1 {
    background-color: #fed426;
    height: 50px;
    width: 100%;
    float: left;
    margin-top: 20px;
    margin-right: 15px;
}

.col-md-6.col-sm-12.col-xs-12.big_con {
    display: flex;
} 

.small-line2 {
    margin-bottom: 60%;
    margin-left: 104%;
    height: 25px;
    width: 15%;
  background-color: #fed426;
}

.blog-name1 {
    float: left;
    width: 70%;
    margin-left: 166%;
    font-size: 21px;
    margin-top: -5%;
}

.banner-btn1{
color: black;
    font-family: Roboto;
    font-size: 16px !important;
    font-weight: 500 !important;
    line-height: 26px !important;
    background: #fed426 !important;
    border: 1px solid #fff !important;
    border-radius: 0 !important;
    padding: 15px 20px !important;
text-transform: uppercase;}

a.left.carousel_left {
    margin-left: -9%;
}
</style>