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
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">

                            <?php                              
								$img = isset($this->request->data['ClientImage']['client_image']) ? $this->request->data['ClientImage']['client_image'] : $this->request->data['ClientImage']['client_image'] = "demo.png"	
                            ?>
                            <?php							
                                print $this->form->create( 'Client', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/manage/client/new', 'type'=>'post','id'=>'client' ) );
                                
                                print $this->form->input( 'Client.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.client_id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientImage.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientImage.imgExist', array( 'type'=>'hidden', 'value' => $this->request->data['ClientImage']['client_image'] ) );
								print $this->form->input( 'ClientWarehouse.id', array( 'type'=>'hidden' ) );
                            ?>
                            <div class="panel-body padding-bottom-40">
								<div class="form-group" style="text-align: center; margin-top: -57px;">
										<?php
												print $this->Html->image('client/'.$img, array('style'=>'border-radius: 52px; height: 100px; width: 100px;','title' => ucfirst($this->request->data['Client']['client_name'])));
										?>
								  </div>
							
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose Country</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'ClientDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose county','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>                           
                                
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose State</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'ClientDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose state','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose City</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getCityList ) > 0 )
                                                    print $this->form->input( 'ClientDesc.city_id', array( 'type'=>'select', 'empty'=>'Choose state','options'=>$getCityList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Client Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Client.client_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Client Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'ClientDesc.client_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Client Phone</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'ClientDesc.client_mobile', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Client Image</label>                                        
                                        <div class="col-lg-7">  
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
                                                print $this->form->input( 'ClientImage.client_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false ) );
                                            ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected"  readonly="" class="form-control">
											</div>										
                                            <?php
                                                //print $this->form->input( 'ClientImage.client_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
									  <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose Warehouse</label>                                        
										<div class="col-lg-7">                                            
											<?php											
													if( count( $getWarehouseList ) > 0 )
													{
														$warehouseIdArray = explode(",",$this->request->data['ClientWarehouse']['warehouse_id']);														
														print $this->form->input( 'ClientWarehouse.warehouse_id', array( 'type'=>'select', 'multiple' => 'multiple', 'empty'=>'Choose state','options'=>$getWarehouseList,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false, 'selected' => $warehouseIdArray) );
													}
											?>  
										</div>
									  </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Status</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                    $statusArray = Configure::read( 'status_key' );
                                                    if( count( $statusArray ) > 0 )
                                                        print $this->form->input( 'Client.status', array( 'type'=>'select', 'empty'=>'Choose status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                            ?>  
                                        </div>
                                      </div>
									  
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                     
									 <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showall/Client/List')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
										
									  <?php
											echo $this->Form->button('Update Client', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
										?>
										
                                    </div>
                                </div>
                            </form>
                       
        </div><!-- /.row -->		
		<!-- Start here listing of countries whose would be active or deactive -->
    </div>        
</div>
<?php
if(!empty($popupArray))
{	
	$objectComponent = $this->Common->getcomponent( "UploadComponent" );	
	echo $objectComponent->Openpopup($popupArray);		
} 
?>
<script>
	function close_popup(url)
	{
		$('#ModalForm').css('display','none');
		window.location=url;
	}
</script>