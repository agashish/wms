<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
		
			<div class="panel-title no-radius bg-green-500 color-white no-border">
				<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			</div>
		
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
				<?php
                                print $this->form->create( 'Warehouse', array( 'class'=>'form-horizontal', 'url' => '/manageWarehouse', 'type'=>'post','id'=>'warehouse' ) );
                                print $this->form->input( 'Warehouse.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'WarehouseDesc.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'WarehouseRackId.custom_id', array( 'type'=>'hidden', 'value' => $this->request->data['WarehouseRackId'] ) );
                            ?>
            
            <div class="col-lg-6 warehouseDetails">
              <div class="panel">
				<div class="panel-title">
									<div class="panel-head">Warehouse Details</div>
									
				</div>
					<div class="panel-body">
                    <div class="row">
					
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Type</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
												$getType	=	array('1' => 'Default', '2' => 'FBA( amazon )');
                                                print $this->form->input( 'WarehouseDesc.warehouse_type', array( 'type'=>'select', 'empty'=>'Choose Warehouse Type','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
                                
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">County</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'WarehouseDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose county','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>                           
                                
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">State</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'WarehouseDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose state','options'=>$getStateList,'class'=>'form-control selectpicker', 'data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">City</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                   print $this->form->input( 'WarehouseDesc.city_id', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown',  'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Name</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'Warehouse.warehouse_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Phone</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'WarehouseDesc.warehouse_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Status</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                    $statusArray = Configure::read( 'status_key' );
                                                    if( count( $statusArray ) > 0 )
                                                        print $this->form->input( 'Warehouse.status', array( 'type'=>'select', 'empty'=>'Choose status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                            ?>  
                                        </div>
                                      </div>
									  
								 </div>                              
                               </div>
                                    
                                </div>
                            </div>
                </div>
				<div class="col-lg-6 rackDetails">
				<div class="panel rackdetail">
                                <div class="panel-title">
									<div class="panel-head">Rack Details</div>
									<div class="panel-tools">
										<a class="add_fieldset" id="btnAdd" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
									</div>
								</div>
                                <div class="panel-body">
									<div class="row rack_block" style="display:none;" >
										  <?php $i=1; foreach($this->request->data['WarehouseRackData'] as $data)
											{
										  ?>
										  
											<div class="rackContainer" id="delete_<?php echo $data['WarehouseRack']['id']; ?>" >
											<div class="col-lg-3">
												<div class="rackBox">
													<?php if($data['WarehouseRack']['is_deleted'] == 1) { ?>
														<a class="add_rack btn btn-labeled btn-danger panel-tile margin-bottom-10"><span class="btn-label"><i class="glyphicon glyphicon-remove" onclick="retrieve_rack( <?php echo $data['WarehouseRack']['id']?> );"></i></span><?php echo $data['WarehouseRack']['warehouse_rack_label']; ?></a>
													<?php } else { ?>
														<a class="add_rack btn btn-labeled btn-success panel-tile margin-bottom-10"><span class="btn-label"><i class="glyphicon glyphicon-remove" onclick="delete_rack( <?php echo $data['WarehouseRack']['id']?> );"></i></span><?php echo $data['WarehouseRack']['warehouse_rack_label']; ?></a>
													<?php } ?>
													<span class="label bg-red-500 border-grey-100 label-rounded"><?php echo " ".$i; ?></span>
													</div>
													<?php
														print $this->form->input( ' ', array( 'type'=>'hidden','div'=>false,'label'=>false,'default'=>'1','class'=>'form-control', 'required'=>false , 'name' => 'data[WarehouseRack][warehouse_rack_label][]','value' => $data['WarehouseRack']['warehouse_rack_label']) );
													?>													
											</div>
											</div>
											
											 
											
											<?php $i++; } ?>  
								   </div>	
								   <!--<div class="col-lg-3">
										 <a class="add_fieldset rackEmpty btn btn-labeled btn-default panel-tile margin-bottom-10 panel-empty">
											<span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>New
										</a>
									</div>-->
                                </div>
                            </div>
				</div>
				
				<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-300" style="clear:both">                                                                             
                                     
									 <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showallWarehouses')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>								 
									  <?php
											echo $this->Form->button('Save', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
										?>
										<?php if($this->request->data['WarehouseDesc']['warehouse_type'] == 1) { ?>
										<!--<a class="add_fieldset btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40 margin-left-10" id="btnAdd" href="javascript:void(0);">Add More</a>-->
										<?php } ?>
                                    </div>	
									</form>
        </div><!-- /.col -->
    </div><!-- /.row -->
		
		<!-- Start here listing of countries whose would be active or deactive -->
		
		
    </div>        
</div>


<script>
	var count = '<?php echo count($this->request->data['WarehouseRackData']) ?>';
	
	$(document).ready(function(){
		$( "#WarehouseDescWarehouseType" ).change(function() {
				if($(this).val() == 1)
				{ $('.rack_block').show(); }
				else{ $('.rack_block').hide(); }
				});
				

		$( ".add_fieldset" ).click(function()
				{			
					var rackHtml = $(".rackContainer").html();			
					var counter = $('div.rackContainer:visible').length;
					var str = counter+1;
					var count =0;	
							
					rackHtml = rackHtml.replace(' 1', str);
					rackHtml = rackHtml.replace('glyphicon-remove', 'glyphicon-minus');
					rackHtml = rackHtml.replace('btn-success', 'btn-info');
					rackHtml = rackHtml.replace('<span class="btn-label">', '<span class="btn-label remove">');			
					
					$(".rack_block").append( '<div class="rackContainer">' + rackHtml + '</div>' );								
					
					$('.glyphicon-minus').removeAttr('onclick');
					$( ".rack_block .rackContainer .label-rounded" ).each(function() {
								var content = $(this).text();
								count = count+1;
								content.replace($(this).text(),$(this).text(count));
						});	
					
					
				});
		$("body").on("click", ".remove", function () {
					var count =0;
					$(this).closest(".rackContainer").remove();
					$( ".rack_block .rackContainer .label-rounded" ).each(function() {
					var content = $(this).text();
					count = count+1;
					content.replace($(this).text(),$(this).text(count));
						});	
				});
		
		<?php if($this->request->data['WarehouseDesc']['warehouse_type'] == 1) { ?>
			$('.rack_block').show();
		<?php } ?>
		
		if($(".ion-close-circled").length == '1')
					{
						$('#icons').remove();
					}
					
		})
		
	function delete_rack(id)
	{
		swal({
        title: "Are you sure?",
        text: "You want to delete this rack !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
			},
				function(isConfirm)
					{
						if (isConfirm)
							{
								var deleteStatus =	"";
								$.ajax({
								'url' 		:	 '<?php echo Router::url('/', true); ?>/deleteRack',
								'type'		:	'POST',
								'data'		:	{ id :id , deleteStatus : deleteStatus},
								'success' 	: 	function(data)
									{
										swal("Rack deleted", data , "success");
										location.reload();
										return false;
				
									}
								});
						}
						else
						{
							swal("Cancelled", "Your rack is safe :)", "error");
						}
		
				});
	}
	
	function retrieve_rack( id )
	{
		swal({
        title: "Are you sure?",
        text: "You want to retrieve this rack !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, retrieve it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
			},
				function(isConfirm)
					{
						if (isConfirm)
							{
								var deleteStatus =	"Retrieve";
								$.ajax({
								'url' 		:	 '<?php echo Router::url('/', true); ?>/retrieveRack',
								'type'		:	'POST',
								'data'		:	{ id :id, deleteStatus : deleteStatus },
								'success' 	: 	function(data)
									{
										swal("Rack retrieved", data , "success");
										location.reload();
										return false;
				
									}
								});
						}
						else
						{
							swal("Cancelled", "Your rack is deleted now :)", "error");
						}
		
				});
	}
	
</script>
