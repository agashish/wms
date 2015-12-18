<?php

class RolesController extends AppController
{
    
    var $name = "Roles";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    public function index( $id = null )
    {
        
        /* Set custom id for update data */
	if(isset($this->request->data['Role']['id']))
        	$id = $this->request->data['Role']['id'];
        
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Role' );
        else
            $this->set( 'role','Add Role' );
        
        $this->layout = "index";
        
        if( !empty($this->request->data) )
        {           
             $this->Role->set( $this->request->data );
             if( $this->Role->validates( $this->request->data ) )
             {               
                  
                  /* Save data into table */
                  $this->Role->saveAll( $this->request->data );                  
                  $this->Session->setflash( "[ ".$this->request->data['Role']['role_name']." ] role has been added.", 'flash_success' );
                  $this->redirect( array( 'controller' => 'showRoles' ) );
             }
             else
             {                
                $error = $this->Role->validationErrors;                              
             }
        }
       
    }
    
    public function editrole( $id = null )
    {
        
        /*  Layout calling*/
        $this->layout = "index";
        
        /* Set Custom Title here */
        if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Role' );
        else
            $this->set( 'role','Add Role' );
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getList = $this->Role->getRoleData( $id );
        
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getList;
        
    }
    
    public function showall()
    {
        
        /* Load Model here for load all role types */
        $this->loadModel( 'RoleType' );
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "role","Show All Roles" );
        $this->layout = "index";
        
        /* Start here getting the list of roles */
        /* Set conditions */
        
        
        /* Start here getting roles list in array */        
        $getRoleArray = $this->Role->find( 'all' );    
        $this->set( 'getRoleArray' , $getRoleArray);
    }
}

?>
