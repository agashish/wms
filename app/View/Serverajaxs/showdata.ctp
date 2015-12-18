	<div class="panel-body" >
      <table width="100%" cellspacing="0" class="display table dataTable table-striped no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info" style="width: 100%;">
               <thead>
                   <tr role="row">
					   <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 233px;" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Warehouse Name</th>
					   <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 164px;" aria-label="Rack Name.: activate to sort column ascending">Rack Name</th>
					   <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 122px;" aria-label="Section: activate to sort column ascending">Section</th>
					   <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 213px;" aria-label="Action: activate to sort column ascending">Action</th>
				   </tr>
                    </thead>
                    <tbody>
						<?php foreach($getSectionDetail as $detail) {  ?>
							<tr role="row" class="odd row_id_<?php echo $detail['WarehouseSection']['id']; ?>">
                                    <td class="sorting_1">
										<?php echo $detail['Warehouse']['warehouse_name']; ?>
										<?php									    
											if( count( $this->Common->getWarehouseList()) > 0 )
												{
													$list = $this->Common->getWarehouseList();	
													print $this->form->input( 'warehouse.warehouse_id', array( 'type'=>'select','empty'=>'Choose','options'=>$list,'class'=>'form-control get_warehouse display_warehouse_'.$detail['WarehouseSection']['id'], 'style'=>'display:none;','div'=>false, 'label'=>false, 'required'=>false,'name'=>'select_warehouse') );
												}
										?>  
                                 	</td>
                                    <td>
										<?php echo $detail['WarehouseRack']['warehouse_rack_label']; ?>
										<select class="form-control rack_class_select rack_for_section edit_rack_name_<?php echo $detail['WarehouseSection']['id']; ?>" style="display:none;" name="select_rack_<?php echo $detail['WarehouseSection']['id']; ?>">
											<option value="">Choose Rack</option>
										</select>
									</td>
                                    <td>
										<span class="section_count_<?php echo $detail['WarehouseSection']['id']; ?> " ><?php echo ($detail['WarehouseSection']['section_label'] ? $detail['WarehouseSection']['section_label'] : 'N/A'); ?></span>
										<input type="text" placeholder="Edit Section" style="display:none;" class="form-control margin-bottom-20 edit_section_count_<?php echo $detail['WarehouseSection']['id']; ?>" value="<?php echo $detail['WarehouseSection']['section_label']; ?>" >  
									</td>
                                    <td><ul class="iconButtons" id="icons">
										<?php if($detail['WarehouseSection']['section_label'] == '') { ?>
										
										<a class="addSectioncontent btn btn-xs btn-success margin-right-10" href="#addSection" data-toggle="tab"><i class="fa fa-plus"></i></a>
										<?php }	else { ?>
										<a href="#" class="btn btn-xs bg-orange-500 color-white btn-dark margin-right-10 editSection_<?php echo $detail['WarehouseSection']['id']; ?>" onclick = "edit_section( <?php echo $detail['WarehouseSection']['id']; ?>, <?php echo $detail['Warehouse']['id'] ?>, <?php echo $detail['WarehouseRack']['id'] ?> )" ><i class="fa fa-pencil"></i></a>
										<?php } ?>
										<a href="#" class="btn btn-xs btn-danger section_delete_<?php echo $detail['WarehouseSection']['id']; ?>" onclick = "delete_section( <?php echo $detail['WarehouseSection']['id']; ?> )" ><i class="ion-minus-circled"></i></a>
										<a href="#" class="btn btn-xs bg-orange-500 color-white btn-dark margin-right-10 section_update_<?php echo $detail['WarehouseSection']['id']; ?>" style="display:none;" onclick="edit_section_update( <?php echo $detail['WarehouseSection']['id']; ?> );"><i class="fa fa-check"></i></a>
										<a href="#" class="btn btn-xs btn-danger section_cancel_<?php echo $detail['WarehouseSection']['id']; ?>" style="display:none;" onclick = "cancel_edit( <?php echo $detail['WarehouseSection']['id']; ?> )"><i class="fa fa-close"></i></a>
								
										
										</ul>
                                    </td>
                             </tr>
                               <?php } ?>
                         </tbody>
       </table>
	</div>
