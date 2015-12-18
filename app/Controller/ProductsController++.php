<?php

class ProductsController extends AppController
{
    
    var $name = "Products";
    
    var $components = array('Session','Upload','Common');
    
    var $helpers = array('Html','Form','Session','Common');
    
    
    public function addattributeset()
    {
		$this->layout = 'index';
		$this->loadModel('AttributeSet');
		$attributesets	=	$this->AttributeSet->find('list', array('fields' => array('id', 'set_name')));
		
		$this->set( 'attributesets', $attributesets );
	}
    
    
    public function addproduct($id = null) 
    {
		$setID	=	(isset($this->request->data['Product']['attributeset_id']) && $this->request->data['Product']['attributeset_id']) ? $this->request->data['Product']['attributeset_id'] : '';
		if(empty($this->request->data['Product']['attributeset_id']))
		{
			$this->redirect(array('controller'=>'addProductattributeset'));
		}
		if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Product' );
        else
            $this->set( 'title','Add Product' );
	
		$this->layout = "index";
		$this->loadModel( 'Category' );
		$this->loadModel( 'ProductImage' );
		$this->loadModel( 'ProductAttribute' );
		$uploadUrl	=	WWW_ROOT .'img/product/';
		
		$getCategories	=	$this->Category->find('all', array('conditions' => array('Category.parent_id' => 0)));
		
		$flag = false;
        $setNewFlag = 0;
		
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
						
						$this->ProductAttribute->set( $this->request->data );
						if( $this->ProductAttribute->validates( $this->request->data) )
						{
							   $flag = true;                                      
						}
						else
						{
						   $flag = false;
						   $setNewFlag = 1;
						   $error = $this->ProductAttribute->validationErrors;
						   //$this->set('errorPrice', $error);
						}
						
						if( $setNewFlag == 0 )
							 {
						
						$this->Product->saveAll( $this->request->data );
						$lastinsertID 		= 	$this->Product->getLastInsertId();
						$i = 1;
						foreach($this->request->data['ProductImage']['product_image'] as $file)
									{
										$this->request->data['ProductImage']['selected_image']		=	(!isset($this->request->data['ProductImage']['select_image'][$i]) && empty($this->request->data['ProductImage']['select_image'][$i])) ? '1' : '0';
										
										if($file['name'] != '' && count($file['name']) > 0 )
											{
												$getImageName = $this->Upload->upload($file, $uploadUrl);
												
												$this->request->data['ProductImage']['image_name'] 		= 	$getImageName;
												$this->request->data['ProductImage']['product_id'] 			= 	$lastinsertID;
												$this->ProductImage->saveAll( $this->request->data['ProductImage']);
											}
											
											$i++;
									}
										
										$this->request->data['ProductAttribute']['attribute_value'] = serialize($this->request->data['ProductAttribute']['attribute_value']);
										$this->request->data['ProductAttribute']['product_id'] = $lastinsertID;
										
										$this->ProductAttribute->saveAll($this->request->data['ProductAttribute']);	
								}
						
			}
			
			$this->loadModel('AttributeSet');
			$this->loadModel('Attribute');
			$this->loadModel('Warehouse');
		
			$attvalue	=	$this->AttributeSet->find('first', array('conditions' => array('AttributeSet.id' => $setID)));
			
			$ids = $attvalue['AttributeSet']['attribute_set_values'];
			$ids	=	explode(',',$ids);
			$attributevalue	=	$this->Attribute->find('all', array('conditions' => array('Attribute.id' => $ids)));
			$this->set('attributeid', $attvalue['AttributeSet']['id']);
			$this->set('attributevalue', $attributevalue);
			$this->Warehouse->bindModel(array('hasMany' => array('WarehouseBin')));
			$warehouse	=	$this->Warehouse->find('all', array('conditions' => array('Warehouse.status' => 0)));
			
