<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $VARS->get('detailtitle'); ?><?php echo siteName; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="resources/bootstrap/css/bootstrap.min<?php if($VARS->get('s_style')!='') echo ".".htmlentities($VARS->get('s_style')); ?>.css" rel="stylesheet">
	<meta name="description" content="OwnStaGram is a free photo-sharing software which allows to upload photos from within this site and an android-app." />
	<link rel="shortcut icon" href="favicon.ico" />
 <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      #osmMap img { max-width:none; }
      #osmMap .olControlAttribution {
      	      bottom: 0;
      }
      .form-signin div, .form-signin label, .form-signin p {
      	       color: gray;
      }
      .otitle {
      	      /*
      	      background-color: white;
      	      border-left: solid 1px silver;
      	      border-bottom: solid 1px silver;
      	      border-right: solid 1px silver;
      	      */
      	      
      	      /*padding: 0 3px 2px 3px;*/
      	      font-size: 80%;
      	      text-overflow: ellipsis;
      	      white-space: nowrap;
      	      overflow:hidden;
      }
    </style>
    
    <link href="resources/bootstrap/css/bootstrap.responsive.min.css" rel="stylesheet">
    
</head>
<body>

<?php if(!isset($_GET["hide"])) { ?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><?php echo siteName; ?></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
            <?php if(me()>0) { ?>
            	    <a href="index.php?action=overview" class="navbar-link"><?php echo getS("user", "u_email");?></a>
            	    &bull;
            	    <a href="#" onclick="ownStaGram.startLogout();return false;" class="navbar-link">Logout</a>
            <?php } else { ?>
            	    
            	    <a href="index.php?action=login" class="navbar-link">Login</a>
            	    <?php if( $VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ) { ?>
            	    	    or <a href="index.php?action=register" class="navbar-link">Register</a>
            	    <?php } ?>
            <?php } ?>
            </p>
            <ul class="nav">
              <li <?php if(!isset($_GET['action']) || $_GET['action']=='') echo 'class="active"';?>><a href="index.php">home</a></li>
              <?php if(me()>0) { ?>
              	      
              	      <?php if( getS('user', 'u_remoteserver')=='') { ?>
              	      	      <li <?php if(isset($_GET['action']) && $_GET['action']=='overview') echo 'class="active"';?>><a href="index.php?action=overview">my photos</a></li>
              	      <?php } else { ?>
              	      	      <li <?php if(isset($_GET['action']) && $_GET['action']=='overview') echo 'class="active"';?>><a href="index.php?action=overview">collected photos</a></li>
              	      <?php } ?>
              	
              	<?php if( getS('user', 'u_email')==ownStaGramAdmin || ($VARS->is_set('s_allowfriendsstreams') && $VARS->get('s_allowfriendsstreams')==1 ) ) { ?>
              		<?php if( getS('user', 'u_remoteserver')=='') { ?>
              			<li <?php if(isset($_GET['action']) && $_GET['action']=='upload') echo 'class="active"';?>><a href="index.php?action=upload">upload</a></li>
              		<?php } ?>
              	<?php } ?>
              	<?php if( ($VARS->is_set('s_allowfriendsstreams') && $VARS->get('s_allowfriendsstreams')==1)
              		||
              		($VARS->is_set('s_global') && $VARS->get('s_global')==1)
              		)  { ?>
       			<li <?php if(isset($_GET['action']) && substr($_GET['action'],0,8)=='discover') echo 'class="active"';?>><a href="index.php?action=discover">discover</a></li>
              	<?php } ?>
              	
              	<?php if(getS('user', 'u_email')==ownStaGramAdmin) { ?>
              		<li <?php if(isset($_GET['action']) && $_GET['action']=='settings') echo 'class="active"';?>><a href="index.php?action=settings">settings</a></li>
              		<li <?php if(isset($_GET['action']) && $_GET['action']=='users') echo 'class="active"';?>><a href="index.php?action=users">users</a></li>
              	<?php } ?>
       		<?php if( getS('user', 'u_remoteserver')=='') { ?>
       			<li <?php if(isset($_GET['action']) && $_GET['action']=='groups') echo 'class="active"';?>><a href="index.php?action=groups">groups</a></li>
       			<li <?php if(isset($_GET['action']) && $_GET['action']=='profile') echo 'class="active"';?>><a href="index.php?action=profile">profile</a></li>
              	<?php } ?>
              <?php } else { ?>
              	      
              	<?php if( $VARS->is_set('s_allowfriendsstreams') && $VARS->get('s_allowfriendsstreams')==1 )  { ?>
       			<li <?php if(isset($_GET['action']) && $_GET['action']=='discover') echo 'class="active"';?>><a href="index.php?action=discover">discover</a></li>
              	<?php } ?>
              	      
              	 <li <?php if(isset($_GET['action']) && $_GET['action']=='login') echo 'class="active"';?>><a href="index.php?action=login">login</a></li>
              	 
              	 <?php if( $VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ) { ?>
              	 	 <li <?php if(isset($_GET['action']) && $_GET['action']=='register') echo 'class="active"';?>><a href="index.php?action=register">register</a></li>
              	 <?php } ?>
              <?php } ?>
              
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<?php } ?>
<?php
/*
echo "<pre>";
print_r($_SESSION);
print_r(me());
echo "</pre>";
*/
?>
    <div class="container-fluid">
      <div class="row-fluid">
      
        <?php echo $VARS->get('CONTENT'); ?>
        
      </div><!--/row-->

      <hr>

      <footer>
      <div style='float:left;'>
        <p>
        OwnStaGram V<?php echo $GLOBALS["own"]->VERSION; ?> - a photo-sharing-service on my own host
        <?php if( $VARS->get('s_imprint')!="") { ?>
        	- <a href='index.php?action=info&info=imprint'>imprint</a>
        <?php } ?>
        <?php if( $VARS->get('s_privacy')!="") { ?>
        	- <a href='index.php?action=info&info=privacy'>privacy</a>
        <?php } ?>
        </p>
        </div>
        
        <?php if(me()>0 && getS('user', 'u_email')==ownStaGramAdmin) { ?>
        <center>
         	<span id='versioncheck'></span>
        </center>
        <?php } ?>
        
        <div style='float:right;'>
        <p>
        <a href='https://play.google.com/store/apps/details?id=org.apache.cordova.ownstagram' target="_blank" style='font-size:8pt;'>get the app on Google Play</a><br/>
        <a href='https://sourceforge.net/projects/ownstagram/' target='_blank' style='font-size:8pt;'>and the script on sourceforge</a>
        </p>
        </div>
        <div style="clear:both;"></div>
      </footer>

    </div><!--/.fluid-container-->    
    
    
