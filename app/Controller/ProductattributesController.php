<?php

class ProductattributesController  extends AppController
{
    
    var $name = "Productattributes";
    
    var $components = array('Session','Upload','Common');
    
    var $helpers = array('Html','Form','Session','Common');
    
    public function addAttribute( $id = null )
    {
				if(isset( $this->request->data['Attribute']['id'] ))
						$id = $this->request->data['Attribute']['id'];
						
				if( isset( $id ) & $id > 0 )
					$this->set( 'title','Edit Attribute' );
				else
					$this->set( 'title','Add Attribute' );
		
				$this->layout ='index';
				$this->loadModel('Attribute');
				$allAttributes	=	$this->Attribute->find('all');
		
				$this->set('allAttributes', $allAttributes);
				$setNewFlag = 0;
				
				$this->Attribute->set( $this->request->data );
				if( $this->Attribute->validates( $this->request->data ) )
				{
					   $flag = true;                                      
				}
				else
				{
				   $flag = false;
				   $setNewFlag = 1;
				   $error = $this->Attribute->validationErrors;
				}
			if($setNewFlag == 0)
			{
				if($this->request->data)
				{
					$this->Attribute->saveAll( $this->request->data );
					$this->request->data = '';
					if( isset( $id ) & $id > 0 )
						$this->set( 'title','Add Attribute' );
					else
						$this->set( 'title','Add Attribute' );
				}
				if($id)
				{
					$this->Session->setflash( 'Attribute update successfully', 'flash_success' ); 
					
				}
				else
				{
					$this->Session->setflash( 'Attribute added successfully', 'flash_success' );  
				}
				
			}
	}
    
    
    public function lockunlockattr($id = null, $status = null)
    {
		$this->loadModel( 'Attribute' );
		echo $id;
		echo $status;
		if($status == 'Deactive')
		{
			$action = 0;
			$msg = "Attribute active successfully";
		}
		else
		{
			$action = 1;
			$msg = "Attribute deactive successfully";
		}
		$this->Attribute->updateAll( array( "Attribute.attribute_status" => $action ), array( "Attribute.id" => $id ) );
		$this->Session->setflash( $msg, 'flash_success' );  
		$this->redirect( array( "controller" => "Productattributes", "action" => "addAttribute" ) );
	}
	
	public function editarrribute( $id = null )
	{
		$this->layout = 'index';
		$this->loadModel( 'Attribute' );
		$getAttributedetail	=	$this->Attribute->find('first', array('conditions' =>array('Attribute.id' => $id )));
		
		$allAttributes	=	$this->Attribute->find('all');
		$this->set('allAttributes', $allAttributes);
		
		$this->request->data = $getAttributedetail;
	}
	
	public function deleteattribute()
	{
		$this->layout = '';
		$this->autoRender = false;
		$this->loadModel('Attribute');
		$this->loadModel('AttributeOption');
		
		$id = $this->request->data['id'];
		$caheckOption =	$this->AttributeOption->find('all', array('conditions' => array('AttributeOption.attribute_id' => $id)));
		if(count($caheckOption) > 0)
		{
			echo '1';
			$this->Session->setflash( 'Please delete Option first.' ,  'flash_success');  
			exit;
		}
		if($this->Attribute->delete($id))
		{
			echo '2';
			$this->Session->setflash( 'Attribute delete successfully.' ,  'flash_success');  
			exit;
		}
		else
		{
			echo '3';
			$this->Session->setflash( 'There is an error in deletion.' ,  'flash_danger');  
			exit;
		}
	}
    
    /************************* Attribute set *******************/

    public function addattributeoption()
    {
		$this->loadModel( 'AttributeOption' );
		
		if($this->request->data)
		{
			
			foreach($this->request->data['AttributeOption']['attribute_option_name'] as $options)
			{
				$this->request->data['AttributeOption']['attribute_id'] = $this->request->data['AttributeOption']['attribute_id'];
				$this->request->data['AttributeOption']['attribute_option_name'] = $options;
				$this->AttributeOption->saveAll( $this->request->data );
			}
			
		}
		
		$this->redirect( $this->referer() );
	}
	
	public function addAttributeSet()
	{
		$this->loadModel( 'Attribute' );
		$this->loadModel( 'AttributeOption' );
		$this->loadModel( 'AttributeSet' );
		
		$allattributes	=	$this->Attribute->find('list',array('fields' => array('Attribute.id', 'Attribute.attribute_label')));
		$attributeset	=	$this->AttributeSet->find('all');
		
		$this->set('allattributes', $allattributes);
		$this->set('attributeset', $attributeset);
		$this->layout = 'index';
		
		
		
	}
	
