<?php
	
	class CoreprintComponent extends Component
	{	
		
		function startup (Controller $controller)
        {
            
		}
        
        /*
         * Function : Print Methods Print anyWhere
         * Version : 1.0
         * Company : Euraco US - UK - India - Europe
         * Parameters : @Null
         * Result List Array
         * 
         */        

		public function setCurlAuth( $customFeilds = array() )
        {
						
			/* Start here set the Auth list */            
            App::import('Helper','Coreprinting');
			$Coreprinting = new CoreprintingHelper(new View());                        
            
            //Set Data
            //$postFeilds = $Coreprinting->setDtlToPrt( $customFeilds['printerId']  , $customFeilds['title']  , $customFeilds['contentType'] , $customFeilds['content']  , $customFeilds['source'] );
            
            $postFeilds = array(
				'printerId' => $customFeilds['printerId'],
				'title' => $customFeilds['title'],
				'contentType' => $customFeilds['contentType'],
				'content' => $customFeilds['content'],
				'source' =>  $customFeilds['source']
			);
            
            //'https://app.printnode.com/testpdfs/ups_label.pdf'
            // Set authentication
            $username = $Coreprinting->getAuth();
			$password = '';
			$host = $Coreprinting->combHost();
			
			//Get Authentication through auth			
			$username=$Coreprinting->getAuth();
			$password='';
			$URL=$host;
			
			//Curl authentication and hack part initialized but mnadoty to see and keep in your mind before touch or editing any sigle word , It can be involve in pain
			$ch = $Coreprinting->curlInitialize();	
			
			//Set Url					
			$Coreprinting->setOptUrl( $ch, $URL );
			
			//Set Timeout
			$Coreprinting->setTout( $ch );
			
			//Set Verification
			$Coreprinting->setVerify( $ch , false );
			
			//Set Post
			//curl_setopt($ch, $Coreprinting->setPost(), 1);
			$Coreprinting->setPostNow( $ch );
			
			//curl_setopt($ch, $Coreprinting->setPostFeild(), http_build_query( $postFeilds ));
			$Coreprinting->setPostOutNow( $ch , $postFeilds );
			
			//Set Tranfer Verification
			$Coreprinting->setTransferVerify( $ch , false );
			
			//Set and get Authentication through Hack
			$Coreprinting->setCurlAuth( $ch , false );
			
			//Get details from now and fetr would be flush
			$Coreprinting->getDetailNow( $ch , $username , $password );
			
			//Get status code
			$status_code = curl_getinfo($ch,$Coreprinting->getCodeHttp());   //get status code
			
			// Now execution
			$result = $Coreprinting->getExec( $ch );
			
			//Shut down
			$Coreprinting->curlShutDown( $ch );
		return json_decode( $result );			
        }
        
        public function getAllOnPrinters()
        {
			/* Start here set the Auth list */            
            App::import('Helper','Coreprinting');
			$Coreprinting = new CoreprintingHelper(new View());                        
            
            // Set authentication
            $username = $Coreprinting->getAuth();
			$password = '';
			$host = $Coreprinting->setPrinterUri();
			
			//Get Authentication through auth			
			$username=$Coreprinting->getAuth();
			$password='';
			$URL=$host;			
			
			//Curl authentication and hack part initialized but mnadoty to see and keep in your mind before touch or editing any sigle word , It can be involve in pain
			$ch = $Coreprinting->curlInitialize();	
			
			//Set Url					
			$Coreprinting->setOptUrl( $ch, $URL );
			
			//Set Timeout
			$Coreprinting->setTout( $ch );
			
			//Set Verification
			$Coreprinting->setVerify( $ch , false );
			
			//Set Tranfer Verification
			$Coreprinting->setTransferVerify( $ch , false );
			
			//Set and get Authentication through Hack
			$Coreprinting->setCurlAuth( $ch , false );
			
			//Get details from now and fetr would be flush
			$Coreprinting->getDetailNow( $ch , $username , $password );
			
			//Get status code
			$status_code = curl_getinfo($ch,$Coreprinting->getCodeHttp());   //get status code
			
			// Now execution
			$result = $Coreprinting->getExec( $ch );
			
			//Shut down
			$Coreprinting->curlShutDown( $ch );
			
		return json_decode( $result );			
		}

	}
	
?>
