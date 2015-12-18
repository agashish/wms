
<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title">Add Options</h1>
			<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="btn btn-success" href="/wms/Productattributes/addAttribute" data-toggle="modal" data-target=""><i class="fa fa-tasks"></i> Attributes </a>
							</li>
						</ul>
					</div>	
			</div>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
				<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			</div>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
				<?php
					print $this->form->create( 'AttributeOption', array( 'class'=>'form-horizontal', 'url' => '/Productattributes/addattributeoption', 'type'=>'post','id'=>'warehouse' ) );
					print $this->form->input( 'AttributeOption.attribute_id', array( 'type'=>'hidden', 'value' => $getAttribute['Attribute']['id']) );
				?>
            <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Attribute Option</div>
							<div class="panel-tools">
								<a href="javascript:void(0);" style="" id="btnAdd" class="add_fieldset_new" onclick="add_text_box();" title="Add More Option"><i class="fa fa-plus-circle"></i></a>
							</div>
						</div>
						
					<div class="panel-body">
                    <div class="row">
					    <div class="col-lg-12">
								<div class="option_textbox" >
							      <div class="form-group" >
                                    <label for="username" class="control-label col-lg-3">Option</label>                                        
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
                               	<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/Productattributes/addAttribute">Go Back</a>
                               	<?php
									echo $this->Form->button('Add Attribute Option', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'add_attribute btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										 ));	
								?>
						</div>
					</div>
	        </div><!-- /.col -->
			</form>
	    </div><!-- /.row -->
		<div class="col-lg-7">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head">All Attribute Options</div>
				</div>
                <div class="panel-body">
					<table class="table table-bordered table-striped" id="example1" aria-describedby="example1_info">
										<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Attribute</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Name</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
											</tr>
										</thead>
										<?php //pr($getAttribute); ?>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php	$i = 1;											
											foreach( $allAttributesOptions as $allAttributes ) { 
													foreach($allAttributes['AttributeOption'] as $allAttributesOption) {
													$id = $allAttributesOption['id'];
										?>
                                            <tr class="odd row_<?php print $id; ?>" >
												<td class="  sorting_1"><?php echo $allAttributes['Attribute']['attribute_label']; ?></td>
												<td>
												<span class="sorting_1 hide_column_<?php print $id; ?>">
													<?php 
													echo $allAttributesOption['attribute_option_name']; 
													?>
													</span>
													<span class="sorting_1 show_column_<?php print $id; ?>" style="display:none;">
												<?php 
													print $this->form->input( 'AttributeOption.attribute_option_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control name_value_'.$id.'', 'required'=>false, 'value' =>  $allAttributesOption['attribute_option_name']) );
												?>
												</span>
												</td>
												<td>
													<ul id="icons" class="iconButtons">
														<a href="javascript:void(0);" onclick="show_edit_content(<?php print $id; ?>);" class="edit_content_<?php print $id; ?> btn btn-success btn-xs margin-right-10" title="Edit Attribute Option"><i class="fa fa-pencil"></i></a>
														<a href="javascript:void(0);" onclick="edit_content(<?php print $id; ?>);" class="edit_action_<?php print $id; ?> btn btn-success btn-xs margin-right-10" title="Edit Attribute Option" style="display:none;"><i class="fa fa-check"></i></a>
														<a href="javascript:void(0);" onclick="cancel_edit_content(<?php print $id; ?>)" class="btn btn-xs btn-danger edit_cancel_<?php print $id; ?>" style="display:none;" title="close" ><i class="fa fa-close"></i></a>
														<a href="javascript:void(0);" onclick="delete_option(<?php print $id; ?>)" class="btn btn-warning btn-xs margin-right-10 delete_cancel_<?php print $id; ?>" title="Deleted Attribute Option"><i class="fa fa-times"></i></a>
													</ul>
												</td>	
										    </tr>
										<?php $i++; } } ?>
										</tbody>
									</table>	
							</div>
						</div>
					</div>
				</div>     
			</div>
<script>

	function add_text_box()
	{
		var getHtml	=	$('.option_textbox').html();
		$('.option_textbox').after(getHtml);
		
	}

	function show_edit_content( id )
	{
		
		$('.show_column_'+id).show();
		$('.edit_action_'+id).show();
		$('.edit_cancel_'+id).show();
		
		$('.hide_column_'+id).hide();
		$('.edit_content_'+id).hide();
		$('.delete_cancel_'+id).hide();
	}
	
	function cancel_edit_content(id)
	{
		
		$('.show_column_'+id).hide();
		$('.edit_action_'+id).hide();
		$('.edit_cancel_'+id).hide();
		
		$('.hide_column_'+id).show();
		$('.edit_content_'+id).show();
		$('.delete_cancel_'+id).show();
		
	}
	
	function edit_content( id )
	{
		/* Start here updating section */
		
		var optionName	=	$('.name_value_'+id).val();
		
          $.ajax(
            {
                url     : getUrl() + '/Productattributes/editOption',
                type    : 'POST',
                data    : { id : id, optionName : optionName },
                success : function( msgArray  )
                {
					$('.show_column_'+id).hide();
					$('.edit_action_'+id).hide();
					$('.edit_cancel_'+id).hide();
		
					$('.hide_column_'+id).show();
					$('.edit_content_'+id).show();
					$('.delete_cancel_'+id).show();
					$('.hide_column_'+id).text(optionName);
					$('.panel-head').html('<span>Attribute option updated successfully.</span>');
					
                }                
            }); 
	}
	
	function delete_option( id )
	{
		swal({
					title: "Are you sure?",
					text: "You want to delete attribute option !",
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
				 $.ajax({
							url     : getUrl() + '/Productattributes/deleteoption',
							type    : 'POST',
							data    : { id : id },
							success : function( msgArray  )
							{
								$('.row_'+id).remove();
								if(msgArray == 1)
								{
									swal("Option deleted successfully.", "" , "success");
								}
							}                
						});
		}
		else
        {
            swal("Cancelled", "Your option is safe :)", "error");
        }
		
		});
		
		
		
	}
	
	/*$('body').on('click', '.add_attribute', function(event){
		
		var textValue = $('#AttributeOptionAttributeOptionName').val();
		if(textValue == '')
		{
			$('.panel-head').html('<span>Please fill the text field value.</span>');
			event.preventDefault();
		}
		});*/

</script>
