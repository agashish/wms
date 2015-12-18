<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php //print $role;?></h1>
				<div class="submenu">
					<div class="navbar-header">
				</div>	
				</div>
					<div class="panel-head"><?php print $this->Session->flash(); ?></div>
				</div>
		<div class="container-fluid">
				<div class="row">
				<?php //pr($this->request->data); ?>
				<?php
					print $this->form->create( 'PostalServiceDesc', array( 'class'=>'form-horizontal', 'url' => '/Matrices/addMatrix', 'type'=>'post','id'=>'deleverymatrix' ) );
					print $this->form->input( 'PostalServiceDesc.id', array( 'type'=>'hidden') );
				?>
            <div class="col-lg-12 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Postal Services</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                   			<div class="col-lg-4">
									
									 <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Warehouse</label>                                        
										<div class="col-lg-7">                                            
										   <?php
										   $warehouse = array('Jersey' => 'Jersey','New Jersey'=>'New Jersey');
										   if( count( $warehouse ) > 0 )
												print $this->form->input( 'PostalServiceDesc.warehouse', array( 'type'=>'select', 'empty'=>'Choose Warehouse','options'=>$warehouse,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
                   			
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Service Level</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												if( count( $service ) > 0 )
												print $this->form->input( 'PostalServiceDesc.service_level_id', array( 'type'=>'select', 'empty'=>'Choose Postal Service','options'=>$service,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Delivery Country</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												if( count( $deleverCountry ) > 0 )
												print $this->form->input( 'PostalServiceDesc.delevery_country', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$deleverCountry,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Courier/Postal Provider</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.courier', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Service Name</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.service_name', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Provider Ref Code</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.provider_ref_code', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Per item</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.per_item', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									   <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Per kilo</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.per_kilo', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
							 </div>
							 <div class="col-lg-4">
							  	    <div class="form-group" >
										<label for="username" class="control-label col-lg-5">CCY of Prices</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												$currency	=	array('GBP' => 'GBP', 'EUR'=>'EUR');
												if( count( $currency ) > 0 )
												print $this->form->input( 'PostalServiceDesc.ccy_prices', array( 'type'=>'select', 'empty'=>'Choose Currency','options'=>$currency,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Size (THICKNESS)</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.size_thickness', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Max Weight</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.max_weight', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Tracked</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												$tracked	=	array('Yes' => 'Yes', 'No'=>'No', 'Invoice' => 'Invoice');
												if( count( $tracked ) > 0 )
												print $this->form->input( 'PostalServiceDesc.tracked', array( 'type'=>'select', 'empty'=>'Choose Tracked','options'=>$tracked,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Delivery Time</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												print $this->form->input( 'PostalServiceDesc.delivery_time', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">CN22 Required</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												$cn22	=	array('Yes' => 'Yes', 'No'=>'No');
												if( count( $cn22 ) > 0 )
												print $this->form->input( 'PostalServiceDesc.cn_required', array( 'type'=>'select', 'empty'=>'Choose CN22','options'=>$cn22,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?>
										</div>
									  </div>
									  
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Manifest Required</label>                                        
										<div class="col-lg-7">                                            
										   <?php
												$manifest	=	array('Yes' => 'Yes', 'No'=>'No');
												if( count( $manifest ) > 0 )
												print $this->form->input( 'PostalServiceDesc.manifest', array( 'type'=>'select', 'empty'=>'Choose Manifest','options'=>$manifest,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
									  
							  </div>
							 <div class="col-lg-4">
							  	 	 
							  	 	 <div class="form-group" >
										<label for="username" class="control-label col-lg-5">Custom Country</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													$customCountry	=	array('0' => 'UK', '1'=>'US', '2' => 'France', '3' => 'Germany');
													if( count( $customCountry ) > 0 )
													print $this->form->input( 'PostalServiceDesc.custom_country', array( 'type'=>'select', 'empty'=>'Choose Custom Country','options'=>$customCountry,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
							  	 	 
									 <div class="form-group" >
										<label for="username" class="control-label col-lg-5">LVCR</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													$lvcr	=	array('Yes' => 'Yes', 'No'=>'No');
													if( count( $lvcr ) > 0 )
													print $this->form->input( 'PostalServiceDesc.lvcr', array( 'type'=>'select', 'empty'=>'Choose LVCR','options'=>$lvcr,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
									
									<div class="form-group" >
										<label for="username" class="control-label col-lg-5">Max Product Amount</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.max_product_amount', array( 'type'=>'text', 'empty'=>'Choose LVCR','options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
										  </div>
										  <div class="form-group" >
										  <label for="username" class="control-label col-lg-5">Max Shipping Amount</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.max_shipping_amount', array( 'type'=>'text', 'empty'=>'Choose LVCR','options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
									
									<div class="form-group" >
										<!--<label for="username" class="control-label col-lg-5">Min Length</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.min_length', array( 'type'=>'text', 'empty'=>'Choose LVCR','options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>-->
										  <label for="username" class="control-label col-lg-5">Max Length</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.max_length', array( 'type'=>'text', 'empty'=>'Choose LVCR','options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
									
									<div class="form-group" >
										<!--<label for="username" class="control-label col-lg-5">Min Width</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.min_width', array( 'type'=>'text', 'options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>-->
										  <label for="username" class="control-label col-lg-5">Max Width</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.max_width', array( 'type'=>'text', 'options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
									
									<div class="form-group" >
										<!--<label for="username" class="control-label col-lg-5">Min Height</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.min_height', array( 'type'=>'text', 'options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>-->
										  <label for="username" class="control-label col-lg-5">Max Height</label>                                        
										  <div class="col-lg-7">                                            
											   <?php
													print $this->form->input( 'PostalServiceDesc.max_height', array( 'type'=>'text', 'options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											   ?> 
										  </div>
									</div>
						   </div>
						</div>
						
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                            	<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/JijGroup/showallmatrix">Go Back</a>
							   	<?php
									echo $this->Form->button('Edit Delevery Matrix', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'add_attribute btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										));	
								?>
						</div>
					</div>
				</div>	
			</form>
	    </div>
	</div>        
</div>

<script>
$( 'body' ).on( 'change', '#PostalServiceDescLvcr', function()
{    
    var id = $(this).val();
    var minProductAmount	=	$('#PostalServiceDescMaxProductAmount').val();
    var minShippingAmount	=	$('#PostalServiceDescMaxShippingAmount').val();
    if(id == 'Yes')
    {
		$('#PostalServiceDescMaxProductAmount').prop('readonly', false);
		$('#PostalServiceDescMaxShippingAmount').prop('readonly', false);
	}
	else
	{
		$('#PostalServiceDescMaxProductAmount').val('');
		$('#PostalServiceDescMaxShippingAmount').val('');
		$('#PostalServiceDescMaxProductAmount').prop('readonly', true);
		$('#PostalServiceDescMaxShippingAmount').prop('readonly', true);
	}
});

</script>
	

