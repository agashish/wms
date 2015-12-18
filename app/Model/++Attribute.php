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
       
        'attribute_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill Attribute name !'                                
            ),
         'unique' => array(
		    'rule' => array( 'checkUniqueness' ),
		    'required' => true,
		    'message' => 'Please choose unique attribute name !'                                                        
			)                                                     
        ),		
        'attribute_type' => array(            
            'rule' => array( 'checkChooseAttributeType' ),
            'required' => true,
            'message' => 'Please choose Attribute here !'            
        )
    );
    
    public function checkChooseAttributeType()
    {
        if( $this->data['Attribute']['attribute_type'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    
    public function checkUniqueness()
    {
		
		$Description 	=	$this->find('all', array('conditions' => array('Attribute.id !=' => $this->data['Attribute']['id'], 'Attribute.attribute_name' => $this->data['Attribute']['attribute_name'])));
		
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
