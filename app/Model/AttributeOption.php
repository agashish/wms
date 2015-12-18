<?php

class AttributeOption extends AppModel
{
    var $name = "AttributeOption";
    
     /* Set here validation for product attribute */
     
     var $belongsTo = array(
                           
        'Attribute'  => array(
                           
            'className' => 'Attribute',
            'foreignKey' => 'attribute_id'
                           
        )                       
                           
    ); 
}

?>
