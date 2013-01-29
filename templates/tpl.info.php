
<style>
	body {
		background-color: #F5F5F5;
	}
      .form-signin {
        max-width: 500px;
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
<form class="form-signin" >

	<?php if(isset($_GET['info']) && $_GET['info']=="imprint") { ?>
		<h2 class="form-signin-heading">Imprint</h2>
		<?php echo nl2br($VARS->get('s_imprint')); ?>
	<?php } ?>
	<?php if(isset($_GET['info']) && $_GET['info']=="privacy") { ?>
		<h2 class="form-signin-heading">Privacy policy</h2>
		<?php echo nl2br($VARS->get('s_privacy')); ?>
	<?php } ?>
	
        
</form>
