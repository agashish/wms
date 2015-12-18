<?php

class BrandImage extends AppModel
{
    
    var $name = "BrandImage";

    /* Set here relation between BrandImage and Brand */
    var $belongsTo = array(
        
        'Brand' => array(
                               
            'className' => 'Brand',
            'foreignKey' => 'brand_id'    
                               
        )   
    );
	
	/*var $validate = array(
        'brand_image' => array(
				'extension' => array(
				'rule' => array('extension', array('jpg,jpeg,gif,png')),
				'message' => 'Only jpg, jpeg, gif, png files',
				),
				'upload-file' => array(
				'rule' => array('uploadFile'),
				'message' => 'Error uploading file'
				)
			)                                                       
		
    );
	/*
	public function uploadFile( $check ) {
		

    $uploadData = array_shift($check);

    if ( $uploadData['size'] == 0 || $uploadData['error'] !== 0) {
        return false;
    }

    $uploadFolder = 'files'. DS .'your_directory';
    $fileName = time() . '.jpg';
    $uploadPath =  $uploadFolder . DS . $fileName;

    if( !file_exists($uploadFolder) ){
        mkdir($uploadFolder);
    }

    if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
        $this->set('pdf_path', $fileName);
        return true;
    }

    return false;
}*/
    
}

?>
