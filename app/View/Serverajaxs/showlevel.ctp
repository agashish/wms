<!--<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>-->

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php  $k = 0; foreach($getLevelDetails as $getLevelDetail) { 
		 	$i= 0;	foreach($getLevelDetail['WarehouseRack'] as $racks) {
		?>
		
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne_<?php echo $i .'_'. $k; ?>">
      <h4 class="panel-title">
        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $i.'_'.$k; ?>" aria-expanded="true" aria-controls="collapseOne_<?php echo $i.'_'.$k; ?>">
          <?php echo $getLevelDetail['Warehouse']['warehouse_name'].':'. $racks['warehouse_rack_label'] ?>
        </a>
      </h4>
    </div>
    <div id="collapseOne_<?php echo $i.'_'.$k; ?>" class="panel-collapse collapse <?php if($i == 0 && $k == 0) echo 'in'; ?>" role="tabpanel" aria-labelledby="headingOne_<?php echo $i.'_'.$k; ?>">
      <div class="panel-body">
		  <table id="" width="100%" cellspacing="0" class="table table-striped no-footer" role="grid" style="width: 100%;">
		  <thead>
			 <tr>
				<th>Section No.</th>
				<th>Level</th>
				<th>Action</th>
			 </tr>
		  </thead>
          <tbody >
	    <?php 
        foreach($getLevelDetail['WarehouseSection'] as $section) {
			
			for($j = 1; $j <= $section['section_label']; $j++)
				{
					if($section['warehouse_id'] == $racks['warehouse_id'] && $section['warehouse_rack'] == $racks['id'])
					{
					
					foreach($getLevelDetail['WarehouseLevel'] as $level) 
						{
							if($section['warehouse_rack'] == $racks['id'] && $section['warehouse_id'] == $level['warehouse_id'] && $section['warehouse_rack'] == $level['warehouse_rack'] && $level['warehouse_section'] == $j && $level['is_deleted'] == 0)
								{
									echo '<tr class="level_row_'.$level['id'].'"><td>Section'. $j;
									echo '<td><span class="level_no_'.$level['id'].'">'.$level['warehouse_level'].'</span>';
									echo '<input type="text" style="display:none;" value="'.$level['warehouse_level'].'"  class="form-control margin-bottom-20 lavel_value_'.$level['id'].'"/></td>';
									echo '<td><ul id="icons" class="iconButtons"><a class="btn btn-success btn-xs margin-right-10 update_button_'.$level['id'].'" title="Edit" onclick="update_level('.$level['id'].')"><i class="fa fa-pencil"></i></a>';
									echo '<a class="btn btn-success btn-xs margin-right-10 ok_value_'.$level['id'].'" title="Edit" style="display:none" onclick="updatelevel_value('.$level['id'].')"><i class="fa fa-check"></i></a>';
									echo '<a class="btn btn-danger btn-xs margin-right-10 cancel_value_'.$level['id'].'" title="cancel" style="display:none" onclick="cancel_update_level( '.$level['id'].')"><i class="fa fa-close"></i></a>';
									echo '<a class="btn btn-danger btn-xs margin-right-10 delete_botton_'.$level['id'].'" alt="Delete" onclick="delete_level( '.$level['id'].' )"><i class="ion-minus-circled minus_'.$level['id'].'"></i></a></ul>';
								}
						}
						
					}
					
				}
				
			}
			echo '</tr></tbody></table>';
	     ?>
	</div>
  </div>
  </div>
  <?php $i++; $k++; } } ?>
</div>
