<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 * Template Name: Clients
 */

get_header(); 
$args = array( 
	'post_type' => 'strips', 
	'p' => '27526', 
	); 
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="strip-<?php if(get_field('strip_id')) { the_field('strip_id'); } else { echo $post->ID; } ?>" class="strip">
		<?php the_content(); ?>
	</div>
<?php endwhile; endif;  wp_reset_query(); 

if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="main">
	<?php the_content(); ?>
</div>
<?php endwhile; endif;  wp_reset_query(); 
get_footer(); ?>
