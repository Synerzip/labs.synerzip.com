<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version

remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Remove Emoji CSS and JS from header
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove some Admin menu items
function remove_admin_menu_item() {
    global $menu;
    unset($menu[15]);
}

add_action('admin_menu', 'remove_admin_menu_item');

// Remove some dashboard widgets
function remove_wp_dashboard_widgets() {
    wp_unregister_sidebar_widget('dashboard_primary');
    wp_unregister_sidebar_widget('dashboard_secondary');
    wp_unregister_sidebar_widget('dashboard_plugins');
    wp_unregister_sidebar_widget('dashboard_recent_comments');
    wp_unregister_sidebar_widget('dashboard_recent_drafts');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
}

add_action('wp_dashboard_setup', 'remove_wp_dashboard_widgets');

// Remove some boxes from Post pages
function remove_post_boxes() {
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('postcustom', 'page', 'normal');
    remove_meta_box('pagecustomdiv', 'page', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
    remove_meta_box('postexcerpt', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'page', 'normal');
    remove_meta_box('edit-box-ppr', 'post', 'normal');
    remove_meta_box('edit-box-ppr', 'page', 'normal');
}

//add_action('admin_menu', 'remove_post_boxes');

// Add Post Thumbnails/Image size
add_theme_support('post-thumbnails');

if (function_exists('add_image_size')) {
    add_image_size('banner', 2000, 800, true);
    add_image_size('company_logo', 500, 500, true);
    add_image_size('team', 200, 200, true);
}

// Add Menu Support
if (function_exists('register_nav_menus')) {
    register_nav_menus(
            array(
                'navigation' => 'Navigation'
            )
    );
}
function __search_by_title_only( $search, $wp_query )
{
global $wpdb;
if ( empty( $search ) )
return $search; // skip processing - no search term in query
$q = $wp_query->query_vars;
$n = ! empty( $q['exact'] ) ? '' : '%';
$search =
$searchand = '';
foreach ( (array) $q['search_terms'] as $term ) {

$term = esc_sql( like_escape( $term ) );

$search .= "{$searchand}($wpdb->posts.post_title REGEXP '[[:<:]]{$term}[[:>:]]')";

$searchand = ' AND ';

}

if ( ! empty( $search ) ) {

$search = " AND ({$search}) ";

if ( ! is_user_logged_in() )

$search .= " AND ($wpdb->posts.post_password = '') ";

}

return $search;

}

add_filter( 'posts_search', '__search_by_title_only', 1000, 2 );

function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');


// Paginate search results
function pagination($query, $baseURL) {
    $page = $query->query_vars["paged"];
    if (!$page)
        $page = 1;
    $qs = $_SERVER["QUERY_STRING"] ? "?" . $_SERVER["QUERY_STRING"] : "";
    // Only necessary if there's more posts than posts-per-page
    if ($query->found_posts > $query->query_vars["posts_per_page"]) {
        echo '<ul class="paging">';
        // Loop through pages
        for ($i = 1; $i <= $query->max_num_pages; $i++) {
            // Current page or linked page?
            if ($i == $page) {
                echo '<li class="active">' . $i . '</li>';
            } else {
                echo '<li><a href="' . $baseURL . 'page/' . $i . '/' . $qs . '">' . $i . '</a></li>';
            }
        }
        echo '</ul>';
    }
}

function pagination_iqsearch($siq_plugin, $query, $baseURL = '') {
    if (!$baseURL)
    {
        $baseURL = get_option('home') . '/';
    }
    $page = $query->query["paged"];
    if (!$page)
        $page = 1;
    $qs = $_SERVER["QUERY_STRING"] ? "?" . $_SERVER["QUERY_STRING"] : "";
    // Only necessary if there's more posts than posts-per-page
    if ($siq_plugin->totalResults > $query->query_vars["posts_per_page"]) {
        echo '<ul class="paging">';
        // Loop through pages
        for ($i = 1; $i <= $siq_plugin->numPages; $i++) {
            // Current page or linked page?
            if ($i == $page) {
                echo '<li class="active">' . $i . '</li>';
            } else {
                echo '<li><a href="' . $baseURL . 'page/' . $i . '/' . $qs . '">' . $i . '</a></li>';
            }
        }
        echo '</ul>';
    }
}

// Trim Content
function trim_content($text, $max_length) {
    if (strlen($text) > $max_length) {
        $text = apply_filters('the_content', $text);
        $text = strip_tags($text, '<p><em><strong>');
        $excerpt_length = $max_length;
        if (strlen($text) > $max_length) {
            $text = substr($text, 0, $max_length);
            $pos = strrpos($text, " ");
            if ($pos === false) {
                return force_balance_tags(substr($text, 0, $max_length) . "...");
            }
            return force_balance_tags(substr($text, 0, $pos) . "...");
        }
    }
    force_balance_tags($text);
    return $text;
}

function acf_load_color_field_choices($field) {
    // reset choices
    $field['choices'] = array();

    // explode the value so that each line is a new array piece
    //$choices = explode("\n", $choices);

    $choices = get_post_types(array('public' => true));

    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice] = $choice;
        }
    }

    // return the field
    return $field;
}

