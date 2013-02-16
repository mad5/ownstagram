
        <div class="span9">
          <div class="hero-unit">
            <h1><?php echo ($VARS->get('s_title')=='' ? 'OwnStaGram-Stream' : $VARS->get('s_title')."-stream"); ?> </h1>
          </div>
          
          <div class="row-fluid">
          
          <?php $i=0;
          	$lastDate = "";
          	$sets = array();
          	foreach($VARS->get('list') as $key => $img) {
          		?>
            <div class="span3">
            
            <h3 style='line-height:10px;padding-top:20px;float:left;'><?php
		    	if($lastDate!=date("d.m.Y", strtotime($img->get('gi_date')))) {
		    		echo date("d.m.Y", strtotime($img->get('gi_date')));
		    		$lastDate = date("d.m.Y", strtotime($img->get('gi_date')));
		    	} else {
		    		#echo "&nbsp;";
		    		echo "<span style='color: #efefef;'>".date("d.m.Y", strtotime($img->get('gi_date')))."</span>";
		    	}
		    ?></h3>
		    <div style='clear:both;'></div>
		    <a href='#' onclick="openIframe('-<?php echo $img->get('gi_gl_fk'); ?>-<?php echo $img->get('gi_id'); ?>');return false;"><?php 
		    if($i<9) { ?><img src='<?php echo $img->get('gl_host'); ?>/index.php?action=image&img=<?php echo $img->get('gi_imgid'); ?>&w=250' id='img_<?php echo $img->get('gi_id');?>' title="<?php echo $img->get('gi_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php  
		    } else { ?><img src="resources/ownstagram.jpg" class="lazy" imgsrc='<?php echo $img->get('gl_host'); ?>/index.php?action=image&img=<?php echo $img->get('gi_imgid'); ?>&w=250' id='img_<?php echo $img->get('gi_id');?>' title="<?php echo $img->get('gi_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php
		    } ?></a><div class='otitle'><?php echo $img->get('gi_title');?></div>
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
        
        <div class="span3" style="position:relative;">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">where</li>
              <li class=""><a href="index.php?action=discover">on this server</a></li>
              <li class="active"><a href="index.php?action=discoverglobal">around the world</a></li>
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
					if($img->get('gi_lng')==0) continue;
					?>
					markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $img->get('gi_lng');?>,<?php echo $img->get('gi_lat');?>).transform( fromProjection, toProjection),icon.clone()));
				<?php } ?>
				var bounds = markers.getDataExtent();
				map.zoomToExtent(bounds);
		      }
		      
		      initOSM();
		      
		    </script>
		
        <?php } ?>          
          
          
        </div><!--/span-->
        
        
