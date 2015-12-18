<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel
{
    
    var $name = "User";
    
    var $validate = array(
                          
        'first_name' => array(
            'notEmpty' => array(
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill first name !'
                                
            )                                                        
        ),
        'last_name' => array(
            'notEmpty' => array(
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill last name !'
                                
            )                                                        
        ),  
        'email' => array(
                                
            'notEmpty' => array(
                'rule' => array( 'email' ),
                'required' => true,
                'message' => 'Please enter a valid email address !'
                                
            )                                                        
        ),
        'country' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select Country !',
				'allowEmpty' => false
			)
        ),
        'state' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select State !',
				'allowEmpty' => false
			)
		), 
		'city' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select City !',
				'allowEmpty' => false
			)
		),                        
		'phone_number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select Phone No. !',
				'allowEmpty' => false
			)
		),                        
		'role_type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select role. !',
				'allowEmpty' => false
			)
		),                        
    
    );
	
	
	public function beforeSave($options = array())
	{
		
        // hash our password		
		
        if( isset($this->data[$this->alias]['password']) )
		{
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        
        // fallback to our parent
        return parent::beforeSave($options);
    }
	
}

?>
