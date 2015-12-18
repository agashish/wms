<?php
class PackageEnvelope extends AppModel
{
    
    var $name = "PackageEnvelope";
    
    var $belongsTo = array(
                           
        'Packagetype'  => array(
                           
            'className' => 'Packagetype',
            'foreignKey' => 'Packagetype_id'
                           
        )                       
                           
    );
     var $validate = array(
     
     'envelope_name' => array(
		'notEmpty' => array(
		'rule' => array( 'notEmpty' ),
		'required' => true,
		'message' => 'Please fill Package Type !'
		)
	),
	'envelop_cost' => array(
		'notEmpty' => array(
		'rule' => array( 'notempty' ),
		'required' => true,
		'message' => 'Please fill cost !'
		)
	),
	'packagetype_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please select Package Type !',
				'allowEmpty' => false
			)
		)
     
     );
    

}
?>
