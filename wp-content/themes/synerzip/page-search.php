<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 *Template Name: search
 */

get_header(); ?>
<div class="shell">
	<div id="copy"> 

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			
			<h1 class="<?php echo $header?>"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<form role="search" method="get" id="site_search" action="<?php echo get_option('home'); ?>/" >
			    <input type="text" name="s" id="s" class="text" placeholder="Search Site" value="" />
			    <button id="search_submit" type="submit">Go</button>
			</form>
		</div>
		<?php endwhile; endif;  wp_reset_query(); ?>   
	</div> <!-- end copy -->


</div>

<?php get_footer(); ?>
