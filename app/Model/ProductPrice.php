<?php

class ProductPrice extends AppModel
{
    var $name = "ProductPrice";
    
    var $belongsTo = array(
        'Product'   => array(

            'className'  => 'Product',
            'foreignKey' => 'product_id',
       
        )
    );
    
    
    var $validate = array( 	
        'product_price' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill price !'                                
            )
        )
    );
    
    public function checkChooseTax()
    {
		if( $this->data['ProductPrice']['tax_class'] === "")
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