<?php
?>

<script src="resources/jquery.min.js"></script>
<script src="resources/bootstrap/js/bootstrap.min.js"></script>
<script src="resources/ownstagram.js"></script>

<?php if(isset($_GET['action']) && ($_GET['action']=='overview' || $_GET['action']=='discover' || $_GET['action']=='discoverglobal')) { ?>
<script src="resources/lazyloader.js"></script>

       
<script>
$(function() {
  $("img.lazy").lazyloader({
        effect : "fadeIn",
        threshold : 100,
        imgSrcAttr : 'imgsrc',
        beforeLoadCls: 'loading'
    });
  
});
</script>
<?php } ?>
<script>
function supportMultiple() {
	var el = document.createElement("input");
	return ("multiple" in el);
}

$(function() {
  if(supportMultiple()) {
  	  
            $(".multipleFileLabel").show();
            $(".singleFileLabel").hide();
  }
  <?php
  if($VARS->get('s_global')==1) {
	  if($VARS->get('s_global_lastcheck')<date("Y-m-d H:i:s", time()-60*60)) { ?>
		  setTimeout(function() { ownStaGram.updateGlobal(); }, 5000);
	  <?php } else { ?>
	  	  setTimeout(function() { ownStaGram.getGlobalPix(); }, 5000);
	  <?php }
  } ?>
});
</script>

<?php if(me()>0 && getS('user', 'u_email')==ownStaGramAdmin) { ?>
        <script>
		$(function() {
				$.ajax({
						"url": "http://www.mad5.de/ownstagram/versioncheck.php",
						"type": "get",
						"data": {"version": "<?php echo $GLOBALS["own"]->VERSION; ?>"},
						"dataType": "jsonp",
						"success": function(data) {
							if(data.result==1) {
								$('#versioncheck').html('new version available!');
							}
						}
				});
		});
        </script>
<?php } ?>

</body>
</html>		
