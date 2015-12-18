<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
			<div class="submenu">
					<div class="navbar-header">
			</div>	
				</div>
			
				<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			
    </div>
    <!-- END PAGE HEADING -->
    
    
    
    <div class="container-fluid">
		<?php if(isset($attributeId)) {  ?>
		<?php echo $this->element('add_option'); } else { ?>
		<?php echo $this->element('add_attribute'); } ?>
		
      <div class="col-lg-7">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head"> All Attributes</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body attr_show">
					<table class="table table-bordered table-striped" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Type</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
											</tr>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?php												
												$i = 1;foreach( $allAttributes as $allAttribute ) {
												$id = $allAttribute['Attribute']['id'];
												$alertClass = ( $allAttribute['Attribute']['is_deleted'] == 1 ) ? "alert-danger" : "";
												$status = ( $allAttribute['Attribute']['status'] == 0 ) ? "Active" : "Deactive";
											?>
                                            <tr class="odd <?php print $alertClass; ?>">
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_name']; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_type']; ?></td>                                                
												<td>
														<ul id="icons" class="iconButtons">
														<a href="editarrribute/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10" title="Edit Attribute"><i class="fa fa-pencil"></i></a>
														
														<?php if( $allAttribute['Attribute']['status'] == 1 ) { ?>
															<a href="lockUnlockAttr/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-info btn-xs margin-right-10" title="Deactive Attribute" ><i class="fa fa-unlock"></i></a>
														<?php } else { ?>
															<a href="lockUnlockAttr/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-info btn-xs margin-right-10" title="Active Attribute"><i class="fa fa-lock"></i></a>
														<?php }	?>
															<a href="deleteAttr/<?php print $id; ?>/<?php print $allAttribute['Attribute']['is_deleted']; ?>" class="btn btn-danger btn-xs margin-right-10" title="Retrieved Attribute"><i class="fa fa-close"></i></a>
															<a href="addoptions/<?php print $id; ?>" class="btn btn-warning btn-xs margin-right-10" title="Add Attribute Option"><i class="fa fa-navicon"></i></a>
														</ul>
												</td>	
										    </tr>
                                    <?php $i++; } ?>
										</tbody>
									</table>	
							</div>
						</div>
					</div>
				</div>        
			</div>
	<?php if( isset($currentdata) ) {
	if($currentdata['Attribute']['attribute_type'] == 'Text' || $currentdata['Attribute']['attribute_type'] == 'Text Area') { ?>
		<script>
			$('.add_fieldset_new').hide();
		</script>
	<?php } } ?>

	<script>
	
	function add_text_box()
	{
		var getHtml	=	$('.option_textbox').html();
		$('.option_textbox').after(getHtml);

	}

	</script>