			$this->set('warehouses', $warehouse);
			$this->set('getCategories', $getCategories);
			$this->set( 'CountryList', $this->Common->getCountryList() );
		
		
	}
	
	public function getChild($p_id = null)
	{
		echo $p_id;
	}
	
	
	public function showallproduct()
    {
		$this->layout = "index";
		$productAllDescs = $this->Product->find('all');
		$this->set('productAllDescs',$productAllDescs);
		$this->set( 'title','Show All Product' );
        
	}
	
	public function getNthChild()
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
		
	}
	
	/*public function getntchild( $node = null)
	{
		$this->layout = '';
		$this->autoRender = false;
		return "[{id:1,label:'123', load_on_demand: true}]";
		exit;
		
	}*/
	
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
            
            /* update the product status */
            $this->Product->updateAll( array( "Product.product_status" => $action ), array( "Product.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg, 'flash_success' );                      
            $this->redirect( array( "controller" => "showAllProduct" ) );
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
			
			$this->Product->updateAll( array( "Product.is_deleted" => $isDeleted, "Product.product_status" => $action), array( "Product.id" => $id ) );
			$this->Session->setflash( $msg ,  'flash_success');                      
            $this->redirect( array( "controller" => "showAllProduct" ) );
	}
	
	public function editProduct( $id = null )
	{
		  $this->layout = "index";
		  
		  if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Product' );
		  else
            $this->set( 'title','Add Brand' );
            
		 $getproductArray = $this->Product->find( 'first' ,array('conditions' => array('Product.id'=> $id))); 
		 $this->request->data = $getproductArray;
		
	}
	
	public function checkcategory()
	{
		$this->layout = 'index';
		$this->loadModel( 'Category' );
		$start = '[';
		$end = ']';
		$getCategories	= $this->cat_all_list();
		
		$getCategories	=	$this->Category->find('all', array('conditions' => array('Category.parent_id' => 0)));
		
		$this->set('getCategories', $start.$getCategories.$end);
	}
	
   public function cat_all_list($p_cid=0 , $innerCounter = 0 ,  $st = 0)
	{
		$this->loadModel('Category');
		$this->recursive = -1;
		$categories	=	$this->Category->find('all', array('conditions' => array('Category.parent_id' => $p_cid)));
		$count=count($categories);		
		if($count > 0)
		{
			$st = 0;
			foreach($categories as $categorie)
			{		
					$haveChild = (count($categorie['Children']) > 0 ) ? ",children :[{" : "";
					$endChild = (count($categorie['Children']) > 0 ) ? "" : "}]";			
					
					if( $p_cid > 0 )
					{	
						
						$innerCounter++;
						$haveChild = (count($categorie['Children']) > 0 ) ? ",children :[{" : "";
						$endChild = (count($categorie['Children']) > 0 ) ? "" : "}]";
						echo ",children :[{".'label : '."'".$categorie['Category']['category_name']."'".", id:".$categorie['Category']['id'].$endChild;					
						$st = 1;
						if( $innerCounter > 0  && $haveChild == '')
						{	
							$strCloseTags = '';
							$ik = 0;while( $ik < $innerCounter-1 )
							{
								$strCloseTags .= '}]';
								$ik++;	
							}							
							echo $strCloseTags;				
						}
						else
						{
							echo $strCloseTags = '';
						}
					}
					else
					{	
						if( $st == 0 )
							echo '{label : '."'".$categorie['Category']['category_name']."'".", id:".$categorie['Category']['id'];						
						else
							echo ',{label : '."'".$categorie['Category']['category_name']."'".", id:".$categorie['Category']['id'];							
						$innerCounter = 0;
						$st = 0;
					}
			
					$this->cat_all_list($categorie['Category']['id'] , $innerCounter , $st);			
			}			
		}
	}
	
	public function UploadProducts()
	{
		$this->layout = 'index';
		
		
			$this->loadModel('AttributeSet');
			$this->loadModel('Attribute');
			$this->loadModel('Warehouse');
		
			$this->loadModel('AttributeSet');
			$attributesets	=	$this->AttributeSet->find('list', array('fields' => array('id', 'set_name')));
			$this->set( 'attributesets', $attributesets );
	}
	
	public function DownloadSample()
	{
		$this->autoLayout = 'ajax';
		$this->autoRender = false;
		
		App::import('Vendor', 'PHPExcel/IOFactory');
		App::import('Vendor', 'PHPExcel');
		
		if($this->request->data['Product']['Attribute_set_id'] != '')
		{
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Stock Master');
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(0);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'System SKU');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Product Title');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Brand');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Short Description');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Long Description');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Contents/Information');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Ingredients');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Usage Information');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Notes');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Technical Specifications');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'UPC/Barcode');
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Image filename');
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Image filename2');
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Image filename3');
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Image filename4');
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'Vegan');
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Vegetarian');
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'Gluten Free');
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'Corn Free');
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'Wheat Free');
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'Dairy Free');
		$objPHPExcel->getActiveSheet()->setCellValue('V1', 'Soya Free');
		$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Non-GM');
		$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Weight');
		$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Category');
		$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Price');
		$objPHPExcel->getActiveSheet()->setCellValue('AA1', 'Length');
		$objPHPExcel->getActiveSheet()->setCellValue('AB1', 'Width');
		$objPHPExcel->getActiveSheet()->setCellValue('AC1', 'Height');
		$objPHPExcel->getActiveSheet()->setCellValue('AD1', 'Status');
		
		$this->loadModel('AttributeSet');
		$this->loadModel('Attribute');
		
		$attvalue	=	$this->AttributeSet->find('first', array('conditions' => array('AttributeSet.id' => $this->request->data['Product']['Attribute_set_id'])));
			
		$ids = $attvalue['AttributeSet']['attribute_set_values'];
		$ids	=	explode(',',$ids);
		$attributevalues	=	$this->Attribute->find('all', array('conditions' => array('Attribute.id' => $ids)));
		
		$row = 1;
		$num1 = ord('A');
		$num2 = ord('D');
		$num3 = ord('1');
		$i = 1;
		foreach($attributevalues as $attributevalue)
		{
			$num4	=	chr($num2+$i); 
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$num4.'1', $attributevalue['Attribute']['attribute_code']);
			$i++;
		}
		

		$name = 'Stock Master';
		header('Content-Encoding: UTF-8');
		header('Content-type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$name.'.csv"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
		$objWriter->save('php://output');
	
		}
		else
		{
			 $this->Session->setflash( 'Please select attribute set', 'flash_danger' ); 
			 $this->redirect($this->referer());
			
		}
		
	}
	
	/*public function uploads_csv()
	{
		$this->autoLayout = 'ajax';
		$this->autoRender = false;
		
		$this->loadModel('Product');
		$this->loadModel('ProductDesc');
		$this->loadModel('ProductPrice');
		$this->loadModel('ProductImage');
		
		$this->data['Product']['Import_file']['name'];
		if($this->data['Product']['Import_file']['name'] != '')
			{
				
				$filename = WWW_ROOT. 'files'.DS.$this->request->data['Product']['Import_file']['name']; 
				move_uploaded_file($this->request->data['Product']['Import_file']['tmp_name'],$filename);  
				$name		=	 $this->request->data['Product']['Import_file']['name'];
		
				App::import('Vendor', 'PHPExcel/IOFactory');
			
				$objPHPExcel = new PHPExcel();
				$objReader= PHPExcel_IOFactory::createReader('CSV');
				$objReader->setReadDataOnly(true);
				$objPHPExcel=$objReader->load('files/'.$name);
				$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
				$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
				$colString	=	 $highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
				$colNumber = PHPExcel_Cell::columnIndexFromString($colString);
				
				
				$count=0;
				$countalready=0;
				$header	=	array('Product Title','Brand','Short Description','Long Description','Contents/Information','Ingredients','Usage Information', 'Notes', 'Technical Specifications',
				 'UPC/Barcode', 'Image filename', 'Image filename2', 'Image filename3', 'Image filename4', 'Vegan', 'Vegetarian', 'Gluten Free', 'Corn Free', 'Wheat Free', 'Dairy Free', 
				 'Soya Free', 'Non-GM', 'Weight', 'Category', 'Price', 'Length', 'Width', 'Height', 'Status');
			$count	= 0;
			$alreadycount	=	0;
			$countbarcode	=	0;		 
			for($i=2;$i<=$lastRow;$i++) 
			{
				
				$productdata['product_sku']					=	$objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				$productdata['product_name']				=	$objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				$productdscdata['brand']					=	$objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				$productdscdata['short_description']		=	addslashes($objWorksheet->getCellByColumnAndRow(3,$i)->getValue());
				$productdscdata['long_description']			=	addslashes($objWorksheet->getCellByColumnAndRow(4,$i)->getValue());
				$productdscdata['barcode'] 					=	$objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
				$productimgdata['Image_filename'] 			=	$objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
				$productimgdata['Image_filename2'] 			=	$objWorksheet->getCellByColumnAndRow(7,$i)->getValue();
				$productimgdata['Image_filename3'] 			=	$objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
				$productimgdata['Image_filename4'] 			=	$objWorksheet->getCellByColumnAndRow(9,$i)->getValue();
				$productdscdata['weight']					=	$objWorksheet->getCellByColumnAndRow(10,$i)->getValue();
				//$data['category_id']						=	$objWorksheet->getCellByColumnAndRow(11,$i)->getValue();
				$productprice['product_price']				=	$objWorksheet->getCellByColumnAndRow(12,$i)->getValue();
				$productdscdata['length']					=	$objWorksheet->getCellByColumnAndRow(13,$i)->getValue();
				$productdscdata['width'] 					=	$objWorksheet->getCellByColumnAndRow(14,$i)->getValue();
				$productdscdata['height'] 					=	$objWorksheet->getCellByColumnAndRow(15,$i)->getValue();
				$productdata['product_status']				=	$objWorksheet->getCellByColumnAndRow(16,$i)->getValue();
				
				$checkproduct		=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $productdata['product_sku'])));
				$checkproductdesc	=	$this->ProductDesc->find('first', array('conditions' => array('ProductDesc.barcode' => $productdscdata['barcode'])));
				
				if(count($checkproduct) == 0)
				{
					if(count($checkproductdesc) == 0)
					{
						$this->Product->saveAll($productdata);
						$productid	=	$this->Product->getLastInsertId();
						
						$productdscdata['product_id'] = $productid;
						$this->ProductDesc->saveAll($productdscdata, array('validate' => false));
						
						$productprice['product_id'] = $productid;
						$this->ProductPrice->saveAll($productprice, array('validate' => false));
						
						$productimgdata['product_id'] = $productid;
						$this->ProductImage->saveAll($productimgdata, array('validate' => false));
						
						$count++;
					}
					else
					{
						$countbarcode++;
					}
				}
				else
				{
					$alreadycount++;
				}
				$this->Session->setFlash($count.' :- SKU Inserted <br>'.$countbarcode.' :- Barcode Already Exist <br>'. $alreadycount.' :- SKU Already Exist <br>', 'flash_danger');
			}
			$this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash('Please Insert CSV File.', 'flash_danger');
			$this->redirect($this->referer());
		}
	}*/
	
	public function uploads_csv()
	{
		$this->autoLayout = 'ajax';
		$this->autoRender = false;
		
		$this->loadModel('Product');
		$this->loadModel('ProductDesc');
		$this->loadModel('ProductPrice');
		$this->loadModel('ProductImage');
		$this->loadModel('AttributeOption');
		//pr($this->request->data);
		//exit;
		$this->data['Product']['Import_file']['name'];
		if($this->data['Product']['Import_file']['name'] != '')
			{
				
				$filename = WWW_ROOT. 'files'.DS.$this->request->data['Product']['Import_file']['name']; 
				move_uploaded_file($this->request->data['Product']['Import_file']['tmp_name'],$filename);  
				$name		=	 $this->request->data['Product']['Import_file']['name'];
			
				App::import('Vendor', 'PHPExcel/IOFactory');
				
				$objPHPExcel = new PHPExcel();
				$objReader= PHPExcel_IOFactory::createReader('CSV');
				$objReader->setReadDataOnly(true);				
				$objPHPExcel=$objReader->load('files/'.$name);
				$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
				$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
				$colString	=	 $highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
				$colNumber = PHPExcel_Cell::columnIndexFromString($colString);
				
				$count=0;
				$countalready=0;
				$header	=	array('Product Title','Brand','Short Description','Long Description','Contents/Information','Ingredients','Usage Information', 'Notes', 'Technical Specifications',
				 'UPC/Barcode', 'Image filename', 'Image filename2', 'Image filename3', 'Image filename4', 'Vegan', 'Vegetarian', 'Gluten Free', 'Corn Free', 'Wheat Free', 'Dairy Free', 
				 'Soya Free', 'Non-GM', 'Weight', 'Category', 'Price', 'Length', 'Width', 'Height', 'Status');
				 
				$count	= 0;
				$alreadycount	=	0;
				$countbarcode	=	0;
						 
			for($i=2;$i<=$lastRow;$i++) 
			{
				
				$productdata['product_sku']				=	$objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				$productdata['asin_no']					=	$objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				$productdata['product_name']			=	$objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				$productdscdata['brand']				=	$objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
				$productdscdata['short_description']	=	addslashes($objWorksheet->getCellByColumnAndRow(4,$i)->getValue());
				$productdscdata['long_description']		=	addslashes($objWorksheet->getCellByColumnAndRow(5,$i)->getValue());
				$productdscdata['barcode'] 				=	$objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
				$productimgdata['image']['0'] 			=	$objWorksheet->getCellByColumnAndRow(7,$i)->getValue();
				$productimgdata['image']['1'] 			=	$objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
				$productimgdata['image']['2'] 			=	$objWorksheet->getCellByColumnAndRow(9,$i)->getValue();
				$productimgdata['image']['3'] 			=	$objWorksheet->getCellByColumnAndRow(10,$i)->getValue();
				$productimgdata['image']['4']			=	$objWorksheet->getCellByColumnAndRow(11,$i)->getValue();
				$productdscdata['weight']				=	$objWorksheet->getCellByColumnAndRow(12,$i)->getValue();
				$productdscdata['category']				=	$objWorksheet->getCellByColumnAndRow(13,$i)->getValue();
				$productdscdata['price']				=	$objWorksheet->getCellByColumnAndRow(14,$i)->getValue();
				$productdscdata['length'] 				=	$objWorksheet->getCellByColumnAndRow(15,$i)->getValue();
				$productdscdata['width'] 				=	$objWorksheet->getCellByColumnAndRow(16,$i)->getValue();
				$productdscdata['height']				=	$objWorksheet->getCellByColumnAndRow(17,$i)->getValue();
				$productdata['product_status']			=	$objWorksheet->getCellByColumnAndRow(18,$i)->getValue();
				$productdscdataAttr['attribute']['1']	=	$objWorksheet->getCellByColumnAndRow(19,$i)->getValue();
				$productdscdataAttr['attribute']['2']	=	$objWorksheet->getCellByColumnAndRow(20,$i)->getValue();
				$productdscdataAttr['attribute']['3']	=	$objWorksheet->getCellByColumnAndRow(21,$i)->getValue();
				$productdscdataAttr['attribute']['4']	=	$objWorksheet->getCellByColumnAndRow(22,$i)->getValue();
				$productdscdataAttr['attribute']['5']	=	$objWorksheet->getCellByColumnAndRow(23,$i)->getValue();
				$productdscdataAttr['attribute']['6']	=	$objWorksheet->getCellByColumnAndRow(24,$i)->getValue();
				//echo "*******************<br>";
				$productdscdata['model_no']				=	$objWorksheet->getCellByColumnAndRow(25,$i)->getValue();
				$productdscdata['manufacturer_part_num']=	$objWorksheet->getCellByColumnAndRow(26,$i)->getValue();
				$productdscdata['yield']				=	$objWorksheet->getCellByColumnAndRow(27,$i)->getValue();
				$productdscdata['type']					=	$objWorksheet->getCellByColumnAndRow(28,$i)->getValue();
				$productdscdata['pack_qty']				=	$objWorksheet->getCellByColumnAndRow(29,$i)->getValue();
				
				/*
				 * 
				 * Params, Inserting Product type and product defined skus list with colon based
				 * 
				 */ 
				$productdscdata['product_type']				=	$objWorksheet->getCellByColumnAndRow(33,$i)->getValue();
				$productdscdata['product_defined_skus']		=	$objWorksheet->getCellByColumnAndRow(34,$i)->getValue();
								
				//echo "******************************************************************************************************<br>";
								
				$arrayMarge = array();
				foreach($productdscdataAttr['attribute'] as $attr)
				{
					if( $attr != '')
					{
						$attributeOptions	=	$this->AttributeOption->find('first', array('conditions' => array('AttributeOption.attribute_option_name' => $attr)));
						$attributeId	=	$attributeOptions['AttributeOption']['id'];
						array_push($arrayMarge, $attributeId);
					}
				}
				$productdscdata['attribute_id']	=	$attrbuteid	=	implode(',', $arrayMarge);
				
				$checkproduct		=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $productdata['product_sku'])));
				
				//$checkproductdesc	=	$this->ProductDesc->find('first', array('conditions' => array('ProductDesc.barcode' => $productdscdata['barcode'])));
				if(count($checkproduct) == 0)
				{
						$this->Product->saveAll($productdata);
						$productid	=	$this->Product->getLastInsertId();
						
						$productdscdata['product_id'] = $productid;
						$this->ProductDesc->saveAll($productdscdata, array('validate' => false));
						
						$productprice['product_id'] = $productid;
						$this->ProductPrice->saveAll($productprice, array('validate' => false));
						foreach( $productimgdata['image'] as $image)
						{
								$productimgdata['image_name'] = $image;
								$productimgdata['product_id'] = $productid;
								$productimgdata['selected_image'] = '0';
								$this->ProductImage->saveAll($productimgdata, array('validate' => false));
						}
						$count++;
				}
				else
				{
					$alreadycount++;
				}
				$this->Session->setFlash($count.' :- SKU Inserted <br>'.$countbarcode.' :- Barcode Already Exist <br>'. $alreadycount.' :- SKU Already Exist <br>', 'flash_danger');
			}
			$this->redirect($this->referer());
		}
		else
		{
			$this->Session->setFlash('Please Insert CSV File.', 'flash_danger');
			$this->redirect($this->referer());
		}
	}
}

?>
