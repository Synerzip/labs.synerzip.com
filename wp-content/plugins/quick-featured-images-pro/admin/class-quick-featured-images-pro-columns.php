<?php
/**
 * Quick Featured Images
 *
 * @package   Quick_Featured_Images_Pro_Columns
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://quickfeaturedimages.com/
 * @copyright 2014 
 */

/**
 * @package Quick_Featured_Images_Pro_Columns
 * @author    Martin Stehle <m.stehle@gmx.de>
 */
class Quick_Featured_Images_Pro_Columns {

	/**
	 * Instance of this class.
	 *
	 * @since    7.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Name of this plugin.
	 *
	 * @since    7.0
	 *
	 * @var      string
	 */
	protected $plugin_name = null;

	/**
	 * Unique identifier for this plugin.
	 *
	 * It is the same as in class Quick_Featured_Images_Pro_Admin
	 * Has to be set here to be used in non-object context, e.g. callback functions
	 *
	 * @since    7.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = null;

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since    7.0
	 *
	 * @var     string
	 */
	protected $plugin_version = null;

	/**
	 * Unique identifier in the WP options table
	 *
	 *
	 * @since    7.0
	 *
	 * @var      string
	 */
	protected $settings_db_slug = null;

	/**
	 * Stored settings in an array
	 *
	 *
	 * @since    7.0
	 *
	 * @var      array
	 */
	protected $stored_settings = array();

	/**
	 * Name of the additional column.
	 *
	 * @since    7.0
	 *
	 * @var      string
	 */
	protected $column_name = 'qfip-thumbnail';

