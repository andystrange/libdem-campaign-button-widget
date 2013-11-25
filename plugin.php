<?php
/*
Plugin Name: Liberal Democrat Campaign Buttons Widget
Plugin URI: 
Description: Adds a widget that displays Mark Pack's Liberal Democrat Campaign Buttons.
Version: 1.0
Author: Andy Strange
Author URI: grit-oyster.co.uk/plugins
Author Email: web@grit-oyster.co.uk
Text Domain: libdem-campaign-buttons-widget-locale
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2013 TODO (email@domain.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// TODO: change 'Widget_Name' to the name of your plugin
class LibDem_Campaign_Buttons_Widget extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// TODO:	update classname and description
		// TODO:	replace 'widget-name-locale' to be named more plugin specific. Other instances exist throughout the code, too.
		parent::__construct(
			'libdem-campaign-buttons-widget-id',
			__( 'Lib Dem Campaign Buttons Widget', 'libdem-campaign-buttons-widget-locale' ),
			array(
				'classname'		=>	'libdem-campaign-buttons-widget-class',
				'description'	=>	__( 'Short description of the widget goes here.', 'libdem-campaign-buttons-widget-locale' )
			)
		);

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$title = $instance['title'];

		$style = $instance['style'];

		if ( $style == 'default') {

			$style_string = '';
	
		} else {

			$style_string = '?style=' . $style;

		}

		include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['style'] = $new_instance['style'];

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

    	$defaults = array(
			'title' => '',
			'style' => 'default'
		);
				
		$instance = wp_parse_args( $instance, $defaults );

		$display_title = $instance['title'];
		$display_style = $instance['style'];


		// Display the admin form
		include( plugin_dir_path(__FILE__) . 'views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {

		// TODO be sure to change 'widget-name' to the name of *your* plugin
		load_plugin_textdomain( 'libdem-campaign-buttons-widget-locale', false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} // end widget_textdomain

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param		boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		// TODO:	Change 'widget-name' to the name of your plugin
		wp_enqueue_style( 'libdem-campaign-buttons-widget-admin-styles', plugins_url( 'widget-name/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		// TODO:	Change 'widget-name' to the name of your plugin
		wp_enqueue_script( 'libdem-campaign-buttons-widget-script', plugins_url( 'widget-name/js/admin.js' ), array('jquery') );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

		// TODO:	Change 'widget-name' to the name of your plugin
		wp_enqueue_style( 'libdem-campaign-buttons-widget-styles', plugins_url( 'widget-name/css/widget.css' ) );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

		// TODO:	Change 'widget-name' to the name of your plugin
		wp_enqueue_script( 'libdem-campaign-buttons-widget-script', plugins_url( 'widget-name/js/widget.js' ), array('jquery') );

	} // end register_widget_scripts


	/**
	 * 
	 */
	public function get_display_styles() {

		$styles = array(
			'default',
			'dark',
			'gold',
			'green',
			'grey',
			'aqua',
			'text' );

	return $styles;

	} // end get_display_styles





} // end class

// TODO:	Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("LibDem_Campaign_Buttons_Widget");' ) );
