<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
		
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		
    </div>
    <?php
		//pr($productAllDescs); exit;
    ?>
    <!-- END PAGE HEADING --> 
    <div class="container-fluid">
		<div class="row">
                        <div class="col-lg-12">
							<div class="panel no-border ">
                                <div class="panel-title bg-white no-border">									
									<div class="panel-tools">
									<a class="downloadVirtualStockFile btn btn-success btn-xs margin-right-10 color-white"><i class="fa fa-download"></i> Download Virtual Stock</a>
									<a class="downloadStockFile btn btn-success btn-xs margin-right-10 color-white"><i class="fa fa-download"></i> Download CSV</a>
									</div>
								</div>
                                <div class="panel-body no-padding-top bg-white">											
											<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 30px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 260px;" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Product Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Product Sku</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Barcode</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="State Name: activate to sort column ascending">Brand</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="State Name: activate to sort column ascending">Avb. Stock</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="State Name: activate to sort column ascending">Min. Stock</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-sort="ascending" aria-label="State Name: activate to sort column ascending">Total Sold</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-sort="ascending" aria-label="State Name: activate to sort column ascending">Status</th>
												<th rowspan="1" colspan="1" style="width: 160px;" title = "Edit County Name" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php
										//echo count($productAllDescs); exit;
										$i = 0;foreach( $productAllDescs as $index => $value ) :                                        
                                        $id = $value['Product']['id'];
                                        $status = ( $value['Product']['product_status'] == 0 ) ? "Active" : "Deactive";
                                    ?>
                                            <tr class="odd">
												<td class="  sorting_1"><?php print $value['Product']['id']; ?></td>
												<td class="  sorting_1"><?php print $value['Product']['product_name']; ?></td>                                                
												<td class="  sorting_1"><?php print $value['Product']['product_sku']; ?></td>
												<td class="  sorting_1"><?php print $value['ProductDesc']['barcode']; ?></td>
												<td class="  sorting_1"><?php print $value['ProductDesc']['brand']; ?></td>
												<td class="  sorting_1"><?php if( $value['Product']['current_stock_level'] == '' )
														{ print "--"; }else{ print $value['Product']['current_stock_level'];} ?></td>
												<td class="  sorting_1"><?php if( $value['Product']['minimum_stock_level'] == '' )
														{ print "--"; }else{ print $value['Product']['minimum_stock_level'];} ?></td>
														<td class="  sorting_1">
														<?php if( $value['Product']['total_sold'] == '' )
														{ print "--"; }else{ print $value['Product']['total_sold'];} ?>
														</td>
                                                <td class="  sorting_1"><?php print $status; ?></td>
                                                <td>
												<ul id="icons" class="iconButtons" >
													<a href="editSupplier/<?php print $id; ?>" title="Edit" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
													<?php
														if( $value['Product']['product_status'] == 1 )
														{
													?>
													<a href="lockUnlockSP/<?php print $id; ?>/<?php print $status; ?>/<?php print "SPAction"; ?>" alt="Unlock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
													<?php
														}
														else
														{
													?>
													<a href="lockUnlockSP/<?php print $id; ?>/<?php print $status; ?>/<?php print "SPAction"; ?>" alt="Lock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
													<?php
														}
													?>
													
													<?php
													
														if( $value['Product']['is_deleted'] == 1 )
														{
													?>
													<a href="deleteSP/<?php print $id; ?>/<?php print $value['Product']['is_deleted']; ?>" alt="Retrieve" class="btn btn-danger btn-xs margin-right-10"><i class="ion-plus-circled"></i></a>
													<?php
														}
														else
														{
													?>
													<a href="deleteSP/<?php print $id; ?>/<?php print $value['Product']['is_deleted']; ?>" alt="Delete" class="btn btn-danger btn-xs margin-right-10"><i class="ion-minus-circled"></i></a>
													<?php
														}
													?>
													</ul>		
												</td>												
                                            </tr>
                                    <?php
										$i++;
                                        endforeach;
                                    ?>
										</tbody>
									</table>
									
									<div class="" style="margin:0 auto; width:350px">
									<ul class="pagination">
										<?php
											echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
											echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
											echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
										?>
									</ul>
								</div>
											
								</div>
                            </div>
                            
                            
                        </div><!-- /.col -->
                        
							    
                        
                    </div><!-- /. row -->
				<!-- BEGIN FOOTER -->
				<footer class="bg-white">
					<div class="pull-left">
						<span class="pull-left margin-right-15">&copy; 2015 WMS by JijGroup.</span>
						<ul class="list-inline pull-left">
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Terms of Use</a></li>
						</ul>
					</div>
				</footer>
				<!-- END FOOTER -->
            </div>
    </div>
    

</div>



<script>
	$(function()
	{
		//Download Stock file now
		$( 'body' ).on( 'click', '.downloadStockFile', function()
		{
			//Check If input rack name exists in table or not
			$.ajax({
					url     	: getUrl() + '/Products/prepareExcel',
					type    	: 'POST',
					data    	: {},  			  
					success 	:	function( data  )
					{
						 window.open(data,'_self' );
					}                
				});				
		});	
		
		//Download Stock file now
		$( 'body' ).on( 'click', '.downloadVirtualStockFile', function()
		{
			//Check If input rack name exists in table or not
			$.ajax({
					url     	: getUrl() + '/Products/prepareVirtualStock',
					type    	: 'POST',
					data    	: {},  			  
					success 	:	function( data  )
					{
						 window.open(data,'_self' );
					}                
				});				
		});
		
	});
</script>