	public function saveattributeset( $id =null )
	{
		$this->loadModel( 'AttributeOption' );
		$this->loadModel( 'AttributeSet' );
		$attrbuteIds		=	$this->request->data['AttributeSet']['attribute_id'];
		$attrbuteId			=	explode('---',$attrbuteIds);
		$attributeID		= implode(',',$attrbuteId);
		$this->request->data['AttributeSet']['attribute_set_values'] = $attributeID;
		
		$Description 	=	$this->AttributeSet->find('all', array('conditions' => array('AttributeSet.id !=' => $this->request->data['AttributeSet']['id'], 'AttributeSet.set_name' => $this->request->data['AttributeSet']['set_name'])));
		
		if($this->request->data['AttributeSet']['set_name'] == '' || $this->request->data['AttributeSet']['attribute_set_values'] == '' )
		{
			$this->Session->setflash( 'Please fill attribute set name and add attribute' ,  'flash_danger');  
			$this->redirect(array('controller'=>'Productattributes','action' => 'addAttributeSet'));
		}
		elseif($Description)
		{
			$this->Session->setflash( 'Attribute set name should be unique' ,  'flash_danger');  
			$this->redirect(array('controller'=>'Productattributes','action' => 'addAttributeSet'));
		}
		else
		{
				if($this->AttributeSet->saveAll($this->request->data))
				{
					$this->Session->setflash( 'Attribute set save successfully' ,  'flash_success');  
				}
				$this->redirect(array('controller'=>'Productattributes','action' => 'addAttributeSet'));
		}
		
	}
	
	public function editattributeset( $id =null )
	{
		$this->loadModel( 'AttributeOption' );
		$this->loadModel( 'AttributeSet' );
		
		$attrbuteIds		=	$this->request->data['AttributeSet']['attribute_id'];
		$attrbuteId			=	explode('---',$attrbuteIds);
		$attributeID		= 	implode(',',$attrbuteId);
			
		
		$this->request->data['AttributeSet']['attribute_set_values'] = $attributeID;
		$id	=	$this->request->data['AttributeSet']['id'];
		
		$Description 	=	$this->AttributeSet->find('all', array('conditions' => array('AttributeSet.id !=' => $this->request->data['AttributeSet']['id'], 'AttributeSet.set_name' => $this->request->data['AttributeSet']['set_name'])));
		
		if($this->request->data['AttributeSet']['set_name'] == '' || $this->request->data['AttributeSet']['attribute_set_values'] == '' )
		{
			$this->Session->setflash( 'Please fill attribute set name and add attribute' ,  'flash_danger');  
			$this->redirect(array('controller'=>'Productattributes','action' => 'editArrributeSet/'.$id));
		}
		elseif($Description)
		{
			$this->Session->setflash( 'Attribute set name should be unique' ,  'flash_danger');  
			$this->redirect(array('controller'=>'Productattributes','action' => 'editArrributeSet/'.$id));
		}
		else
		{
				if($this->AttributeSet->saveAll($this->request->data))
				{
					$this->Session->setflash( 'Attribute set Update successfully' ,  'flash_success');  
					$this->redirect(array('controller'=>'Productattributes','action' => 'addAttributeSet'));
				}
		}
	}
	
	public function deleteattributeset()
	{
		$this->layout = '';
		$this->autoRender = false;
		$this->loadModel('AttributeSet');
		
		$id = $this->request->data['id'];
		if($this->AttributeSet->delete($id))
		{
			$this->Session->setflash( 'Attribute set delete successfully.' ,  'flash_success');  
			exit;
		}
		else
		{
			$this->Session->setflash( 'There is an error in deletion.' ,  'flash_danger');  
			exit;
		}
	}
	
	
	
	public function editarrributeset( $id = null )
	{
		$this->layout = 'index';
		
		$this->loadModel( 'Attribute' );
		$this->loadModel( 'AttributeSet' );
		
		$allattributes	=	$this->Attribute->find('list',array('fields' => array('Attribute.id', 'Attribute.attribute_label')));
		$attributeset	=	$this->AttributeSet->find('first', array('conditions' => array('AttributeSet.id' => $id)));
		$ids = $attributeset['AttributeSet']['attribute_set_values'];
		$ids	=	explode(',',$ids);
		
		$attributevalue	=	$this->Attribute->find('list', array('conditions' => array('Attribute.id' => $ids), 'fields' => array('Attribute.id', 'Attribute.attribute_label')));
		
		$this->set('allattributes', $allattributes);
		$this->set('attributeset', $attributeset);
		$this->set('attributevalue', $attributevalue);
		
	}
    
