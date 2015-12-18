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
