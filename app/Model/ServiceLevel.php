<?php

class ServiceLevel extends AppModel
{
    
    var $name = "ServiceLevel";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    
    var $hasMany = array(
        
        'PostaServiceDesc' => array(
            'className' => 'PostalServiceDesc',
            'foreignKey' => 'service_level_id'
        )
    );
    
    
}

?>
