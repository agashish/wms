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
<?php foreach($express1 as $exp ) { $exqty = 0; ?>
		 <tr>
			<td><?php echo $exp['NumOrderId']; ?></td>
			<td><?php echo $exp['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $exp['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $exp['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $exp['GeneralInfo']['Source']; ?></td>
			<td><input class="itemcount" type="hidden" value="<?php echo count($exp['Items']); ?>" /><?php foreach($exp['Items'] as $expitem ) { 
					$exqty = $exqty + $expitem['Quantity'];
			 } echo $exqty; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $exp['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>

<?php foreach($tracked1 as $tra ) {  $traqty = 0; ?>
		<tr>
			<td><?php echo $tra['NumOrderId']; ?></td>
			<td><?php echo $tra['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $tra['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $tra['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $tra['GeneralInfo']['Source']; ?></td>
			<td>
			<?php foreach($tra['Items'] as $traitem ) {   
					$traqty = $traqty + $traitem['Quantity'];
			 } echo $traqty; ?>
			</td>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $tra['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>

<?php foreach($standerd1 as $sta ) {  $stqty = 0 ?>
		<tr>
			<td><?php echo $sta['NumOrderId']; ?></td>
			<td><?php echo $sta['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $sta['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $sta['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $sta['GeneralInfo']['Source']; ?></td>
			<td>
			<?php foreach($sta['Items'] as $staitem ) {   
					$stqty = $stqty + $staitem['Quantity'];
			 } echo $stqty; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $sta['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>

<!-------------------------------------------- Start Code for group 2 ------------------------------------------>

<?php foreach($express2 as $exp2 ) { $exqty2 = 0; ?>
		 <tr>
			<td><?php echo $exp2['NumOrderId']; ?></td>
			<td><?php echo $exp2['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $exp2['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $exp2['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $exp2['GeneralInfo']['Source']; ?></td>
			<td><input class="itemcount" type="hidden" value="<?php echo count($exp2['Items']); ?>" /><?php foreach($exp2['Items'] as $expitem2 ) { 
					$exqty2 = $exqty2 + $expitem2['Quantity'];
			 } echo $exqty2; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $exp2['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>


<?php foreach($tracked2 as $tra2 ) {  $traqty2 = 0; ?>
		<tr>
			<td><?php echo $tra2['NumOrderId']; ?></td>
			<td><?php echo $tra2['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $tra2['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $tra2['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $tra2['GeneralInfo']['Source']; ?></td>
			<td>
			<?php foreach($tra2['Items'] as $traitem2 ) {   
					$traqty2 = $traqty2 + $traitem2['Quantity'];
			 } echo $traqty2; ?>
			</td>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $tra2['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>



<?php foreach($standerd2 as $sta2 ) {  $stqty2 = 0 ?>
		<tr>
			<td><?php echo $sta2['NumOrderId']; ?></td>
			<td><?php echo $sta2['GeneralInfo']['ReceivedDate']; ?></td>
			<td><?php echo $sta2['ShippingInfo']['PostalServiceName']; ?></td>
			<td><?php echo $sta2['CustomerInfo']['Address']['FullName']; ?></td>
			<td><?php echo $sta2['GeneralInfo']['Source']; ?></td>
			<td>
			<?php foreach($sta2['Items'] as $staitem2 ) {   
					$stqty2 = $stqty2 + $staitem2['Quantity'];
			 } echo $stqty2; ?>
			</td>
			<td><a class="btn btn-xs btn-success" href="/wms/linnworksapis/confirmBarcode/<?php echo $sta2['NumOrderId']; ?>" ><i class="ion-clipboard"></i></td>
		</tr>
<?php } ?>
<!-------------------------------------------- End Code for group 2 ------------------------------------------>
</tbody>
</table>
<script>
$(function() {
	$('table tbody tr:nth-child(2)').css('background-color','#c4ebff'); 	
});
</script>


