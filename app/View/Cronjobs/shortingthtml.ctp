<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title">Sorting Station<?php              
                                                $getOperatorInformation = $this->Session->read('Auth.User') ;
                                                if( isset($getOperator) )
                                                {
                                                                //pr($getOperator);
                                                }
                                                //pr($this->Session->read('Auth.User')); 
                                                if( $getActivationForCutOffList == 0 )                                      
                                                {
                                                                $classDisable = 'disabled=disabled';
                                                }
                                                else
                                                {
                                                                $classDisable = '';
                                                }
        ?></h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
                                <div class="col-lg-5">
              <div class="panel sortingSerivesLeft">
                                                  <div class="panel-title bg-gray-100 no-border">
                                                                <div class="panel-head">Services List</div>                                                         
                                                                                <div class="panel-tools">                                                                                                             </div>
                                                                                                                                </div>
                                                  <div class="panel-body bg-grey-200">
                                                                  
                                                <!-- Now, Service would be render -->     
                                                <?php
                                                                global $indexCounter;                                                   
                                                                $iGetter = 1;$icount = 0; while( $icount <= count($leftService)-1 ):
                                                                                $indexCounter++;
                                                                                
                                                                                // Set dom data now                                                                      
                                                                                $strFormat = $leftService[$icount]['ServiceCounter']['service_provider'].$leftService[$icount]['ServiceCounter']['service_name'].$leftService[$icount]['ServiceCounter']['service_code'].$leftService[$icount]['ServiceCounter']['destination'];
                                                                                $strFormat = strtolower(str_replace(')','-',str_replace('(','-',str_replace('<','-',str_replace(' ','-',$strFormat)))));
                                                                                
                                                                                if( $iGetter <= 6 )
                                                                                {
                                                                                                if( $iGetter == 1 )
                                                                                                {
                                                                                                                echo '<div class="row">                ';
                                                                                                }
                                                ?>
                                                                                                                                <div class="col-sm-2 sortingBox">
                                                                                                                                                <div class=" panel margin-bottom-15 bg-white <?php echo $strFormat; ?>">
                                                                                                                                                                <div class="panel-body padding-5">
                                                                                                                                                                                <div class="clearfix ">
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Total</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 customTotal"><?php print $leftService[$icount]['ServiceCounter']['original_counter']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Scanned</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 custom">
                                                                                                                                                                                                                <?php                                                                                                                                                                                                                   
                                                                                                                                                                                                                                if( $leftService[$icount]['ServiceCounter']['counter'] == 0 ):
                                                                                                                                                                                                                                                print '-';
                                                                                                                                                                                                                                else:
                                                                                                                                                                                                                                                print $leftService[$icount]['ServiceCounter']['counter'];
                                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                ?>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute label bagNumber">
                                                                                                                                                                                                                
                                                                                                                                                                                                                <div class="customBags customDisplay<?php print $leftService[$icount]['ServiceCounter']['id']; ?>" for="<?php print $leftService[$icount]['ServiceCounter']['id']; ?>">
                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                                print $leftService[$icount]['ServiceCounter']['bags'];
                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute top right margin-right-5">
                                                                                                                                                                                                                <span class="threeDtext font-size-14 color-grey-800"><?php print "A".$indexCounter; ?></span>
                                                                                                                                                                                                </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="clearfix "><div class="help-block display-block margin-top-5"><?php print $leftService[$icount]['ServiceCounter']['service_name']. ' ' . $leftService[$icount]['ServiceCounter']['service_provider'] .' ('. $leftService[$icount]['ServiceCounter']['destination'].')'; ?></div>
                                                                                                                                                                                </div>
                                                                                                                                                                </div>
                                                                                                                                                </div><!-- /.panel -->
                                                                                                                                </div>   
                                                <?php   
                                                                                                
                                                                                                if( $iGetter == 6 )
                                                                                                {                                                                                                              
                                                                                                                echo "</div>";
                                                                                                                //echo '<div class="row">            ';
                                                                                                }
                                                                                                else if( $icount == count($leftService)-1 )
                                                                                                {
                                                                                                                echo "</div>";
                                                                                                }
                                                                                                else{}
                                                                                                
                                                                                }              
                                                                                else                                        
                                                                                {
                                                                                                if( $iGetter > 6 )
                                                                                                {                                                                                                              
                                                                                                                $iGetter = 1;
                                                                                                }
                                                                                                
                                                                                                if( $iGetter == 1 )
                                                                                                {
                                                                                                                echo '<div class="row">                ';
                                                                                                }
                                                ?>
                                                                                                                <div class="col-sm-2 sortingBox ">
                                                                                                                                                <div class="panel margin-bottom-15 bg-white <?php echo $strFormat; ?>">
                                                                                                                                                                <div class="panel-body padding-5">
                                                                                                                                                                                <div class="clearfix ">
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                                <p class="help-block no-margin">Total</p>
                                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 customTotal"><?php print $leftService[$icount]['ServiceCounter']['original_counter']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                                <p class="help-block no-margin">Scanned</p>
                                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 custom">
                                                                                                                                                                                                                                <?php                                                                                                                                                                                                                   
                                                                                                                                                                                                                                if( $leftService[$icount]['ServiceCounter']['counter'] == 0 ):
                                                                                                                                                                                                                                                print '-';
                                                                                                                                                                                                                                else:
                                                                                                                                                                                                                                                print $leftService[$icount]['ServiceCounter']['counter'];
                                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute label bagNumber">
                                                                                                                                                                                                                
                                                                                                                                                                                                                <div class="customBags customDisplay<?php print $leftService[$icount]['ServiceCounter']['id']; ?>" for="<?php print $leftService[$icount]['ServiceCounter']['id']; ?>"><?php print $leftService[$icount]['ServiceCounter']['bags']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute top right margin-right-5">
                                                                                                                                                                                                                <span class="threeDtext font-size-14 color-grey-800"><?php print "A".$indexCounter; ?></span>
                                                                                                                                                                                                </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="clearfix "><div class="help-block display-block margin-top-5"><?php print $leftService[$icount]['ServiceCounter']['service_name']. ' ' . $leftService[$icount]['ServiceCounter']['service_provider'] .' ('. $leftService[$icount]['ServiceCounter']['destination'].')'; ?></div>
                                                                                                                                                                                </div>
                                                                                                                                                                </div>
                                                                                                                                                </div><!-- /.panel -->
                                                                                                                                </div>                                   
                                                <?php                   
                                                                                                if( $icount == count($leftService)-1 )
                                                                                                {
                                                                                                                echo "</div>";
                                                                                                }
                                                                                                else{}
                                                                                }              
                                                                $icount++;          
                                                                $iGetter++;                                        
                                                                endwhile;
                                                                
                                                ?>

                                                  
                                                  </div>
                                                  </div>
                                                  </div>
                                                  
                                                  <div class="col-lg-2">
              <div class="panel">
                                                  <div class="panel-title bg-gray-100 no-border">                                                                                                                                              
                                                                <div class="panel-head">Sorting Station</div>                                   
                                                                                <div class="panel-tools">                                                                                                             </div>
                                                                                                                                </div>
                                                  <div class="panel-body bg-white">
                                                  <a href="#" class="panel padding-5 color-grey-400 display-block text-center margin-bottom-20">
                                                                                                                                                                
                                                                                                                                                                <input type="text" id="LinnworksapisBarcode" index="0" value="" class="get_sku_string form-control" name="data[Linnworksapis][barcode]">
                                                                                                                                                </a>
                                                  
                                                  <a href="#" class="panel padding-md btn-dark bg-red-500 color-white display-block text-center">

                                                                                                                                                                                                <?php
                                                                                                                                                                                                                $userImage = $getOperatorInformation['user_image'];
                                                                                                                                                                                                                $userName = $getOperatorInformation['first_name'].' '.$getOperatorInformation['last_name'];
                                                                                                                                                                                                                if( isset( $userImage ) && $userImage != "" )
                                                                                                                                                                                                                {
                                                                                                                                                                                                                                print $this->html->image( 'upload/'.$userImage, array( "class" => "img-circle", "title" => $userName, "width" => "60px" ) );                                               
                                                                                                                                                                                                                }
                                                                                                                                                                                                ?>

                                                                                                                                                                <div class="bold">
                                                                                                                                                                                <?php
                                                                                                                                                                                                print $getOperatorInformation['first_name'] . $getOperatorInformation['last_name']; // substr($getOperatorInformation['last_name'],0,1);
                                                                                                                                                                                ?>
                                                                                                                                                                </div>
                                                                                                                                                </a>
                                                                <?php
                                                                                print $this->form->create( 'SortingStation', array( 'class'=>'form-horizontal', 'url' => '/cronjobs/createCutOffList', 'type'=>'post','id'=>'sortinStation' ) );                                                                          
                                                                ?>                                                                                           
                                                                                                <button class="add_attribute cut_off btn bg-green-500 color-white btn-dark padding-left-30 padding-right-30" <?php print $classDisable; ?> type="submit">Cut-Off List</button>
                                                                </form>
                                                  </div>
                                                  </div>
                                                  </div>
                                                  
                                                  <div class="col-lg-5">
              <div class="panel sortingSerivesLeft">
                                                  <div class="panel-title bg-gray-100 no-border">
                                                                <div class="panel-head">Services List</div>                                                         
                                                                                <div class="panel-tools">                                                                                                             </div>
                                                                                                                                </div>
                                                  <div class="panel-body bg-grey-200">
                                                                  
                                                                                                <!-- Now, Service would be render -->     
                                                <?php                                                   
                                                                $iGetter = 1;$icount = 0; while( $icount <= count($rightService)-1 ):
                                                                                $indexCounter++;
                                                                                
                                                                                // Set dom data now                                                                      
                                                                                $strFormat = $rightService[$icount]['ServiceCounter']['service_provider'].$rightService[$icount]['ServiceCounter']['service_name'].$rightService[$icount]['ServiceCounter']['service_code'].$rightService[$icount]['ServiceCounter']['destination'];
                                                                                $strFormat = strtolower(str_replace(')','-',str_replace('(','-',str_replace('<','-',str_replace(' ','-',$strFormat)))));
                                                                                
                                                                                if( $iGetter <= 6 )
                                                                                {
                                                                                                if( $iGetter == 1 )
                                                                                                {
                                                                                                                echo '<div class="row">                ';
                                                                                                }
                                                ?>
                                                                                                                                <div class="col-sm-2 sortingBox">
                                                                                                                                                <div class="panel margin-bottom-15 bg-white <?php echo $strFormat; ?>">
                                                                                                                                                                <div class="panel-body padding-5">
                                                                                                                                                                                <div class="clearfix ">
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Total</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 customTotal"><?php print $rightService[$icount]['ServiceCounter']['original_counter']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Scanned</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 custom">
                                                                                                                                                                                                                <?php                                                                                                                                                                                                                   
                                                                                                                                                                                                                                if( $rightService[$icount]['ServiceCounter']['counter'] == 0 ):
                                                                                                                                                                                                                                                print '-';
                                                                                                                                                                                                                                else:
                                                                                                                                                                                                                                                print $rightService[$icount]['ServiceCounter']['counter'];
                                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                ?>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute label bagNumber">
                                                                                                                                                                                                                
                                                                                                                                                                                                                <div class="customBags customDisplay<?php print $rightService[$icount]['ServiceCounter']['id']; ?>" for="<?php print $rightService[$icount]['ServiceCounter']['id']; ?>"><?php print $rightService[$icount]['ServiceCounter']['bags']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute top right margin-right-5">
                                                                                                                                                                                                                <span class="threeDtext font-size-14 color-grey-800"><?php print "A".$indexCounter; ?></span>
                                                                                                                                                                                                </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="clearfix "><div class="help-block display-block margin-top-5"><?php print $rightService[$icount]['ServiceCounter']['service_name']. ' ' . $rightService[$icount]['ServiceCounter']['service_provider'] .' ('. $rightService[$icount]['ServiceCounter']['destination'].')'; ?></div>
                                                                                                                                                                                </div>
                                                                                                                                                                </div>
                                                                                                                                                </div><!-- /.panel -->
                                                                                                                                </div>
                                                <?php   
                                                                                                if( $iGetter == 6 )
                                                                                                {                                                                                                              
                                                                                                                echo "</div>";
                                                                                                                //echo '<div class="row">            ';
                                                                                                }
                                                                                }              
                                                                                else                                        
                                                                                {
                                                                                                if( $iGetter > 6 )
                                                                                                {                                                                                                              
                                                                                                                $iGetter = 1;
                                                                                                }
                                                                                                
                                                                                                if( $iGetter == 1 )
                                                                                                {
                                                                                                                echo '<div class="row">                ';
                                                                                                }
                                                ?>
                                                                                                                <div class="col-sm-2 sortingBox">
                                                                                                                                                <div class="panel margin-bottom-15 bg-white <?php echo $strFormat; ?>">
                                                                                                                                                                <div class="panel-body padding-5">
                                                                                                                                                                                <div class="clearfix ">
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Total</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 customTotal"><?php print $rightService[$icount]['ServiceCounter']['original_counter']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                <p class="help-block no-margin">Scanned</p>
                                                                                                                                                                                                <div class="color-blue-grey-200 font-size-18 font-roboto font-weight-600 line-height-20 custom">
                                                                                                                                                                                                                <?php                                                                                                                                                                                                                   
                                                                                                                                                                                                                                if( $rightService[$icount]['ServiceCounter']['counter'] == 0 ):
                                                                                                                                                                                                                                                print '-';
                                                                                                                                                                                                                                else:
                                                                                                                                                                                                                                                print $rightService[$icount]['ServiceCounter']['counter'];
                                                                                                                                                                                                                                endif;
                                                                                                                                                                                                                ?>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute label bagNumber">
                                                                                                                                                                                                                
                                                                                                                                                                                                                <div class="customBags customDisplay<?php print $rightService[$icount]['ServiceCounter']['id']; ?>" for="<?php print $rightService[$icount]['ServiceCounter']['id']; ?>"><?php print $rightService[$icount]['ServiceCounter']['bags']; ?></div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="absolute top right margin-right-5">
                                                                                                                                                                                                                <span class="threeDtext font-size-14 color-grey-800"><?php print "A".$indexCounter; ?></span>
                                                                                                                                                                                                </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                <div class="clearfix "><div class="help-block display-block margin-top-5"><?php print $rightService[$icount]['ServiceCounter']['service_name']. ' ' . $rightService[$icount]['ServiceCounter']['service_provider'] .' ('. $rightService[$icount]['ServiceCounter']['destination'].')'; ?></div>
                                                                                                                                                                                </div>
                                                                                                                                                                </div>
                                                                                                                                                </div><!-- /.panel -->
                                                                                                                                </div>
                                                <?php   
                                                                                                
                                                                                                if( $iGetter == 6 )
                                                                                                {                                                                                                              
                                                                                                                echo "</div>";
                                                                                                }                              
                                                                                }              
                                                                $icount++;          
                                                                $iGetter++;                                        
                                                                endwhile;
                                                                
                                                ?>
                                                  </div>
                                                  </div>
                                                  </div>
                                
                                
            
            </div>
        </div>
    </div> 

