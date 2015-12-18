<?php
class Warehouse extends AppModel
{
    
    var $name = "Warehouse";
    
    /* Set here realation between Warehouse and WarehouseDesc */
    var $hasOne = array(
        
        'WarehouseDesc' => array(
                               
            'className' => 'WarehouseDesc',
            'foreignKey' => 'warehouse_id'
                               
        )        
        
    );
    
    var $validate = array(        
        'warehouse_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill warehouse name!'                                
            ),
	    'unique' => array(
		    'rule' => array( 'checkUniqueness' ),
		    'required' => true,
		    'message' => 'Please choose unique name with city !'                                                        
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
        if( $this->data['Warehouse']['status'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function getWarehouseDataById( $id = null )
    {
        
        return $this->findById( $id );
        
    }
    
    public function updateWarehouse( $str, $id )
    {
        $action = 0;
        if( $str == "Active" )
            $action = 0;
        else
            $action = 1;        
        
        if( $this->updateAll( array( "Warehouse.status" => "'$action'" ), array( "Warehouse.id" => $id ) ) )
            return "update";
        else	
            return "error";
    }

   public function checkUniqueness()
    {
		if($this->data['Warehouse']['id'] == '')
		{
			$Description 	=	$this->find('all', array('conditions' => array('WarehouseDesc.city_id' => $this->data['WarehouseDesc']['city_id'], 'Warehouse.warehouse_name' => $this->data['Warehouse']['warehouse_name'])));
		}
		else
		{
			$Description 	=	$this->find('all', array('conditions' => array('Warehouse.id !=' => $this->data['Warehouse']['id'], 'Warehouse.warehouse_name' => $this->data['Warehouse']['warehouse_name'])));
		}
		
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
