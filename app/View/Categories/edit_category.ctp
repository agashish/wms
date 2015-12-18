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
							<?php
                                print $this->form->create( 'Category', array( 'class'=>'form-horizontal', 'url' => '/manageCategory', 'type'=>'post','id'=>'warehouse', 'enctype'=>'multipart/form-data' ) );
                                print $this->form->input(  'Category.id', array( 'type'=>'hidden' ) );
								print $this->form->input(  'CategoryDesc.id', array( 'type'=>'hidden' ) );
                            ?>
            <div class="col-lg-6 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
									<div class="panel-head">Category Details</div>
									
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                              <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Name</label>                                        
                                    <div class="col-lg-8">                                            
                                       <?php
                                          print $this->form->input( 'Category.category_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                       ?> 
                                    </div>
                                  </div>                           
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Alias</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                          print $this->form->input( 'Category.category_alias', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false,'onFocus' =>'create_alias();' ) );
										?> 
                                    </div>
                                  </div>
						          
                                   <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Parent</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
												$getAllCategory	=	$this->Common->getCategoryList();
												print $this->form->input( 'Category.parent_id', array( 'type'=>'select', 'empty'=>'Choose Parent','options'=>$getAllCategory,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?>  
                                    </div>
                                  </div>
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Short Text</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                          print $this->form->input( 'CategoryDesc.category_short_text', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false,'style'=>'height:100px;' ) );
										?>  
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Long Text</label>                                        
                                     <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'CategoryDesc.category_long_text', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'style'=>'height:100px;' ) );
                                            ?>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Status</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
												$statusArray = Configure::read( 'status_key' );
												if( count( $statusArray ) > 0 )
												print $this->form->input( 'Category.status', array( 'type'=>'select', 'empty'=>'Choose Status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?>  
                                    </div>
                                  </div>
                                  
							</div>
						</div>
					</div>
            </div><!-- /.col -->
	    </div><!-- /.row -->
		<div class="col-lg-6 rackDetails">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head">Category</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body">
					
			       <div class="row">
                        <div class="col-lg-12">
								<div class="form-group">
								    <label for="username" class="control-label col-lg-3">
										<?php 
										if(isset($this->request->data['CategoryImage'][0]['category_image']))
										{
										$imageUrl	=	 Router::url('/', true).'app/webroot/img/category/'; ?>
										<img src="<?php echo $imageUrl.$this->request->data['CategoryImage'][0]['category_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
										<?php 
											print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][0]['category_image'], 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][0]['id'], 'name' => 'data[CatImage][id][]' ) ); 
										}
										else
										{
											print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[CatImage][id][]' ) ); 
										}
										?>
										
									</label>                                        
									
                                    <div class="col-lg-8">
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-primary btn-file">
												Browse… <?php
                                                print $this->form->input( 'CategoryImage.category_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[CategoryImage][category_image][]' , ) );
												?>
												</span>
											</span>
											<input type="text" placeholder="No file selected"  class="form-control">
												 <span class="input-group-addon no-padding-top no-padding-bottom">
												 <div class="radio radio-theme min-height-auto no-margin no-padding">
													 <?php 
															if(isset($this->request->data['CategoryImage'][0]['selected_image']) && $this->request->data['CategoryImage'][0]['selected_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
															$options=array('1'=>'');
															echo $this->Form->radio('',$options, array('name' => 'data[CategoryImage][selected_image][]','label' =>false, 'checked' => $checked)); 
													 ?>
												 </div>
												 </span>
											</div>			
									</div>
                                  </div>                           
								
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">
                                    <?php 
										if(isset($this->request->data['CategoryImage'][1]['category_image']))
										{
										$imageUrl	=	 Router::url('/', true).'app/webroot/img/category/'; ?>
										<img src="<?php echo $imageUrl.$this->request->data['CategoryImage'][1]['category_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
										<?php 
											print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][1]['category_image'], 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][1]['id'], 'name' => 'data[CatImage][id][]' ) ); 
										}
										else
										{
											print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[CatImage][id][]' ) ); 
										}
									?>
                                    </label>                                        
                                    <div class="col-lg-8">                                            
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-primary btn-file">
												Browse… <?php
                                                print $this->form->input( 'CatImage.category_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[CategoryImage][category_image][]' ) );
												?>
												</span>
											</span>
											<input type="text" placeholder="No file selected"  class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
													<?php 
														if(isset($this->request->data['CategoryImage'][1]['selected_image']) && $this->request->data['CategoryImage'][1]['selected_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[CategoryImage][selected_image][]','label' =>false, 'checked' => $checked)); 
													?>
													</div>
												</span>
											</div>	
									</div>
                                  </div>
						          
                                   <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">
                                    <?php 
										if(isset($this->request->data['CategoryImage'][2]['category_image']))
										{
										$imageUrl	=	 Router::url('/', true).'app/webroot/img/category/'; ?>
										<img src="<?php echo $imageUrl.$this->request->data['CategoryImage'][2]['category_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
										<?php 
											print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][2]['category_image'], 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][2]['id'], 'name' => 'data[CatImage][id][]' ) );  
										}
										else
										{
											print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[CatImage][id][]' ) ); 
										}
									?>
                                    
                                    </label>                                        
                                    <div class="col-lg-8">                                            
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-primary btn-file">
												Browse… <?php
                                                print $this->form->input( 'CategoryImage.category_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[CategoryImage][category_image][]') );
												?>
												</span>
										</span>
												<input type="text" placeholder="No file selected"  class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
												 <div class="radio radio-theme min-height-auto no-margin no-padding">
												<?php 
														if(isset($this->request->data['CategoryImage'][2]['selected_image']) && $this->request->data['CategoryImage'][2]['selected_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[CategoryImage][selected_image][]','label' =>false, 'checked' => $checked)); 
												?>
												</div>
												</span>
											</div>	
									</div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">
                                    <?php 
										if(isset($this->request->data['CategoryImage'][3]['category_image']))
										{
										$imageUrl	=	 Router::url('/', true).'app/webroot/img/category/'; ?>
										<img src="<?php echo $imageUrl.$this->request->data['CategoryImage'][3]['category_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
										<?php print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][3]['category_image'], 'name' => 'data[CategoryOldImage][image_name][]') ); 
										print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][3]['id'], 'name' => 'data[CatImage][id][]' ) ); 
										}
										else
										{
											print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[CategoryOldImage][image_name][]') ); 
										print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[CatImage][id][]' ) ); 
										}
										
									?>
                                    
                                    </label>                                        
                                    <div class="col-lg-8">                                            
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-primary btn-file">
												Browse… <?php
                                                print $this->form->input( 'CategoryImage.category_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[CategoryImage][category_image][]' ) );
												?>
												</span>
										</span>
												<input type="text" placeholder="No file selected"  class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
												 <div class="radio radio-theme min-height-auto no-margin no-padding">
												<?php 
														if(isset($this->request->data['CategoryImage'][3]['selected_image']) && $this->request->data['CategoryImage'][3]['selected_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[CategoryImage][selected_image][]','label' =>false, 'checked' => $checked)); 
														?>
														</div>
														</span>
											</div>
									</div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">
                                    <?php 
										if(isset($this->request->data['CategoryImage'][4]['category_image']))
										{
										$imageUrl	=	 Router::url('/', true).'app/webroot/img/category/'; ?>
										<img src="<?php echo $imageUrl.$this->request->data['CategoryImage'][4]['category_image'] ?>" style="width:35px; height:35px; border-radius:50px;" />
										<?php 
											print $this->form->input( 'image_name', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][4]['category_image'], 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden','value' => $this->request->data['CategoryImage'][4]['id'], 'name' => 'data[CatImage][id][]' ) ); 
										}
										else
										{
											print $this->form->input( 'image_name', array( 'type'=>'hidden', 'name' => 'data[CategoryOldImage][image_name][]') ); 
											print $this->form->input( 'CatImage.id', array( 'type'=>'hidden', 'name' => 'data[CatImage][id][]' ) ); 
										}
									?>
                                    </label>                                        
                                    <div class="col-lg-8">                                            
										<div class="input-group">
											<span class="input-group-btn">
												<span class="btn btn-primary btn-file">
												Browse… <?php
                                                print $this->form->input( 'CategoryImage.category_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[CategoryImage][category_image][]') );
												?>
												</span>
										</span>
												<input type="text" placeholder="No file selected"  readonly="" class="form-control">
												<span class="input-group-addon no-padding-top no-padding-bottom">
												 <div class="radio radio-theme min-height-auto no-margin no-padding">
												<?php 
														if(isset($this->request->data['CategoryImage'][4]['selected_image']) && $this->request->data['CategoryImage'][4]['selected_image'] == 1) { $checked =  "checked"; } else { $checked =  ""; }
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[CategoryImage][selected_image][]','label' =>false, 'checked' => $checked)); 
														?>
														</div>
														</span>
											</div>
									</div>
                                  </div>
								 
                                  
							</div>
						</div>
					</div>  
                  
				</div>
				
				<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
										<?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showAllCategory')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
                                     
									<?php
											echo $this->Form->button('Edit', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>' btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
									?>
				</div>
			</form>
    </div>        
</div>

<script>

	function create_alias()
	{
		var catName		=	$.trim($('#CategoryCategoryName').val().toLowerCase());
		var str = catName.replace(/ /g, '_');
		$('#CategoryCategoryAlias').val(str);
	}
</script>
