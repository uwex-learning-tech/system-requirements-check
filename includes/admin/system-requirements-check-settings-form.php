<div class="settings_box">

<p class="callout info"><strong>Usage:</strong> place the shortcode, <code>[system_requirements_check]</code> on posts or pages where the result will be displayed.</p>

<form method="post" action="options.php">

	<?php settings_fields($this->settings_group); ?>

	<h3>Settings</h3>

	<?php
		if (!empty($_GET['settings-updated'] ) ) {
			flush_rewrite_rules();
		}
	?>
	
	<div class="settings_form">
		<h4>Operating Systems</h4>
		
		<p>Select the minimum operating systems required.</p>
		
		<label class="src-cb"><input type="checkbox" name="windows_vista" value="1" <?php checked('1', get_option('windows_vista')); ?> />Windows Vista </label>
		
		<label class="src-cb"><input type="checkbox" name="windows_7" value="1" <?php checked('1', get_option('windows_7')); ?> />Windows 7 </label>
		
		<label class="src-cb"><input type="checkbox" name="windows_8" value="1" <?php checked('1', get_option('windows_8')); ?> />Windows 8 </label>
		
		<label class="src-cb"><input type="checkbox" name="windows_81" value="1" <?php checked('1', get_option('windows_81')); ?> />Windows 8.1 </label>
		
		<label class="src-cb"><input type="checkbox" name="mac" value="1" <?php checked('1', get_option('mac')); ?> />Mac OS X </label>
		
		<p class="callout info">Windows XP and older will not be supported.</p>
		
		<h4>Web Browsers</h4>
		
		<p>Enter the <strong>minimum</strong> required version number for each web browser.<br /><small>If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x</code>, <code>x.x</code>, or <code>x.x.x</code>.</small></p>
		
		<label class="fixed-width" for="settings-ie">Internet Explorer</label>
		<input type="text" id="settings-ie" name="ie" value="<?php esc_attr_e(get_option('ie')); ?>" />
		<br />
		<label class="fixed-width" for="settings-firefox">Mozilla Firefox</label>
		<input type="text" id="settings-firefox" name="firefox" value="<?php esc_attr_e(get_option('firefox')); ?>" />
		<br />
		<label class="fixed-width" for="settings-chrome">Google Chrome</label>
		<input type="text" id="settings-chrome" name="chrome" value="<?php esc_attr_e(get_option('chrome')); ?>" />
		<br />
		<label class="fixed-width" for="settings-safari">Apple Safari</label>
		<input type="text" id="settings-safari" name="safari" value="<?php esc_attr_e(get_option('safari')); ?>" />
		<br />
		<label class="fixed-width" for="settings-opera">Opera</label>
		<input type="text" id="settings-opera" name="opera" value="<?php esc_attr_e(get_option('opera')); ?>" />
		
		<h4>Java Runtime Environment (JRE)</h4>
		
		<p>Enter the <strong>minimum</strong> required version number of the JRE.<br /><small>If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x.x</code> or <code>x.x.x</code>.</small></p>
		
		<label for="settings-jre">Version </label>
		<input type="text" id="settings-jre" name="jre" value="<?php esc_attr_e(get_option('jre')); ?>" />
		
		<p class="callout warning"><strong>Note:</strong> Java Runtime Environment (JRE) version numbering system is different than the usual version numbering system. For instance, Java 7 Update 51 does not means the version number is <code>7.x.x</code>. The version number is actually <code>1.<strong><em>7</em></strong>.0_<strong><em>51</em></strong></code> and should be entered as such in the text box above.</p>
		
		<h4>Adobe Flash Player</h4>
		
		<p>Enter the <strong>minimum</strong> required version number of the Adobe Flash Player.<br /><small>If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x</code>, <code>x.x</code>, or <code>x.x.x</code>.</small></p>
		
		<label id="settings-flash">Version </label>
		<input type="text" id="settings-flash" name="flash" value="<?php esc_attr_e(get_option('flash')); ?>" />
		
		<h4>Cookie</h4>
		<label>Check for cookie? <input type="checkbox" name="cookie" value="1" <?php checked('1', get_option('cookie')); ?> /> </label>
		
		<h4>JavaScript</h4>
		<label>Check for JavaScript? <input type="checkbox" name="js" value="1" <?php checked('1', get_option('js')); ?> /></label>
        
        <p class="callout danger"><strong>Important:</strong> Java Runtime Environment (JRE), cookie, and Adobe Flash Player checks require JavaScript to be enabled on the client's web browser.</p>
        
	</div>
	
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'system_requirements_check' ); ?>" />
	</p>
	
</form>
</div>