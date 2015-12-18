<?php

class Client extends AppModel
{
    
    var $name = "Client";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    var $hasOne = array(
        
        'ClientDesc' => array(
                               
            'className' => 'ClientDesc',
            'foreignKey' => 'client_id'
                               
        )
        ,        
        'ClientImage' => array(
            
            'className' => 'ClientImage',
            'foreignKey' => 'client_id'
            
        ),        
        'ClientWarehouse' => array(
            
            'className' => 'ClientWarehouse',
            'foreignKey' => 'client_id'
            
        )
        
    );
    
     var $hasMany = array(
        
        'ClientContact' => array(
                               
            'className' => 'ClientContact',
            'foreignKey' => 'client_id'
                               
        )
    );
    
    var $validate = array( 	
       
        'client_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill client name!'                                
            )                                                        
        ),         
        'status' => array(            
            'rule' => array( 'checkChooseStatus' ),
            'required' => true,
            'message' => 'Please choose status here!'            
        )
    );
    
    public function checkChooseStatus()
    {
        
        if( $this->data['Client']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
        
    public function getClientDataById( $id = null )
    {
        return $this->findById( $id );        
    }
    
}

?>
