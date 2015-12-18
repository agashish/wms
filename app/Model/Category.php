<?php
class Category extends AppModel
{
    
    var $name = "Category";

     var $hasMany = array(
                         
        'Children'   => array(
                              
            'className'  => 'Category',
            'foreignKey' => 'parent_id'
                              
        ),
        'CategoryImage'   => array(
                              
            'className'  => 'CategoryImage',
            'foreignKey' => 'category_id'
                              
        )
                    
    );
    
    var $hasOne = array(
                        
        'CategoryDesc' => array(
                                
            'className' => 'CategoryDesc',
            'foreignKey' => 'category_id',
            'dependent' => true
                                
        )                    
                        
    );
    
    var $belongsTo = array(
                           
        'Parent'  => array(
                           
            'className' => 'Category',
            'foreignKey' => 'parent_id'
                           
        )                       
                           
    );
    
    
    var $validate = array(        
        'category_name' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill category name !'                                
            )
		),
		'category_alias' => array(                                
            'notEmpty' => array(                                
                'rule' => array( 'notEmpty' ),
                'required' => true,
                'message' => 'Please fill Alias !'                                
            )
		),
		'status' => array(            
				'rule' => array( 'notEmpty' ),
				'required' => true,
				'message' => 'Please choose status here !'            
				)
		);
		
		 public function getcategoryListForedit( $option = null )
		{       
        
			/* Start here getting roles list in array */        
			return $this->find( 'list', $option);
        }
    
    
    
}
?>
