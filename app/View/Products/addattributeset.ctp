<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"></h1>
    </div>
   
    <div class="container-fluid">
		 <div class="row">
					<?php
						print $this->form->create( 'Product', array( 'class'=>'form-horizontal', 'url' => '/Products/addproduct', 'type'=>'post','id'=>'warehouse' ) );
					?>
            <div class="col-lg-12">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Create Product Settings</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
						  <div class="form-group">
							<label for="username" class="control-label col-lg-2"> Attribute Set </label>                                        
							 <div class="col-lg-6">                                            
								<?php
									if(count($attributesets) > 0) 
									print $this->form->input( 'Product.attributeset_id', array( 'type'=>'select', 'empty'=>'Choose Attribute Set','options'=>$attributesets,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
								?>
							 </div>
						  </div>
                     </div>
					 
					 <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
							<?php
								echo $this->Form->button('Continue', array(
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
	</div>        
</div>

