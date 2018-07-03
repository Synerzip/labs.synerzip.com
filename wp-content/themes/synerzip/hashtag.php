<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 * Template Name: Clients
 */
global $wp_query;
get_header('taxonomy');
$queried_object = $wp_query->get_queried_object();
//echo "<pre>";print_r($queried_object);
if(is_tax())
{
	$queried_object = $wp_query->get_queried_object();
	if(isset($queried_object->name))
	$hashtag=$queried_object->name;
}
elseif( is_page( 'hashtag-homepage' ))
{
 
 $post_object = get_field('hashtagged_home_page', 'option');
 if(isset($post_object->name))
 $hashtag=$post_object->name;
}
else
{
	$hashtag="";
	$errormsg="Wrong route! Pleae select hashtag";
}
//print_r($hashtag);
if(isset($hashtag))
{
$arrhashtag[] = $hashtag;
}
		$condition=array();
		$condition['post_type']='webinar';
		$condition['taxonomy']='schedule';
		$condition['posts_per_page']='5';
		$condition['description_limit']=5000;
		$condition['reading_time']=1;
		$condition['tax_query'] = array('relation' =>'AND');
		$taxnomyArr=array('taxonomy' => 'hashtag','field'    => 'slug','terms'    => $arrhashtag);
		array_push($condition['tax_query'],$taxnomyArr);
		$webinar=hashtagged_content($condition);
//echo "<pre>";print_r($webinar);
if(isset($webinar) && isset($webinar['upcoming']))
{
	$upcoming_webinar=$webinar[$webinar['upcoming_webinar_id']];
	unset($webinar[$webinar['upcoming_webinar_id']]);
	unset($webinar['upcoming_webinar_id']);
	unset($webinar['upcoming']);
}
$countOfWebinar=count($webinar);
//show only even number of webinars, else remove bottom one
if($countOfWebinar%2==1)
{
array_pop($webinar);	
}
if(isset($upcoming_webinar) && !empty($upcoming_webinar))
{
?>
                <!--header section end-->

                <!--hashtag-banner-section-start-->

<section class="f-fix hashtag-banner-wrapper" id="hashtag-banner-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-xs-12 no-paddingR">
        <div class="banner-content">
          <p class="event-type">Webinar</p>
          <h1 class="event-name"><?php echo $upcoming_webinar['title'];?></h1>
          <p class="event-time"><?php echo $upcoming_webinar['ShowWebinarDate'];?> <?php echo $upcoming_webinar['time'];?></p>
          <p class="event-desc"><?php echo trim(trim_content($upcoming_webinar['description'],200));?></p>
          <div class="event-btn-container">
		            <button  onclick="location.href='<?php echo $upcoming_webinar['url'];?>'" class="btn event-register-btn">Register</button>
           <!-- <button class="btn event-more-btn">Learn more</button> -->
          </div>
        </div>
      </div>
      <div class="col-sm-6 hidden-xs no-paddingL">
        <div class="banner-image"><img src='<?php echo $upcoming_webinar['sb_thumb']; ?>'></div>
      </div>
    </div>
  </div>
</section>
<?php
}
?>
                <!--hashtag-banner-section-end-->

                <!--popular-on-synerzip-section-start-->

<section class="f-fix popular-event-wrapper push-down-3" id="popular-event-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="section-title">
          <h4>Popular on Synerzip</h4>
          <hr/>
        </div>
      </div>
    </div>
	  <div class="event-cards">
  <?php
	  if(isset($webinar) && !empty($webinar))
	  {
		$counter=1;		  
		  foreach($webinar as $webKey=>$webValue)
		  {
			 if($counter!=1)
$appendClass="push-down-3";				 
			   if($counter >0 && $counter%2==1)
				 {
				 ?>
		   <div class="row <?php echo $appendClass;?>"  >
		  <?php
				 }
			  ?>
        <div class="col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-img">
              <img src="<?php echo $webValue['sb_thumb']; ?>">
              <div class="card-event"><?php echo $webValue['post_type']; ?></div>
            </div>
            <div class="card-details">
              <h5 class="card-title"><?php echo $webValue['title'];?></h5>
              <div class="card-desc"><?php echo trim_content($webValue['description'],200);?></div>
              <ul class="card-action push-down-6">
                <li><?php echo $webValue['reading_time'];?></li>
                <li class="right"><a href="<?php echo $webValue['url'];?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
  	<?php
			  
			   if($counter >0 && $counter%2==0)
				 {
				 ?>
		  </div>
		  <!---<div class="row push-down-3">-->
		  <?php
			  }
			  $counter++;
		  }}
				  ?>
      </div>
		  <div class="row push-down-3">
