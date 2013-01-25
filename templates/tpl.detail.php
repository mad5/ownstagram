        <div class="span3">
        
        	<?php if($VARS->get('i_u_fk')==me()) { ?>
			  <div class="well sidebar-nav" id='links'>
			  <a href='index.php?action=overview' onclick="if($('#detailiframe', window.parent.document).length>0) { parent.history.pushState({ }, 'Overview', 'index.php?action=overview'); $('#detailiframe', window.parent.document).remove(); return false;}" class="btn btn-link"><i class="icon-arrow-left"></i> close detail-view</a>
			  </div>
                <?php } ?>
                
                  <div class="well sidebar-nav" id='links'>
                  
                  	<a href='#' id='maillink' onclick="var H = window.location+'';H=H.replace('hide=1&', '');H=H.replace('&','%26');window.location='mailto:?subject=take%20a%20look&body=see this picture:%0a'+H+'%0a%0a';return false;" class="btn btn-link"><i class="icon-envelope"></i> send this image via email</a> 
                  	
                  </div>
                
                  <?php if($VARS->get('i_u_fk')!=me() && 1==2) { ?>
                  	  
                  	 
                  <div class="well sidebar-nav" id='links'>
                  	<a href='#' id='connectlink' class="btn btn-link"><i class="icon-tag"></i> Follow user</a> 
                  </div>
                  	  
                  	  
                  <?php } ?>
		
                  
                  <?php if($VARS->get('i_u_fk')==me()) { ?>
			  <div class="well sidebar-nav">
			  	<a href='#' onclick="if(confirm('delete image?')) { window.top.location='index.php?action=delete&id=<?php echo $VARS->get('id');?>' } return false;"  id='maillink' class="btn btn-link"><i class="icon-trash"></i> delete image</a> 
			  </div>
			  
			  <div class="well sidebar-nav">
			  <form method="post" style='padding-left:20px;'>
			  
		  		  <input type="hidden" name="savesettings" value="1" />
		  		  
				  <fieldset>
					<legend>Photo-settings</legend>
					
					<label>Title</label>
					<input type="text" name="title" value="<?php echo $VARS->get('i_title'); ?>" placeholder="Photo title">

					<label>Visibility</label>
						
					<label class="checkbox">
						<input type="radio" name="public" value="0" <?php if($VARS->get('i_public')==0) { echo "checked"; } ?> /> show picture if url is known<br/>
						<span style='font-size:8pt;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You can share the url to the image.<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Everyone who gets the url can see the image.</span>
					</label>
					<label class="checkbox">
						<input type="radio" name="public" value="1" <?php if($VARS->get('i_public')==1) { echo "checked"; } ?>  /> make picture public<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:8pt;'>use picture for collages on the front-page.</span>
					</label>
					<label class="checkbox">
						<input type="radio" name="public" value="-1" <?php if($VARS->get('i_public')==-1) { echo "checked"; } ?>  /> make picture private<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:8pt;'>only you can see the image.</span>
					</label>
					
					<label>Group</label>
						<select name="group">
							<option value='0'>default</option>
							<?php foreach($VARS->get('groups') as $key => $group) { ?>
								<option value='<?php echo $group->get('g_pk');?>' <?php if($VARS->get('i_g_fk')==$group->get('g_pk')) echo 'selected'; ?> ><?php echo $group->get('g_name');?></option>
							<?php } ?>
						</select>
					
					<br/>
					<p><button class="btn">save changes &raquo;</button></p>
				  </fieldset>
			  </form>
			  </div>
                  <?php } ?>
        </div>

        <div class="span6">
        <div class="hero-unit" style="padding-top:15px;">
		  
		  <div style="float:left;">
			<h2><?php echo date("d.m.Y", strtotime($VARS->get('i_date')));?></h2>
		  </div>
		  
		  <?php if(me()==$VARS->get('i_u_fk')) { ?>
		  <div style="float:right;">
			
			<?php foreach($VARS->get('next') as $key => $img) { ?>
				<a href='index.php?action=detail&id=<?php echo $img->get("id");?>'>
				<img src='index.php?action=image&amp;img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&amp;w=35' width=35 height=35 />
				</a>
			<?php } ?>
		  
			<a href='index.php?action=detail&id=<?php echo $VARS->get("id");?>'>
				<img src='index.php?action=image&amp;img=<?php echo md5($VARS->get('i_date').$VARS->get('i_file')); ?>&amp;w=50' width=50 height=50 />
			</a>
	
			<?php foreach($VARS->get('prev') as $key => $img) { ?>
				<a href='index.php?action=detail&id=<?php echo $img->get("id");?>'>
				<img src='index.php?action=image&amp;img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&amp;w=35' width=35 height=35 />
				</a>
			<?php } ?>
			
		  </div>
		  <?php } ?>
		  
		  <div style="clear:both;"></div>
		  
		  <?php /* <img src='index.php?action=image&amp;img=<?php echo md5($VARS->get('i_date').$VARS->get('i_file')); ?>&amp;w=500' width=500 height=500 /> */ ?>
		  
		  <div style='max-width:540px;background-color:white;border-radius: 5px;box-shadow:0 10px 18px -10px #888888;'>
			  <div style='padding:20px;'>
			  <img src='<?php echo $VARS->get('imgsrc');?>' width=500 height=500 style="border:solid 1px silver;border-radius:5px;" />
			  </div>
			  <div style='height:30px;padding:0 20px 20px 20px;'>
				  <?php if($VARS->get('i_title')!="") { ?>
					  <b><?php echo $VARS->get('i_title');?></b><br/>
				  <?php } ?>
			  </div>
		  </div>
          
          </div>
          
          <div class="hero-unit" style="padding-top:15px;">
          	
          	<h2>Comments</h2>
          	
          	<?php foreach($VARS->get('comments') as $key => $comment) { ?>
              	      <p class="muted">
              	      <?php if($VARS->get('i_u_fk')==$comment->get('co_u_fk')) { ?>
              	      	<i title="comment from owner" class="icon-certificate"></i> 
              	      <?php } else { ?>
              	      	     <i title="comment from other" class="icon-align-justify"></i>
              	      <?php }?>
              	      	<?php echo $comment->get("co_comment"); ?>
              	      	<br/><span class='date'><small><?php echo date("d.m.Y H:i:s", strtotime($comment->get("co_date"))); ?></small></span>
              	      </p>
              <?php } ?>
             
              <br/>
              <?php if(me()>0) { ?>
		      
		      <form class="form-inline" onsubmit="ownStaGram.startComment(this, '<?php echo $VARS->get('id');?>');return false;">
			    <label>add comment</label><br/>
			    <input type="text" class="input-medium" placeholder="Type something..." id="comment_text">
			    <button type="submit" class="btn">Submit</button>
			</form>
	      <?php } else { ?>
	      	      <?php if( $VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ) { ?>
	      	      <p class="muted">Login to comment.</p>
	      	      <?php } ?>
	      <?php } ?>
          </div>
          
        </div><!--/span-->
        
        <div class="span3">
        
        <?php if($VARS->get('i_location')!="") { ?>
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Location</li>
              <p class="muted">
              	<?php echo $VARS->get('i_location'); ?>
              </p>
            </ul>
         </div>
        <?php } ?>
         
        <?php /*
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              
            </ul>
          </div><!--/.well -->
          */ ?>
          
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Public photos from same user</li>
              <?php foreach($VARS->get('forthis') as $key => $other) { 
          		?><a href='index.php?action=detail&id=<?php echo $other->get("id");?>'><?php 
          		?><img src='index.php?action=image&amp;img=<?php echo md5($other->get('i_date').$other->get('i_file')); ?>&amp;w=47' width=47 height=47 /><?php
          		?></a><?php
              } ?>
          </ul>
            <ul class="nav nav-list">
              <li class="nav-header">Public photos from other users</li>
              <?php foreach($VARS->get('others') as $key => $other) { 
          		?><a href='index.php?action=detail&id=<?php echo $other->get("id");?>'><?php 
          		?><img src='index.php?action=image&amp;img=<?php echo md5($other->get('i_date').$other->get('i_file')); ?>&amp;w=47' width=47 height=47 /><?php
          		?></a><?php
              } ?>
          </ul>
          </div><!--/.well -->
          
          
        </div><!--/span-->
        
