        <div class="span3">
                  <div class="well sidebar-nav">
                  	
                  </div>
        </div>

        <div class="span6">
          <div class="hero-unit">
          
            <h1>Upload picture</h1>
            
            
            <form method="post" enctype="multipart/form-data" action="index.php?action=upload">
		<input type="hidden" name="upload" value="1" />            
            	<br/>
            	<label>
            	<span class="singleFileLabel" style="display:block">select one image</span>
            	<span class="multipleFileLabel" style="display:none">select one or more images (use shift/ctrl)</span>
            	</label>
            	<input type="file" name="img[]" multiple="multiple"/>
            	<br/><br/>
            	<label>title</label>
            	<input type="text" name="title" />
            	<label class="checkbox">
            		<input type="radio" name="public" value="0" checked /> show picture if url is known<br/>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:8pt;'>You can share the url to the image. Everyone who gets the url can see the image.</span>
            	</label>
            	<label class="checkbox">
            		<input type="radio" name="public" value="1" /> make picture public<br/>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:8pt;'>use picture for collages on the front-page.</span>
            	</label>
            	<label class="checkbox">
            		<input type="radio" name="public" value="-1" /> make picture private<br/>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:8pt;'>only you can see the image.</span>
            	</label>
            	
            	<span class="multipleFileLabel" style="display:none;">
            		<br/>
			<label class="checkbox">
				<input type="radio" name="sameset" value="0" checked /> not a set<br/>
			</label>
            		
			<label class="checkbox">
				<input type="radio" name="sameset" value="1" /> add to new set
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=''>set-name: <input type='text' name='setname' value="" /></span>
			<br/>
            		
			<label class="checkbox">
				<input type="radio" name="sameset" value="2" /> or add to existing set
			</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="knownset">
				<option value='0'></option>
				<?php foreach($VARS->get('sets') as $key => $set) { ?>
					<option value='<?php echo $set->get('se_pk');?>' ><?php echo $set->get('se_name');?></option>
				<?php } ?>
				</select>

			<br/>
            	
            	</span>
            	
            	<br/>
                <p><button class="btn btn-primary btn-large">Upload picture &raquo;</button></p>

            </form>
            
          </div>

        </div><!--/span-->
        
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Upload picture</li>
              <p>
              Select a picture from your local device and upload to ownStaGram.
              </p>
              <p>
              if you choose to make the image public it will randomly appear at the home-screen and might be recommendet to other users.
              </p>
              <p>
              If you upload an image and send the details-url to someone via email, the recipient doesn't need to register to see the image.
              He or she can see this image because of the unique ID. 
              </p>
              <!--
              <p>
              If the recipient is already registered, the image will be linked to his/her account.
              </p>
              -->
              <br/><br/><br/>
              <p>
              <a href='https://play.google.com/store/apps/details?id=org.apache.cordova.ownstagram' target="_blank"><img src='resources/badge_android.png' border=0 /></a>
              </p>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