add_filter('acf/load_field/name=posttypes', 'acf_load_color_field_choices');


// Shortcodes
// Story Metadata
// Story Logo
// Webinar Metadata
// Shortcode/Element: Custom Header Tag
vc_map(array(
    "name" => __("Header Tag"),
    "base" => "synerzip_header",
    "category" => __('Content'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Header Text"),
            "param_name" => "text",
            "value" => ""
        ),
        array(
            "type" => "dropdown",
            "param_name" => "tag",
            "heading" => __("Choose Header Tag", "js_composer"),
            "value" => array(
                __('', 'js_composer') => '',
                __('h1', 'js_composer') => 'h1',
                __('h2', 'js_composer') => 'h2',
                __('h3', 'js_composer') => 'h3',
                __('h4', 'js_composer') => 'h4',
                __('h5', 'js_composer') => 'h5',
                __('h6', 'js_composer') => 'h6',
            ),
            "holder" => "div"
        ),
    )
));

add_shortcode('synerzip_header', 'synerzip_header');

function synerzip_header($atts) {
    extract(shortcode_atts(array(
        'tag' => 'tag',
        'text' => 'text'
                    ), $atts));

    $output = "<{$tag}>{$text}</{$tag}>";

    return $output;
}

// Webinar Meta shortcode
function webinar_meta($atts) {
    global $post;
    $date = get_post_meta($post->ID, 'date', true);
    $time = get_post_meta($post->ID, 'time', true);
    $timestamp = $date . ' 20:00:00';
    $today = date("Y-m-d H:i:s");
    if (strtotime($timestamp) > strtotime($today)) {
        $future = true;
    }
    $output = '';
    if ($date) {
        $date = date("l, F j, Y", strtotime($date));
        $output .= '<h6>Date</h6>';
        $output .= '<div class="storymeta">' . $date . '</div>';
    }
    if ($time) {
        $output .= '<h6>Time</h6>';
        $output .= '<div class="storymeta">' . $time . '</div>';
    }
    if ($future) {
        $output .= '<div class="vc_btn3-container"><a class="vc_general vc_btn3 colorbox" href="#register">Register Now</a></div>';
    }
    return $output;
}

add_shortcode('webinar_meta', 'webinar_meta');

// Quote Meta shortcode
function quote_meta($atts) {
    global $post;
    $author = get_post_meta($post->ID, 'author', true);
    $title = get_post_meta($post->ID, 'title', true);
    $company = get_post_meta($post->ID, 'company', true);
    $company_url = get_post_meta($post->ID, 'company_url', true);
    $linkedin_url = get_post_meta($post->ID, 'linkedin_url', true);

    $output = '<strong>' . $author . '</strong> ';
    if ($title) {
        $output .= '<em>' . $title . '</em>, ';
    }
    if ($company) {
        if ($company_url) {
            $output .= '<a href="' . $company_url . '">' . $company . '</a>';
        } else {
            $output .= $company;
        }
    }
    if ($linkedin_url) {
        $output .= '<a href="' . $linkedin_url . ' class="fa fa-linkedin"></a>';
    }

    return $output;
}

add_shortcode('quote_meta', 'quote_meta');

// Date Meta shortcode
function date_meta($atts) {
    global $post;
    $date = get_post_meta($post->ID, 'date', true);
    if ($date) {
        $month = date("M", strtotime($date));
        $day = date("j", strtotime($date));
        $year = date("Y", strtotime($date));

        $output = '<div class="dot">' . $month . '<span class="day">' . $day . '</span>' . $year . '</div>';
        return $output;
    } else {
        $month = date("M", strtotime(get_the_date()));
        $day = date("j", strtotime(get_the_date()));
        $year = date("Y", strtotime(get_the_date()));

        $output = '<div class="dot">' . $month . '<span class="day">' . $day . '</span>' . $year . '</div>';
        return $output;
    }
}

add_shortcode('date_meta', 'date_meta');

// Webinar Upcoming/Past shortcode
function webinar_timer($atts) {
    global $post;
    if ('webinar' == get_post_type($post->ID)) {
        $date = get_post_meta($post->ID, 'date', true);
        $today = date("Y-m-d H:i:s");
        if (strtotime($date) < strtotime($today)) {
            $output = '<div class="vc_gitem-post-data vc_gitem-post-data-source-post_categories vc_grid-filter vc_clearfix vc_grid-filter-comma  vc_grid-filter-size-md vc_grid-filter-center vc_grid-filter-color-grey""><div class="vc_grid-filter-item vc_gitem-post-category-name"><span class="vc_gitem-post-category-name">Webinar</span></div></div>';
        } else {
            $output = '<div class="vc_gitem-post-data vc_gitem-post-data-source-post_categories vc_grid-filter vc_clearfix vc_grid-filter-comma  vc_grid-filter-size-md vc_grid-filter-center vc_grid-filter-color-grey""><div class="vc_grid-filter-item vc_gitem-post-category-name"><span class="vc_gitem-post-category-name">Upcoming Webinar</span></div></';
        }
        return $output;
    }
}

