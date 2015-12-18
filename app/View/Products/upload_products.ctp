<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title">Upload Products</h1>		
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>		
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="panel-body check_image_extension padding-bottom-40 padding-top-40">
                                	   <?php							
											print $this->form->create( 'Product', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/Products/uploads_csv', 'type'=>'post','id'=>'brand' ) );
										?>
										<div class="form-group">
											<label for="username" class="control-label col-lg-3">CSV File</label>                                        
											<div class="col-lg-7">
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-primary btn-file">
															Browse…  <?php
																		print $this->form->input( 'Product.Import_file', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false) );
																	  ?>
														</span>
													</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php
														echo $this->Form->button('Upload', array(
														'type' => 'submit',
														'escape' => true,
														'class'=>'add_brand btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
														 ));	
													?>
													</div>
													</span>
											</div>
											
                                        </div>
                                      </div>
								      </form>
								      
									  <?php							
											print $this->form->create( 'Product', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/Products/DownloadSample', 'type'=>'post','id'=>'brand' ) );
										?>
									  <!--<div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Attribute Set</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                if( count( $attributesets ) > 0 )
                                                print $this->form->input( 'Product.Attribute_set_id', array( 'type'=>'select', 'empty'=>'Choose Attribute Set','options'=>$attributesets,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                            ?>  
                                        </div>
                                      </div>-->
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Type</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
												$importtype	=	array('0' => 'Inventory', '1' => 'Category Map', '2' => 'Assign Product To Location', '3' => 'Import Stock Level And Minimium Stock', '4' => 'Price Import Based On Warehouse');
                                                if( count( $importtype ) > 0 )
                                                print $this->form->input( 'Product.Import_type', array( 'type'=>'select', 'empty'=>'Choose Attribute Set','options'=>$importtype,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                            ?>  
                                        </div>
                                      </div>
								    
								    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                    
                                    <button class="switch btn btn-success" data-toggle="modal" data-target=""><i class=""></i> Download Sample </button>
                                      <!--<?php
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
										?>-->
									</div>
                                </div>
                               </form>
						</div>
					</div>        
				</div>
