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
                                print $this->form->create( 'User', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'saveuser','enctype'=>'multipart/form-data' ));
                                 print $this->form->input( 'User.id', array( 'type'=>'hidden') );
                            ?>
                                <div class="panel-body padding-bottom-40 padding-top-40">
                                      
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Role</label>
											<div class="col-sm-7">                                               
												<?php
													if( count( $getRoleList ) > 0 )
													print $this->form->input( 'User.role_type', array( 'type'=>'select', 'empty'=>'Choose role','options'=>$getRoleList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false ) );
												?>  
											</div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">First Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.first_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Last Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.last_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Username</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.username', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Password</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.password', array( 'type'=>'password','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Choose Country</label>                                        
                                        <div class="col-lg-7">                                                                                         
											<?php
												if( count( $getLocationArray ) > 0 )
													print $this->form->input( 'User.country', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">State</label>                                        
                                        <div class="col-lg-7">                           
												<?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'User.state', array( 'type'=>'select', 'empty'=>'Choose State','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
												?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">City</label>                                        
                                        <div class="col-lg-7">  
												<?php
                                                if( count( $getCityList ) > 0 )
                                                    print $this->form->input( 'User.cit', array( 'type'=>'select', 'empty'=>'Choose City','options'=>$getCityList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
												?> 
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
												<label for="email" class="control-label col-lg-3">Phone:</label>
												<div class="col-lg-7">
													 <?php
														print $this->form->input( 'User.phone_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(999) 999-9999'") );
														?>
													<small class="help-block">(999) 999-9999</small>
												</div>
											</div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Office Phone</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
												print $this->form->input( 'User.office_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(999) 999-9999'") );
											?>
													
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Fax No.</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
												print $this->form->input( 'User.fax_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(999) 999-9999'") );
											?>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">User Image</label>                                        
                                        <div class="col-lg-7">  
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse… <?php
                                                print $this->form->input( 'User.user_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false ) );
                                            ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected"  readonly="" class="form-control">
											</div>
                                            <?php
                                                //print $this->form->input( 'User.user_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      
									  <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showList')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
									  <?php
											echo $this->Form->button('Add User', array(
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
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
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