add_shortcode('webinar_timer', 'webinar_timer');

// Webinar/News Permalink Button shortcode
function more_button($atts) {
    global $post;
    $date = get_post_meta($post->ID, 'date', true);
    $today = date("Y-m-d H:i:s");
    if (('webinar' == get_post_type($post->ID)) && (strtotime($date) > strtotime($today))) {
        $button_content = 'Register Now';
    } else {
        $button_content = 'Read More';
    }
    $output = '<div class="vc_btn3-container btn-text vc_btn3-left"><a href="' . get_permalink($post->ID) . '" class="vc_gitem-link vc_general vc_btn3" title="' . $button_content . ' »">' . $button_content . ' »</a></div>';
    return $output;
}

add_shortcode('more_button', 'more_button');

// Story Logo shortcode
function story_logo($atts) {
    global $post;
    $company_url = get_post_meta($post->ID, 'company_url', true);
    $company_logo = get_post_meta($post->ID, 'company_logo', true);
    $clogo = wp_get_attachment_image_src($company_logo, 'company_logo');

    $output = '';
    if ($company_logo) {
        if ($company_url) {
            $output .= '<a href="' . $company_url . '"><img src="' . $clogo[0] . '" alt="" class="img-responsive" /></a>';
        } else {
            $output .= '<img src="' . $clogo[0] . '" alt="" class="img-responsive" />';
        }
    }

    return $output;
}

add_shortcode('story_logo', 'story_logo');

// Story Meta shortcode
function story_meta($atts) {
    global $post;
    $client_name = get_post_meta($post->ID, 'client_name', true);
    $client_title = get_post_meta($post->ID, 'client_title', true);

    $output = '';
    if ($client_name) {
        $output .= '<h6>Client</h6><div class="storymeta">';
        if ($client_title) {
            $output .= $client_name . ', ' . $client_title;
        } else {
            $output .= $client_name;
        }
        $output .= '</div>';
    }

    $offering = get_the_terms($post->ID, 'offering');
    if (!empty($offering)) {
        $entry_terms = '';
        $output .= '<h6>Offering</h6><div class="storymeta">';
        foreach ($offering as $term) {
            $entry_terms .= $term->name . ', ';
        }
        $entry_terms = rtrim($entry_terms, ', ');
        $output .= $entry_terms;
        $output .= '</div>';
    }
    /* $technology = get_the_terms( $post->ID , 'technology' );
      if ( !empty( $technology ) ) {
      $entry_terms = '';
      $output .= '<h6>Technology</h6><div class="storymeta">';
      foreach ( $technology as $term ) {
      $entry_terms .= $term->name . ', ';
      }
      $entry_terms = rtrim( $entry_terms, ', ' );
      $output .= $entry_terms;
      $output .= '</div>';
      } */
    $industry = get_the_terms($post->ID, 'industry');
    if (!empty($industry)) {
        $entry_terms = '';
        $output .= '<h6>Industry</h6><div class="storymeta">';
        foreach ($industry as $term) {
            $entry_terms .= $term->name . ', ';
        }
        $entry_terms = rtrim($entry_terms, ', ');
        $output .= $entry_terms;
        $output .= '</div>';
    }
    /* $hashtags = get_the_terms( $post->ID , 'hashtag' );
      if ( !empty( $hashtags ) ) {
      $entry_terms = '';
      $output .= '<h6>Tags</h6><div class="storymeta">';
      foreach ( $hashtags as $term ) {
      $entry_terms .= $term->name . ', ';
      }
      $entry_terms = rtrim( $entry_terms, ', ' );
      $output .= $entry_terms;
      $output .= '</div>';
      } */

    return $output;
}

add_shortcode('story_meta', 'story_meta');

// Team Meta shortcode
function team_meta($atts) {
    global $post;
    $title = get_post_meta($post->ID, 'title', true);
    $tw = get_post_meta($post->ID, 'twitter_url', true);
    $li = get_post_meta($post->ID, 'linkedin_url', true);

    $output = '';
    $output .= '<h4>' . get_the_title($post->ID) . '</h4>';
    if ($title) {
        $output .= '<h6>' . $title . '</h6>';
    }
    if ($tw || $li) {
        $output .= '<ul>';
        if ($tw) {
            $output .= '<li><a href="' . $tw . '"><i class="fa fa-twitter"></i></a></li>';
        }
        if ($li) {
            $output .= '<li><a href="' . $li . '"><i class="fa fa-linkedin"></i></a></li>';
        }
        $output .= '</ul>';
    }

    return $output;
}

add_shortcode('team_meta', 'team_meta');

// Story Meta shortcode
function story_tags($atts) {
    global $post;

    $output = '';
    $hashtags = get_the_terms($post->ID, 'hashtag');
    $output .= '<h5>';
    if (!empty($hashtags)) {
        $entry_terms = '';
        $i = 0;
        foreach ($hashtags as $term) {
            $entry_terms .= $term->name . ', ';
            $i++;
            if ($i == 4) {
                break;
            }
        }
        $entry_terms = rtrim($entry_terms, ', ');
        $output .= $entry_terms;
    }
    $output .= '</h5>';

    return $output;
}

