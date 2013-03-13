        <div class="span3">
        
        <script>
        function closeIframe() {
        	if($('#detailiframe', window.parent.document).length>0) { 
        		parent.history.pushState({ }, 'Overview', 'index.php?action=overview'); 
        		$('#osmMap', window.parent.document).show();
        		$('#detailiframe', window.parent.document).remove();
        		return false;
        	}
        	return true;
        }
        </script>
        
        	
		  <div class="well sidebar-nav" id='links'>
		  <a href='index.php?action=<?php echo ($VARS->get('i_u_fk')==me() ? 'overview' : 'discover'); ?>' onclick="return closeIframe();" class="btn btn-link"><i class="icon-arrow-left"></i> close detail-view</a>
		  </div>
                

		  <?php if($VARS->get('i_set')!=0) { ?>

		  <div class="well sidebar-nav">
		    <ul class="nav nav-list">
		    <li class="nav-header">Set of images: <?php echo $VARS->get('setname');?></li>
		  	  
		  	  <?php foreach($VARS->get('setimages') as $key => $img) { 
				?><a href='index.php?action=detail&id=<?php echo $img->get("id");?>'><?php
				?><img src='index.php?action=image&amp;img=<?php 
					echo md5($img->get('i_date').$img->get('i_file')); 
					?>&amp;w=50' width=50 height=50 style='border: solid 1px <?php echo ( $img->get("id")==$_GET['id'] ? 'red' : 'transparent'); ?>;margin:3px;'/><?php
				?></a><?php
		  	  } ?>
		  	  
		  	  <div style="clear:both;height:5px;"></div>
		  	  </ul>
		     </div><!--/.well -->
		  <?php } ?> 

                
                  <div class="well sidebar-nav" id='links'>
                  
                  	<a href='#' id='maillink' onclick="var H = window.location+'';H=H.replace('hide=1&', '');H=H.replace('&','%26');window.location='mailto:?subject=take%20a%20look&body=see this picture:%0a'+H+'%0a%0a';return false;" class="btn btn-link"><i class="icon-envelope"></i> send this image via email</a><br/> 
                  	
                  </div>
                  
                  <?php /*
                  <div class="well sidebar-nav" id='links'>
                  	<a href='#' id='maillink' onclick="ownStaGram.socialpost('twitter', '<?php echo $VARS->get("id");?>', '<?php echo $VARS->get('imgsrc');?>', '<?php echo $VARS->get('i_title');?>');return false;" class="btn btn-link"><img src='resources/twitter_bird.png' style="height:22px;" /> post on twitter</a> 
                  </div>
                  */ ?>
                
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
					
					<label>Date</label>
					<input type="text" name="date" value="<?php echo $VARS->get('i_date'); ?>" placeholder="YYYY-mm-dd">
					
					<label>Title</label>
					<input type="text" name="title" value="<?php echo $VARS->get('i_title'); ?>" placeholder="Photo title">
					
					<label>Location</label>
					<input type="text" name="location" value="<?php echo $VARS->get('i_location'); ?>" placeholder="City, Country">


					<label>Format</label>
						<select name="format">
							<option value='1' <?php if($VARS->get('i_square')==1) echo 'selected'; ?>>square</option>
							<option value='0' <?php if($VARS->get('i_square')==0) echo 'selected'; ?>>original</option>
						</select>

						
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

					<label>Set</label>
						<select name="set" onchange="if(this.value==-1) $('#newset').slideDown(); else $('#newset').slideUp();">
							<option value='0'>-- none --</option>
							<?php foreach($VARS->get('sets') as $key => $set) { ?>
								<option value='<?php echo $set->get('se_pk');?>' <?php if($VARS->get('i_set')==$set->get('se_pk')) echo 'selected'; ?> ><?php echo $set->get('se_name');?></option>
							<?php } ?>
							<option value='-1'>** NEW SET **</option>
						</select>
						<div style='display:none;' id='newset'>
							<label>new set:</label>
							<input type="text" name="newsetname" value="" placeholder="new set name">
						</div>
						
					<br/>
					<p><button class="btn">save changes &raquo;</button></p>
				  </fieldset>
			  </form>
			  </div>
                  <?php } ?>
                  
		  
		  <?php if($VARS->get('i_set')==0 && $VARS->get('i_u_fk')!=me()) { ?>
				  
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
		  <?php } ?>                  
                  
        </div>

        <div class="span6">
        <div class="hero-unit" style="padding-top:15px;padding-bottom:20px;">
		  
		  <div style="float:left;">
			<h2><?php echo date("Y-m-d", strtotime($VARS->get('i_date')));?></h2>
		  </div>
		  
		  <?php if(me()==$VARS->get('i_u_fk') && $VARS->get('i_set')==0) { ?>
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
			  <div style='height:30px;padding:0 20px 20px 20px;float:left;'>
				  <?php if($VARS->get('i_title')!="") { ?>
					  <b><?php echo $VARS->get('i_title');?></b><br/>
				  <?php } ?>
			  </div>
			  
			  
			  <div style='height:30px;padding:0 20px 20px 20px;float:right;'>
			  <a href="http://twitter.com/share?text=<?php echo urlencode( ($VARS->get('i_title')=='' ? 'my photo' : $VARS->get('i_title')).' on ownStaGram');?>&url=http://<?php echo urlencode($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);?>" target="_blank"><img src='resources/twitter.png' /></a>
 
			  <a href="http://www.facebook.com/sharer.php?u=http://<?php echo urlencode($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);?>" target="_blank"><img src='resources/facebook.png' /></a>
			  </div>
			  <div style='clear:both;'></div>
		    
		  </div>
		  <br/>
				 
		  <?php /*
		    <i class="icon-user"></i> <a href="#"><?php echo $VARS->get('u_nickname'); ?></a>
		    | <i class="icon-calendar"></i> <?php echo $VARS->get('i_date'); ?>
		    | <i class="icon-comment"></i> <a href="#comments"><?php echo $VARS->get('comments')->count();?> Comments</a>
		    <!-- | <i class="icon-share"></i> <a href="#">39 Shares</a> -->
		    <br/>
		    -->
		    */?>
		    
		    
		    			

		    <!--
		    <br/>
		    Tags:
		    <a href="#"><span class="label label-info">Snipp</span></a>
		    <a href="#"><span class="label label-info">Bootstrap</span></a>
		    <a href="#"><span class="label label-info">UI</span></a>
		    <a href="#"><span class="label label-info">growth</span></a>
		    -->
    
          
          </div>
          
          <div class="hero-unit" style="padding-top:15px;">
          	<a name='comments'></a>
          	<h2>Comments</h2>
          	
          	<?php foreach($VARS->get('comments') as $key => $comment) { ?>
              	      <p class="muted">
              	      <?php if($VARS->get('i_u_fk')==$comment->get('co_u_fk')) { ?>
              	      	<i title="comment from owner" class="icon-certificate"></i> 
              	      <?php } else { ?>
              	      	     <i title="comment from other" class="icon-align-justify"></i>
              	      <?php }?>
              	      	<?php echo $comment->get("co_comment"); ?>
              	      	<br/><span class='date'><small><?php echo date("Y-m-d H:i:s", strtotime($comment->get("co_date"))); ?></small></span>
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
        
        <div class="span3" style="position:fixed; right:20px;">
        
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">photographer</li>
              <p class="muted">
              	<b><?php echo $VARS->get('u_nickname'); ?></b><br/>
              	<?php echo $VARS->get('u_country'); ?>, <?php echo $VARS->get('u_city'); ?>
              </p>
            </ul>
         </div>
         
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
        
        <?php if( $VARS->is_set('s_osm') && $VARS->get('s_osm')==1 ) { ?>
		<?php if($VARS->get('i_lng')!=0 /* && me()==$VARS->get('i_u_fk') */ ) { ?>
		<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
		
		<div class="well sidebar-nav" style='padding: 10px 10px 10px 10px;'>
		<div id="osmMap" style="height:250px;border-radius: 5px;"></div>
		</div>
		<script>
			var map;
		      function initOSM() {
			      map = new OpenLayers.Map("osmMap");
				var mapnik         = new OpenLayers.Layer.OSM();
				var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
				var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
				var position       = new OpenLayers.LonLat(<?php echo $VARS->get('i_lng')+blurred($VARS->get('i_u_fk'));?>,<?php echo $VARS->get('i_lat')+blurred($VARS->get('i_u_fk'));?>).transform( fromProjection, toProjection);
				var zoom           = <?php echo blurredZoom($VARS->get('i_u_fk')); ?>; 
			 
				map.addLayer(mapnik);
				map.setCenter(position, zoom);
				
				<?php if($VARS->get('i_set')!=0) { ?>
					var markers = new OpenLayers.Layer.Markers( "Markers" );
					map.addLayer(markers);
					var size = new OpenLayers.Size(21,25);
					var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
					var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
					<?php foreach($VARS->get('setimages') as $key => $img) {
						if($img->get('i_lng')==0) continue;
						?>
						markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $img->get('i_lng')+blurred($VARS->get('i_u_fk'));?>,<?php echo $img->get('i_lat')+blurred($VARS->get('i_u_fk'));?>).transform( fromProjection, toProjection),icon.clone()));
					<?php } ?>
					var bounds = markers.getDataExtent();
					map.zoomToExtent(bounds);
				<?php } else if(me()>0) { ?>
					var markers = new OpenLayers.Layer.Markers( "Markers" );
					map.addLayer(markers);
					
					var size = new OpenLayers.Size(21,25);
					var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
					var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
					markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $VARS->get('i_lng')+blurred($VARS->get('i_u_fk'));?>,<?php echo $VARS->get('i_lat')+blurred($VARS->get('i_u_fk'));?>).transform( fromProjection, toProjection),icon));
				<?php } ?>
		      }
		      
		      initOSM();
		      
		    </script>
		<?php } ?>
        <?php } ?>
        
        <?php /*
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              
            </ul>
          </div><!--/.well -->
          */ ?>
          

          
          
        </div><!--/span-->
        
