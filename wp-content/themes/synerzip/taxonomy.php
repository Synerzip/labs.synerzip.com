<?php
get_header();
?>

<?php 
	global $posts;
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
//echo "<pre>";prddint_r($term);exit;
$masterTax=0;
if($term->parent==0)
{$masterTax=1;

}
$pageTerm=$term->name;

	if(isset($posts))
	{
	  $webinarContent=array();
	 $quoteContent=array();
		
		foreach($posts as $keypost => $post)
		{
$hashtagExists=strstr($post->post_content, $pageTerm, true);
// comment below once aijaz is done with demo
//$hashtagExists=1;
			if(isset($hashtagExists) && $hashtagExists!='')
			{
			$post_type = get_post_type( $post->ID );
		if(isset($pageTerm))
			 $post->post_link = get_permalink( $post->ID ).'#'.$pageTerm;
		else
		$post->post_link = get_permalink( $post->ID );	
		$post->post_type= $post_type;
			$post->thumbnailurl= get_the_post_thumbnail_src(get_the_post_thumbnail( $post->ID ));
			if($post_type =='webinar' && $masterTax!=1)
			{
				$date = get_post_meta($post->ID,'date',true);
				$timestamp = $date . ' 20:00:00';
				$today = date("Y-m-d H:i:s");
				if (strtotime($timestamp) > strtotime($today) && empty($poster)) { 
				$poster=$post;
 				$poster->action="Register";
				unset($posts[$keypost]);
				}
				
				$webinarContent[$keypost]=$post;
			}
			elseif($post_type =='story')
			{
				
				$quote='';
			 	$quote = get_post_meta($post->ID,'quote',true);
				$client_name = get_post_meta($post->ID,'client_name',true);
				
				if(isset($quote) && !empty($quote))
				{
				$post->quote=$quote;
				$post->client_name=$client_name;
				$quoteContent[]=$post;
				}
			}
			else
			{
				$blogContent=$post;
			}
			
			}
		else
			{
				
				unset($posts[$keypost]);
			}	
		}
	
	}
if( $masterTax!=1)
{
	// if forthcoming webinar is not present, show old relevant webinar
	if(!isset($poster) && isset($webinarContent) && !empty($webinarContent))
	{    $webinarKeys=array_keys($webinarContent);
		 $poster=current($webinarContent);
	 	 $poster->action="Register";
		 unset($posts[$webinarKeys[0]]);
		// remove this from main posts blog
	}
	if(isset($poster))
	{
		$poster->webinarDate = get_post_meta($poster->ID,'date',true);
		$poster->webinarDate = date("F j, Y", strtotime($poster->webinarDate));
		$poster->description =wp_trim_words($poster->post_content,20);
		$poster->description = trim_content(preg_replace("#\[[^\]]+\]#", '', $poster->description),500);
		if(!isset($poster->action))
		$poster->action="Download";
	}
	else
	{
		// if  webinar is not present, show first relevant blog as poster
	$blogKeys=array_keys($blogContent);
	$poster=current($blogContent);
	$poster->action="Read More";
	if(isset($posts) && isset($posts[$blogKeys[0]]))
	unset($posts[$blogKeys[0]]);
	}
}
if((isset($poster) && $poster->post_type!='')  ||  $masterTax==1 )
{
if( $masterTax==1)
	{
		 $poster->post_type='';
		$poster->post_title="#".$term->name;
		$poster->description=wp_trim_words($term->description,90);
		$poster->thumbnailurl= get_field('feature_images', $term)['url'];
	}
if(!isset( $poster->thumbnailurl)|| ( $poster->thumbnailurl==''))
   $poster->thumbnailurl='/wp-content/themes/synerzip/beta_images/bighashtagplaceHolder.png';

?>
	
	<!--header section end-->
   
        <!--hashtag-banner-section-start-->

<section class="f-fix hashtag-banner-wrapper push-down-1" id="hashtag-banner-wrapper">
  <div class="container">
<div class="banner-and-text-half-column">
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        <div class="banner-content">
<?php if( $poster->post_type!=''){?>
          <p class="event-type"><?php echo $poster->post_type;?></p>
<?php } ?>
          <h1 class="event-name"><?php  echo str_replace(' ','',strtolower($poster->post_title));?></h1>
	<?php if(isset($poster->webinarDate))
{?>
          <p class="event-time"><?php echo $poster->webinarDate;?></p><?php }?>
          <p class="event-desc push-down-2"><?php echo $poster->description;?></p>
<?php if( $masterTax!=1){?>
          <div class="event-btn-container push-down-3">
            <a class="btn event-register-btn" href="<?php echo $poster->post_link;?>"><?php echo $poster->action;?></a>
          </div>
<?php }?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="banner-image">
          <img src="<?php echo $poster->thumbnailurl;?>">
        </div>
      </div>
    </div>
  </div>
</div>
</section>

        <!--hashtag-banner-section-end-->

                <!--popular-on-synerzip-section-start-->
<?php
} 
 if(isset($posts) && count($posts)>1) {?>
<section class="f-fix popular-event-wrapper push-down-4" id="popular-event-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="section-title">
          <h4>Popular on Synerzip</h4>
          <hr/>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <ul class="grid effect-2" id="grid">
			
		<?php foreach($posts as  $showContent)
		{
		//	echo "<pre>";print_r($showContent);exit;
			//$author = get_post_meta($showContent->ID,'author',true);
			//$writers = get_field('writer',$showContent->ID);
			if(count($writers) >1)
			{
			foreach($writers as $singleWriter )
			{	
				$writer.=$singleWriter->post_title . ", ";	
			}
			$writer=rtrim($writer,', ');
			}
			else{
			$writer=$writers[0]->post_title;
			}
			if(!isset($showContent->thumbnailurl) || $showContent->thumbnailurl==''){
			$showContent->thumbnailurl='/wp-content/themes/synerzip/beta_images/placeholder.png';
			}
		
		?>
      <li class="grid-item card">
        <div class="card-img">
			<a href="<?php echo $showContent->post_link; ?>"><img src="<?php echo $showContent->thumbnailurl;?>"></a>
			</div>
        <div class="card-details">
          <span class="event-type"><?php echo $showContent->post_type;?></span>
          <a style="color:black;"href="<?php echo  $showContent->post_link;?>"><h5 class="card-title"><?php echo $showContent->post_title;?></h5></a>
			<?php if(isset($writer) && !empty($writer)){ ?>
          <p>by <span><?php echo $writer;?></span></p><?php }?>
          <div class="card-action push-down-5">
          <span><?php echo $time;?></span>
          <span class="right"><a href="<?php echo  $showContent->post_link;?>"><i style="font-size:20px;padding-right: 10px;
    padding-bottom: 30px;" class="fa fa-long-arrow-right" aria-hidden="true"></i></a></span>
          </div>
        </div>
      </li>
    <?php } ?>

    </ul>
  </div>
</section>
<?php } 

