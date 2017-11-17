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

	function fpt_insert_transitions() {
		$transition_type = get_option('fpt-opt-transition-type');
		$transition_main_color = get_option('fpt-opt-transition-main-color');

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
		
		//Spinner
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-type');
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-delay');
		register_setting('fpt-opt-settings-group', 'fpt-opt-spinner-main-color');
	}

	function fpt_options_settings_page() {
		/*
		 * This is the content for the main page of the custom option-page.
		 * You can create general settings here,
		 * but as of now, the page is for general information an documentation.
		 */
	?>
	
	<div class="wrap">
		<h1><?php _e('Fake Transitions', 'Headline for subpage', 'rbl-custom-options'); ?></h1>

		<form method="post" action="options.php">
			<?php
				/*
				 * Initiate the setting-section.
				 * Remember to rename subpage to the url-friendly version of your pages name.
				 */
				settings_fields( 'fpt-opt-settings-group' );
				do_settings_sections( 'fpt-opt-settings-group' );
		
				$transition_type = get_option('fpt-opt-transition-type');
				$spinner_type = get_option('fpt-opt-spinner-type');
			?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Transition Type', 'rbl-fake-page-transitions'); ?></th>
					<td>
						<select name="fpt-opt-transition-type" id="fpt-opt-transition-type">
							<option value=""><?php _e('Select a transition-type', 'rbl-fake-page-transitions'); ?></option>
							<option value="fade" <?php echo ($transition_type == 'fade') ? 'selected' : ''; ?>><?php _e('Fade in/out', 'rbl-fake-page-transitions'); ?></option>
							<option value="collapse-vert" <?php echo ($transition_type == 'collapse-vert') ? 'selected' : ''; ?>><?php _e('Collapse vertical', 'rbl-fake-page-transitions'); ?></option>
							<option value="collapse-horz" <?php echo ($transition_type == 'collapse-horz') ? 'selected' : ''; ?>><?php _e('Collapse Horizontal', 'rbl-fake-page-transitions'); ?></option>
							<option value="collapse-diag-vert" <?php echo ($transition_type == 'collapse-diag-vert') ? 'selected' : ''; ?>><?php _e('Collapse Diagonal/Vertical', 'rbl-fake-page-transitions'); ?></option>
							<option value="collapse-diag-horz" <?php echo ($transition_type == 'collapse-diag-horz') ? 'selected' : ''; ?>><?php _e('Collapse Diagonal/Horizontal', 'rbl-fake-page-transitions'); ?></option>
						</select>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><?php _e('Transition Main Color', 'rbl-fake-page-transitions'); ?></th>
					<td>
						<input type="color" name="fpt-opt-transition-main-color" id="fpt-opt-transition-main-color" value="<?php echo get_option('fpt-opt-transition-main-color'); ?>">
					</td>
				</tr>
			</table>
			
			<h2><?php _e('Spinner', 'rbl-fake-page-transitions'); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Spinner Type', 'rbl-fake-page-transitions'); ?></th>
					<td>
						<select name="fpt-opt-spinner-type" id="fpt-opt-spinner-type">
							<option value="none" <?php echo ($spinner_type == 'none') ? 'selected' : ''; ?>><?php _e('No spinner', 'rbl-fake-page-transitions'); ?></option>
							<option value="bars" <?php echo ($spinner_type == 'bars') ? 'selected' : ''; ?>><?php _e('Bars', 'rbl-fake-page-transitions'); ?></option>
						</select>
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><?php _e('Spinner Main Color', 'rbl-fake-page-transitions'); ?></th>
					<td>
						<input type="color" name="fpt-opt-spinner-main-color" id="fpt-opt-spinner-main-color" value="<?php echo get_option('fpt-opt-spinner-main-color'); ?>">
					</td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><?php _e('Spinner Delay (in ms)', 'rbl-fake-page-transitions'); ?></th>
					<td>
						<?php
							$spinner_delay = get_option('fpt-opt-transition-delay');
							if(empty($spinner_delay))
								$spinner_delay = 500;
						?>
						<input type="number" class="widefat" name="fpt-opt-spinner-delay" id="fpt-opt-spinner-delay" value="<?php echo $spinner_delay; ?>">
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
	}
