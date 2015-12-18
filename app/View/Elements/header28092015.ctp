<header>
		<a href="<?php echo Router::url('/', true) ?>" class="logo"><i class="ion-ios-bolt"></i> <span>WMS</span></a>
<nav class="navbar navbar-static-top">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </div>
        <div class="navbar-header">
            <ul class="nav navbar-nav">
				<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="ion-wand"></i> <span>Roles</span></a>
						<ul class="dropdown-menu">
							<li><a href="/wms/showRoles">Show Roles</a></li>
							<li><a href="/wms/managerole">Add New Roles</a></li>
						</ul>
					</li>
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-users"></i> <span>Users</span></a>
						<ul class="dropdown-menu">
							<li><a href="/wms/showList">Show All Users</a></li>
							<li><a href="/wms/register">Register User</a></li>		
						</ul>
					</li>
					<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-map-marker"></i> <span>Region</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Countries</a>
                            <ul class="dropdown-menu">
                                <li><a href="/wms/showallLocation">Show All Countries</a></li>
                                <li><a href="/wms/manageCounty">Add Country</a></li>
                            </ul>
                        </li>
						<li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">State</a>
                            <ul class="dropdown-menu">
                                <li><a href="/wms/showallStates">Show All States</a></li>
                                <li><a href="/wms/manageState">Add State</a></li>
                            </ul>
                        </li>
						<li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">City</a>
                            <ul class="dropdown-menu">
                                <li><a href="/wms/showallCities">Show All Cities</a></li>
                                <li><a href="/wms/manageCity">Add City</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cubes"></i> <span>Warehouse</span></a>
						<ul class="dropdown-menu">
							<li><a href="/wms/showallWarehouses">Show All Warehouse</a></li>
							<li><a href="/wms/manageWarehouse">Add Physical Warehouse</a></li>	
						</ul>
					</li>
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="ion-ios-color-filter-outline"></i> <span>Clients</span></a>
						<ul class="dropdown-menu">
							<li><a href="/wms/showall/Client/List">Show All Client</a></li>
							<li><a href="/wms/manage/client/new">Add Client</a></li>	
						</ul>
					</li>
					<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-clipboard"></i> <span>Inventory Management</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-android-person-add"></i> <span>Suppliers</span></a>
                            <ul class="dropdown-menu">
							<li><a href="/wms/showAllSupplier">Show Supplier</a></li>
							<li><a href="/wms/manageSupplier">Add New Supplier</a></li>		
							</ul>
                        </li>
						<li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="ion-merge"></i> <span>Categories</span></a>
							<ul class="dropdown-menu">
							<li><a href="/wms/manageCategory">Add New Category</a></li>	
							<li><a href="/wms/showAllCategory">Show Category</a></li>		
							</ul>
                        </li>
						<li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-shirtsinbulk"></i> <span>Brands</span></a>
							<ul class="dropdown-menu">
							<li><a href="/wms/showAllBrand">Show Brands</a></li>
							<li><a href="/wms/manageBrand">Add Brand</a></li> 	
							</ul>
                        </li>
						<li>
						<a href="/wms/attribute"  ><i class="fa fa-buysellads"></i> <span>Product Attributes</span></a>
						</li>
                    </ul>
                </li>
					<li class="dropdown dropdown-inverse">
						<a href="/wms/linnworksapis"  ><i class="fa fa-plug"></i> <span>Linnworks API</span></a>
					</li>
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="ion-grid"></i> <span>Delivery Matrix</span></a>
						<ul class="dropdown-menu">
							<li><a href="/wms/JijGroup/showallmatrix">Show Matrix</a></li>
							<li><a href="/wms/JijGroup/DeleveryMatrix">Add Matrix</a></li> 	
						</ul>
					</li>
					
					<!-- Start Plateform fee -->
					
					<li class="dropdown dropdown-inverse">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span><i class="fa fa-bank"></i>Platform Charges</span></a>
						<ul class="dropdown-menu">
							<!--<li><a href="/wms/JijGroup/ShowAmazonFbaFee">Amazon FBA Fee</a></li>-->
							<li><a href="/wms/JijGroup/ShowAllCategoryFee">Amazon Category Fee</a></li> 	
						</ul>
					</li>
					
					<!-- End Plateform fee -->
            </ul>
        </div><!--/.nav-collapse -->
		<div class="navbar-right">
				<ul class="nav navbar-nav">
					
						
                    
						
                    <li class="dropdown dropdown-box dropdown-tasks">
					<a href="<?php print Router::url(array('controller' => 'users', 'action' => 'logout')); ?>" class="button"><i class="ion-log-out"></i> <span>Logout</span></a>
                        
                    </li>
                </ul>
			</div>
