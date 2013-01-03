
        <div class="span9">
          <div class="hero-unit">
            <h1><?php echo ($VARS->get('s_title')=='' ? 'OwnStaGram-groups' : $VARS->get('s_title')."-groups"); ?> </h1>
          </div>
          
          <div class="row-fluid">
          
          <div class="span9">
          
          
<?php if($VARS->get("view")=="list") { ?>

	<table class="table table-hover">
		<tr>
			<th>groupname</th>
			<th></th>
		</tr>
	<?php foreach($VARS->get('list') as $key => $group) { ?>
		<tr>	
		
		<td><?php echo $group->get('g_name');?></td>
			<td><a href='index.php?action=groups&id=<?php echo $group->get('g_pk');?>' class="icon-pencil">&nbsp;</a></td>
		</tr>
	<?php } ?>
	</table>
  
<?php } ?>
          
<?php if($VARS->get("view")=="edit") { ?>
	
	
	<form class="form-horizontal" method="post">
		<input type="hidden" name="savegroup" value="1" />
		<div class="control-group">
			<label class="control-label" for="inputGroup">groupname</label>
			<div class="controls">
				<input type="text" name="FORM[groupname]" id="inputGroup" placeholder="Groupname" value="<?php echo $VARS->get("g_name");?>" autocomplete="off" />
			</div>
		</div>
		
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">save changes</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn" onclick="window.location='index.php?action=groups';">cancel</button>
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
              <li class="nav-header">Groups</li>
              <li class="active"><a href="index.php?action=groups">overview</a></li>
              <li><a href="index.php?action=newgroup">add new</a></li>
              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