<!-- For popup -->    
<div class="showPopup"></div>    

<script>
                $(function() {                     
                                console.log( "****************************" );                    
                                console.log( "Euraco is ready to processed" );
                                console.log( "****************************" );
                                
                  $("#LinnworksapisBarcode").focus();
                });

                $(document).keypress(function(e) {
                                if(e.which == 13) {
                                                checkOperatorBarcodeValue();
                                }
                });
                
                $(document).keypress(function(e) {
                                if(e.which == 32) {
                                                var url = $('.btn-success').attr('href');
                                                window.open(url,'_self');
                                }
                });

                function checkOperatorBarcodeValue()
                {
                                var Barcode        =             $('#LinnworksapisBarcode').val();                                             
                                
                                // If barcode blank
                                if( Barcode == '' )
                                {
                                                console.log( "****************************" );
                                                var number = 1 + Math.floor(Math.random() * 20000000000000000000);
                                                console.log( "Oops, Your barcode is blank![ " + number + " ]" );
                                                console.log( "****************************" );
                                return false;
                                }
                                
                                $('.searchbarcode').text(Barcode);
                                $.ajax(
                                {
                                                'url'            : getUrl() + '/Linnworksapis/checkBarcodeForSortingOperator',
                                                'type'           : 'POST',
                                                'data'           : { barcode : Barcode },                                            
                                                'beforeSend'      : function() {
                                                                                                                                                                                                //$('.loading-image').show();
                                                                                                                                                                                },
                                                'success'                                : function( msgArray )
                                                                                                                   {                                                                                                                              
                                                                                                                                   if( msgArray != 'none' )
                                                                                                                                   {                                                                                                                                              
                                                                                                                                                                //Find specific id or class and update its counter value
                                                                                                                                                                var customIncrementer = $.trim($( 'div.row div.col-sm-2' ).find( 'div.'+msgArray ).find( 'div.custom' ).html());
                                                                                                                                                                
                                                                                                                                                                // Check condition for custom counter
                                                                                                                                                                if( customIncrementer == "-" )
                                                                                                                                                                {
                                                                                                                                                                                // If set already then remove it
                                                                                                                                                                                $( 'div.row' ).find( 'div.bg-yellow-400' ).removeClass('bg-yellow-400');
                                                                                                                                                                                
                                                                                                                                                                                // Increment again if scanned and will show up over sorting station
                                                                                                                                                                                customIncrementer = 0;
                                                                                                                                                                                customIncrementer = customIncrementer + 1;
                                                                                                                                                                                
                                                                                                                                                                                // Set custom increment value in specific location but after updatin al table values hahahahhaaaaaa
                                                                                                                                                                                $( 'div.row div.col-sm-2' ).find( 'div.'+msgArray ).find( 'div.custom' ).html("");                                                                                                                                                    
                                                                                                                                                                                $( 'div.row div.col-sm-2' ).find( 'div.'+msgArray ).find( 'div.custom' ).html( customIncrementer );
                                                                                                                                                                                
                                                                                                                                                                                //Blinking Background
                                                                                                                                                                                setTimeout(function ()
                                                                                                                                                                                {
                                                                                                                                                                                                $( 'div.row div.col-sm-2 div.'+msgArray ).removeClass('bg-white').addClass('bg-yellow-400');
                                                                                                                                                                                                
                                                                                                                                                                                                // Enable CutOFf List button
                                                                                                                                                                                                $( '.cut_off' ).removeAttr( 'disabled' );
                                                                                                                                                                                                
                                                                                                                                                                                }, 250);                                                                                                                                                                  
                                                                                                                                                                }
                                                                                                                                                                else
                                                                                                                                                                {
                                                                                                                                                                                // If set already then remove it
                                                                                                                                                                                $( 'div.row' ).find( 'div.bg-yellow-400' ).removeClass('bg-yellow-400');
                                                                                                                                                                                
                                                                                                                                                                                // Increment again if scanned and will show up over sorting station                                                                                                                                                                               
                                                                                                                                                                                customIncrementer = parseInt(customIncrementer) + 1;
                                                                                                                                                                                                                                                                                                                                                                
                                                                                                                                                                                // Set custom increment value in specific location but after updatin al table values hahahahhaaaaaa
                                                                                                                                                                                $( 'div.row div.col-sm-2' ).find( 'div.'+msgArray ).find( 'div.custom' ).html("");                                                                                                                                                    
                                                                                                                                                                                $( 'div.row div.col-sm-2' ).find( 'div.'+msgArray ).find( 'div.custom' ).html( customIncrementer );
                                                                                                                                                                                
                                                                                                                                                                                //Blinking Background
                                                                                                                                                                                setTimeout(function ()
                                                                                                                                                                                {
                                                                                                                                                                                                $( 'div.row div.col-sm-2 div.'+msgArray ).removeClass('bg-white').addClass('bg-yellow-400');
                                                                                                                                                                                                
                                                                                                                                                                                                // Enable CutOFf List button
                                                                                                                                                                                                $( '.cut_off' ).removeAttr( 'disabled' );
                                                                                                                                                                                                
                                                                                                                                                                                }, 250);                                                                                                                                                                  
                                                                                                                                                                }
                                                                                                                                                }
                                                                                                                                                else
                                                                                                                                                {
                                                                                                                                                                alert( "Oops, Barcode not found in our records!!" );
                                                                                                                                                                return false;
                                                                                                                                                }
                                                                                                                   }  
                                });                                                                                           
                }
</script>
<script>
                $(function()
                {
                                $( 'body' ).on( 'click', '.customBags', function()
                                {              
                                                var getClass                                        = $(this).parent().prev().prev().parent().parent().parent().attr( 'class' );
                                                var exactLocationClick    = $(this).attr('for');          
                                                $.ajax(
                                                {
                                                                'url'            : getUrl() + '/Cronjobs/addBag',
                                                                'type'           : 'POST',
                                                                'data'           : { exactLocationClick : exactLocationClick },                                    
                                                                'beforeSend'      : function()
                                                                {
                                                                                //$('.loading-image').show();
                                                                },
                                                                'success'                                : function( msgArray ){ $( 'div.showPopup' ).html( msgArray ); }
                                                });
                                });
                });
</script>