</div>
</nav>
    </header>
	
<!----------------------------------------- Popup start for add bins ----------------------------------------------- -->
	
<div class="modal modal-wide fade pop-up-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-1">Manage Bin</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <form method="post" class="save_bin">
				<div class="panel" style="clear:both">
						<div class="panel-body" >
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
								  <select class="form-control racks_class_bin" name="data[Level][warehouse_rack]"><option value="">Choose</option></select>
							   </div>
							</div>
							<div class="col-lg-3">
							   <div class="form-group">
								  <label for="username" class="control-label">Section</label>                                        
								  <select class="form-control sections_class" name="data[Level][warehouse_section]"><option value="">Choose</option></select>
							   </div>
							</div>
							<div class="col-lg-3">
							   <div class="form-group">
								  <label for="username" class="control-label">Level</label>                                        
								  <select class="form-control level_class_bin" name="data[Level][warehouse_level]"><option value="">Choose</option></select>
							   </div>
							</div>
						 </div>
				</div>
				<div class="outer_bin_addMore">
						<!-- Start here render html according to login -->
			    </div>	
				<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
				<button type="submit" class="addBin btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Save</button>				
				<button type="submit" class="btn btn_binAddMore bg-green-500 color-white btn-dark padding-left-40 padding-right-40">Add More</button>
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
            <h4 class="modal-title " id="myLargeModalLabel-2">Bin List</h4>
         </div>
         <div class="modal-body bg-grey-100">
            <div class="row">
               <div class="col-lg-12 margin-bottom-20" id="popup-scroller2">
                     <div class="panel" style="clear:both">
                        <div class="panel-title bg-blue-grey-800 color-white">
                           <div class="panel-head">Bin Location</div>
                           <div class="panel-tools">
                              <a class="panel-refresh color-white" href="#"></a>
                              <a class="panel-close color-white" href="#"></a>
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
											 print $this->form->input( 'Bin.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
										 }
									 ?> 
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Rack</label>                                        
								 <select class="form-control racks_class_bin_list" name="data[Level][warehouse_rack]"><option value="">Choose</option></select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                  <label for="username" class="control-label">Section</label>                                        
								  <select class="form-control sections_class_list" name="data[Level][warehouse_section]"><option value="">Choose</option></select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                  <label for="username" class="control-label">Level</label>                                        
								  <select class="form-control level_class_bin_list" name="data[Level][warehouse_level]"><option value="">Choose</option></select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel no-border ">
                        <div class="panel-title no-border">
                           <div class="panel-head">Bin List</div>
                           <div class="panel-tools">
                              <a href="#" class="panel-refresh"></a>
                              <a href="#" class="panel-close" data-effect="fadeOutDown"></a>
                           </div>
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                           <h3 class="color-grey-700"></h3>
                           <p class="text-light margin-bottom-30"></p>
                           <div class="bin_data">
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>

$( 'body' ).on( 'change', '#BinWarehouseId', function()
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
          'jij_url'                         : getUrl() + '/serverajaxs/getRacksBehindWarehouse',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'racks_class_bin_list',
          'jij_selectorIdentifier'          : '.'
    });
      
});


