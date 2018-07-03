<?php
/*
Plugin Name: Posts List for Visual Composer
Plugin URI: http://codecanyon.net/item/posts-list-for-visual-composer/9456666
Description: Extend Visual Composer with a list of your blog posts
Version: 1.3.8
Author: DEBD
Author URI: http://debd.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

defined( 'DEBD_VC_POSTS_LIST' ) or define( 'DEBD_VC_POSTS_LIST', 'debd-vc-posts-list' );

class DEBDPostsListShortcode {

	/**
	 * Hook into WordPress
	 *
	 * @since    1.0.0
	 */
	function __construct() {

		// Initialize
		add_action( 'init', array( $this, 'init' ) );

		// Load translations
		add_action( 'plugins_loaded', array( $this, 'loadTranslations' ) );

		// Enqueue admin-side scripts & styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ) );

		// Render shortcut
		add_shortcode( 'posts_list', array( $this, 'renderShortcodes' ) );
	}

	/**
	 * Get term without khowing it's taxonomy
	 *
	 * @uses    type $wpdb
	 * @uses    get_term()
	 *
	 * @param   int|object $term
	 * @param   string $output
	 * @param   string $filter
	 *
	 * @return object
	 * @since 1.3.0
	 */
	public function get_term_by_id( $term, $output = OBJECT, $filter = 'raw' ) {
		global $wpdb;
		$null = null;

		if ( empty( $term ) ) {
			$error = new WP_Error( 'invalid_term', __( 'Empty Term' ) );

			return $error;
		}

		$_tax     = $wpdb->get_row( $wpdb->prepare( "SELECT t.* FROM $wpdb->term_taxonomy AS t WHERE t.term_id = %s LIMIT 1", $term ) );
		$taxonomy = $_tax->taxonomy;

		return get_term( $term, $taxonomy, $output, $filter );
	}

	/**
	 * Initializes our VC and Titan Framework integration
	 *
	 * @return    void
	 * @since    1.0.0
	 */
	public function init() {

		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			add_action( 'admin_notices', array( $this, 'showVcVersionNotice' ) );

			return;
		}

		// add custom params
		function initChosen() {
			return;
		}

		function get_associated_terms( $taxonomy_slug ) {
			global $wpdb;

			$sql = "SELECT $wpdb->term_taxonomy.term_id, $wpdb->terms.name, $wpdb->terms.slug
    	        FROM $wpdb->term_taxonomy
              INNER JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
              WHERE $wpdb->term_taxonomy.taxonomy = %s
              ORDER BY $wpdb->terms.name";

			$safe_sql = $wpdb->prepare( $sql, $taxonomy_slug );
			$results  = $wpdb->get_results( $safe_sql, OBJECT );

			return $results;
		}

		function contentOrderField( $settings, $value ) {

			function layoutChooser( $name ) {
				$content = '<select class="contentorder-layout" name="contentorder-layout-' . $name . '" data-contentorder="layout' . $name . '">';
				$content .= '<option value="12">' . __( '12/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="11">' . __( '11/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="10">' . __( '10/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="9">' . __( '9/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="8">' . __( '8/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="7">' . __( '7/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="6">' . __( '6/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="5">' . __( '5/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="4">' . __( '4/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="3">' . __( '3/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="2">' . __( '2/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '<option value="1">' . __( '1/12', DEBD_VC_POSTS_LIST ) . '</option>';
				$content .= '</select>';

				return $content;
			}

			$sortValue = ( $value ) ? $value : '%7B%220%22%3A%22showdate%22%2C%221%22%3A%22showtitle%22%2C%222%22%3A%22showauthor%22%2C%223%22%3A%22showexcerpt%22%2C%224%22%3A%22showcomments%22%2C%225%22%3A%22showimage%22%2C%226%22%3A%22showcategories%22%2C%227%22%3A%22showtags%22%2C%228%22%3A%22showcontent%22%7D';
			$sort      = json_decode( urldecode( $sortValue ) );

			$items = array(
				'showdate'       => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-date" class="contentorder-show" data-contentorder="showdate"></div><div class="column-2">' . __( 'Show date', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'date' ) . '</div></li>',
				'showtitle'      => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-title" class="contentorder-show" data-contentorder="showtitle"></div><div class="column-2"> ' . __( 'Show title', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'title' ) . '</div></li>',
				'showauthor'     => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-author" class="contentorder-show" data-contentorder="showauthor"></div><div class="column-2"> ' . __( 'Show author', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'author' ) . '</div></li>',
				'showexcerpt'    => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-excerpt" class="contentorder-show" data-contentorder="showexcerpt"></div><div class="column-2"> ' . __( 'Show excerpt', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'excerpt' ) . '</div></li>',
				'showcontent'    => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-content" class="contentorder-show" data-contentorder="showcontent"></div><div class="column-2"> ' . __( 'Show content', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'content' ) . '</div></li>',
				'showcomments'   => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-comments" class="contentorder-show" data-contentorder="showcomments"></div><div class="column-2"> ' . __( 'Show comments', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'comments' ) . '</div></li>',
				'showimage'      => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-image" class="contentorder-show" data-contentorder="showimage"></div><div class="column-2"> ' . __( 'Show featured image', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'image' ) . '</div></li>',
				'showcategories' => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-categories" class="contentorder-show" data-contentorder="showcategories"></div><div class="column-2"> ' . __( 'Show categories', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'categories' ) . '</div></li>',
				'showtags'       => '<li><label><div class="column-1"><input type="checkbox" name="contentorder-show-tags" class="contentorder-show" data-contentorder="showtags"></div><div class="column-2"> ' . __( 'Show tags', DEBD_VC_POSTS_LIST ) . '</div></label><div class="column-3">' . layoutChooser( 'tags' ) . '</div></li>'
			);

			$content = '<div class="contentorder">';
			$content .= '<input id="contentorder-input" name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			$content .= '<div class="contentorder-header"><div class="column-1">' . __( 'Active', DEBD_VC_POSTS_LIST ) . '</div><div class="column-2">' . __( 'Content', DEBD_VC_POSTS_LIST ) . '</div><div class="column-3">' . __( 'Layout (column width)', DEBD_VC_POSTS_LIST ) . '</div></div>';
			$content .= '<ul class="sortable">';

			// store returned values to check if newer items were added
			$stored = array();

			// print old items
			foreach ( $sort as $key => $value ) {

				$stored[ $value ] = true;
				$content .= $items[ $value ];
			}

			// print new items (for newer vc-posts-list versions)
			foreach ( $items as $key => $value ) {

				if ( ! array_key_exists( $key, $stored ) ) {
					$content .= $items[ $key ];
				}
			}

			$content .= '</ul>';
			$content .= '</div>';

			return $content;
		}

		function hiddenContentOrderInputField( $settings, $value ) {
			$content = '<div class="hiddeninput">';
			$content .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			$content .= '</div>';

			return $content;
		}

		function categoriesMultipleOptionsField( $settings, $value ) {
			$content = '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';

			// include built in post tags and custom taxonomies
			$taxonomies = array( 'category' => 'Category' );

			foreach ( get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' ) as $taxonomy ) {
				if ( $taxonomy->hierarchical == 1 ) {
					$taxonomies[ $taxonomy->query_var ] = $taxonomy->labels->name;
				}
			}

			// loop through all tags and build option with/without selected attribute						
			$options  = '';
			$selected = '';

			foreach ( $taxonomies as $taxonomy_query_var => $taxonomy_name ) {
				$options .= '<optgroup label="' . $taxonomy_name . '">';

				$taxonomy_terms = get_associated_terms( $taxonomy_query_var );
				foreach ( $taxonomy_terms as $taxonomy_term ) {

					if ( is_array( $value ) ) {
						if ( in_array( $taxonomy_term->term_id, $value ) ) {
							$selected = ' selected="selected"';
						}
					}

					$options .= '<option value="' . $taxonomy_term->term_id . '"' . $selected . '>' . $taxonomy_term->name . '</option>';

				}
				$options .= '</optgroup>';
			}

			$content .= '<select id="' . $settings['param_name'] . '_select" class="chosen" multiple="multiple" data-placeholder="' . __( 'Choose categories', DEBD_VC_POSTS_LIST ) . '">';
			$content .= $options;
			$content .= '</select>';

			return $content;
		}

		function tagsMultipleOptionsField( $settings, $value ) {
			$content = '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';

			// include built in post tags and custom taxonomies
			$taxonomies = array( 'post_tag' => 'Post Tags' );

			foreach ( get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' ) as $taxonomy ) {
				if ( $taxonomy->hierarchical != 1 ) {
					$taxonomies[ $taxonomy->query_var ] = $taxonomy->labels->name;
				}
			}

			// loop through all tags and build option with/without selected attribute
			$options  = '';
			$selected = '';

			foreach ( $taxonomies as $taxonomy_query_var => $taxonomy_name ) {
				$options .= '<optgroup label="' . $taxonomy_name . '">';

				$taxonomy_terms = get_associated_terms( $taxonomy_query_var );
				foreach ( $taxonomy_terms as $taxonomy_term ) {

					if ( is_array( $value ) ) {
						if ( in_array( $taxonomy_term->term_id, $value ) ) {
							$selected = ' selected="selected"';
						}
					}

					$options .= '<option value="' . $taxonomy_term->term_id . '"' . $selected . '>' . $taxonomy_term->name . '</option>';

				}
				$options .= '</optgroup>';
			}

			$content .= '<select id="' . $settings['param_name'] . '_select" class="chosen" multiple="multiple" data-placeholder="' . __( 'Choose tags', DEBD_VC_POSTS_LIST ) . '">';
			$content .= $options;
			$content .= '</select>';

			return $content;
		}

		add_shortcode_param( 'initchosen', 'initChosen', plugins_url( 'assets/js/initChosen.js', __FILE__ ) );
		add_shortcode_param( 'contentorder', 'contentOrderField', plugins_url( 'assets/js/contentOrder.js', __FILE__ ) );
		add_shortcode_param( 'hiddencontentorderinput', 'hiddenContentOrderInputField' );
		add_shortcode_param( 'categoriesmultipleoptions', 'categoriesMultipleOptionsField', plugins_url( 'assets/js/categoriesMultipleOptions.js', __FILE__ ) );
		add_shortcode_param( 'tagsmultipleoptions', 'tagsMultipleOptionsField', plugins_url( 'assets/js/tagsMultipleOptions.js', __FILE__ ) );

		$orderby_options = array(
			__( 'None', DEBD_VC_POSTS_LIST )             => 'none',
			__( 'ID', DEBD_VC_POSTS_LIST )               => 'ID',
			__( 'Author', DEBD_VC_POSTS_LIST )           => 'author',
			__( 'Title', DEBD_VC_POSTS_LIST )            => 'title',
			__( 'Post name (Slug)', DEBD_VC_POSTS_LIST ) => 'name',
			__( 'Date', DEBD_VC_POSTS_LIST )             => 'date',
			__( 'Modified', DEBD_VC_POSTS_LIST )         => 'modified',
			__( 'Parent post/page', DEBD_VC_POSTS_LIST ) => 'parent',
			__( 'Random', DEBD_VC_POSTS_LIST )           => 'rand',
			__( 'Comment count', DEBD_VC_POSTS_LIST )    => 'comment_count',
			__( 'Menu Order', DEBD_VC_POSTS_LIST )    	=> 'menu_order',
			__( 'Meta Value: Last Name', DEBD_VC_POSTS_LIST )    	=> 'meta_value'
		);

		if ( get_bloginfo( 'version' ) >= 4.0 ) {
			$orderby_options[ __( 'Post type', DEBD_VC_POSTS_LIST ) ] = 'type';
		}

		$imagesizes = array();

		foreach ( get_intermediate_image_sizes() as $imagesize ) {
			$imagesizes[ $imagesize ] = $imagesize;
		}

		vc_map( array(
			'name'        => __( 'Posts List', DEBD_VC_POSTS_LIST ),
			'base'        => 'posts_list',
			'description' => __( 'List last posts', DEBD_VC_POSTS_LIST ),
			'icon'        => plugins_url( 'assets/img/icon.png', __FILE__ ),
			'category'    => __( 'Content', 'js_composer' ),
			'params'      => array(

				/*
				 * General options
				 */

				array(
					'type'        => 'posttypes',
					'heading'     => __( 'Post types', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'posttypes',
					'description' => __( 'Choose post types (If empty, posts are displayed by default)', DEBD_VC_POSTS_LIST ),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Relation', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'relation',
					'description' => __( 'Choose "AND" to query posts that are assigned to both selected categories and selected tags. Choose "OR" to query posts that are assigned to the selected categories or selected tags.', DEBD_VC_POSTS_LIST ),
					'value'       => array(
						__( 'AND', DEBD_VC_POSTS_LIST ) => 'AND',
						__( 'OR', DEBD_VC_POSTS_LIST )  => 'OR',
					),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Categories', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'categories',
					'description' => __( 'Choose between all categories or include/exclude some categories', DEBD_VC_POSTS_LIST ),
					'value'       => array(
						__( 'All', DEBD_VC_POSTS_LIST )     => 'all',
						__( 'include', DEBD_VC_POSTS_LIST ) => 'include',
						__( 'exclude', DEBD_VC_POSTS_LIST ) => 'exclude'
					),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'categoriesmultipleoptions',
					'heading'     => __( 'Included/excluded categories', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'category_ids',
					'description' => __( 'Choose all categories that should be included/excluded', DEBD_VC_POSTS_LIST ),
					'dependency'  => array(
						'element' => 'categories',
						'value'   => array( 'include', 'exclude' ),
					),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Tags', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'tags',
					'description' => __( 'Choose between all tags or include/exclude some tags', DEBD_VC_POSTS_LIST ),
					'value'       => array(
						__( 'All', DEBD_VC_POSTS_LIST )     => 'all',
						__( 'include', DEBD_VC_POSTS_LIST ) => 'include',
						__( 'exclude', DEBD_VC_POSTS_LIST ) => 'exclude'
					),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'tagsmultipleoptions',
					'heading'     => __( 'Included/excluded tags', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'tag_ids',
					'description' => __( 'Choose all tags that should be included/excluded', DEBD_VC_POSTS_LIST ),
					'dependency'  => array(
						'element' => 'tags',
						'value'   => array( 'include', 'exclude' ),
					),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Number of posts', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'number',
					'description' => __( 'How many posts do you want to show?', DEBD_VC_POSTS_LIST ),
					'value'       => 10,
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Exlude posts', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'exclude',
					'description' => __( 'Comma-separated list of excluded posts (e.g. 2,3,12)', DEBD_VC_POSTS_LIST ),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Offset', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'offset',
					'description' => __( 'Skip the first x posts', DEBD_VC_POSTS_LIST ),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Custom CSS classes', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'customclass',
					'description' => __( 'Add your own CSS classes (without "." and separated by space)', DEBD_VC_POSTS_LIST ),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Custom ID', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'customid',
					'description' => __( 'Add your own CSS ID (without "#")', DEBD_VC_POSTS_LIST ),
					'group'       => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'initchosen',
					'param_name' => 'initchosen',
					'group'      => __( 'General options', DEBD_VC_POSTS_LIST )
				),
				/*
				 * Content options
				 */

				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Use HTML-list', DEBD_VC_POSTS_LIST ),
					'param_name' => 'useul',
					'value'      => array(
						__( 'Check to return content as list', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'contentorder',
					'heading'     => __( 'Active fields', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'contentorder',
					'description' => __( "Set active content element and its layout (rearrange per drag and drop, choose column width)", DEBD_VC_POSTS_LIST ),
					'group'       => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Featured image size', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'imagesize',
					'description' => __( 'Choose size for featured image', DEBD_VC_POSTS_LIST ),
					'value'       => $imagesizes,
					'group'       => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link title', DEBD_VC_POSTS_LIST ),
					'param_name' => 'titlelink',
					'value'      => array(
						__( 'Check if title should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link comments', DEBD_VC_POSTS_LIST ),
					'param_name' => 'commentslink',
					'value'      => array(
						__( 'Check if comments should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link author', DEBD_VC_POSTS_LIST ),
					'param_name' => 'authorlink',
					'value'      => array(
						__( 'Check if author should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link image', DEBD_VC_POSTS_LIST ),
					'param_name' => 'imagelink',
					'value'      => array(
						__( 'Check if image should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link categories', DEBD_VC_POSTS_LIST ),
					'param_name' => 'categorieslink',
					'value'      => array(
						__( 'Check if categories should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Link tags', DEBD_VC_POSTS_LIST ),
					'param_name' => 'tagslink',
					'value'      => array(
						__( 'Check if tags should be linked', DEBD_VC_POSTS_LIST ) => 'true'
					),
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Excerpt length', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'excerptlength',
					'description' => __( 'Number of words (only matters if you didn\'t wrote your own excerpt)', DEBD_VC_POSTS_LIST ),
					'value'       => 55,
					'group'       => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Date format', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'dateformat',
					'description' => __( 'Use your own date format (show <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">possible options</a>)', DEBD_VC_POSTS_LIST ),
					'value'       => get_option( 'date_format' ),
					'group'       => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Wrap title', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'titlewrap',
					'description' => __( 'Choose which element should wrap the title', DEBD_VC_POSTS_LIST ),
					'value'       => array(
						'h1'   => 'h1',
						'h2'   => 'h2',
						'h3'   => 'h3',
						'h4'   => 'h4',
						'h5'   => 'h5',
						'h6'   => 'h6',
						'p'    => 'p',
						'span' => 'span',
					),
					'group'       => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				/*
				 * Hidden content options (show/hide certain content)
				 */

				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showdate',
					'value'      => 1,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutdate',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showtitle',
					'value'      => 1,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layouttitle',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showauthor',
					'value'      => 1,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutauthor',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showexcerpt',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutexcerpt',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showcontent',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutcontent',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showcomments',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutcomments',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showimage',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutimage',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showcategories',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layoutcategories',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'showtags',
					'value'      => 0,
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'       => 'hiddencontentorderinput',
					'param_name' => 'layouttags',
					'value'      => '12',
					'group'      => __( 'Content & Layout', DEBD_VC_POSTS_LIST )
				),
				/*
				 * Sort & Order options
				 */

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order posts by', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'orderby',
					'description' => __( 'Order posts by parameter', DEBD_VC_POSTS_LIST ),
					'value'       => $orderby_options,
					'group'       => __( 'Sort & Order', DEBD_VC_POSTS_LIST )
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort order', DEBD_VC_POSTS_LIST ),
					'param_name'  => 'order',
					'description' => __( 'Choose between ascending and descending order', DEBD_VC_POSTS_LIST ),
					'value'       => array(
						__( 'Ascending', DEBD_VC_POSTS_LIST )  => 'ASC',
						__( 'Descending', DEBD_VC_POSTS_LIST ) => 'DESC'
					),
					'group'       => __( 'Sort & Order', DEBD_VC_POSTS_LIST )
				)
			)
		) );

	}

	/**
	 * Loads the translations
	 *
	 * @return    void
	 * @since    1.0.0
	 */
	public function loadTranslations() {
		load_plugin_textdomain( DEBD_VC_POSTS_LIST, false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the admin stylings for VC
	 *
	 * @return    void
	 * @since    1.0.0
	 */
	public function enqueueAdminScripts() {
		wp_enqueue_style( 'vc-posts-list-chosen-style', plugins_url( 'vendor/chosen-1.2.0/chosen.css', __FILE__ ) );
		wp_enqueue_style( 'vc-posts-list-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
		wp_enqueue_script( 'vc-posts-list-chosen-script', plugins_url( 'vendor/chosen-1.2.0/chosen.jquery.min.js', __FILE__ ) );
	}

	/**
	 * Render Shortcode
	 *
	 * @param    array $atts Attributes from vc_map
	 *
	 * @return    string
	 * @since    1.0.0
	 */
	public function renderShortcodes( $atts ) {

		// get options
		$posttypes      = ( isset( $atts['posttypes'] ) ) ? explode( ',', $atts['posttypes'] ) : 'post';
		$query_relation = ( isset( $atts['relation'] ) ) ? $atts['relation'] : 'AND';
		$categories     = ( isset( $atts['categories'] ) ) ? $atts['categories'] : 'all';
		$category_ids   = ( isset( $atts['category_ids'] ) ) ? json_decode( urldecode( $atts['category_ids'] ) ) : null;
		$tags           = ( isset( $atts['tags'] ) ) ? $atts['tags'] : 'all';
		$tag_ids        = ( isset( $atts['tag_ids'] ) ) ? json_decode( urldecode( $atts['tag_ids'] ) ) : null;
		$number         = ( isset( $atts['number'] ) ) ? intval( $atts['number'] ) : 10;
		$order          = ( isset( $atts['order'] ) ) ? $atts['order'] : 'ASC';
		$orderby        = ( isset( $atts['orderby'] ) ) ? $atts['orderby'] : 'menu_order';
		$exclude        = ( isset( $atts['exclude'] ) ) ? explode( ',', $atts['exclude'] ) : null;
		$offset         = ( isset( $atts['offset'] ) ) ? intval( $atts['offset'] ) : 0;

		$customclass = ( isset( $atts['customclass'] ) ) ? ' ' . $atts['customclass'] : '';
		$customid    = ( isset( $atts['customid'] ) ) ? 'id="' . $atts['customid'] . '" ' : '';

		$titlewrap = ( isset( $atts['titlewrap'] ) ) ? $atts['titlewrap'] : 'h1';

		$titlelink      = ( isset( $atts['titlelink'] ) ) ? $atts['titlelink'] : false;
		$commentslink   = ( isset( $atts['commentslink'] ) ) ? $atts['commentslink'] : false;
		$authorlink     = ( isset( $atts['authorlink'] ) ) ? $atts['authorlink'] : false;
		$imagelink      = ( isset( $atts['imagelink'] ) ) ? $atts['imagelink'] : false;
		$categorieslink = ( isset( $atts['categorieslink'] ) ) ? $atts['categorieslink'] : false;
		$tagslink       = ( isset( $atts['tagslink'] ) ) ? $atts['tagslink'] : false;

		$showdate       = ( isset( $atts['showdate'] ) ) ? intval( $atts['showdate'] ) : true;
		$showtitle      = ( isset( $atts['showtitle'] ) ) ? intval( $atts['showtitle'] ) : true;
		$showauthor     = ( isset( $atts['showauthor'] ) ) ? intval( $atts['showauthor'] ) : true;
		$showexcerpt    = ( isset( $atts['showexcerpt'] ) ) ? intval( $atts['showexcerpt'] ) : false;
		$showcontent    = ( isset( $atts['showcontent'] ) ) ? intval( $atts['showcontent'] ) : false;
		$showcomments   = ( isset( $atts['showcomments'] ) ) ? intval( $atts['showcomments'] ) : false;
		$showimage      = ( isset( $atts['showimage'] ) ) ? intval( $atts['showimage'] ) : false;
		$showcategories = ( isset( $atts['showcategories'] ) ) ? intval( $atts['showcategories'] ) : false;
		$showtags       = ( isset( $atts['showtags'] ) ) ? intval( $atts['showtags'] ) : false;

		$layoutdate       = ( isset( $atts['layoutdate'] ) ) ? intval( $atts['layoutdate'] ) : 12;
		$layouttitle      = ( isset( $atts['layouttitle'] ) ) ? intval( $atts['layouttitle'] ) : 12;
		$layoutauthor     = ( isset( $atts['layoutauthor'] ) ) ? intval( $atts['layoutauthor'] ) : 12;
		$layoutexcerpt    = ( isset( $atts['layoutexcerpt'] ) ) ? intval( $atts['layoutexcerpt'] ) : 12;
		$layoutcontent    = ( isset( $atts['layoutcontent'] ) ) ? intval( $atts['layoutcontent'] ) : 12;
		$layoutcomments   = ( isset( $atts['layoutcomments'] ) ) ? intval( $atts['layoutcomments'] ) : 12;
		$layoutimage      = ( isset( $atts['layoutimage'] ) ) ? intval( $atts['layoutimage'] ) : 12;
		$layoutcategories = ( isset( $atts['layoutcategories'] ) ) ? intval( $atts['layoutcategories'] ) : 12;
		$layouttags       = ( isset( $atts['layouttags'] ) ) ? intval( $atts['layouttags'] ) : 12;

		$excerptlength = ( isset( $atts['excerptlength'] ) ) ? intval( $atts['excerptlength'] ) : 55;

		$dateformat = ( isset( $atts['dateformat'] ) ) ? $atts['dateformat'] : get_option( 'date_format' );

		$imagesize = ( isset( $atts['imagesize'] ) ) ? $atts['imagesize'] : 'thumbnail';

		$useul = ( isset( $atts['useul'] ) ) ? $atts['useul'] : false;

		$sort = ( isset( $atts['contentorder'] ) ) ? $atts['contentorder'] : '%7B%220%22%3A%22showdate%22%2C%221%22%3A%22showtitle%22%2C%222%22%3A%22showauthor%22%2C%223%22%3A%22showexcerpt%22%2C%224%22%3A%22showcomments%22%2C%225%22%3A%22showimage%22%2C%226%22%3A%22showcategories%22%2C%227%22%3A%22showtags%22%2C%228%22%3A%22showcontent%22%7D';

		$sort = json_decode( urldecode( $sort ) );

		// build query_posts options array
		$args = array(
			'post_type' => $posttypes
		);

		if ( $number ) {
			$args['posts_per_page'] = $number;
		}

		if ( $order ) {
			$args['order'] = $order;
		}

		if ( $orderby ) {
			$args['orderby'] = $orderby;
		}

		if($orderby == 'meta_value') {
			$args['meta_key'] = 'last_name';
		}
		if ( $exclude ) {
			$args['post__not_in'] = $exclude;
		}

		if ( $offset ) {
			$args['offset'] = $offset;
		}

		// get taxonomies by term IDs
		// little bit ugly, but necessary to avoid conflicts with older versions of this plugin
		// and to make updating more easier for our users

		$taxonomy_terms = array();
		$tax_query      = array(
			'relation' => $query_relation
		);

		if ( $categories != 'all' && $category_ids && is_array( $category_ids ) ) {
			foreach ( $category_ids as $category_id ) {
				$term = $this->get_term_by_id( $category_id );

				if ( ! is_array( $taxonomy_terms[ $term->taxonomy ] ) ) {
					$taxonomy_terms[ $term->taxonomy ] = array();
				}

				if ( ! is_array( $taxonomy_terms[ $term->taxonomy ]['terms'] ) ) {
					$taxonomy_terms[ $term->taxonomy ]['terms'] = array();
				}

				$taxonomy_terms[ $term->taxonomy ]['relation'] = ( $categories == 'include' ) ? 'IN' : 'NOT IN';
				array_push( $taxonomy_terms[ $term->taxonomy ]['terms'], $term );
			}
		}

		if ( $tags != 'all' && $tag_ids && is_array( $tag_ids ) ) {
			foreach ( $tag_ids as $tag_id ) {
				$term = $this->get_term_by_id( $tag_id );

				if ( ! is_array( $taxonomy_terms[ $term->taxonomy ] ) ) {
					$taxonomy_terms[ $term->taxonomy ] = array();
				}

				if ( ! is_array( $taxonomy_terms[ $term->taxonomy ]['terms'] ) ) {
					$taxonomy_terms[ $term->taxonomy ]['terms'] = array();
				}

				$taxonomy_terms[ $term->taxonomy ]['relation'] = ( $tags == 'include' ) ? 'IN' : 'NOT IN';
				array_push( $taxonomy_terms[ $term->taxonomy ]['terms'], $term );
			}
		}

		foreach ( $taxonomy_terms as $taxonomy_slug => $terms_and_relation ) {

			$terms    = $terms_and_relation['terms'];
			$relation = $terms_and_relation['relation'];

			$term_ids = array();
			foreach ( $terms as $term ) {
				array_push( $term_ids, $term->term_id );
			}

			$query_array = array(
				'taxonomy' => $taxonomy_slug,
				'field'    => 'id',
				'terms'    => $term_ids,
				'operator' => $relation
			);
			array_push( $tax_query, $query_array );
		}

		if ( $categories != 'all' || $tags != 'all' ) {
			$args['tax_query'] = $tax_query;
		}

		$posts_list_query = new WP_Query( $args );

		// open content wrapper
		$content = '<div ' . $customid . 'class="vc-posts-list' . $customclass . '">';

		if ( $useul ) {
			$content .= '<ul>';
		}

		// get content
		while ( $posts_list_query->have_posts() ) : $posts_list_query->the_post();

			// multiple used variables
			$post_type  = get_post_type();
			$taxonomies = get_object_taxonomies( $post_type, 'objects' );

			// build markup for each item
			if ( $showdate ) {
				$date = get_the_date( $dateformat );
			} else {
				$date = '';
			}

			if ( $showtitle ) {
				$title = ( $titlelink ) ? '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>' : get_the_title();
			} else {
				$title = '';
			}

			if ( $showauthor ) {
				$author = ( $authorlink ) ? '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a>' : get_the_author();
			} else {
				$author = '';
			}

			if ( $showexcerpt ) {
				if ( has_excerpt( get_the_ID() ) ) {
					$excerpt = apply_filters( 'the_content', get_the_excerpt() );
				} else {
					$excerpt = wp_trim_words( wp_strip_all_tags( apply_filters( 'the_content', get_the_content() ) ), $excerptlength );
				}
			}

			if ( $showcontent && get_the_content() ) {
				$pcontent = apply_filters( 'the_content', get_the_content() );
			} else {
				$pcontent = '';
			}

			if ( $showcomments ) {
				$comments = ( $commentslink ) ? '<a href="' . get_comments_link() . '">' . get_comments_number_text() . '</a>' : get_comments_number_text();
			} else {
				$comments = '';
			}

			if ( $showimage && has_post_thumbnail() ) {
				$image = ( $imagelink ) ? '<a href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), $imagesize ) . '</a>' : get_the_post_thumbnail( get_the_ID(), $imagesize );
			} else {
				$image = '';
			}

			if ( $showcategories ) {

				$categories = array();
				foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {

					if ( $taxonomy->hierarchical == 1 ) {

						// get the terms related to post
						$terms = get_the_terms( get_the_ID(), $taxonomy_slug );

						if ( ! empty( $terms ) ) {
							foreach ( $terms as $term ) {
								if ( $categorieslink ) {
									array_push( $categories, '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' );
								} else {
									array_push( $categories, $term->name );
								}
							}
						}

					}

				}

				if ( count( $categories ) > 0 ) {
					$categories = implode( ', ', $categories );
				} else {
					$categories = '';
				}

			} else {
				$categories = '';
			}

			if ( $showtags ) {

				$tags = array();
				foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {

					if ( $taxonomy->hierarchical != 1 && $taxonomy_slug != 'product_type' ) {

						// get the terms related to post
						$terms = get_the_terms( get_the_ID(), $taxonomy_slug );

						if ( ! empty( $terms ) ) {
							foreach ( $terms as $term ) {
								if ( $tagslink ) {
									array_push( $tags, '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' );
								} else {
									array_push( $tags, $term->name );
								}
							}
						}

					}

				}

				if ( count( $tags ) > 0 ) {
					$tags = implode( ', ', $tags );
				} else {
					$tags = '';
				}

			} else {
				$tags = '';
			}

			$items = array(
				//'showdate'       => '<div class="post-date vc_col-sm-' . $layoutdate . ' wpb_column vc_column_container">' . $date . '</div>',
				'showtitle'      => '<div class="post-title vc_col-sm-' . $layouttitle . ' wpb_column vc_column_container"><' . $titlewrap . '>' . $title . '</' . $titlewrap . '></div>',
				'showauthor'     => '<div class="post-author vc_col-sm-' . $layoutauthor . ' wpb_column vc_column_container">' . $author . '</div>',
				'showexcerpt'    => '<div class="post-excerpt vc_col-sm-' . $layoutexcerpt . ' wpb_column vc_column_container"><span class="more">' . $date . '</span> ' . $excerpt . '</div>',
				'showcontent'    => '<div class="post-content vc_col-sm-' . $layoutcontent . ' wpb_column vc_column_container">' . $pcontent . '</div>',
				'showcomments'   => '<div class="post-comments vc_col-sm-' . $layoutcomments . ' wpb_column vc_column_container">' . $comments . '</div>',
				'showimage'      => '<div class="post-image vc_col-sm-' . $layoutimage . ' wpb_column vc_column_container">' . $image . '</div>',
				'showcategories' => '<div class="post-categories vc_col-sm-' . $layoutcategories . ' wpb_column vc_column_container">' . $categories . '</div>',
				'showtags'       => '<div class="post-tags vc_col-sm-' . $layouttags . ' wpb_column vc_column_container">' . $tags . '</div>'
			);

			if ( $useul ) {
				$content .= '<li>';
			}

			$content .= '<div class="vc-posts-list-item">';

			//$content .= '<div class="vc_row wpb_row vc_inner vc_row-fluid vc-posts-list-row-1">';
			$columns = 0;
			$rows    = 1;

			foreach ( $sort as $key => $value ) {

				if ( ${$value} ) {

					$columnwidth = intval( ${"layout" . substr( $value, 4 )} );
					$columns += $columnwidth;

					if ( $columns > 12 ) {
						$rows ++;
						//$content .= '</div><div class="vc_row wpb_row vc_inner vc_row-fluid vc-posts-list-row-' . $rows . '">';
						$columns = $columnwidth;
					}

					$content .= $items[ $value ];

				}

			}

			//$content .= '</div></div>';
			$content .= '</div>';

			if ( $useul ) {
				$content .= '</li>';
			}

		endwhile;

		// close content wrapper
		if ( $useul ) {
			$content .= '</ul>';
		}

		$content .= '</div>';

		wp_reset_postdata();

		return $content;
	}

	/**
	 * Displays "Install Visual Composer" notice
	 *
	 * @return    string
	 * @since    1.0.0
	 */
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data( __FILE__ );
		echo '
        <div class="updated">
          <p>' . sprintf( __( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend' ), $plugin_data['Name'] ) . '</p>
        </div>';
	}
}

// Initialize!
new DEBDPostsListShortcode();