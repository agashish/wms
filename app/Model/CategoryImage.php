<?php

class CategoryImage extends AppModel
{
    
    var $name = "CategoryImage";
    
	var $belongsTo = array(
                           
        'Category'  => array(
                           
            'className' => 'Category',
            'foreignKey' => 'category_id'
                           
        )                       
                           
    ); 
    
}

?>
