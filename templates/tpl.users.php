
        <div class="span9">
          <div class="hero-unit">
            <h1><?php echo ($VARS->get('s_title')=='' ? 'OwnStaGram-users' : $VARS->get('s_title')."-users"); ?> </h1>
          </div>
          
          <div class="row-fluid">
          
          <div class="span9">
          
          
<?php if($VARS->get("view")=="list") { ?>

	<table class="table table-hover">
		<tr>
			<th>email</th>
			<th>registered</th>
			<th>confirmed</th>
			<th></th>
		</tr>
	<?php foreach($VARS->get('list') as $key => $user) { ?>
		<tr>	
		
			<td><?php echo $user->get('u_email');?></td>
			<td><?php echo $user->get('u_registered');?></td>
			<td><?php echo ($user->get('u_confirmed')=='0000-00-00 00:00:00' ? "no" : "yes");?></td>
			<td><a href='index.php?action=users&id=<?php echo $user->get('u_pk');?>' class="icon-pencil">&nbsp;</a></td>
		</tr>
	<?php } ?>
	</table>
  
<?php } ?>
          
<?php if($VARS->get("view")=="edit") { ?>
	
	
	<form class="form-horizontal" method="post">
		<input type="hidden" name="saveuser" value="1" />
		<div class="control-group">
			<label class="control-label" for="inputEmail">email</label>
			<div class="controls">
				<input type="text" name="FORM[email]" id="inputEmail" placeholder="Email" value="<?php echo $VARS->get("u_email");?>" autocomplete="off" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputPW">password</label>
			<div class="controls">
				<input type="password" name="FORM[password]" id="inputPW" placeholder="password" value="" autocomplete="off" />
				<br/>
				<span style="font-size:8pt;">only set password if you want to set a new one.</span> 
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputPW2">again</label>
			<div class="controls">
				<input type="password" name="FORM[password2]" id="inputPW2" placeholder="repeat password" value="" autocomplete="off" />
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name='FORM[confirm]' value="1" <?php echo ($VARS->get('u_confirmed')=="" || $VARS->get('u_confirmed')=='0000-00-00 00:00:00' ? "" : "checked");?>> confirmed
				</label>
				
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">save changes</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn" onclick="window.location='index.php?action=users';">cancel</button>
			</div>
		</div>		
	</form>
	
	
<?php } ?>          
          </div>
            

          </div><!--/row-->
        </div><!--/span-->
        
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Users</li>
              <li class="active"><a href="index.php?action=users">overview</a></li>
              <li><a href="index.php?action=newuser">add new</a></li>
              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
