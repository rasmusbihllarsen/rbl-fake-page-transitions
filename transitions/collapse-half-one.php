<div class="rbl_fake_transitions--collapse_half_one fpt_top active" style="background-color:<?php echo $transition_main_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_half_one fpt_bottom active" style="background-color:<?php echo $transition_secondary_color ?>;"></div>
<div class="rbl_fake_transitions--collapse_half_one fpt_spinner">
	<?php
		if(!empty($spinner_type)){
			include(plugin_dir_path(__FILE__).'/../spinners/'.$spinner_type.'.php');
		}
	?>
</div>