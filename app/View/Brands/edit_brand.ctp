<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>		
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>		
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">

                            
                            <?php							
                                print $this->form->create( 'Brand', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/manageBrand', 'type'=>'post','id'=>'brand' ) );
                                
                                print $this->form->input( 'Brand.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'BrandDesc.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'BrandDesc.Brand_id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'BrandImage.id', array( 'type'=>'hidden' ) );
                            ?>
                            <?php //pr($this->request->data); ?>
                            <div class="panel-body padding-bottom-40 padding-top-40">
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Brand Name</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php
                                                print $this->form->input( 'Brand.brand_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>  
                                    </div>
                                  </div>

								  <div class="form-group">
									 <label for="username" class="control-label col-lg-3">Brand Alias</label>                                        
                                     <div class="col-lg-7">                                            
                                        <?php
                                                print $this->form->input( 'Brand.brand_alias', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>  
									 </div>
                                  </div>
                                
                                  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">
                                        
                                        <?php
														if(isset($this->request->data['BrandImage'][0]['brand_image']))
															{
															$imageUrl	=	 Router::url('/', true).'app/webroot/img/brand/'; ?>
															<img src="<?php echo $imageUrl.$this->request->data['BrandImage'][0]['brand_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
															<?php print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][0]['brand_image'], 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][0]['id'], 'name' => 'data[BImage][id][]' ) ); 
															}
															else
															{
																print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[BImage][id][]' ) ); 
															}
														?>
                                        
                                        </label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-primary btn-file">
														Browse…  <?php
																	print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false,'name' => 'data[BrandImage][brand_image][]' ) );
																?>
													</span>
												</span>
												
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														if(isset($this->request->data['BrandImage'][1]['select_image']) && $this->request->data['BrandImage'][0]['select_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false, 'checked' => $checked)); 
														?>
													</div>
												</span>
											</div>
											
                                        </div>
                                      </div>
                                      
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">
														<?php
															if(isset($this->request->data['BrandImage'][1]['brand_image']))
															{
															$imageUrl	=	 Router::url('/', true).'app/webroot/img/brand/'; ?>
															<img src="<?php echo $imageUrl.$this->request->data['BrandImage'][1]['brand_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
															<?php print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][1]['brand_image'], 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][1]['id'], 'name' => 'data[BImage][id][]' ) ); 
															}
															else
															{
																print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden', 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden', 'name' => 'data[BImage][id][]' ) ); 
															}
														?>
                                        </label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-primary btn-file">
														Browse…  <?php
																	print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false,'name' => 'data[BrandImage][brand_image][]' ) );
																 ?>
													</span>
												</span>
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														if(isset($this->request->data['BrandImage'][1]['select_image']) && $this->request->data['BrandImage'][1]['select_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false, 'checked' => $checked )); 
														?>
													</div>
												</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">
													<?php
														if(isset($this->request->data['BrandImage'][2]['brand_image']))
															{
															$imageUrl	=	 Router::url('/', true).'app/webroot/img/brand/'; ?>
															<img src="<?php echo $imageUrl.$this->request->data['BrandImage'][2]['brand_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
															<?php print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][2]['brand_image'], 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][2]['id'], 'name' => 'data[BImage][id][]' ) ); 
															}
															else
															{
																print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden', 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden', 'name' => 'data[BImage][id][]' ) ); 
															}
														?>
                                        
                                        </label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-primary btn-file">
														Browse… <?php
																	print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[BrandImage][brand_image][]' ) );
																	?>
													</span>
												</span>
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														if(isset($this->request->data['BrandImage'][2]['select_image']) && $this->request->data['BrandImage'][2]['select_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false, 'checked' => $checked )); 
														?>
													</div>
												</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">
                                        
                                         <?php
														if(isset($this->request->data['BrandImage'][3]['brand_image']))
															{
															$imageUrl	=	 Router::url('/', true).'app/webroot/img/brand/'; ?>
															<img src="<?php echo $imageUrl.$this->request->data['BrandImage'][3]['brand_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
															<?php print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][3]['brand_image'], 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][3]['id'], 'name' => 'data[BImage][id][]' ) ); 
															}
															else
															{
																print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden', 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden', 'name' => 'data[BImage][id][]' ) ); 
															}
														?>
                                        </label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-primary btn-file">
														Browse…  <?php
																	print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[BrandImage][brand_image][]' ) );
																  ?>
													</span>
												</span>
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														if(isset($this->request->data['BrandImage'][3]['select_image']) && $this->request->data['BrandImage'][3]['select_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false, 'checked' => $checked)); 
														?>
													</div>
												</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">
                                         <?php
														if(isset($this->request->data['BrandImage'][4]['brand_image']))
															{
															$imageUrl	=	 Router::url('/', true).'app/webroot/img/brand/'; ?>
															<img src="<?php echo $imageUrl.$this->request->data['BrandImage'][4]['brand_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
															<?php print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][4]['brand_image'], 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden','value' => $this->request->data['BrandImage'][4]['id'], 'name' => 'data[BImage][id][]' ) ); 
															}
															else
															{
																print $this->form->input( 'BrandOldImage.image_name', array( 'type'=>'hidden', 'name' => 'data[BrandOldImage][image_name][]') ); 
																print $this->form->input( 'BImage.id', array( 'type'=>'hidden', 'name' => 'data[BImage][id][]' ) ); 
															}
														?>
                                        
                                        </label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-primary btn-file">
														Browse…  <?php
																	print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[BrandImage][brand_image][]' ) );
																  ?>
													</span>
												</span>
												<input type="text" placeholder="No file selected" readonly="" class="form-control">
												
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														if(isset($this->request->data['BrandImage'][4]['select_image']) && $this->request->data['BrandImage'][4]['select_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false, 'checked' => $checked)); 
														?>
													</div>
												</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Brand Description</label>                                        
                                    <div class="col-lg-7">                                            
                                        <?php												
												print $this->form->input( 'BrandDesc.brand_desc', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>  
											
                                    </div>
                                  </div>
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Status</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                    $statusArray = Configure::read( 'status_key' );
                                                    if( count( $statusArray ) > 0 )
                                                        print $this->form->input( 'Brand.status', array( 'type'=>'select', 'empty'=>'Choose status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                            ?>  
                                        </div>
                                      </div>
									  
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showAllBrand')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
									  <?php
											echo $this->Form->button('Edit Brand', array(
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
	

