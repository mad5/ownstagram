        <div class="span3">
                  <div class="well sidebar-nav" id='links'>
                  
                  <a href='#' id='maillink' onclick="var H = window.location+'';H=H.replace('&','%26');window.location='mailto:?subject=take%20a%20look&body=see this picture:%0a'+H+'%0a%0a';return false;" class="btn btn-link"><i class="icon-envelope"></i> send this image via email</a> 
                  	
                  </div>
                  
                  <?php if($VARS->get('i_u_fk')==me()) { ?>
			  <div class="well sidebar-nav" id='links'>
			  
			  <a href='#' onclick="if(confirm('delete image?')) { window.location='index.php?action=delete&id=<?php echo $VARS->get('id');?>' } return false;"  id='maillink' class="btn btn-link"><i class="icon-trash"></i> delete image</a> 
				
			  </div>
                  <?php } ?>
        </div>

        <div class="span6">
        <div class="hero-unit" style="padding-top:15px;">
          
          <h2><?php echo date("d.m.Y", strtotime($VARS->get('i_date')));?></h2>
          <?php if($VARS->get('i_title')!="") { ?>
          	  <b><?php echo $VARS->get('i_title');?></b><br/>
          <?php } ?>
          	<img src='index.php?action=image&amp;img=<?php echo md5($VARS->get('i_date').$VARS->get('i_file')); ?>&amp;w=500' width=500 height=500 />
            
          </div>
        </div><!--/span-->
        
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Comments</li>
              
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
             
              <br/><br/>
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
              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
