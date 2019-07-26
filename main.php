<?php
	/*
	 * Plugin Name: Fake Page Transitions
	 * Description: Make it look like your page is transitioning, even though it just changes page
	 * Version: 1.0.11
	 * Plugin URI: https://github.com/rasmusbihllarsen/rbl-fake-page-transitions
	 * Author URI: http://rasmusbihllarsen.com/
	 * Author: Rasmus Bihl Larsen
	 * Text Domain: rbl-fake-page-transitions
	 * GitHub Plugin URI: https://github.com/rasmusbihllarsen/rbl-fake-page-transitions
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
			wp_enqueue_style( 'fake-page-transitions-css', plugin_dir_url( __FILE__ ) . 'css/style.css', '1.0.0');
			wp_enqueue_style( 'fpt-admin-css', plugins_url( 'css/admin.css', __FILE__ ), '1.0.0' ); 
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

	add_action('wp_ajax_fpt_preview', 'fpt_preview');
	add_action('wp_ajax_nopriv_fpt_preview', 'fpt_preview');
	function fpt_preview()
	{
		$type = $_POST['type'];

		ob_start();
		include('transitions/' . $type .'.php');
		$html = ob_get_clean();
		
		switch($type) {
			case 'collapse-diag-vert':
			case 'collapse-diag-horz':
				$colored = 'border-color';
				break;
			default:
				$colored = 'background-color';
				break;
		}

		echo json_encode(array(
			'success'	=> true,
			'html'		=> $html,
			'colored'	=> $colored,
		));
		die();
	}

	include('pages/settings.php');
	include('updater.php');

	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$rep_name = 'rbl-fake-page-transitions';
		$user_name = 'rasmusbihllarsen';
		$config = array(
			'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
			'proper_folder_name' => $rep_name, // this is the name of the folder your plugin lives in
			'api_url' => 'https://api.github.com/repos/'.$user_name.'/'.$rep_name, // the GitHub API url of your GitHub repo
			'raw_url' => 'https://raw.github.com/'.$user_name.'/'.$rep_name.'/master', // the GitHub raw url of your GitHub repo
			'github_url' => 'https://github.com/'.$user_name.'/'.$rep_name, // the GitHub url of your GitHub repo
			'zip_url' => 'https://github.com/'.$user_name.'/'.$rep_name.'/zipball/master', // the zip url of the GitHub repo
			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
			'requires' => '3.0', // which version of WordPress does your plugin require?
			'tested' => '3.3', // which version of WordPress is your plugin tested up to?
			'readme' => 'README.md', // which file to use as the readme for the version number
			'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
		);
		new WP_GitHub_Updater($config);
	}
