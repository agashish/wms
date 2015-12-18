<?php

class Location extends AppModel
{
    
    var $name = "Location";
    
    var $hasMany = array(
        
        'PostaServiceDesc' => array(
            'className' => 'PostalServiceDesc',
            'foreignKey' => 'service_level_id'
        )
    );
    
    var $validate = array(
                          
        'county_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill county name!'                                
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
        if( $this->data['Location']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function getRoleList( $option = null )
    {       
        
        /* Start here getting roles list in array */        
        return $this->find( 'all', $option);
        
    }
    
    public function getRoleListForState( $option = null )
    {       
        
        /* Start here getting roles list in array */        
        return $this->find( 'list', $option);
        
    }
    
    public function getLocationData( $id = null )
    {
        
        /* Get data from database accordingly to id */
        $getList = $this->findById( $id );
    return $getList;    
    }
}

?>
