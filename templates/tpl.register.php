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
<form class="form-signin" onsubmit="ownStaGram.startRegister(this);return false;">

	<h2 class="form-signin-heading">Please register</h2>
	<input type="text" class="input-block-level" placeholder="Nickname" id="register_nickname">
	<input type="text" class="input-block-level" placeholder="Email address" id="register_email">
	<input type="password" class="input-block-level" placeholder="Password" id="register_password">
	<input type="password" class="input-block-level" placeholder="Again" id="register_again">
	<button class="btn btn-large btn-primary" type="submit">Register</button>
	
	<br/><br/>
	<span style='color: gray;'>
	Do you have your own ownStaGram-Copy running? 
	If so, you do not need to register. Go to <a href='index.php?action=login'>login-page</a> and login through your own server.
	</span>
	
        
</form>
