<div class="rbl_fake_transitions--move_up fpt_top active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--move_up fpt_spinner">
	<?php
		if(!empty($spinner_type)){
			include(plugin_dir_path(__FILE__).'/../spinners/'.$spinner_type.'.php');
		}
	?>
</div>