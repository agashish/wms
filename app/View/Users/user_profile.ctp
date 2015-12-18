<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $title;?></h1>
			<?php print $this->Session->flash();  ?>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <?php 
                            	$img = $this->request->data['User']['user_image'] ? $this->request->data['User']['user_image'] : $this->request->data['User']['user_image'] = "demo.png"	
                            ?>
                            <?php
                                print $this->form->create( 'User', array( 'class'=>'form-horizontal', 'type'=>'post','url'=>'/register','id'=>'saveuser','enctype'=>'multipart/form-data' ));
                                print $this->form->input( 'User.id', array( 'type'=>'hidden') );
                                print $this->form->input( 'User.profile', array( 'type'=>'hidden', 'value' => '1') );
                            ?>
                                <div class="panel-body padding-bottom-40">
									  <div class="form-group" style="text-align: center; margin-top: -73px;">
											<?php
												print $this->Html->image('upload/'.$img, array('style'=>'border-radius: 52px; height: 100px; width: 100px;'));
											?>
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
                                        <label for="username" class="control-label col-lg-3">Email</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.email', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
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
                                        <label for="username" class="control-label col-lg-3">Confirm Password</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'User.confirm_password', array( 'type'=>'password','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
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
																	print $this->form->input( 'User.user_image', array( 'type'=>'file','value' => '','div'=>false,'label'=>false,'class'=>'', 'required'=>false ) );
																?>
													</span>
												</span>
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
											</div>	
									    </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3"></label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
											    if($this->request->data['User']['user_image'] == 'demo.png')
                                                {
													print "";
													
												}
												else
												{
													print $this->request->data['User']['user_image'];
													
												}
												print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['User']['user_image']) );
												
                                            ?>
                                        </div>
                                      </div>
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                    	<a class="update_profile btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="submit">Edit Profile</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>

<script>
$( 'body' ).on( 'click', '.update_profile', function()
	{    
		   /* check password and confirm password is same and then submit */
		   var password	=	$('#UserPassword').val();
		   var confirmPassword	=	$('#UserConfirmPassword').val();
		   if( password == '' && confirmPassword == '' )
		   {
			   $('#saveuser').submit();   
		   }
		   else
		   {
			   if( password == confirmPassword )
			   {
				   $('#saveuser').submit();
			   }
			   else
			   {
				   alert('Confirm password and password will be same');
			   }
		   }
	});
</script>

						
                            
