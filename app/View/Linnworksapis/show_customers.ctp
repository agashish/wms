<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
		<h1 class="page-title">Customers</h1>
		<div class="panel-title no-radius bg-green-500 color-white no-border"></div>
    </div>
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel no-border ">
					<div class="panel-title bg-white no-border">									
						<div class="panel-tools">																	
						</div>
					</div>
					<div class="panel-body no-padding-top bg-white">											
							<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
								<thead>
									<tr role="row">
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">S.No.</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Name</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Email</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Phone</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Town</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Region</th>
										<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Country</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php $i = 1; foreach($customers as $customer) { ?>
										<tr class="odd">
											<td class="sorting_1"><?php echo $i; ?></td>
											<td class="sorting_1"><?php echo $customer['Customer']['name']; ?></td>                                                
											<td class="sorting_1"><?php echo $customer['Customer']['email']; ?></td>
											<td class="sorting_1"><?php echo $customer['Customer']['phone']; ?></td>
											<td class="sorting_1"><?php echo $customer['Customer']['town']; ?></td>
											<td class="sorting_1"><?php echo $customer['Customer']['region']; ?></td>
											<td class="sorting_1"><?php echo $customer['Customer']['country']; ?></td>
										</tr>
									<?php $i++; } ?>
								</tbody>
							</table>		
						</div>
					</div>
				</div>
			</div>
			<?php echo $this->element('footer'); ?>
		</div>
	</div>
</div>




