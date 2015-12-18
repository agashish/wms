<?php
class AssignService extends AppModel
{
    
    var $name = "AssignService";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    var $belongsTo = array(
        
        'OpenOrder' => array(
            'className' => 'OpenOrder',
            'foreignKey' => 'open_order_id'
                               
        )        
        
    );    
}
?>
