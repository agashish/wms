<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
       	<div class="panel-title no-radius bg-green-500 color-white no-border">
				<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			</div>
	 </div>
    <div class="container-fluid">
        <div class="row">
						<?php
							print $this->form->create( 'AttributeSet', array( 'class'=>'form-horizontal', 'url' => '/Productattributes/editattributeset', 'type'=>'post' ) );
							print $this->form->input( 'AttributeSet.attribute_id', array( 'type'=>'hidden', 'class'=>'attribute_id' ) );
							print $this->form->input( 'AttributeSet.set_value', array( 'type'=>'hidden','class'=>'set_value' ) );
							print $this->form->input( 'AttributeSet.id', array( 'type'=>'hidden', 'value' => $attributeset['AttributeSet']['id'] ) );
						?>
						
            <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Edit Attribute Set</div>
						</div>
					<div class="panel-body">
                    <div class="row">
						
						<div class="form-group">
						<label for="username" class="control-label col-lg-3"> Attribute Set </label> 
							 <div class="col-lg-8">                                            
								<?php
									print $this->form->input( 'AttributeSet.set_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'value' => $attributeset['AttributeSet']['set_name']) );
								?>
							 </div>
						 </div>
                                    <?php $attrributeafterdiff = array_diff($allattributes, $attributevalue );   ?>
                        <div class="col-lg-12">
							<?php
								print $this->form->input( '', array( 'type'=>'select','name'=>'selectfrom', 'id'=>'select-from','multiple size' => '8','options'=>$attrributeafterdiff,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							?>
							<a href="JavaScript:void(0);" id="btn-add">Add &raquo;</a>
							<a href="JavaScript:void(0);" id="btn-remove">&laquo; Remove</a>
							<?php
								print $this->form->input( '', array( 'type'=>'select','name'=>'selectto', 'id'=>'select-to','multiple size' => '8','options'=>$attributevalue,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							?>
						</div>
						
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                               	<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/attribute">Cancel</a>
                               	<?php
									echo $this->Form->button('Edit Attribute Set', array(
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
	</div>     
</div>


<script>
$(document).ready(function() {
	
	var blkstr = [];
	var blkstrID = [];
	
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
			
					
					
	//$('.set_value').val('');
	//$('.attribute_id').val('');
					
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
 
});

</script>
