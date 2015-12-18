<?php

class BrandsController extends AppController
{
    
    var $name = "Brands";
    
    var $components = array('Session', 'Common', 'Upload','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    public function addbrand( $id = null )
    {
		if(isset($this->request->data['Brand']['id']))
        	$id = $this->request->data['Brand']['id'];
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Brand' );
        else
            $this->set( 'role','Add Brand' );
        $this->loadModel( 'BrandImage' );
        
        $this->layout = "index";
		/* Set upload path uri */
		
        $uploadUrl	=	WWW_ROOT .'img/brand/';
        $flag = false;
        $setNewFlag = 0;
        
	if( empty( $id ) && $id == '' )
			{ 
				if( !empty( $this->request->data ) )
				{
					
					  
						/* Get validation result here */
						$this->Brand->set( $this->request->data );
						if( $this->Brand->validates( $this->request->data ) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Brand->validationErrors;
						}
						
						$this->Brand->BrandDesc->set( $this->request->data );   
						if( $this->Brand->BrandDesc->validates( $this->request->data ) )
						{
							   $flag = true;
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Brand->BrandDesc->validationErrors;
						}
						
						$this->BrandImage->set( $this->request->data );   
						if( $this->BrandImage->validates( $this->request->data ) )
						{
							   $flag = true;
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->BrandImage->validationErrors;
						}
						
				if( $setNewFlag == 0 )
							 {
									//$this->Brand->unbindModel(array('hasMany' => array('BrandImage')));
									
									$this->Brand->saveAll($this->request->data);
									$lastinsertID 		= 	$this->Brand->getLastInsertId();
									
									$this->loadModel( 'BrandImage' );
									$i=1;
									foreach($this->request->data['BrandImage']['brand_image'] as $file)
									{
										if($file['name'] != '' && count($file['name']) > 0 )
											{
												if($this->request->data['brand']['select_image'][$i] == '1')
													$this->request->data['BrandImage']['select_image'] 	= 	1;
												else
													$this->request->data['BrandImage']['select_image']	=	0;
													
												$getImageName = $this->Upload->upload($file, $uploadUrl, $name = NULL, $rules = array('jpg','jpeg','gif','png'), $allowed = array('jpg','jpeg','gif','png'), $time = NULL);
												
												$this->request->data['BrandImage']['brand_image'] 		= 	$getImageName;
												$this->request->data['BrandImage']['brand_id'] 			= 	$lastinsertID;
												
												$this->BrandImage->saveAll( $this->request->data['BrandImage']);
											}
											$i++;
									}
									$this->redirect( array( 'controller' => 'showAllBrand' ) ); 
							}
					}
            }
			else
			{
				if( !empty( $this->request->data ))
						{
				$this->loadModel( 'BrandImage' );
				
				$oldImg	=	array();
				if(isset($this->request->data['BrandOldImag']['image_name']))
					$oldImg = $this->request->data['BrandOldImag']['image_name'];
				
				$imgID	=	array();
				if(isset($this->request->data['BImage']['id']))
					$imgID	=	$this->request->data['BImage']['id'];
					$imagecounter	=	count(array_filter($imgID));
			
				$img 	=	array();
				$img=	$this->request->data['BrandImage']['brand_image'];
									
				$count	=	 count($this->request->data['BrandImage']['brand_image']);
				$tmpArray = $this->request->data['BrandImage']['brand_image'];
				
				$this->Brand->set( $this->request->data );
						if( $this->Brand->validates( $this->request->data ) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Brand->validationErrors;
						}
						
						$this->Brand->BrandDesc->set( $this->request->data );   
						if( $this->Brand->BrandDesc->validates( $this->request->data ) )
						{
							   $flag = true;
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Brand->BrandDesc->validationErrors;
						}
						
				if( $setNewFlag == 0 )
					{
					
				for($i=0; $i < $count; $i++)
						{
							$this->Brand->saveAll($this->request->data); 
							
							$oldBrandImage = ( isset($this->request->data['BrandOldImage']['image_name'][$i]) ? $this->request->data['BrandOldImage']['image_name'][$i] : "" );
							
							$updateBrandImage = ( isset($this->request->data['BrandImage']['brand_image'][$i]['name']) ? $this->request->data['BrandImage']['brand_image'][$i]['name'] : "" );
							
							/* Update and upload corresponding image renders */
							if( $oldBrandImage != '' && $updateBrandImage != '' )
							{
								
								/* image will be unset */
										if($oldBrandImage)
										$image_name = WWW_ROOT .'img/brand/'.$oldBrandImage;
										chmod($image_name, 0777);
										unlink ( $image_name );
								
								if($this->request->data['brand']['select_image'][$i+1] == '')
										{		
												$data['BrandImage']['select_image'] 	= 	0;
										}
										else
										{
												$data['BrandImage']['select_image']	=	1;
										}
								
								$getImageName = $this->Upload->upload($tmpArray[$i], $uploadUrl, $name = NULL, $rules = array('jpg','jpeg','gif','png'), $allowed = array('jpg','jpeg','gif','png'), $time = NULL);
									
								$data['BrandImage']['brand_image'] 		= 	$getImageName;
								$data['BrandImage']['brand_id'] 		= 	$id;
								$data['BrandImage']['id'] 				= 	$imgID[$i];
								$this->BrandImage->saveAll( $data );
						
							}
							else if( $updateBrandImage != '' && $oldBrandImage == '' )
							{
								
								$getImageName = $this->Upload->upload($this->request->data['BrandImage']['brand_image'][$i], $uploadUrl, $name = NULL, $rules = array('jpg','jpeg','gif','png'), $allowed = array('jpg','jpeg','gif','png'), $time = NULL);
								
								if($this->request->data['brand']['select_image'][$i+1] == '')
										{		
												$dataImage['BrandImage']['select_image'] 	= 	0;
										}
										else
										{
												$dataImage['BrandImage']['select_image']	=	1;
										}
								$dataImage['BrandImage']['brand_image'] 	= 	$getImageName;
								$dataImage['BrandImage']['brand_id'] 		= 	$id;
								$this->BrandImage->saveAll( $dataImage );
							}
							
							
							if($imagecounter > $i)
								{
							if(isset($this->request->data['brand']['select_image'][$i+1] ) && $this->request->data['brand']['select_image'][$i+1] == '')
							{		
									$datanew['BrandImage']['select_image'] 	= 	0;
									$datanew['BrandImage']['id'] 				= 	$imgID[$i];
									$this->BrandImage->saveAll( $datanew );
							}
							else
							{
									
									$datanew['BrandImage']['select_image']	=	1;
									$datanew['BrandImage']['id'] 				= 	$imgID[$i];
									$this->BrandImage->saveAll( $datanew );
							}
								}
							
						}
									
									$this->redirect( array( 'controller' => 'showAllBrand' ) ); 
					}
					
			}
			
		}
    }
    
    public function showallbrand()
    {
	  
        /* Set image path for popup appearance */
        $imagePath = Router::url('/'). 'app/webroot/img/brand/';
		
		$this->set( "role","Show All Brand" );
        $this->layout = "index";
		
		/* Start here getting the list of brand */
        
		$getBrandArray = $this->Brand->find( 'all'); 
                
        /* Start here getting brands list in array */        
        $this->set( 'getAllBrands' , $getBrandArray);
    }
    
   
    public function actionlocunlock( $id = null, $strAction = null )
    {
       
        $this->autorender = false;
        if( $strAction === "active" )
			{            
                $action = 1;
                $msg = "Active Successful";
			}
        else
			{
                $action = 0;
                $msg = "Deactive Successful";
			}   
            
            /* update the brand status */
            $this->Brand->updateAll( array( "Brand.status" => $action ), array( "Brand.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showAllBrand" ) );
    }
    
    public function deleteAction($id = null, $isDeleted =null)
	{
		$action 	=	"1";
		if($isDeleted == 0){
			$isDeleted = 1;
			$msg = "Deletion successful"; }
		else{
			$isDeleted = 0;
			$msg = "Retreival successful"; }
			
			$this->Brand->updateAll( array( "Brand.is_deleted" => $isDeleted, "Brand.status" => $action), array( "Brand.id" => $id ) );
			$this->Session->setflash( $msg ,  'flash_success');                      
            $this->redirect( array( "controller" => "showAllBrand" ) );
	}
	
	public function editBrand( $id = null )
	{
		  $this->layout = "index";
		  
		  if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Brand' );
		  else
            $this->set( 'role','Add Brand' );
            
		 $this->Brand->bindModel(array('hasMany' => array('BrandImage')));
		 $getBrandArray = $this->Brand->find( 'first' ,array('conditions' => array('Brand.id'=> $id))); 
		 //pr($getBrandArray);
		 //exit;
		 $this->request->data = $getBrandArray;
		
	}


	public function addAttribute( $id = null)
	{
		$this->layout = "index";
		$this->loadModel( 'Attribute' );
		
        $this->set( 'role','Add Attribure' );
        
        if(isset($this->request->data['Attribute']['id']))
        	$id = $this->request->data['Attribute']['id'];
		
        	
		$flag = false;
        $setNewFlag = 0;
		
		$this->loadModel( 'Attribute' );
		
		/* use for add and update product attribute */
		
				if( !empty( $this->request->data ) )
				{
					
						$this->Attribute->set( $this->request->data['Attribute'] );
						if( $this->Attribute->validates( $this->request->data['Attribute'] ) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Attribute->validationErrors;
						}
						if( $setNewFlag == 0 )
							 {
								$this->Attribute->saveAll( $this->request->data );
								$lastinsertID 		= 	$this->Attribute->getLastInsertId();
								
								if( $id == '')
								{
									$data 	=	$this->Attribute->find( 'first', array('conditions' =>array('Attribute.id' => $lastinsertID)) );
									$this->set('attributeId' , $lastinsertID);
									$this->set('currentdata' , $data);
									$this->Session->setflash( 'Attribute added successfully.' ,  'flash_success');
									//$this->redirect( array( 'controller' => '/attribute' ) );
								}
								else
								{
									$this->Session->setflash( 'Attribute Update successfully.' ,  'flash_success'); 
									$this->redirect( array( 'controller' => '/attribute' ) );
								}
							 }
					}
				
	    $allAttributes	=	$this->Attribute->find('all');
	    $this->set('allAttributes', $allAttributes);
	}
	
	public function attrDeleteRetrive($id = null)
	{
		
		$this->loadModel( 'Attribute' );
		$this->loadModel( 'AttributeOption' );
	
		$msg = "Attribute deleted successfully with options."; 
		
			/* delete selected attribute and related option */
		$this->Attribute->delete( $id );
			
		$this->Session->setflash( $msg ,  'flash_success');                      
		$this->redirect( array( "controller" => "attribute" ) );
	
	}
	
	public function actionlocunlockAttr(  $id = null, $strAction = null )
	{
		$this->autorender = false;
		$this->loadModel( 'Attribute' );
		
        if( $strAction === "Active" )
			{            
                $action = 1;
                $msg = "Active Successful";
			}
        else
			{
                $action = 0;
                $msg = "Deactive Successful";
			}   
            
            /* update the brand status */
            $this->Attribute->updateAll( array( "Attribute.status" => $action ), array( "Attribute.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "attribute" ) );
		
	}
	
	public function editArrribute( $id = null)
	{
		$this->layout = "index";
		$this->loadModel( 'Attribute' );
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Attribute' );
		  else
            $this->set( 'role','Add Attribute' );
		
		$allAttribute	=	$this->Attribute->find('first', array('conditions' => array('Attribute.id' => $id)));
		$allAttributes	=	$this->Attribute->find('all');
        $this->set('allAttributes', $allAttributes);
		$this->request->data = $allAttribute;
	}
	
	public function addOption( $id = null)
	{
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Add Attribute Option' );
		  else
            $this->set( 'role','Edit Attribute Option' );
         
		 $this->layout = "index";
		 
		 $this->loadModel( 'Attribute' );
		 $this->loadModel( 'AttributeOption' );
		 
         $getAttribute	=	$this->Attribute->find('first', array('conditions' => array('Attribute.id' => $id)));
         $allAttributelist	=	$this->Attribute->find('list',array('fields' => 'attribute_name'));
         
         /* all the conditionS are use for set the css class and html attribute and show on attribute option */
         if($getAttribute['Attribute']['attribute_type'] == 'Select')
         {
			 $options	=	array( 'type'=>'select', 'empty'=>'Select Option','options'=>'','class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false);
		 }
         if($getAttribute['Attribute']['attribute_type'] == 'Text')
         {
			 $options	=	array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false );
		 }
         if($getAttribute['Attribute']['attribute_type'] == 'Text Area')
         {
			 $options	=	array( 'type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false, 'style'=>'height:100px;' );
		 }
         if($getAttribute['Attribute']['attribute_type'] == 'File')
         {
			 $options	=	array( 'type'=>'file','before' => '<div class="input-group"><span class="input-group-btn"><span class="btn btn-primary btn-file">Browse…','after' => '</span></span><input type="text" placeholder="No file selected"  class="form-control"></div> ','label'=>false,'class'=>'', 'required'=>false );
		 }
         if($getAttribute['Attribute']['attribute_type'] == 'Radio')
         {
			 $options	=	array('type' => 'radio', 'options' => array(1 => '',),'class' => 'testClass', 'before' => '<div class="testOuterClass">','after' => '</div>', 'hiddenField' => false );
		 }
         if($getAttribute['Attribute']['attribute_type'] == 'Checkbox')
         {
			 $options	=	array('type'=>'checkbox', 'label'=>'Label', 'checked'=>'checked');
		 }
		 
		 $this->Attribute->bindModel(array('hasMany' => array('AttributeOption')));
		 $allAttributesOptions	=	$this->Attribute->find('all');
				
		 $this->set('allAttributesOptions', $allAttributesOptions);
         $this->set('getAttribute', $getAttribute);
         $this->set('allAttributelist', $allAttributelist);
         $this->set('options', $options);
		
	}
	
	public function addAttributeOption()
	{
		$this->autorender = false;
		$this->layout	=	'';
		$this->loadModel( 'AttributeOption' );
		
		
		$cnt = count($this->request->data['AttributeOption']['attribute_option_name']);
		
		
		for( $i = 0; $i < $cnt; $i++ )
			{
				if($this->request->data['AttributeOption']['attribute_option_name'][$i] != '' )
					{
						$level  	=  $this->request->data['AttributeOption']['attribute_option_name'][$i];
						$setArrays[$i]['AttributeOption'] 	= array( "attribute_option_name" => $level, "attribute_id" => $this->request->data['AttributeOption']['attribute_id']);
					}
			}
			foreach($setArrays as $setArray)
				{
					$this->AttributeOption->saveAll($setArray);
					
				}
				$allAttributesOptions	=	$this->AttributeOption->find('all');
				
				$this->set('allAttributesOptions', $allAttributesOptions);
				$this->Session->setflash( 'Attribute options added successfully', 'flash_success' );  
				$this->redirect( $this->referer() );
				
				
	}
	
	public function editAttributeOption()
	{
		
		
		$data['id']						=	$this->request->data['optionsId'];
		$data['attribute_option_name']	=	$this->request->data['optionName'];
		
		$this->loadModel( 'AttributeOption' );
		
		/* update attribute option */
		$this->AttributeOption->saveAll( $data );
		exit;
		
	}
	
	public function deleteAttributeOption()
	{
		
		$id = $this->request->data['optionId'];
		$this->loadModel( 'AttributeOption' );
		
		/* delete attribute option */

		if($this->AttributeOption->delete( $id ))
		{
			echo "1";
			exit;
		}
		else
		{
			echo "2";
			exit;
		}
		
	}
	
	
    
    
}

?>
