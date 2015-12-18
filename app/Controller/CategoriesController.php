<?php
class CategoriesController extends AppController
{
    
    var $name = "Categories";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    public function addCategory($id = null)
    {
		//$this->loadModel( 'CategoryImage' );	
		$this->layout = "index";
		
		$flag = false;
        $setNewFlag = 0;
        $uploadUrl	=	WWW_ROOT .'img/category/';
        
		if(isset($this->request->data['Category']['id']))
        	$id = $this->request->data['Category']['id'];
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Category' );
        else
            $this->set( 'role','Add Category' );
            
			if( empty( $id ) && $id == '' )
			{ 
				if( $this->request->is('post') )
						{		
							/* validation for category */
							$this->Category->set( $this->request->data );
							if( $this->Category->validates( $this->request->data ) )
								{
									   $flag = true;                                      
								}
								else
								{
								   $flag = false;                   
								   $setNewFlag = 1;
								   $error = $this->Category->validationErrors;
								}
								
						   /* validation for category description */	
						   $this->Category->CategoryDesc->set( $this->request->data['CategoryDesc'] );
						   if( $this->Category->CategoryDesc->validates($this->request->data) )
								{
									$flag = true;
								}
								else
								{
									$flag = false;
									$setNewFlag = 1;
									$error = $this->Category->CategoryDesc->ValidationErrors;
								}


						if( $setNewFlag == 0 )
							 {
								
								
								  $this->Category->unBindModel(array('hasMany' => array('CategoryImage')));
								  
								  if( isset($this->request->data['Category']['parent_id']) && $this->request->data['Category']['parent_id'] == '' )
									{
										$this->request->data['Category']['parent_id'] = 0;       
									}
								  $this->Category->saveAll($this->request->data);
								  $lastinsertID = $this->Category->getLastInsertId();
								  $i = 1;
								  $this->loadModel( 'CategoryImage' );
								  foreach($this->request->data['CategoryImage']['category_image'] as $file)
								  {
									  //$this->request->data['CategoryImage']['default_image'][$i];
									  if($file['name'] != '' && count($file['name']) > 0 )
									  {
										  if(isset($this->request->data['CategoryImage']['default_image'][$i]) && $this->request->data['CategoryImage']['default_image'][$i] != '')
										  {
											  $this->request->data['CategoryImage']['selected_image'] 	= 	1;
										  }
										  else
										  {
											  $this->request->data['CategoryImage']['selected_image'] 	= 	0;
										  }
										  /* Upload image in image folder and return the image name */
										  $getImageName = $this->Upload->upload($file, $uploadUrl );
										  
										  $this->request->data['CategoryImage']['category_image'] 	= 	$getImageName;
										  $this->request->data['CategoryImage']['category_id'] 		= 	$lastinsertID;
										  
										  /* save image name */
										  $this->CategoryImage->saveAll( $this->request->data['CategoryImage']);
									  }
									  $i++;
									  
									  
						 }
						  $this->redirect( array( 'controller' => 'showAllCategory' ) );   
					 }
					
				}
				
		}
		else
		{
			if( $this->request->is('post') )
						{		
							/* validation for category */
							
							$this->Category->set( $this->request->data );
							if( $this->Category->validates( $this->request->data ) )
								{
									   $flag = true;                                      
								}
								else
								{
								   $flag = false;                   
								   $setNewFlag = 1;
								   $error = $this->Category->validationErrors;
								}
								
						   /* validation for category description */	
						   $this->Category->CategoryDesc->set( $this->request->data['CategoryDesc'] );
						   if( $this->Category->CategoryDesc->validates($this->request->data) )
								{
									$flag = true;
								}
								else
								{
									$flag = false;
									$setNewFlag = 1;
									$error = $this->Category->CategoryDesc->ValidationErrors;
								}


						if( $setNewFlag == 0 )
							 {
								 //pr($this->request->data);
								 
									$this->loadModel( 'CategoryImage' );
									
									$oldImg	=	array();
									if(isset($this->request->data['CategoryOldImage']['image_name']))
										$oldImg = $this->request->data['CategoryOldImage']['image_name'];
									
									$imgID	=	array();
									if(isset($this->request->data['CatImage']['id']))
										$imgID	=	$this->request->data['CatImage']['id'];
										$imagecounter	=	count(array_filter($imgID));
										
								//pr($imgID);
								//exit;
									$img 	=	array();
									$img=	$this->request->data['CategoryImage']['category_image'];
									$count	=	 count($this->request->data['CategoryImage']['category_image']);
									
									$tmpArray = $this->request->data['CategoryImage']['category_image'];				
									
									for($i=0; $i < $count; $i++)
									{
										
										$oldCatImage = (isset($this->request->data['CategoryOldImage']['image_name'][$i]) ? $this->request->data['CategoryOldImage']['image_name'][$i] : "" );
										
										//$name = $this->request->data['CategoryImage']['category_image'][$i]['name'];
										$updateCatImage = ( isset($this->request->data['CategoryImage']['category_image'][$i]['name']) ? $this->request->data['CategoryImage']['category_image'][$i]['name'] : "" );
										
										/* Update and upload corresponding image renders */
										if( $oldCatImage != '' && $updateCatImage != '' )
										{
											/* image will be unset */
											$image_name = WWW_ROOT .'img/category/'.$oldCatImage;
											chmod($image_name, 0777);
											unlink ( $image_name );
											
											$getImageName = $this->Upload->upload($tmpArray[$i], $uploadUrl );
											if($this->request->data['CategoryImage']['selected_image'][$i+1] == '1')
												{		
													$this->request->data['CategoryImage']['selected_image'] 	= 	1;
												}
												else
												{
													$this->request->data['CategoryImage']['selected_image'] 	= 	0;
												}
											
											$data['CategoryImage']['category_image'] 	= 	$getImageName;
											$data['CategoryImage']['category_id'] 		= 	$id;
											$data['CategoryImage']['id'] 				= 	$imgID[$i];
										
											$this->CategoryImage->saveAll( $data );
									
										}
										else if( $updateCatImage != '' && $oldCatImage == '' )
										{
											
											$getImageName = $this->Upload->upload($this->request->data['CategoryImage']['category_image'][$i], $uploadUrl );
											if($this->request->data['CategoryImage']['selected_image'][$i+1] == '1')
												{		
													$this->request->data['CategoryImage']['selected_image'] 	= 	1;
												}
												else
												{
													$this->request->data['CategoryImage']['selected_image'] 	= 	0;
												}
											
											
											$this->request->data['CategoryImage']['category_image'] 	= 	$getImageName;
											$this->request->data['CategoryImage']['category_id'] 		= 	$id;
											$this->CategoryImage->saveAll( $this->request->data['CategoryImage']);
											
										}
										
										if($imagecounter > $i)
										{
											if( $this->request->data['CategoryImage']['selected_image'][$i+1] == '1')
											{		
												$datanew1['CategoryImage']['selected_image'] 	= 	1;
												$datanew1['CategoryImage']['id'] 				= 	$imgID[$i];
												$this->CategoryImage->saveAll( $datanew1 );
											}
											else
											{
												$datanew2['CategoryImage']['selected_image'] 	= 	0;
												$datanew2['CategoryImage']['id'] 				= 	$imgID[$i];
												$this->CategoryImage->saveAll( $datanew2 );
											}
										}
										}
									//exit;
									$this->redirect( array( 'controller' => 'showAllCategory' ) ); 
							} 
							
							
				}
		}
	}
	
	
	
	
	public function showCategory()
	{
		$this->layout = "index";
		$getAllCategories		=	$this->Category->find('all');
		$this->set( 'role','Show Category' );
		$this->set('getAllCategories', $getAllCategories);
		
	}
	
	public function activeDeactive($id=null, $action=null)
	{
	    
			/* Action perform according active and deactive */
            if( $action === "active" ){
                $action = 1;
                $msg	= "Active Successful";}
            else{
                $action = 0;
                $msg	= "Deactive Successful";}
            
            $this->Category->updateAll( array( "Category.status" => $action ), array( "Category.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg , 'flash_success');  
                                
            $this->redirect( array( "controller" => "showAllCategory" ) );
   	
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
			
			$this->Category->updateAll( array( "Category.is_deleted" => $isDeleted, "Category.status" => $action), array( "Category.id" => $id ) );
			$this->Session->setflash( $msg ,  'flash_success');                      
            $this->redirect( array( "controller" => "showAllCategory" ) );
	}
	
	public function editCategory( $id = null)
	{
		 /*  Layout calling*/
		 $this->layout = "index";
		 
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Category' );
        else
            $this->set( 'role','Add Category' );
		
		 $this->set( 'getAllCategory', $this->Common->getCategoryList() );
		 
		 $getCategoryArray = $this->Category->find( 'first' ,array('conditions' => array('Category.id'=> $id))); 
		 $this->request->data = $getCategoryArray;    
		
	}
	
	
		
	
     
}

?>
