<div class="rbl_fake_transitions--collapse_horz fpt_left active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_horz fpt_right active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_vert fpt_spinner">
	<?php
		if(!empty($spinner_type)){
			include(plugin_dir_path(__FILE__).'/../spinners/'.$spinner_type.'.php');
		}
	?>
</div>