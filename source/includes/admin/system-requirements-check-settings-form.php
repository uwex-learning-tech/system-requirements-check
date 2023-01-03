<div class="instruction_box">
    <h3>INSTRUCTION</h3>
    <p>Place the shortcode (below) on post or page where the result is to be displayed.</p>
    <p><strong><code>[system_requirements_check]</code></strong></p>
    
    <div class="callout info"><strong>Have questions, suggestions, or ideas?</strong> Post them on <a href="https://github.com/uwex-learning-tech/system-requirements-check/issues" target="_blank">System Requirements Check GitHub Repository</a>.</div>

</div>

<div class="settings_box">

    <form method="post" action="options.php">
        
        <h3>Settings</h3>
        
    	<?php
    	
    	    settings_fields($this->settings_group);
    	    
    		if (!empty($_GET['settings-updated'] ) ) {
    			flush_rewrite_rules();
    		}
    		
    	?>
    	
    	<div class="settings_form">
            
    		<h4>Operating Systems</h4>
    		
    		<p>Select the minimum operating systems required.</p>
    		
    		<div class="danger-text">
        		<label class="src-cb"><input type="checkbox" name="disable_os_check" value="1" <?php checked('1', get_option('disable_os_check')); ?> />Disable operating systems check.</label><br>If selected, operating systems check is disabled even if they are selected below.
            </div>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_xp" value="1" <?php checked('1', get_option('windows_xp')); ?> />Windows XP </label>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_vista" value="1" <?php checked('1', get_option('windows_vista')); ?> />Windows Vista </label>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_7" value="1" <?php checked('1', get_option('windows_7')); ?> />Windows 7 </label>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_8" value="1" <?php checked('1', get_option('windows_8')); ?> />Windows 8 </label>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_81" value="1" <?php checked('1', get_option('windows_81')); ?> />Windows 8.1 </label>
    		
    		<label class="src-cb"><input type="checkbox" name="windows_10" value="1" <?php checked('1', get_option('windows_10')); ?> />Windows 10 </label>
    		
    		<label class="src-cb"><input type="checkbox" name="mac" value="1" <?php checked('1', get_option('mac')); ?> />Mac OS X </label>
    		
    		<label class="src-cb"><input type="checkbox" name="linux" value="1" <?php checked('1', get_option('linux')); ?> />Linux </label>
    		
    		<hr />
    		
    		<h4>Web Browsers</h4>
    		
    		<p>Enter the <strong>minimum</strong> required version number for each web browser. If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x</code>, <code>x.x</code>, or <code>x.x.x</code>.</p>
    		
    		<div class="danger-text">
        		<label class="src-cb"><input type="checkbox" name="disable_browser_check" value="1" <?php checked('1', get_option('disable_browser_check')); ?> />Disable web browsers check.</label><br>
        		If selected, web browsers check is disabled even if they are specified below.
            </div>
    		
    		<label class="fixed-width" for="settings-ie">Internet Explorer</label>
    		<input type="text" id="settings-ie" name="ie" value="<?php esc_attr_e(get_option('ie')); ?>" />
    		<br />
    		<label class="fixed-width" for="settings-edge">Microsoft Edge</label>
    		<input type="text" id="settings-edge" name="edge" value="<?php esc_attr_e(get_option('edge')); ?>" />
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
    		
    		<hr />
    		
    		<h4>IP Addresses</h4>
    		
    		<div class="danger-text"><strong>Displaying IP address to the public may increase of the risk of a security breach. By choosing to display the IP address, you expressed or agreed that the author and any sponsors of this plugin cannot be held responsible for any security breaches. Please use responsibly.</strong></div>
    		
    		<label><input type="checkbox" name="ip" value="1" <?php checked('1', get_option('ip')); ?> /> Display client's IP address</label>
    		<br>
    		<label><input type="checkbox" name="host_ip" value="1" <?php checked('1', get_option('host_ip')); ?> /> Display host's IP address</label>
    		
    		<hr />
    		
    		<h4>JavaScript</h4>
    		<label>Check for JavaScript? <input type="checkbox" name="js" value="1" <?php checked('1', get_option('js')); ?> /></label>
            
            <div class="callout warning">Java Runtime Environment (JRE), cookie, screen resolution, and Adobe Flash Player checks require JavaScript on the client's web browser.</div>
    		
    		<hr />
    		
    		<h4>Screen Resolution</h4>
    		
    		<label class="src-cb"><input type="checkbox" name="screen" value="1" <?php checked('1', get_option('screen')); ?> /> Display client's screen resolution.</label><br>
    		
    		<div class="callout info">
        		If "Display client's screen resolution" is not selected, screen resolution check is disabled even if it is specified below. Screen resolution check is not on by default, unselect "Disable screen resolution check" to enable screen resolution check.
            </div>
    		
    		<label class="src-cb"><input type="checkbox" name="disable_screen_check" value="1" <?php checked('1', get_option('disable_screen_check')); ?> /> Disable screen resolution check.</label><br>
    		
    		<input type="number" id="settings-screen-w" name="screen_w" size="4" value="<?php esc_attr_e(get_option('screen_w')); ?>" />
    		&times;
    		<input type="number" id="settings-screen-h" name="screen_h" size="4" value="<?php esc_attr_e(get_option('screen_h')); ?>" />
    		
    		<hr />
    		
    		<h4>Java Runtime Environment (JRE)</h4>
    		
    		<p>Enter the <strong>minimum</strong> required version number of the JRE. If the version number is less than or equal to 0, it is disabled. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x.x</code> or <code>x.x.x</code></p>
    		
    		<label for="settings-jre">Version </label>
    		<input type="text" id="settings-jre" name="jre" value="<?php esc_attr_e(get_option('jre')); ?>" />
    		
    		<div class="callout info">Java Runtime Environment (JRE) version numbering system is different than the usual version numbering system. For instance, Java 7 Update 51 does not mean the version number is <code>7.x.x</code>. The version number is actually <code>1.<strong><em>7</em></strong>.0_<strong><em>51</em></strong></code> and should be entered as such.</div>
    		
    		<hr />
    		
    		<h4>Cookie</h4>
    		<label>Check for cookie? <input type="checkbox" name="cookie" value="1" <?php checked('1', get_option('cookie')); ?> /> </label>
    		
        	<hr />
        	
        	<h4>Adobe Flash Player</h4>
    		
    		<div class="callout warning">Adobe no longer supports Flash Player after December 31, 2020 and blocked Flash content from running in Flash Player beginning January 12, 2021. Adobe strongly recommends all users immediately uninstall Flash Player to help protect their systems.</div>
    		
    		<p>Enter the <strong>minimum</strong> required version number of the Adobe Flash Player. If the version number is less than or equal to 0, it is disabled. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x</code>, <code>x.x</code>, or <code>x.x.x</code>.</p>
    		
    		<label id="settings-flash">Version </label>
    		<input type="text" id="settings-flash" name="flash" value="<?php esc_attr_e(get_option('flash')); ?>" />
    		
    		<!-- end of settings -->
    		
    		<hr class="thick"/>
    		
    		<p class="submit">
        		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'system_requirements_check' ); ?>" />
        	</p>
            
    	</div>
    	
    </form>
    
</div>