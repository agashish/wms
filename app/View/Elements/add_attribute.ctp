		 <div class="row">
					<?php
						print $this->form->create( 'Attribute', array( 'class'=>'form-horizontal', 'url' => '/addattribute', 'type'=>'post','id'=>'warehouse' ) );
						print $this->form->input( 'Attribute.id', array( 'type'=>'hidden' ) );
					?>
            <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Attribute</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Name </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											print $this->form->input( 'Attribute.attribute_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
										?>
                                        </div>
                                  </div>
                                  
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Type </label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
											$getType	=	Configure::read( 'attribute_type_key' );
											print $this->form->input( 'Attribute.attribute_type', array( 'type'=>'select', 'empty'=>'Choose Attribute Type','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
                                  
							</div>
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
									<?php
										echo $this->Form->button('Add Attribute', array(
											'type' => 'submit',
											'escape' => true,
											'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
											 ));	
									?>
						</div>
					</div>
				</div>
			</form>
	    </div>
