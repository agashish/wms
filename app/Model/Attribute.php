<?php

class Attribute extends AppModel
{
    var $name = "Attribute";
    
     /* Set here validation for product attribute */
    
    var $hasMany = array(
        
        'AttributeOption'   => array(
			'className'  => 'AttributeOption',
            'foreignKey' => 'attribute_id',
            'dependent' => true
		)
    );
    
    var $validate = array( 	
       
        'attribute_label' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill attribute name !'                                
            )                                                    
        ),
        'attribute_code' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill attribute code !'                                
            ),
         'attribute_code' => array(
		    'rule' => array( 'checkUniqueness' ),
		    'required' => true,
		    'message' => 'Please choose unique attribute code !'                                                        
			)                                                     
        ),		
        'system_generated' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please choose !'            
        ),		
        'attribute_type' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please choose attribute type !'            
        ),
        'attribute_status' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please choose status !'            
        ),
        'is_required' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'message' => 'Please choose status !'            
        )
    );
    
    
   /* public function checkChooseAttributeType()
    {
        if( $this->data['Attribute']['attribute_type'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }*/
    
    
    public function checkUniqueness()
    {
		
		$Description 	=	$this->find('all', array('conditions' => array('Attribute.id !=' => $this->data['Attribute']['id'], 'Attribute.attribute_code' => $this->data['Attribute']['attribute_code'])));
		
		if($Description)
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
