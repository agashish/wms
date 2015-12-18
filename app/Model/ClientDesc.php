<?php

class ClientDesc extends AppModel
{
    
    var $name = "ClientDesc";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Client' => array(
                               
            'className' => 'Client',
            'foreignKey' => 'client_id'
                               
        )        
        
    );
    
    var $validate = array(
        
        'location_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'checkChoose', 'location_id' ),
                'required' => true,
                'message' => 'Please choose county name!'                                
            )                                                        
        ),
        
        'state_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'checkChoose', 'state_id'  ),
                'required' => true,
                'message' => 'Please choose state name!'                                
            )                                                        
        ),
                          
        'city_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill city name!'                                
            )                                                        
        ),
        'client_mobile' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill mobile number!'                                
            ),
            'checkNumType' => array(
                'rule' => array( 'checkNumType' ),
                'message' => 'Only integers are allowed!'
            ),
            'checkMobCount' => array(
                'rule' => array( 'checkMobCount' ),
                'message' => 'Kindly fill 10 digit mobile number!'
            )           
        ),
        'client_email' => array(
            'notempty',
            'email' => array(
                'rule' => '/^[A-Za-z0-9._%+-]+@([A-Za-z0-9-]+\.)+([A-Za-z0-9]{2,4}|museum)$/',
                'message' => 'Please supply a valid email address.'
            )/*,
            'checkEmail' => array(
                'rule' => 'checkEmail',
                'message' => 'Your input email address already, we have!.'
            )*/
        )
    );
    
    /*public function checkEmail()
    {
        
        $id = $this->data['ClientDesc']['client_id'];
        $email = $this->data['ClientDesc']['client_email'];
        if( $id > 0 )
        {
            
            $getStatus = $this->find( 'first',array(
                    'conditions' => array('ClientDesc.id !=' => $id,'ClientDesc.client_email' => $email )
                )
            );
            
        }
        else
        {
            
            $getStatus = $this->find( 'first',array(
                    'conditions' => array('ClientDesc.client_email' => $email )
                )
            );
            
        }
        
        if( count( $getStatus ) > 0 )
        {
            return false;
        }
        else
        {
            return true;   
        }
        
    }*/
    public function checkMobCount()
    {
        
        /* Mobiule number digit counts is equal to 10 than true else false */
        $mobValue = strlen( $this->data['ClientDesc']['client_mobile'] );
        if( $mobValue > 10 || $mobValue < 10 )
        {
            return false;
        }
        else
        {
            return true;
        }
        
    }
    public function checkNumType()
    {
        
        /* Start here type and length */
        $value = $this->data['ClientDesc']['client_mobile'];
        $getResult = preg_match ("/[^0-9]/", $value);  // 0 is success and 1 is error
        if( $getResult == 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function checkChoose( $str )
    {
        
        if( isset( $str['location_id'] ) )
        {
            if( $str['location_id'] === "")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            if( $str['state_id'] === "")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        
    }
    
}

?>