    public function addoptions( $id =null )
    {
		$this->layout = 'index';
		$this->loadModel( 'Attribute' );
		$this->loadModel( 'AttributeOption' );
		
		 $getAttribute	=	$this->Attribute->find('first', array('conditions' => array('Attribute.id' => $id)));
         $allAttributelist	=	$this->Attribute->find('list',array('fields' => 'attribute_label'));
         
    	 
		 $this->Attribute->bindModel(array('hasMany' => array('AttributeOption')));
		 $allAttributesOptions	=	$this->Attribute->find('all');
				
		 $this->set('allAttributesOptions', $allAttributesOptions);
         $this->set('getAttribute', $getAttribute);
         $this->set('allAttributelist', $allAttributelist);
   }
   public function deleteoption()
   {
		$this->layout = '';
		$this->autoRender = false;
		
		$this->loadModel('AttributeOption');
		
		$id = $this->request->data['id'];
		if($this->AttributeOption->delete($id))
		{
			echo '1';
			exit;
		}
		else
		{
			echo '2';
			exit;
		}
   }
   
   public function editOption()
   {
	   $this->layout = '';
	   $this->autoRender = false;
	   $this->loadModel('AttributeOption');
	   $id 			= 	$this->request->data['id'];
	   $optionName	=	$this->request->data['optionName'];
	   
	   $updateOptin 	=	$this->AttributeOption->updateAll( array( 'AttributeOption.attribute_option_name' => "'".$optionName."'" ), array( 'AttributeOption.id' => $id ) );
   }
    
    
    
    /*****************************************************************************/
    
    
   /* public function addproduct($id = null) 
    {
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Product' );
        else
            $this->set( 'title','Add Product' );
	
		$this->layout = "index";
		$this->loadModel( 'Category' );
		
		$getCategories	=	$this->Category->find('all', array('conditions' => array('Category.parent_id' => 0)));
		
		if(!empty($this->request->data))
		{
			
						$this->Product->set( $this->request->data );
						if( $this->Product->validates( $this->request->data ) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Product->validationErrors;
						    $this->set('errorproduct', $error);
						}
						
						$this->Product->ProductDesc->set( $this->request->data );
						if( $this->Product->ProductDesc->validates( $this->request->data) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Product->ProductDesc->validationErrors;
						    $this->set('errordesc', $error);
						}
						
						$this->Product->ProductPrice->set( $this->request->data );
						if( $this->Product->ProductPrice->validates( $this->request->data) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->Product->ProductPrice->validationErrors;
						   $this->set('errorPrice', $error);
						}
						
			$this->Product->saveAll( $this->request->data );
		}
		
		$this->set('getCategories', $getCategories);
		$this->set( 'CountryList', $this->Common->getCountryList() );
		
		
	}*/
	
	/*public function getChild($p_id = null)
	{
		echo $p_id;
	}*/
	
	
	/*public function showallproduct()
    {
		$this->layout = "index";
		$productAllDescs = $this->Product->find('all');
		$this->set('productAllDescs',$productAllDescs);
		$this->set( 'title','Show All Product' );
        
	}*/
	
	/*public function getNthChild()
	{
		$this->layout = "";
		$this->autoRender = false;
		$this->loadModel( 'Category' );
		$id = $this->request->data['id'];
		$getChildList	=	$this->Category->find('all', array('conditions' => array('Category.parent_id' => $id)));
		$space = "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<ul class=child>";
		foreach($getChildList as $getChild)
		{
			$haveChild = (count($getChild['Children']) > 0 ) ? "glyphicon-plus" : "";
			echo '<li class="list-group-item node-treeview-checkable" id="'. $getChild['Category']['id'].'" data-nodeid="0" style="color:undefined;background-color:undefined;"><span class="icon expand-icon glyphicon '.$haveChild. '"></span><input type="checkbox" class="l-tcb" id="ext-gen15">'.$space.$getChild['Category']['category_name'].'</li>';
		}
		echo "<ul>";
		//pr($getChildList);
		exit;
		
	}*/
	
	/*public function getntchild( $node = null)
	{
		$this->layout = '';
		$this->autoRender = false;
		return "[{id:1,label:'123', load_on_demand: true}]";
		exit;
		
	}*/
	
	/*public function actionlocunlock( $id = null, $strAction = null )
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
            
       
            $this->Product->updateAll( array( "Product.product_status" => $action ), array( "Product.id" => $id ) );

       
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showAllProduct" ) );
    }*/
    
    /*public function deleteAction($id = null, $isDeleted =null)
	{
		$action 	=	"1";
		if($isDeleted == 0){
			$isDeleted = 1;
			$msg = "Deletion successful"; }
		else{
			$isDeleted = 0;
			$msg = "Retreival successful"; }
			
			$this->Product->updateAll( array( "Product.is_deleted" => $isDeleted, "Product.product_status" => $action), array( "Product.id" => $id ) );
			$this->Session->setflash( $msg ,  'flash_success');                      
            $this->redirect( array( "controller" => "showAllProduct" ) );
	}*/
	
	/*public function editProduct( $id = null )
	{
		  $this->layout = "index";
		  
		  if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Product' );
		  else
            $this->set( 'title','Add Brand' );
            
		 $getproductArray = $this->Product->find( 'first' ,array('conditions' => array('Product.id'=> $id))); 
		 $this->request->data = $getproductArray;
		
	}*/
	
   
    
}

?>
