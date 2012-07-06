<?php

/*

Plugin Name: 			Repo.js Shortcode
Plugin URI:       http://github/carstingaxion/
Description:      Shortcode to embed whole GitHub Repos via <a href="https://github.com/darcyclarke/Repo.js">repo.js</a> inside your content with a shortcode <strong>[repo name="" author=""]</strong>
Author:      			Carsten Bach
Version: 					1.0
Author URI:    		http://github/carstingaxion/

*/







class cbacb_RepoJsShortcode {

		/*
		*	Some required plugin information
		*/
		var $version = '1.0';


		function __construct() {
	    		add_action( 'wp_head', array( &$this, 'add_repo_js_scripts' ) );
	    		add_shortcode( 'repo', array( &$this, 'render_shortcode' ) );

	  }



	 /**
		*		Run during the activation of the plugin
		*/
		function activate() {

		}



		/**
		*		Run during the initialization of Wordpress
		*/
		function initialize() {

		}


    /**
     *
     *
     *  @since    1.0
     */
    function render_shortcode( $atts ) {
         // add repo.js to the footer of the given page

         extract(shortcode_atts(array('name' => '', 'author' => ''), $atts));
         $div_id  = sanitize_title_with_dashes( 'repo-js_'.$author.'-'.$name );
         return '<div id="'.$div_id.'"></div>'.
                '<script type="text/javascript">'.
                'jQuery(function($){'.
#                'jQuery(document).ready(function($) {'.
                '$("#'.$div_id.'").repo({ user: "'.$author.'", name: "'.$name.'" });'.
                '});'.
                '</script>';
    }



  	/**
  	 *  Add scripts
  	 *
     *  @since    1.0
  	 */
  	function add_repo_js_scripts ( ) {
        $repo_js = dirname( __FILE__ ).'/js/repo/repo.js';
    		wp_enqueue_script( 'repo-js', $repo_js, array( 'jquery' ), '1.0', false );
  	}



}



// Initalize the your plugin
$cbacb_RepoJsShortcode = new cbacb_RepoJsShortcode();

// Add an activation hook
#register_activation_hook(__FILE__, array(&$cbacb_RepoJsShortcode, 'activate'));

// Run the plugins initialization method
#add_action('init', array(&$cbacb_RepoJsShortcode, 'initialize'));

?>