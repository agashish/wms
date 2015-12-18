<?php

class ClientWarehouse extends AppModel
{
    
    var $name = "ClientWarehouse";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Client' => array(
                               
            'className' => 'Client',
            'foreignKey' => 'client_id'
                               
        )        
        
    );
    
    var $validate = array( 	
                        
        'warehouse_id' => array(            
            'rule' => array( 'checkChooseStatus' ),
            'required' => true,
            'message' => 'Please choose warehouse here!'            
        )
    );
    
    public function checkChooseStatus()
    {
        
        if( $this->data['ClientWarehouse']['warehouse_id'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
}

?>