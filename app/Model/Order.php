<?php
class Order extends AppModel
{
    
    var $name = "Order";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    var $hasMany = array(
        
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'order_id'
                               
        )        
        
    );    
}
?>
