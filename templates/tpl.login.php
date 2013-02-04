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
<form class="form-signin" onsubmit="ownStaGram.startLogin(this);return false;" <?php if(isset($_GET["remotekey"])) { ?>style="max-width:500px;"<?php } ?>>
	<h2 class="form-signin-heading">Please sign in</h2>
	<?php if(isset($_GET["remotekey"])) { ?>
		<h4>@ <?php echo $_GET["remoteserver"]; ?></h4>
		
		<input type="hidden" id="login_remotekey" value="<?php echo htmlspecialchars($_GET['remotekey']);?>">
		<input type="hidden" id="login_remoteserver" value="<?php echo htmlspecialchars($_GET['remoteserver']);?>">
		
	<?php } ?>
	
		
		<div class="alert alert-error" style="display:none;">
		<a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
		</div>
	
	<input type="text" class="input-block-level" placeholder="Email address" id="login_email">
	<input type="password" class="input-block-level" placeholder="Password" id="login_password">
	<!--
	<label class="checkbox">
	  <input type="checkbox" value="remember-me" id="login_remember" checked> Remember me
	</label>
	-->
	<button class="btn btn-large btn-primary" type="submit">Sign in <?php if(isset($_GET["remotekey"])) { ?>@ remote server<?php } ?></button>
	
	<?php if(!isset($_GET["remotekey"])) { ?>
	<br/><br/>
	Sorry, but I forgot my password...<br/>
	No problem! <a href='index.php?action=forgot'>Click here...</a>
	<?php } ?>
	
</form>
<br/>

<?php if( $VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ) { ?>
<?php if(!isset($_GET["remotekey"]) && 1==1) { ?>

<script>
var handle = "";
function checkServer() {
	$('#checkedserver').html("<img src='resources/err.gif' />");
	$('.buttonremote').removeAttr("disabled");
	$('.buttonremote').css("background-image", "none");
	$('.buttonremote').css("background-color", "silver");

	var S = $('#remote_server').val();
	if(S=="") return false;

	if(S.substring(S.length-1)!="/") S += "/";
	
	$.ajax({
			"url": S+"app.php?action=version",
			"type": "post",
			"dataType": "jsonp",
			"success": function(data) {
				if(typeof(data.result)!="undefined" && data.result==1) {
					var version = data.version.split('.');
					var ver = version[0]*10000+version[1]*100+version[2]*1;
					if(ver<10900) data.result=0;
					console.log(version);
					console.log(ver);
				}
				
				if(typeof(data.result)!="undefined" && data.result==1) {
					$('#checkedserver').html("<img src='resources/ok.gif' />");
					$('.buttonremote').removeAttr("disabled");
					$('.buttonremote').css("background-image", "linear-gradient(to bottom, #0088CC, #0044CC)");
					$('.buttonremote').css("background-color", "#006DCC");
				} else {
					$('#checkedserver').html("<img src='resources/err.gif' />");
					$('.buttonremote').attr("disabled","disabled");
					$('.buttonremote').css("background-image", "none");
					$('.buttonremote').css("background-color", "silver");
				}
			}
	});
}
//setTimeout(function() { checkServer(); }, 2000);

</script>
<form class="form-signin" onsubmit="ownStaGram.startRemoteLogin($('#remote_server').val());return false;">
	<h2 class="form-signin-heading">Sign in through your own server</h2>
	<input type="text" style="width:260px;" class="input-block-level" placeholder="ownStaGram-URL" value="" id="remote_server" onkeyup="if(handle!='') { clearTimeout(handle);handle=''; } handle = setTimeout(function() { checkServer(); }, 500); ">
	<span id='checkedserver'><img src='resources/err.gif' /></span>
<!--
	<input type="text" class="input-block-level" placeholder="Email address" id="remote_email" />
	<input type="password" class="input-block-level" placeholder="Password" id="remote_password" />
-->	

	<button class="btn btn-large btn-primary buttonremote" type="submit" disabled="disabled">Sign in</button>
	
	<br/><br/>
	If you have your own ownStaGram-Server running you can login with your own credentials.<br/>
	
	
</form>
<br/>
<?php } ?>
<?php } ?>


