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
                                      
									  <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Brand</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                            if(count($brandName) > 0)
                                                print $this->form->input( 'Product.brand', array( 'type'=>'select', 'empty'=>'Choose Brand', 'div'=>false,'options'=> $brandName, 'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                      </div>
                                      
                                      <!-- bin assosiation --->
                                      
                                      <div class="form-group">
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
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="username" class="control-label col-lg-3">Bin Location</label>                                        
                                        <div class="col-lg-7">                                            
                                            <?php
                                                print $this->form->input( 'binLocation', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
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
			
			if($('#binLocation').val() != '')
			{
				
				setSelectionValue();
			}
			
		}
	});

	$(function()
	{		
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
			
			/*//Get selected ground level text
			var groundLevel = $( '#groundFloor').val();//$( '#groundFloor :selected' ).text();
			
			//Get selected Rack level text
			var rackNumber = $( '#rackNumber').val(); //$( '#rackNumber :selected' ).text();
			
			//Get selected Level text
			var levelNumber = $( '#levelNumber').val(); //$( '#levelNumber :selected' ).text();
			
			//Get selected Section text
			var sectionNumberForBinAllocation = $( '#sectionNumber').val(); //$( '#sectionNumber :selected' ).text();
			*/
			
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
			$( '#levelNumber :selected' ).each(function(){				
				//console.log($(this).val() +'=='+ $(this).text());
				if( i == 0 )
					str += $(this).text();
				else
					str += ','+$(this).text();
			i++;	
			});	
			
			//Section				
			var s = 0;
			var strS = '';
			$( '#sectionNumber :selected' ).each(function(){				
				//console.log($(this).val() +'=='+ $(this).text());
				if( s == 0 )
					strS += $(this).text();
				else
					strS += ','+$(this).text();
			s++;	
			});					
			
			//Get combinedText text
			//var combinedText = $( '#groundFloor :selected' ).text() + '##' + $( '#rackNumber :selected' ).text() + '##' + $( '#levelNumber :selected' ).text() + '##' + $( '#sectionNumber :selected' ).text();
						
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
										groundText : strG,
										rackText : strR,
										levelText : str,
										sectionText : strS,
										bin_sku : bin_sku
										/*,
										combinedText : combinedText*/
									},
				'success' 		 : function( msgArray )
								   {
										if( msgArray == 1 )
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
											
											$('#groundFloor').val('');
											$('#rackNumber').val('');
											$('#levelNumber').val('');
											$('#sectionNumber').val('');
											
											location.reload();
											
											return false;	
										}
								   }
				});
				
		});
	})
	
	function setSelectionValue()
	{
		
		/*$("#groundFloor option:selected").each(function ()
		{
			$(this).removeAttr('selected'); 
        });
		$("#rackNumber option:selected").each(function ()
		{
			$(this).removeAttr('selected'); 
        });
		$("#levelNumber option:selected").each(function ()
		{
			$(this).removeAttr('selected'); 
        });
		$("#sectionNumber option:selected").each(function ()
		{
			$(this).removeAttr('selected'); 
        });*/
        		
		var binLocationText	=	$('#binLocation').val();	
		
		//Set Pattern
		var patternText = binLocationText.split( '-' );		
		
		//Get Groundtext
		var groundText = patternText[0].split( '_' ); 
		
		//For ground
		var e = 0;
		var k = 0 ;
		while( e < groundText.length )
		{										
			$("#groundFloor option").each(function()
			{
				if( $(this).text() == groundText[0] )
				{
					$(this).attr('selected', 'selected');  
				}											
			});	
		e++;	
		}	
		
		//For Rack
		var e = 0;
		var k = 0 ;
		while( e < groundText[1].length )
		{										
			$("#rackNumber option").each(function()
			{
				if( $(this).text() == groundText[1] )
				{
					$(this).attr('selected', 'selected');  
				}											
			});	
		e++;	
		}	
		
		//For Level
		var e = 0;
		var k = 0 ;
		while( e < patternText[1].length )
		{										
			$("#levelNumber option").each(function()
			{
				if( $(this).text() == (groundText[1] + '-' + patternText[1]) )
				{
					$(this).attr('selected', 'selected');  
				}											
			});	
		e++;	
		}
		
		//For Section
		var e = 0;
		var k = 0 ;
		while( e < binLocationText.length )
		{		
			$("#sectionNumber option").each(function()
			{
				if( $(this).text() == binLocationText )
				{
					$(this).attr('selected', 'selected');  
				}											
			});	
		e++;	
		}
	}
	
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
									
									//Set up
									$('div.floor_number').html( msgArray.data.groundLevel );
									$('div.rack_Number').html( msgArray.data.rack );											
									$('div.level_Number').html( msgArray.data.level );											
									$('div.section_Number').html( msgArray.data.section );
									
									//Make as default selection	
									var splitId = msgArray.data.bin_combined_text.split('##');
									
									var groundValue = splitId[0].split( ',' ); 
									
									//For ground
									var e = 0;
									var k = 0 ;
									while( e < groundValue.length )
									{										
										$("#groundFloor option").each(function()
										{
											if( $(this).text() == groundValue[e] )
											{
												$(this).attr('selected', 'selected');  
											}											
										});	
									e++;	
									}										
									
									//For Rack
									var e = 0;
									var k = 0 ;
									var groundValue = splitId[1].split( ',' );
									while( e < groundValue.length )
									{										
										$("#rackNumber option").each(function()
										{
											if( $(this).text() == groundValue[e] )
											{
												$(this).attr('selected', 'selected');  
											}											
										});	
									e++;	
									}	
									
									//For Rack
									var e = 0;
									var k = 0 ;
									var groundValue = splitId[2].split( ',' );
									while( e < groundValue.length )
									{										
										$("#levelNumber option").each(function()
										{
											if( $(this).text() == groundValue[e] )
											{
												$(this).attr('selected', 'selected');  
											}											
										});	
									e++;	
									}	
									
									//For Rack
									var e = 0;
									var k = 0 ;
									var groundValue = splitId[3].split( ',' );
									while( e < groundValue.length )
									{										
										$("#sectionNumber option").each(function()
										{
											if( $(this).text() == groundValue[e] )
											{
												$(this).attr('selected', 'selected');  
											}											
										});	
									e++;	
									}	
									
									var img	= msgArray.image;
									$('.image1').empty();
									$.each(img, function(i, item) {
												$('.image1').append('<img src='+item.imagename+' height = 150 width = 150>');
										});
									
									var location = msgArray.location;
									$('.location').empty();
									$.each(location, function(i, item)
									{
										$('.location').append('<strong>Warehouse : </strong>'+item.warehousename+'<br><strong>City : </strong>'+ item.city+'<br><br>	');
									});
									
									$('#ProductBrand option').each(function() {
										if($(this).text() == brandName) {
												jQuery('#ProductBrand').attr('<option value='+$(this).val()+' selected>'+$(this).text()+'</option>');
											}
										});
										
									
										
								}
			});
	}
</script>
