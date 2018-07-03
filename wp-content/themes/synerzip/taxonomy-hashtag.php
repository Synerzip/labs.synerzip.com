<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

get_header(); ?>
<div id="main">
	<div class="vc_row">
	<?php if (have_posts()) : ?>
		<h2><?php single_cat_title(); ?></h2>

		<?php while (have_posts()) : the_post(); 
		$post_type = get_post_type( $post->ID );
		if($post_type == 'post') { $post_type = 'News & Insights'; }
		if($post_type == 'page') { $post_type = ''; }
		?>

        <div <?php post_class('search-result') ?>>
            <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <small><?php echo $post_type; ?></small></h4>
            <?php the_excerpt(); ?>
        </div>

		<?php endwhile; ?>

		 <?php pagination( $wp_query, "/" ); ?>

	<?php else : ?>

		<h2>No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?> 
	</div>
</div>
<?php get_template_part( 'template', 'strip' ); ?>
<?php get_footer(); ?>

