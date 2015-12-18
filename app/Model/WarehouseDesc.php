<?php
class WarehouseDesc extends AppModel
{
    
    var $name = "WarehouseDesc";

    /* Set here realation between WarehouseDesc and Warehouse */
    var $belongsTo = array(
        
        'Warehouse' => array(
                               
            'className' => 'Warehouse',
            'foreignKey' => 'Warehouse.id'
                               
        )        
        
    );
    
    var $validate = array(
        
        'location_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'checkChoose', 'location_id' ),
                'required' => true,
                'message' => 'Please choose country name!'                                
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
                'rule' => array( 'checkChoose', 'city_id'  ),
                'required' => true,
                'message' => 'Please choose city name!'                                
            )                                                        
        ),
        
        'warehouse_number' => array(                                
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
        )
        
    );
   
    public function checkMobCount()
    {
        
        /* Mobiule number digit counts is equal to 10 than true else false */
        $mobValue = strlen( $this->data['WarehouseDesc']['warehouse_number'] );
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
        $value = $this->data['WarehouseDesc']['warehouse_number'];
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
        else if( isset( $str['state_id'] ) )
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
        else if( isset( $str['city_id'] ) )
        {
            if( $str['city_id'] === "")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else{}        
    }
}
?>