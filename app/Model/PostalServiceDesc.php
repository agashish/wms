<?php

class PostalServiceDesc extends AppModel
{
    
    var $name = "PostalServiceDesc";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    
    var $belongsTo = array(
        
        'ServiceLevel' => array(
            'className' => 'ServiceLevel',
            'foreignKey' => 'service_level_id'
        ),
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'delevery_country'
        ),
        'PostalProvider' => array(
            'className' => 'PostalProvider',
            'foreignKey' => 'postal_provider_id'
            )
        
        
    );
    
    
     var $validate = array(
                          
        'postal_provider_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill postal provider !'                                
            )                                                        
        ),
        'service_level_id' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select service level !'            
        ),
        'warehouse' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select warehouse !'            
        ),
        'delevery_country' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select delevery country !'            
        ),
        'service_name' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill service name !'            
        ),
        'provider_ref_code' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill provider ref code !'            
        ),
        'per_item' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill per item !',
            'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'                        
        ),
        'per_kilo' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill per kilo !',
            'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'                        
        ),
        'ccy_prices' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select currency code !'            
        ),
        'size_thickness' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill size thickness !'            
        ),
        'max_weight' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill max_weight !',
            'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'            
        ),
        'tracked' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select tracked status !'            
        ),
        'delivery_time' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill delevery time !'            
        ),
        'cn_required' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select CN22 time !'            
        ),
        'manifest' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select manifest !'            
        ),
        'lvcr' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select lvcr !'            
        ),
        'max_length' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill max length !',
            'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'            
        ),
        'max_width' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill max width !'  ,
            'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'          
        ),
        'max_height' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill max height !',
			'rule' => array('numeric'),
			'message' => 'Please enter only numbers !'
	    ),
	    'custom_country' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please select custom country !'            
        )
        
    );
    
}

?>
