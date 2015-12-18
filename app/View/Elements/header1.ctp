<header>
		<a href="<?php echo Router::url('/', true) ?>" class="logo"><i class="ion-ios-bolt"></i> <span>WMS</span></a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="navbar-btn sidebar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
<div class="navbar-header">
				<ul class="nav navbar-nav pull-left">
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-tag"></i></a>
						<ul class="dropdown-menu">
							<li>
								<a href="#" data-toggle="modal" data-target=".pop-up-5"><i class="ion-person-add"></i> Manage Section </a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target=".pop-up-3"><i class="ion-person-add"></i> Manage Level </a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target=".pop-up-1"><i class="ion-person-add"></i> New Bin </a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target=".pop-up-2"><i class="ion-compose"></i> Bin List </a>
							</li>
						</ul>
					</li>
					
				</ul>
			</div>			
            <div class="navbar-right">
				<form role="search" class="navbar-form pull-left" method="post" action="#">
					<div class="btn-inline">
						<input type="text" class="form-control padding-right-35" placeholder="Search..."/>
						<button class="btn btn-link no-shadow bg-transparent no-padding padding-right-10" type="button"><i class="ion-search"></i></button>
					</div>
				</form>				
        </nav>
    </header>
	
	<!----------------------------------------- Popup start for add bins ----------------------------------------------- -->
	
