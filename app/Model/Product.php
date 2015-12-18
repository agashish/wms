<?php

class Product extends AppModel
{
    var $name = "Product";
    
    var $hasOne = array(
        'ProductDesc'   => array(

            'className'  => 'ProductDesc',
            'foreignKey' => 'product_id',
      
        ),
        'ProductPrice'   => array(

            'className'  => 'ProductPrice',
            'foreignKey' => 'product_id',
      
        )
        
    );
    
    var $hasMany = array(
		'ProductLocation' => array(
			
			'className' => 'ProductLocation',
			'foreignKey' => 'product_id'
		)
    
    );
    
    
    var $validate = array( 	
       
        'product_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill Product name !'                                
            )
        ),
        'product_sku' => array(
        
        'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill SKU !'),
		'isUnique' => array(
		'rule' => 'isUnique',
		'message' => 'This SKU has already been used.'
		)),
        'product_status' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'checkChooseStatus' ),
                'required' => true,
                'message' => 'Please select status !'                                
            )
        )
    );
    
    
    
    
    public function checkChooseStatus()
    {
		if( $this->data['Product']['product_status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
	}
    
}

?>