	/**
	 * Required user capability to use this plugin
	 *
	 * @since   5.0 pro
	 *
	 * @var     string
	 */
	protected $required_user_cap = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     7.0
	 *
	 */
	private function __construct() {

		// Call variables from public plugin class.
		$plugin = Quick_Featured_Images_Pro_Admin::get_instance();
		$this->plugin_name = $plugin->get_plugin_name();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->plugin_version = $plugin->get_plugin_version();
		$this->settings_db_slug = $plugin->get_settings_db_slug();

		// add featured image columns if desired
		$add_column_function = array( $this, 'add_thumbnail_column' );
		$display_column_function = array( $this, 'display_thumbnail_in_column' );
		$add_sort_function = array( $this, 'add_sortable_column' );
		// get current or default settings
		$this->stored_settings = get_option( $this->settings_db_slug, array() );

		// add Featured Image column in desired posts lists
		foreach ( $this->stored_settings as $key => $value ) {
			if ( '1' == $value ) {
				if ( preg_match('/^column_thumb_([a-z0-9_\-]+)$/', $key, $matches ) ) {
					// make the following lines more readable
					$post_type = $matches[ 1 ];
					
					// get the hook name for the columns filter
					$hook = sprintf( 'manage_%s_posts_columns', $post_type );
					// add a column to list of desired post type and
					// sanitizing: check with has_filter() to prevent multiple columns in a row
					if ( ! has_filter( $hook, $add_column_function ) ) {
						add_filter( $hook, $add_column_function );
					}
					
					// get the hook name for the sortable columns filter
					$hook = sprintf( 'manage_edit-%s_sortable_columns', $post_type );
					// add the column to list of sortable columns
					// sanitizing: check with has_filter() to prevent more than 1 call
					if ( ! has_filter( $hook, $add_sort_function ) ) {
						add_filter( $hook, $add_sort_function );
					}
					
					// get the hook name for the column edit action
					$hook = sprintf( 'manage_%s_posts_custom_column', $post_type );
					// add thumbnail in column per post
					// sanitizing: check with has_filter() to prevent multiple contents in a column
					if ( ! has_action( $hook, $display_column_function ) ) {
						add_action( $hook, $display_column_function, 10, 2 );
					}
					
				} // if ( preg_match() )
			} // if ( value == 1 )
		} // foreach( stored_settings )

		// set required user capability
		if ( isset( $this->stored_settings[ 'minimum_role_all_pages' ] ) ) {
			switch ( $this->stored_settings[ 'minimum_role_all_pages' ] ) {
				case 'administrator':
					$this->required_user_cap = 'manage_options';
					break;
				default:
					$this->required_user_cap = 'edit_others_posts';
			}
		} else {
			$this->required_user_cap = 'edit_others_posts';
		}
		
		// load admin style sheet
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		// load admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		// print style for thumbnail column
		add_action( 'admin_head', array( $this, 'display_thumbnail_column_style' ) );
		// define image column sort order
		add_filter( 'pre_get_posts', array( $this, 'sort_column_by_image_id' ) );
		// define ajax function to set featured images
		add_action( 'wp_ajax_qfip_set_thumbnail', array( $this, 'set_thumbnail' ) );
		// define ajax function to set featured images
		add_action( 'wp_ajax_qfip_delete_thumbnail', array( $this, 'delete_thumbnail' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     7.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     5.0 pro
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		$handle = $this->plugin_slug . '-admin-script';
		
		wp_enqueue_script( $handle, plugins_url( 'assets/js/admin-column.js', __FILE__ ), array( 'jquery' ), $this->plugin_version );

		$translations = array(
			'nonce' => wp_create_nonce( 'qfip-image-column' ),
		);
		wp_localize_script( $handle, 'qfip_i18n', $translations );

		// Enqueued script with localized data.
		//wp_enqueue_script( $handle );

	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     7.0
	 *
	 * @return    null
	 */
	public function enqueue_admin_styles() {
		// load CSS file in posts list pages only
		$screen = get_current_screen();
		if ( 'edit' == $screen->base ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin-column.css', __FILE__ ), array( ), $this->plugin_version );
		}
 	}

	/**
	 * Add a column with the title 'Featured Image' in the post lists
	 *
	 * @since     7.0
	 *
	 * @return    array	list of columns    
	 */
    public function add_thumbnail_column( $cols ) {
		$text = 'Featured Image';
		$cols[ $this->column_name ] = __( $text );
        return $cols;
    }
	
    /**
     * Add the Featured Image column to sortable columns
     *
	 * @since     9.0
	 *
	 * @return    array	extended list of sortable columns    
     */
    public function add_sortable_column( $cols ) {
        $cols[ $this->column_name ] = $this->column_name;

        return $cols;
    }

	/**
	 * Print the featured image in the column
	 *
	 * @since     7.0
	 *
	 * @return    array	extended list of columns    
	 */
    public function display_thumbnail_in_column( $column_name, $post_id ) {
		/*
		// export to class wide vars to call it only once
		$max_dimension = 80; // width of thumbnail column in px at 1024 px window width
		$default_value = $max_dimension * 2;
		// set dimensions with values in Settings => Media => Thumbnail Size
		$width  = absint( get_option( 'thumbnail_size_w', $default_value ) / 2 );
		$height = absint( get_option( 'thumbnail_size_h', $default_value ) / 2 );
		// set maximum value if necessary
		$width = $width > $max_dimension ? $max_dimension : $width;
		$height = $height > $max_dimension ? $max_dimension : $height;
		*/
		$width = $height = 80;
		if ( $this->column_name == $column_name ) {
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			// image from gallery
			if ( $thumbnail_id ) {
				if ( $thumb = wp_get_attachment_image( $thumbnail_id, array( $width, $height ) ) ) {
					if ( current_user_can( $this->required_user_cap, $thumbnail_id ) ) {
						// show image linked to media selection box
						$link_title = __( 'Change &#8220;%s&#8221;', 'quick-featured-images-pro' );
						$thumb_title = _draft_or_post_title( $thumbnail_id );
						$link_text = 'Change Image';
						printf(
							'<a href="%s" id="qfip_set_%d" class="qfip_set_fi" title="%s">%s<br />%s</a>',
							esc_url( get_upload_iframe_src( 'image', $post_id ) ),
							$post_id,
							esc_attr( sprintf( $link_title, $thumb_title ) ),
							$thumb,
							__( $link_text )
						);
						
						// display 'edit' link
						$link_title = 'Edit &#8220;%s&#8221;';
						$link_text = 'Edit Image';
						printf(
							'<br><a href="%s" title="%s">%s</a>',
							get_edit_post_link( $thumbnail_id ),
							esc_attr( sprintf( __( $link_title ), $thumb_title ) ),
							__( $link_text )
						);

						// display removal link
						$link_title = __( 'Remove &#8220;%s&#8221;', 'quick-featured-images-pro' );
						$link_text = 'Remove featured image';
						printf(
							'<br><a href="#" id="qfip_delete_%d" class="qfip_delete_fi hide-if-no-js" title="%s">%s</a>',
							$post_id,
							esc_attr( sprintf( $link_title, $thumb_title ) ),
							__( $link_text )
						);
					} else {
						// if no edit capatibilities show image only
						echo $thumb;
					} // if user may
				} // if thumb
			} else {
				if ( current_user_can( $this->required_user_cap ) ) {
					/*$text = 'No image set';
					_e( $text );*/
					$text = 'Set featured image';
					printf(
						'<a href="%s" id="qfip_set_%d" class="qfip_set_fi" title="%s">%s</a>',
						esc_url( get_upload_iframe_src( 'image', $post_id ) ),
						$post_id,
						esc_attr( sprintf( __( 'Set image for &#8220;%s&#8221;', 'quick-featured-images-pro' ), _draft_or_post_title( $post_id ) ) ),
						__( $text )
					);
				} // if user may
			} // if thumbnail_id
		} // if this column name == column_name
    }
	
	/**
	 * Print CSS for image column
	 *
	 * @since     7.0
	 *
	 * @return    null    
	 */
	public function display_thumbnail_column_style(){
		echo '<style type="text/css">';
		echo "\n";
		echo "/* Quick Featured Images plugin styles */\n";
		echo "/* Fit thumbnails in posts list column */\n";
		printf( '.column-%s img {', $this->column_name );
		echo 'width:100%;height:auto;';
		printf( 'max-width:%dpx;', 80 );
		printf( 'max-height:%dpx;', 80 );
		echo "}\n";
		/* hide image column in small displays in WP version smaller than 4.3 */
		if ( version_compare( get_bloginfo( 'version' ), '4.3', '<' ) ) {
			echo "/* Auto-hiding of the thumbnail column in posts lists */\n";
			echo '@media screen and (max-width:782px) {';
			printf( '.column-%s {', $this->column_name );
			echo "display:none;}}\n";
		} // if WP < 4.3
		echo '</style>';
	}

    /**
     * Define sort order: order posts by featured image id
     *
	 * @since     9.0
	 *
     * @param $query
     */
    public function sort_column_by_image_id( $query ) {
	
		// if user wants to get rows sorted by featured image
        if ( $query->get( 'orderby' ) === $this->column_name ) {
			// set thumbnail id as sort value
            $query->set( 'meta_key', '_thumbnail_id' );
			// change sorting from alphabetical to numeric
            $query->set( 'orderby', 'meta_value_num' );
        }
    }

    /**
     * Set post featured image per Ajax request
     *
	 * @since     5.0 pro
	 *
     */
    public function set_thumbnail () {

		if ( ! isset( $_POST[ 'qfip_nonce' ] ) or ! wp_verify_nonce( $_POST[ 'qfip_nonce' ], 'qfip-image-column' ) ) {
			$text = 'Sorry, you are not allowed to add this item.';
			die( __( $text ) );
		}
		if ( isset( $_POST[ 'post_id' ] ) and isset( $_POST[ 'thumbnail_id' ] ) ) {
			$success = set_post_thumbnail( $_POST[ 'post_id' ][ 0 ], $_POST[ 'thumbnail_id' ] );
			if ( $success ) {

				// Localize the texts
				$title_edit		= 'Edit &#8220;%s&#8221;';
				$text_change	= 'Change Image';
				$text_edit		= 'Edit Image';
				$text_remove	= 'Remove featured image';
				$translations = array(
					'title_change'	=> __( 'Change &#8220;%s&#8221;', 'quick-featured-images-pro' ),
					'title_remove'	=> __( 'Remove &#8220;%s&#8221;', 'quick-featured-images-pro' ),
					'title_edit'	=> __( $title_edit ),
					'text_change'	=> __( $text_change ),
					'text_edit'		=> __( $text_edit ),
					'text_remove'	=> __( $text_remove ),
				);
				
				/*
				 * build the HTML response
				 */
				 
				$thumb_title = _draft_or_post_title( $_POST[ 'thumbnail_id' ] );
				
				// 'change thumbnail' link
				$html = sprintf(
					'<a href="%s" id="qfip_set_%d" class="qfip_set_fi" title="%s">%s<br />%s</a>',
					esc_url( get_upload_iframe_src( 'image', $_POST[ 'post_id' ][ 0 ] ) ),
					$_POST[ 'post_id' ][ 0 ],
					esc_attr( sprintf( $translations[ 'title_change' ], $thumb_title ) ),
					get_the_post_thumbnail( $_POST[ 'post_id' ][ 0 ], array( 80, 80 ) ),
					$translations[ 'text_change' ] 
				);

				// 'edit image' link
				$html .= sprintf(	
					'<br /><a href="%s" title="%s">%s</a>',
					get_edit_post_link( $_POST[ 'thumbnail_id' ] ),
					esc_attr( sprintf( $translations[ 'title_edit' ], $thumb_title ) ),
					$translations[ 'text_edit' ] 
				);

				// 'remove thumbnail' link
				$html .= sprintf(
					'<br /><a href="#" id="qfi_delete_%d" class="qfip_delete_fi hide-if-no-js" title="%s">%s</a>',
					$_POST[ 'post_id' ][ 0 ],
					esc_attr( sprintf( $translations[ 'title_remove' ], $thumb_title ) ),
					$translations[ 'text_remove' ] 
				);
				
				// return response to Ajax script
				echo $html;
				
			} else {
				// return error message to Ajax script
				$text = 'Item not added.';
				_e( $text );
			}
		}
		die();
    }

    /**
     * Remove post featured image per Ajax request
     *
	 * @since     5.0 pro
	 *
     */
    public function delete_thumbnail () {
		if ( ! isset( $_POST[ 'qfip_nonce' ] ) or ! wp_verify_nonce( $_POST[ 'qfip_nonce' ], 'qfip-image-column' ) ) {
			$text = 'Sorry, you are not allowed to delete this item.';
			die( __( $text ) );
		}
		if ( isset( $_POST[ 'post_id' ] ) ) {
			$success = delete_post_thumbnail( $_POST[ 'post_id' ][ 0 ] );
			if ( $success ) {
				// Localize the texts
				$text_set		= 'Set featured image';
				$text_deleted	= 'Item deleted.';
				$translations = array(
					'title_set'		=> __( 'Set image for &#8220;%s&#8221;', 'quick-featured-images-pro' ),
					'text_set'		=> __( $text_set ),
					'text_deleted'	=> __( $text_deleted ),
				);
				
				/*
				 * build the HTML response
				 */
				
				$post_title = _draft_or_post_title( $_POST[ 'post_id' ][ 0 ] );

				// 'set thumbnail' link
				$html = sprintf(
					'%s<br /><a href="%s" id="qfip_set_%d" class="qfip_set_fi" title="%s">%s</a>',
					$translations[ 'text_deleted' ],
					esc_url( get_upload_iframe_src( 'image', $_POST[ 'post_id' ][ 0 ] ) ),
					$_POST[ 'post_id' ][ 0 ],
					esc_attr( sprintf( $translations[ 'title_set' ], $post_title ) ),
					$translations[ 'text_set' ] 
				);

				// return response to Ajax script
				echo $html;
				
			} else {
				// return error message to Ajax script
				$text = 'Item not updated.';
				_e( $text );
			}
		}
		die();
    }

}
