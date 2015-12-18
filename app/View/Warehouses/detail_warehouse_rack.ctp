<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo $getWarehouseDetail['Warehouse']['warehouse_name'].'('. $role.')';?></h1>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
		<div class="row">
                        <div class="col-lg-12">
							<div class="panel no-border ">
                                <div class="panel-title bg-white no-border">									
									<div class="panel-tools">																	
									</div>
								</div>
                                <div class="panel-body no-padding-top bg-white">
													
<!----------------------------------------Show Rack, section, Level and bin on view start------------------------------>
								<div class="warehouse" data-rack_id="0">
									<?php foreach($getWarehouseDetail['WarehouseRack'] as $Racks) {  if($Racks['is_deleted'] == 0) { ?>
									<h1><?php echo $Racks['warehouse_rack_label']; ?></h1>
									<div class="table-responsive">
									<table class="rack" ><tr>
									<?php foreach($getWarehouseDetail['WarehouseSection'] as $section) { ?>
									<?php if($section['warehouse_id'] == $getWarehouseDetail['Warehouse']['id'] && $section['warehouse_rack'] == $Racks['id']) { ?>
									<?php for($j=1; $j <=$section['section_label']; $j++) {	?>
										<td  class="section" valign="top" height="100%" >
										<table height="100%" class="levelSection" >
											<tr><td class="command add_level"><i class="fa fa-plus-circle"></i> level</td></tr>
											<tr><td height="100%" >
											<table class="levelTable" height="100%" width="100%" >
												<?php foreach($getWarehouseDetail['WarehouseLevel'] as $level) { ?>
												<?php  if($section['warehouse_rack'] == $Racks['id'] && $section['warehouse_id'] == $level['warehouse_id'] && $section['warehouse_rack'] == $level['warehouse_rack'] && $level['warehouse_section'] == $j) { ?>
												<?php  for($i = 1; $i <= $level['warehouse_level']; $i++) { ?>
												<tr><td valign="bottom" class="level">
												<div class="rotate"><?php echo 'Level'. $i; ?></div>
												<a data-url="#" class="command" href="#">✖</a>
												<table width="100%" >
													<tr>
													<?php foreach($getWarehouseDetail['WarehouseBin'] as $bin) { ?>
														<?php  if($bin['warehouse_level'] == $i && $bin['warehouse_section'] == $j && $bin['warehouse_rack'] == $Racks['id'] && $bin['warehouse_id'] == $getWarehouseDetail['Warehouse']['id'] && $bin['is_deleted'] == '0') {  ?>
														<td class="bin bin_<?php echo $bin['id']; ?>"><a data-url="#" class="command delBin" href="javascript:void(0);" onclick="delete_bin(<?php echo $bin['id']; ?>)">✖</a><a data-content="Bin Label: <?php echo $bin['bin_label']; ?>" title="" data-toggle="popover" href="#" data-original-title="Bin ID: <?php echo $bin['bin_unique_id']; ?>"><i class="fa fa-archive"></i></a></td>
														<?php } } ?>
												</tr></table>
											</td></tr>
							<?php } } } ?>
						</table>
					</td></tr>
				<tr><td style="height:1px;" class="command del_section" onclick="remove_section( <?php echo $getWarehouseDetail['Warehouse']['id']; ?>,<?php echo $Racks['id']; ?>,<?php echo $section['id']?>)" data-url="#"><i class="fa fa-minus-circle"></i> <?php echo 'Section' .$j; ?><input type="hidden" class="section_id_<?php echo $Racks['id']; ?>" value="<?php echo $section['id']?>" /></td></tr>
			</table>
		</td>
			<?php } } } ?>
  			 <td  data-target="" class="add_section"><i class="fa fa-plus-circle"></i><a data-target="" data-toggle="modal" href="#" onclick="add_section( <?php echo $getWarehouseDetail['Warehouse']['id']; ?>,<?php echo $Racks['id']; ?>)" > Section </a></td>
	</tr></table></div>   
<?php } } ?>


						

<!----------------------------------------Show Rack, section, Level and bin on view end-------------------------------->
				
								</div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /. row -->
				<!-- BEGIN FOOTER -->
				<?php //echo $this->element('footer'); ?>
				<!-- END FOOTER -->
            </div>
    </div>
</div>
<script>

 //~ function delete_bin(id)
 //~ {
	 //~ swal({
        //~ title: "Are you sure?",
        //~ text: "You want to delete Bin !",
        //~ type: "warning",
        //~ showCancelButton: true,
        //~ confirmButtonColor: "#DD6B55",
        //~ confirmButtonText: "Yes, delete it!",
        //~ cancelButtonText: "No, cancel!",
        //~ closeOnConfirm: false,
        //~ closeOnCancel: false
    //~ },
    //~ function(isConfirm)
    //~ {
		//~ 
        //~ /* isConfirm tell us true or false */
        //~ if (isConfirm)
        //~ {
            //~ 
		//~ $.ajax(
            //~ {
                //~ url     : getUrl() + '/jijGroup/server/warehouse/bin_delete',
                //~ type    : 'POST',
                //~ data    : {binId : id },
                //~ success :	function( data  )
                //~ {
					//~ $('.bin_'+id).remove();
				    //~ swal("Bin Deleted", "" , "success");
                    //~ return false;
                //~ }                
            //~ });           
        //~ }
        //~ else
        //~ {
            //~ swal("Cancelled", "Your bin is safe :)", "error");
        //~ }
    //~ });
 //~ }
 //~ 
 //~ function add_section( wid, rid )
 //~ {
	 //~ 
	 //~ var sid = $('.section_id_'+rid).val();
	//~ 
	 //~ $.ajax(
            //~ {
                //~ url     : getUrl() + '/jijGroup/server/warehouse/add_section',
                //~ type    : 'POST',
                //~ data    : { wId : wid, rid : rid, sid : sid },
                //~ success :	function( data  )
                //~ {
				    //~ location.reload();
                //~ }                
            //~ });
 //~ }
 //~ */

</script>




