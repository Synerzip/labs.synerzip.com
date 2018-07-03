<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */
?>
<div id="sidebar">
	<?php $args = array( 
		'post_type' => 'strips', 
		'p' => '27313', 
		); 
	query_posts($args);
	if (have_posts()) : while (have_posts()) : the_post();
		the_content();
	endwhile; endif;  wp_reset_query();  ?>
</div>  <!-- /sidebar -->