?> 
                <!--popular-on-synerzip-section-end-->

                <!--client-stories-section-start-->
	<?php 
		  if(isset($quoteContent) && !empty($quoteContent)) {?>
<section class="f-fix client-stories-wrapper push-down-4" id="client-stories-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="section-title">
          <h4>Success Stories</h4>
          <hr/>
        </div>
      </div>
    </div>
    <div class="event-cards">
      <div class="row">
		  
	
		<?php 
		$quoteCounter=1;
	    $quoteCount=count($quoteContent);
			  $quoteContent = array_slice($quoteContent, 0, 3); 
		foreach($quoteContent as  $showQuote)
		{
if($quoteCounter==1 && $quoteCount==1)
{
	$addOffset="col-sm-offset-4";
	
}
elseif($quoteCounter==1 && $quoteCount==2)
{
	$addOffset="col-sm-offset-2";
}
else
{
	$addOffset='';
}
if(!isset( $showQuote->thumbnailurl)|| ( $showQuote->thumbnailurl==''))
   $showQuote->thumbnailurl='/wp-content/themes/synerzip/beta_images/placeholder.png';
			$quoteCounter++;
?>
        <div class="col-sm-4 <?php echo $addOffset;?> col-xs-12">
          <div class="card">
            <div class="card-img">
              <a href="<?php echo $showQuote->post_link;?>"><img src="<?php echo $showQuote->thumbnailurl;?>"></a>
            </div>
            <div class="card-details">
              <img src="<?php bloginfo('template_url'); ?>/beta_images/quote.png">
              <p class="card-desc"><?php echo $showQuote->quote;?></p>
              <ul class="card-action push-down-5">
                <li><span>In client stories</span><p><?php echo $showQuote->client_name;?></p></li>
                <li class="right"><a href="<?php echo $showQuote->post_link;?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div><?php
		}
									
		  ?>
      </div>
    </div>
  </div>
    
<?php }?>

  <div class="container-fluid no-padding">
	<div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/practice">Practices</a></h4>
				<div class="arrow">	
					<a href="/career"><img src="/wp-content/uploads/2017/11/skype.png"></a>
				</div>
			</div>
		</div>
	</div>

  

                <style>
                    
                    .next-img{
                            align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
   
                    }
.next-page-wrapper {
    padding: 70px;
    margin-top: 150px;
    background-color: #ffd21b;
    float: left !important;
    width: 100%;
}
</style>

                <!--client-stories-section-end-->

                <!--footer-section-start-->                
<?php
get_footer();
?>
