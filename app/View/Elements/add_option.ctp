		<div class="row">
				<?php
					print $this->form->create( 'AttributeOption', array( 'class'=>'form-horizontal', 'url' => '/addattributeoption', 'type'=>'post','id'=>'warehouse' ) );
					print $this->form->input( 'AttributeOption.attribute_id', array( 'type'=>'hidden', 'value' => $attributeId ) );
				?>
            <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Attribute Option</div>
						</div>
					<div class="panel-body">
                    <div class="info"><h5>Attribute Name: <?php echo $currentdata['Attribute']['attribute_name'];?></h5>
						 <h5>Attribute Type: <?php echo $currentdata['Attribute']['attribute_type']; ?></h5>
						</div>
                    <div class="row">
					    <div class="col-lg-12">
							<div class="col-lg-1 col-lg-offset-11 panel-tools">
								<a href="javascript:void(0);" style="" id="btnAdd" class="add_fieldset_new" onclick="add_text_box();" title="Add More Option"><i class="fa fa-plus-circle"></i></a>
							</div>
							<div class="option_textbox" >
							  <div class="form-group option_textbox_count" >
								<label for="username" class="control-label col-lg-3">New Option</label>                                        
								<div class="col-lg-8">                                            
								   <?php
									  print $this->form->input( 'AttributeOption.attribute_option_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'name' =>'data[AttributeOption][attribute_option_name][]' ) );
								   ?> 
								</div>
							  </div>
							</div>  
                           </div>
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                            	 <a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/attribute">Cancel</a>
							   	<?php
									echo $this->Form->button('Add Attribute Option', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'add_attribute btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										 ));	
								?>
						</div>
					</div>
				</div>	
			</form>
	    </div>
