<?php
get_header(); 
global $post;
$condition=array();
$condition['post_type']='news';
$condition['posts_per_page']='-1';
$passhash='showAll';
$stories=fetch_rulequery($passhash,$condition);

//echo "<pre>";print_r($stories);
$Allstories=$stories->posts;
$countStory=count($Allstories);
 $bannerImage = '/wp-content/themes/synerzip/beta_images/blogpagebanner.png';

/*<img src="<?php echo $clientImage; ?>">
//$terms=getParentandChildTaxonomy('practice');*/
?>
<section class="f-fix popular-event-wrapper push-down-6" id="popular-event-wrapper">
    <div class="container">
  <div class="page-intro-block" >
      <p>Know where the latest and greatest in tech is happening. Synerzip helps you stay informed by actively participating and promoting leading industry events that matter.
      </p>
    </div>
	<div class="row">
            <?php
            for ($i = 0; $i < $countStory;$i++) {
                $clientImage = get_the_post_thumbnail_src(get_the_post_thumbnail($Allstories[$i]->ID, 'medium'));
                $clientLink = get_permalink($Allstories[$i]->ID);	
					$image = get_field('feature_images', $Allstories[$i]->ID);
                   $news->image = get_the_post_thumbnail_src(get_the_post_thumbnail($Allstories[$i]->ID));
                ?>
				<div class="col-sm-4 push-down-3">
        <div class="card">
          <div class="card-img">
         <?php  if(isset($news->image)!='')
{?>
			 <a href="<?php echo $clientLink; ?>"><img src="<?php echo  $news->image; ?>"></a>


<?php } 
  else{ ?>

<a href="<?php echo $clientLink; ?>"><img src="<?php echo   $bannerImage; ?>"></a>
<?php } ?>
          </div>  
          <div class="card-details">
            <a href="<?php echo $clientLink; ?>"><h5 class="card-title"><?php echo wp_trim_words($Allstories[$i]->post_title,10); ?></h5></a>
          </div>  
        </div>
      </div> 
			<?php } ?>
         </div>
        </div> 
  <div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/news">News</a></h4>
				<div class="arrow">	
					<a href="/news"><img src="../wp-content/uploads/2017/11/skype.png"></a>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
.card-title
{
font-size: 25px;
color: black;
}
.popular-event-wrapper .card-img img
{
	width: 100%;
height: 100%;
}
</style>
<?php
get_footer(); 

//$terms=getParentandChildTaxonomy('practice');
?>