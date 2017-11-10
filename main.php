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
?>
	<div class="rbl_fake_transitions active">
		<?php
			$transition_type = 'fade';
			$transition_color = '#ffffff';
		
			switch($transition_type){
				case 'fade':
				default:
					echo '<div class="rbl_fake_transitions--fade active" style="background-color:'.$transition_color.';"></div>';
					break;
			}
		?>
	</div>
<?php
	}
	add_action( 'wp_footer', 'fpt_insert_transitions' );
?>