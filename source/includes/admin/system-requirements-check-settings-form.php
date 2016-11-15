<div class="callout info"><strong>How to use:</strong> place the shortcode, <code>[system_requirements_check]</code>, on post or page where the result will be displayed.</div>

<div class="settings_box">

    <form method="post" action="options.php">
        
        <p class="submit">
    		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'system_requirements_check' ); ?>" />
    	</p>
    	
    	<hr class="thick"/>
        
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
    		
    		<div class="callout danger">
        		<label class="src-cb"><input type="checkbox" name="disable_os_check" value="1" <?php checked('1', get_option('disable_os_check')); ?> />Disable operating systems check.</label><br>
        		If selected, operating systems will not be checked and displayed even if they are selected below.
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
    		
    		<div class="callout danger">
        		<label class="src-cb"><input type="checkbox" name="disable_browser_check" value="1" <?php checked('1', get_option('disable_browser_check')); ?> />Disable web browsers check.</label><br>
        		If selected, web browsers will not be checked and displayed even if they are specified below.
            </div>
    		
    		<label class="fixed-width" for="settings-ie">Internet Explorer</label>
    		<input type="text" id="settings-ie" name="ie" value="<?php esc_attr_e(get_option('ie')); ?>" />
    		<br />
    		<label class="fixed-width" for="settings-ie">Microsoft Edge</label>
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
    		
    		<div class="callout danger"><strong>Important:</strong> Displaying IP address to the public may increase of the risk of a security breach. By choosing to display the IP address, you expressed or agreed that the author of this plugin will not be held responsible for any security breaches. Please use responsibly.</div>
    		
    		<label>Display client's IP address? <input type="checkbox" name="ip" value="1" <?php checked('1', get_option('ip')); ?> /></label>
    		<br>
    		<label>Display host's IP address? <input type="checkbox" name="host_ip" value="1" <?php checked('1', get_option('host_ip')); ?> /></label>
    		
    		<hr />
    		
    		<h4>JavaScript</h4>
    		<label>Check for JavaScript? <input type="checkbox" name="js" value="1" <?php checked('1', get_option('js')); ?> /></label>
            
            <div class="callout danger"><strong>Important:</strong> Java Runtime Environment (JRE), cookie, and Adobe Flash Player checks require JavaScript to be enabled on the client's web browser.</div>
    		
    		<hr />
    		
    		<h4>Java Runtime Environment (JRE)</h4>
    		
    		<p>Enter the <strong>minimum</strong> required version number of the JRE. If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x.x</code> or <code>x.x.x</code>.</p>
    		
    		<label for="settings-jre">Version </label>
    		<input type="text" id="settings-jre" name="jre" value="<?php esc_attr_e(get_option('jre')); ?>" />
    		
    		<div class="callout warning"><strong>Note:</strong> Java Runtime Environment (JRE) version numbering system is different than the usual version numbering system. For instance, Java 7 Update 51 does not mean the version number is <code>7.x.x</code>. The version number is actually <code>1.<strong><em>7</em></strong>.0_<strong><em>51</em></strong></code> and should be entered as such.</div>
    		
    		<hr />
    		
    		<h4>Adobe Flash Player</h4>
    		
    		<p>Enter the <strong>minimum</strong> required version number of the Adobe Flash Player. If the version number is less than or equal to 0, it will not be checked. Defaulted to 0 if left blanked or invalid. Version number can be entered as <code>x</code>, <code>x.x</code>, or <code>x.x.x</code>.</p>
    		
    		<label id="settings-flash">Version </label>
    		<input type="text" id="settings-flash" name="flash" value="<?php esc_attr_e(get_option('flash')); ?>" />
    		
    		<hr />
    		
    		<h4>Cookie</h4>
    		<label>Check for cookie? <input type="checkbox" name="cookie" value="1" <?php checked('1', get_option('cookie')); ?> /> </label>
    		
    		<hr class="thick"/>
    		
    		<p class="submit">
        		<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'system_requirements_check' ); ?>" />
        	</p>
            
    	</div>
    	
    </form>
    
</div>