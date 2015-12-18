<?php

class SupplierContact extends AppModel
{
    
    var $name = "SupplierContact";
	var $belongsTo = "Supplier";
    /* Set here realation between SupplierDesc and Supplier */
    /*var $hasMany = array(
        
        'Supplier' => array(
                               
            'className' => 'Supplier',
            'foreignKey' => 'Supplier.id'
                               
        )        
        
    );*/
   
    var $validate = array( 	
       
        'supplier_label' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
				'message' => 'Please fill supplier label !'
            )                                                        
        ),         
        'supplier_email' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill supplier email !'
        )
    );
    
}

?>
