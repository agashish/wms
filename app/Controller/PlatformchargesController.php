<?php
class PlatformchargesController extends AppController
{
    
    var $name = "Platformcharges";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    
    
    /************************************* code start for amazon category fee ***********************************/
    
    /*
     * funcation use for show amazon category fee 
     * 
     * */
    
    public function ShowAllCategoryFee()
    {
		$this->layout = 'index';
		$this->loadModel('AmazonFee');
		$AllCatFeeDeatils	=	$this->AmazonFee->find('all');
		$this->set('AllCatFeeDeatils', $AllCatFeeDeatils);
	}
	
	/*
     * funcation use for add amazon category fee 
     * 
     * */
	
	public function AddCategoryFee( $id = null )
	{
		
		if(isset($this->request->data['AmazonFee']['id']))
        	$id = $this->request->data['AmazonFee']['id'];
            
            if( isset( $id ) & $id > 0 )
            $this->set( 'title','Edit Category Fee' );
        else
            $this->set( 'title','Add Category Fee' );
		
		$this->layout = 'index';
		$this->loadModel('AmazonFee');
		
		$flag = false;
        $setNewFlag = 0;
        
		if($this->request->is('post'))
		{
				
				$this->AmazonFee->set( $this->request->data );
                if( $this->AmazonFee->validates( $this->request->data ) )
                {
                       $flag = true;                                      
                }
                else
                {
                   $flag = false;                   
                   $setNewFlag = 1;
                   $error = $this->AmazonFee->validationErrors;
                }
               
				if( $setNewFlag == 0 )
					{
						$this->AmazonFee->saveall($this->request->data);
						if(isset( $id ))
						{
							$this->Session->setFlash('Category fee updated successfully.', 'flash_success');
						}
						else
						{
							$this->Session->setFlash('Category fee added successfully.', 'flash_success');
						}
							$this->redirect(array('controller'=>'Platformcharges','action' => 'ShowAllCategoryFee')); 
					}
			}
			
			$this->set( 'CountryList', $this->Common->getCountryList() );
			
			$amazonCategories	=	$this->AmazonFee->find('list',array('fields' => 'AmazonFee.id, AmazonFee.category', 'conditions' => array('AmazonFee.platform' => 'Amazon')));
			$this->set('amazonCategories' , $amazonCategories);
					
	}
	
	/*
     * funcation use for edit amazon category fee 
     * 
     * */
	
	
	public function EditCategoryFee( $id = null )
	{
		$this->layout = 'index';
		
		$this->loadModel('AmazonFee');
		$this->set( 'title','Edit Category Fee' );
		$feedetail	=	$this->AmazonFee->find('first', array('conditions' => array('AmazonFee.id' => $id)));
		$this->request->data = $feedetail;
		$this->set( 'CountryList', $this->Common->getCountryList() );
	}
	
	/*
     * funcation use for delete amazon category fee 
     * 
     * */
	
	
	public function deleteamazoncategoryfee()
	{
		$id	=	$this->request->data['id'];
		$this->loadModel('AmazonFee');
		
		if($this->AmazonFee->delete( $id ))
		{
			$this->Session->setFlash('Category fee delete successfully', 'flash_success');
			echo "1";
			exit;
		}
		else
		{
			$this->Session->setFlash('There is an error', 'flash_danger');
			echo "2";
			exit;
		}
	}
	
    /************************************* code end for amazon category fee ***********************************/
}
?>
