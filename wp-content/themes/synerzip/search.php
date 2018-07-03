<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */
//echo "mmmm";exit;


get_header();
// print_r($siq_plugin);
if(isset($siq_plugin) && is_object($siq_plugin))
{
  $resultCount = $siq_plugin->totalResults;
}
else
{
  $resultCount = $wp_query->found_posts;
}
  $resultCount = $resultCount ? $resultCount : '0';
?>





<section class="f-fix banner-wrapper" >
  <div class="container v-align">
    <div class="banner-text text-center">
      <p class="typing"><noscript>Search results for '<?php echo $s ?>'</noscript></p>
      <p class="num-results"><?php echo  $resultCount;?> results</p>
    </div>
    <div class="clear"></div>           
    </div>
</section>


    <!--banner section start-->


        <!--banner section end-->


        <!--search-result-content-start-->        

<section class="f-fix search-result-wrapper" id="search-result-wrapper">
  <div class="container push-down-3">
    <div class="text-content-block">
   <?php if (have_posts()) { 
		while (have_posts()) : the_post(); 
		$post_type = get_post_type( $post->ID );
		?>
		<div class="results">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <span class="search-type"><?php echo $post_type; ?></span>
        <p><?php the_excerpt(); ?></p>
      </div>
     <?php 
						 endwhile;    } 
            else {
            ?>
               <div class="results">
                <h2>We’re sorry, but your search didn’t return any results.</h2>
                <p>
                    Here are some search suggestions:
                </p>
                <ul class="bulletlist">
                  <li>Check your spelling.&nbsp;<br></li>
                  <li>Try different keywords.<br></li>
                  <li>Try more general words.<br></li>
                </ul>
                <p> Or alternatively you can simply <a href="/contact">ask us</a>.</p>
                <!-- <p>Or alternatively you can simply <a href="/contact-us">ask us</a>.</p> -->
               </div>
            <?php
      } // end :: if
		
		?>
		 <?php 
    if(isset($siq_plugin) && is_object($siq_plugin))
    {
      pagination_iqsearch( $siq_plugin, $wp_query );
    }
    else
    {
      pagination( $wp_query, get_option('home') . '/' ); 
    }
     ?>
    </div>
  </div>
</section>

        <!--search-result-content-end-->
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


<?php get_footer(); ?>