add_shortcode('story_tags', 'story_tags');

// Story Meta shortcode
function story_type($atts) {
    global $post;

    $output = '';
    $hashtags = get_the_terms($post->ID, 'story_type');
    if (!empty($hashtags)) {
        $output .= '<div class="vc_grid-filter-item">';
        $entry_terms = '';
        foreach ($hashtags as $term) {
            $entry_terms .= $term->name . ', ';
        }
        $entry_terms = rtrim($entry_terms, ', ');
        $output .= $entry_terms;
        $output .= '</div>';
    }

    return $output;
}

add_shortcode('story_type', 'story_type');

// Job Listing shortcode
function job_listing($atts) {
    global $post;
    $overview = get_post_meta($post->ID, 'overview', true);
    $responsibilities = get_post_meta($post->ID, 'responsibilities', true);
    $skills_and_experience = get_post_meta($post->ID, 'skills_and_experience', true);
    $education = get_post_meta($post->ID, 'education', true);
    $benefits = get_post_meta($post->ID, 'benefits', true);

    $output = $overview;
    if ($responsibilities) {
        $output .= '<h4>Responsibilities</h4>' . $responsibilities;
    }
    if ($skills_and_experience) {
        $output .= '<h4>Skills and Experience</h4>' . $skills_and_experience;
    }
    if ($education) {
        $output .= '<h4>Education</h4>' . $education;
    }
    if ($benefits) {
        $output .= '<h4>Benefits</h4>' . $benefits;
    }
    $output = apply_filters('the_content', $output);
    return $output;
}

add_shortcode('job_listing', 'job_listing');


// Add Post Content to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_quote_content');

