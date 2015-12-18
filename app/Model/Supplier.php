<?php

class Supplier extends AppModel
{
    
    var $name = "Supplier";
    var $hasMany = "SupplierContact";
    /* Set here realation between Supplier and SupplierDesc */
    var $hasOne = array(
        
        'SupplierDesc' => array(
                               
            'className' => 'SupplierDesc',
            'foreignKey' => 'supplier_id'
                               
        ),
        'SupplierImage' => array(
                               
            'className' => 'SupplierImage',
            'foreignKey' => 'Supplier_id'
                               
        ),
        /*'SupplierContact' => array(
			
			'className'	=>	'SupplierContact',
			'foreignKey'	=> 'supplier_id'	
        )*/
        
    );
	
	var $validate = array( 	
       
        'supplier_first_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill supplier first name!'                                
            )                                                        
        ),         
        'supplier_last_name' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please fill supplier second name!'            
        )
    );
	
	
    public function getSupplierDataById( $id = null )
    {
        
        return $this->findById( $id );
        
    }
    
}

?>
