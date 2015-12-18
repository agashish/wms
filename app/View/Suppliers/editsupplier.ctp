<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $title;?></h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">

                            <?php
                                print $this->form->create( 'Supplier', array( 'class'=>'form-horizontal', 'type'=>'post','id'=>'savesupplier','enctype'=>'multipart/form-data' ));
                            ?>
                                <!--<div class="panel-body padding-bottom-40">
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">First Name</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'Supplier.supplier_first_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">Last Name</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'Supplier.supplier_last_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">Email</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'SupplierDesc.email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">Optional Email</label>                                        
                                        <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'SupplierDesc.optional_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">Choose Country</label>                                        
                                        <div class="col-lg-8">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'SupplierDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control location', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
										<label for="username" class="control-label col-lg-2">Choose State</label>                                        
											<div class="col-lg-8">                                            
											<?php
													if( count( $getStateList ) > 0 )
														print $this->form->input( 'SupplierDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose State','class'=>'form-control state', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
											</div>
									</div>
                                      
                                     
										<div class="form-group">
											<label for="username" class="control-label col-lg-2">Choose city</label>                                        
												<div class="col-lg-8">                                            
													<?php
														if( count( $getCityList ) > 0 )
															print $this->form->input( 'SupplierDesc.city_id', array( 'type'=>'select', 'empty'=>'Choose City','class'=>'form-control city', 'div'=>false, 'label'=>false, 'required'=>false) );
													?>  
												</div>
									  </div>
                                      <div class="form-group">
												<label for="email" class="control-label col-lg-2">Phone:</label>
												<div class="col-lg-8">
													 <?php
														print $this->form->input( 'SupplierDesc.phone_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(999) 999-9999'") );
														?>
													<p class="help-block">(999) 999-9999</p>
												</div>
											</div>-->
									<!--<div class="form-group">
												<label for="username" class="control-label col-lg-2">Suppliers Image :</label>                                        
													<div class="col-lg-8">                                            
													<?php
														//print $this->form->input( 'SupplierImage.supplier_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ));
													?>
													</div>
											</div>-->
											
											<!--Start for contact One-->
                                      <!--<FIELDSET style="border: 1px solid #f0f0f0;" id="contact_fieldset1">
										<legend style="margin-bottom: 0px; width: 0px; margin-left: 17px; padding-left: 3px; padding-right: 84px; border-bottom: medium none;">Contact:1</legend>
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Label</label>                                        
													<div class="col-lg-8">                                            
													<?php
														print $this->form->input( '', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false , 'name'=>'data[SupplierContact][][supplier_label]'));
													?>
													</div>
											</div>
								      </FIELDSET>-->
                                      <!--End for contact One-->
                                      
                                      <!--Start for contact two-->
                                      
                                      <!--<FIELDSET style="border: 1px solid #f0f0f0; display:none;" id="contact_fieldset2" >
										<legend style="margin-bottom: 0px; width: 0px; margin-left: 17px; padding-left: 3px; padding-right: 84px; border-bottom: medium none;">Contact:2</legend>
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Label</label>                                        
													<div class="col-lg-8">                                            
													<?php
														print $this->form->input( '', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false,'name'=>'data[SupplierContact][][supplier_label]' ));
													?>
													</div>
											</div>
								      </FIELDSET>-->
                                      
                                       <!--end for contact two-->
                                     
								      
                                  <!--    
                                    <button class="btn btn-success" type="button" style="float:right;" onclick="add_contact()" >Add Contact</button>
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      <?php
											echo $this->Form->button('Add Supplier', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
										?>
                                    </div>
                                </div>
                            </form>
                            
                           
                           -->
                           
                           
                        <div class="panel-body padding-bottom-40 padding-top-40">    
                           
                            <div id="content">
									<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
										<li class="active"><a href="#red" data-toggle="tab">Supplier Information</br>&nbsp;</a></li>
										<li><a href="#orange" data-toggle="tab">Supplier Contact : 1</br>&nbsp; </a></li>
										<li><a href="#yellow" data-toggle="tab">Supplier Contact : 2 </br> <strong style="color:red;">Optional</strong></a></li>
										<li><a href="#green" data-toggle="tab">Supplier Contact : 3 </br> <strong style="color:red;">Optional</strong></a></li>
									</ul>
								<div id="my-tab-content" class="tab-content">
									<div class="tab-pane active" id="red">
										 <?php
                                print $this->form->create( 'Supplier', array( 'class'=>'form-horizontal', 'type'=>'post','id'=>'savesupplier','enctype'=>'multipart/form-data' ));
                                
                            ?>
                                <div class="panel-body padding-bottom-40">
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">First Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Supplier.id', array( 'type'=>'hidden','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                                print $this->form->input( 'Supplier.supplier_first_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Last Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Supplier.supplier_last_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'SupplierDesc.email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                                print $this->form->input( 'SupplierDesc.supplier_id', array( 'type'=>'hidden') );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Optional Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'SupplierDesc.optional_email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Choose Country</label>                                        
                                        <div class="col-lg-7">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'SupplierDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control location selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
										<label for="username" class="control-label col-lg-3">Choose State</label>                                        
											<div class="col-lg-7">                                            
											<?php
													if( count( $getStateList ) > 0 )
														print $this->form->input( 'SupplierDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose State','class'=>'form-control state selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>  
											</div>
									</div>
                                      
                                     
										<div class="form-group">
											<label for="username" class="control-label col-lg-3">Choose city</label>                                        
												<div class="col-lg-7">                                            
													<?php
														if( count( $getCityList ) > 0 )
															print $this->form->input( 'SupplierDesc.city_id', array( 'type'=>'select', 'empty'=>'Choose City','class'=>'form-control city selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
													?>  
												</div>
									  </div>
                                      <div class="form-group">
												<label for="email" class="control-label col-lg-3">Phone:</label>
												<div class="col-lg-7">
													 <?php
														print $this->form->input( 'SupplierDesc.phone_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(999) 999-9999'") );
														?>
													<p class="help-block">(999) 999-9999</p>
												</div>
											</div>
									<!--<div class="form-group">
												<label for="username" class="control-label col-lg-2">Suppliers Image :</label>                                        
													<div class="col-lg-8">                                            
													<?php
														//print $this->form->input( 'SupplierImage.supplier_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ));
													?>
													</div>
											</div>-->
								    
                                </div>
                            
										</div>
										<!--  Start Supplier Option Contact One -->
									<div class="tab-pane" id="orange">
							
                                <div class="panel-body padding-bottom-40">
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">label</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( ' ', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false , 'name' => 'data[SupplierContact][supplier_label][]') );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( '', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[SupplierContact][supplier_email][]' ) );
                                            ?>
                                        </div>
                                      </div>
                                </div>
                            
									</div>
									<!--  End Supplier Option Contact One -->
									
									<!--  Start Supplier Option Contact two -->
									
									<div class="tab-pane" id="yellow">
							
                                <div class="panel-body padding-bottom-40">
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">label</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( '', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name' => 'data[SupplierContact][supplier_label][]' ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( '', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name'=>'data[SupplierContact][supplier_email][]' ) );
                                            ?>
                                        </div>
                                      </div>
                                </div>
                            
									</div>
									<!--  End Supplier Option Contact two -->
									<div class="tab-pane" id="green">
										<h1>Supplier Contact : 3</h1>
										<p>Supplier Contact : 3</p>
									</div>
									<div>
											<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      <?php
											echo $this->Form->button('Add Supplier', array(
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
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>        
</div>





<script type="text/javascript">
jQuery(document).ready(function ($) {
$('#tabs').tab();
});
</script>
</div> 


