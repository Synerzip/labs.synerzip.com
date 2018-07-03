<?php 
get_header('beta'); 
global $post;
	$post_meta=get_post_meta($post->ID);
$video=$post_meta['video'][0];
//echo "<pre>";print_r($post_meta);
$accomplishment1_title=$post_meta['accomplishment1_title'][0];
$accomplishment1_description=$post_meta['accomplishment1_description'][0];	
$accomplishment2_title=$post_meta['accomplishment2_title'][0];
$accomplishment2_description=$post_meta['accomplishment2_description'][0];	
$accomplishment3_title=$post_meta['accomplishment3_title'][0];
$accomplishment3_description=$post_meta['accomplishment3_description'][0];	
$accomplishment4_title=$post_meta['accomplishment4_title'][0];
$accomplishment4_description=$post_meta['accomplishment4_description'][0];	
$countaccompleshements=4;
$counter=0;
for($i=1;$i<=$countaccompleshements ;$i++)
{
	 $title='accomplishment'.$i.'_title';
	
	if(isset($$title) && $$title!='')
	$counter++; 
	
}


if($counter==4)
$accomplishmentClass='col-sm-3';
elseif($counter==3)	
$accomplishmentClass='col-sm-4';	
elseif($counter==2)	
$accomplishmentClass='col-sm-6';	
?>

<section class="grid-lines-wrapper">
	<div class="grid">
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
	<figure class="active-menu" data-percent="100">
		<svg width="15" height="55">
			<line class="line" x1="6" y1="0" x2="6" y2="45" stroke-width="2px" />
			<circle class="circle" cx="141" cy="6" r="2.5" transform="rotate(-90, 95, 95)"/>
		</svg>
	</figure>
</section>

								<!--banner section end-->
								
								<!--client-intro section start-->

<section class="f-fix client-intro-wrapper" id="client-intro-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6 no-paddingR paddingR-sm-reset">
				<div class="shadow-box"></div>
				<div class="client-intro-left-block content-box">
				<?php echo $post->post_content;?>
				</div>
			</div>
			<div class="col-md-6 no-paddingL paddingL-sm-reset">
				<div class="shadow-box"></div>
				<div class="client-intro-right-block content-box">
					<div class="client-intro-content">
						<iframe src="<?php echo $video;?>" frameborder="0" allowfullscreen></iframe>
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
					<?php for($i=1;$i<=$counter;$i++){
	  $title='accomplishment'.$i.'_title';
	  $description='accomplishment'.$i.'_description';?>				
					<div class="<?php echo $accomplishmentClass; ?> ">
						<div class="counter-block text-center">
							<p class="digit-block"><span class="counter-value" data-count="<?php echo $$description  ;?>"><?php echo ($$description *(90/100));?></span><sub>%</sub></p>
							<p class="text-block"><?php echo $$title;?></p>
						</div>
					</div>
					<?php }?>
				
				</div>
			</div>
		</div>
		<div class="clear"></div>           
    </div>
</section>

								<!--accomplishment section end-->								
																
								<!--client-exp section start-->
<?php
$taxonomies=array("value","practice","technology");
$terms = wp_get_object_terms($post->ID,$taxonomies);
$arrHashtag=array();
foreach($terms as $term)
{
				$arrHashtag[]=$term->slug;
}
$condition=array();
$condition['post_type']='story';
$condition['posts_per_page']='1';
$condition['description_limit']=5000;
$condition['post__not_in'] =array($post->ID);
$condition['fields'] ='ids';
$quote=fetch_rulequery($arrHashtag,$condition);
$quoteId=$quote->posts[0];
$clientQuote = get_post_meta($quoteId,'quote',true);
$clientImage= get_the_post_thumbnail_src(get_the_post_thumbnail( $quoteId,'medium' ));

?>
<section class="f-fix client-exp-wrapper" id="client-exp-wrapper">
	<div class="container-fluid no-padding">
		<!--div class="row">
			<div class="col-md-offset-1 col-md-5 no-paddingR"-->
				<div class="client-exp-left-block scroll-frame">
					<div class="client-exp-content">
						<img src="<?php echo $clientImage; ?>"/>
					</div>
				</div>
			<!--/div>
			<div class="col-md-6 no-padding"-->
				<div class="client-exp-right-block scroll-frame">
					<div class="client-exp-content theme-color">
						<p class="push-down-2"><?php echo $clientQuote; ?></p>
					</div>
				</div>
			<!--/div-->
		</div>
		<div class="clear"></div>           
    </div>
</section>

								<!--client-exp section end-->
																								
								<!--webinar section start-->
