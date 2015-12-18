	<!-- BEGIN CORE PLUGINS -->
        <?php print $this->html->script(array('plugins/jquery-1.11.1.min','plugins/bootstrap/js/bootstrap.min','plugins/bootstrap/js/holder','plugins/pace/pace.min','plugins/slimScroll/jquery.slimscroll.min','core')); ?>
	<!-- END CORE PLUGINS -->
<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $title;?></h1>
		
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
								$img = $this->request->data['User']['user_image'] ? $this->request->data['User']['user_image'] : $this->request->data['User']['user_image'] = "demo.png"	
                            ?>
                            <?php
                                print $this->form->create( 'User', array( 'class'=>'form-horizontal', 'type'=>'post','url'=>'/register','id'=>'saveuser','enctype'=>'multipart/form-data' ));
                                print $this->form->input( 'User.id', array( 'type'=>'hidden') );
                            ?>
                            <?php //echo "<pre>"; print_r($this->request->data); ?>
                                <div class="panel-body padding-bottom-40">
                                      
                                      <div class="form-group" style="text-align: center; margin-top: -73px;">
                                            <?php
													print $this->Html->image('upload/'.$img, array('style'=>'border-radius: 52px; height: 100px; width: 100px;','title' => ucfirst($this->request->data['User']['first_name'])));
                                            ?>
                                      </div>
                                      
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
													print $this->form->input( 'User.country', array( 'type'=>'select', 'empty'=>'Choose county','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
											?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">State</label>                                        
                                        <div class="col-lg-7">                           
												<?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'User.state', array( 'type'=>'select', 'empty'=>'Choose state','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
												?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">City</label>                                        
                                        <div class="col-lg-7">  
												<?php
                                                if( count( $getCityList ) > 0 )
                                                    print $this->form->input( 'User.city', array( 'type'=>'select', 'empty'=>'Choose city','options'=>$getCityList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
												?> 
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
												<label for="email" class="control-label col-lg-3">Phone:</label>
												<div class="col-lg-7">
													 <?php
														print $this->form->input( 'User.phone_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ,'data-inputmask' =>"'mask': '(0999) 999-9999'") );
														?>
													<p class="help-block">(999) 999-9999</p>
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
                                                print $this->form->input( 'User.user_image', array( 'type'=>'file','value' => '','div'=>false,'label'=>false,'class'=>'', 'required'=>false ) );
                                            ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
											</div>										
                                            <?php
                                                //print $this->form->input( 'User.user_image', array( 'type'=>'file','value' => '','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
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
											echo $this->Form->button('Edit User', array(
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
?>
<script>
$( document ).ready(function() {
$('#ModalForm').css('display','block');
$('#ModalForm').css('padding-right','13px');
$('#ModalForm').addClass('in');
$('#ModalForm').attr('aria-hidden',false);
//$('.modal-backdrop'),addClass('in');
$('.modal-backdrop .in').css('background', 'none repeat scroll 0 0 rgba(53, 58, 61, 0.698)');
$('.modal-backdrop .in').css('opacity', '1');
    
});

</script>	
<?php } ?>

<script>
	function close_popup()
	{
		$('#ModalForm').css('display','none');
		window.location="showList";
	}
</script>


						
                            
