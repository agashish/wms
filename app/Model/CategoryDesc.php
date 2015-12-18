<?php
class CategoryDesc extends AppModel
{
    
    var $name = "CategoryDesc";
	
	
	var $belongsTo = array(
                           
        'Category'  => array(
                           
            'className' => 'Category',
            'foreignKey' => 'category_id'
                           
        )                       
                           
    );
	
	
    /* Set here realation between WarehouseDesc and Warehouse */    
    var $validate = array(
		'category_short_text' => array(
		'notEmpty' => array(
				'rule' => array('notEmpty'),
				'required'=> true,
				'message'=>'Please fill short text !'
			)
		),
		'category_long_text' => array(
			'notEmpty' => array(
				'rule' =>array('notEmpty'),
				'required' => true,
				'message' => 'Please fill long text !'
			)
		)
    
    );
   
}
?>
