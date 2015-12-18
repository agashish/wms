<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo "Despatch Console"; ?></h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
			<?php print $this->Session->flash(); ?>
              <div class="panel"> 
<div class="panel-title">
							<div class="panel-head">Barcode Scan Section</div>
							<div class="panel-tools">
										<a href="/wms/JijGroup/Generic/Order/GetOpenFilter"   class="btn bg-orange-500 color-white btn-dark">Go Back</a>
									</div>
							
						</div>
<div class="panel-body">

<div class="row">

                        <div class="col-lg-4 col-lg-offset-1">
								<div class="input text"><label for="LinnworksapisBarcode">Barcode</label> <input type="text" id="LinnworksapisBarcode" index="0" value="" class="get_sku_string form-control" name="data[Linnworksapis][barcode]">
								<p class="help-block">Please scan an item to start processing order</p>
								</div>
								
							</div>
							
							<div class="col-lg-4 col-lg-offset-1"><img alt="" title="Scanner" src="/wms/img/bar-code.png"></div>
						</div>
					
					<label><span>Orders containing barcode : <span><span class="searchbarcode"></span></label>
					<div class="outer_bin_addMore">
					
					</div>	
				</div>
			</div>
			
		</div>  

</div>						
                          
	</div>
<script>

$(function() {
  $("#LinnworksapisBarcode").focus();
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        submitSanningValue();
    }
});
$(document).keypress(function(e) {
    if(e.which == 13) {
		var url = $('.btn-success').attr('href');
        window.open(url,'_self');
    }
});

function submitSanningValue()
{
	var Barcode	=	$('#LinnworksapisBarcode').val();
	$('.searchbarcode').text(Barcode);
	$.ajax(
				{
						'url'            : getUrl() + '/Linnworksapis/getsearchlist',
						'type'           : 'POST',
						'data'           : { barcode : Barcode },
						'beforeSend'	 : function() {
															$('.loading-image').show();
														},
						'success' 		 : function( msgArray )
														{
															$('#LinnworksapisBarcode').val('');
															$('.outer_bin_addMore').html(msgArray);
															
														}  
						});  
					
}
</script>
