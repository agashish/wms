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
                            <div class="panel-body check_image_extension padding-bottom-40 padding-top-40">
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
                                                print $this->form->input( 'Brand.brand_alias', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'onFocus' =>'create_alias();' ) );
                                            ?>  
                                    </div>
                                  </div>
                                
								
									  

                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand Image1</label>                                        
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
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]','label' =>false)); 
														?>
													</div>
													</span>
											</div>
											
                                        </div>
                                      </div>
                                      
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand Image2</label>                                        
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
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
															
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand Image3</label>                                        
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
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand Image4</label>                                        
                                        <div class="col-lg-7">
											<div class="input-group">
															<span class="input-group-btn">
																<span class="btn btn-primary btn-file">
																	Browse…  <?php
																				print $this->form->input( 'BrandImage.brand_image', array( 'type'=>'file','div'=>false,'label'=>false,'class'=>'', 'required'=>false, 'name' => 'data[BrandImage][brand_image][]','onFocus' =>'check_image();' ) );
                                                                              ?>
																</span>
															</span>
															<input type="text" placeholder="No file selected" readonly="" class="form-control">
															<span class="input-group-addon no-padding-top no-padding-bottom">
													<div class="radio radio-theme min-height-auto no-margin no-padding">
														<?php 
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]', 'label' =>false)); ?>
													</div>
													</span>
											</div>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand Image5</label>                                        
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
														$options=array('1'=>'');
														echo $this->Form->radio('',$options, array('name' => 'data[brand][select_image][]', 'label' =>false)); ?>
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
														array('controller' => 'showall/Client/List')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
										?>
									  
										<?php
											echo $this->Form->button('Add Brand', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'add_brand btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
										?>
                                    </div>
                                </div>
                                </form>
                            
                            

        </div><!-- /.row -->		
		<!-- Start here listing of countries whose would be active or deactive -->
    </div>        
</div>
<script>

	function create_alias()
	{
		var catName		=	$.trim($('#BrandBrandName').val().toLowerCase());
		var str = catName.replace(/ /g, '-');
		
		var dt = new Date(); 
		if(catName != '')
		{
			var time = dt.getDate() + "-" + dt.getMonth() + "-" + dt.getFullYear() + "-" + str;
			$('#BrandBrandAlias').val(time);
		}
		else
		{
			$('#BrandBrandAlias').val("");
		}
		
		
	}
	
	$('body').on('click', '.add_brand', function(event){
		
		$( ".check_image_extension .form-group #BrandImageBrandImage" ).each(function() {
		
				var ext = $('#BrandImageBrandImage').val().split('.').pop().toLowerCase();
				var size = parseFloat($("#BrandImageBrandImage")[0].files[0].size ).toFixed(2);
				if(ext != '' && size != '')
				{
					if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1 && size < 2*1024*1024) {
					swal('Image extension should be gif, png, jpg, jpeg Image size should be less the 2MB','');
					event.preventDefault();
					}
				}
				
				
		});
	})
	
</script>

