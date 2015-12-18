<div class="form-group">
	<label for="username" class="control-label col-lg-3">Floor Level</label>                                        
	<div class="col-lg-7">                                            
		<?php
		if(count($packageType) > 0)
			print $this->form->input( 'groundFloor', array( 'type'=>'select', 'empty'=>'Choose Floor Level', 'div'=>false,'options'=> $setNewGroundArray, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
		?>
	</div>
</div>
