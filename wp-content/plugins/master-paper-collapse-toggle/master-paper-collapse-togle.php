<?php
/**
 * @package Master Paper Collapse Toggle
 * @author Luis Rock
 * @version 1.1
 */
/*
Plugin Name: Master Paper Collapse Toggle
Plugin URI: http://luisrock.com
Description: Based on jQuery Paper Collapse Plugin, by Alexander Rühle, this WordPress plugin allows you to create accordion/toggle in format of collapsible paper cards, inspired by Google Material Design.
Author: Luis Rock
Version: 1.1
Author URI: http://luisrock.com
*/

/*  Copyright 2014 Luis Rock 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
JQuery Paper Collapse (v0.2.0) License

Copyright (c) 2014 Alexander Rühle

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

if ( ! defined( 'ABSPATH' ) ) exit;

//Just registering script and style files (the goal is not including them until shortcode is inserted)

	//Base JQuery script
add_action( 'wp_enqueue_scripts', 'register_master_paper_collapse_jq' );
	
	function register_master_paper_collapse_jq() {
		wp_register_script( 'master-paper-collapse-jq',
						plugin_dir_url(__FILE__) . 'js/master-paper-collapse.min.js',
						array('jquery'),
						'1.0.0',
						true);
		}
		
	//CSS file
add_action( 'wp_enqueue_scripts', 'register_master_paper_collapse_style' );

	function register_master_paper_collapse_style() {
		wp_register_style( 'mpc-style', 
						plugins_url( 'css/master-paper-collapse.min.css', __FILE__ ) );		}
						


//---------Paper Collapse SHORTCODE--------------
function getMasterPapercollapse( $atts, $content = null ) {
	extract(shortcode_atts (
		array (
			'title' => '',
			'icon' => 'fa-bullseye',
			'color' => ''
		),
		$atts ) );

//inserting scripts and style

		wp_enqueue_script( 'master-paper-collapse-jq' );
		wp_enqueue_style( 'mpc-style');
		wp_enqueue_style( 'mpc-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' ); 

//inserting the HTML element needed by JQuery
$out  = '<div class="collapse-card"><div class="mpc-title" style="color:' . $color .'">';

		if ($icon != 'no') {
$out .= '<i class="mpc-icon fa ' . $icon . ' fa-2x fa-fw"></i>';
	}
$out .= '<strong>' . $title . '</strong> </div>';
$out .= '<div class="mpc-body">' . do_shortcode($content) . '</div></div>';

        return $out;
}
// Allow us to add the pull collapse using Wordpress shortcode, "[accpaper][/accpaper]" 
add_shortcode('mpaper', 'getMasterPaperCollapse');