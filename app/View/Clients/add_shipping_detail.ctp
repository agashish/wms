<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
		<h1 class="page-title">Shipping & Platform Detail</h1>
		<div class="panel-title no-radius bg-green-500 color-white no-border">
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		</div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
				<?php							
					print $this->form->create( 'Client', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/clients/AddShippingDetail', 'type'=>'post','id'=>'client' ) );
				?>
            <div class="col-lg-6">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add & Update Shipping</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                                  <?php $i = 0; foreach($providers as $provider) {  ?>
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3"><?php echo $provider['PostalProvider']['provider_name']; ?></label>                                        
                                        	<div class="input-group">
												<span class="input-group-addon no-padding-top no-padding-bottom">
														<div class="col-sm-12">
															<div class="checkbox checkbox-theme display-inline-block">
																<?php
																	print $this->form->input( 'ClientShippingDetail.'.$i.'.selected_currier', array( 'type'=>'checkbox','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
																?>
															</div>
														</div>
												</span>
												<div class="col-sm-10">
												<?php
													print $this->form->input( 'ClientShippingDetail.'.$i.'.licence_key', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
													print $this->form->input( 'ClientShippingDetail.'.$i.'.courier_id', array( 'type'=>'hidden', 'value'=> $provider['PostalProvider']['id']) );
													print $this->form->input( 'ClientShippingDetail.'.$i.'.client_id', array( 'type'=>'hidden', 'value'=> $id ) );
													print $this->form->input( 'ClientShippingDetail.'.$i.'.id', array( 'type'=>'hidden') );
												?> 
												</div>
											</div>
                                      </div>
								<?php $i++; } ?>
								
							</div>
						  </div>
						</div>
						<div class="panel-footer"><div class="text-center border-top-1 border-grey-100">                                                                            
							  <?php
									echo $this->Form->button('Add Detail', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										 ));	
								?>
							</div>
						</form></div>
					 </div>
					 
				  </div>
	    
	    
	    
		<div class="col-lg-6">
			<div class="panel" >
			<?php							
                                print $this->form->create( 'Client1', array( 'enctype' => 'multipart/form-data','class'=>'form-horizontal', 'url' => '/clients/AddPlatformDetail', 'type'=>'post','id'=>'platformdetail' ) );
                            ?>
                <div class="panel-title">
					<div class="panel-head">Add & Update Platform</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body">
					<div class="row">
					
						<div class="col-lg-8 col-lg-offset-2">
						          <?php $i = 0; foreach($sourceresults as $sourceresult) { ?>
                                        <label class="control-label col-lg-4">
											<?php echo $sourceresult['Source']['source_name']; ?>
											
                                        </label> 
                                        <label class="control-label col-lg-8">&nbsp;</label>                                     
                                        <?php  foreach($sourceresult['SubSource'] as $subsource) { ?>
											<div class="form-group">
											<label class="control-label col-lg-6"><?php echo $subsource['sub_source_name']; ?></label>                                        
                                        
                                        	<div class="input-group col-lg-2">
												<div class="col-sm-12">
													<div class="checkbox checkbox-theme display-inline-block">
														<?php
															print $this->form->input( 'ClientPlatformDetail.'.$i.'.selected_platform', array( 'type'=>'checkbox','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
														?>
													</div>
												</div>
												
												<?php
													print $this->form->input( 'ClientPlatformDetail.'.$i.'.subsource_id', array( 'type'=>'hidden', 'value' => $subsource['id'] ) );
													print $this->form->input( 'ClientPlatformDetail.'.$i.'.client_id', array( 'type'=>'hidden', 'value'=> $id ) );
													print $this->form->input( 'ClientPlatformDetail.'.$i.'.id', array( 'type'=>'hidden') );
													print $this->form->input( 'ClientPlatformDetail.'.$i.'.source_id', array( 'type'=>'hidden', 'value' => $sourceresult['Source']['id'] ) );
												?> 
												
											</div>
                                      </div>
								<?php $i++; } } ?>
							</div>
						</div>
					</div>
					<div class="panel-footer"><div class="text-center border-top-1 border-grey-100">                                                                            
							  <?php
									echo $this->Form->button('Add Detail', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										 ));	
								?>
					</div>
				  </form>
			    </div>
			  </div>
			</div>
		<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
			<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/showall/Client/List">Go Back</a>
		</div>
	</div>        
</div>


