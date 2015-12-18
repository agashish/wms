<?php

class State extends AppModel
{
    
    var $name = "State";
    
    var $validate = array(
        
        'location_id' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'checkChooseCounty' ),
                'required' => true,
                'message' => 'Please choose county name!'                                
            )                                                        
        ),
                          
        'state_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill state name!'                                
            )                                                        
        ),
        
        'status' => array(            
            'rule' => array( 'checkChooseStatus' ),
            'required' => true,
            'message' => 'Please choose status here!'            
        )
    );
    
    public function checkChooseCounty()
    {
        if( $this->data['State']['location_id'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
     public function checkChooseStatus()
    {
        if( $this->data['State']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function getStateList()
    {

        /* Set custom options here */
        $options = array();
        
        /* Start here getting roles list in array */        
        return $this->find( 'all' , $options );
        
    }
    
    public function getStateListForCity( $option = null )
    {       
        
        /* Start here getting roles list in array */        
        return $this->find( 'list', $option);
        
    }
    
    public function getStateDataById( $id = null )
    {
        
        /* Get data from database accordingly to id */
        $getList = $this->findById( $id );
    return $getList;    
    }
    
}

?>