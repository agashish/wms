<?php
class WarehousesController extends AppController
{
    
    var $name = "Warehouses";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
     public function addwarehouse( $id = null )
    {
		
        if(isset($this->request->data['WarehouseDesc']['id']))
        	$id = $this->request->data['WarehouseDesc']['id'];
		
        
        if( isset( $id ) & $id > 0 )
        {
            $this->set( 'role','Edit Warehouse' );
            $arraydata = $this->request->data;
            //$this->deleteWarehouseData( $arraydata );
		}
        else
            $this->set( 'role','Add Warehouse' );
        
        $this->layout = "index";
        $flag = false;
        $setNewFlag = 0;
        
        /* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );
              
        if( $this->request->is('post') )
        {
			//pr($this->request->data);
			
			
            $id = $this->request->data['Warehouse']['id'];
            if( !empty($this->request->data) )
            {
                /* Get validation result here */
                $this->Warehouse->set( $this->request->data );
                if( $this->Warehouse->validates( $this->request->data ) )
                {
                       $flag = true;                                      
                }
                else
                {
                   $flag = false;                   
                   $setNewFlag = 1;
                   $error = $this->Warehouse->validationErrors;
                }
                
                $this->Warehouse->WarehouseDesc->set( $this->request->data );   
                if( $this->Warehouse->WarehouseDesc->validates( $this->request->data ) )
                {
                       $flag = true;
                }
                else
                {
                   $flag = false;                   
                   $setNewFlag = 1;
                   $error = $this->Warehouse->WarehouseDesc->validationErrors;
                }
                
                    
                 if( $setNewFlag == 0 )//if( $this->Warehouse->validates( $this->request->data ) )
                 {               
                      
                      /* Save data into table */
                     
                      if($this->request->data['WarehouseDesc']['warehouse_type']  == 2)
                      {
						  //$this->request->data['WarehouseDesc']['warehouse_rack'] = '';
						  $this->request->data['WarehouseDesc']['warehouse_block'] = '';
						  //$this->request->data['WarehouseDesc']['warehouse_rack_label'] = '';
					  }
					  
				 
                      $this->Warehouse->saveAll( $this->request->data);
                      
                      if(empty($this->request->data['WarehouseDesc']['id']))
                      {        	
						 $lastinsertID = $this->Warehouse->getLastInsertId();
						  
					  }
					  else
					  {
						  $lastinsertID = $this->request->data['Warehouse']['id'];
					  }
					  		//exit;			  
					$this->loadModel('WarehouseRack');
					if($this->request->data['WarehouseDesc']['warehouse_type'] == 1)
					{
						$warehouseRack = $this->request->data['WarehouseRack'];
						$cnt = count($warehouseRack['warehouse_rack_label']);
		
						/* Rack Id array for manipulation */
						if(isset($this->request->data['WarehouseRackId']['custom_id']))
						$rackIdArray = explode("-",$this->request->data['WarehouseRackId']['custom_id']);
						
						for( $i = 0; $i < $cnt; $i++ )
							{
								if($warehouseRack['warehouse_rack_label'][$i] != '' && $this->request->data['WarehouseDesc']['warehouse_type'] == 1)
									{
										//$level  	= $warehouseRack['warehouse_rack_label'][$i];	
										
										if( isset( $rackIdArray[$i] ) && $rackIdArray[$i] > 0 )		
										{
											$id = $rackIdArray[$i];
											$level  	=  $warehouseRack['warehouse_rack_label'][$i];
										}
										else
										{
											$id = "";
											$level  	=  "";
										}
										
										
										$setArrays[$i]['WarehouseRack'] = array( "warehouse_id" => $lastinsertID, "warehouse_rack_label" => $level, "id" => $id );
									}
							}
						$i = 1;
						foreach($setArrays as $setArray)
						{
							
							
							if($setArray['WarehouseRack']['id'])
							{
							
								$label	=	'R'.$i;$i;								
								$rackRowId =  $setArray['WarehouseRack']['id'];
								$setNewUpdateArray['WarehouseRack']['id'] = $rackRowId;
								$setNewUpdateArray['WarehouseRack']['warehouse_rack_label'] = $label;								
								$this->WarehouseRack->saveAll($setNewUpdateArray);
								
							}
							else
							{						
								$label	=	'R'.$i;		
								$setUpdateArray['WarehouseRack']['warehouse_id'] = $setArray['WarehouseRack']['warehouse_id'];
								$setUpdateArray['WarehouseRack']['warehouse_rack_label'] = $label;
								$this->WarehouseRack->saveAll($setUpdateArray);
							}
							$i++;				
						}
					}
                
                      
                      if( isset( $id ) & $id > 0 )
                        $this->Session->setflash( "Data Updated" );
                      else
                          $this->Session->setflash( "Data Saved" );                      
                        
                      $this->redirect( array( 'controller' => 'showallWarehouses' ) );
                 }
                 else
                 {                
                    $error = $this->Warehouse->validationErrors;                              
                 }
            }
        }
    }
    
    public function showallwarehouse()
    {
       
        /* Load State model here */
        $this->loadModel( 'Location' );
        $this->loadModel( 'State' );
        $this->loadModel('City');
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All Warehouse" );
        $this->layout = "index";
        
        /* Start here getting the list of roles */
        /* Set conditions */
        $options = array(
            'fields' => array('State.state_name','Location.county_name','Warehouse.id','Warehouse.warehouse_name','WarehouseDesc.city_id','Warehouse.status','WarehouseDesc.warehouse_id','WarehouseDesc.is_deleted'),
            'joins' => array(
                array(
                    'alias' => 'State',  
                    'table' => 'states',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'State.id = WarehouseDesc.state_id',
                    )
                ),
                array(
                    'alias' => 'Location',  
                    'table' => 'locations',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Location.id = WarehouseDesc.location_id',
                    )
                )
            )
        );
                
        /* Start here getting roles list in array */        
        $getWarehouseArray = $this->Warehouse->find( 'all', $options );
        $this->set( 'getWarehouseArray' , $getWarehouseArray);
        
    }
    
    public function warehousedelete( $id = null, $is_deleted = null )
    {
        
        /* Unset view */
        $this->autorender = false;
        
        /* Set custom condition for user appearence */
        if( $is_deleted == 1 )
        {
        
            /* Start here setup delete function */
            $this->Warehouse->updateAll( array( "WarehouseDesc.is_deleted" => "0", "Warehouse.status" => "1" ), array( "Warehouse.id" => $id ) );
            $msg = "Retreive Successful";
            
        }
        else
        {
            /* Start here setup delete function */
            $this->Warehouse->updateAll( array( "WarehouseDesc.is_deleted" => "1", "Warehouse.status" => "1" ), array( "Warehouse.id" => $id ) );
            $msg = "Deletion Successful";
        }
        
        /* Redirect action after success */
        $this->Session->setflash( $msg, 'flash_success' );                      
        $this->redirect( array( "controller" => "showallWarehouses" ) );
        
    }
  
    public function editwarehouse( $id = null )
    {
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Warehouse' );
        else
            $this->set( 'role','Add Warehouse' );
                
        /* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );
        $this->loadModel( 'WarehouseRack' );
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getWarehouseList = $this->Warehouse->getWarehouseDataById( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        /* Start here getting Waherehouse Rack in array */        
        $getWarehouseArray = $this->Warehouse->find( 'first' ,array('conditions' => array('Warehouse.id'=> $id)));  
        $getWarehouseRackArray = $this->WarehouseRack->find( 'all',array('conditions' => array('Warehouse_id'=> $id)) );  
        $getWarehouseRackArrayId = $this->WarehouseRack->find( 'list',array('fields' => array('id'), 'conditions' => array('Warehouse_id'=> $id)) );  
        $getWarehouseArray['WarehouseRackData'] = $getWarehouseRackArray;
        $getWarehouseArray['WarehouseRackId'] = implode("-",$getWarehouseRackArrayId);
        $this->request->data = $getWarehouseArray;         
    }

	public function actionlocunlock($id = null, $status = null)
	{
        /* Unset view */
        $this->autorender = false;
        
        /* Set custom condition for user appearence */
        if( $status == 'Active' )
        {
        
            /* Start here setup delete function */
            $this->Warehouse->updateAll( array( "Warehouse.status" => "1" ), array( "Warehouse.id" => $id ) );
            $msg = "Deactivate Successful";
            
        }
        else
        {
            /* Start here setup delete function */
            $this->Warehouse->updateAll( array( "Warehouse.status" => "0" ), array( "Warehouse.id" => $id ) );
            $msg = "Activate Successful";
        }
        
        /* Redirect action after success */
        $this->Session->setflash( $msg, 'flash_success' );                      
        $this->redirect( array( "controller" => "showallWarehouses" ) );		
	}

	
	public function show_detail()
	{
		$this->autoRander = false;
		$this->layout = "";
		$id		=	$this->data['id'];
		$this->loadModel('WarehouseRack');
		
			/* Apply the join and condition to get the warehouse all detail */
		 $options['conditions'] = array('Warehouse.id' => $id);
         $options['fields'] = array('State.state_name','Location.county_name','City.city_name','Warehouse.id','Warehouse.warehouse_name','WarehouseDesc.warehouse_type','WarehouseDesc.warehouse_number');
         $options['joins'] = array(
                array(
                    'alias' => 'State',  
                    'table' => 'states',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'State.id = WarehouseDesc.state_id',
                    )
                ),
                array(
                    'alias' => 'Location',  
                    'table' => 'locations',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Location.id = WarehouseDesc.location_id',
                    )
                ),
                array(
                    'alias' => 'City',  
                    'table' => 'cities',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'City.id = WarehouseDesc.city_id',
                    )
                )
            );
        
	
		$detail			=	$this->Warehouse->find('first', $options);
		$rackDetails	=	$this->WarehouseRack->find('all', array('conditions' => array('WarehouseRack.warehouse_id' => $detail['Warehouse']['id'] )));
		$sectionCount	=	'0';
		
		$this->set(compact('rackDetails', 'detail'));
		$this->render('warehousedetailpopup');
		

	}

