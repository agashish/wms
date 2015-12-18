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

}
?>
