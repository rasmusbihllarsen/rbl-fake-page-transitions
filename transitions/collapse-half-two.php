<div class="rbl_fake_transitions--collapse_half_two fpt_top active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_half_two fpt_bottom active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_half_two fpt_spinner">
	<?php
		if(!empty($spinner_type)){
			include(plugin_dir_path(__FILE__).'/../spinners/'.$spinner_type.'.php');
		}
	?>
</div>