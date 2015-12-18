<?php

class ProductDesc extends AppModel
{
    var $name = "ProductDesc";
    
    var $belongsTo = array(
        'Product'   => array(

            'className'  => 'Product',
            'foreignKey' => 'product_id',
       
        )
    );
    
    
    var $validate = array( 	
       
        'short_description' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill short description !'                                
            )
        ),
        'long_description' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill short description !'                                
            )
        ),
        'weight' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
			'message' => 'Please fill weight ( only numbers )'            
        ),
        'length' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
			'message' => 'Please fill length ( only numbers )'            
        ),
        'width' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
			'message' => 'Please fill width ( only numbers )'            
        ),
        'height' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
			'message' => 'Please fill height ( only numbers )'            
        ),
        'barcode' => array(
        'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill Barcode !'),
		'isUnique' => array(
		'rule' => 'isUnique',
		'message' => 'This barcode has already been used.'
		))
    );
   
}

?>
