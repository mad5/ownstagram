<style>
	body {
		/*background-color: #F5F5F5;*/
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

<div class="span3">

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

</div>


<div class="span3">
<div class="form-signin">
	<h2 class="form-signin-heading">email-in</h2>
	<br/>
	<p>
	You can send your photos to <a href='mailto:pix@ownstagram.de'>pix@ownstagram.de</a> to insert them into your album.<br/>
	To do this you have to register your mailaddress from which you send your photos.<br/>
	If you have multiple sender-addresses you should register them all.<br/>
	If you do so, you receive a verification-code once to make sure the address belongs to you.
	</p>
	
	<button class="btn btn-large btn-primary" type="button" onclick="$('#newsender').slideToggle();return false;">add email-address</button>
	<br/><br/>
	<div id='newsender' style='display:none;'>
		<form onsubmit="ownStaGram.addEmailinSender($('#addsender').val());$('#newsender').slideUp();return false;">
		emailaddress:<br/>
		<input type='text' id='addsender' value='' />
		<input type='submit' value='add'>
		</form>	
	</div>
	<div id='allsender'>
		<form method="post">
			<input type='hidden' name='sendemailin' value='1' />
			<?php foreach($VARS->get('emailin') as $key => $EI) { ?>
				<b><?php echo $EI->get('ei_email');?></b><br/>
				key:<input type='text' value='<?php echo $EI->get('ei_key');?>' name='emailins[<?php echo $EI->get('ei_email');?>]' style='font-size:10px;font-family: arial;' />
				<a href='#' onclick="if(confirm('really?')) { ownStaGram.removeEIkey('<?php echo $EI->get('ei_email');?>'); } return false;">[x]</a>
			<?php } ?>
			<input type='submit' value='save keys' class="btn btn-large btn-primary">
		</form>
	</div>
	<br/><br/>
	Why should you send photos via email? Because then you can use every mobile app (android or iphone/ipad) which shares photos via email.
	
</div>
</div>

<?php /*
<div class="span3">
<form class="form-signin" method="post">
	<h2 class="form-signin-heading">Social</h2>
	<br/>
	<button class="btn btn-large btn-primary" type="button" onclick="ownStaGram.connectTwitter();return false;">connect to twitter</button>
	<br/><br/>
	<p>
	If you connect your account to twitter you can send your pictures directly to your twitter-feed.
	</p>
</form>
</div>
*/ ?>
