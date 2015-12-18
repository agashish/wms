<?php

class AttributeSet extends AppModel
{
    var $name = "AttributeSet";
    
     /* Set here validation for product attribute */
    
    
    var $validate = array( 	
       
		'set_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill attribute set !'                                
            ),
         'set_name' => array(
		    'rule' => array( 'checkUniqueness' ),
		    'required' => true,
		    'message' => 'Please choose unique attribute set !'                                                        
			)                                                     
        )
    );
    
    
    public function checkUniqueness()
    {
		$Description 	=	$this->find('all', array('conditions' => array('AttributeSet.id !=' => $this->data['AttributeSet']['id'], 'AttributeSet.set_name' => $this->data['AttributeSet']['set_name'])));
		
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
