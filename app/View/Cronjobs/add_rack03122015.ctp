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
