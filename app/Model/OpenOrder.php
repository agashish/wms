<?php
class OpenOrder extends AppModel
{
    
    var $name = "OpenOrder";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    var $hasOne = array(
        
        'AssignService' => array(
            'className' => 'AssignService',
            'foreignKey' => 'open_order_id'
                               
        )        
        
    );    
}
?>
