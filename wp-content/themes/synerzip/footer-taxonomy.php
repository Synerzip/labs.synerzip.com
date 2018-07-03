<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

global $wpdb;	

if ( get_post_type( get_the_ID() ) == 'page' ) {
	$strip_group = get_post_meta($post->ID, 'strip_group', true);
	//print_r($strip_group);
} else {
	
	$strip_group = $wpdb->get_var("SELECT post_id FROM wp_postmeta WHERE meta_value LIKE '%".get_post_type( get_the_ID() )."%' AND meta_key = 'posttypes'");
}
if(is_tax())
{
	$strip_group = $wpdb->get_var("SELECT ID FROM wp_posts WHERE post_type = 'strips_manager' AND post_name = 'Hashtag-Default'");

}
if(empty($strip_group)) {
	$strip_group = $wpdb->get_var("SELECT ID FROM wp_posts WHERE post_type = 'strips_manager' AND post_name = 'default'");
} 

$rel = get_post_meta($strip_group, 'synerzip_strips', true);
if(!empty($rel)) { 
    foreach ($rel as $strip) {
		$args = array( 
            'post_type' => 'strips', 
            'p' => $strip, 
			'post_status' => 'publish'
            ); 
        query_posts($args);
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="strip-<?php if(get_field('strip_id')) { the_field('strip_id'); } else { echo $post->ID; } ?>" class="strip">
				<?php the_content(); ?>
            </div>
        <?php  
        endwhile; endif; 
	}
} ?>

</div> <!-- /page -->
<script type="text/javascript">
piAId = '131341';
piCId = '16860';

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>
<script type="text/javascript">
_linkedin_data_partner_id = "32860";
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<?php wp_footer(); ?>
</body>
</html>