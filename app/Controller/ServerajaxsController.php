<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
error_reporting(0);
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ServerajaxsController extends AppController
{
    public $components = array();
    
    var $helpers = array('Common','Form','Html'); 
    // only allow the login controllers only
    public function beforeFilter()
    {        
        $this->Auth->allow('login');
    }
     
    public function isAuthorized($user)
    {
        // Here is where we should verify the role and give access based on role         
        return true;
    }
    
    public function getRacksBehindWarehouse()
    {
        
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = $this->request->input('json_decode', true );           
        }
        
        /* Load Related Models Here  */
        $this->loadModel( 'Warehouse' );
        $this->loadModel( 'WarehouseRack' );
        
        /* Set conditions */
        $options = array(
            'fields' => array('WarehouseRack.id' , 'WarehouseRack.warehouse_rack_label'),
            'joins' => array(
                array(
                    'alias' => 'WarehouseRack',  
                    'table' => 'warehouse_racks',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Warehouse.id = WarehouseRack.warehouse_id',                        
                    )
                ),array(
                    'alias' => 'WarehouseDesc',  
                    'table' => 'warehouse_descs',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Warehouse.id = WarehouseDesc.warehouse_id',                        
                    )
                )
            ),
            'conditions' => array( 'WarehouseRack.warehouse_id' => $data['action'],'WarehouseRack.is_deleted' => '0','WarehouseDesc.is_deleted' => '0' )
            
        );
        
        $getWarehouseFilterList = $this->Warehouse->find( 'list', $options );
        
        if( count( $getWarehouseFilterList ) > 0 )
        {
            $str = '<option value="">Choose</option>';
            foreach( $getWarehouseFilterList as $index => $key )
            {
                $str .= "<option value = '{$index}' >" . $key . "</option>";            
            }
            echo $str; exit;   
        }
        
        echo ""; exit;
    }
    
    /* Start here get section list from this function */
    public function getPrepareSectionListFromCounter()
    {        
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = $this->request->input('json_decode', true );
        }
        
        /* Get Post data here */
        $warehouseRackID	=	$data['action'];
        $warehouseID		=	$data['wh'];
        
        /* Load Related Models Here  */
        $this->loadModel( 'WarehouseSection' );
        
        /* Set conditions */        
        $getWarehouseFilterList = $this->WarehouseSection->find( 'all',  array('conditions' => array('WarehouseSection.warehouse_id' => $warehouseID, 'WarehouseSection.warehouse_rack'=> $warehouseRackID)) );
        
        if( count( $getWarehouseFilterList ) > 0 )
        {
            /* Set default option for section */
            $str = '<option value="">Choose</option>';
            
            /* Prepare list of section through counter */
            $e = 0;while( $e <= ($getWarehouseFilterList[0]['WarehouseSection']['section_label'] - 1) )
            {                
                /* Setup here the list of section corresponding specific warehouser and rack */
                $str .= "<option value =" . ($e + 1) . ">Section " . ($e + 1) . "</option>";                            
            $e++;    
            }
            echo $str; exit;   
        }
        else
        {            
            echo ""; exit;   
        }        
    }    
    /*********************End fetch section from table   *************************/
    
    /************************************ Code start for fetch level list **********************************************/    
    public function getLevelBehindSection()
    {
		/* Load Related Models Here  */
        $this->loadModel( 'WarehouseLevel' );
		
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = json_decode(file_get_contents('php://input'), true);  
        }
        
        $getWarehouseFilterList = $this->WarehouseLevel->find( 'all',  array('conditions' => 
        array(
        'WarehouseLevel.warehouse_id' => $data['whid'], 
        'WarehouseLevel.warehouse_rack'=> $data['rackid'],
        'WarehouseLevel.warehouse_section'=> $data['sectionid']
        ) ) );
      
        if( count( $getWarehouseFilterList ) > 0 )
        {
            /* Set default option for section */
            $str = '<option value="">Choose</option>';
            
            /* Prepare list of section through counter */
            $e = 0;while( $e <= ($getWarehouseFilterList[0]['WarehouseLevel']['warehouse_level'] - 1) )
            {                
                /* Setup here the list of section corresponding specific warehouser and rack */
                $str .= "<option value =" . ($e + 1) . ">Level " . ($e + 1) . "</option>";                            
            $e++;    
            }
            echo $str; exit;   
        }
        else
        {            
            echo ""; exit;   
        }      
        echo ""; exit;		
	}
    /************************************ Code end for fetch level list   **********************************************/
    
    /* Start here add level corresponding to sections */
    public function addLevelForWarehouse()
    {
        
        /* Load Model */
        $this->loadModel( 'WarehouseLevel' );
        
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = json_decode(file_get_contents('php://input'), true);           
        }
                  
        /* set cakephp array below that will be save acordingly */
        $cakephpJijArray = array();
        $cakephpJijArray['WarehouseLevel']['warehouse_id'] = $data['warehouse_id'];
        $cakephpJijArray['WarehouseLevel']['warehouse_rack'] = $data['warehouse_rack'];
        $cakephpJijArray['WarehouseLevel']['warehouse_section'] = $data['warehouse_section'];
        $cakephpJijArray['WarehouseLevel']['warehouse_level'] = $data['warehouse_level_text'];           
        $cakephpJijArray['WarehouseLevel']['level_status'] = $data['level_status'];
        $cakephpJijArray['WarehouseLevel']['is_deleted'] = $data['is_deleted'];
        
        /* Check duplicate row corresponding level */
        if( !isset($data['level_action']) )
        {
            $checklabel	= $this->WarehouseLevel->find('all', array('conditions' => array(
                        'WarehouseLevel.warehouse_id' => $data['warehouse_id'],
                        'WarehouseLevel.warehouse_rack' => $data['warehouse_rack'],
                        'WarehouseLevel.warehouse_section' => $data['warehouse_section']
                    )
                )
            );

            if(count($checklabel) > 0)
            {
                echo 'alreadyLevel' . '<>' . $checklabel[0]['WarehouseLevel']['id']; exit;
            }
        }
        
        /* Start here update level in case user need to edit the levels informations */
        if( isset($data['level_action']) )
        {
            $cakephpJijArray['WarehouseLevel']['id'] = $data['id'];            
            $getResultAfterSave = $this->WarehouseLevel->saveAll( $cakephpJijArray );
            echo "Level has been updated"; exit;
        }
        
        $getResultAfterSave = $this->WarehouseLevel->saveAll( $cakephpJijArray );
        echo "ok"; exit;
    }
    
    public function addSection() 
    {
        
		/* Load Model */
        $this->loadModel( 'WarehouseSection' );
        
        if($this->data['warehouse_id'] == '' || $this->data['warehouse_rack'] == '' || $this->data['section_label'] == '' )        
        {
            echo "error"; exit;
        }
        
		$sectionArray = array();
        $sectionArray['WarehouseSection']['warehouse_id'] 		= 	$this->data['warehouse_id'];
        $sectionArray['WarehouseSection']['warehouse_rack'] 	= 	$this->data['warehouse_rack'];
        $sectionArray['WarehouseSection']['section_label'] 		= 	$this->data['section_label'];
        $sectionArray['WarehouseSection']['section_status'] 	= 	$this->data['section_status'];
        $sectionArray['WarehouseSection']['is_deleted'] 		= 	$this->data['is_deleted'];
        
        if( !isset($this->data['section_action']) )
        {
            $checklabel	= $this->WarehouseSection->find('all', array('conditions' => array(
                        'WarehouseSection.warehouse_id' => $this->data['warehouse_id'],
                        'WarehouseSection.warehouse_rack' => $this->data['warehouse_rack']                    
                    )
                )
            );

            if(count($checklabel) > 0)
            {
                echo 'already' . '<>' . $checklabel[0]['WarehouseSection']['id']; exit;
            }
        }
        
        if( isset($this->data['section_action']) )
        {
            
            $sectionArray['WarehouseSection']['id'] = $this->data['warehouse_id'];
            /* Set conditions */
            $options = array(
                'conditions' => array(
                    'WarehouseSection.warehouse_id' => $this->data['warehouse_id'],
                    'WarehouseSection.warehouse_rack' => $this->data['warehouse_rack']
                )
            );
            
            $sectionArray['WarehouseSection']['id'] = $this->data['id'];
            $getResultAfterSave = $this->WarehouseSection->saveAll( $sectionArray );
            echo "Section has been updated"; exit;
        }
        
        $getResultAfterSave = $this->WarehouseSection->saveAll( $sectionArray );
        echo "ok"; exit;
		
	}
    
    private function getDuplicate( $dataArray = null )
    {
        
        echo "duplicate"; exit;
        
    }
    
    /************************************ Code start for create the unique bin number *****************************/
    
    public function getUniqueNumber()
    {
		$this->loadModel( 'WarehouseLevel' );
		 /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = $this->request->input('json_decode', true );
        }
        
        $forUniqueNumber = $this->WarehouseLevel->find( 'first',  array('conditions' => 
        array(
        'WarehouseLevel.warehouse_id' => $data['whid'], 
        'WarehouseLevel.warehouse_rack'=> $data['rackid'],
        'WarehouseLevel.warehouse_section '=> $data['sectionid'],
        'WarehouseLevel.id '=> $data['levelid']
        ) ) );
        
        if(count($forUniqueNumber) > 0)
        {
			$uniqueNumber = 'W'.$forUniqueNumber['WarehouseLevel']['warehouse_id'].'R'. $forUniqueNumber['WarehouseLevel']['warehouse_rack'].'S'. $forUniqueNumber['WarehouseLevel']['warehouse_section'].'L'.$forUniqueNumber['WarehouseLevel']['id'];
			echo '<input type="text" placeholder="" value = '. $uniqueNumber .' id="input-text" class="form-control unique_bin_number" disabled>';
			exit;
		}
	}
	
    /*************************************Code start for create the unique bin number ******************************/    
    public function getWarehouseFromCity()
	{
		/* Load Related Models Here  */
        $this->loadModel( 'Warehouse' );
		 /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = $this->request->input('json_decode', true );
        }
        if($data['city_id'])
        {
			$getWarehouseFilterList = $this->Warehouse->find( 'all',  array('conditions' => array('WarehouseDesc.city_id' => $data['city_id'],'WarehouseDesc.is_deleted' => '0') ) );
		}
		else
		{
			$getWarehouseFilterList = $this->Warehouse->find( 'all' );
		}
     
        if( count( $getWarehouseFilterList ) > 0 )
        {
            $str = '<option value="">Choose</option>';
            foreach( $getWarehouseFilterList as $getsectionList )
            {
		        $str .= "<option value =" .$getsectionList['Warehouse']['id'] . ">" . $getsectionList['Warehouse']['warehouse_name'] . "</option>";            
            }
            echo $str; exit;   
        }
        
        echo ""; exit;
	}
	
	public function getAllSection()
	{
		$this->autorander = false;
		$this->layout = "";
		$this->loadModel( 'Warehouse' );
		$this->loadModel( 'WarehouseRacks' );
		$this->loadModel( 'WarehouseSections' );
		
		$data = $this->request->input('json_decode', true );
		
		$id = $data['warehouseID']; 
		
        //$this->Warehouse->unBindModel( array( 'hasOne'=> array( 'WarehouseDesc' ) ) );
		
		$option	=	array();
           $options['fields'] = array('WarehouseSection.section_label', 'WarehouseSection.is_deleted','WarehouseSection.id','Warehouse.id','WarehouseRack.warehouse_rack_label', 'WarehouseRack.id','Warehouse.warehouse_name','Warehouse.status');
           $options['joins'] = array(
                array(
                    'alias' => 'WarehouseRack',  
                    'table' => 'warehouse_racks',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Warehouse.id = WarehouseRack.warehouse_id',						
                    )
                ),
                array(
                    'alias' => 'WarehouseSection',  
                    'table' => 'warehouse_sections',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Warehouse.id = WarehouseSection.warehouse_id',
                        'WarehouseRack.id = WarehouseSection.warehouse_rack',
                    )
                )
         );
         if($id)
         {
         $options['conditions'] = array('Warehouse.id'=> $id, 'WarehouseDesc.is_deleted !=' => '1','WarehouseRack.is_deleted' => '0', 'WarehouseSection.is_deleted' => '0');
		}
		else
		{
			$options['conditions'] = array('WarehouseDesc.is_deleted !=' => '1','WarehouseRack.is_deleted' => '0', 'WarehouseSection.is_deleted' => '0');
		}
        
        $getSectionDetail 	=	$this->Warehouse->find('all', $options);
        
        $this->set('getSectionDetail', $getSectionDetail);
        $this->render('showdata');
	}
	
	public function sectionUpdate()
	{
		$this->loadModel( 'WarehouseSection' );
		if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = json_decode(file_get_contents('php://input'), true);
        }
        
        
        $updateSection  = array();
        $updateSection['WarehouseSection']['id']			=	$data['sectionId'];
        $updateSection['WarehouseSection']['warehouse_id']		=	$data['warehouseId'];
        $updateSection['WarehouseSection']['section_label']		=	$data['sectionval'];
      
        if($this->WarehouseSection->saveAll($updateSection))
        {
			echo "editSection";
			exit;
		}
		else
		{
			echo "errorSection";
			exit;
		}
        
	}
	
	public function sectionDeleteRetrieve()
	{
		
	$this->loadModel( 'WarehouseSection' );
		
       
        $deleteSection 	=	array();
        $deleteSection['WarehouseSection']['id'] = $this->data['sectionId'];
        $deleteSection['WarehouseSection']['is_deleted'] = '1' ;
        
        if($this->WarehouseSection->saveAll($deleteSection))
        {
			echo "ok";
			exit;
		}
		else
		{
			echo "error";
			exit;
		}
	}
	
    /* Start here save bins */
    public function saveBin()
    {
		$this->loadModel( 'WarehouseBin' );
		
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;           
           $data = json_decode(file_get_contents('php://input'));           
        }
                
        /* Ensure us, coming array or not after tha will operate the below code */
        if( is_array( $data->{'data[WarehouseBin][warehouse_binLabel][]'} ) )
        {            
            /* Default validation, if user input same label.... that will not input in WMS Database */
            $dataValidateLabelDuplicacy = $data->{'data[WarehouseBin][warehouse_binLabel][]'};
            
            if( count( $dataValidateLabelDuplicacy ) > 1 )
            {            
                /* Decalare flag for check */
                $matchCase = false;
                $matchCounter = 0;
                
                /* Outer loop for rows */
                $outer = 0; while( $outer < count( $dataValidateLabelDuplicacy ) )
                {                
                    /* Inner loop for items */
                    $inner = 0; while( $inner < count( $dataValidateLabelDuplicacy ) )
                    {                    
                        /* Validate lable can't same */
                        if( $dataValidateLabelDuplicacy[$outer] == $dataValidateLabelDuplicacy[$inner] )
                        {
                            $matchCase = true;
                            $matchCounter += 1;
                            if( $matchCase == true && $matchCounter >= 2 )
                            {
                                echo "matchLabel"; exit;
                            }
                        }
                        
                    /* Inner loop complete */
                    $inner++;    
                    }      
                /* Outer loop complete */    
                $outer++;
                $matchCounter = 0;
                }
            }            
        }
        
        /* Check here duplicacy */
        if( !isset($data->{'bin_action'}) )        
        {
            $checklabel	= $this->WarehouseBin->find('all', array('fields'=>array('WarehouseBin.id'),'conditions' => array(
                        'WarehouseBin.warehouse_id' => $data->{'data[Level][warehouse_id]'},
                        'WarehouseBin.warehouse_rack' => $data->{'data[Level][warehouse_rack]'},
                        'WarehouseBin.warehouse_section' => $data->{'data[Level][warehouse_section]'},
                        'WarehouseBin.warehouse_level' => $data->{'data[Level][warehouse_level]'},
                        'WarehouseBin.is_deleted' => '0'
                    )
                )
            );

            if(count($checklabel) > 0)
            {
                $commaIds = array();
                /* Join with comma sepearted id's */
                $e = 0; while( $e < count($checklabel) )
                {
                    $commaIds[] = $checklabel[$e]['WarehouseBin']['id'];
                $e++;    
                }                
                echo 'alreadyBin' . '<>' .implode( ',' , $commaIds ); exit;
            }
        }
        
        /* Data set according to cakePhp conventions */
        $dataBin['WarehouseBin']['warehouse_section']		=	$data->{'data[Level][warehouse_section]'};
        $dataBin['WarehouseBin']['warehouse_id']			=	$data->{'data[Level][warehouse_id]'};
        $dataBin['WarehouseBin']['warehouse_rack']			=	$data->{'data[Level][warehouse_rack]'};
        $dataBin['WarehouseBin']['warehouse_level']		    =	$data->{'data[Level][warehouse_level]'};
        
        /* Update one by one */
        $dataBinIdArray			                            =	$data->{'data[WarehouseBin][warehouse_binId][]'};
		$dataBinLabelArray                                  = 	$data->{'data[WarehouseBin][warehouse_binLabel][]'};
        
        /* Save data of bin here and get insert id and update it again one by one for addMore concept */
        if( !empty( $dataBin ) )
        {            
            /* For Explode all ids in array */
            if( isset($data->{'bin_action'}) )
            {
                $getIds = explode( ",", $data->{'data[WarehouseBin][id]'} );
            }
            
            $e = 0; while( $e < count( $dataBinIdArray ) )
            {
                /* For updatation if ids exists in json */
                if( isset($data->{'bin_action'}) )
                {                    
                    $dataBin['WarehouseBin']['id'] = $getIds[$e];                    
                }
                else
                {
                    $dataBin['WarehouseBin']['id'] = '';
                }
                
                /* Check BinId is in array or not */
                if( is_array( $data->{'data[WarehouseBin][warehouse_binId][]'} ) )
                {
                    $getBinId = $dataBinIdArray[$e];
                    $sequenceRowId = explode( "-", $dataBinIdArray[$e] )[4];
                }
                else
                {
                    $getBinId = $data->{'data[WarehouseBin][warehouse_binId][]'};
                    $sequenceRowId = explode( "-", $data->{'data[WarehouseBin][warehouse_binId][]'})[4];
                }
                
                /* Here need to setup BinId and Label according to looping */
                $dataBin['WarehouseBin']['bin_unique_id']		    =	$getBinId;//$dataBinIdArray[$e] . '-' . '000' . ( $e + 1 );
                $dataBin['WarehouseBin']['bin_label']		        =	( $dataBinLabelArray[$e] == "" ) ? $dataBinLabelArray[$e] = $dataBin['WarehouseBin']['bin_unique_id'] : $dataBinLabelArray[$e];
                $dataBin['WarehouseBin']['bin_counter']		        =	$sequenceRowId;
                
                $this->WarehouseBin->saveAll($dataBin);
                $id	= $this->WarehouseBin->getLastInsertId();
                
            $e++;    
            }
            
            $matchCase = false;
            echo "ok"; exit;
        }
	}
    
    /* Start here getting the bins that would be relate to levels */
    function getAllBinsById()
    {
        
        $this->layout = '';
        
        CakeLog::write('debug', '.......Getting bin list below hmm......');
        $this->loadModel( 'WarehouseBin' );
		
        /* Cakephp will not find the action file into folder area */
        $this->autoRender = false;
       
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = json_decode(file_get_contents('php://input'));           
        }

        if( !empty( $data ) )
        {            
            /* Check here duplicacy */
            if( !isset($data->{'bin_action'}) )        
            {
                $checklabel	= $this->WarehouseBin->find('all', array('fields'=>array('WarehouseBin.id','WarehouseBin.bin_unique_id','WarehouseBin.bin_label'),'conditions' => array(
                            'WarehouseBin.warehouse_id' => $data->{'warehouse_id'},
                            'WarehouseBin.warehouse_rack' => $data->{'warehouse_rack'},
                            'WarehouseBin.warehouse_section' => $data->{'warehouse_section'},
                            'WarehouseBin.warehouse_level' => $data->{'warehouse_level'},
                            'WarehouseBin.is_deleted' => '0'
                        )
                    )
                );
                
                /* Get complete counter of rows have been inserted */
                $checklabelForCounter	= $this->WarehouseBin->find('all', array('fields'=>array('WarehouseBin.id','WarehouseBin.bin_counter'),'conditions' => array(
                            'WarehouseBin.warehouse_id' => $data->{'warehouse_id'},
                            'WarehouseBin.warehouse_rack' => $data->{'warehouse_rack'},
                            'WarehouseBin.warehouse_section' => $data->{'warehouse_section'},
                            'WarehouseBin.warehouse_level' => $data->{'warehouse_level'}                           
                        ),
                        'order' => array('WarehouseBin.id DESC'),
                        'limit' => '1'
                    )
                );
                
                if(count($checklabel) > 0)
                {
                    $this->set( 'checklabel', $checklabel );
                    $this->set( 'checklabelForCounter', $checklabelForCounter );
                    echo $html = $this->render( 'show_bin_list' );
                    exit;
                }
                else
                {
                    $setValue = 'WH'.$data->{'warehouse_id'} . '-' .$data->{'warehouse_rack_text'} . '-' . 'S' . $data->{'warehouse_section'} . '-' . 'L' . $data->{'warehouse_level'} . '-' . '0001'; 
                    $this->set( 'defaultBinData', array( "binId"=>$setValue ) );
                    $this->set( 'checklabel', '' );
                    echo $html = $this->render( 'show_bin_list' );
                    exit;
                }
            }            
        }        
    }
    
    /* Delete bins if available */
    function deleteBinsById()
    {        
        $this->layout = '';
        
        CakeLog::write('debug', '.......Getting bin list below hmm......');
        $this->loadModel( 'WarehouseBin' );
		
        /* Cakephp will not find the action file into folder area */
        $this->autoRender = false;
       
        /* Check Ajax request here */
        if( $this->request->is('ajax') )
        {
           $this->autoRender = false;
           $data = json_decode(file_get_contents('php://input'));           
        }

        if( !empty( $data ) )
        {            
            /* Check here duplicacy */
            if( !isset($data->{'bin_action'}) )        
            {
                $checklabel	= $this->WarehouseBin->find('all', array('fields'=>array('WarehouseBin.id','WarehouseBin.bin_unique_id','WarehouseBin.bin_label'),'conditions' => array(
                            'WarehouseBin.warehouse_id' => $data->{'warehouse_id'},
                            'WarehouseBin.warehouse_rack' => $data->{'warehouse_rack'},
                            'WarehouseBin.warehouse_section' => $data->{'warehouse_section'},
                            'WarehouseBin.warehouse_level' => $data->{'warehouse_level'},
                            'WarehouseBin.is_deleted' => '0'
                        )
                    )
                );
                
                if(count($checklabel) > 0)
                {
                    echo "already";
                    exit;
                }
                else
                {
                    echo "nothing";
                    exit;
                }
            }            
        }
        
        /* Delete the bins and change the is_deleted mode */
        if( isset($data->{'bin_action'}) )
        {            
            $dataBin['WarehouseBin']['id'] = $data->{'id'};
            $dataBin['WarehouseBin']['is_deleted'] = '1';
            
            if( $this->WarehouseBin->saveAll( $dataBin ) )            
                echo "ok";
            else
                echo "error";
                
            exit;
        }        
    }
    
   
	
	 public function getAllLevel()
    {
		
		$this->autorander = false;
		$this->layout = "";
		$this->loadModel( 'Warehouse' );
		$this->loadModel( 'WarehouseRacks' );
		$this->loadModel( 'WarehouseSections' );
		$this->loadModel( 'WarehouseLevel' );
		
		
		if( $this->request->is('ajax') )
        {
           $this->autoRender = false;           
           $data = json_decode(file_get_contents('php://input'));           
        }
        
		$this->Warehouse->bindModel(array('hasMany' => array('WarehouseRack','WarehouseSection','WarehouseLevel')));
		
		if($data->warehouseID != '')
			{
				$option['conditions'] = array(array('Warehouse.id'=> $data->warehouseID, 'WarehouseDesc.is_deleted !=' => '1'));	
				$getLevelDetail 	=	$this->Warehouse->find('all',$option);
			} 
		else
			{
				$option['conditions'] = array(array('WarehouseDesc.is_deleted !=' => '1'));	
				$getLevelDetail 	=	$this->Warehouse->find('all');
			}
		
		
       
        if(count($getLevelDetail) > 0)
			{
				$this->set('getLevelDetails', $getLevelDetail);
				$this->render('showlevel');
			}
		else
			{
				echo "error";
				exit;
			}
        
       
	}
	
	public function levelDeleteRetrieve()
	{
		/*load model for delete the level */
		$this->loadModel( 'WarehouseLevel' );
		
        if($this->data['retrieve'] == 'Retrieve')
        {
			$isDeleted = '0';
			$msg = "Successfully deleted.";
		}
		else
		{
			$isDeleted = '1';
			$msg = "Successfully deleted.";
		}
		
        $deleteSection 	=	array();
        $deleteSection['WarehouseLevel']['id'] = $this->data['levelId'];
        $deleteSection['WarehouseLevel']['is_deleted'] = $isDeleted;
       
       
        if($this->WarehouseLevel->saveAll($deleteSection))
        {
			echo $msg;
			exit;
		}
		else
		{
			echo "error";
			exit;
		}
	}
	
	public function levelUpdate()
	{
		$this->autorander = false;
		$this->layout = "";
		
		/* load model for edit the level */
		$this->loadModel( 'WarehouseLevel' );
		
		/* set the value in array */
		$updateLevel =	array();
		$updateLevel['WarehouseLevel']['id'] 				=	$this->data['sectionId'];
		$updateLevel['WarehouseLevel']['warehouse_level'] 	=	$this->data['sectionValue'];
		
		/* update level value in table by id */
		if($this->WarehouseLevel->saveAll($updateLevel))
        {
			echo "successfully.";
			exit;
		}
	}

	/**** Upload by amit gaur*****/

	public function getAllBin()
	{
		$this->autoRender = false;
		$this->layout = '';
		$this->data['warehouseID'];
		$this->data['sectionID'];
		$this->data['rackID'];
		
		
		$this->loadModel( 'WarehouseBin' );
		$getBinDetail	=	$this->WarehouseBin->find('all', array('conditions' => 
		array(
		'WarehouseBin.warehouse_id' => $this->data['warehouseID'],
		'WarehouseBin.warehouse_rack' => $this->data['rackID'] ,
		'WarehouseBin.warehouse_section' => $this->data['sectionID'], 
		'WarehouseBin.warehouse_level' => $this->data['levelID'],
		'WarehouseBin.is_deleted' => 0
		)));
		
		$this->set('getBinDetails', $getBinDetail);
		$this->render('showbin');
	}
	
	public function showBinUpdate()
	{
		$this->autoRender = false;
		$this->layout = '';
		$this->loadModel( 'WarehouseBin' );
		
		
		$updateBin	=	array();
		$updateBin['WarehouseBin']['bin_label'] 	= 	$this->data['binlabel'];
		$updateBin['WarehouseBin']['id'] 			= 	$this->data['binID'];
		
		if($this->WarehouseBin->saveAll($updateBin))
        {
			echo "Update Successfully.";
			exit;
		}
		else
		{
			echo "error";
			exit;
		}
		
	}
	
	public function showBinDelete()
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
	
	/****************************/
	
}
