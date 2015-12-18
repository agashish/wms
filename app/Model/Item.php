<?php
class Item extends AppModel
{
    
    var $name = "Item";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Order' => array(
                               
            'className' => 'Order',
            'foreignKey' => 'order_id'
        )        
    );    
}
?>