<?php
		  	$condition=array();
		$condition['post_type']='post';
		//$condition['taxonomy']='schedule';
		$condition['description_limit']=5000;
		$condition['reading_time']=1;
		$condition['posts_per_page']='10';
		$condition['tax_query'] = array('relation' =>'AND');
		$taxnomyArr=array('taxonomy' => 'hashtag','field'    => 'slug','terms'    => $arrhashtag);
		array_push($condition['tax_query'],$taxnomyArr);
		$blog=hashtagged_content($condition);
			  //echo "blogs";print_r($condition);print_r($blog);
		$countOfBlogs=count($blog);	  
		if($countOfBlogs%2==1)
		{
		array_pop($blog);	
		}
			   if(isset($blog) && !empty($blog))
	  {
			  $blogCounter=1;
		  foreach($blog as $blogKey => $blogValue)
		  {
			   if($blogCounter >1 && $blogCounter%2==1)
				 {
				 ?>
		   <div class="row push-down-3">
		  <?php
				 }
		  ?>
        <div class="col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-img">
              <img src="<?php echo $blogValue['sb_thumb'];?>">
              <div class="card-event">blog</div>
            </div>
            <div class="card-details">
              <h5 class="card-title"><?php echo $blogValue['title'];?></h5>
              <div class="card-desc"><?php echo trim_content($blogValue['description'],200);?></div>
              <ul class="card-action push-down-6">
                <li><?php echo $blogValue['reading_time'];?></li>
                <li class="right"><a href="<?php echo $blogValue['url'];?>"><i  class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        
     	  
	<?php
			  
			   if($blogCounter >0 && $blogCounter%2==0)
				 {
				 ?>
		  </div>
		  <!--<div class="row push-down-3">-->
		  <?php
			  }
			  $blogCounter++;
		  }}
				  ?>
    		   </div>
	
    </div>
 
</section>
        <!--popular-on-synerzip-section-end-->

                <!--client-stories-section-start-->
<?php
		  	$condition=array();
		$condition['post_type']='quote';
		//$condition['taxonomy']='schedule';
		$condition['posts_per_page']='10';
		$condition['description_limit']=5000;
		$condition['tax_query'] = array('relation' =>'AND');
		$taxnomyArr=array('taxonomy' => 'hashtag','field'    => 'slug','terms'    => $arrhashtag);
		array_push($condition['tax_query'],$taxnomyArr);
		$story=hashtagged_content($condition);
		$countOfStories=count($story);	  
		if($countOfStories%3!=0)
		{ 	$itemToRemove=$countOfStories%3;
			for($i=0; $i<$itemToRemove;$i++)
			{	
			array_pop($story);
			}
		}
	//echo $countOfStories;
	if(isset($story) && !empty($story))
	{
	
?>
<section class="f-fix client-stories-wrapper push-down-4" id="client-stories-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="section-title">
          <h4>
            <span>Client Stories</span>
            <a href="/clients/" class="more-link right">more<i  class="fa fa-angle-right" aria-hidden="true"></i></a>
          </h4>
          <hr/>
        </div>
      </div>
    </div>
    <div class="event-cards">
    	  <?php
		  	  $storyCounter=1;
		  foreach($story as $storyKey => $storyValue)
		  {
			   if($storyCounter >0 && $blogCounter%2==1)
				 {
				 ?>
		   <div class="row">
		  <?php
				 }
		  ?>
		  
        <div class="col-sm-4 col-xs-12">
          <div class="card">
            <div class="card-img">
              <img src="<?php echo $storyValue['sb_thumb'];?>">
              <div class="card-event"></div>
            </div>
            <div class="card-details">
             <!-- <h5 class="card-title"><?php echo $storyValue['title'];?></h5>-->
              <div class="card-desc"><?php echo trim_content($storyValue['description'],200);?></div>
              <ul class="card-action push-down-5">
                <li><span>In client stories</span><p><?php echo $storyValue['title'];?></p></li>
                <li class="right"><a href="<?php echo $storyValue['link_relavant_page'];?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
	<?php
			  
			   if($storyCounter >0 && $storyCounter%3==0)
				 {
				 ?>
		  </div>
		  <div class="row push-down-3">
		  <?php
			  }
			  $storyCounter++;
		  }
				  ?>
    	  
		  
		  
		  
   	</div>
    </div>
  </div>
</section>
	<?php
	}
	?>

                <!--client-stories-section-end-->

                <!--footer section start-->


	<?php
get_footer('taxonomy'); 
?>