function synerzip_quote_content($shortcodes) {
    $shortcodes['vc_quote_content'] = array(
        'name' => __('Quote', 'my-text-domain'),
        'base' => 'vc_quote_content',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Quote + Data', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Add Webinar Type to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_webinar_timing');

function synerzip_webinar_timing($shortcodes) {
    $shortcodes['webinar_timing'] = array(
        'name' => __('Webinar Timing', 'my-text-domain'),
        'base' => 'webinar_timing',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Webinar Timing', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Add Webinar Date to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_webinar_date');

function synerzip_webinar_date($shortcodes) {
    $shortcodes['webinar_date'] = array(
        'name' => __('Webinar Date', 'my-text-domain'),
        'base' => 'webinar_date',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Webinar Date', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Add Custom Permalink Button to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_more_button');

function synerzip_more_button($shortcodes) {
    $shortcodes['synerzip_more_button'] = array(
        'name' => __('More Button', 'my-text-domain'),
        'base' => 'synerzip_more_button',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Custom More Button', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Add Story Type to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_story_type');

function synerzip_story_type($shortcodes) {
    $shortcodes['synerzip_story_type'] = array(
        'name' => __('Story Type', 'my-text-domain'),
        'base' => 'synerzip_story_type',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Story Type', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Add Hashtags to Grid Builder
add_filter('vc_grid_item_shortcodes', 'synerzip_story_tags');

function synerzip_story_tags($shortcodes) {
    $shortcodes['synerzip_story_tags'] = array(
        'name' => __('Story Tags', 'my-text-domain'),
        'base' => 'synerzip_story_tags',
        'category' => __('Content', 'my-text-domain'),
        'description' => __('Show Story Tags', 'my-text-domain'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );
    return $shortcodes;
}

// Show webinar date or post date
add_shortcode('synerzip_story_type', 'vc_story_type_render');

function vc_story_type_render() {
    $post_id = '{{ post_data:ID }}';
    return '[story_type id="' . $post_id . '"]';
}

// Show webinar date or post date
add_shortcode('synerzip_story_tags', 'vc_story_tags_render');

function vc_story_tags_render() {
    $post_id = '{{ post_data:ID }}';
    return '[story_tags id="' . $post_id . '"]';
}

// Show webinar date or post date
add_shortcode('webinar_date', 'vc_webinar_date_render');

function vc_webinar_date_render() {
    $post_id = '{{ post_data:ID }}';
    return '[date_meta id="' . $post_id . '"]';
}

// Show webinar/upcoming webinar
add_shortcode('webinar_timing', 'vc_webinar_timing_render');

function vc_webinar_timing_render() {
    $post_id = '{{ post_data:ID }}';
    return '[webinar_timer id="' . $post_id . '"]';
}

// Show custom permalink button
add_shortcode('synerzip_more_button', 'vc_synerzip_more_button_render');

function vc_synerzip_more_button_render() {
    $post_id = '{{ post_data:ID }}';
    return '[more_button id="' . $post_id . '"]';
}

// Show testimonial quote
add_shortcode('vc_quote_content', 'vc_post_content_render');

function vc_post_content_render() {
    $post_id = '{{ post_data:ID }}';
    return '<blockquote>{{ post_data:post_content }}<cite>[quote_meta id="' . $post_id . '"]</cite></blockquote>';
}

// Search form
add_shortcode('synerzip_search', 'synerzip_search');

function synerzip_search() {
    return '<form role="search" method="get" id="site_search" action="/" >
    <input type="text" name="s" id="s" class="text" placeholder="Search Site" aria-label="Search" value="" />
    <button id="search_submit" class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	</form>';
}

// Hide shortcodes in search results
add_filter('relevanssi_pre_excerpt_content', 'rlv_trim_shortcodes');

function rlv_trim_shortcodes($content) {
    $content = preg_replace('/\[\/?vc_.*?\]/', '', $content);
    return $content;
}

// Job Title
add_shortcode('job_title', 'job_title');

function job_title() {
    return get_the_title($_GET["j"]);
}

// Remove extra shortcodes
function vc_remove_shortcodes_from_vc_grid_element($shortcodes) {
    unset($shortcodes['vc_custom_heading']);
    return $shortcodes;
}

// using wp filter hook to remove shortcodes from the list;
add_filter('vc_grid_item_shortcodes', 'vc_remove_shortcodes_from_vc_grid_element', 100);

//Adds post title to job form
add_filter('gform_field_value_job', create_function("", '$value = get_the_title($_GET["j"]); return $value;'));

// Submit webinar to Pardot
add_action('gform_after_submission_6', 'post_to_pardot', 10, 2);

function post_to_pardot($entry, $form) {

    $post_url = 'http://go.synerzip.com/l/130341/2016-12-01/269587i/?';
    $post_url .= 'fn=' . rgar($entry, '14');
    $post_url .= '&ln=' . rgar($entry, '15');
    $post_url .= '&em=' . rgar($entry, '2');
    $post_url .= '&co=' . rgar($entry, '3');
    $post_url .= '&ti=' . rgar($entry, '4');
    $post_url .= '&cy=' . rgar($entry, '10');
    $post_url .= '&ci=' . rgar($entry, '6.3') . rgar($entry, '11.3');
    $post_url .= '&st=' . rgar($entry, '6.4');
    $post_url .= '&ph=' . rgar($entry, '5') . rgar($entry, '16');
    $post_url .= '&ex=' . rgar($entry, '12');
    $post_url .= '&pt=' . rgar($entry, '13');
    $post_url .= '&ep=' . rgar($entry, '9');

    error_log($post_url, 1, 'leia@thirdinteractive.com');


    $request = new WP_Http();
    $response = $request->post($post_url);
    error_log('gform_after_submission: response => ' . print_r($response, true), 1, 'leia@thirdinteractive.com');
}

add_action('gform_after_submission_10', 'post_to_pardot_10', 10, 2);

function post_to_pardot_10($entry, $form) {

    $post_url = 'http://go.synerzip.com/l/130341/2017-01-16/27xqh8?';
    $post_url .= 'fn=' . rgar($entry, '14');
    $post_url .= '&ln=' . rgar($entry, '15');
    $post_url .= '&em=' . rgar($entry, '2');
    $post_url .= '&co=' . rgar($entry, '3');
    $post_url .= '&ti=' . rgar($entry, '4');
    $post_url .= '&cy=' . rgar($entry, '10');
    $post_url .= '&ci=' . rgar($entry, '6.3') . rgar($entry, '11.3');
    $post_url .= '&st=' . rgar($entry, '6.4');
    $post_url .= '&ph=' . rgar($entry, '5') . rgar($entry, '16');
    $post_url .= '&ex=' . rgar($entry, '12');
    $post_url .= '&pt=' . rgar($entry, '13');
    $post_url .= '&ep=' . rgar($entry, '9');

    error_log($post_url, 1, 'leia@thirdinteractive.com');


    $request = new WP_Http();
    $response = $request->post($post_url);
    error_log('gform_after_submission: response => ' . print_r($response, true), 1, 'leia@thirdinteractive.com');
}

// Add Gravity Forms Capabilities to Editor role
function add_grav_forms() {
    $role = get_role('editor');
    $role->add_cap('gform_full_access');
}

add_action('admin_init', 'add_grav_forms');

function displaydate() {
    return date('Ymd');
}

add_shortcode('todaydate', 'displaydate');

//function added synerzip to show webinar registration form on page
// Webinar Meta shortcode
function webinar_meta_withpardot($atts) {
    global $post;

    $pardotform = get_post_meta($post->ID, 'pardot_form', true);
    $date = get_post_meta($post->ID, 'date', true);
    $time = get_post_meta($post->ID, 'time', true);
    $timestamp = $date . ' 20:00:00';
    $today = date("Y-m-d H:i:s");
    if (strtotime($timestamp) > strtotime($today)) {
        $future = true;
    }
    $output = '';
    if ($date) {
        $date = date("l, F j, Y", strtotime($date));
        $output .= '<h6>Date</h6>';
        $output .= '<div class="storymeta">' . $date . '</div>';
        //    $output .= '<div class="storymeta">15-17 August, 2017</div>';
    }
    if ($time) {
        $output .= '<h6>Time</h6>';
        $output .= '<div class="storymeta">' . $time . '</div>';
    }
    if ($future && $pardotform) {

        $output .= '<script type="text/javascript">
		  var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		  var eventer = window[eventMethod];
		  var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
		  eventer(messageEvent, function(e) {
		     if (isNaN(e.data)) return;
		     document.getElementById("sizetracker").style.height = e.data + "px";
			}, false);
		</script><iframe src="' . $pardotform . '" width="100%"  scrolling="no" id="sizetracker"></iframe>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.3/iframeResizer.min.js"></script>';
    }
    return $output;
}

add_shortcode('webinar_meta_withpardot', 'webinar_meta_withpardot');

//function to remove jquery-migrate
function isa_remove_jquery_migrate(&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        // $scripts->add( 'jquery', false, array( 'jquery-core' ), 'null' );
        $scripts->add('jquery', '/wp-includes/js/jquery/jquery.js', array(), null);
    }
}

add_filter('wp_default_scripts', 'isa_remove_jquery_migrate');

//remove version from all the css & js

function ewp_remove_script_version($src) {
    return remove_query_arg('ver', $src);
}

add_filter('script_loader_src', 'ewp_remove_script_version', 15, 1);
add_filter('style_loader_src', 'ewp_remove_script_version', 15, 1);

add_action('wp_enqueue_scripts', 'remove_script_css');

function remove_script_css() {
    //wp_dequeue_style( 'default-css' );
    wp_dequeue_script('comment-reply');
}

add_filter('template_include', 'hashtag_page_template', 99);

function hashtag_page_template($template) {
    global $wp_query;
    $queried_object = $wp_query->get_queried_object();
    if (isset($queried_object->name))
        $hashtag = $queried_object->name;

   // $post_object = get_field('hashtags_in_new_design', 'option');

    if (isset($post_object)) {
        foreach ($post_object as $key => $value) {
            if ($value->name == $hashtag) {
                $showhashtagpage = 1;
                break;
            }
        }
    }

    if (is_page('hashtag-homepage') || $showhashtagpage == 1) {
        $new_template = locate_template(array('single-posters.php'));
        if ('' != $new_template) {
            return $new_template;
        }
    }
    return $template;
}

function estimate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));

    $minutes = floor($word_count / 200);
    $seconds = floor($word_count % 200 / (200 / 60));

    $str_minutes = ($minutes == 1) ? "minute" : "minutes";
    $str_seconds = ($seconds == 1) ? "second" : "seconds";

    if ($minutes == 0) {
        if ($seconds == 0)
            return '';
        else
            return "1 {$str_minutes}";
    }
    else {
        return "{$minutes} {$str_minutes}";
    }
}

function pull_bestPractices() {
    global $post;
    $hashtags = get_the_terms($post->ID, 'practice');
}

function hashtagged_content($condition) {
    //Rule - show post/webinar based on hashtag , if not , show latest one.
    global $post;
    //logic - show webinar based on hashtag , if not , show latest one.
    //if(!isset($condition['post__not_in']))
    //$condition['post__not_in'] =array($post->ID);
    //echo "<pre>";print_r($condition);
    $hashtags = get_the_terms($post->ID, 'hashtag');
    $arrhashtag = array();
    foreach ($hashtags as $hashtag) {
        $arrhashtag[] = $hashtag->slug;
    }
    $the_query = fetch_rulequery($arrhashtag, $condition);

    if (!empty($the_query->posts)) {
        $i = 0;
        //echo "<pre>";print_r($the_query->posts);
        $today = strtotime(date("Y-m-d H:i:s"));

        foreach ($the_query->posts as $thePost) {
            if (isset($thePost) && $thePost instanceof WP_Post) {


                $limit = $condition['description_limit'];
                $postid = $thePost->ID;
                $output[$postid]['ID'] = $thePost->ID;
                $output[$postid]['description'] = wp_trim_words($thePost->post_content, 60);
                $output[$postid]['description'] = trim_content(preg_replace("#\[[^\]]+\]#", '', $output[$postid]['description']), 150);
                if (isset($condition['reading_time']) && $condition['reading_time'] == 1 && $thePost->post_content != '')
                    $output[$postid]['reading_time'] = estimate_reading_time($thePost->post_content);
                $output[$postid]['sb_thumb'] = get_the_post_thumbnail_src(get_the_post_thumbnail($thePost->ID));
                $output[$postid]['url'] = get_permalink($thePost->ID);
                $output[$postid]['title'] = $thePost->post_title;
                $output[$postid]['meta'] = get_post_meta($thePost->ID);
                $output[$postid]['writer'] = get_field('writer', $thePost->ID);
                $output[$postid]['date'] = get_post_meta($thePost->ID, 'date', true);
                $output[$postid]['post_type'] = $condition['post_type'];
                if (isset($output[$postid]['meta']['link_page']) && $output[$postid]['meta']['link_page'][0] != '')
                    $output[$postid]['link_relavant_page'] = get_permalink($output[$postid]['meta']['link_page'][0]);
                $date = strtotime($output[$postid]['date']);
                if (isset($date)) {
                    if ($date < $today) {
                        $output[$postid]['ShowWebinarDate'] = date("d M Y", $date);
                        $output[$postid]['ShowWebinarText'] = "Download webinar";
                    } else {
                        $output['upcoming'] = 1;
                        $output['upcoming_webinar_id'] = $postid;
                        $output[$postid]['ShowWebinarDate'] = date("d M ", $date);
                        $output[$postid]['ShowWebinarText'] = "Register Now";
                    }
                }
                $output[$postid]['time'] = get_post_meta($thePost->ID, 'time', true);
            } else {

                //when query returns only post id e.g webinar
                //$postid=$postid;
                $output[$postid]['ID'] = $postid;
                $output[$postid]['date'] = get_post_meta($thePost, 'date', true);
                $output[$postid]['time'] = get_post_meta($thePost, 'time', true);
                $output[$postid]['title'] = get_the_title($thePost);
                //$output[$i]['title']=get_the_title($thePost);
                $output[$postid]['url'] = get_permalink($thePost);
                // Get Post Thumbnail for pinterest
                $output[$postid]['sb_thumb'] = get_the_post_thumbnail_src(get_the_post_thumbnail($thePost));
                $output[$postid]['writer'] = get_field('writer', $thePost);
            }
            $i++;
        }

        wp_reset_query();
    } else {
        if ($condition['post_type'] == 'webinar') {
            $post_object = get_field('next_webinar', 'option');
            if ($post_object) {
                $postid = $post_object->ID;
                $output[$postid]['ID'] = $post_object->ID;
                $output[$postid]['date'] = get_post_meta($post_object->ID, 'date', true);
                $output[$postid]['time'] = get_post_meta($post_object->ID, 'time', true);
                $output[$postid]['title'] = get_the_title($post_object->ID);
                $output[$postid]['url'] = get_permalink($post_object->ID);
                $output[$postid]['sb_thumb'] = get_the_post_thumbnail_src(get_the_post_thumbnail($post_object, 'medium'));
            }
        } else {
            $output = array();
            $the_query = fetch_rulequery(array(), $condition);
            if (!empty($the_query->posts)) {
                foreach ($the_query->posts as $thePost) {
                    if (isset($thePost) && $thePost instanceof WP_Post) {
                        $postid = $thePost->ID;
                        $limit = $condition['description_limit'];
                        $output[$postid]['description'] = trim_content($thePost->post_content, 500);
                        $output[$postid]['sb_thumb'] = get_the_post_thumbnail_src(get_the_post_thumbnail($thePost->ID, 'medium'));
                        $output[$postid]['url'] = get_permalink($thePost->ID);
                        $output[$postid]['title'] = $thePost->post_title;
                        $output[$postid]['writer'] = get_field('writer', $thePost->ID);
                        $output[$postid]['meta'] = get_post_meta($thePost->ID);
                    }
                }
            }
        }
    }
    return $output;
}

function fetch_rulequery($passhash, $condition) {

    $args = array(
        'no_found_rows' => 1,
    );
    //echo "<pre>";print_r($passhash);

    if ($passhash != "showAll" && !empty($passhash) && empty($condition['tax_query'])) {
        $tax = array('tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'value',
                    'field' => 'slug',
                    'terms' => $passhash,
                ),
                array(
                    'taxonomy' => 'practice',
                    'field' => 'slug',
                    'terms' => $passhash,
                ),
                array(
                    'taxonomy' => 'technology',
                    'field' => 'slug',
                    'terms' => $passhash,
                ),
            ),
        );
        $args = array_merge($args, $tax);
    }


    $args = array_merge($args, $condition);


    $the_query = new WP_Query($args);
//echo "<pre>";print_r($the_query);
    return $the_query;
}

function get_the_post_thumbnail_src($img) {
    return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

//Function for beta pages//

function getParentandChildTaxonomy($taxonomyName = '', $child = 0) {
    if ($child == 0) {
        return $terms = get_terms(array(
            'taxonomy' => $taxonomyName,
            'parent' => 0,
        ));
    } else {
        return $terms = get_terms(array(
            'taxonomy' => $taxonomyName,
        ));
    }
}

add_action('pre_get_posts', 'change_num_posts_in_grid');

function change_num_posts_in_grid($query) {
    global $wp_the_query;
    if ($query->is_main_query() && is_tax()) {
        $query->set('posts_per_page', '20');
    }
}
function humanTiming ($time)
        {

            $time = time() - $time; // to get the time since that moment
            $time = ($time<1)? 1 : $time;
            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'') .' ago';
            }

        }

