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
		  <a href='index.php?action=discoverglobal' onclick="return closeIframe();" class="btn btn-link"><i class="icon-arrow-left"></i> close detail-view</a>
		  </div>
                
                
                  <div class="well sidebar-nav" id='links'>
                  
                  	<a href='#' id='maillink' onclick="var H = window.location+'';H=H.replace('hide=1&', '');H=H.replace('&','%26');window.location='mailto:?subject=take%20a%20look&body=see this picture:%0a'+H+'%0a%0a';return false;" class="btn btn-link"><i class="icon-envelope"></i> send this image via email</a><br/> 
                  	
                  </div>
                  
                
		                 
                  
        </div>

        <div class="span6">
        <div class="hero-unit" style="padding-top:15px;padding-bottom:20px;">
		  
		  <div style="float:left;">
			<h2><?php echo date("d.m.Y", strtotime($VARS->get('gi_date')));?></h2>
		  </div>
		  
		  
		  <div style="clear:both;"></div>
		  
		 
		  <div style='max-width:540px;background-color:white;border-radius: 5px;box-shadow:0 10px 18px -10px #888888;'>
			  <div style='padding:20px;'>
			  <img src='<?php echo $VARS->get('imgsrc');?>' width=500 height=500 style="border:solid 1px silver;border-radius:5px;" />
			  </div>
			  <div style='height:30px;padding:0 20px 20px 20px;float:left;'>
				  <?php if($VARS->get('gi_title')!="") { ?>
					  <b><?php echo $VARS->get('gi_title');?></b><br/>
				  <?php } ?>
			  </div>
			  
			  
			  <div style='height:30px;padding:0 20px 20px 20px;float:right;'>
			  <a href="http://twitter.com/share?text=<?php echo urlencode( ($VARS->get('gi_title')=='' ? 'this photo' : $VARS->get('gi_title')).' on ownStaGram');?>&url=http://<?php echo urlencode($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);?>" target="_blank"><img src='resources/twitter.png' /></a>
 
			  <a href="http://www.facebook.com/sharer.php?u=http://<?php echo urlencode($_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);?>" target="_blank"><img src='resources/facebook.png' /></a>
			  </div>
			  <div style='clear:both;'></div>
		    
		  </div>
		  <br/>
			
		    
		    
          </div>
          
          
        </div><!--/span-->
        
        <div class="span3" style="position:fixed; right:20px;">
        
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">remote host</li>
              <p class="muted">
              	<a href='<?php echo $VARS->get('gl_host');?>' target='_blank'><?php echo $VARS->get('gl_host');?></a>
              </p>
            </ul>
         </div>
         
        <?php if($VARS->get('i_location')!="") { ?>
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Location</li>
              <p class="muted">
              	<?php echo $VARS->get('gi_location'); ?>
              </p>
            </ul>
         </div>
        <?php } ?>
        
        <?php if( $VARS->is_set('s_osm') && $VARS->get('s_osm')==1 ) { ?>
		<?php if($VARS->get('gi_lng')!=0 /* && me()==$VARS->get('i_u_fk') */ ) { ?>
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
				var position       = new OpenLayers.LonLat(<?php echo $VARS->get('gi_lng');?>,<?php echo $VARS->get('gi_lat');?>).transform( fromProjection, toProjection);
				var zoom           = 15; 
			 
				map.addLayer(mapnik);
				map.setCenter(position, zoom);
				

					var markers = new OpenLayers.Layer.Markers( "Markers" );
					map.addLayer(markers);
					
					var size = new OpenLayers.Size(21,25);
					var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
					var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
					markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $VARS->get('gi_lng');?>,<?php echo $VARS->get('gi_lat');?>).transform( fromProjection, toProjection),icon));
				
		      }
		      
		      initOSM();
		      
		    </script>
		<?php } ?>
        <?php } ?>
        
       
          

          
          
        </div><!--/span-->
        
