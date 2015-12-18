<?php

class AmazonFee extends AppModel
{
   
    var $name = "AmazonFee";
    
     var $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'country'
        )
    );
     var $validate = array(
                          
        'category' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill Category !'                                
            )                                                        
        ),
        'referral_fee' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => 'numeric',
            'message' => 'Please fill referral fee (only numbers) !'            
        ),
        'app_min_referral_fee' => array(            
            'rule' => array( 'notEmpty' ),
            'required' => true,
            'rule' => 'numeric',
            'message' => 'Please fill applicable minimum referral fee (only numbers) !'            
        ),
        'country' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please select country !'                                
            )                                                        
        ),
        'platform' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please select platform !'                                
            )                                                        
        )
    );
    
}

?>
