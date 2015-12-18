<div class="modal fade pop-up-4" tabindex="-1" role="dialog" id="pop-up-4" aria-labelledby="myLargeModalLabel-4" aria-hidden="true">
	<div class="modal-dialog modal-bags">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title color-white" id="myLargeModalLabel-3">Add Bags</h4>
			</div>
			<div class="modal-body bg-grey-100">
				<div class="row">
					<div class="col-lg-12" id="popup-scroller4">
						<div class="text-center border-bottom-1 border-grey-100">
							
							<div class="panel no-border ">
								<div class="panel-title bg-brown-200 no-border">
									<div class="panel-head">Service (Bags)</div>									
								</div>
								<div class="panel-body bg-white">
									<div class="col-sm-4">Your Bags</div>
									<div class="col-sm-4"><input type="text" id="serviceBag" class="form-control customInput" name="serviceBag" for="<?php print $getParamsData[0]['ServiceCounter']['id']; ?>" value="<?php echo $getParamsData[0]['ServiceCounter']['bags'];?>"></div>
									<!--<button type="submit" class="add_attribute btn bg-green-500 color-white btn-dark padding-left-30 padding-right-30">Add</button>-->
									<div class="col-sm-4"><button type="button" class="btn bg-green-500 color-white btn-dark padding-left-30 padding-right-30 customAdd">+</button></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
   $(document).ready(function()
   {
       $('#pop-up-4').modal('show');

		
		//Update and add bags
		$( 'body' ).on( 'click', '.customAdd', function()
		{	
			//Add One at once
			var counter = parseInt($('.customInput').val());
						
			// Get Data ID and Value
			var exactLocationClick 	= $('.customInput').val();
			var exactLocationId 	= $('.customInput').attr('for');						
			
			$.ajax(
			{
				'url'            : getUrl() + '/Cronjobs/addBagByOperator',
				'type'           : 'POST',
				'data'           : { exactLocationClick : exactLocationClick , exactLocationId : exactLocationId },			
				'beforeSend'	 : function()
				{
					//$('.loading-image').show();
				},
				'success' 		 : function( msgArray )
								   {
									    var afterSplit = msgArray.split('==');
										$('.customInput').attr( 'value' , afterSplit[0] );
										
										//Now change into dom
										var id = afterSplit[1];
										$( 'div.row div.customDisplay'+id ).html( afterSplit[0] );
										$( '.close' ).click();
										counter = '';
								   }
			});
		});
		
   });
</script>

