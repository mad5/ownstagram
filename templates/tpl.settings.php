<style>
	body {
		background-color: #F5F5F5;
	}
      .form-signin {
        
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
        color: gray;
      }
      
</style>


<form onsubmit="ownStaGram.saveSettings(this);return false;">
<div class="span3">

	<div class="form-signin">
	<h2 class="form-signin-heading">settings</h2>
	
	<label>Title</label>
	<input type="text" class="input-block-level settingform" placeholder="ownStaGram" value="<?php echo $VARS->get('s_title');?>" name="setting_maintitle"><br/>
	
	<label>Subtitle</label>
	<input type="text" class="input-block-level settingform" placeholder="describe your site" value="<?php echo $VARS->get('s_subtitle');?>" name="setting_title"><br/>
	
	
	<label>Style</label>
		<select name="setting_style" class="settingform">
			<option value=''>default
			
			<?php
			$styles = array('amelia', 'cerulean', 'cyborg', 'readable', 'simplex', 'slate', 'superhero');
			for($i=0;$i<count($styles);$i++) {
				echo '<option value="'.$styles[$i].'" '.($VARS->get('s_style')==$styles[$i] ? 'selected' : '').'>'.ucfirst($styles[$i]);
			}
			
			?>
		</select>

	
	<label class="checkbox">
		<input type="checkbox" value="1" name="setting_allow_register" class="settingform" <?php echo ($VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ? 'checked' : '');?> /> Allow visitors to register
		<br/>
		<div style="font-size:8pt;">
		If you do so, others will be able to comment to your pictures.
		Otherwise they can only see the pictures if you send them a link.
		</div>
	</label>
	
	<label class="checkbox">
		<input type="checkbox" value="1" name="setting_allow_upload" class="settingform" <?php echo ($VARS->is_set('s_allowfriendsstreams') && $VARS->get('s_allowfriendsstreams')==1 ? 'checked' : '');?> /> Allow registered users to upload pictures
		<br/>
		<div style="font-size:8pt;">
		If you do so, others can use this server for the <b>ownStaGram-App</b> and share their pictures with others through your server.<br/>
		If you do not activate this checkbox you are still able to allow single users to use your server. Go to user-administration to give permission. 
		</div>
	</label>
	<br/>
	<label class="checkbox">
		<input type="checkbox" value="1" name="setting_enable_osm" class="settingform" <?php echo ($VARS->is_set('s_osm') && $VARS->get('s_osm')==1 ? 'checked' : '');?> /> enable map-display
		<br/>
		<div style="font-size:8pt;">
		Display geoposition along with your images 
		</div>
	</label>
	<br/>
	<label class="checkbox">
		<input type="checkbox" value="1" name="setting_homecontent" class="settingform" <?php echo ($VARS->is_set('s_homecontent') && $VARS->get('s_homecontent')==1 ? 'checked' : '');?> /> show default homepage-content
		<br/>
		<div style="font-size:8pt;">
		You can hide the default home-content.<br/>
		If you want to create your own home-content, you can rename or copy the file named 'tpl.home_my.php.dist' inside templates-folder to 'tpl.home_my.php' and set your own content.<br/>
		If you update to a new version of ownStaGram this file will not be touched.
		</div>
	</label>
	
	</div>

</div>

<div class="span3">
	<div class="form-signin">
		<h2 class="form-signin-heading">general</h2>
		
		<label>Imprint</label>
		<textarea class="settingform" rows=5 placeholder="insert your imprint here" name="setting_imprint"><?php echo $VARS->get('s_imprint');?></textarea><br/>
		
		<label>Privacy-policy</label>
		<textarea class="settingform" rows=5 placeholder="insert your privacy-policy here" name="setting_privacy"><?php echo $VARS->get('s_privacy');?></textarea><br/>
		
	</div>
</div>

<div class="span3">
<!--
	<div class="form-signin">
		<h2 class="form-signin-heading">distribution</h2>
		<p>
			
		</p>
	</div>
-->	
</div>

<div class="span3">
	<div class="form-signin">
		<h2 class="form-signin-heading">involvement</h2>
		<p>
		Please keep in mind, that this is a one-man-side-project.
		I like the idea of hosting my own photo-service a lot.
		I use it multiple times per day and therefor it is in my own interest to keep this project running.
		Nevertheless I have limited time, so I am glad if you give me some hints about things not working correct.
		I also really appreciate to hear your wishes.<br/>
		Send me a note to: <a href='mailto:info@ownstagram.de'>info@ownstagram.de</a>
		</p>
	</div>
</div>

<div style='clear:both;'></div>

<button class="btn btn-large btn-primary" type="submit">Save settings</button>
</form>
