<?php

class LocationsController extends AppController
{
    
    var $name = "Locations";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    public function index( $id = null )
    {
        
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Location' );
        else
            $this->set( 'role','Add Location' );
        
        $this->layout = "index";
              
        if( $this->request->is('post') )
        {
            $id = $this->request->data['Location']['id'];
            if( !empty($this->request->data) )
            {           
                 $this->Location->set( $this->request->data );
                 if( $this->Location->validates( $this->request->data ) )
                 {               
                      
                      /* Save data into table */
                      $this->Location->saveAll( $this->request->data );
                      
                      if( isset( $id ) & $id > 0 )
                        $this->Session->setflash( "[ ".$this->request->data['Location']['county_name']." ] county has been updated.", 'flash_success' );
                      else
                          $this->Session->setflash( "[ ".$this->request->data['Location']['county_name']." ] county has been added.", 'flash_success' );                      
                        
                      $this->redirect( array( 'controller' => 'showallLocation' ) );
                 }
                 else
                 {                
                    $error = $this->Location->validationErrors;                              
                 }
            }
        }
    }
    
    public function editlocation( $id = null )
    {
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Location' );
        else
            $this->set( 'role','Add Location' );
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getList = $this->Location->getLocationData( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getList;
        
    }
    
    public function showall()
    {
       
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All Countries" );
        $this->layout = "index";
                
        /* Start here getting roles list in array */        
        $getLocationArray = $this->Location->getRoleList();        
        $this->set( 'getLocationArray' , $getLocationArray);
    }
        
    /* Start here manage states function and other related logics */
    
    public function addstate( $id = null )
    {
        /* Start here set the country list */
        $options = array('fields' => array('Location.county_name'));      
        $getLocationArray = $this->Location->getRoleListForState( $options );
        $this->set( 'getLocationArray', $getLocationArray );
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit State' );
        else
            $this->set( 'role','Add State' );
        
        /* Check here isPost or not to avoid the inttreuptions from web browser URL direct hitting */
        if( $this->request->is( 'post' ) )
        {
            /* Load Model of state */
            $this->loadModel( 'State' );
            
            $id = $this->request->data['State']['id'];
            if( !empty($this->request->data) )
            {
                 
                 $this->State->set( $this->request->data );
                 if( $this->State->validates( $this->request->data ) )
                 {               
                      
                      /* Save data into table */
                      $this->State->saveAll( $this->request->data );
                      
                      if( isset( $id ) & $id > 0 )
                        $this->Session->setflash( "[ ".$this->request->data['State']['state_name']." ] state has been updated.", 'flash_success' );
                      else
                          $this->Session->setflash( "[ ".$this->request->data['State']['state_name']." ] state has been added.", 'flash_success' );                      
                        
                      $this->redirect( array( 'controller' => 'showallStates' ) );
                 }
                 else
                 {                
                    $error = $this->Location->validationErrors;                    
                 }
            }
        }        
    }
    
    public function showallstate()
    {
       
        /* Load State model here */
        $this->loadModel('State');
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All State" );
        $this->layout = "index";
                
        /* Start here getting roles list in array */        
        $getStateArray = $this->State->getStateList();        
        $this->set( 'getStateArray' , $getStateArray);
    }
        
    public function editstate( $id = null )
    {
        /* Load Model here */
        $this->loadModel('State');
        
         /* Start here set the country list */
        $options = array('fields' => array('Location.county_name'));      
        $getLocationArray = $this->Location->getRoleListForState( $options );
        $this->set( 'getLocationArray', $getLocationArray );
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit State' );
        else
            $this->set( 'role','Add State' );
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getStateList = $this->State->getStateDataById( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getStateList;        
    }
    
    public function statedelete( $id = null, $is_deleted = null )
    {
        
        /* Unset view */
        $this->autorender = false;
        
        /* Load City model here */
        $this->loadModel( 'State' );
        
        /* Set custom condition for user appearence */
        if( $is_deleted == 1 )
        {
        
            /* Start here setup delete function */
            $this->State->updateAll( array( "State.is_deleted" => "0", "State.status" => "1" ), array( "State.id" => $id ) );
            $msg = "Retreive Successful";
            
        }
        else
        {
            /* Start here setup delete function */
            $this->State->updateAll( array( "State.is_deleted" => "1", "State.status" => "1" ), array( "State.id" => $id ) );
            $msg = "Deletion Successful";
        }
        
        /* Redirect action after success */
        $this->Session->setflash( $msg, 'flash_success' );                      
        $this->redirect( array( "controller" => "showallStates" ) );
        
    }
    
    /* Ends here manage states function and other related logics */
    
    /* Start here manage cities function and other related logics */
    
    public function addcity( $id = null )
    {
        /* Start here set the country list */
        $options = array('fields' => array('Location.county_name'));      
        $getLocationArray = $this->Location->getRoleListForState( $options );
        $this->set( 'getLocationArray', $getLocationArray );
        
        /* Load Model of state */
        $this->loadModel( 'State' );
        $options = array('fields' => array('State.state_name'));  
        $getStateList = $this->State->getStateListForCity( $options );
        $this->set( 'getStateList', $getStateList );
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit City' );
        else
            $this->set( 'role','Add City' );
        
        /* Check here isPost or not to avoid the inttreuptions from web browser URL direct hitting */
        if( $this->request->is( 'post' ) )
        {            
            /* Load Model of state */
            $this->loadModel( 'City' );
            
            $id = $this->request->data['City']['id'];
            if( !empty($this->request->data) )
            {
                 
                 $this->City->set( $this->request->data );
                 if( $this->City->validates( $this->request->data ) )
                 {               
                      
                      /* Save data into table */
                      $this->City->saveAll( $this->request->data );
                      
                      if( isset( $id ) & $id > 0 )
                        $this->Session->setflash( "[ ".$this->request->data['City']['city_name']." ] county has been updated.", 'flash_success' );
                      else
                          $this->Session->setflash( "[ ".$this->request->data['City']['city_name']." ] county has been added.", 'flash_success' );                      
                        
                      $this->redirect( array( 'controller' => 'showallCities' ) );
                 }
                 else
                 {                
                    $error = $this->Location->validationErrors;                    
                 }
            }
        }        
    }
    
    public function showallcity()
    {
       
        /* Load State model here */
        $this->loadModel( 'Location' );
        $this->loadModel( 'State' );
        $this->loadModel('City');
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All City" );
        $this->layout = "index";

        /* Start here getting the list of roles */
        /* Set conditions */
        $options = array(
            'fields' => array('State.state_name','Location.county_name','City.id','City.city_name','City.status','City.is_deleted'),
            'joins' => array(
                array(
                    'alias' => 'State',  
                    'table' => 'states',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'State.id = City.state_id',
                    )
                ),
                array(
                    'alias' => 'Location',  
                    'table' => 'locations',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Location.id = City.location_id',
                    )
                )
            )
        );
                
        /* Start here getting roles list in array */        
        $getCityArray = $this->City->find( 'all', $options );        
        $this->set( 'getCityArray' , $getCityArray);
    }
        
