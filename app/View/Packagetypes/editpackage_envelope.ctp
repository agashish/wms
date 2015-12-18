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
                                print $this->form->create( 'PackageEnvelope', array( 'class'=>'form-horizontal', 'type'=>'post','url'=>'addEnvelope' , 'id'=>'PackageEnvelope' ) );
                                print $this->form->input( 'PackageEnvelope.id', array( 'type'=>'hidden' ) );
                            ?>
                                <div class="panel-body padding-bottom-40 padding-top-40">
									
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">PackageType</label>                                        
                                        <div class="col-lg-7">                                            
                                        <?php                                        
                                             if( count( $packageList ) > 0 )
                                             print $this->form->input( 'PackageEnvelope.packagetype_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$packageList,'class'=>'form-control location selectpicker', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                        </div>
                                      </div>	
									
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Package Type</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'PackageEnvelope.envelope_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Cost</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'PackageEnvelope.envelop_cost', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'packagetypes', 'action' => 'showAllEnvelope')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
                                      <?php
											echo $this->Form->button('Edit Package Type', array(
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
