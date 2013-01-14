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
<form class="form-signin" method="post">
	<input type="hidden" name="send" value="1" />
	<h2 class="form-signin-heading">Profile</h2>
	
	<label>Nickname</label>
	<input type="text" class="input-block-level" placeholder="Nickname" name="u_nickname" value="<?php echo $VARS->get('u_nickname');?>" /><br/>
	<label>Country</label>
	<input type="text" class="input-block-level" placeholder="Country" name="u_country" value="<?php echo $VARS->get('u_country');?>" /><br/>
	<label>City</label>
	<input type="text" class="input-block-level" placeholder="City" name="u_city" value="<?php echo $VARS->get('u_city');?>" /><br/>
	
	<br/>
	<button class="btn btn-large btn-primary" type="submit">Save profile</button>
</form>
