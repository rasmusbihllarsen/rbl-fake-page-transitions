<?php
	/*
	 * Plugin Name: Fake Page Transitions
	 * Description: Make it look like your page is transitioning, even though it just changes page
	 * Version: 1.0.0
	 * Plugin URI: http://rasmusbihllarsen.com/
	 * Author URI: http://rasmusbihllarsen.com/
	 * Author: Rasmus Bihl Larsen
	 * Text Domain: rbl-fake-page-transitions
	 */

	//Enqueue javascript
	function fpt_enqueue_files() {
		wp_enqueue_style( 'fake-page-transitions-css', plugin_dir_url( __FILE__ ) . 'css/style.css', '1.0.0');
		wp_enqueue_script( 'fake-page-transitions-js', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), '1.0.0', true );
	}
	add_action( 'wp_enqueue_scripts', 'fpt_enqueue_files' );

	add_action( 'admin_enqueue_scripts', 'fpt_add_color_picker' );
	function fpt_add_color_picker() {
		if( is_admin() ) { 
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'fpt-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
		}
	}

	function fpt_insert_transitions() {
		$transition_type = get_option('fpt-opt-transition-type');
		$transition_main_color = get_option('fpt-opt-transition-main-color');
		$transition_secondary_color = get_option('fpt-opt-transition-secondary-color');
		
		if($transition_secondary_color == ''){
			$transition_secondary_color = $transition_main_color;
		}

		$spinner_type = get_option('fpt-opt-spinner-type');
		
		if(!empty($transition_type)){
	?>
	<div class="rbl_fake_transitions active">
		<?php
				include('transitions/'.$transition_type.'.php');

				if($spinner_type != 'none') {
					$spinner_delay = get_option('fpt-opt-spinner-delay');
					$spinner_main_color = get_option('fpt-opt-spinner-main-color');
			?>
			<div class="rbl_fpt_spinner--wrap active" data-delay="<?php echo $spinner_delay; ?>">
				<?php include('spinners/'.$spinner_type.'.php'); ?>
			</div>
			<?php  } ?>
	</div>
	<?php
		}
	}
	add_action( 'wp_footer', 'fpt_insert_transitions' );

	function fpt_options_create_menu() {
		$capability = 'administrator';

		add_menu_page('Transitions', __('Transitions', 'Menu text', 'rbl-fake-page-transitions'), $capability, 'fpt_option_settings', 'fpt_options_settings_page', 'dashicons-admin-generic', 80);
		add_action( 'admin_init', 'register_fpt_options_settings' );
	}
	add_action('admin_menu', 'fpt_options_create_menu');

	function register_fpt_options_settings() {
		register_setting('fpt-opt-settings-group', 'fpt-opt-transition-type');
		register_setting('fpt-opt-settings-group', 'fpt-opt-transition-main-color');
		register_setting('fpt-opt-settings-group', 'fpt-opt-transition-secondary-color');
		
		//Spinner
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-type');
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-delay');
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-main-color');
	}

include('pages/settings.php');
