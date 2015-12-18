<div class="modal fade pop-up-4" tabindex="-1" role="dialog" id="pop-up-4" aria-labelledby="myLargeModalLabel-4" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title color-white" id="myLargeModalLabel-3">View Warehouse</h4>
			</div>
			<div class="modal-body bg-grey-100">
				<div class="row">
					<div class="col-lg-12 margin-bottom-20" id="popup-scroller4">
						<div class="text-center margin-bottom-20 border-bottom-1 border-grey-100">
							<h2 class="color-grey-700 margin-top-10 bold"><?php echo $detail['Warehouse']['warehouse_name']; ?></h2>
							<h4 class="text-light no-margin-top margin-bottom-10"><?php echo $detail['City']['city_name']; ?>, <?php echo $detail['State']['state_name']; ?>, <?php echo $detail['Location']['county_name']; ?></h4>
							<h4 class="text-light no-margin-top margin-bottom-20">Phone: <?php echo $detail['WarehouseDesc']['warehouse_number']; ?></h4>
							<div class="panel no-border ">
								<div class="panel-title bg-brown-200 no-border">
									<div class="panel-head">Rack Details</div>
								</div>
								<div class="panel-body no-padding-top bg-white">
									<h3 class="color-grey-700"></h3>
									<p class="text-light margin-bottom-30"></p>
									<table class="table table-striped" id="example2">
										<thead>
											<tr>
												<th>Rack No.</th>
												<th>Number of Section</th>
												<th>Levels</th>
												<th>Bins</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($rackDetails as $rackDetail) { ?>
											<tr>
												<td><?php echo $rackDetail['WarehouseRack']['warehouse_rack_label']; ?></td>
												<td><?php //echo $rackDetail['WarehouseRack']['warehouse_section']; ?></td>
												<td>
													<select class="form-control input-sm">
														<option>1 (R1, S1)</option>
														<option>2 (R1, S2)</option>
													</select>
												</td>
												<td>
													<select class="form-control input-sm">
														<option>Dell Laptops</option>
														<option>Samsung LCD</option>
														<option>Philips LED Light</option>
													</select>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
   $(document).ready(function(){
       $('#pop-up-4').modal('show');
       $('#popup-scroller4').slimScroll({
        height: '450px',
		width:'100%',
		alwaysVisible: true
    });
   });
</script>

