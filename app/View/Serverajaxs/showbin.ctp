	<table id="" class="display table" cellspacing="0" width="100%">
	  <thead>
		 <tr>
			<th>Bin Label</th>
			<th>Bin Unique ID</th>
			<th>Action</th>
		 </tr>
	  </thead>
	  <tbody>
		<?php foreach($getBinDetails as $getBinDetail) { ?>
		 <tr class="whole_row_<?php echo $getBinDetail['WarehouseBin']['id']; ?>">
			<td class="display_bin_value_<?php echo $getBinDetail['WarehouseBin']['id']; ?>">
				<?php echo $getBinDetail['WarehouseBin']['bin_label']; ?>
			</td>
			<td style="display:none;" class="dis_bin_value_<?php echo $getBinDetail['WarehouseBin']['id']; ?>" >
			<input type="text" value="<?php echo $getBinDetail['WarehouseBin']['bin_label']; ?>" class="form-control input-sm bin_value_<?php echo $getBinDetail['WarehouseBin']['id']; ?>"/>
			</td>
			<td><?php echo $getBinDetail['WarehouseBin']['bin_unique_id']; ?></td>
			<td>
				<button type="button" class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40 editBin_<?php echo $getBinDetail['WarehouseBin']['id']; ?>" onclick = "edit_bin( <?php echo $getBinDetail['WarehouseBin']['id']; ?> )" >Edit</button>	
				<button class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40 bin_update_<?php echo $getBinDetail['WarehouseBin']['id']; ?>" style="display:none;" onclick="edit_bin_update( <?php echo $getBinDetail['WarehouseBin']['id']; ?> );">Update</button>
				<button class="btn btn-danger bin_cancel_<?php echo $getBinDetail['WarehouseBin']['id']; ?>" style="display:none;" onclick = "cancel_edit_bin( <?php echo $getBinDetail['WarehouseBin']['id']; ?> )">Cancel</button>
				<button class="btn btn-danger bin_delete_<?php echo $getBinDetail['WarehouseBin']['id']; ?>" onclick = "delete_bin( <?php echo $getBinDetail['WarehouseBin']['id']; ?> )">Delete</button>
			</td>
		 </tr>
		<?php } ?>
	  </tbody>
	</table>
<script>
	
$('table.display').dataTable();

</script>
