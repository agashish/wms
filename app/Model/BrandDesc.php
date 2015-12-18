<?php
class BrandDesc extends AppModel
{
    var $name = "BrandDesc";

    /* Set here relation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Brand' => array(
                               
            'className' => 'brand',
            'foreignKey' => 'brand_id'
                               
        )        
        
    );
    
    var $validate = array(
        'brand_desc' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill brand description!'                                
            )                                                        
        )	
    );
    
}

?>