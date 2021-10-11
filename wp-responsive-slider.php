<?php

/**
 * Plugin Name: OS3 Responsive Slider for Elementor
 * Plugin URI: https://wordpress.org/plugins/
 * Description: This plugin will create responsive slider/carousel for Elementor.
 * Version: 1.0.2
 * Author: Fabio Rotondo - OS3 srl
 * Author URI: https://www.os3.it/
 * License: GPLv2
 * Text Domain: wp-responsive-slider
 * Domain Path: /languages/
 */

define('OS3_Responsive_Slider', plugin_dir_path(__FILE__));
final class OS3_Responsive_Slider
{
	const VERSION = '1.0.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function __construct()
	{

		add_action('plugins_loaded', [$this, 'wp_responsive_slider']);
	}

	public function i18n()
	{

		load_plugin_textdomain('wp-responsive-slider');
	}

	public function wp_responsive_slider()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	public function is_compatible()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}


	public function init()
	{
		$this->i18n();
		// Add Plugin actions
		add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
		add_action('elementor/elements/categories_registered', [$this, 'register_new_category']);
		add_action('elementor/frontend/after_enqueue_scripts', array($this, 'widget_assets_enqueue'));
	}

	public function init_widgets()
	{
		require_once(OS3_Responsive_Slider . './widgets/responsive-slider.php');
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor\Responsive_Slider());
	}

	public function register_new_category($elements_manager)
	{
		$elements_manager->add_category(
			'wp-responsive-slider',
			[
				'title' => __('WP Responsive Slider', 'wp-responsive-slider'),
			]
		);
	}

	public function widget_assets_enqueue()
	{
		wp_enqueue_style('wp-responsive-slider-css', plugin_dir_url(__FILE__) . 'assets/css/style.css', null, time(), null);
		wp_enqueue_script('wp-responsive-slider-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', ['jquery'], '1.0.0', true);
	}

	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'wp-responsive-slider'),
			'<strong>' . esc_html__('wp responsive slider', 'wp-responsive-slider') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wp-responsive-slider') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wp-responsive-slider'),
			'<strong>' . esc_html__('wp responsive-slider', 'wp-responsive-slider') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wp-responsive-slider') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wp-responsive-slider'),
			'<strong>' . esc_html__('wp responsive slider', 'wp-responsive-slider') . '</strong>',
			'<strong>' . esc_html__('PHP', 'wp-responsive-slider') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

OS3_Responsive_Slider::instance();
