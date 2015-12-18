<div class="rightside bg-grey-100">
   <!-- BEGIN PAGE HEADING -->
   <div class="page-head bg-grey-100">
      <h1 class="page-title"><?php print $title;?></h1>
      <div class="submenu">
		<div class="navbar-header">
				<ul class="nav navbar-nav pull-left">
					<li>
						<a class="switch btn btn-success" href="/wms/JijGroup/UploadProducts" data-toggle="modal" data-target=""><i class=""></i> Upload Products </a>
					</li>
				</ul>
			</div>
		</div>
   </div>
   <!-- END PAGE HEADING -->
   <div class="container-fluid">
      <div class="panel padding-top-40">
         <div class="row">
            <div class="col-lg-12 ">
               <div class="col-lg-9">
                  <!-- Tab panes -->
							<?php							
                              print $this->form->create( 'Product', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/products/addproduct', 'type'=>'post','id'=>'brand' ) );
                              print $this->form->input( 'Product.attributeset_id', array( 'type' => 'hidden', 'value' => $attributeid) );
                            ?>
                  <div class="tab-content">
                     <div class="tab-pane active" id="general">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">General</div>
                           </div>
                           
                           <div class="panel-body ">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Name</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'Product.product_name', array( 'type'=>'text','div'=>false, 'multiple' => true, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                          ?>  
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">SKU</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'Product.product_sku', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Brands</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
												$brandName	=	$this->Common->getBrandName();
												if( count( $brandName ) > 0 )
                                                 print $this->form->input( 'ProductDesc.brand', array( 'type'=>'select', 'empty'=>'Choose Brand','options'=>$brandName,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                             ?>  
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Barcode</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductDesc.barcode', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                           ?> 
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Short Description	</label>                                        
                                       <div class="col-lg-10">
                                          <?php
                                             print $this->form->input( 'ProductDesc.short_description', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control bs-texteditor', 'required'=>false ) );
                                          ?>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Long Description	</label>                                        
                                       <div class="col-lg-10">
                                          <?php
                                             print $this->form->input( 'ProductDesc.long_description', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control bs-texteditor', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>
                                    
                                    <!--<div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Bin</label>                                        
                                       <div class="col-lg-10">
                                          <?php
                                             print $this->form->input( 'ProductDesc.bin', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control bs-texteditor', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>-->
                                    
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Weight (kg.)</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductDesc.weight', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                          ?>  
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Length (mm)</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductDesc.length', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div><div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Width (mm)</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductDesc.width', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div><div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Height (mm)</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductDesc.height', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>
                                   
                                    <!--<div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Country of Manufacture</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             if( count( $CountryList ) > 0 )
                                                 print $this->form->input( 'Product.Country', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$CountryList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                             ?>  
                                       </div>
                                    </div>-->
                                    
                                     <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Status</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             $statusArray = Configure::read( 'status_key' );
                                             if( count( $statusArray ) > 0 )
                                                 print $this->form->input( 'Product.product_status', array( 'type'=>'select', 'empty'=>'Choose status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                             ?>  
                                       </div>
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="prices">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">Prices</div>
                           </div>
                           
                           
                           <div class="panel-body ">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Purchase price</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             print $this->form->input( 'ProductPrice.product_price', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Suggested Retail Price</label>                                        
                                       <div class="col-lg-10">
                                          <?php
                                             print $this->form->input( 'ProductPrice.suggested_retail_price', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>   
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Selling price</label>                                        
                                       <div class="col-lg-10">
                                          <?php
                                             print $this->form->input( 'ProductPrice.selling_price', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                             ?>  
                                       </div>
                                    </div>
                                    <!--<div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Tax Class</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                             $statusArray = Configure::read( 'tax_key' );
                                             if( count( $statusArray ) > 0 )
                                                 print $this->form->input( 'ProductPrice.tax_class', array( 'type'=>'select', 'empty'=>'Choose Tax','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                             ?>  
                                       </div>
                                    </div>-->
                                 </div>
                              </div>
                           </div>
                           
                           
                           
                        </div>
                     </div>
                    
                     <div class="tab-pane" id="images">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">Images</div>
                           </div>
                           <div class="panel-body ">
                              <div class="row">
                                 <div class="col-lg-12">
                                    
                                   <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Product Image1</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'ProductImage.product_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false,'name' => 'data[ProductImage][product_image][]' ) );
																			?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[ProductImage][select_image][]','label' =>false)); 
														?>
													</div>
													</span>
											</div>
											
                                        </div>
                                      </div>
                                      
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Product Image2</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'ProductImage.product_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false,'name' => 'data[ProductImage][product_image][]' ) );
																			 ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[ProductImage][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
															
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Product Image3</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'ProductImage.product_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[ProductImage][product_image][]' ) );
																				?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[ProductImage][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Product Image4</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'ProductImage.product_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[ProductImage][product_image][]','onFocus' =>'check_image();' ) );
                                                                              ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[ProductImage][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Product Image5</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'ProductImage.product_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[ProductImage][product_image][]' ) );
																			  ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															
													<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[ProductImage][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
											</div>
                                        </div>
                                      </div> 
                                    
                                    
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="tab-pane" id="inventory">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">Inventory</div>
                           </div>
                           <div class="panel-body ">
                              <div class="row" >
                                <?php  $i = 0; foreach($warehouses as $warehouse) { ?> 
                               
                                 <div class="col-lg-12" style = "border: 2px solid #c3c3c3; margin-bottom:20px;">
                                     
                                     <div class="form-group">
                                       <div class="col-lg-12">
										<label class="control-label col-lg-12" style="text-align: center;"><?php echo $warehouse['Warehouse']['warehouse_name'];?></label>
                                       </div>
                                    </div>
                                    <?php if(count($warehouse['WarehouseBin']) > 0 ) { ?>
                                     <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Bin/Rack</label>
                                         <div class="col-lg-10">
                                          <?php
                                         
											  foreach($warehouse['WarehouseBin'] as $bin)
											  {
												  $bindata[ $bin['id'] ]	=	$bin['bin_unique_id'];
											  }
												print $this->form->input( 'ProductLocation.'.$i.'.bin_rack_address', array( 'type'=>'select', 'empty'=>'Choose Bin/Rack','options'=>$bindata,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false, 'name' => 'data[ProductLocation]['.$i.'][bin_rack_address]'));
                                             ?>  
                                       </div>
                                    </div>
                                    <?php } ?>
                                     
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Minimum Stock Level</label>                                        
                                       <div class="col-lg-10">                                            
                                          <?php
                                                print $this->form->input( 'ProductLocation.minimum_stock_level', array( 'type'=>'text', 'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false, 'name' =>'data[ProductLocation]['.$i.'][minimum_stock_level]') );
                                             ?>  
                                       </div>
                                    </div>  
                                   
                                   
                                    <div class="form-group">
                                       <label for="username" class="control-label col-lg-2">Current Stock Level</label>                                        
                                       <div class="col-lg-10">
                                          <?php
											print $this->form->input( 'ProductLocation.current_stock_level', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name' =>'data[ProductLocation]['.$i.'][current_stock_level]' ) );
                                             ?>  
                                       </div>
                                    </div>
                                    
                                   
                                 </div>
                                 <?php $i++; } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     
                     <div class="tab-pane" id="attribute">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">Attribute</div>
                           </div>
                           <div class="panel-body ">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <div class="col-lg-10">
											
											<table class="table table-bordered table-striped" id="" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Label</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending"></th>
											</tr>
										</thead>
										<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?php												
												foreach( $attributevalue as $attributes ) { 
											?>
                                            <tr class="odd" >
												<td class="  sorting_1"><?php echo $attributes['Attribute']['attribute_label']; ?></td>
												<td class="  sorting_1">
												
												<?php
													unset($data);
													if($attributes['Attribute']['is_required'] == 1)
													{
														$required	=	1;
													}
													else
													{
														$required	=	0;
													}
													
													print $this->form->input( 'ProductAttribute.attribute_set_id', array( 'type'=>'hidden', 'value' => $attributeid ) );
                                            	
												if( $attributes['Attribute']['attribute_type'] == 'Dropdown') 
												{
													foreach($attributes['AttributeOption'] as $option)
													{
														$data[ $option['id'] ] =	$option['attribute_option_name'];
														
													}
													if(empty($attributes['AttributeOption']))
													{
														$data[0]	=	'Please create option';
													}
													print $this->form->input( 'ProductAttribute.dropdownshow', array( 'type'=>'select', 'empty'=>'Choose Any One','options'=>$data,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false, 'name' => 'data[ProductAttribute][attribute_value][]'));
													print $this->form->input( 'ProductAttribute.dropdown', array( 'type'=>'hidden', 'value' => $required));
												}
												if( $attributes['Attribute']['attribute_type'] == 'Text') 
												{
													print $this->form->input( 'ProductAttribute.textshow', array( 'type'=>'text', 'class'=>'form-control', 'data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false, 'name' => 'data[ProductAttribute][attribute_value][]' ));
													print $this->form->input( 'ProductAttribute.text', array( 'type'=>'hidden', 'value' => $required));
												}
												if( $attributes['Attribute']['attribute_type'] == 'Text Area') 
												{
													print $this->form->input( 'ProductAttribute.textareashow', array( 'type'=>'textarea', 'empty'=>'Choose','class'=>'form-control', 'data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false, 'name' => 'data[ProductAttribute][attribute_value][]' ));
													print $this->form->input( 'ProductAttribute.textarea', array( 'type'=>'hidden', 'value' => $required));
												}
												if( $attributes['Attribute']['attribute_type'] == 'Radio') 
												{ 	$val =	array('0'=>'Yes', '1' => 'No');
													print $this->form->input( 'ProductAttribute.radioshow', array('type' => 'radio', 'options' => $val,'class' => 'testClass', 'before' => '<div class="testOuterClass">','after' => '</div>', 'hiddenField' => false,'legend' => false, 'name' => 'data[ProductAttribute][attribute_value][]'));
													print $this->form->input( 'ProductAttribute.radio', array( 'type'=>'hidden', 'value' => $required));
												}
												if( $attributes['Attribute']['attribute_type'] == 'Date') 
												{ 	
													print $this->form->input( 'ProductAttribute.dateshow', array('type' => 'text','label'=>false,'class' => 'form-control datepicker to_date', 'before' => '<div class="testOuterClass">','after' => '</div>', 'hiddenField' => false,'legend' => false, 'name' => 'data[ProductAttribute][attribute_value][]') );
													print $this->form->input( 'ProductAttribute.date', array( 'type'=>'hidden', 'value' => $required));
												}
												if( $attributes['Attribute']['attribute_type'] == 'Multiple Select') 
												{ 	
													foreach($attributes['AttributeOption'] as $option)
													{
														$dataMultiSel[ $option['id'] ] =	$option['attribute_option_name'];
													}
													echo $this->Form->input('ProductAttribute.multipleselectshow', array('multiple' => true, 'class' => 'form-control', 'options' => $dataMultiSel, 'style'=> 'width:450px;', 'name' => 'data[ProductAttribute][attribute_value]'));
													print $this->form->input( 'ProductAttribute.multipleselect', array( 'type'=>'hidden', 'value' => $required));
												}
												
												?>
												</td>
										    </tr>
											<?php } ?>
										</tbody>
									</table>
										
								       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     
                     <div class="tab-pane" id="categories">
                        <div class="panel">
                           <div class="panel-title">
                              <div class="panel-head">Categories</div>
                           </div>
                           <?php							
                              //print $this->form->create( 'Brand', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/manageBrand', 'type'=>'post','id'=>'brand' ) );
                           ?>
                           <div class="panel-body ">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <input type="input" class="form-control" id="input-check-node" placeholder="Search Category..." value="">
                                    <ul class="list-group">
                                     <?php 
										foreach($getCategories as $getCategory) { 
										$haveChild = (count($getCategory['Children']) > 0 ) ? "glyphicon-plus" : "";
									 ?>
										<div id="treeview-checkable1" class="">
											<li class="list-group-item node-treeview-checkable" id="<?php echo $getCategory['Category']['id']; ?>" data-nodeid="0" style="color:undefined;background-color:undefined;">
												<span class="icon expand-icon glyphicon <?php echo $haveChild; ?>"></span><input type="checkbox" class="l-tcb" id="ext-gen15" name ="data[Product][category_id]" value="<?php echo $getCategory['Category']['id']; ?>">
												<?php 
													//print $this->form->input( 'Product.category_id', array('type'=>'checkbox', 'label'=>'Label', 'checked'=>'') );
												?>
												<?php echo $getCategory['Category']['category_name']; ?>
											</li>
										</div>
									<?php } ?>
							        </ul>
							       
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
               
                <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">
					<button class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="submit" formaction="/wms/showAllProduct" >Go Back</button>
						<?php
							echo $this->Form->button('Add Product', array(
								'type' => 'submit',
								'escape' => true,
								'class'=>'add_product btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
								 ));	
						?>
                </div>
		   </div>
		   </form>
               <div class="col-lg-3">
				   <?php 
					$priceError = (isset($errorPrice)) ? "errorMessage" : " ";
					$productError = (isset($errorproduct) || isset($errordesc)) ? "errorMessage" : " ";
				   ?>
                  <ul class="nav nav-tabs tabs-right">
                     <li class="active"><a href="#general" data-toggle="tab" class="<?php echo $productError; ?>" >General</a></li>
                     <li><a href="#prices" data-toggle="tab" class="<?php echo $priceError; ?>">Prices</a></li>
                     <li><a href="#images" data-toggle="tab">Images</a></li>
                     <li><a href="#inventory" data-toggle="tab">Inventory</a></li>
                     <li ><a href="#categories" data-toggle="tab">Categories</a></li>
                     <li ><a href="#attribute" data-toggle="tab" id="attributeid" >Attribute</a></li>
                     <!--<li><a href="#other" data-toggle="tab">Other</a></li>-->
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>






<style>
.errorMessage
{
	color: red !important;
}
</style>

<script>


$('body').on('click', '.add_product', function (){
	
	var radioButton		=	$('#ProductAttributeRadio').val();
	var textareaButton	=	$('#ProductAttributeTextarea').val();
	var textButton		=	$('#ProductAttributeText').val();
	var dateButton		=	$('#ProductAttributeDate').val();
	var	dropdownButton	=	$('#ProductAttributeDropdown').val();
	
			var flag = 0;
			/* radio button validation */
			if( radioButton == '1'  && $('input[class=testClass]:checked').length<=0 )
			{
				flag = 1;
				if ($(".radio_val")[0]){
						$('.radio_val').hide();
					}
				$('#ProductAttributeRadio').after('<p class= radio_val>Please select one !.</p>');
			}
			else
			{
				$('.radio_val').hide();
			}
			
			
			/* validation for text area */
			if( textareaButton == '1' && $('#ProductAttributeTextareashow').val() == '' )
			{
				flag = 1;
				if ($(".textarea_val")[0]){
						$('.textarea_val').hide();
					}
				$('#ProductAttributeTextarea').after('<p class=textarea_val>Please fill value !.</p>');
			}
			else
			{
				$('.textarea_val').hide();
			}
			
			/* validation for date */
			if( textButton == '1' && $('#ProductAttributeTextshow').val() == '')
			{
				flag = 1;
				if ($(".text_val")[0]){
						$('.text_val').hide();
					}
				$('#ProductAttributeText').after('<p class="text_val">Please fill value !.</p>');
			}
			else
			{
				$('.text_val').hide();
			}
			
			/* validation for date */
			if( dateButton == '1'  && $('#ProductAttributeDateshow').val() == '' )
			{
				flag = 1;
				if ($(".date_val")[0]){
						$('.date_val').hide();
					} 
				$('#ProductAttributeDate').after('<p class="date_val">Please select date !.</p>');
			}
			else
			{
			
				$('.date_val').hide();
			}
			
			/* validation for dropdown */
			if( dropdownButton == '1' && $("#ProductAttributeDropdownshow").val() == '')
			{
				flag = 1;
				if ($(".select_val")[0]){
						$('.select_val').hide();
					} 
				$('#ProductAttributeDropdown').after('<p class=select_val>Please select value !.</p>');
			}
			else
			{
				$('.select_val').hide();
			}
			
			
			if(flag == 1)
			{
				$('#attributeid').css('color', 'red');
				return false;
			}
			else
			{
				$('#attributeid').css('color', 'black');
				return true;
			}
	
	});
	
	
	
$('body').on('click','.node-treeview-checkable', function(){
	
	var id = $(this).attr('id');
	var spanClass 	= 	$('li#'+id).find('span').attr('class');
	var nextClass	=	$( 'li#'+id ).next('ul').attr('class');
	
	//alert(nextClass);
	var hasCheckedClass = $('li#'+id).find('span').hasClass('glyphicon-plus');
	
		if(hasCheckedClass == false)
		{
			return false;
		}
		
		if(nextClass == 'child')
		{
			return false;
		}
		
		    $.ajax(
            {
                url     : getUrl() + '/products/getNthChild',
                type    : 'POST',
                data    : { id : id },
                success : function( msgArray  )
                {
					$('#'+id).after( msgArray );
					$('li#'+id).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }                
            }); 
	});




</script>

<?php
   if(!empty($popupArray))
   {	
   	$objectComponent = $this->Common->getcomponent( "UploadComponent" );	
   	echo $objectComponent->Openpopup($popupArray);		
   } 
   ?>
<script type="text/javascript">
   $(function() {
   
       var defaultData = [
         {
           text: 'Parent 1',
           href: '#parent1',
           tags: ['4'],
           nodes: [
             {
               text: 'Child 1',
               href: '#child1',
               tags: ['2'],
               nodes: [
                 {
                   text: 'Grandchild 1',
                   href: '#grandchild1',
                   tags: ['0']
                 },
                 {
                   text: 'Grandchild 2',
                   href: '#grandchild2',
                   tags: ['0']
                 }
               ]
             },
             {
               text: 'Child 2',
               href: '#child2',
               tags: ['0']
             }
           ]
         },
         {
           text: 'Parent 2',
           href: '#parent2',
           tags: ['0']
         },
         {
           text: 'Parent 3',
           href: '#parent3',
            tags: ['0']
         },
         {
           text: 'Parent 4',
           href: '#parent4',
           tags: ['0']
         },
         {
           text: 'Parent 5',
           href: '#parent5'  ,
           tags: ['0']
         }
       ];
   
       var alternateData = [
         {
           text: 'Parent 1',
           tags: ['2'],
           nodes: [
             {
               text: 'Child 1',
               tags: ['3'],
               nodes: [
                 {
                   text: 'Grandchild 1',
                   tags: ['6']
                 },
                 {
                   text: 'Grandchild 2',
                   tags: ['3']
                 }
               ]
             },
             {
               text: 'Child 2',
               tags: ['3']
             }
           ]
         },
         {
           text: 'Parent 2',
           tags: ['7']
         },
         {
           text: 'Parent 3',
           icon: 'glyphicon glyphicon-earphone',
           href: '#demo',
           tags: ['11']
         },
         {
           text: 'Parent 4',
           icon: 'glyphicon glyphicon-cloud-download',
           href: '/demo.html',
           tags: ['19'],
           selected: true
         },
         {
           text: 'Parent 5',
           icon: 'glyphicon glyphicon-certificate',
           color: 'pink',
           backColor: 'red',
           href: 'http://www.tesco.com',
           tags: ['available','0']
         }
       ];
   
       var json = '[' +
         '{' +
           '"text": "Parent 1",' +
           '"nodes": [' +
             '{' +
               '"text": "Child 1",' +
               '"nodes": [' +
                 '{' +
                   '"text": "Grandchild 1"' +
                 '},' +
                 '{' +
                   '"text": "Grandchild 2"' +
                 '}' +
               ']' +
             '},' +
             '{' +
               '"text": "Child 2"' +
             '}' +
           ']' +
         '},' +
         '{' +
           '"text": "Parent 2"' +
         '},' +
         '{' +
           '"text": "Parent 3"' +
         '},' +
         '{' +
           '"text": "Parent 4"' +
         '},' +
         '{' +
           '"text": "Parent 5"' +
         '}' +
       ']';
   
       var initSelectableTree = function() {
         return $('#treeview-selectable').treeview({
           data: defaultData,
           multiSelect: $('#chk-select-multi').is(':checked'),
           onNodeSelected: function(event, node) {
             $('#selectable-output').prepend('<p>' + node.text + ' was selected</p>');
           },
           onNodeUnselected: function (event, node) {
             $('#selectable-output').prepend('<p>' + node.text + ' was unselected</p>');
           }
         });
       };
       var $selectableTree = initSelectableTree();
   
       var findSelectableNodes = function() {
         return $selectableTree.treeview('search', [ $('#input-select-node').val(), { ignoreCase: false, exactMatch: false } ]);
       };
       var selectableNodes = findSelectableNodes();
   
       $('#chk-select-multi:checkbox').on('change', function () {
         console.log('multi-select change');
         $selectableTree = initSelectableTree();
         selectableNodes = findSelectableNodes();          
       });
   
       // Select/unselect/toggle nodes
       $('#input-select-node').on('keyup', function (e) {
         selectableNodes = findSelectableNodes();
         $('.select-node').prop('disabled', !(selectableNodes.length >= 1));
       });
   
       $('#btn-select-node.select-node').on('click', function (e) {
         $selectableTree.treeview('selectNode', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
       });
   
       $('#btn-unselect-node.select-node').on('click', function (e) {
         $selectableTree.treeview('unselectNode', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
       });
   
       $('#btn-toggle-selected.select-node').on('click', function (e) {
         $selectableTree.treeview('toggleNodeSelected', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
       });
   
   
   
       var $expandibleTree = $('#treeview-expandible').treeview({
         data: defaultData,
         onNodeCollapsed: function(event, node) {
           $('#expandible-output').prepend('<p>' + node.text + ' was collapsed</p>');
         },
         onNodeExpanded: function (event, node) {
           $('#expandible-output').prepend('<p>' + node.text + ' was expanded</p>');
         }
       });
   
       var findExpandibleNodess = function() {
         return $expandibleTree.treeview('search', [ $('#input-expand-node').val(), { ignoreCase: false, exactMatch: false } ]);
       };
       var expandibleNodes = findExpandibleNodess();
   
       // Expand/collapse/toggle nodes
       $('#input-expand-node').on('keyup', function (e) {
         expandibleNodes = findExpandibleNodess();
         $('.expand-node').prop('disabled', !(expandibleNodes.length >= 1));
       });
   
       $('#btn-expand-node.expand-node').on('click', function (e) {
         var levels = $('#select-expand-node-levels').val();
         $expandibleTree.treeview('expandNode', [ expandibleNodes, { levels: levels, silent: $('#chk-expand-silent').is(':checked') }]);
       });
   
       $('#btn-collapse-node.expand-node').on('click', function (e) {
         $expandibleTree.treeview('collapseNode', [ expandibleNodes, { silent: $('#chk-expand-silent').is(':checked') }]);
       });
   
       $('#btn-toggle-expanded.expand-node').on('click', function (e) {
         $expandibleTree.treeview('toggleNodeExpanded', [ expandibleNodes, { silent: $('#chk-expand-silent').is(':checked') }]);
       });
   
       // Expand/collapse all
       $('#btn-expand-all').on('click', function (e) {
         var levels = $('#select-expand-all-levels').val();
         $expandibleTree.treeview('expandAll', { levels: levels, silent: $('#chk-expand-silent').is(':checked') });
       });
   
       $('#btn-collapse-all').on('click', function (e) {
         $expandibleTree.treeview('collapseAll', { silent: $('#chk-expand-silent').is(':checked') });
       });
   
   
   
       var $checkableTree = $('#treeview-checkable').treeview({
         data: defaultData,
         showIcon: false,
         showCheckbox: true,
         onNodeChecked: function(event, node) {
           $('#checkable-output').prepend('<p>' + node.text + ' was checked</p>');
         },
         onNodeUnchecked: function (event, node) {
           $('#checkable-output').prepend('<p>' + node.text + ' was unchecked</p>');
         }
       });
   
       var findCheckableNodess = function() {
         return $checkableTree.treeview('search', [ $('#input-check-node').val(), { ignoreCase: false, exactMatch: false } ]);
       };
       var checkableNodes = findCheckableNodess();
   
       // Check/uncheck/toggle nodes
       $('#input-check-node').on('keyup', function (e) {
         checkableNodes = findCheckableNodess();
         $('.check-node').prop('disabled', !(checkableNodes.length >= 1));
       });
   
       $('#btn-check-node.check-node').on('click', function (e) {
         $checkableTree.treeview('checkNode', [ checkableNodes, { silent: $('#chk-check-silent').is(':checked') }]);
       });
   
       $('#btn-uncheck-node.check-node').on('click', function (e) {
         $checkableTree.treeview('uncheckNode', [ checkableNodes, { silent: $('#chk-check-silent').is(':checked') }]);
       });
   
       $('#btn-toggle-checked.check-node').on('click', function (e) {
         $checkableTree.treeview('toggleNodeChecked', [ checkableNodes, { silent: $('#chk-check-silent').is(':checked') }]);
       });
   
       // Check/uncheck all
       $('#btn-check-all').on('click', function (e) {
         $checkableTree.treeview('checkAll', { silent: $('#chk-check-silent').is(':checked') });
       });
   
       $('#btn-uncheck-all').on('click', function (e) {
         $checkableTree.treeview('uncheckAll', { silent: $('#chk-check-silent').is(':checked') });
       });
   
   
   
       var $disabledTree = $('#treeview-disabled').treeview({
         data: defaultData,
         onNodeDisabled: function(event, node) {
           $('#disabled-output').prepend('<p>' + node.text + ' was disabled</p>');
         },
         onNodeEnabled: function (event, node) {
           $('#disabled-output').prepend('<p>' + node.text + ' was enabled</p>');
         },
         onNodeCollapsed: function(event, node) {
           $('#disabled-output').prepend('<p>' + node.text + ' was collapsed</p>');
         },
         onNodeUnchecked: function (event, node) {
           $('#disabled-output').prepend('<p>' + node.text + ' was unchecked</p>');
         },
         onNodeUnselected: function (event, node) {
           $('#disabled-output').prepend('<p>' + node.text + ' was unselected</p>');
         }
       });
   
       var findDisabledNodes = function() {
         return $disabledTree.treeview('search', [ $('#input-disable-node').val(), { ignoreCase: false, exactMatch: false } ]);
       };
       var disabledNodes = findDisabledNodes();
   
       // Expand/collapse/toggle nodes
       $('#input-disable-node').on('keyup', function (e) {
         disabledNodes = findDisabledNodes();
         $('.disable-node').prop('disabled', !(disabledNodes.length >= 1));
       });
   
       $('#btn-disable-node.disable-node').on('click', function (e) {
         $disabledTree.treeview('disableNode', [ disabledNodes, { silent: $('#chk-disable-silent').is(':checked') }]);
       });
   
       $('#btn-enable-node.disable-node').on('click', function (e) {
         $disabledTree.treeview('enableNode', [ disabledNodes, { silent: $('#chk-disable-silent').is(':checked') }]);
       });
   
       $('#btn-toggle-disabled.disable-node').on('click', function (e) {
         $disabledTree.treeview('toggleNodeDisabled', [ disabledNodes, { silent: $('#chk-disable-silent').is(':checked') }]);
       });
   
       // Expand/collapse all
       $('#btn-disable-all').on('click', function (e) {
         $disabledTree.treeview('disableAll', { silent: $('#chk-disable-silent').is(':checked') });
       });
   
       $('#btn-enable-all').on('click', function (e) {
         $disabledTree.treeview('enableAll', { silent: $('#chk-disable-silent').is(':checked') });
       });
   
   
   
       var $tree = $('#treeview12').treeview({
         data: json
       });
   });
</script>
<script>
   $(document).ready(function() {
       $("#file-5").fileinput({
           'allowedFileExtensions' : ['jpg', 'png','gif'],
   'msgImageWidthSmall' : '100px'
       });
   });
</script>
<script type="text/javascript">
   function close_popup(url)
   	{
   		$('#ModalForm').css('display','none');
   		window.location=url;
   	}
</script>
</div>

