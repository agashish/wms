<?php

class PostalProvider extends AppModel
{
    
    var $name = "PostalProvider";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    
    var $hasMany = array(
        
        'PostalProvider' => array(
            'className' => 'PostalServiceDesc',
            'foreignKey' => 'service_level_id'
        )
    );
    
     var $validate = array(
                          
        'provider_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill postal provider name !'                                
            ))
        );
    
}

?>