/* Selection of rack that after will add with rack dropdown for bin form, if we get the racks list */
$( 'body' ).on( 'change', '.racks_class_bin_list', function()
{
		
    /* Get selected value from warehouse dropdown */
    var getRackIdFromDropdown = $(this).val();
    var getWarehouseIdFromDropdown = $("#BinWarehouseId").val();
    
    

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/serverajaxs/getPrepareSectionListFromCounter',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"action":' + getRackIdFromDropdown + ', "wh":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'sections_class_list',
          'jij_selectorIdentifier'      : '.'          
    });
      
});

$( 'body' ).on( 'change', '.sections_class_list', function()
{
    
    /* Get selected value from rack dropdown */
    var getSectionIdFromDropdown 		= 	$(this).val();
    var getWarehouseIdFromDropdown 	    = 	$("#BinWarehouseId").val();
    var getRackIdFromDropdown 		    = 	$(".racks_class_bin_list").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/level/list',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"sectionid":' + getSectionIdFromDropdown + ', "whid":' + getWarehouseIdFromDropdown + ', "rackid":' + getRackIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'level_class_bin_list',
          'jij_selectorIdentifier'      : '.'
    });
      
});

$( 'body' ).on( 'change', '.level_class_bin_list', function()
{
    
    /* Get selected value from level dropdown */
    var getLevelIdFromDropdown 			= 	$(this).val();
    var getWarehouseIdFromDropdown 	    = 	$("#BinWarehouseId").val();
    var getRackIdFromDropdown 		    = 	$(".racks_class_bin_list").val();
    var getSectionIdFromDropdown 		= 	$(".sections_class_list").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
		$.ajax({
                url     	: getUrl() + '/jijGroup/server/warehouse/getbin',
                type    	: 'POST',
                data    	: { warehouseID : getWarehouseIdFromDropdown,  
								sectionID : getSectionIdFromDropdown, 
								rackID : getRackIdFromDropdown, 
								levelID : getLevelIdFromDropdown },
                success 	:	function( data  )
                {
					$('.bin_data').html(data);
			    }                
            });
	});
	
	/* show the edit test box field and other content */
	function edit_bin(id)
		{
			$('.editBin_'+id).hide();
			$('.display_bin_value_'+id).hide();
			
			$('.bin_update_'+id).show();
			$('.bin_cancel_'+id).show();
			$('.bin_value_'+id).show();
			$('.dis_bin_value_'+id).show();
		}
	
	/* hide the edit test box field and other content */
	function cancel_edit_bin( id )
		{
			$('.editBin_'+id).show();
			$('.display_bin_value_'+id).show();
			
			$('.bin_update_'+id).hide();
			$('.bin_cancel_'+id).hide();
			$('.bin_value_'+id).hide();
			$('.dis_bin_value_'+id).hide();
		}
		
	function edit_bin_update( id )
		{
			/* get the text value for selected bin */
			var getLebel	=	$('.bin_value_'+id).val();
		 
			/* ajax use update the selected bin */
			$.ajax(
				{
					url     	: getUrl() + '/jijGroup/server/warehouse/editbin',
					type    	: 'POST',
					data    	: { binID : id, binlabel : getLebel },
					success 	:	function( data  )
						{
							swal("Bin update successfully !" , "" , "error");
							$('.editBin_'+id).show();
							$('.display_bin_value_'+id).show(); 
							$('.display_bin_value_'+id).text(getLebel); 
							$('.bin_update_'+id).hide();
							$('.bin_cancel_'+id).hide();
							$('.bin_value_'+id).hide();
							$('.dis_bin_value_'+id).hide();                   
							return false; 
						}                
            });
		}
		
	function delete_bin( id )
	{
		swal({
        title: "Are you sure?",
        text: "You want to delete bin !",
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
						$.ajax(
								{
									url     : getUrl() + '/jijGroup/server/warehouse/bin_delete',
									type    : 'POST',
									data    : { binId : id },
									success :	function( msgArray  )
										{
											$('.whole_row_'+id).remove();
											swal("Bin Deleted", "" , "success");
											return false;
										}                
								});           
						}
				else
					{
						swal("Cancelled", "Your bin is safe :)", "error");
					}
				});
	}

</script>