public function deleteRetrieveRack()
	{
		$this->loadModel( 'WarehouseRack' );
		
		$id					=	$this->data['id'];
		$deleteStatus		=	$this->data['deleteStatus'];
		if($deleteStatus == "Retrieve")
		{
			$isDelete = '0';
		}
		else
		{
			$isDelete = '1';
		}
		if($this->WarehouseRack->updateAll(array('WarehouseRack.is_deleted' => $isDelete), array( 'WarehouseRack.id' => $id)))
		{
			echo "Successfully"; 
			exit;
		}
		else
		{
			echo "0"; exit;
		}
	}
	
	public function detailWarehouseRack($id=null, $str= null)
    {
		$this->layout ="index";
		$this->set('role','Racks');
		
		$this->Warehouse->bindModel(array('hasMany' => array('WarehouseRack','WarehouseSection','WarehouseLevel','WarehouseBin')));
		$getWarehouseDetail	=	$this->Warehouse->find('first', array('conditions' => array('Warehouse.id' => $id)));
		//pr($getWarehouseDetail);
		//exit;
		$this->set('getWarehouseDetail', $getWarehouseDetail);
		
	}
	
	public function deleteBin()
	{
		$this->autoRander = false;
		$this->layout = "";
		$id = $this->data['binId'];
		
		$this->loadModel( 'WarehouseBin' );
	
		if($this->WarehouseBin->updateAll(array('WarehouseBin.is_deleted' => '1'), array( 'WarehouseBin.id' => $id)))
		{
			echo "Successfully Deleted."; exit;
		}
		else
		{
			echo "0"; exit;
		}
	}
	
	public function addSectionByRack()
	{
		$this->autoRander = false;
		$this->layout = 'ajax';
		
		$this->loadModel( 'WarehouseSection' );
		
		$wid	=	$this->data['wId'];
		$rid	=	$this->data['rid'];
		$sid	=	$this->data['sid'];
		if($sid)
		{
			$seid = $sid;
		}
		else
		{
			$sid = 0;
		}
		
		$findsectionDetail	=	$this->WarehouseSection->find('first', array('conditions' => array('WarehouseSection.warehouse_id' => $wid, 'WarehouseSection.warehouse_rack' => $rid, 'WarehouseSection.id' => $seid)));
		if(count($findsectionDetail) > 0) 
		{
			$section = $findsectionDetail['WarehouseSection']['section_label'];
			$sectionincrease  = $section + 1;
			$savesection =	array();
			if($sectionincrease > $section)
			{
				$savesection['WarehouseSection']['section_label'] = $sectionincrease;
				$savesection['WarehouseSection']['id'] = $sid;
				if($this->WarehouseSection->saveAll($savesection))
				{
					$this->Session->setflash( "Section Added Successfully" );
					exit;
				}
				else
				{
					echo "fail";
					exit;
				}
			}
		}
		else
		{
			$savesection['WarehouseSection']['warehouse_id'] = $wid;
			$savesection['WarehouseSection']['warehouse_rack'] = $rid;
			$savesection['WarehouseSection']['section_label'] = 1;
			$this->WarehouseSection->saveAll($savesection);
			
		}
	}
    
}
?>
