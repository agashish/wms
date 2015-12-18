<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<!-- Mirrored from demo.yakuzi.eu/maniac/1.2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 May 2015 06:14:06 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	
	<title>WMS - Dashboard</title>
	
	<!-- BEGIN CORE FRAMEWORK -->
        <?php print $this->html->css(array('plugins/bootstrap/css/bootstrap.min','plugins/ionicons/css/ionicons.min','plugins/font-awesome/css/font-awesome.min')); ?>
	<!-- END CORE FRAMEWORK -->
	
	<!-- BEGIN PLUGIN STYLES -->
        <?php print $this->html->css(array('plugins/animate/animate')); ?>	
	<!-- END PLUGIN STYLES -->
	
	<!-- BEGIN THEME STYLES -->
        <?php print $this->html->css(array('material','style','plugins','helpers','responsive')); ?>	
	<!-- END THEME STYLES -->
	
	<!-- BEGIN THEME STYLES -->
        <?php print $this->html->css(array('plugins/bootstrapValidator/bootstrapValidator.min','plugins/switchery/switchery.min')); ?>	
	<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="auth-page height-auto bg-blue-600">
	<!-- BEGIN CONTENT -->
	<?php
		print $this->fetch( 'content' );
	?>
	<!-- END CONTENT -->
		
<!-- BEGIN JAVASCRIPTS -->
	
	<!-- BEGIN CORE PLUGINS -->
        <?php print $this->html->script(array('plugins/jquery-1.11.1.min','plugins/bootstrap/js/bootstrap.min','plugins/bootstrap/js/holder','plugins/slimScroll/jquery.slimscroll.min','core')); ?>
	<!-- END CORE PLUGINS -->
	
	<!-- maniac -->
    <?php print $this->html->script(array('maniac')); ?>
	
    <?php print $this->html->script(array('plugins/bootstrapValidator/bootstrapValidator.min','plugins/switchery/switchery.min')); ?>
	
	<!-- dashboard -->
	<script type="text/javascript">		
		maniac.loadvalidator();
		maniac.loadswitchery();
	</script> 

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

<!-- Mirrored from demo.yakuzi.eu/maniac/1.2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 May 2015 06:15:20 GMT -->
</html>