?>
<?php
add_action('wp_ajax_nopriv_load_webinars_by_ajax', 'load_webinars_by_ajax_callback');
add_action('wp_ajax_load_webinars_by_ajax', 'load_webinars_by_ajax_callback');

function load_webinars_by_ajax_callback() {
    $paged = $_POST['page']+2;
    $args = array(
        'post_type' => 'webinar',
         //'post_status'=>'publish',
        'posts_per_page' => '3',
        'paged' => $paged,
    );

    $webinars = fetch_rulequery('showAll', $args)->posts;
    foreach ($webinars as $webinar) {
        $webinar->webinarDate = get_post_meta($webinar->ID, 'date', true);
        $webinar->url = get_permalink($webinar->ID);
        ?>
       <tr onclick="document.location='<?php echo $webinar->url; ?>'" >
            <td><?php echo $webinar->post_title; ?></td>
            <td><?php
        $date = new DateTime($webinar->webinarDate);
        echo $date->format('j M Y');
        //echo $eachWebinar->webinarDate; 
        ?></td>
            <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
        </tr>
        <?php
    }

}
wp_reset_postdata();
?>
<?php
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    $paged = $_POST['page']+1;
    $args = array(
        'post_type' => 'webinar',
       // 'post_status'=>'publish',
        'posts_per_page' => '3',
        'paged' => $paged,
    );
    $webinars = fetch_rulequery('showAll', $args)->posts;
    foreach ($webinars as $webinar) {
        $webinar->webinarDate = get_post_meta($webinar->ID, 'date', true);
        $webinar->url = get_permalink($webinar->ID);
        ?>
       <tr onclick="document.location='<?php echo $webinar->url; ?>'" >
            <td><?php echo $webinar->post_title; ?></td>
            <td><?php
        $date = new DateTime($webinar->webinarDate);
        echo $date->format('j M Y');
        
        ?></td>
            <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
        </tr>
<?php }

    }
    ?>
