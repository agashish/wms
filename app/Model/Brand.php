<?php

class Brand extends AppModel
{
    
    var $name = "Brand";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    
    var $hasOne = array(
        
        'BrandDesc' => array(
                               
            'className' => 'BrandDesc',
            'foreignKey' => 'brand_id'
                               
        )
        
    );
    
    //var $hasMany = array('BrandImage' );
    
   
    
    var $validate = array( 	
       
        'brand_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill brand name!'                                
            )                                                     
        ),		
        'status' => array(            
            'rule' => array( 'checkChooseStatus' ),
            'required' => true,
            'message' => 'Please choose status here!'            
        )
    );
	
	public function brandUnique() 
{
    $existing = $this->find('first', array(
        'conditions' => array(
            'brand_name' => $this->data[$this->name]['brand_name']
         )
    ));

    return (count($existing) == 0);
}

    public function checkChooseStatus()
    {
        
        if( $this->data['Brand']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
        
    public function getBrandDataById( $id = null )
    {
        return $this->findById( $id );        
    }
    
}

?>
