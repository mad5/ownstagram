
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
		    <?php echo $img->get('gl_content'); ?>
		    <!--
		    <a href='#' onclick="openIframe('-<?php echo $img->get('gi_gl_fk'); ?>-<?php echo $img->get('gi_id'); ?>');return false;"><?php 
		    if($i<9) { ?><img src='<?php echo $img->get('gl_url'); ?>' id='img_<?php echo $img->get('gi_id');?>' title="<?php echo $img->get('gi_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php  
		    } else { ?><img src="resources/ownstagram.jpg" class="lazy" imgsrc='<?php echo $img->get('gl_url'); ?>' id='img_<?php echo $img->get('gi_id');?>' title="<?php echo $img->get('gi_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php
		    } ?></a><div class='otitle'><?php echo $img->get('gi_title');?></div>
		    -->
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
              <li class=""><a href="index.php?action=discoverglobal">around the world</a></li>
              <li class="active"><a href="index.php?action=discoverflickr">newest on flickr</a></li>
            </ul>
          </div><!--/.well -->
          
          
          
          
        </div><!--/span-->
        
        
