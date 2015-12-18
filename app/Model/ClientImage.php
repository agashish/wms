<?php

class ClientImage extends AppModel
{
    
    var $name = "ClientImage";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Client' => array(
                               
            'className' => 'Client',
            'foreignKey' => 'client_id'
                               
        )        
        
    );
    
}

?>