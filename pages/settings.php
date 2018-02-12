<?php function fpt_options_settings_page() { ?>
<div class="wrap">
	<h1>
		<?php _e('Fake Transitions', 'Headline for subpage', 'rbl-custom-options'); ?>
	</h1>

	<form method="post" action="options.php">
		<?php
			settings_fields( 'fpt-opt-settings-group' );
			do_settings_sections( 'fpt-opt-settings-group' );

			$transition_type = get_option('fpt-opt-transition-type');
			$spinner_type = get_option('fpt-opt-spinner-type');

			$two_color_transitions = array(
				'collapse-diag-vert',
				'collapse-diag-horz',
				'collapse-half-one',
				'collapse-half-two',
			);
		?>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="postbox-container-1" class="postbox-container">
						<div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
							<div id="spinnerdiv" class="postbox ">
								<button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text"><?php _e('Vis eller skjul panel', 'rbl-fake-page-transitions'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button>
								<h2 class="hndle ui-sortable-handle"><span><?php _e('Preferences', 'rbl-fake-page-transitions'); ?></span></h2>
								<div class="inside">
									<?php submit_button(); ?>
								</div>
							</div>
						</div>
					</div>
					<div id="postbox-container-2" class="postbox-container">
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">

							<div id="transitiondiv" class="postbox" style="">
								<button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text"><?php _e('Vis eller skjul panel', 'rbl-fake-page-transitions'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button>
								<h2 class="hndle ui-sortable-handle"><span><?php _e('Transition', 'rbl-fake-page-transitions'); ?></span></h2>
								<div class="inside">
									<table>
										<tr>
											<td><strong><?php _e('Transition Type', 'rbl-fake-page-transitions'); ?></strong></td>
											<td>
												<select name="fpt-opt-transition-type" id="fpt-opt-transition-type">
												<option value=""><?php _e('No transition', 'rbl-fake-page-transitions'); ?></option>
												<option value="fade" <?php echo ($transition_type == 'fade') ? 'selected' : ''; ?>><?php _e('Fade in/out', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-vert" <?php echo ($transition_type == 'collapse-vert') ? 'selected' : ''; ?>><?php _e('Collapse Vertical', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-horz" <?php echo ($transition_type == 'collapse-horz') ? 'selected' : ''; ?>><?php _e('Collapse Horizontal', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-diag-vert" <?php echo ($transition_type == 'collapse-diag-vert') ? 'selected' : ''; ?>><?php _e('Collapse Diagonal/Vertical', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-diag-horz" <?php echo ($transition_type == 'collapse-diag-horz') ? 'selected' : ''; ?>><?php _e('Collapse Diagonal/Horizontal', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-half-one" <?php echo ($transition_type == 'collapse-half-one') ? 'selected' : ''; ?>><?php _e('Half/Half #1', 'rbl-fake-page-transitions'); ?></option>
												<option value="collapse-half-two" <?php echo ($transition_type == 'collapse-half-two') ? 'selected' : ''; ?>><?php _e('Half/Half #2', 'rbl-fake-page-transitions'); ?></option>
											</select>
											</td>
										</tr>

										<tr>
											<td><strong><?php _e('Transition Main Color', 'rbl-fake-page-transitions'); ?></strong></td>
											<td>
												<input type="text" class="color-field" name="fpt-opt-transition-main-color" id="fpt-opt-transition-main-color" value="<?php echo get_option('fpt-opt-transition-main-color'); ?>">
											</td>
										</tr>

										<tr class="transition-secondary-color" <?php if(!in_array($transition_type, $two_color_transitions)){ echo 'style="display:none;"'; } ?>>
											<td><strong><?php _e('Transition Secondary Color', 'rbl-fake-page-transitions'); ?></strong></td>
											<td>
												<input type="text" class="color-field" name="fpt-opt-transition-secondary-color" id="fpt-opt-transition-secondary-color" value="<?php echo get_option('fpt-opt-transition-secondary-color'); ?>">
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div id="advanced-sortables" class="meta-box-sortables ui-sortable"></div>
					</div>
					<div id="postbox-container-3" class="postbox-container">
						<div id="normal-sortables-3" class="meta-box-sortables ui-sortable" style="">
							<div id="spinnerdiv" class="postbox ">
								<button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text"><?php _e('Vis eller skjul panel', 'rbl-fake-page-transitions'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button>
								<h2 class="hndle ui-sortable-handle"><span><?php _e('Spinner', 'rbl-fake-page-transitions'); ?></span></h2>
								<div class="inside">
									<table>
										<tr>
											<td><strong><?php _e('Spinner Type', 'rbl-fake-page-transitions'); ?></strong></td>
											<td>
												<select name="fpt-opt-spinner-type" id="fpt-opt-spinner-type">
												<option value="none" <?php echo ($spinner_type == 'none') ? 'selected' : ''; ?>><?php _e('No spinner', 'rbl-fake-page-transitions'); ?></option>
												<option value="bars" <?php echo ($spinner_type == 'bars') ? 'selected' : ''; ?>><?php _e('Bars', 'rbl-fake-page-transitions'); ?></option>
											</select>
											</td>
										</tr>

										<tr>
											<td><strong><?php _e('Spinner Main Color', 'rbl-fake-page-transitions'); ?></strong></td>
											<td>
												<input type="text" name="fpt-opt-spinner-main-color" id="fpt-opt-spinner-main-color" class="color-field" value="<?php echo get_option('fpt-opt-spinner-main-color'); ?>">
											</td>
										</tr>

										<tr>
											<td><strong><?php _e('Spinner Delay (in ms)', 'rbl-fake-page-transitions'); ?></strong></td>
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /post-body -->
				<br class="clear">
			</div>
	</form>
</div>

<script>
	jQuery('#fpt-opt-transition-type').on('change', function() {
		var $this = jQuery('this'),
			value = $this.val(),
			twoColorTransitions = ['collapse-diag-vert', 'collapse-diag-horz', 'collapse-half-one', 'collapse-half-two'];

		if (jQuery.inArray(value, twoColorTransitions) !== -1) {
			jQuery('tr.transition-secondary-color').slideDown();
		} else {
			jQuery('tr.transition-secondary-color').slideUp();
		}
	});

</script>
<?php } ?>