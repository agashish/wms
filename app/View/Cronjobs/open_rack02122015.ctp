<div class="rightside bg-grey-100">
	<div class="page-head bg-grey-100">
		<h1 class="page-title">Add Racks</h1>		
	</div>
	<div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">

			<div class="row">
				<div class="col-lg-3">
					<div class="panel">
						<div class="panel-title">
							<div class="panel-head">Search Rack</div>									
						</div>
						<div class="panel-body selectForm">
							<div class="form_container">
								<div class="form_inner_container row">
									<div class="col-lg-12">
										<?php											
											if( isset($rackNameList) && $rackNameList != '' )
											print $this->form->input( 'Rack.rack_name_select', array( 'type'=>'select', 'empty'=>'Choose Your Rack','options'=>$rackNameList, 'id' => 'rack_name_select', 'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Rack</div>									
						</div>
						<div class="panel-body">
							<div class="form_container">
								<div class="form_inner_container row">
									<div class="col-lg-12">
									<label>
											Rack Name :	
										</label>
									</div>
									<div class="col-lg-12">
									<input type="text" id="addNewRack" class="form-control" name="data[Rack][rack_name]">
									</div>
									<div class="col-lg-12">
									<button class="customNewRack btn bg-green-500 color-white btn-dark padding-left-10 padding-right-10 margin-top-10" type="submit">Add New Rack</button>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-lg-9">
					<div class="panel">
							<div class="panel-title">
								<div class="panel-head">View Rack</div>
									<div class="panel-tools">
										<a class="rackLabelPrint" href="#"><i class="ion-ios-printer"></i> Print </a>
									</div>
								
															
							</div>
							<div class="panel-body">
							<div class="img-roller" style="display:none;">
									<span>
										<img src="<?php print '/wms/img/studio.gif'; ?>" width="50" height="50" />
									</span>
								</div>	
								<div class="outerContainer">
								<?php
									if( isset( $rackData ) && $rackData != '' ):
								?>	
										<div class="innerContainer">											
											<div class="level_inner">
											<!-- Appear according to DB -->	
											<?php
												$rackName = explode('-',$rackData[0]->Rack->rack_level_section);
												$rackName = $rackName[0];
											?>
											<?php							
												$levelInc = 1;$inc = 1;$row = 0;$ik = 0;while( $ik < 5 ):	
												$rName = $rackName . '-L'.$inc;												
											?>
													<div class="level" id="<?php print $rName; ?>">
														<div class="actionBtn">
															<button type="button" class="addLevelSection btn bg-green-500 color-white btn-dark"><i class="fa fa-plus"></i></button>
															<button type="button" class="removeLevelSection btn btn-danger color-white btn-dark margin-top-10"><i class="fa fa-close"></i></button>
															
														</div>
														<div class="section-manage">
														<?php																
															$index = 0;			
															//if( $rackData[$row+$inc]->Rack->locking_stage_section == 0 ):
															$stInc = 1;$st = 0;while( $st < $rackData[$ik]->$index->sectionCounter ):
															$widthCalculate = 800 / $rackData[$ik]->$index->sectionCounter;
															
															$newId = explode( '-',$rackData[$ik]->Rack->rack_level_section );
															$rackName = $rackData[$ik]->Rack->rack_name;
															$level = 'L'.$levelInc;
															$section = 'S'.$stInc;
															$newLevlSection = $rackName.'-'.$level.'-'.$section;															
														?>
																<div class="section" id="<?php print $newLevlSection; ?>" style="width:<?php print $widthCalculate; ?>px">
																<?php
																	print $newLevlSection;
																?>
																<?php
																	if( file_exists( WWW_ROOT .'img/racks/barcodes/'.$newLevlSection.'.png' ) )
																	{
																?>
																		<br><img src="<?php print '/wms/img/racks/barcodes/'.$newLevlSection.'.png'; ?>" width="70" height="35" />
																<?php
																	}
																?>		
																</div>															
														<?php
															//endif;
															$st++;$stInc++;
															endwhile;
														?>													
														</div>							
													</div>
											<?php	
												$ik++;$inc = $inc+1;$row++;$levelInc++;
												endwhile;	
											?>									
											</div>
										</div>
								<?php
									endif;
								?>	
								</div>
							</div>
						</div>
					</div>						
			</div>

				</div>
			</div>		
		</div>	
		<script>			
			$(function()
			{	
				//Find last level to add level class
				//$( ".level:last" ).attr( 'style' , 'border-bottom:0px solid #999;' );
				
				//Choose Rack which one we need to see and make changes
				$( 'body' ).on( 'change', '#rack_name_select', function()
				{
					var rackSelectName = $('#rack_name_select').val();
					var rackText = $("select#rack_name_select option:selected").text();
					if( rackSelectName != '' )
					{
						//Check If input rack name exists in table or not
						$.ajax({
								url     	: getUrl() + '/cronjobs/getRackdetail',
								type    	: 'POST',
								data    	: {
												rackInputName : rackText											
											  },
								'beforeSend': function()
								{
									$( "div.img-roller" ).attr( 'style','display:block' );
									$( "div.outerContainer" ).attr( 'style','opacity:0.4' );								 
								},  			  
								success 	:	function( data  )
								{
									if( data == '1' )
									{
										$( "div.img-roller" ).attr( 'style','display:none' );
										$( "div.outerContainer" ).attr( 'style','' );
										
										alert( "Sorry, Already exist in system!" );
										return false;
									}
									else
									{
										$( "div.img-roller" ).attr( 'style','display:none' );
										$( "div.outerContainer" ).attr( 'style','' );
										//Deploy UI 
										$('div.outerContainer').html(data);
									}
								}                
							});	
						}
				});
				
				//Add and check for new racks 
				$( 'body' ).on( 'click', '.customNewRack', function()
				{
					var rackInputName = $( "#addNewRack" ).val();
					if( rackInputName == '' )
					{
						alert( "Please input new rack name!" );
					return false;
					}
					
					//Check If input rack name exists in table or not
					$.ajax({
							url     	: getUrl() + '/cronjobs/addRackBtnOnClick',
							type    	: 'POST',
							data    	: {
											rackInputName : rackInputName											
										  },
							'beforeSend': function()
							{
								$( "div.img-roller" ).attr( 'style','display:block' );
								$( "div.outerContainer" ).attr( 'style','opacity:0.4' );								 
							},  			  
							success 	:	function( data  )
							{
								if( data == '1' )
								{
									$( "div.img-roller" ).attr( 'style','display:none' );
									$( "div.outerContainer" ).attr( 'style','' );
									
									alert( "Sorry, Already exist in system!" );
									return false;
								}
								else
								{
									$( "div.img-roller" ).attr( 'style','display:none' );
									$( "div.outerContainer" ).attr( 'style','' );
									//Deploy UI 
									location.reload();
									//$('div.outerContainer').html(data);
								}
							}                
						});						
				});
							
				$( 'body' ).on( 'click', 'div.section_default', function()
				{
					var idSplit = $(this).attr( "id" ).split( '-' );					
					var rackName = idSplit[0];
					var rack_level_section = $(this).attr( "id" );
					
					var newSection2 = idSplit[0] +'-' + idSplit[1] +'-'+ 'S2';
					var sectionSplitStr = '<div class="section" id="'+rack_level_section+'">' +rack_level_section;
					sectionSplitStr += '<img src="/wms/img/racks/barcodes/'+rack_level_section+'.png" width="120" height="35" />';
					sectionSplitStr += '</div>';
					sectionSplitStr += '<div class="section section_last" id="'+newSection2+'">' +newSection2;
					sectionSplitStr += '<img src="/wms/img/racks/barcodes/'+newSection2+'.png" width="120" height="35" />';								
					sectionSplitStr += '</div>';	
					
					//$(this).attr( "id" ).remove();					
					$( '#'+idSplit[0]+ '-' + idSplit[1] ).find( 'div.section-manage' ).find( '#'+$(this).attr( "id" ) ).remove();
					$( '#'+idSplit[0]+ '-' + idSplit[1] ).find( 'div.section-manage' ).html( sectionSplitStr );
					
					//Storing cordinates of racks					 
					$.ajax({
							url     	: getUrl() + '/cronjobs/addRackCordinates',
							type    	: 'POST',
							data    	: {
											rackName : rackName,
											rack_level_section : rack_level_section
										  },
							success 	:	function( data  )
							{
								//$('.bin_data').html(data);
							}                
						});					
				});	
				
				//Click Evenhandler on Section
				$( 'body' ).on( 'click', 'div.actionBtn .addLevelSection', function()
				{
					
					//alert( $(this).parent().next().find('div.section').length );
					//return false;
					//var classSection = $(this).attr( 'class' );
					//var idSection = $(this).attr( 'id' );	
									
					var sectionDivCount = parseInt($(this).parent().next().find('div.section').size());
					var getWidth = $(this).parent().next().find('div.section').css('width').split('px')[0];							
					//var newWidth = parseInt(getWidth * sectionDivCount) / (sectionDivCount+1);
					var newWidth = 800 / (sectionDivCount+1);
					var parentLevelId = $(this).parent().next().find('div.section:last').parent().parent().attr('id').split('-');					
					var getCurrentRack = parentLevelId[0];
					var getCurrentLevel = parentLevelId[1];
					var setNewSectionId = getCurrentRack+'-'+getCurrentLevel+'-'+'S'+(sectionDivCount+1);
					var justParentRef = $(this).parent().next();
										
					// Add through Ajax simultaneously	
					if(sectionDivCount < 10 )									 
						$.ajax
						({
							url     	: getUrl() + '/cronjobs/addRackCordinatesByOne',
							type    	: 'POST',
							data    	: {
											rackName : getCurrentRack,
											rack_level_section : setNewSectionId
										  },
							'beforeSend': function()
							{
								$( "div.img-roller" ).attr( 'style','display:block' );
								$( "div.outerContainer" ).attr( 'style','opacity:0.4' );								 
							},  			  
							success 	:	function( data  )
							{
								if( data == 'done' )
								{
									var newImagePath = '/wms/img/racks/barcodes/'+ setNewSectionId +'.png';					
									var getNewWidth = 'width:'+newWidth+'px';
									var newRackAdd = '<div id="'+setNewSectionId+'" class="section">';
										newRackAdd += setNewSectionId;						
										newRackAdd += '<br><img width="70" height="35" src="'+ newImagePath +'">';
									newRackAdd += '</div>';
									
									// Set New Section at last
									justParentRef.find( 'div.section:last' ).after( newRackAdd );
									
									//Set new width accordingly
									justParentRef.find( 'div.section' ).attr( 'style' , getNewWidth );
									
									$( "div.img-roller" ).attr( 'style','display:none;' );
									$( "div.outerContainer" ).attr( 'style','opacity:1' );								 
								}
							}                
						});
				});
				
				//Remove Section
				$( 'body' ).on( 'click', 'div.actionBtn .removeLevelSection', function()
				{
					
					//alert( $(this).parent().next().find('div.section').length );
					//return false;
					//var classSection = $(this).attr( 'class' );
					//var idSection = $(this).attr( 'id' );	
									
					var sectionDivCount = parseInt($(this).parent().next().find('div.section').size());
					if( sectionDivCount > 2 )
					{
						var getWidth = $(this).parent().next().find('div.section').css('width').split('px')[0];															
						//var newWidth = parseInt(getWidth * sectionDivCount) / (sectionDivCount-1);						
						var newWidth = 800 / (sectionDivCount-1);						
						var parentLevelId = $(this).parent().next().find('div.section:last').parent().parent().attr('id').split('-');					
						var getCurrentRack = parentLevelId[0];
						var getCurrentLevel = parentLevelId[1];
						var setNewSectionId = getCurrentRack+'-'+getCurrentLevel+'-'+'S'+(sectionDivCount);
						var justParentRef = $(this).parent().next();
													
						// Add through Ajax simultaneously										 
						$.ajax
						({
							url     	: getUrl() + '/cronjobs/removeRackCordinatesByOne',
							type    	: 'POST',
							data    	: {
											rackName : getCurrentRack,
											rack_level_section : setNewSectionId
										  },
							'beforeSend': function()
							{
								$( "div.img-roller" ).attr( 'style','display:block' );
								$( "div.outerContainer" ).attr( 'style','opacity:0.4' );								 
							},  			  
							success 	:	function( data  )
							{
								if( data == 'delete' )
								{
									// Set New Section at last									
									justParentRef.find('div.section:last').remove();
																		
									//Set new width accordingly
									var getNewWidth = 'width:'+newWidth+'px';
									justParentRef.find( 'div.section' ).attr( 'style' , getNewWidth );									
									
									$( "div.img-roller" ).attr( 'style','display:none;' );
									$( "div.outerContainer" ).attr( 'style','opacity:1' );
									
								}
							}                
						});
					 }	
				});
				
				// Racl Label Print rackLabelPrint
				$( 'body' ).on( 'click', '.rackLabelPrint', function()
				{					
					// Add through Ajax simultaneously										 
					$.ajax
					({
						url     	: getUrl() + '/cronjobs/getPrint',
						type    	: 'POST',
						data    	: {},
						'beforeSend': function()
						{
															 
						},  			  
						success 	:	function( data  )
						{
							if( data == 'print' )
							{
															
							}
						}                
					});					
				});
						
			})
			function getUrl()
			{
				   //Do some stuff here
				   var getUrl = window.location;
				   var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
			return baseUrl;       
			}
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<style type="text/css">
			.innerContainer
			{
				width : 860px;
				height : 450px;
				outline:8px solid #999;	
				margin : 0 auto;	
				font-size:11px;
				text-align:center;
			}
			.level
			{
				height : 90px;
				
				border-bottom:2px solid #999;
			}
			.level_last
			{
				border-bottom:0px solid #999;
			}
			.section
			{
				width : 400px;
				border-right : 2px solid #999;
				height : 90px;
				float:left;
				padding:15px 0;
				-webkit-box-shadow: inset 0px 0px 30px -18px rgba(66,66,66,1);
-moz-box-shadow: inset 0px 0px 30px -18px rgba(66,66,66,1);
box-shadow: inset 0px 0px 30px -18px rgba(66,66,66,1);
			}
			.section_last
			{
				border-right:0px solid #999;
			}		
			.actionBtn{float:right; width:60px; padding:5px 0;}	
			.img-roller{position:absolute; top:50%; left:50%}
		</style>
