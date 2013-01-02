<style>
	body {
		background-color: #F5F5F5;
	}
      .form-signin {
        max-width: 300px;
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
      }
</style>
<form class="form-signin" onsubmit="ownStaGram.saveSettings(this);return false;">
	<h2 class="form-signin-heading">Settings</h2>
	
	<label>Title</label>
	<input type="text" class="input-block-level settingform" placeholder="ownStaGram" value="<?php echo $VARS->get('s_title');?>" name="setting_maintitle"><br/>
	
	<label>Subtitle</label>
	<input type="text" class="input-block-level settingform" placeholder="describe your site" value="<?php echo $VARS->get('s_subtitle');?>" name="setting_title"><br/>
	
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
	<button class="btn btn-large btn-primary" type="submit">Save settings</button>
</form>