<!-----------------------------------------------popup end for show bin list--------------------------------------------- -->		  
				

														  
<!-----------------------------------------------Popup Start for add level--------------------------------------------------- -->

<div class="modal modal-wide fade pop-up-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-3" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-3">Manage Level</h4>
         </div>
         <div class="modal-body bg-grey-100">
		 <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
										<li class="addLevelcontent active"><a href="#addLevel" data-toggle="tab">Add Section</a></li>
										<li class="showAll_level" ><a href="#showAllLevel" data-toggle="tab">Show All</a></li>
									</ul>
							<div id="my-tab-content" class="tab-content">
								<div class="tab-pane active" id="addLevel">
								<div class="panel" style="clear:both" id="addSectionpanel">
                        
                        <div class="panel-body">
                           <div class="col-lg-2 col-lg-offset-1">
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
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="username" class="control-label">Rack</label>                                                                                   
                                 <select class="form-control racks_class racks_class_level"></select>   
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                                 <label for="username" class="control-label">Section</label>                                                                                   
                                 <select class="form-control sectionsList_class"></select>      
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
								  <?php $rackDetail = configure::read('rack_detail'); 
								  $rackDetail['min_level'];
								  ?>
                                 <label for="username" class="control-label">Level</label>                                                                                   
                                 <input type="text" placeholder="Add No of levels here" value="<?php echo $rackDetail['min_level']; ?>" class="form-control margin-bottom-20 addLevelValue">  
                              </div>
                           </div>
                           
                              <div class="col-lg-1">
								 <!--<button class="showAll_level btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Show All</button>-->
								 <label class="control-section">&nbsp;</label>
                                 <button class="control-section addLevel btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Add</button>
                                 <!--<button aria-hidden="true" data-dismiss="modal" class="levelCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="button">Cancel</button>									   -->
                              </div>
                        </div>
                     </div>
								</div>
								<div class="tab-pane" id="showAllLevel">
								<div class="panel no-border defaultListNone" id="levelList" style="display:none;" >
                        
                        <div class="row">
                             <!--<div class="outerSpinner">
								 <span>
									<img src="http://lovevitamins.com/wms/app/webroot/img/canvas.png" height="50" width="50" border="0" />			
								 </span>
                             </div> -->
                          <div class="panel-body">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-rack">City</label>                                                                                   
											<?php
                                                if( count( $this->Common->getCityList() ) > 0 )
													$getCityList = $this->Common->getCityList();	
                                                    print $this->form->input( 'City.city_id', array( 'type'=>'select', 'empty'=>'Select All','options'=>$getCityList,'class'=>'form-control', 'div'=>false, 'label'=>false, 'required'=>false) );
											?> 
                              </div>
                           </div>
                           <div class="col-lg-3 col-lg-offset-1">
							  <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
                                    if( count( $this->Common->getWarehouseList()) > 0 )
                                    {
                                    	$list = $this->Common->getWarehouseList();	
                                    	print $this->form->input( 'getLevelBy.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control get_warehouse', 'div'=>false, 'label'=>false, 'required'=>false) );
                                    }
                                    ?>    
                              </div>
                           </div>
                           <!--<div class="col-lg-6 col-lg-offset-6">
                              <div class="form-group">
                                 <button class="addLevelcontent btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Add</button>
                                 <button aria-hidden="true" data-dismiss="modal" class="levelCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="button">Cancel</button>									         
                              </div>
                           </div>-->
                        </div>
                       </div>
                        <div class="panel-body no-padding-top bg-white">
                           <h3 class="color-grey-700"></h3>
                           <p class="text-light margin-bottom-30"></p>
                           <div class="level_data" id="popup-scroller3">
                           </div>
                        </div>
                     </div>
								</div>
							</div>
            
         </div>
      </div>
   </div>
</div>

