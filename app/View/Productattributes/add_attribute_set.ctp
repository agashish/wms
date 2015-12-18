<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php //print $role;?></h1>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
	 </div>
    <div class="container-fluid">
        <div class="row">
						<?php
							print $this->form->create( 'AttributeSet', array( 'class'=>'form-horizontal', 'url' => '/Productattributes/saveattributeset', 'type'=>'post' ) );
							print $this->form->input( 'AttributeSet.attribute_id', array( 'type'=>'hidden', 'class'=>'attribute_id' ) );
							print $this->form->input( 'AttributeSet.set_value', array( 'type'=>'hidden','class'=>'set_value' ) );
							print $this->form->input( 'AttributeSet.id', array( 'type'=>'hidden' ) );
						?>
		    <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Attribute Set</div>
						</div>
					<div class="panel-body">
                    <div class="row">
						
						<div class="form-group">
						<label for="username" class="control-label col-lg-3"> Attribute Set </label> 
							 <div class="col-lg-8">                                            
								<?php
									print $this->form->input( 'AttributeSet.set_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false) );
								?>
							 </div>
						 </div>
                                     
                        <div class="col-lg-12">
							<?php
								print $this->form->input( '', array( 'type'=>'select','name'=>'selectfrom', 'id'=>'select-from','multiple size' => '8','options'=>$allattributes,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							?>
							<a href="JavaScript:void(0);" id="btn-add">Add &raquo;</a>
							<a href="JavaScript:void(0);" id="btn-remove">&laquo; Remove</a>
							<?php
								print $this->form->input( '', array( 'type'=>'select','name'=>'selectto', 'id'=>'select-to','multiple size' => '8','options'=>'','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							?>
						</div>
						
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                               	<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/Productattributes/addAttribute">Go Back</a>
                               	<?php
									echo $this->Form->button('Add Attribute Set', array(
										'type' => 'submit',
										'escape' => true,
										'class'=>'add_attributeset btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										 ));	
								?>
						</div>
					</div>
				</div>
			</form>
	    </div>
	    
	    <!----------------------------------------Left UI---------------------------------------------------->
	    <div class="col-lg-7">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head">All Attribute Sets</div>
					<div class="panel-tools">
						<a class="add_fieldset_new" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body">
					<table class="table table-bordered table-striped" id="example1" aria-describedby="example1_info">
										<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">S.no.</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Set Name</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
											</tr>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php		$i = 1;											
													foreach( $attributeset as $setdesc ) { 
													$id	=	$setdesc['AttributeSet']['id'];
										?>
                                            <tr class="odd row_<?php print $id; ?>" >
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $setdesc['AttributeSet']['set_name']; ?></td>
												<td>
													<ul id="icons" class="iconButtons">
														<a href="/wms/Productattributes/editArrributeSet/<?php print $id; ?>"  class="edit_content_<?php print $id; ?> btn btn-success btn-xs margin-right-10" title="Edit Attribute Option"><i class="fa fa-pencil"></i></a>
														<a href="javascript:void(0);" for = "<?php echo $id; ?>" class="delete_attribute_set btn btn-warning btn-xs margin-right-10 delete_cancel_<?php print $id; ?>" title="Deleted Attribute Option"><i class="fa fa-times"></i></a>
													</ul>
												</td>	
										    </tr>
                                    <?php $i++;  } ?>
										</tbody>
									</table>	
							</div>
						</div>
					</div>
	</div>     
</div>



<script>
	
$(document).ready(function() {
	
	$('.set_value').val('');
	$('.attribute_id').val('');
					
    $('#btn-add').click(function(){
		var blkstr = [];
		var blkstrID = [];
        $('#select-from option:selected').each( function() {
                $('#select-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
         $('#select-to option').each( function() {
					blkstr.push($(this).text());
					blkstrID.push($(this).val());
					$('.set_value').val('');
					$('.attribute_id').val('');
				});
					var skuStr	=	blkstr.join("---");
					$('.set_value').val(skuStr);
						
					var skuStrid	=	blkstrID.join("---");
					$('.attribute_id').val(skuStrid);
    });
    
    
    $('#btn-remove').click(function(){
		var blkstr = [];
		var blkstrID = [];
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
        $('#select-to option').each( function() {
                
					blkstr.push($(this).text());
					blkstrID.push($(this).val());
					$('.set_value').val('');
					$('.attribute_id').val('');
                
				});
					var skuStr	=	blkstr.join("---");
					$('.set_value').val(skuStr);
						
					var skuStrid	=	blkstrID.join("---");
					$('.attribute_id').val(skuStrid);
        
						
    });
    
    /* start, function use for delete the attribute set */
    
    $('body').on('click', '.delete_attribute_set', function(){

	var id = $(this).attr('for');
	swal({
					title: "Are you sure?",
					text: "You want to delete attribute set !",
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
							url     : getUrl() + '/Productattributes/deleteattributeset',
							type    : 'POST',
							data    : { id : id },
							success : function( msgArray  )
							{
								swal("Attribute set deleted successfully.", "" , "success");
								location.reload();
							}                
						});
		}
		else
        {
            swal("Cancelled", "Your attribute set is safe :)", "error");
        }
		
		});
		
		
	});
    
    /* end, function use for delete the attribute set */
    
 
});

</script>
