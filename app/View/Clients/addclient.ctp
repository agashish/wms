<!--<div class="rightside bg-grey-100">
   
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>		
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>		
    </div>
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">

                            
                            <?php							
                                print $this->form->create( 'Client', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/manage/client/new', 'type'=>'post','id'=>'client' ) );
                                
                                print $this->form->input( 'Client.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.client_id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientImage.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientWarehouse.id', array( 'type'=>'hidden' ) );
                            ?>
                            <div class="panel-body padding-bottom-40 padding-top-40">
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose Country</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'ClientDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>                           
                                
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose State</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'ClientDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose State','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								
								<div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Choose City	</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getCityList ) > 0 )
                                                    print $this->form->input( 'ClientDesc.city_id', array( 'type'=>'select', 'empty'=>'Choose City','options'=>$getCityList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
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
														print $this->form->input( 'ClientWarehouse.warehouse_id', array( 'type'=>'select', 'multiple' => 'multiple', 'empty'=>'Choose state','options'=>$getWarehouseList,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									  </div>
									  
									  <div class="form-group">
										<label for="username" class="control-label col-lg-3">Return Address</label>                                        
										<div class="col-lg-7">                                            
											<?php											
													if( count( $getWarehouseList ) > 0 )
														print $this->form->input( 'ClientWarehouse.return_address', array( 'type'=>'textarea', 'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
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
											echo $this->Form->button('Add Client', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
										?>
										
                                    </div>
                                </div>
                                
                            </form>

        </div>
		
    </div>        
</div>-->



<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                             <?php							
                                print $this->form->create( 'Client', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/manage/client/new', 'type'=>'post','id'=>'client' ) );
                                print $this->form->input( 'Client.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientDesc.client_id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientImage.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'ClientWarehouse.id', array( 'type'=>'hidden' ) );
                            ?>
						<div class="panel-body padding-bottom-40 padding-top-40">     
                            <div id="content">
									<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
										<li class="active"><a href="#red" data-toggle="tab">Client Information</br>&nbsp;</a></li>
										<li><a href="#orange" data-toggle="tab">Contact Persion : 1</br>&nbsp; </a></li>
										<li><a href="#yellow" data-toggle="tab">Contact Persion : 2 </br> <strong style="color:red;">Optional</strong></a></li>
										<li><a href="#green" data-toggle="tab">Contact Persion : 3 </br> <strong style="color:red;">Optional</strong></a></li>
									</ul>
								<div id="my-tab-content" class="tab-content">
									<div class="tab-pane active" id="red">
										 <?php
												print $this->form->input( 'Client.id', array( 'type'=>'hidden' ) );
										?>
                                <div class="panel-body padding-bottom-40">
                                    
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
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose Country</label>                                        
										<div class="col-lg-7">                                            
											<?php
													if( count( $getLocationArray ) > 0 )
														print $this->form->input( 'ClientDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									  </div> 
                                      
                                      <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose State</label>                                        
										<div class="col-lg-7">                                            
											<?php
													if( count( $getStateList ) > 0 )
														print $this->form->input( 'ClientDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose State','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									 </div>
                                      
                                     <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose City	</label>                                        
										<div class="col-lg-7">                                            
											<?php
													if( count( $getCityList ) > 0 )
														print $this->form->input( 'ClientDesc.city_id', array( 'type'=>'select', 'empty'=>'Choose City','options'=>$getCityList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									 </div>
                                      
									  <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose Warehouse</label>                                        
										<div class="col-lg-7">                                            
											<?php											
												if( count( $getWarehouseList ) > 0 )
												print $this->form->input( 'ClientWarehouse.warehouse_id', array( 'type'=>'select', 'multiple' => 'multiple', 'empty'=>'Choose Warehouse','options'=>$getWarehouseList,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									  </div>
									  
									  <div class="form-group">
										<label for="username" class="control-label col-lg-3">Address</label>                                        
										<div class="col-lg-7">                                            
											<?php											
												if( count( $getWarehouseList ) > 0 )
												print $this->form->input( 'ClientDesc.address', array( 'type'=>'textarea', 'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
										</div>
									  </div>
									  
									  <div class="form-group">
										<label for="username" class="control-label col-lg-3">Return Address</label>                                        
										<div class="col-lg-7">                                            
											<?php											
												if( count( $getWarehouseList ) > 0 )
												print $this->form->input( 'ClientDesc.return_address', array( 'type'=>'textarea', 'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
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
                                      
									</div>
								</div>
								
								
<!------------------------------  Start Client Contact One --------------------------------------------->
								<div class="tab-pane" id="orange">
								  <div class="panel-body padding-bottom-40">
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Person  Name</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										print $this->form->input( 'ClientContact.0.id', array( 'type'=>'hidden' ) );
										print $this->form->input( 'ClientContact.1.client_id', array( 'type'=>'hidden') );
										  
										print $this->form->input( 'ClientContact.0.person_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false , 'name' => 'data[ClientContact][0][person_name]') );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Phone</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.0.person_phone', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][0][person_phone]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Email</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.0.person_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][0][person_email]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Department</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.0.person_department', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][0][person_department]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Designation</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.0.person_designation', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][0][person_designation]' ) );
										  ?>
									  </div>
									</div>
									
								  </div>
								</div>
<!-----------------------------  End Client Option Contact One ----------------------------------------------->

									
<!-----------------------------  Start Client Option Contact two ------------------------------------------->
								<div class="tab-pane" id="yellow">
								  <div class="panel-body padding-bottom-40">
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Person  Name</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										 print $this->form->input( 'ClientContact.1.id', array( 'type'=>'hidden' ) );
										 print $this->form->input( 'ClientContact.1.client_id', array( 'type'=>'hidden') );
										  print $this->form->input( 'ClientContact.1.person_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false , 'name' => 'data[ClientContact][1][person_name]') );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Phone</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.1.person_phone', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][1][person_phone]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Email</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.1.person_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][1][person_email]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Department</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.1.person_department', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][1][person_department]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Designation</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.1.person_designation', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][1][person_designation]' ) );
										  ?>
									  </div>
									</div>
									
								  </div>
								</div>
<!----------------------------------  End Client Option Contact two ------------------------------------------>


<!-----------------------------  Start Client Option Contact three ------------------------------------------->
								<div class="tab-pane" id="green">
								  <div class="panel-body padding-bottom-40">
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Person  Name</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										print $this->form->input( 'ClientContact.2.id', array( 'type'=>'hidden' ) );
										 print $this->form->input( 'ClientContact.2.client_id', array( 'type'=>'hidden') );
										  print $this->form->input( 'ClientContact.2.person_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false , 'name' => 'data[ClientContact][2][person_name]') );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Phone</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.2.person_phone', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][2][person_phone]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Email</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.2.person_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][2][person_email]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Department</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.2.person_department', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][2][person_department]' ) );
										  ?>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="username" class="control-label col-lg-3">Designation</label>                                        
									  <div class="col-lg-7">                                            
										<?php
										  print $this->form->input( 'ClientContact.2.person_designation', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[ClientContact][2][person_designation]' ) );
										  ?>
									  </div>
									</div>
									
								  </div>
								</div>
<!----------------------------------  End Client Option Contact three ------------------------------------------>

                               	</div>
									<div>
										<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
										  <?php
												echo $this->Form->button('Add Client', array(
													'type' => 'submit',
													'escape' => true,
													'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
													 ));	
											?>
										</div>
									</div>
								</div>
							</div>		
						</div>
					</div>
                  </div>
                </div>
            </div>
        </div>
    </div>        
</div>

<!--
<?php
if(!empty($popupArray))
{	
	//$objectComponent = $this->Common->getcomponent( "UploadComponent" );	
	//echo $objectComponent->Openpopup($popupArray);		
} 
?>
<script>
	function close_popup(url)
	{
		$('#ModalForm').css('display','none');
		window.location=url;
	}
</script>
-->


<?php
if(!empty($popupArray))
{	
	$objectComponent = $this->Common->getcomponent( "UploadComponent" );	
	echo $objectComponent->Openpopup($popupArray);		
} 
?>


<script type="text/javascript">
jQuery(document).ready(function ($) {
$('#tabs').tab();
});

function close_popup(url)
	{
		$('#ModalForm').css('display','none');
		window.location=url;
	}
</script>
</div> 