<script>
	$( 'body' ).on( 'click', '.showAll_level', function()
	{
		$('#addSectionpanel').hide();
		$('#levelList').show();
		$.ajax(
            {
                url     	: getUrl() + '/jijGroup/server/warehouse/section/getLevel',
                type    	: 'POST',
                data    	: { warehouseID : "" },
                beforeSend	: function(){ $( ".outerSpinner" ).show(); },
                success 	:	function( data  )
                {
					$( ".outerSpinner" ).hide();
					if(data == 'error')
					{
						swal("Level not found !" , "" , "error");                    
						return false; 
					}
					$('.level_data').html(data);
			    }                
            });
		
	});
	
	
	$( 'body' ).on( 'click', '.addLevelcontent', function()
	{
		$('#addSectionpanel').show();
		$('#levelList').hide();
	});
	
	
	$( 'body' ).on('change', '#getLevelByWarehouseId', function()
	{    
		 var getWearehouseId = $(this).val();
    /* Call Plugin for selection dropdows here */ 
    
    $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/section/getLevel',
                type    : 'POST',
                data    : {warehouseID : getWearehouseId },
                beforeSend	: function(){ $( ".outerSpinner" ).show(); },
                success :	function( data  )
                {
					$( ".outerSpinner" ).hide();
					if(data == 'error')
					{
						swal("Level not found !" , "" , "error");                    
						return false; 
					}
					$('.level_data').html(data);
					
			    }                
            });  
	});
	
	function delete_level(id)
	{
		swal({
        title: "Are you sure?",
        text: "You want to delete level !",
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
						var retrieve	=	"";
            
						/* Set JSon String for sending the data at specific location -->>
						<<-- Data set according to cakephp convention */
						$.ajax(
								{
									url     : getUrl() + '/jijGroup/server/warehouse/level_delete',
									type    : 'POST',
									data    : {levelId : id ,retrieve : retrieve},
									success :	function( msgArray  )
										{
											$('.level_no_'+id).remove();
											$('.update_button_'+id).remove();
											$('.delete_botton_'+id).remove();
											swal("Level Deleted", "" , "success");
											return false;
										}                
								});           
					}
				else
					{
						swal("Cancelled", "Your level is safe :)", "error");
					}
			});
	} 
	
	
	function update_level(id)
	{
		$('.level_no_'+id).hide();
		$('.update_button_'+id).hide();
		
		$('.lavel_value_'+id).show();
		$('.ok_value_'+id).show();
		$('.cancel_value_'+id).show();
	}
	function cancel_update_level(id)
	{
		$('.level_no_'+id).show();
		$('.update_button_'+id).show();
		
		$('.lavel_value_'+id).hide();
		$('.ok_value_'+id).hide();
		$('.cancel_value_'+id).hide();
		
	}
	function updatelevel_value(id)
	{
		var sectionValue	=	$('.lavel_value_'+id).val();
		$.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/level_update',
                type    : 'POST',
                data    : {sectionId : id ,sectionValue : sectionValue},
                success :	function( msgArray  )
                {
					$('.level_no_'+id).show();
					$('.update_button_'+id).show();
					
					$('.lavel_value_'+id).hide();
					$('.ok_value_'+id).hide();
					$('.cancel_value_'+id).hide();
					
					$('.level_no_'+id).text(sectionValue);
					
                    swal("Level update", msgArray , "success");
                    return false;
                }                
            });           
   	
	}
	
	
</script>




<!-----------------------------------------------Popup end for add level----------------------------------------------------->


