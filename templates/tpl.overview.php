
        <div class="span9">
          <div class="hero-unit">
            <h1><?php echo ($VARS->get('s_title')=='' ? 'OwnStaGram-Stream' : $VARS->get('s_title')."-stream"); ?> </h1>
          </div>
          
          <div class="row-fluid">
          
          <?php $i=0;
          	$lastDate = "";
          	$sets = array();
          	foreach($VARS->get('list') as $key => $img) {
          		if($img->get('i_set')!=0) {
          			if(in_array($img->get('i_set'), $sets)) continue;
          			$sets[] = $img->get('i_set');
          		}
          		?>
            <div class="span3">
            
		    <?php if($img->get('i_set')==0) { ?>
		    	    <h3 style='line-height:10px;padding-top:20px;float:left;padding-right:5px;'><div style='position:relative;top:5px;height:1px;'><a href='#' onclick="ownStaGram.star('<?php echo $img->get('id');?>', this);blur();return false;"><img rel='<?php echo $img->get('i_star'); ?>' src='resources/fav<?php echo $img->get('i_star'); ?>.png' border="0" /></a></div></h3>
		    <?php } ?>
	            <h3 style='line-height:10px;padding-top:20px;float:left;'><?php
		    	if($lastDate!=date("d.m.Y", strtotime($img->get('i_date')))) {
		    		echo date("d.m.Y", strtotime($img->get('i_date')));
		    		$lastDate = date("d.m.Y", strtotime($img->get('i_date')));
		    	} else {
		    		#echo "&nbsp;";
		    		echo "<span style='color: #efefef;'>".date("d.m.Y", strtotime($img->get('i_date')))."</span>";
		    	}
		    ?></h3>
		    <div style='clear:both;'></div>
		    
		    <a href='index.php?O=<?php echo $img->get('id');?>' onclick="openIframe('<?php echo $img->get('id'); ?>');return false;"><?php 
		    if($i<9) { ?><img src='index.php?action=image<?php echo ($img->get('i_set')!=0 ? '&set=1' : '');?>&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' id='img_<?php echo $img->get('id');?>' title="<?php echo $img->get('i_title');?>" style="<?php if($img->get('i_set')==0) { ?>border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;<?php } ?>" border="0" height="250" width="250" /><?php  
		    } else { ?><img src="resources/ownstagram.jpg" class="lazy" imgsrc='index.php?action=image<?php echo ($img->get('i_set')!=0 ? '&set=1' : '');?>&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' id='img_<?php echo $img->get('id');?>' title="<?php echo $img->get('i_title');?>" style="<?php if($img->get('i_set')==0) { ?>border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;<?php } ?>" border="0" height="250" width="250" /><?php
		    } ?></a><div class='otitle'><?php echo $img->get('i_title');?></div><?php if($img->get('i_u_fk')==me()) { ?><div style='display:none;' class='imgedit'>
		    	<?php if($img->get('i_set')==0) {?><div style='float:left;'><input type=checkbox class='editcheck' value='<?php echo $img->get('id');?>' onclick="ownStaGram.editchecks();" /></div><?php } ?>
		    	<div style='float:right;padding-right:30px;'>
				<a href='#' onclick="ownStaGram.rotate('<?php echo $img->get('id');?>', -1);blur();return false;"><img src='resources/ccw.png' border="0" /></a>
				<a href='#' onclick="ownStaGram.rotate('<?php echo $img->get('id');?>', 1);blur();return false;"><img src='resources/cw.png' border="0" /></a>
		    	</div>
		    	<div style='clear:both;'></div>
		    </div><?php } ?>
		    <div>
		    <?php if((int)$img->get('views')>0) { ?>
			    <div style="float:left;font-size:8pt;">
				<?php echo (int)$img->get('views');?> view<?php if((int)$img->get('views')>1) echo "s";?>
			    </div>
		    <?php } ?>
		    <?php if((int)$img->get('comments')>0) { ?>
			    <div style="float:right;padding-right:30px;font-size:8pt;">
				<?php echo (int)$img->get('comments');?> comment<?php if((int)$img->get('comments')>1) echo "s";?>
			    </div>
		    <?php } ?>
		    </div>
            </div><!--/span-->
          	  <?php
          	  if($i++%4==3) {
          	  	  echo '</div><div class="row-fluid">';
          	  	  $lastDate = "";
          	  }
          	  ?>
          <?php } ?>
            

          </div><!--/row-->
        </div><!--/span-->
        
        
        
        <div class="span3" style="position:fixed; right:20px;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">filter</li>
              <li class="<?php if(!isset($_GET['filter'])) echo "active";?>"><a href="index.php?action=overview">all</a></li>
              <li class="<?php if(isset($_GET['filter']) && $_GET['filter']=='fav') echo "active";?>"><a href="index.php?action=overview&filter=fav">favorites</a></li>
              <!--
              <li><a href="#">oldest first</a></li>
              <li><a href="#">random</a></li>
              <li><a href="#">most comments first</a></li>
              -->
            </ul>
          </div><!--/.well -->
          
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">editing</li>
              <li class=""><a href="#" onclick="$('.imgedit').toggle();if( $(this).parent().attr('class')=='active' ) { $(this).parent().removeClass('active'); } else {  $(this).parent().addClass('active'); }; return false;">enable editing</a></li>
              <!--
              <li><a href="#">oldest first</a></li>
              <li><a href="#">random</a></li>
              <li><a href="#">most comments first</a></li>
              -->
            </ul>
          </div><!--/.well -->

          <div class="well sidebar-nav" id='checkeditbox' style='display:none;'>
            <ul class="nav nav-list">
              <li class="nav-header">edit photos</li>
              	
		<form method="post" id='changesetform'>
		<input type='hidden' name='changeset' value='1' />
			
              	<label>add to set</label>
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
		
		
		<label>Visibility</label>
		<label class="checkbox">
			<input type="radio" name="public" value="-999" checked /> no changes to selected photos<br/>
		</label>		
		<label class="checkbox">
			<input type="radio" name="public" value="0" /> show picture if url is known<br/>
		</label>
		<label class="checkbox">
			<input type="radio" name="public" value="1" /> make picture public<br/>
		</label>
		<label class="checkbox">
			<input type="radio" name="public" value="-1" /> make picture private<br/>
		</label>	

		<label>set new Date<label>
		<input type="text" name="newdate" value="" placeholder="YYYY-mm-dd">
		
		<br/>
		
		<input type="submit" value='ok'>
		</form>
              	
            </ul>
          </div><!--/.well -->          
          

        <?php if( $VARS->is_set('s_osm') && $VARS->get('s_osm')==1 ) { ?>
		
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
				//var position       = new OpenLayers.LonLat(<?php echo $VARS->get('i_lng');?>,<?php echo $VARS->get('i_lat');?>).transform( fromProjection, toProjection);
				//var zoom           = 16; 
			 
				map.addLayer(mapnik);
				//map.setCenter(position, zoom);
				
				var markers = new OpenLayers.Layer.Markers( "Markers" );
				map.addLayer(markers);
				
				var size = new OpenLayers.Size(21,25);
				var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
				var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
				var im = 0;
				var M = new Array();
				<?php foreach($VARS->get('list') as $key => $img) {
					if($img->get('i_lng')==0) continue;
					?>
					M[im] = new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $img->get('i_lng')+blurred($img->get('i_u_fk'));?>,<?php echo $img->get('i_lat')+blurred($img->get('i_u_fk'));?>).transform( fromProjection, toProjection),icon.clone());
					M[im].id = '<?php echo $img->get('id'); ?>';
					M[im].events.register(
						"mousedown", 
						M[im],
						(function(ii) {
								return function() {
									openIframe(M[ii].id);
								}
						})(im)
						);
         				
					markers.addMarker(M[im]);
					im++;
					
				<?php } ?>
				var bounds = markers.getDataExtent();
				map.zoomToExtent(bounds);
		      }
		      
		      initOSM();
		      
		    </script>
		
        <?php } ?>          
          
          
        </div><!--/span-->
        
        
