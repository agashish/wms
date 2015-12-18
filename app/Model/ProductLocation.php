<?php

class ProductLocation extends AppModel
{
    var $name = "ProductLocation";
    
     var $belongsTo = array(
        'Product'   => array(

            'className'  => 'Product',
            'foreignKey' => 'product_id',
        )
    );
    
}

?>
