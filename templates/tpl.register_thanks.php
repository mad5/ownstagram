
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

<?php if($VARS->get("res")==1) { ?>
	<h2 class="form-signin-heading">Thank you for registering</h2>
	You will get an email soon to confirm your registration...
<?php } else if($VARS->get("res")==2) { ?>
	<h2 class="form-signin-heading">Thank you for registering</h2>
	You registered with your admin-account.<br/>
	You do not need to confirm your account!<br/>
	<a href='index.php?action=login'>Please login now.</a>
<?php } else { ?>
	<h2 class="form-signin-heading">Error registering</h2>
	There is an error with your registration.<br/>
	Please use another email-address.
<?php } ?>
	
	
        

