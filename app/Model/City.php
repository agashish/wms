<?php

class City extends AppModel
{
    
    var $name = "City";
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
                          
        'city_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill city name!'                                
            )                                                        
        ),
        
        'status' => array(            
            'rule' => array( 'checkChooseStatus' ),
            'required' => true,
            'message' => 'Please choose status here!'            
        )
    );
    
    public function checkChooseStatus()
    {
        
        if( $this->data['City']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
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
    
    public function getCityList()
    {

        /* Set custom options here */
        $options = array();
        
        /* Start here getting roles list in array */        
        return $this->find( 'all' , $options );
        
    }
    
    public function getCityDataById( $id = null )
    {
        
        /* Get data from database accordingly to id */
        $getList = $this->findById( $id );
        
    return $getList;    
    }
    
}

?>