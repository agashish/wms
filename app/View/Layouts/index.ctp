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
        <?php print $this->html->css(array('plugins/bootstrap-treeview/bootstrap-treeview','plugins/bootstrap/css/bootstrap.min','plugins/ionicons/css/ionicons.min','plugins/font-awesome/css/font-awesome.min','plugins/bootstrap-select/css/bootstrap-select.min','plugins/bootstrapValidator/bootstrapValidator.min', 'plugins/bootstrap-verticaltabs/bootstrap.vertical-tabs')); ?>
	<!-- END CORE FRAMEWORK -->
	
	<!-- BEGIN PLUGIN STYLES -->
        <?php print $this->html->css(array('plugins/animate/animate','plugins/queryLoader/queryLoader','plugins/datatables/dataTables.bootstrap','plugins/bootstrap-slider/css/slider','plugins/iCheck/skins/all','plugins/rickshaw/rickshaw.min','plugins/jquery-jvectormap/jquery-jvectormap-1.2.2','plugins/bootstrap-daterangepicker/daterangepicker-bs3')); ?>	
	<!-- END PLUGIN STYLES -->
	
	<!-- BEGIN SweetAlert Box STYLES -->
        <?php print $this->html->css(array('plugins/dist/sweetalert')); ?>	
	<!-- END PLUGIN STYLES -->
	
	<!-- BEGIN THEME STYLES -->
        <?php print $this->html->css(array('material','style','plugins','helpers','responsive')); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
	<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-leftside fixed-header sidebar-sm">
	<!-- BEGIN HEADER -->
        <?php 			  
			  if( $this->session->read('Auth.User')['username'] !== "jake.shaw" ):
					print $this->element( 'header_user' ); 
			  else:
					print $this->element( 'header' ); 
			  endif;
		?>
	<!-- END HEADER -->
		 
	<div class="wrapper">
		<!-- BEGIN LEFTSIDE -->
            <?php print $this->element( 'side_menu' ); ?>
		<!-- END LEFTSIDE -->

		<!-- BEGIN RIGHTSIDE -->
            <?php print $this->fetch( 'content' ); ?>
        <!-- /.wrapper -->
	<!-- END CONTENT -->
		
	<!-- BEGIN JAVASCRIPTS -->
	
	<!-- BEGIN CORE PLUGINS -->
        <?php print $this->html->script(array('plugins/bootstrap-treeview/bootstrap-treeview','plugins/jquery-1.11.1.min','plugins/queryLoader/queryLoader','plugins/iCheck/icheck.min','plugins/bootstrap/js/bootstrap.min','plugins/bootstrap/js/holder','plugins/pace/pace.min','plugins/slimScroll/jquery.slimscroll.min','plugins/bootstrap-select/js/bootstrap-select.min', 'plugins/bootstrapValidator/bootstrapValidator.min','plugins/bootstrap-modal-popover/bootstrap-modal-popover','core','custom','custom_datatable')); ?>
	<!-- END CORE PLUGINS -->
	
	<!-- flot chart  
    <?php print $this->html->script(array('plugins/flot/jquery.flot.min','plugins/flot/jquery.flot.grow','plugins/flot/jquery.flot.resize.min')); ?> -->

	<!-- sparkline  
    <?php print $this->html->script(array('plugins/sparkline/jquery.sparkline.min')); ?> -->
	
	<!-- bootstrap slider 
    <?php print $this->html->script(array('plugins/bootstrap-slider/js/bootstrap-slider')); ?>-->
	
	<!-- datepicker 
    <?php print $this->html->script(array('plugins/bootstrap-daterangepicker/moment.min','plugins/bootstrap-daterangepicker/daterangepicker')); ?>-->
	
	<!-- vectormap  
    <?php print $this->html->script(array('plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min','plugins/jquery-jvectormap/jquery-jvectormap-europe-merc-en')); ?>-->
	
	<!-- counter  
    <?php print $this->html->script(array('plugins/jquery-countTo/jquery.countTo')); ?>-->
	
	<!-- rickshaw  
        <?php print $this->html->script(array('plugins/rickshaw/vendor/d3.v3','plugins/rickshaw/rickshaw.min')); ?>-->
	
	<!-- datatables -->
	<?php print $this->html->script(array('plugins/datatables/jquery.dataTables','plugins/datatables/dataTables.bootstrap')); ?>
	
	<!-- maniac -->
        <?php print $this->html->script(array('maniac')); ?>

	<!--inputmask -->
    <?php print $this->html->script(array('plugins/input-mask/jquery.inputmask','plugins/input-mask/jquery.inputmask.date.extensions','plugins/input-mask/jquery.inputmask.numeric.extensions')); ?>
	
	<!-- SweetAlert Customization -->
	<?php print $this->html->script(array('plugins/dist/sweetalert.min')); ?>
	
	<!-- dashboard -->
	<script type="text/javascript">
		//maniac.loadchart();
		//maniac.loadvectormap();
		//maniac.loadbsslider();
		//maniac.loadrickshaw();
		//maniac.loadcounter();
		//maniac.loadprogress();
		//maniac.loaddaterangepicker();
		
		/* Call custom datatable js */
		maniac.loadinputmask();
	</script> 
<script>
$(document).ready(function(){
    $('#popup-scroller1').slimScroll({
        height: '450px',
		width:'100%',
		alwaysVisible: true
    });
 $('#popup-scroller2').slimScroll({
        height: '450px',
		width:'100%',
		alwaysVisible: true
    });
  $('#popup-scroller3').slimScroll({
        height: '300px',
		width:'100%',
		alwaysVisible: true
    });
    $('#popup-scroller5').slimScroll({
        height: '300px',
		wheelStep: 1,
		animate: true,
		width:'100%',
		alwaysVisible: true
    });
	
	$('.rackDetails .panel-body').slimScroll({
        height: '383px',
		width:'100%',
		size:'3',
		alwaysVisible: true
    });
    
    $('.attr_show').slimScroll({
        height: '485px',
		width:'100%',
		size:'3',
		alwaysVisible: false
    });
	
	$('.sortingSerivesLeft>.panel-body').slimScroll({
        height: '430px',
		width:'100%',
		size:'3',
		alwaysVisible: true
    });
	
	$('.sortingSerivesRight>.panel-body').slimScroll({
        height: '430px',
		width:'100%',
		size:'3',
		alwaysVisible: true
    });
  
	/* Call datatable */
	$('table.display').dataTable();
	
	window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
 
 
 $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});


    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
	
	$('input').iCheck({
			handle: 'radio',
			radioClass: 'iradio_square-green'
		});
		
	$('input').iCheck({
			handle: 'checkbox',
			checkboxClass: 'icheckbox_square-green'
		});

});


/* $(document).on('show','.accordion', function (e) {
         //$('.accordion-heading i').toggleClass(' ');
         $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });
    
    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });

	
*/
</script>
<script>
 
$(function(){
 
	$(document).on( 'scroll', function(){
 
		if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
</script>
	<!-- END JAVASCRIPTS -->
	
	<div class="scroll-top-wrapper ">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>

<script>
  //QueryLoader.selectorPreload = "body";
  //QueryLoader.init();
</script>
 
<script type="text/javascript">
		maniac.loaddatatables();
	</script>
</body>
<!-- END BODY -->

<!-- Mirrored from demo.yakuzi.eu/maniac/1.2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 May 2015 06:15:20 GMT -->
</html>