<?php
add_action('wp_ajax_nopriv_load_blogs_by_ajax', 'load_blogs_by_ajax_callback');
add_action('wp_ajax_load_blogs_by_ajax', 'load_blogs_by_ajax_callback');
function load_blogs_by_ajax_callback() {
    $paged = $_POST['page']+1;
    $args = array(
        'post_type' => 'post',
       // 'post_status'=>'publish',
        'posts_per_page' => '9',
        'paged' => $paged,
    );
    $blogs = fetch_rulequery('showAll', $args)->posts;?>
     <ul class="grid effect-2" id="grid">
         <?php
     foreach ($blogs as $blog)
    {
	//echo "<pre>";print_r($post);exit;
		$blog->postLink=get_permalink($blog->ID);
	$blog->time= estimate_reading_time($blog->post_content);
	$trimmed_content=wp_trim_words($blog->post_content,50);
	$blog->image= get_the_post_thumbnail_src(get_the_post_thumbnail( $blog->ID ,thumbnail));
	if(!isset($blog->image)|| $blog->image=='')
	$blog->image='/wp-content/themes/synerzip/beta_images/placeholder.png';

	if($blog->ID !=$post_object->ID){
	
		?>
      <li class="grid-item card">
        <div class="card-img">
         <a href="<?php echo $blog->postLink;?>"><img src="<?php echo $blog->image;?>"></a>
        </div>
        <div class="card-details">
           <a href="<?php echo $blog->postLink;?>"><h5 class="card-title"><?php echo $blog->post_title;?></h5></a>
          <p class="card-content"><?php echo $trimmed_content;?> </p>
          <div class="card-action push-down-5">
          <span><?php echo $blog->post_date;?></span>
          <span class="right"><?php echo $blog->time;?></span>
          </div>
        </div>
      </li>
		<?php }}?> 
    </ul>
 <?php  
   wp_die();
}
?>
<?php
add_action('wp_ajax_nopriv_load_jobs_by_ajax', 'load_jobs_by_ajax_callback');
add_action('wp_ajax_load_jobs_by_ajax', 'load_jobs_by_ajax_callback');

