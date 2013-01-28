
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
		    if($i<9) { ?><img src='index.php?action=image&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' title="<?php echo $img->get('i_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php  
		    } else { ?><img src="resources/ownstagram.jpg" class="lazy" imgsrc='index.php?action=image&img=<?php echo md5($img->get('i_date').$img->get('i_file')); ?>&w=250' title="<?php echo $img->get('i_title');?>" style="border:solid 1px silver;box-shadow:0 10px 18px -10px #888888;border-radius:3px;" border="0" height="250" width="250" /><?php
		    } ?></a><?php if($img->get('i_u_fk')==me()) { ?><div style='display:none;' class='imgedit'>
		    	<div style='float:left;'><input type=checkbox /></div>
		    	<div style='float:right;padding-right:30px;'>
				<img src='resources/cw.png'>
				<img src='resources/ccw.png'>
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
              <li class="nav-header">sorting</li>
              <li class="active"><a href="#">newest first</a></li>
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
          
        </div><!--/span-->
        
        