<!-----------------------------------------------Star Popup for Section ----------------------------------------------->	
<div class="modal modal-wide fade pop-up-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-5" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-5">Manage Section</h4>
         </div>
         <div class="modal-body bg-grey-100">
		 <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
										<li class="addSectioncontent active"><a href="#addSection" data-toggle="tab">Add Section</a></li>
										<li><a href="#showAll" class="showAllSection" data-toggle="tab">Show All</a></li>
									</ul>
									
					<div id="my-tab-content" class="tab-content">
									<div class="tab-pane active" id="addSection">
									<div class="panel" style="clear:both;" id="addSectionpanel">
									<div class="panel-body">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-label">Warehouse</label>                                        
                                 <?php									    
                                    if( count( $this->Common->getWarehouseList()) > 0 )
                                    {
                                    	$list = $this->Common->getWarehouseList();	
                                    	print $this->form->input( 'Section.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control','div'=>false, 'label'=>false, 'required'=>false) );
                                    }
                                    ?>    
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-rack">Rack</label>                                                                                   
                                 <select class="form-control rack_class_select rack_for_section>
										<option value="">Choose Rack</option>
								 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
								  <?php $section = configure::read('rack_detail'); 
								  $section['min_section'];
								  ?>
								 <label for="username" class="control-section">Section</label>                                                                                   
                                 <input type="text" placeholder="Add No of sections here" class="form-control margin-bottom-0 addSectionValue" value="<?php echo $section['min_section']; ?>">
								<p class="help-block">(Default section will be 25 min. If you want, you can change value)</p>								 
                              </div>
                           </div>
                           
                              <div class="col-lg-1">
							  <div class="form-group">
                                 <!--<button class=" btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" type="button">Show All</button>-->
								 <label class="control-section">&nbsp;</label>
                                 <button class="addSection btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40 control-section" type="button">Add</button>
                                 <!--<button aria-hidden="true" data-dismiss="modal" class="SectionCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="button">Cancel</button>									  --> 
                              </div>
							  </div>
                          
                        </div>
						</div>
									</div>
									<div class="tab-pane" id="showAll">
									<div class="panel" style="clear:both; display:none;" id="showlistpanel">
                        
                        <div class="panel-body">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="username" class="control-rack">City</label>                                                                                   
										<?php
                                                if( count( $this->Common->getCityList() ) > 0 )
													$getCityList = $this->Common->getCityList();	
                                                    print $this->form->input( 'City.city_id', array( 'type'=>'select', 'empty'=>'Select All','options'=>$getCityList,'class'=>'form-control ','div'=>false, 'label'=>false, 'required'=>false) );
                                        ?> 
                                           
                              </div>
                           </div>
                           <div class="col-lg-3">
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
                        <div class="panel_body_table"  id="popup-scroller5">
                        </div>
                   <!--<div class="col-lg-6 col-lg-offset-6">
                        <button type="button" class="addSectioncontent btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Add</button>
                        <button type="button" class="SectionCancel btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" data-dismiss="modal" aria-hidden="true">Cancel</button>									   
                   </div>-->
                   </div>
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
		$('.addSectionpanel').hide();
		$('#showlistpanel').show();
		var getWearehouseId = '';
		
		$(this).jijAjax(
		{
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getSection',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"warehouseID":' + getWearehouseId + '}',
          'jij_dataSetClass_Id'         : 'panel_body_table',
          'jij_selectorIdentifier'      : '.'
		});
	});
	
	$( 'body' ).on( 'click', '.addSectioncontent', function()
	{
		$('.addSectionpanel').show();
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
			
			
			//$('.rack_name_'+id).hide();
			$('.section_count_'+id).hide();
			$('.editSection_'+id).hide();
			//$('.warehouse_name_'+id).hide();
			$('.section_delete_'+id).hide();
			
			//$('.display_warehouse_'+id).show();
			$('.edit_section_count_'+id).show();
			//$('.edit_rack_name_'+id).show();
			$('.section_update_'+id).show();
			$('.section_cancel_'+id).show();
			
			$('select[name^="select_warehouse"] option[value='+wID+']').attr("selected","selected");
			$('select[name^=select_rack_'+id+'] option[value='+rID+']').attr("selected","selected");
			
			
		}
		
		function cancel_edit(id)
		{
			//$('.rack_name_'+id).show();
			$('.section_count_'+id).show();
			$('.editSection_'+id).show();
			//$('.warehouse_name_'+id).show();
			$('.section_delete_'+id).show();
			
			//$('.display_warehouse_'+id).hide();
			$('.edit_section_count_'+id).hide();
			//$('.edit_rack_name_'+id).hide();
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
	var sectionVal		=	$('.edit_section_count_'+id).val();
	
		
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/section_update',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"sectionId":' + id + ',"warehouseId": '+warehouseId+',"sectionval" :'+sectionVal+'}'
            
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
