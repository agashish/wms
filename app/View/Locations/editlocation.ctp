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
                                print $this->form->create( 'Location', array( 'class'=>'form-horizontal', 'url' => '/manageCounty', 'type'=>'post','id'=>'location' ) );
                                
                                print $this->form->input( 'Location.id', array( 'type'=>'hidden' ) );
                            ?>
                                <div class="panel-body padding-bottom-40 padding-top-40">
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Location Name</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Location.county_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                            <label class="col-sm-3 control-label">Location Type</label>
                                            <div class="col-lg-7">                                               
                                                
                                                <?php
                                                    $statusArray = Configure::read( 'status_key' );
                                                    if( count( $statusArray ) > 0 )
                                                        print $this->form->input( 'Location.status', array( 'type'=>'select', 'empty'=>'Choose role','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                                ?>  
                                                
                                            </div>
                                        </div>
                                      
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showallLocation')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
                                      <?php
											echo $this->Form->button('Update Location', array(
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
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>        
</div>
