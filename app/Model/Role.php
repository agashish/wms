<?php

class Role extends AppModel
{
    
    var $name = "Role";
    
    var $validate = array(
                          
        'role_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill role name!'                                
            )                                                        
        )
    );
    
    public function checkChooseRole()
    {
        if( $this->data['Role']['role_type'] === "")
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function getRoleList()
    {
        
        /* Set conditions */
        $options = array(
            'conditions' => array(
                'RoleType.type_attr' => 'Role.role_type'
            ),
            'fields' => array('RoleType.type_name')
        );
        
        /* Start here getting roles list in array */        
        return $this->find( 'all' , $options );
        
    }
    
    public function getRoleData( $id = null )
    {
        
        /* Get data from database accordingly to id */
        $getList = $this->findById( $id );
    return $getList;    
    }
}

?>
