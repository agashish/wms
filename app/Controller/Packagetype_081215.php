<?php
class Packagetype extends AppModel
{
    
    var $name = "Packagetype";
    
    var $validate = array(
     'package_type_name' => array(
		'notEmpty' => array(
		'rule' => array( 'notEmpty' ),
		'required' => true,
		'message' => 'Please fill Package Type !'
			)
		)
     );
    
}
?>