<?php 
$condition=array();
$condition['post_type']='webinar';
$condition['posts_per_page']='1';
$condition['description_limit']=5000;
//$condition['fields'] ='ids';
$webinar=fetch_rulequery($arrHashtag,$condition);
$webinarTitle=$webinar->posts[0]->post_title;
$webinarId=$webinar->posts[0]->ID;
$webinageDate = get_post_meta($webinarId,'date',true);
$webinageTime = get_post_meta($webinarId,'time',true);
$clientImage= get_the_post_thumbnail_src(get_the_post_thumbnail( $webinarId,'medium' ));
$today = strtotime(date("Y-m-d H:i:s"));
$webinarLink=get_permalink($webinarId);
if ($date < $today) 
{
	$text="Download Now";
}
else
{
	$text="Register Now";
}
?>
<section class="f-fix webinar-wrapper" id="webinar-wrapper">
	<div class="webinar-left-block scroll-frame">
		<div class="webinar-content">
			<div class="bg-block">
				<div class="img-block">
					<img src="<?php echo $clientImage; ?>" />
				</div>
			</div>
		</div>
	</div>
	<div class="webinar-right-block social-block scroll-frame">
		<div class="webinar-content social-content">
			<h4>WEBINAR</h4>
			<h2><?php echo $webinarTitle;?></h2>
			<div class="time">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<span><?php echo $webinageTime;?> / <?php echo $webinageDate;?></span>
			</div>
			<button class="btn push-down-3 theme-color"><a href="<?php echo $webinarLink;?>"><?php echo $text;?></a></button>
		</div>
	</div>
	<div class="clear"></div>
</section>

								<!--webinar section end-->
								
								<!--blog section start-->
<?php 
$condition=array();
$condition['post_type']='post';
$condition['posts_per_page']='1';
//$condition['fields'] ='ids';
$blog=fetch_rulequery($arrHashtag,$condition);
$blogTitle=$blog->posts[0]->post_title;
$blogId=$blog->posts[0]->ID;
$blogImage= get_the_post_thumbnail_src(get_the_post_thumbnail( $blogId,'medium' ));
$blogLink=get_permalink($blogId);
$blogWriter = get_field('writer',$blogId);
?>

<section class="f-fix blog-wrapper" id="blog-wrapper">
	<div class="blog-left-block scroll-frame">
		<div class="blog-content">
			<div class="bg-block">
				<div class="img-block">
					<img src="<?php echo $blogImage;?>" />
				</div>
			</div>
		</div>
	</div>
	<div class="blog-right-block social-block scroll-frame">
		<div class="blog-content social-content">
			<h4>Blog</h4>
			<h2><?php echo $blogTitle;?></h2>
			<div class="time">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<span>by <?php echo $blogWriter[0]->post_title;?></span>
			</div>
			<button class="btn push-down-3 theme-color">Read Article</button>
		</div>
	<div>
	<div class="clear"></div>           
</section>

								<!--blog section end-->
								
								<!--footer section start-->

<section class="f-fix footer-wrapper theme-color" id="footer-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-push-6 scroll-frame">
				<div class="contact-block">
					<div class="partner-us text-center">
						<h3>Want to partner with Synerzip?</h3>
						<button class="btn push-down-4 theme-color">Contact Me</button>
						<p>** We don’t send any spams</p>
					</div>
					<div class="logo-block">
						<div class="col-sm-6 no-paddingR paddingR-sm-reset text-right">
							<img src="<?php bloginfo('template_url'); ?>/beta_images/inc5000.png" class="inc-logo" title="Inc5000" alt="Inc5000" />
						</div>
						<div class="col-sm-6 no-paddingL paddingL-sm-reset text-left">
							<img src="<?php bloginfo('template_url'); ?>/beta_images/logo-o.svg" class="syn-logo" title="Synerzip" alt="Synerzip" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-md-pull-6 no-padding scroll-frame">
				<div class="links-block clearfix">
					<div class="col-sm-4">
						<ul class="link-list">
							<li><label>Our Expertise</label>
								<ul>
									<li><a href="#">Technologies</a></li>
									<li><a href="#">Offerings</a></li>
									<li><a href="#">Lean UX</a></li>
								</ul>
							</li>
							<li><label>Success Stories</label>
								<ul>
									<li><a href="#">Case Studies</a></li>
									<li><a href="#">Clients</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul class="link-list">
							<li><label>Best Practices</label>
								<ul>
									<li><a href="#">Agile DNA</a></li>
									<li><a href="#">Continuous Engagement</a></li>
									<li><a href="#">Trusted Partner</a></li>
									<li><a href="#">Talent Grooming</a></li>
								</ul>
							</li>
							<li><label>Our Team</label>
								<ul>
									<li><a href="#">Executive Team</a></li>
									<li><a href="#">Leadership Team</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul class="link-list">
							<li><label>Career</label>
								<ul>
									<li><a href="#">Current Openings</a></li>
									<li><a href="#">Employee Benefits</a></li>
									<li><a href="#">Company Culture</a></li>
								</ul>
							</li>
							<li class="single-link"><label>Webinar</label></li>
							<li class="single-link"><label>Blog</label></li>
							<li class="single-link"><label>Contact</label></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="rights-reserved text-center push-down-3">
					<p>© 2017 Synerzip, Inc. All Rights Reserved.  //  <a href="#">Privacy Policy</a>  //  <a href="#">Disclaimer</a></p>
				</div>
			</div>
		</div>
		<div class="clear"></div>           
    </div>
</section>

								<!--footer section end-->
</body>
</html>