<div class="modal fade pop-up-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-1">Add Bin</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <div class="row">
               <div class="col-lg-12 margin-bottom-20" id="popup-scroller1">
				<span class="serializeData"></span>
                  <form class="form-horizontal bin_Form" method="post">
                     <div class="panel" style="clear:both">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Bin Location</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close color-white" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
										if( count( $this->Common->getWarehouseList()) > 0 )
										{
											$list = $this->Common->getWarehouseList();	
											print $this->form->input( 'Level.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
										}
									?> 
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Rack</label>                                        
                                 <select class="form-control racks_class_bin"></select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Section</label>                                        
                                 <select class="form-control sections_class"></select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Level</label>                                        
                                 <select class="form-control level_class_bin"></select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel" style="clear:both">
                        <div class="panel-title bg-amber-200">
                           <div class="panel-head">Add Bin</div>
                           <div class="panel-tools">
                              <a class="panel-refresh" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <!-- Text input -->
                           <div class="col-lg-5 ">
                              <div class="form-group">
                                 <label class="control-label binid" for="input-text">Bin ID</label>
                                 <input type="text" placeholder="E.g.- R1-S1-L1-1234" name="data[WarehouseBin][warehouse_bin][]" class="form-control bin_text_value">
                              </div>
                           </div>
                           <!-- Input text with help -->
                           <div class="col-lg-5 col-lg-offset-1">
                              <div class="form-group">
                                 <label class="control-label" for="input-text-help">Bin Label</label>
                                 <input type="text" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
                              </div>
                           </div>
                        </div>
						<div class="panel-body">
                           <!-- Text input -->
                           <div class="col-lg-5 ">
                              <div class="form-group">
                                 <label class="control-label binid" for="input-text">Bin ID</label>
                                 <input type="text" placeholder="E.g.- R1-S1-L1-1234" name="data[WarehouseBin][warehouse_bin][]" class="form-control bin_text_value">
                              </div>
                           </div>
                           <!-- Input text with help -->
                           <div class="col-lg-5 col-lg-offset-1">
                              <div class="form-group">
                                 <label class="control-label" for="input-text-help">Bin Label</label>
                                 <input type="text" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
                              </div>
                           </div>
                        </div>
						<div class="panel-body">
                           <!-- Text input -->
                           <div class="col-lg-5 ">
                              <div class="form-group">
                                 <label class="control-label binid" for="input-text">Bin ID</label>
                                 <input type="text" placeholder="E.g.- R1-S1-L1-1234" name="data[WarehouseBin][warehouse_bin][]" class="form-control bin_text_value">
                              </div>
                           </div>
                           <!-- Input text with help -->
                           <div class="col-lg-5 col-lg-offset-1">
                              <div class="form-group">
                                 <label class="control-label" for="input-text-help">Bin Label</label>
                                 <input type="text" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
                              </div>
                           </div>
                        </div>
						<div class="panel-body">
                           <!-- Text input -->
                           <div class="col-lg-5 ">
                              <div class="form-group">
                                 <label class="control-label binid" for="input-text">Bin ID</label>
                                 <input type="text" placeholder="E.g.- R1-S1-L1-1234" name="data[WarehouseBin][warehouse_bin][]" class="form-control bin_text_value">
                              </div>
                           </div>
                           <!-- Input text with help -->
                           <div class="col-lg-5 col-lg-offset-1">
                              <div class="form-group">
                                 <label class="control-label" for="input-text-help">Bin Label</label>
                                 <input type="text" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
            <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
            <button class="save_bin btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="submit">Save</button>
            <button class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="submit">Add More</button>
            </div>
            </div>
            </form>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal mixer image -->
<!-- Popup for bin list -->


	
<!-----------------------------------------------Popup end for add bins ------------------------------------------------- -->
														  
<!-----------------------------------------------popup start for show bin list--------------------------------------------- -->		  


<div class="modal fade pop-up-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-2" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-2">Bin List</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <div class="row">
               <div class="col-lg-12 margin-bottom-20" id="popup-scroller2">
                  <!--<div class="text-center margin-bottom-20 border-bottom-1 border-grey-100">
                     <h3 class="color-grey-700 margin-top-30"></h3>
                      <p class="text-light margin-bottom-40"></p>
                     </div>-->
                  <form class="form-horizontal">
                     <div class="panel" style="clear:both">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Bin Location</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close color-white" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Rack</label>                                        
                                 <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Section</label>                                        
                                 <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Level</label>                                        
                                 <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel no-border ">
                        <div class="panel-title no-border">
                           <div class="panel-head">Bin List</div>
                           <div class="panel-tools">
                              <a href="#" class="panel-refresh"><i class="ion-refresh"></i></a>
                              <a href="#" class="panel-close" data-effect="fadeOutDown"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                           <h3 class="color-grey-700"></h3>
                           <p class="text-light margin-bottom-30"></p>
                           <table id="" class="display table" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Salary</th>
                                 </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Salary</th>
                                 </tr>
                              </tfoot>
                              <tbody>
                                 <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>$320,800</td>
                                 </tr>
                                 <tr>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>$433,060</td>
                                 </tr>
                                 <tr>
                                    <td>Sonya Frost</td>
                                    <td>Software Engineer</td>
                                    <td>Edinburgh</td>
                                    <td>23</td>
                                    <td>$103,600</td>
                                 </tr>
                                 <tr>
                                    <td>Quinn Flynn</td>
                                    <td>Support Lead</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>$342,000</td>
                                 </tr>
                                 <tr>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td>Edinburgh</td>
                                    <td>35</td>
                                    <td>$217,500</td>
                                 </tr>
                                 <tr>
                                    <td>Gavin Joyce</td>
                                    <td>Developer</td>
                                    <td>Edinburgh</td>
                                    <td>42</td>
                                    <td>$92,575</td>
                                 </tr>
                                 <tr>
                                    <td>Martena Mccray</td>
                                    <td>Post-Sales support</td>
                                    <td>Edinburgh</td>
                                    <td>46</td>
                                    <td>$324,050</td>
                                 </tr>
                                 <tr>
                                    <td>Jennifer Acosta</td>
                                    <td>Junior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>43</td>
                                    <td>$75,650</td>
                                 </tr>
                                 <tr>
                                    <td>Shad Decker</td>
                                    <td>Regional Director</td>
                                    <td>Edinburgh</td>
                                    <td>51</td>
                                    <td>$183,000</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>



<!-----------------------------------------------popup start for show bin list--------------------------------------------- -->		  
															  
<!-----------------------------------------------Popup Start for add level--------------------------------------------------- -->

<div class="modal fade pop-up-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-3" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-3">Manage Level</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <div class="row">
               <div class="col-lg-12 margin-bottom-20" id="popup-scroller3">
                  <form class="form-horizontal">
                     <div class="panel" style="clear:both">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Add Level</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close color-white" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
                                    if( count( $this->Common->getWarehouseList()) > 0 )
                                    {
                                    	$list = $this->Common->getWarehouseList();	
                                    	print $this->form->input( 'Level.warehouseSection_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
                                    }
                                    ?>    
                              </div>
                           </div>
                           <div class="col-lg-2 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-label">Rack</label>                                                                                   
                                 <select class="form-control racks_class racks_class_level"></select>   
                              </div>
                           </div>
                           <div class="col-lg-2 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-label">Section</label>                                                                                   
                                 <select class="form-control sectionsList_class"></select>      
                              </div>
                           </div>
                           <div class="col-lg-3 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-label">Level</label>                                                                                   
                                 <input type="text" placeholder="Add No of levels here" value="1" class="form-control margin-bottom-20 addLevelValue">  
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6 col-lg-offset-6">
                                 <button class="showAll btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Show All</button>
                                 <button class="addLevel btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Add</button>
                                 <button aria-hidden="true" data-dismiss="modal" class="levelCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="button">Cancel</button>									   
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel no-border defaultListNone" id="levelList">
                        <div class="panel-title no-border">
                           <div class="panel-head">Level List</div>
                           <div class="panel-tools">
                              <a href="#" class="panel-refresh"><i class="ion-refresh"></i></a>
                              <a href="#" class="panel-close" data-effect="fadeOutDown"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                           <h3 class="color-grey-700"></h3>
                           <p class="text-light margin-bottom-30"></p>
                           <table id="" class="display table" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Warehhouse Name</th>
                                    <th>Rack No.</th>
                                    <th>Section No.</th>
                                    <th>Level No.</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                    <th>Warehhouse Name</th>
                                    <th>Rack No.</th>
                                    <th>Section No.</th>
                                    <th>Level No.</th>
                                    <th>Action</th>
                                 </tr>
                              </tfoot>
                              <tbody>
                                 <?php $levelLists	=	$this->Common->getWarehouseLevelList(); 
                                    foreach($levelLists as $levelList) { 
                                    ?>
                                 <tr>
                                    <td><?php echo $levelList['Warehouse']['warehouse_name']; ?></td>
                                    <td><?php echo $levelList['WarehouseLevel']['warehouse_rack'] ?></td>
                                    <td><?php echo $levelList['WarehouseLevel']['warehouse_section'] ?></td>
                                    <td><?php echo $levelList['WarehouseLevel']['warehouse_level'] ?></td>
                                    <td><button class="editLevel btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Edit</button></td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>



<!-----------------------------------------------Popup end for add level----------------------------------------------------->

	
<div class="modal modal-wide fade pop-up-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-5" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-5">Manage Section</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <div class="row">
               <div class="col-lg-12 margin-bottom-20" id="popup-scroller5">
                     <div class="panel" style="clear:both" id="addSectionpanel">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Add Section</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close color-white" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
                                    if( count( $this->Common->getWarehouseList()) > 0 )
                                    {
                                    	$list = $this->Common->getWarehouseList();	
                                    	print $this->form->input( 'Section.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
                                    }
                                    ?>    
                              </div>
                           </div>
                           <div class="col-lg-2 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-rack">Rack</label>                                                                                   
                                 <select class="form-control rack_class_select rack_for_section">
										<option value="">Choose Rack</option>
								 </select>
                              </div>
                           </div>
                           <div class="col-lg-3 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-section">Section</label>                                                                                   
                                 <input type="text" placeholder="Add No of sections here" class="form-control margin-bottom-20 addSectionValue">  
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6 col-lg-offset-6">
                                 <button class="showAllSection btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Show All</button>
                                 <button class="addSection btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Add</button>
                                 <button aria-hidden="true" data-dismiss="modal" class="SectionCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="button">Cancel</button>									   
                              </div>
                           </div>
                        </div>
                   </div>
						<!----Section List----->
				
				
				<div class="panel" style="clear:both; display:none;" id="showlistpanel">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Show Section</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"><i class="ion-refresh"></i></a>
                              <a class="panel-close color-white" href="#"><i class="ion-close"></i></a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-lg-2 col-lg-offset-1">
                              <div class="form-group">
                                 <label for="username" class="control-rack">City</label>                                                                                   
                                <?php
                                                if( count( $this->Common->getCityList() ) > 0 )
													$getCityList = $this->Common->getCityList();	
                                                    print $this->form->input( 'City.city_id', array( 'type'=>'select', 'empty'=>'Select All','options'=>$getCityList,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?> 
                                           
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
                                    if( count( $this->Common->getWarehouseList()) > 0 )
                                    {
                                    	$list = $this->Common->getWarehouseList();	
                                    	print $this->form->input( 'getSectionBy.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control get_warehouse', 'div'=>false, 'label'=>false, 'required'=>false) );
                                    }
                                    ?>    
                              </div>
                           </div>
                           </div>
                        <div class="panel_body_table" >
                        </div>
                   <div class="col-lg-6 col-lg-offset-6">
                        <button type="button" class="addSectioncontent btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Add</button>
                        <button type="button" class="SectionCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" data-dismiss="modal" aria-hidden="true">Cancel</button>									   
                   </div>
                   </div>
				   <!---show list ---->
				   
               </div>
            </div>
           
         </div>
      </div>
   </div>
</div>

<script>


	$( 'body' ).on('change', '#getSectionByWarehouseId', function()
	{    
		 var getWearehouseId = $(this).val();
    
 
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getSection',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"warehouseID":' + getWearehouseId + '}',
          'jij_dataSetClass_Id'         : 'panel_body_table',
          'jij_selectorIdentifier'      : '.'
    });
	}); 
	
	
	$( 'body' ).on( 'change', '#CityCityId', function()
	{
   
		/* Get selected value from city dropdown */
		
		var getCityId = $(this).val();
    
 
		/* Call Plugin for selection dropdows here */  
		$(this).jijAjax(
		{
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getWarehouse',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"city_id":' + getCityId + '}',
          'jij_dataSetClass_Id'         : 'get_warehouse',
          'jij_selectorIdentifier'      : '.'
		});
      
	});

	$( 'body' ).on( 'click', '.showAllSection', function()
	{
		$('#addSectionpanel').hide();
		$('#showlistpanel').show();
	});
	
	$( 'body' ).on( 'click', '.addSectioncontent', function()
	{
		$('#addSectionpanel').show();
		$('#showlistpanel').hide();
	});

	function edit_section(id, wID, rID)
	{
		
		$(this).jijAjax(
				{
					'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/list',
					'jij_type'                        : 'POST',
					'jij_data'                        : '{"action":' + wID + '}',
					'jij_dataSetClass_Id'             : 'rack_class_select',
					'jij_selectorIdentifier'          : '.'       
				});
			
			
			$('.rack_name_'+id).hide();
			$('.section_count_'+id).hide();
			$('.editSection_'+id).hide();
			$('.warehouse_name_'+id).hide();
			$('.section_delete_'+id).hide();
			
			$('.display_warehouse_'+id).show();
			$('.edit_section_count_'+id).show();
			$('.edit_rack_name_'+id).show();
			$('.section_update_'+id).show();
			$('.section_cancel_'+id).show();
			
			$('select[name^="select_warehouse"] option[value='+wID+']').attr("selected","selected");
			$('select[name^="select_rack_'+id+'"] option[value='+rID+']').attr("selected","selected");
			
			
		}
		
		function cancel_edit(id)
		{
			$('.rack_name_'+id).show();
			$('.section_count_'+id).show();
			$('.editSection_'+id).show();
			$('.warehouse_name_'+id).show();
			$('.section_delete_'+id).show();
			
			$('.display_warehouse_'+id).hide();
			$('.edit_section_count_'+id).hide();
			$('.edit_rack_name_'+id).hide();
			$('.section_update_'+id).hide();
			$('.section_cancel_'+id).hide();
		}


	
$( 'body' ).on( 'change', '#warehouseWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/list',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'rack_class_select',
          'jij_selectorIdentifier'          : '.'       
    });
      
});


