<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php //print $role;?></h1>
        <div class="panel-title no-radius bg-green-500 color-white no-border"></div>
        
				<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/showallpostalprovider" data-toggle="modal" data-target=""><i class=""></i> Show Postal Provider </a>
							</li>
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/showallmatrix" data-toggle="modal" data-target=""><i class=""></i> Show Postal Service </a>
							</li>
						</ul>
					</div>
				</div>
					<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		</div>
		<div class="container-fluid">
				<div class="row">
				<?php
					print $this->form->create( 'PostalProvider', array( 'class'=>'form-horizontal', 'url' => '/Matrices/addPostalProvider', 'type'=>'post','id'=>'deleverymatrix' ) );
					print $this->form->input( 'PostalProvider.id', array( 'type'=>'hidden') );
				?>
            <div class="col-lg-12 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head"><?php echo $title; ?></div>
						</div>
					<div class="panel-body">
                    <div class="row">
								<div class="col-lg-6">
									  <div class="form-group" >
										<label for="username" class="control-label col-lg-3">Provider Name</label>                                        
										<div class="col-lg-6">                                            
										   <?php
												print $this->form->input( 'PostalProvider.provider_name', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
										</div>
									  </div>
							 </div>
						</div>
						
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                            	<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/JijGroup/showallpostalprovider">Go Back</a>
							   	<?php
									echo $this->Form->button( $title , array(
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
	</div>        
</div>
	

