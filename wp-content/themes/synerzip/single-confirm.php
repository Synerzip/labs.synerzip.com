<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

get_header();if (have_posts()) : while (have_posts()) : the_post(); 
the_field('ga_conversion'); ?>
<div id="main" class="titled">
	<?php the_content(); ?>
</div>
<?php endwhile; endif;  wp_reset_query(); 
get_footer(); ?>
