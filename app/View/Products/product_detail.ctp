<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title">Product Scan</h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">                            
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <?php
                                 //print $this->form->create( 'product', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'saveuser','enctype'=>'multipart/form-data' ));
                                 //print $this->form->input( 'User.id', array( 'type'=>'hidden') );                                 
                            ?>
                                <div class="form-horizontal panel-body padding-bottom-40 padding-top-40">

									   <div class="form-group">
											<label class="col-sm-3 control-label">Barcode</label>
											<div class="col-sm-7">                                               
												<?php
													print $this->form->input( 'Product.barcode', array( 'type'=>'text','class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false ) );
												?>  
											</div>
										</div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Title</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.title', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <!--<div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Short Description</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.short_desc', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Long Description</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.logn_desc', array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>-->
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">SKU / Bin</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.sku', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" id="stockLabel" class="control-label col-lg-3">Available Stock</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'stock', array( 'type'=>'text','div'=>false,'label'=>false, 'readonly' => 'readonly' ,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Length(mm)</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.length', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Width(mm)</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.width', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Height(mm)</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.height', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Weight(grams)</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'Product.weight', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Packaging Types</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                            if(count($packageType) > 0)
                                                print $this->form->input( 'packagingType', array( 'type'=>'select', 'empty'=>'Choose Variants', 'div'=>false,'options'=> $packageType, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
									  <div class="form-group brandSelect">
                                        <label for="username" class="control-label col-lg-3">Brand</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                            if(count($brandName) > 0)
                                                print $this->form->input( 'Product.brand', array( 'type'=>'select', 'empty'=>'Choose Brand', 'div'=>false,'options'=> $brandName, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <!-- bin assosiation --->
                                      
                                      <!--<div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Floor Level</label>                                        
                                        <div class="col-lg-7 floor_number">                                            
                                            <?php
                                            if(count($setNewGroundArray) > 0)
                                                print $this->form->input( 'groundFloor', array( 'multiple' => 'multiple' , 'type'=>'select', 'empty'=>'Choose Floor Level', 'div'=>false,'options'=> $setNewGroundArray, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Rack Number</label>                                        
                                        <div class="col-lg-7 rack_Number">                                            
                                            <?php
                                            if(count($rack) > 0)
                                                print $this->form->input( 'rackNumber', array( 'multiple' => 'multiple' , 'type'=>'select', 'empty'=>'Choose Rack Number', 'div'=>false,'options'=> $rack, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Level Number</label>                                        
                                        <div class="col-lg-7 level_Number">                                            
                                            <?php
                                            if(count($rackLevel) > 0)
                                                print $this->form->input( 'levelNumber', array( 'multiple' => 'multiple' , 'type'=>'select', 'empty'=>'Choose Level Number', 'div'=>false,'options'=> $rackLevel, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Section Number</label>                                        
                                        <div class="col-lg-7 section_Number">                                            
                                            <?php
                                            if(count($rackSection) > 0)
                                                print $this->form->input( 'sectionNumber', array( 'multiple' => 'multiple' , 'type'=>'select', 'empty'=>'Choose Section Number', 'div'=>false,'options'=> $rackSection, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>-->
                                      
                                      <div class="form-group count">
                                        <label for="username" class="control-label col-lg-3">Primary Bin Location</label>                                        
                                        <div class="col-lg-3">                                            
                                            <?php
                                                print $this->form->input( 'binLocation1', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control binLocation', 'required'=>false ) );
                                                
                                                //print $this->Soap->number_to_word(1);
                                                
                                            ?>
                                        </div>
                                        <label for="username" class="control-label col-lg-1">Stock</label>                                        
                                        <div class="col-lg-3">                                            
                                            <?php
                                                print $this->form->input( 'stock1', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control stock', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group count">
                                        <label for="username" class="control-label col-lg-3">Secondary Bin Location</label>                                        
                                        <div class="col-lg-3">                                            
                                            <?php
                                                print $this->form->input( 'binLocation2', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control binLocation', 'required'=>false ) );
                                            ?>
                                        </div>
                                        <label for="username" class="control-label col-lg-1">Stock</label>                                        
                                        <div class="col-lg-3">                                            
                                            <?php
                                                print $this->form->input( 'stock2', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control stock', 'required'=>false ) );
                                            ?>
                                        </div>
                                        <div class="col-lg-2">
											
											<button class="flushLocation btn btn-danger color-white btn-dark" type="button"><i class="fa fa-close"></i></button>
											
											</div>
                                      </div>
                                                                         
                                      
                                      <!-- bin assosiation -->
                                      
                                      <div class='image1' ></div>
                                      
                                    <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                      
									  <?php
											/*echo $this->Form->button(
												'Reset', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showList')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);*/	
										?>
									 <button class="addLocationBtnClick btn bg-green-500 color-white btn-dark" type="button"><i class="fa fa-plus"></i> Add More Locations</button>
									 <?php
											echo $this->Form->button('Save', array(
												'type' => 'submit',												
												'escape' => true,
												'class'=>'resetPackage btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										    ));	
										?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>        
</div>

<script>
	
	$(document).keypress(function(e)
	{
	   if(e.which == 13) {
		   
		  
		   if($('#ProductBarcode').val() != '')
			{
				
				submitSanningValue();
			}
			else
			{
				//submitTrackingSanningValue();
			}
			
		}
	});

	$(function()
	{		
		
		//Add Location field area
		$( 'body' ).on( 'click', '.addLocationBtnClick', function(e)
		{
			//Get Size
			var getCountLocationSize = parseInt($( "div.count" ).size()) + 1;			
			
			//Set Html for inline rows will increase
			var str = '';
			str += '<div class="form-group count">';
			str += '<label for="username" class="control-label col-lg-3">Secondary Bin Location</label>';
			str += '<div class="col-lg-3">';
				str += '<input type="text" id="binLocation'+getCountLocationSize+'" class="form-control binLocation" name="data[binLocation'+getCountLocationSize+']">';
			str += '</div>';
			str += '<label for="username" class="control-label col-lg-1">Stock</label>';                                        
			str += '<div class="col-lg-3">';
				str += '<input type="text" id="stock'+getCountLocationSize+'" class="form-control stock" name="data[stock'+getCountLocationSize+']">';
			str += '</div>';
			str += '<div class="col-lg-2">';				
			str += '<button class="btn btn-danger color-white btn-dark" type="button"><i class="fa fa-close"></i></button>';
				str += '</div>';
		  str += '</div>';
			
			//Add more at run time after at last
			$( "div.count:last" ).after( str );
			
		});
		
		//Get Rack NUmber which one we need to see and make changes
		$( 'body' ).on( 'change', '#groundFloor', function(e)
		{			
			$(this).focusout(function()
			{
			
				var optionSelected = $("option:selected", this);
				var valueSelected = optionSelected.text();
				var floorId = $(this).val();
				
				var str = '';
				var i = 0;
				optionSelected.each(function(){				
					//console.log($(this).val() +'=='+ $(this).text());
					if( i == 0 )
						str += $(this).text();
					else
						str += ','+$(this).text();
				i++;	
				});
				
				//Check If input rack name exists in table or not
				$.ajax({
						url     	: getUrl() + '/Products/getRackAccordingToFloor',
						type    	: 'POST',
						data    	: { floorId : floorId , selectedText : str },  			  
						success 	:	function( data  )
						{
							$( "div.rack_Number" ).html( data );							
						}                
					});	
				
			});
			
		});	
		
		//Get Rack NUmber which one we need to see and make changes
		$( 'body' ).on( 'change', '#rackNumber', function()
		{
			
			$(this).focusout(function()
			{
				//Get Current chnage event text
				var levelNumber = $(this).val();
				var optionSelected = $("option:selected", this);
				var valueSelected = optionSelected.text();
				
				if( levelNumber != '' )
				{	
					var strG = '';	
					var g = 0;				
					$("#groundFloor :selected").each(function (i,sel)
					{
					   if( g == 0 )
							strG += $(sel).text();
						else
							strG += ','+$(sel).text();
					g++;
					});
									
					var i = 0;
					var str = '';
					optionSelected.each(function(){				
						//console.log($(this).val() +'=='+ $(this).text());
						if( i == 0 )
							str += $(this).text();
						else
							str += ','+$(this).text();
					i++;	
					});										
				}	
				//Check If input rack name exists in table or not
				$.ajax({
						url     	: getUrl() + '/Products/getLevelAccordingG_R',
						type    	: 'POST',
						data    	: { groundText : strG , rackText : str },  			  
						success 	:	function( data  )
						{
							$( "div.level_Number" ).html( data );							
						}                
				});	
			});
			
		});		
		
		//Get Section NUmber which one we need to see and make changes
		$( 'body' ).on( 'change', '#levelNumber', function()
		{	
			$(this).focusout(function()
			{
				//Get Current chnage event text
				var levelNumber = $(this).val();
				var optionSelected = $("option:selected", this);
				var valueSelected = optionSelected.text();
				
				if( levelNumber != '' )
				{	
					//Ground
					var strG = '';	
					var g = 0;				
					$("#groundFloor :selected").each(function (i,sel)
					{
					   if( g == 0 )
							strG += $(sel).text();
						else
							strG += ','+$(sel).text();
					g++;
					});
					
					//Rack
					var strR = '';	
					var r = 0;				
					$( '#rackNumber :selected' ).each(function (i,sel)
					{
					   if( r == 0 )
							strR += $(sel).text();
						else
							strR += ','+$(sel).text();
					r++;
					});
					
					//Level				
					var i = 0;
					var str = '';
					optionSelected.each(function(){				
						//console.log($(this).val() +'=='+ $(this).text());
						if( i == 0 )
							str += $(this).text();
						else
							str += ','+$(this).text();
					i++;	
					});										
				}	
				
				///Check If input rack name exists in table or not
				$.ajax({
						url     	: getUrl() + '/Products/getSectionAccordingG_R',
						type    	: 'POST',
						data    	: { groundText : strG , rackText : strR , levelSelected : str },  			  
						success 	:	function( data  )
						{
							$( "div.section_Number" ).html( data );							
						}                
				});		
			});			
		});	
		
		$('#ProductBarcode').focus();
		$( ".resetPackage" ).click( function()
		{	
			var barcode	=	$('#ProductBarcode').val();			
			var bin_sku	=	$('#ProductSku').val();			
			
			var packagingType	=	$('#packagingType').val();
			var packagingTypeSelectedName	=	$('#packagingType :selected').text();
			
			var getLength	=	$('#ProductLength').val();
			var getWidth	=	$('#ProductWidth').val();
			var getHeight	=	$('#ProductHeight').val();
			var getWeight	=	$('#ProductWeight').val();			
			var getBrand	=	$('#ProductBrand').val();
			
			var i = 0;
			var getLocation = '';
			//Get Lacation and stock values
			$( "div.count" ).each(function()
			{
				if( i == 0 )
				{
					getLocation += $(this).find( '.binLocation' ).val();
				}
				else
				{
					getLocation += ','+$(this).find( '.binLocation' ).val();
				}				
			i++;  
			});
			
			var getStockByLocation = '';
			i = 0;
			//Get Lacation and stock values
			$( "div.count" ).each(function()
			{
				if( i == 0 )
				{
					getStockByLocation += $(this).find( '.stock' ).val();
				}
				else
				{
					getStockByLocation += ','+$(this).find( '.stock' ).val();
				}				
			i++;  
			});
						
			var productRefId = $( ".resetPackage" ).attr( 'for' ).split( '-' );
			
			$.ajax({
				'url'            : getUrl() + '/Products/updatePackagingIdByBarcodeSearch',
				'type'           : 'POST',
				'dataType'		 : "JSON",
				'data'           : {  	barcode : barcode , 
										variant_envelope_id : packagingType , 
										variant_envelope_name : packagingTypeSelectedName , 
										getLength : getLength , 
										getWidth : getWidth , 
										getHeight : getHeight , 
										getWeight : getWeight , 
										product_id : productRefId[0] , 
										id : productRefId[1] , 
										brand : getBrand ,										
										bin_sku : bin_sku,
										getLocation : getLocation,
										getStockByLocation : getStockByLocation
									},
				'success' 		 : function( msgArray )
								   {
										if( msgArray.data.status == "success" )
										{
											alert( "Update successful." );
											
											//Reset All feilds now
											$('#ProductBarcode').val('');
											$('#ProductTitle').val('');
											$('#ProductSku').val('');
											$('#ProductLength').val('');
											$('#ProductWidth').val('');
											$('#ProductHeight').val('');
											$('#ProductWeight').val('');
											$('#packagingType').val('');
											$('#ProductBrand').val('');
											$('#binLocation1').val('');
											$('#binLocation2').val('');
											$('#stock1').val('');
											$('#stock2').val('');
											$('#stock').val('');
																						
											location.reload();
											
											return false;	
										}
								   }
				});
				
		});
		
		$( 'body' ).on( 'click', '.flushLocation', function()
		{	
			var getClickIndex = $(this).attr('for');
			var barcode	=	$('#ProductBarcode').val();			
			var bin_sku	=	$('#ProductSku').val();			
			
			var packagingType	=	$('#packagingType').val();
			var packagingTypeSelectedName	=	$('#packagingType :selected').text();
			
			var getLength	=	$('#ProductLength').val();
			var getWidth	=	$('#ProductWidth').val();
			var getHeight	=	$('#ProductHeight').val();
			var getWeight	=	$('#ProductWeight').val();			
			var getBrand	=	$('#ProductBrand').val();
			
			var i = 0;
			var getLocation = '';
			//Get Lacation and stock values
			$( "div.count" ).each(function()
			{
				if( $(this).find( '.binLocation' ).val() != "" )
				{
					if( i == 0 )
					{
						getLocation += $(this).find( '.binLocation' ).val();
					}
					else
					{
						if( getClickIndex != i )
						getLocation += ','+$(this).find( '.binLocation' ).val();
					}
				}				
			i++;  
			});
			
			var getStockByLocation = '';
			i = 0;
			//Get Lacation and stock values
			$( "div.count" ).each(function()
			{
				if( $(this).find( '.stock' ).val() != "" )
				{
					if( i == 0 )
					{
						getStockByLocation += $(this).find( '.stock' ).val();
					}
					else
					{
						if( getClickIndex != i )
						getStockByLocation += ','+$(this).find( '.stock' ).val();
					}
				}				
			i++;  
			});
						
			var productRefId = $( ".resetPackage" ).attr( 'for' ).split( '-' );
			
			$.ajax({
				'url'            : getUrl() + '/Products/updatePackagingIdByBarcodeSearch',
				'type'           : 'POST',
				'dataType'		 : "JSON",
				'data'           : {  	barcode : barcode , 
										variant_envelope_id : packagingType , 
										variant_envelope_name : packagingTypeSelectedName , 
										getLength : getLength , 
										getWidth : getWidth , 
										getHeight : getHeight , 
										getWeight : getWeight , 
										product_id : productRefId[0] , 
										id : productRefId[1] , 
										brand : getBrand ,										
										bin_sku : bin_sku,
										getLocation : getLocation,
										getStockByLocation : getStockByLocation
									},
				'success' 		 : function( msgArray )
								   {
										if( msgArray.data.status == "success" )
										{
											alert( "Update successful." );
											var brandName	=	msgArray.data.brand;	
											var getId_productId = msgArray.data.product_id + "-" + msgArray.data.id;											
											$( ".resetPackage" ).attr( 'for' , getId_productId );
											$('#ProductTitle').val( msgArray.data.name );
											$('#ProductShortDesc').val( msgArray.data.shortdescription );
											$('#ProductLognDesc').val( msgArray.data.longdescription );
											$('#ProductBrand').val( msgArray.data.brand );
											$('#ProductLength').val( msgArray.data.length );
											$('#ProductWidth').val( msgArray.data.width );
											$('#ProductHeight').val( msgArray.data.height );
											$('#ProductWeight').val( msgArray.data.weight );
											$('#ProductSku').val( msgArray.data.sku );											
											$('#packagingType').val( msgArray.data.variant_envelope_id );
											
											if( msgArray.data.stock === null )
											{
												$( '#stockLabel' ).addClass( 'color-red-800' );
												$('#stock').val( "N/A" );										
											}
											else
											{
												$('#stock').val( msgArray.data.stock );	
											}
											
											//Set Html for inline rows will increase
											/*var str = '';
											str += '<div class="form-group count">';
											str += '<label for="username" class="control-label col-lg-3">Secondary Bin Location</label>';
											str += '<div class="col-lg-3">';
												str += '<input type="text" id="binLocation'+getCountLocationSize+'" class="form-control binLocation" name="data[binLocation'+getCountLocationSize+']">';
											str += '</div>';
											str += '<label for="username" class="control-label col-lg-1">Stock</label>';                                        
											str += '<div class="col-lg-3">';
												str += '<input type="text" id="stock'+getCountLocationSize+'" class="form-control stock" name="data[stock'+getCountLocationSize+']">';
											str += '</div>';
											str += '<div class="col-lg-2">';				
											str += '<button class="btn btn-danger color-white btn-dark" type="button"><i class="fa fa-close"></i></button>';
												str += '</div>';
										  str += '</div>';*/
											
											var str = '';
											var binLocate = msgArray.data.binLocationArray;																
											$.each(binLocate, function(idx, obj)
											{
												var index = idx;
												var idTable = obj.id;
												var bin_location = obj.bin_location;
												var stock_by_location = obj.stock_by_location;
												var barcode = obj.barcode;
												
												//Set AddMore Locations Html
												if( idx == 0 )
												{	
													str += '<div class="form-group count">';
														str += '<label class="control-label col-lg-3" for="username">Primary Bin Location</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="binLocation1" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation1]"></div>';
														str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="stock1" class="form-control stock" value="'+stock_by_location+'" name="data[stock1]"></div>';
													  str += '</div>';
												}										
												else if( idx == 1 )
												{
													str += '<div class="form-group count">';
														str += '<label class="control-label col-lg-3" for="username">Secondary Bin Location</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="binLocation2" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation2]"></div>';
														str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="stock2" class="form-control stock" value="'+stock_by_location+'" name="data[stock2]"></div>';
															str += '<div class="col-lg-2">';											
													str += '<button class="flushLocation btn btn-danger color-white btn-dark" type="button" for="'+index+'"><i class="fa fa-close"></i></button>';											
													str += '</div>';
													  str += '</div>';
												}
												else // for all
												{
													//Get Size
													var getCountLocationSize = parseInt($( "div.count" ).size()) + 1;	
															
													str += '<div class="form-group count">';
														str += '<label class="control-label col-lg-3" for="username">Secondary Bin Location</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="binLocation'+getCountLocationSize+'" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation'+getCountLocationSize+']"></div>';
														str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
														str += '<div class="col-lg-3">';                                            
															str += '<input type="text" id="stock'+getCountLocationSize+'" class="form-control stock" value="'+stock_by_location+'" name="data[stock'+getCountLocationSize+']"></div>';
															str += '<div class="col-lg-2">';											
													str += '<button class="flushLocation btn btn-danger color-white btn-dark" type="button" for="'+index+'"><i class="fa fa-close"></i></button>';											
													str += '</div>';
													  str += '</div>';
												}
													
											});
											
											$( "div.count" ).remove();
											
											//Add more at run time after at last
											$( "div.brandSelect" ).after( str );
											return false;	
										}
								   }
				});
				
		});
		
		
	})
	
	function submitSanningValue()
	{
		
		var barcode	=	$('#ProductBarcode').val();			
		
		$.ajax({
			'url'            : getUrl() + '/Products/getBarcodeSearch',
			'type'           : 'POST',
			'dataType'		 : "JSON",
			'data'           : {  barcode : barcode },
			'success' 		 : function( msgArray )
								{
									var brandName	=	msgArray.data.brand;	
									var getId_productId = msgArray.data.product_id + "-" + msgArray.data.id;											
									$( ".resetPackage" ).attr( 'for' , getId_productId );
									$('#ProductTitle').val( msgArray.data.name );
									$('#ProductShortDesc').val( msgArray.data.shortdescription );
									$('#ProductLognDesc').val( msgArray.data.longdescription );
									$('#ProductBrand').val( msgArray.data.brand );
									$('#ProductLength').val( msgArray.data.length );
									$('#ProductWidth').val( msgArray.data.width );
									$('#ProductHeight').val( msgArray.data.height );
									$('#ProductWeight').val( msgArray.data.weight );
									$('#ProductSku').val( msgArray.data.sku );											
									$('#packagingType').val( msgArray.data.variant_envelope_id );
									
									if( msgArray.data.stock === null )
									{
										$( '#stockLabel' ).addClass( 'color-red-800' );
										$('#stock').val( "N/A" );										
									}
									else
									{
										$('#stock').val( msgArray.data.stock );	
									}
									
									//Set Html for inline rows will increase
									/*var str = '';
									str += '<div class="form-group count">';
									str += '<label for="username" class="control-label col-lg-3">Secondary Bin Location</label>';
									str += '<div class="col-lg-3">';
										str += '<input type="text" id="binLocation'+getCountLocationSize+'" class="form-control binLocation" name="data[binLocation'+getCountLocationSize+']">';
									str += '</div>';
									str += '<label for="username" class="control-label col-lg-1">Stock</label>';                                        
									str += '<div class="col-lg-3">';
										str += '<input type="text" id="stock'+getCountLocationSize+'" class="form-control stock" name="data[stock'+getCountLocationSize+']">';
									str += '</div>';
									str += '<div class="col-lg-2">';				
									str += '<button class="btn btn-danger color-white btn-dark" type="button"><i class="fa fa-close"></i></button>';
										str += '</div>';
								  str += '</div>';*/
									
									var str = '';
									var binLocate = msgArray.data.binLocationArray;	
									if( binLocate !== null )															
									{
										$.each(binLocate, function(idx, obj)
										{
											var index = idx;
											var idTable = obj.id;
											var bin_location = obj.bin_location;
											var stock_by_location = obj.stock_by_location;
											var barcode = obj.barcode;
											
											//Set AddMore Locations Html
											if( idx == 0 )
											{	
												str += '<div class="form-group count">';
													str += '<label class="control-label col-lg-3" for="username">Primary Bin Location</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="binLocation1" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation1]"></div>';
													str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="stock1" class="form-control stock" value="'+stock_by_location+'" name="data[stock1]"></div>';
												  str += '</div>';
											}										
											else if( idx == 1 )
											{
												str += '<div class="form-group count">';
													str += '<label class="control-label col-lg-3" for="username">Secondary Bin Location</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="binLocation2" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation2]"></div>';
													str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="stock2" class="form-control stock" value="'+stock_by_location+'" name="data[stock2]"></div>';
														str += '<div class="col-lg-2">';											
												str += '<button class="flushLocation btn btn-danger color-white btn-dark" type="button" for="'+index+'"><i class="fa fa-close"></i></button>';											
												str += '</div>';
												  str += '</div>';
											}
											else // for all
											{
												//Get Size
												var getCountLocationSize = parseInt($( "div.count" ).size()) + 1;	
														
												str += '<div class="form-group count">';
													str += '<label class="control-label col-lg-3" for="username">Secondary Bin Location</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="binLocation'+getCountLocationSize+'" class="form-control binLocation" value="'+bin_location+'" name="data[binLocation'+getCountLocationSize+']"></div>';
													str += '<label class="control-label col-lg-1" for="username">Stock</label>';                                        
													str += '<div class="col-lg-3">';                                            
														str += '<input type="text" id="stock'+getCountLocationSize+'" class="form-control stock" value="'+stock_by_location+'" name="data[stock'+getCountLocationSize+']"></div>';
														str += '<div class="col-lg-2">';											
												str += '<button class="flushLocation btn btn-danger color-white btn-dark" type="button" for="'+index+'"><i class="fa fa-close"></i></button>';											
												str += '</div>';
												  str += '</div>';
											}
												
										});
										$( "div.count" ).remove();
									
										//Add more at run time after at last
										$( "div.brandSelect" ).after( str );
										
									}
									else
									{
										$('#binLocation1').val('');
										$('#binLocation2').val('');
										$('#stock1').val('');
										$('#stock2').val('');	
									}	
								}
			});
	}
	
	
	
	
</script>
