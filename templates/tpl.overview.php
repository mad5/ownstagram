
        <div class="span9">
          <div class="hero-unit">
            <h1><?php echo ($VARS->get('s_title')=='' ? 'OwnStaGram-Stream' : $VARS->get('s_title')."-stream"); ?> </h1>
          </div>
          
          <div class="row-fluid">
          
          <?php $i=0;
          	$lastDate = "";
          	foreach($VARS->get('list') as $key => $img) {  ?>
            <div class="span3">
            
            <h3 style='line-height:10px;padding-top:20px;float:left;'><?php
		    	if($lastDate!=date("d.m.Y", strtotime($img->get('i_date')))) {
		    		echo date("d.m.Y", strtotime($img->get('i_date')));
		    		$lastDate = date("d.m.Y", strtotime($img->get('i_date')));
		    	} else {
		    		#echo "&nbsp;";
		    		echo "<span style='color: #efefef;'>".date("d.m.Y", strtotime($img->get('i_date')))."</span>";
		    	}
		    ?></h3>
		    <h3 style='line-height:10px;padding-top:20px;float:right;padding-right:30px;'><div style='position:relative;top:5px;height:1px;'><a href='#' onclick="ownStaGram.star('<?php echo $img->get('id');?>', this);blur();return false;"><img rel='<?php echo $img->get('i_star'); ?>' src='resources/fav<?php echo $img->get('i_star'); ?>.png' border="0" /></a></div></h3>
		    
		    <a href='index.php?action=detail&id=<?php echo $img->get('id');?>' onclick="openIframe('<?php echo $img->get('id'); ?>');return false;"><?php 
		    if($i<9) { ?><img src='index.php?action=image&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' id='img_<?php echo $img->get('id');?>' title="<?php echo $img->get('i_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php  
		    } else { ?><img src="resources/ownstagram.jpg" class="lazy" imgsrc='index.php?action=image&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' id='img_<?php echo $img->get('id');?>' title="<?php echo $img->get('i_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php
		    } ?></a><?php if($img->get('i_u_fk')==me()) { ?><div style='display:none;' class='imgedit'>
		    	<!--<div style='float:left;'><input type=checkbox /></div>-->
		    	<div style='float:right;padding-right:30px;'>
				<a href='#' onclick="ownStaGram.rotate('<?php echo $img->get('id');?>', -1);blur();return false;"><img src='resources/ccw.png' border="0" /></a>
				<a href='#' onclick="ownStaGram.rotate('<?php echo $img->get('id');?>', 1);blur();return false;"><img src='resources/cw.png' border="0" /></a>
		    	</div>
		    	<div style='clear:both;'></div>
		    </div><?php } ?>
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
        
        <div class="span3">
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
          
          

        <?php if( $VARS->get('s_osm')==1 ) { ?>
		
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
				<?php foreach($VARS->get('list') as $key => $img) {
					if($img->get('i_lng')==0) continue;
					?>
					markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $img->get('i_lng');?>,<?php echo $img->get('i_lat');?>).transform( fromProjection, toProjection),icon.clone()));
				<?php } ?>
				var bounds = markers.getDataExtent();
				map.zoomToExtent(bounds);
		      }
		      
		      initOSM();
		      
		    </script>
		
        <?php } ?>          
          
          
        </div><!--/span-->
        
        
