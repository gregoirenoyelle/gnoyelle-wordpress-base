<?php
/*
Plugin Name: gnoyelle : Réglages Bases pour WordPress
Plugin URI: http://wwww.gregoirenoyelle.com
Description: Pour les sites développé par Grégoire Noyelle. Indépendamment de Genesis.
Version: 1.5
Author: Grégoire Noyelle
Author URI: http://wwww.gregoirenoyelle.com
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/gregoirenoyelle/gnoyelle-wordpress-base
GitHub Branch: master
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Disable editor
if ( ! defined('DISALLOW_FILE_EDIT') ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/***********
* CONSTANTES
************/

if ( ! defined( 'GN_WPB_PLUG_PATH' ) ) {
	define('GN_WPB_PLUG_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GN_WPB_PLUG_URL' ) ) {
	define('GN_WPB_PLUG_URL', plugin_dir_url( __FILE__ ) );
}

/**************************
* ENQUEUE ADMIN
**************************/

// scripts
add_action('admin_enqueue_scripts','gnwpbase_scripts');
function gnwpbase_scripts(){
	wp_register_script('gnwpbase-scripts', GN_WPB_PLUG_URL . '/gnwpbase.js', array('jquery'),'1.0',true);
	// place for conditionnal
	wp_enqueue_script('gnwpbase-scripts');
}

// CSS
add_action('admin_print_styles', 'gnwpbase_css', 11);
function gnwpbase_css() {
	wp_enqueue_style( 'gnwpbase-css', GN_WPB_PLUG_URL . '/gnwpbase.css');
}


/**************************
* ADMIN FUNCTION
**************************/

if ( ! function_exists('aff_p') ) {
	function aff_p($var) {
		echo "<pre style='style: white-space: pre-wrap;'>";
		print_r($var);
		echo "</pre>";
	}
}

if ( ! function_exists('aff_v') ) {
	function aff_v($var) {
		echo "<pre style='style: white-space: pre-wrap;'>";
		var_dump($var);
		echo "</pre>";
	}
}

/**************************
* TINYMCE
**************************/
/***
* default set up for $arr['block_formats']
* Paragraph=p;Address=address;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5; Heading 6=h6
***/
function gn_tinymce_filtre($arr){
	// remove h1 and h2
    $arr['block_formats'] = 'Paragraph=p;Address=address;Heading 3=h3;Heading 4=h4;Heading 5=h5';
    // remove Style color
    $arr['toolbar2']='formatselect,underline,alignjustify,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'gn_tinymce_filtre');

