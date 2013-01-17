
        <div class="span9">
          <div class="hero-unit">
		<h1><?php echo ($VARS->get('s_title')=='' ? 'My ownStaGram!' : $VARS->get('s_title')); ?> </h1>
		<h3><?php echo ($VARS->get('s_subtitle')=='' ? 'the self-hosted photosharing-platform.' : $VARS->get('s_subtitle')); ?> </h3>
          </div>
          
          <div class="row-fluid">
            <div class="span4">
              <h2>Photo-Sharing</h2>
              <p>OwnStaGram is a free photo-sharing software which allows to upload photos from within this site and an available <a href='http://www.mad5.de/ownstagram/resources/badge_android.png' target='_blank'>android-app</a>.</p>
              <p>Every picture can be shared via an unique url.<br/><a href='http://www.mad5.de/ownstagram/index.php?action=detail&id=2536ffcf71a8d53d07c73393fafe8b95' target='_blank'>Try this one...</a></p>
              <!-- <p><a class="btn" href="#">View details &raquo;</a></p> -->
            </div><!--/span-->
            <div class="span4">
              <h2>Self-Hosted</h2>
              <p>
              OwnStaGram is a small PHP-OpenSource-project which will be installed easily on every php/mysql-enabled server.
              </p>
              
            </div><!--/span-->
            <div class="span4">
              <h2>Ownership</h2>
              <p>
              Keep the ownership of your photos. No one will every use them for advertising or anything else.<br>
              Your photos belong to you.
              </p>
              
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span4">
              <h2>Open-Source</h2>
              <p>
              	the ownStaGram-platform is licensed under GPL-V3.<br/>
              	<a href='https://sourceforge.net/projects/ownstagram/' target="_blank">See project at sourceforge.net</a><br/>
              	Download latest version: 
              		<a href='https://sourceforge.net/projects/ownstagram/files/latest/download' target="_blank">ownStaGram.tar.gz</a>
              </p>
              
            </div><!--/span-->
            <div class="span4">
              <h2>Minimum requirements</h2>
              <p>
              	You need a PHP/MySQL enabled webserver. Nothing more.
              </p>
              
            </div><!--/span-->
            <div class="span4">
              <h2>App &amp; API</h2>
              <p>
              	Use the free <a href='http://www.mad5.de/ownstagram/resources/badge_android.png' target="_blank">android-app</a> to take and share photos from everywhere.<br/>
              	An API to use the service from within other software is in development.<br/>
              	<center>
              	<a href='https://play.google.com/store/apps/details?id=org.apache.cordova.ownstagram' target="_blank"><img src='resources/badge_android.png' border=0 /></a>
              	</center>
              </p>
              
            </div><!--/span-->
          </div><!--/row-->
          
          <br/><br/>
          
          <div class="row-fluid">
            <div class="span4">
            	<h2>Recognized by others</h2>
            	<p>
            	   <b>Instagram Alternative That Lets You Own Your Photos 100%</b><br/>
            	    If you want to share photos that you truly own, you can host your own Instagram-like platform with Ownstagram. This photo sharing software lets you upload your pictures from the website or its own dedicated Android app, while having full ownership of your photos.
            	    <br/>
            	    <a href="http://www.makeuseof.com/dir/ownstagram-instagram-alternative-that-lets-you-own-your-photos-100/" target="_blank">read full review at makeuseof.com</a>
            	</p>
            	<p>
            	<a href="http://www.makeuseof.com/dir/ownstagram-instagram-alternative-that-lets-you-own-your-photos-100/" target="_blank" title="Cool Websites, Software and Internet Tips"><img src="http://www.makeuseof.com/images/logo/recby_new.png"></a>
            	</p>
            
            </div><!--/span-->
            
            <div class="span4">
            	<h2>&nbsp;</h2>
            	<p>
            	   <b>Ownstagram - In a nutshell</b><br/>
            	   <br/>
            	    Ownstagram works much like infamous Instagram, allowing you to quickly shoot a picture, upload it and share it with your friends. It’s still a little rough around the edges but looks very promising.
            	    <br/>
            	    <a href="http://selfhostedweb.org/ownstagram/" target="_blank">read full review at selfhostedweb.org</a>
            	    
            	</p>
            
            </div><!--/span-->
            
            
            
            <div class="span4">
            	<h2>&nbsp;</h2>
            	<p>
            	   <b>você é dono de 100% das suas fotos</b><br/>
            	   <br/>
            	    'Ownstagram': uma opção ao Instagram onde 'você é dono de 100% das suas fotos'<br/>
            	    Este sistema de compartilhamento de fotos permite que os usuários enviem suas imagens a partir do site ou do próprio app para Android, e o principal:  você terá plena propriedade sobre suas fotos.
            	    <br/>
            	    <a href="http://canaltech.com.br/noticia/apps/Ownstagram-uma-opcao-ao-Instagram-onde-voce-e-dono-de-100-das-suas-fotos/" target="_blank">read full review at canaltech.com.br</a>
            	    
            	</p>
            
            </div><!--/span-->
            
            
            
          </div><!--/row-->
           
          
        </div><!--/span-->
        
        <div class="span3">
           <div class="row-fluid">
              
                  <div class="well sidebar-nav">
		    <ul class="nav nav-list">
		      <li class="nav-header">Public photos from all users</li>
		      <?php foreach($VARS->get('public') as $key => $other) { 
				?><a href='index.php?action=detail&id=<?php echo $other->get("id");?>'><?php 
				?><img src='index.php?action=image&amp;img=<?php echo md5($other->get('i_date').$other->get('i_file')); ?>&amp;w=47' width=47 height=47 /><?php
				?></a><?php
		      } ?>
		   </ul>
		  </div>

            
          </div><!--/.row -->
        </div><!--/span-->
        
