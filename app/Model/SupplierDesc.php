<?php

class SupplierDesc extends AppModel
{
    
    var $name = "SupplierDesc";

    /* Set here realation between SupplierDesc and Supplier */
    var $hasOne = array(
        
        'Supplier' => array(
                               
            'className' => 'Supplier',
            'foreignKey' => 'Supplier.id'
                               
        )        
        
    );
    
    var $validate = array( 	
        'email' => array(
            'notEmpty' => array(
                'rule' => array( 'email' ),
                'required' => true,
                'message' => 'Please enter a valid email address !'
                                
            )                                                        
        ),
        'location_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select Country !',
				'allowEmpty' => false
			)
        ),
        'state_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select State !',
				'allowEmpty' => false
			)
        ),
        'city_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select City !',
				'allowEmpty' => false
			)
        )
    );
    
}

?>
