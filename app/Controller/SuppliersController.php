<?php

class SuppliersController extends AppController
{
    
    var $name = "Suppliers";
    
    var $components = array('Session','Upload','Common');
    
    var $helpers = array('Html','Form','Session','Common');
    
    public function addsupplier($id = null) 
    {
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Supplier' );
        else
            $this->set( 'title','Add Supplier' );
		$this->layout = "index";
		
		/* Set upload path uri */
		$flag = false;
        $setNewFlag = 0;
        $uploadUrl	=	WWW_ROOT .'img/supplier/';
        $baseUri = Router::url('/');
		 /* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );
        
		if(!empty($this->request->data))
		{		
			 /* Get validation result here */
			  $id = $this->request->data['Supplier']['id'];
            
            if( $id > 0 )
            $imgExist = $this->request->data['SupplierImage']['imgExist'];
			 
                $this->Supplier->set( $this->request->data );
                if( $this->Supplier->validates( $this->request->data ) )
                {
                       $flag = true;                                      
                }
                else
                {
                   $flag = false;
                   $setNewFlag = 1;
                   $error = $this->Supplier->validationErrors;
                }
                
                $this->Supplier->SupplierDesc->set( $this->request->data );   
                if( $this->Supplier->SupplierDesc->validates( $this->request->data ) )
                {
                       $flag = true;
                }
                else
                {
                   $flag = false;
                   $setNewFlag = 1;
                   $error = $this->Supplier->SupplierDesc->validationErrors;
                }    
               
                $this->Supplier->SupplierContact->set( $this->request->data );   
				if( $this->Supplier->SupplierContact->validates( $this->request->data ) )
                {
                       $flag = true;
                }
                else
                {
                   $flag = false;
                   $setNewFlag = 1;
                   $error = $this->Supplier->SupplierContact->validationErrors;
                }
                
			
			if( $setNewFlag == 0 ) 
			{ 
				/* Insert data in supplier table */
				
				 /* Start here image is coming to upload or not */
                $file = $this->request->data['SupplierImage']['supplier_image'];
                //pr($file);
                if( isset( $file['name'] ) && $file['name'] != "" )
                        {
                            /* Here upload an image accordingly and validate it */
                           $getImageName = $this->Upload->upload($this->request->data['SupplierImage']['supplier_image'], $uploadUrl );
                           
                            /* Set client image name from upload component */
                            $this->request->data['SupplierImage']['supplier_image'] = $getImageName;
                            
                        }
                        else
                        {                            
                            /* If image array will blank than will set to string name */
                            $this->request->data['SupplierImage']['supplier_image']  = $imgExist;                                
                        }
				
				$this->Supplier->saveAll($this->request->data['Supplier']);
				$lastinsertID = $this->Supplier->getLastInsertId();	
				
				/* Insert data in supplier image table */
				$this->request->data['SupplierImage']['supplier_id'] = $lastinsertID;
				$this->Supplier->SupplierImage->saveAll($this->request->data['SupplierImage']);
				
				/* Insert data in supplier desc table */
				$this->request->data['SupplierDesc']['supplier_id'] = $lastinsertID;
				$this->Supplier->SupplierDesc->saveAll($this->request->data['SupplierDesc']);			
				
				/* Insert data in supplier contact table */
				$supplierContact = $this->request->data['SupplierContactOptional'];
				$this->request->data['SupplierContact']['supplier_id'] =	$lastinsertID;
				$this->Supplier->SupplierContact->saveAll($this->request->data['SupplierContact']);
				
				$cnt = count($supplierContact);
				
				for( $i = 0; $i < $cnt; $i++ )
				{
					if($supplierContact['supplier_label_optional'][$i] != '')
					{
						$label  = $supplierContact['supplier_label_optional'][$i];
						$email  = $supplierContact['supplier_email_optional'][$i];	
						$setArrays['SupplierContact'][$i] = array( "supplier_label" => $label, "supplier_email" => $email, "supplier_id" => $lastinsertID );
					}
				}
				
				foreach($setArrays as $setArray)
				{
						$this->Supplier->SupplierContact->saveAll($setArray);					
				}
				
				/************************/
				if( isset( $id ) && ($id > 0) )
                        {
                              
                              $this->Session->setflash( "Supplier details has been updated." );
                              $msg = " has been updated in our list";
                              
                              /* Here unset existing image when user will update with new image */
                              if( ( isset($getImageName) && $getImageName != "" ) )
                              {
                                
                                 $image_name = WWW_ROOT .'img/supplier/'.$imgExist;
                                 chmod($image_name, 0777);
                                 unlink ( $image_name );
                                
                               }
                        
                        }
                        else
                        {
                            $this->Session->setflash( "Supplier details has been saved." );
                            $msg = " has been added in our list";
                        }
                        
                        /* Set image path for popup appearance */
                        if( $getImageName != "" )
                            $image = Router::url('/'). 'app/webroot/img/supplier/' .$getImageName;
                        else
                            $image = Router::url('/'). 'app/webroot/img/supplier/' .$imgExist;
                        
                        $supplierName = $this->request->data['Supplier']['supplier_first_name'];
                        
                        /* Start here popup content with client image */                        
                        $popupArray	=	array(
                                              "","<div style = text-align:center; >
                                            <div class=clearfix>
                                            <div class=message>
                                            <img class= manage_image style='border-radius: 158px; height: 100px; width: 100px;' src=".$image." ></div>
                                        </div>
                                        <div class=form-group>
                                            <label for=username ><strong>".ucfirst($supplierName)."</strong> ".$msg."</label>                                                                                
                                        </div>
                                        <div class=form-group>
                                            <label for=username >Supplier :</label><label for=username >".ucfirst($supplierName)."</label>                                                                                
                                        </div>                                        
                                    </div>",$baseUri."showAllSupplier");
                        $this->set( "popupArray", $popupArray );
				/***********************/
			}
		}		
		$this->set(compact("title","Add Suppliers"));
	}
	
	
	public function showallsupplier()
	{
		 
        /* Load State model here */
        $this->loadModel( 'Location' );
        $this->loadModel( 'State' );
        $this->loadModel('City');
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All Supplier" );
        $this->layout = "index";
        
        /* Start here getting the list of roles */
        /* Set conditions */
        $options = array(
            'fields' => array('State.state_name','Location.county_name','City.city_name','Supplier.id','Supplier.supplier_first_name','Supplier.status','SupplierDesc.supplier_id','SupplierDesc.is_deleted'),
            'joins' => array(
                array(
                    'alias' => 'State',  
                    'table' => 'states',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'State.id = SupplierDesc.state_id',
                    )
                ),
                array(
                    'alias' => 'Location',  
                    'table' => 'locations',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Location.id = SupplierDesc.location_id',
                    )
                ),
                array(
                    'alias' => 'City',  
                    'table' => 'cities',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'City.id = SupplierDesc.city_id',
                    )
                )
            )
        );
                
        /* Start here getting roles list in array */        
        $getSupplierArray = $this->Supplier->find( 'all', $options );
       
        $this->set( 'getSupplierArray' , $getSupplierArray);
        
	}
	
	public function supplierdelete( $id = null, $is_deleted = null )
    {
       
        /* Unset view */
        $this->autorender = false;
        
        /* Set custom condition for user appearence */
        if( $is_deleted == 1 )
        {
        
            /* Start here setup delete function */
            $this->Supplier->updateAll( array( "SupplierDesc.is_deleted" => "0", "Supplier.status" => "1" ), array( "Supplier.id" => $id ) );
            $msg = "Retreive Successful";
            
        }
        else
        {
            /* Start here setup delete function */
            $this->Supplier->updateAll( array( "SupplierDesc.is_deleted" => "1", "Supplier.status" => "1" ), array( "Supplier.id" => $id ) );
            $msg = "Deletion Successful";
        }
        
        /* Redirect action after success */
        $this->Session->setflash( $msg, 'flash_success' );                      
        $this->redirect( array( "controller" => "showAllSupplier" ) );
        
    }
    public function actionlocunlock( $id = null, $str = null, $strAction = null )
    {
        
        /* Set here false to render the self view */
        $this->autorender = false;
        
        /* Action perform according active and deactive */
        
        if( $strAction === "SPAction" )
        {            
         
            if( $str === "Deactive" )
            {
                $action = 0;
                $msg = "Active Successful";
            }
            else
            {
                $action = 1;
                $msg = "Deactive Successful";
            }   
            
            $this->Supplier->updateAll( array( "Supplier.status" => $action ), array( "Supplier.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showAllSupplier" ) );
            
        }
    }
    
    public function editsupplier($id = null)
    {
		
        /*  Layout calling*/
        $this->layout = "index";
        $this->autorender = false;
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Supplier' );
        else
            $this->set( 'title','Add Supplier' );
                
        /* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getSupplierList = $this->Supplier->getSupplierDataById( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getSupplierList;      
	}
    
    

   
    
}

?>
