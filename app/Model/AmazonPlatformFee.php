<?php

class AmazonPlatformFee extends AppModel
{
   
    var $name = "AmazonPlatformFee";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    
    var $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'country'
        )
    );
    
    
     var $validate = array(
                          
        'packaging_type' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill packaging provider !'                                
            )                                                        
        ),
        'length' => array(            
            'rule' => array( 'notEmpty','numeric'),
            'required' => true,
            'rule' => array('numeric'),
            'message' => 'Please fill length (only numbers) !'            
        ),
        'width' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
            'message' => 'Please fill width (only numbers) !'            
        ),
        'height' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
            'message' => 'Please fill height (only numbers) !'            
        ),
        'min_weight' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
            'message' => 'Please fill min weight (only numbers) !'            
        ),
        'max_weight' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => array('numeric'),
            'message' => 'Please fill max weight (only numbers) !'            
        ),
        'fee' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill per item !',
            'rule' => array('numeric'),
			'message' => 'Please fill fee (only numbers)' 
		),
        'packaging_min_fee' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill per item !',
            'rule' => array('numeric'),
			'message' => 'Please fill fee (only numbers)' 
		),
		'packaging_min_fee' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill per item !',
            'rule' => array('numeric'),
			'message' => 'Please fill fee (only numbers)' 
		)
    );
    
}

?>
