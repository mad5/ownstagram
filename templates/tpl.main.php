<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $VARS->get('detailtitle'); ?>OwnStaGram</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

    </style>
    
    <link href="resources/bootstrap/css/bootstrap.responsive.min.css" rel="stylesheet">
    
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">OwnStaGram</a>
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
              <li class="active"><a href="index.php">Home</a></li>
              <?php if(me()>0) { ?>
              	<li><a href="index.php?action=overview">Overview</a></li>
              	
              	<?php if( getS('user', 'u_email')==ownStaGramAdmin || ($VARS->is_set('s_allowfriendsstreams') && $VARS->get('s_allowfriendsstreams')==1 ) ) { ?>
              	<li><a href="index.php?action=upload">Upload</a></li>
              	<?php } ?>
              	
              	<?php if(getS('user', 'u_email')==ownStaGramAdmin) { ?>
              		<li><a href="index.php?action=settings">Settings</a></li>
              		<li><a href="index.php?action=users">Users</a></li>
              	<?php } ?>
              	<li><a href="index.php?action=groups">Groups</a></li>
              <?php } else { ?>
              	 <li><a href="index.php?action=login">Login</a></li>
              	 
              	 <?php if( $VARS->is_set('s_allowregistration') && $VARS->get('s_allowregistration')==1 ) { ?>
              	 	 <li><a href="index.php?action=register">Register</a></li>
              	 <?php } ?>
              <?php } ?>
              
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

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
        OwnStaGram V<?php echo $GLOBALS["own"]->VERSION; ?> - a clone on my own host
        </p>
        </div>
        
        <?php if(me()>0 && getS('user', 'u_email')==ownStaGramAdmin) { ?>
        <center>
         	<span id='versioncheck'></span>
        </center>
        <?php } ?>
        
        <div style='float:right;'>
        <p>
        <a href='https://play.google.com/store/apps/details?id=org.apache.cordova.ownstagram' target="_blank">GET IT ON Google Play</a>
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

<?php if(isset($_GET['action']) && $_GET['action']=='overview') { ?>
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
