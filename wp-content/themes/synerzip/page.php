<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

get_header();if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="main">
	<?php the_content(); ?>
</div>
<?php endwhile; endif;  wp_reset_query(); 
get_footer(); ?>