function load_jobs_by_ajax_callback() {
    $paged = $_POST['page']+2;
    $args = array(
        'post_type' => 'job',
        // 'post_status'=>'publish',
        'posts_per_page' => '3',
        'paged' => $paged,
    );
     

   $allPosts = fetch_rulequery('showAll', $args)->posts;
    foreach($allPosts as $jobPost)
			  {
				  $location = get_the_terms( $jobPost->ID , 'location' );
				  $jobPost->years_of_experience = get_field('years_of_experience',$jobPost->ID);
				  $jobPost->link=get_permalink($jobPost->ID);
        ?>
       <tr onclick="document.location='<?php echo $jobPost->link; ?>'" >
            <td><?php echo $jobPost->post_title; ?></td>
            <td><?php  echo $jobPost->years_of_experience; ?>years of experience</td>
   
       
            <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
        </tr>
        <?php
    }
 wp_die();
}

/*div#acf-home_page_carousel_items select {
    min-height: 250px !important;
}*/
function syn_post_object_query_reorder( $args) {
    static $cssAdded = false;
    if (!$cssAdded){
        $cssAdded = true;
        // echo '<style>div#acf-home_page_carousel_items select {
        //     min-height: 250px !important;
        // }</style>';
        echo '<script>
        jQuery(document).ready(function(){
            jQuery(".acf_postbox select").chosen();
        })
        </script>';

    }
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    $args['sort_column'] = 'date';
    $args['sort_order'] = 'DESC';
    return $args;
}
add_filter('acf/fields/post_object/query/name=home_page_carousel_items', 'syn_post_object_query_reorder');
?>