<div class="rbl_fake_transitions--collapse_diag-vert fpt_top active" style="border-color:<?php echo $transition_main_color ?>;border-left-color:transparent;border-bottom-color:transparent;"></div>
<div class="rbl_fake_transitions--collapse_diag-vert fpt_bottom active" style="border-color:<?php echo $transition_main_color ?>;border-right-color:transparent;border-top-color:transparent;"></div>
<div class="rbl_fake_transitions--collapse_vert fpt_spinner">
	<?php
		if(!empty($spinner_type)){
			include(plugin_dir_path(__FILE__).'/../spinners/'.$spinner_type.'.php');
		}
	?>
</div>