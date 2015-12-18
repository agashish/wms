<?php

class CoreprintersController extends AppController
{    
    var $name = "CorePrinters";    
    public function startThread( $customFeilds = array() )
    {		
		App::import( 'Component','Coreprint' );
		$Coreprint = new CoreprintComponent(new View());		
		return $Coreprint->setCurlAuth( $customFeilds );
	}
	 
	public function run( $customFeilds = array() )
	{
		return CoreprintersController::startThread( $customFeilds );
	}
    
    public function toPrint( $customFeilds = array() )
    {
		CoreprintersController::run( $customFeilds );
	}
        
    public function toAllPrinterNames()
    {
		App::import( 'Component','Coreprint' );
		$Coreprint = new CoreprintComponent(new View());
		$getPrinterData = $Coreprint->getAllOnPrinters();
				
		$setPrinterDataArray[] = array();
		$inc_ = 0;foreach( $getPrinterData as $indexPrinter => $indexPrinterValue )
		{
			$setPrinterDataArray[$inc_][0] = $indexPrinterValue->id;
			$setPrinterDataArray[$inc_][1] = $indexPrinterValue->name;
			$setPrinterDataArray[$inc_][2] = $indexPrinterValue->computer->state;
			$setPrinterDataArray[$inc_][3] = $indexPrinterValue->state;
		$inc_++;
		}	
		pr($setPrinterDataArray); exit;
	return $setPrinterDataArray; 		
	}
}

?>
