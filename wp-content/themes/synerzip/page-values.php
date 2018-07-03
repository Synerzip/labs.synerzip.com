<?php
get_header();
$terms = getParentandChildTaxonomy('value');
//$taxonomy="value";
?>
<!--banner section start-->
<!--
<section class="f-fix banner-wrapper" id="banner-wrapper">
    <div class="container">
        <div class="banner-text">
            <p class="typing"><noscript>Our Values</noscript></p>
        </div>
        <div class="banner-video">
            <div class="black-overlay"></div>
            <video autoplay loop class="fillWidth">
                <source src="<?php bloginfo('template_url'); ?>/beta_images/values.mp4" type="video/mp4">
            </video>
        </div>
        <div class="clear"></div>           
    </div>
</section>-->

<!--banner section end-->

<!--values section start-->		

<section class="f-fix values-main-wrapper grey-bg" id="values-main-wrapper">
    <div class="container">
 <div class="page-intro-block">
            <p id="value2">Our values are an integral part of our DNA! These are some values that guide our business, partnerships and relationships within!As Synerzip continues to evolve and grow, these values remain constant!
            </p>
        </div>
        <div id="grid" class="values-grid clearfix row push-down-6">
            <?php
  				$taxonomy="value";
$taxonomy_terms = get_terms( $taxonomy, 'orderby=ID&order=ASC&parent=0' );         
            foreach ($taxonomy_terms as $i => $term) {
                $term_id=$term->term_id;
				 $term_link = esc_url(get_term_link( $term));
                
				$thumbnail = get_field('image_poster', $taxonomy . '_' . $term_id);
                                
                                //exit;
				//$thumbnail_image=$thumbnail['sizes']['thumbnail'];
				$image = get_field('feature_images', $taxonomy . '_' . $term_id);
				$medium_image=$image['sizes']['medium'];
                echo "<a href='$term_link'> <div class='uc-container'>
                    <div class='uc-initial-content'>
                       <img src='$thumbnail' alt='$term->name' />
                        <!--span class='icon-eye'></span>-->
                        <div class='value-name'>
                            <p class='dash'></p>
                            <p class='value'>$term->name</p>
                        </div>

                    </div>
                    <div class='uc-final-content'>
                        <img src='$medium_image' alt='$term->name' />
                        <div class='description'>
                            <div class='value-name'>
                                <p class='dash'></p>
                                 <a href='$term_link'>
                                <p class='value'>$term->name</p>
                               </a>
                            </div>
                            <span>$term->description</span>
                        </div>
                        <span class='icon-cancel'></span>
                    </div>
                </div></a><!-- / uc-container -->";
            }
            ?>
        </div>
<!--        <div class="synerzip-life-wrapper">
            <div class="section-head text-center">
                <h2>CSR @Synerzip</h2>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="synerzip-life-video">
                        <div class="temp-life"> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="synerzip-life-video-thumb">
                        <li>
                            <div class="thumb-video"></div>
                        </li>
                        <li>
                            <div class="thumb-video"></div>
                        </li>
                        <li>
                            <div class="thumb-video"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->
<div class="container-fluid no-padding push-down-3">
    
      <div class="container">
        <div class="section-head">
          <h2></h2>
        </div>  
		  <?php 
		  $page = get_page_by_title('Life At Synerzip', OBJECT, 'page');
		  
		 if(isset($page) && $page->post_content!='')
		 {
			
			echo $page->post_content;  
		 	  }
			 else{
			 ?>
		   <div class="row">
          
         
        </div>
		  <?php }
		  ?>
      </div>
    </div>
  </div>
 
    </div>
    <div class="container-fluid no-padding">
	<!-- new -->
<div class="next-page-wrapper">

	<div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/careers">Careers</a></h4>
				<div class="arrow">	
					<a href="/careers"><img src="../wp-content/uploads/2017/11/skype.png">
				</div></a>
			</div>
	</div>
</div>
<!-- End -->    	


  </div>
</section>
                <style>
                    
                    .next-img{
                            align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
   
                    }
                    
                							

#value1{
color: #373A3C;
font-weight: 400;
font-size: 36px;
line-height: 48px;
}
#value2{
color: #4A4A4A;
font-size: 16px;
line-height: 26px;
}


.uc-initial-content
{
 -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}

.uc-initial-content:hover
{
 -webkit-filter: grayscale(0%);
    filter: grayscale(0%);
}
</style>
<!--values section end-->										

<!--footer section start-->


<?php get_footer(); ?>