function edit_section_update(id)
{
    /* Get selected value */
	var warehouseId		=	$('.display_warehouse_'+id).val();
	var rackId			=	$('.edit_rack_name_'+id).val();
	var sectionVal		=	$('.edit_section_count_'+id).val();
	
		if ( warehouseId == "" )
		{
         swal("Kindly select warehouse!" , "" , "error");                    
		return false;  
		}
		
		if ( rackId == "" )
		{
         swal("Kindly select warehouse rack!" , "" , "error");                    
		 return false;  
		}
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/section_update',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"sectionId":' + id + ',"warehouseId": '+warehouseId+', "rackid" : '+rackId+', "sectionval" :'+sectionVal+'}'
            
    });
      
}

function delete_section(id)
{
	
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this sections!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            /* Set default update action */
            var strAction = "update";
            
            /* Set JSon String for sending the data at specific location -->>
             <<-- Data set according to cakephp convention */
            var sendJsonData = '';
            sendJsonData = '{"sectionId":' + id;
            sendJsonData += '}';
            
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/section_delete',
                type    : 'POST',
                data    : sendJsonData,
                success :	function( msgArray  )
                {
                    swal("Section deleted", msgArray , "success");
                    return false;
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your section is safe :)", "error");
        }
    });
	
}

</script>
								  
<!------------------------------------------------ Popup end for add section -------------------------------------------->									  
