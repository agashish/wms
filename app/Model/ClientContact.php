<?php

class ClientContact extends AppModel
{
    
    var $name = "ClientContact";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Client' => array(
                               
            'className' => 'Client',
            'foreignKey' => 'client_id'
			)        
		);		
}

?>
