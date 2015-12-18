<?php

class SupplierImage extends AppModel
{
    
    var $name = "SupplierImage";

    /* Set here realation between SupplierDesc and supplierimage */
    var $belongsTo = array(
        
        'Supplier' => array(
                               
            'className' => 'Supplier',
            'foreignKey' => 'Supplier.id'
                               
        )        
        
    );
    
}

?>
