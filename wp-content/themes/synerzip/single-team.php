<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

get_header();if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="main" class="titled" style="margin-top: 4%;">
	<a href="/about/" class="back">&laquo; Back</a>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
</div>
<?php endwhile; endif;  wp_reset_query(); 
get_footer(); ?>