    public function editcity( $id = null )
    {
        
        /* Start here set the country list */
        $options = array('fields' => array('Location.county_name'));      
        $getLocationArray = $this->Location->getRoleListForState( $options );
        $this->set( 'getLocationArray', $getLocationArray );
        
        /* Load Model of state */
        $this->loadModel( 'State' );
        $options = array('fields' => array('State.state_name'));  
        $getStateList = $this->State->getStateListForCity( $options );
        $this->set( 'getStateList', $getStateList );
        
        /* Load Model here */
        $this->loadModel('City');
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit City' );
        else
            $this->set( 'role','Add City' );
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getCityList = $this->City->getCityDataById( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getCityList;        
    }
    
    public function citydelete( $id = null, $is_deleted = null )
    {
        
        /* Unset view */
        $this->autorender = false;
        
        /* Load City model here */
        $this->loadModel( 'City' );
        
        /* Set custom condition for user appearence */
        if( $is_deleted == 1 )
        {
        
            /* Start here setup delete function */
            $this->City->updateAll( array( "City.is_deleted" => "0", "City.status" => "1" ), array( "City.id" => $id ) );
            $msg = "Retreive Successful";
            
        }
        else
        {
            /* Start here setup delete function */
            $this->City->updateAll( array( "City.is_deleted" => "1", "City.status" => "1" ), array( "City.id" => $id ) );
            $msg = "Deletion Successful";
        }
        
        /* Redirect action after success */
        $this->Session->setflash( $msg, 'flash_success' );                      
        $this->redirect( array( "controller" => "showallCities" ) );
        
    }
    
    public function actionlocunlock( $id = null, $str = null, $strAction = null )
    {
        
        /* Set here false to render the self view */
        $this->autorender = false;
        
        /* Action perform according active and deactive */
        
        if( $strAction === "cityAction" )
        {            
         
            /* Load City Model Here */
            $this->loadModel( "City" );
            
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
            
            $this->City->updateAll( array( "City.status" => $action ), array( "City.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showallCities" ) );
            
        }
        else if( $strAction === "stateAction" )
        {
            
            /* Load City Model Here */
            $this->loadModel( "State" );
            
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
            
            $this->State->updateAll( array( "State.status" => $action ), array( "State.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showallStates" ) );
            
        }
        else if( $strAction === "countyAction" )
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
            
            $this->Location->updateAll( array( "Location.status" => $action ), array( "Location.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showallLocation" ) );
            
        }
        else{}
        
    }
    
    /* Ends here manage cities function and other related logics */
            
}

?>
