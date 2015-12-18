<table class="table table-bordered table-striped dataTable" >
	<tr>
		<th>OrderID</th>
		<th>Order Date</th>
		<th>Postal Service</th>
		<th>Name</th>
		<th>Source</th>
		<th>Product</th>
		<th>Action</th>
	</tr>
<?php  foreach($express1 as $exp ) { $exqty = 0; ?>
		<tr>
			<td><?php echo $exp['Order']['num_order_id']; ?></td>
			<td><?php echo $exp['Order']['received_date']; ?></td>
			<td><?php echo $exp['Order']['postal_service']; ?></td>
			<td><?php echo $exp['Order']['customer_name']; ?></td>
			<td><?php echo $exp['Order']['source']; ?></td>
			<td><input class="itemcount" type="hidden" value="<?php echo count($exp['Item']); ?>" /><?php foreach($exp['Item'] as $expitem ) {   
					$exqty = $exqty + $expitem['quantity'];
			 } echo $exqty; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $exp['Order']['pk_order_id']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php  } ?>

<?php foreach($tracked1 as $tra ) {  $traqty = 0  ?>
		<tr>
			<td><?php echo $tra['Order']['num_order_id']; ?></td>
			<td><?php echo $tra['Order']['received_date'] ?></td>
			<td><?php echo $tra['Order']['postal_service'] ?></td>
			<td><?php echo $tra['Order']['customer_name']; ?></td>
			<td><?php echo $tra['Order']['source']; ?></td>
			<td>
			<?php foreach($tra['Item'] as $traitem ) {   
					$traqty = $traqty + $staitem['quantity'];
			 } echo $traqty; ?>
			</td>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $tra['Order']['pk_order_id']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>

<?php foreach($standerd1 as $sta ) {  $stqty = 0 ?>
		<tr>
			<td><?php echo $sta['Order']['num_order_id']; ?></td>
			<td><?php echo $sta['Order']['received_date'] ?></td>
			<td><?php echo $sta['Order']['postal_service'] ?></td>
			<td><?php echo $sta['Order']['customer_name']; ?></td>
			<td><?php echo $sta['Order']['source']; ?></td>
			<td>
			<?php foreach($sta['Item'] as $staitem ) {   
					$stqty = $stqty + $staitem['quantity'];
			 } echo $stqty; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $sta['Order']['pk_order_id']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>

</table>
<script>
$(function() {
	$('table tbody tr:nth-child(2)').css('background-color','#c4ebff');
});
</script>



