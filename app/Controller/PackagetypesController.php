<?php
class PackagetypesController extends AppController
{
    
    var $name = "Packagetypes";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    public function addPackage( $id = null )
    {
		$this->layout = "index";
		$this->loadModel('Packagetype');
		if(isset($this->request->data['Packagetype']['id']))
        	$id = $this->request->data['Packagetype']['id'];
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit PackageType' );
        else
            $this->set( 'role','Add PackageType' );
         if( $this->request->is('post') )
				{
        $this->Packagetype->set( $this->request->data );
        
        if( $this->Packagetype->validates( $this->request->data ) )
			{
				
				
					if( empty( $id ) && $id == '' )
					{ 
						//Add case				
						$this->Packagetype->saveAll( $this->request->data );
						$this->Session->setflash( "Add successful" , 'flash_success');
						$this->redirect( '/JijGroup/Packaging/Type/Show' );
						/* Redirect action after success */
					}
					else
					{
						//Edit case
						$this->Packagetype->saveAll( $this->request->data );
						$this->Session->setflash( "Edit successful" , 'flash_success');
						$this->redirect( '/JijGroup/Packaging/Type/Show' );
						/* Redirect action after success */
					}
				}
			}
	}
    
    public function showAllPackage()
    {
		$this->layout = "index";
		
		$this->set( 'role','ShowAll PackageTypes' );
		$this->set('packageType' , $this->Packagetype->find('all'));
		$this->render( 'show_all_package' );
	}
        
    
    public function addEnvelope( $id = null )
    {
		$this->layout = "index";
		$this->loadModel( 'PackageEnvelope' );
		
		if(isset($this->request->data['PackageEnvelope']['id']))
        	$id = $this->request->data['PackageEnvelope']['id'];
		
		if( isset( $id ) & $id > 0 )
            $this->set( 'role','Edit Envelope' );
        else
            $this->set( 'role','Add Envelope' );
        
        // Set Packagibg Type as list
        
        $this->set( 'packageList' , $this->Packagetype->find('list' , array( 'fields' => array( 'Packagetype.package_type_name' ) )) );
         
        if( $this->request->is('post') )
		{
			$this->PackageEnvelope->set( $this->request->data );
			if( $this->PackageEnvelope->validates( $this->request->data ) )
			{
					if( empty( $id ) && $id == '' )
					{ 
						
						//Add case				
						$this->PackageEnvelope->saveAll( $this->request->data );
						
						$this->Session->setflash( "Add successful" , 'flash_success');
						$this->redirect( '/JijGroup/Envelope/PackagingEnvelopes/Show' );
						
						/* Redirect action after success */
						
					}
					else
					{
						$this->PackageEnvelope->saveAll( $this->request->data );
						//$this->redirect( '/JijGroup/Envelope/PackagingEnvelopes/Show' );
						$this->Session->setflash( "Edit successful" , 'flash_success');
						$this->redirect('/JijGroup/Envelope/PackagingEnvelopes/Show');
						/* Redirect action after success */
						
						
					}
			}
		}
	}
        
        
    public function showAllEnvelope()
    {
		$this->layout = "index";
		$this->loadModel( 'PackageEnvelope' );
		$this->set( 'role','ShowAll Variants' );
		$this->set('packageEnvelope' , $this->PackageEnvelope->find('all'));
		$this->render( 'show_all_envelope' );
	}
	public function editPackageEnvelope( $id = null )
	{
		$this->layout = "index";
		$this->loadModel( 'PackageEnvelope' );
		$this->set( 'title','Edit Variant' );
		$packageDetail	=	$this->PackageEnvelope->find('first', array('conditions' => array('PackageEnvelope.id' => $id)));
		$this->set( 'packageList' , $this->Packagetype->find('list' , array( 'fields' => array( 'Packagetype.package_type_name' ) )) );
		$this->request->data = $packageDetail;
		
	}
	
	public function deletepackageEnvelope( $id = null )
	{
		$this->layout = "index";
		$this->loadModel( 'PackageEnvelope' );
		if($this->PackageEnvelope->delete( $id ))
		{
			$this->Session->setflash( "Delete successful" , 'flash_success');
		}
		else
		{
			$this->Session->setflash( "There is some error in deletion" , 'flash_danger');
		}
		$this->redirect( '/JijGroup/Envelope/PackagingEnvelopes/Show' );
	}
	
	public function deletepackage() 
	{
		$this->layout = '';
		$this->autoRender = false;
		$this->loadModel( 'PackageEnvelope' );
		$id = $this->request->data;
		if($this->PackageEnvelope->delete( $id ))
		{
			$this->Session->setflash( "Delete successful" , 'flash_success');
			echo "1";
			exit;
		}
		else
		{
			$this->Session->setflash( "There is some error in deletion" , 'flash_danger');
			echo "2";
			exit;
		}
	}
	public function editPackage( $id = null ) 
	{
		$this->layout = "index";
		$this->loadModel( 'Packagetype' );
		$this->set( 'role','Edit Package Type' );
		$packageTypeDetail	=	$this->Packagetype->find('first', array('conditions' => array('Packagetype.id' => $id)));
		$this->request->data = $packageTypeDetail;
	}
	
	public function deletepackagetype()
	{
		$this->layout = '';
		$this->autoRender = false;
		$this->loadModel( 'Packagetype' );
		$id = $this->request->data['id'];
		if($this->Packagetype->delete( $id ))
		{
			$this->Session->setflash( "Delete successful" , 'flash_success');
			echo "1";
			exit;
		}
		else
		{
			$this->Session->setflash( "There is some error in deletion" , 'flash_danger');
			echo "2";
			exit;
		}
		
	}
}

?>
