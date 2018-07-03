<?php
get_header(); 
 ?>
        <!--blog-banner-section-start-->
<?php 
global $post;
$author = get_post_meta($post->ID,'author',true);
 $storyType = get_the_terms($post->ID, 'story_type');
$post_meta = get_post_meta($post->ID, 'writer');

 $author_information = $post_meta['writer_information'][0];
$author_linkedin= $post_meta['linkedin_url'][0];
$author_twitter= $post_meta['twitter_url'][0];

$author_title=get_post_meta($post->ID, 'title', true);
 $img_src= get_field('writer_image')['url'];
$author_title = get_field( $writer['title'] );

if(isset($storyType) && $storyType[0]->name=='Testimonials')
{
    // pullinvideo
$videoUrl = get_post_meta($post->ID, 'vedio', true);// pulling videourl from custom field.
//print_r($videoUrl);exit;
if (isset($videoUrl)) {
    $videourl = wp_oembed_get($videoUrl);
    preg_match('/src="([^"]+)"/', $videourl, $match);
    $videourl = $match[1];  
}    
}
$taxonomies=array("value","practice","technology");
$terms = wp_get_object_terms($post->ID,$taxonomies);
$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner');
if(isset($large_image_url) && !empty($large_image_url) && $large_image_url[0]!='')
{
	
	$bannerImage=$large_image_url[0];
}
else
$bannerImage='/wp-content/themes/synerzip/beta_images/singleblog.jpg';
$writers = get_field('writer',$post->ID);
//echo'<pre>';print_r($writer);
if(count($writers) >1)
{
foreach($writers as $singleWriter )
{
	
	$writer.=$singleWriter->post_title . ", ";	
}
$writer="Thanks to ".rtrim($writer,', ');
}
else{
if(isset($writers[0]->post_title))
$writer='Thanks to '.$writers[0]->post_title;
}
$arrHashtag=array();
foreach($terms as $term)
{
$arrHashtag[]=$term->slug;
	  $term_link = get_term_link( $term );
                $techLink=esc_url( $term_link );
$hashtag.='<a href='.$techLink.'><li>'.$term->slug.'</li></a>';
}

	?>
<section class="f-fix blog-banner-wrapper push-down-1" id="blog-banner-wrapper">
  <div class="container">
    <div class="blog-title blog-align">
      <h1><?php echo $post->post_title;?></h1>
      <p>Published on <?php $date = new DateTime($post->post_date);echo $date->format('j M Y');?></p>
	<!--<div><a href="https://twitter.com/Synerzip"><i class="fa fa-twitter" aria-hidden="true"></i></a></div>
    </div>-->
  </div>
    <?php 
    if(isset($videourl) && $videourl!='')
    {
        ?>
 <div class="past-webinar-video-wrapper" style="margin-top:12px">
                <div class="video-cover-common no-shaddow" onclick="thevid = document.getElementById('thevideo'); thevid.style.display = 'block'; this.style.display = 'none'">

<center><img width="804" height="453" src="<?php bloginfo('template_url'); ?>/beta_images/video-cover.png" /></center>
<img class="youtube-play-icon" src="/wp-content/themes/synerzip/beta_images/youtube_play.png">
</div>

                <div id="thevideo" style="display: none;"> <center>  <iframe id="youtube-video" width="806" height="454" src="<?php echo $videourl; ?>" frameborder="0" allowfullscreen></iframe></center></div>
            </div>
   <?php     
    }
    else{ ?>
    
  <div class="container-fluid no-padding">
    <div class="full-img-wrap">
      <img src="<?php echo $bannerImage; ?>">
    </div>
  </div>
    <?php }?>
  <div class="container">
	  <div class="blog-details blog-align">
	<div style="padding-bottom:20px;"><?php the_content();?></div>
<?php if(get_field('writer')) { ?>
					<div class="writer-block">
						<h3>About the Writer</h3>
						<?php $post_objects = get_field('writer');
						
						if( $post_objects ): ?>
							<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
								<?php setup_postdata($post); ?>
						
<div class="author_personal_image"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
									
									<h3><?php the_title(); ?></h3>
									<h4><?php the_field('title'); ?></h4>
									<p><?php the_content(); ?></p>

<?php $post_objects_linkedin = get_field('linkedin_url');
						
						if( $post_objects_linkedin ): ?>
										
						<a href="<?php the_field('linkedin_url'); ?>" target="_blank"><i style="font-size:15px;" class="fa fa-linkedin" aria-hidden="true"></i></a>
					<?php endif; ?> 
					
					<?php $post_objects_twitter = get_field('twitter_url');
						
						if( $post_objects_twitter ): ?>
			  <a href="<?php the_field('twitter_url'); ?>" target="_blank"><i style="font-size:15px;" class="fa fa-twitter" aria-hidden="true"></i></a>
			<?php endif; ?> 
				
							<?php endforeach; ?>
					
							<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
						<?php endif; ?> 
					</div>
					<?php } ?>
			
<div class ="comment">
  	<?php comments_template() ?>
  </div>
      <ul class="blog-tags">
       <?php echo $hashtag;?>
       
      </ul>
	  </div>
	 
  </div>
  
  

</section>

        <!--blog-banner-section-end-->

        <!--more-blogs-start-->  
<?php
$condition=array();
			$condition['post_type']='blog';
			$condition['posts_per_page']='3';
			$condition['post__not_in'] =array($post->ID);
			$posts=fetch_rulequery($arrHashtag,$condition);
			$allPosts=$posts->posts;		
		?>

<section class="f-fix more-blogs-wrapper" id="more-blogs-wrapper">
  <div class="container">
	<h2>Related blogs</h2>
    <div class="row">
<?php
	foreach($allPosts as $singlePost)
	{
	$singlePost->url=get_permalink($singlePost->ID);
			$singlePost->time= estimate_reading_time($singlePost->post_content);
            $singlePost->image= get_the_post_thumbnail_src(get_the_post_thumbnail( $singlePost->ID));
            if(!isset($singlePost->image) || $singlePost->image=='')
			$singlePost->image='/wp-content/themes/synerzip/beta_images/placeholder.png';
		?>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-img">
           <a href="<?php echo $singlePost->url;?>"><img src="<?php echo $singlePost->image;?>"></a>
          </div>  
          <div class="card-details">
            <a href="<?php echo $singlePost->url;?>"><h5><?php echo $singlePost->post_title;?></h5></a>
            <p><?php wp_trim_words($singlePost->post_content,60);?></p>
            <div class="card-action push-down-5">
              <span><?php echo $singlePost->post_date;?></span>
              <span class="right"><?php  echo $singlePost->time;?></span>
            </div>
          </div>  
        </div>
      </div>
		<?php }?>
		
    </div>
  </div>
</section>
<style>
.search-content .form-control {
    background: transparent;
    border: 0;
    border-bottom: 1px solid black;
    border-bottom-left-radius: 1px;
    color: black;
    box-shadow: none;
}

.btn-default-search {
    color: black;
    background-color: transparent;
    border-color: transparent;
}
.search-content .form-control:focus{
    box-shadow:none;
    border-color:transparent;
    border-bottom:1px solid black;
}
.form-control{
		display: block;
	    width: 100%;
	    height: 25px;
	    padding: 6px 12px;
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #555;
	    background-color: #fff;
	    background-image: none;
	    border-radius: 0px;
	    border: 1px solid #ccc;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
	    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}



</style>

        <!--more-blogs-end-->          

        <!--footer-section-start--> 
<?php
get_footer(); 
?>
        <!--footer-section-end-->
 

