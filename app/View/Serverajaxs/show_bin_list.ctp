<div class="counterInc" id="counter_<?php print $checklabelForCounter[0]['WarehouseBin']['bin_counter']; ?>" style="display:none;"></div>
<?php
    if( !empty( $checklabel ) ) :
?>
    <div style="margin-bottom:0px;margin-top:30px;" role="alert" class="alert alert-success alert_bin defaultListNone"></div>    
    <div class="panel-body defaultListBlock">
            <!-- Text input -->
            <div class="col-lg-5 binid_textfeild">
               <div class="form-group">
                  <label class="control-label binid" for="input-text">Bin ID</label>									  
               </div>
               <!-- Looping Here -->
               <?php                
                foreach( $checklabel as $binIndex => $binValue ) :
               ?>
                    <div class="form-group addId addCustomId addId_<?php print $binValue['WarehouseBin']['id']; ?>" id="">
                         <input type="text" readonly="readonly" value="<?php print $binValue['WarehouseBin']['bin_unique_id']; ?>" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binId][]" class="form-control bin_value">
                    </div>
                <?php
                endforeach;
                ?>
            </div>
            
            <!-- Input text with help -->
            <div class="col-lg-5 col-lg-offset-1 binlabel_textfeild">
               <div class="form-group">
                  <label class="control-label" for="input-text-help">Bin Label</label>									  
               </div>
               <!-- Looping Here -->
               <?php
                $counter = count( $checklabel );
                foreach( $checklabel as $binIndex => $binValue ) :
               ?>                    
                    <div class="form-group addLabel addCustomLabel addLabel_<?php print $binValue['WarehouseBin']['id']; ?>" id="">
                        <input type="text" value="<?php print $binValue['WarehouseBin']['bin_label']; ?>" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
                        <?php
                             if( $counter > 1 ):
                        ?>
                                <a class="panel-close" href="#"><i class="ion-close customClose"></i></a>
                        <?php
                            endif;
                        ?>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
    </div>
<?php
    else :  
?>
    <div class="panel-body defaultListBlock">
        <!-- Text input -->
        <div class="col-lg-5 binid_textfeild">
           <div class="form-group">
              <label class="control-label binid" for="input-text">Bin ID</label>									  
           </div>
           <div class="form-group addId customId">
                <input type="text" value="<?php print $defaultBinData['binId']; ?>" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binId][]" class="form-control bin_value">
           </div>								   
        </div>
        
        <!-- Input text with help -->
        <div class="col-lg-5 col-lg-offset-1 binlabel_textfeild">
           <div class="form-group">
              <label class="control-label" for="input-text-help">Bin Label</label>									  
           </div>
           <div class="form-group addLabel">
                <input type="text" placeholder="E.g.- Dell Laptop" name="data[WarehouseBin][warehouse_binLabel][]" class="form-control bin_value">
           </div>           
        </div>
    </div>
<?php
    endif;
?>



<div class="row">
<div class="col-lg-3">
						<div class="panel bg-white">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"><a href="#"><i class="fa fa-close"></i></a></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-300 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-teal-500 font-size-13 font-roboto font-weight-600">WH1-R817-S1-L1-0001</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="E.g.- Dell Laptop" value="Dell Laptop"></div>
								
								
								
							</div>
						</div><!-- /.panel -->
					</div>
					
					<div class="col-lg-3">
						<div class="panel bg-white">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"><a href="#"><i class="fa fa-close"></i></a></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-300 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-teal-500 font-size-13 font-roboto font-weight-600">WH1-R817-S1-L1-0001</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="E.g.- Dell Laptop" value="Dell Laptop"></div>
								
								
								
							</div>
						</div><!-- /.panel -->
					</div>
					<div class="col-lg-3">
						<div class="panel bg-white">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"><a href="#"><i class="fa fa-close"></i></a></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-300 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-teal-500 font-size-13 font-roboto font-weight-600">WH1-R817-S1-L1-0001</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="E.g.- Dell Laptop" value="Dell Laptop"></div>
								
								
								
							</div>
						</div><!-- /.panel -->
					</div>
					<div class="col-lg-3">
						<div class="panel bg-white">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"><a href="#"><i class="fa fa-close"></i></a></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-300 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-teal-500 font-size-13 font-roboto font-weight-600">WH1-R817-S1-L1-0001</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="E.g.- Dell Laptop" value="Dell Laptop"></div>
								
								
								
							</div>
						</div><!-- /.panel -->
					</div>
					<div class="col-lg-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					<div class="col-lg-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					
					<div class="col-lg-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					
					<div class="col-lg-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					
					<div class="col-lg-3 col-lg-offset-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					
					<div class="col-lg-3">
						<div class="panel panel-empty">
							<div class="panel-body padding-10">
							<div class="font-size-11 clearfix color-blue-grey-300 font-weight-600">
									<div class="pull-left"></div>
									<div class="pull-right">
										<i class="font-size-20 color-blue-grey-100 fa fa-archive"></i>
									</div>
								</div>
								<div class="clearfix">
									<div class="pull-left">
										<div data-refresh-interval="10" data-speed="500" data-to="1230" data-from="0" data-start="0" data-toggle="counter" class="color-blue-500 font-size-13 font-roboto font-weight-600">Empty Bin</div>
										
									</div>
									
								</div>
										<div class="display-block"><input type="text" class="form-control font-size-12 input-sm bin_value" name="textname" placeholder="Write Label here" value=""></div>

							</div>
						</div><!-- /.panel -->
					</div>
					

					
					</div>