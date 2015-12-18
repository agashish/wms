<?php

class UsersController extends AppController
{
    
    var $name = "Users";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
	
	public function beforeFilter()
	{		
        parent::beforeFilter(); 
    }
    
	public function login()
	{
		
		/* Start setup login layout */
		$this->layout = "wms_login";
		 
        //if already logged-in, redirect
        if($this->Session->check('Auth.User'))
		{			
            $this->redirect(array('controller'=>'users','action' => 'index'));			
        }
				
        // if we get the post information, try to authenticate
        if ($this->request->is('post'))
		{
			//debug($this->Auth->login());
			//$this->request->data['User']['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            if ($this->Auth->login())
			{				
                $this->Session->setFlash('Welcome, '. $this->Auth->user('first_name'), 'flash_success');
				
				/* Set Logged user data into session::write */
				$this->Session->write( 'Auth_WMS_User', $this->Auth->user() );
				
                $this->redirect($this->Auth->redirectUrl());
            }
			else
			{
                $this->Session->setFlash('Invalid username & password','flash_danger');
            }
        } 
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
	
	public function showall()
    {
        
        $this->layout = "index";
        
        /* Start here set custom title and breadcrumbs */
        $allUsers	=	$this->User->find('all');
        
        $title	=	"Show All User";
        $this->set( compact( "title","allUsers" ));
        $this->layout = "index";
    }
    
    public function saveuser()
    {

		if(isset($this->request->data['User']['id']))
		{
			$id = $this->request->data['User']['id'];
			if($this->request->data['User']['password'] == '')
			{
				unset($this->request->data['User']['password']);
			}
		}
		else
		{
			$id = '';
		}
		$this->layout = "index";
		/* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );

		$this->set( 'getRoleList', $this->Common->getRoleList() );
		
		if( !empty($this->request->data) )
			{
				
				//pr($this->request->data);
				//exit;
					$this->User->set( $this->request->data );
				if( $this->User->validates( $this->request->data ) )
					{
						
						if(!empty($this->request->data['User']['user_image']['name'] ))
							{
								if(isset($this->request->data['User']['image_name']) && $this->request->data['User']['image_name'] != "demo.png")
									{
										$image_name = WWW_ROOT .'img/upload/'.$this->request->data['User']['image_name'];
										chmod($image_name, 0777);
										unlink ( $image_name );
									}
									$uploadUrl	=	WWW_ROOT .'img/upload/';
									$getImageName = $this->Upload->upload($this->request->data['User']['user_image'], $uploadUrl );
									$this->request->data['User']['user_image'] = $getImageName;
									
							}
							else
							{
								
									$this->request->data['User']['user_image'] = $this->request->data['User']['image_name'];
									/* Save data into table */
							}
							
							$saveuser	=	$this->User->saveAll( $this->request->data );
							$id		=	$this->User->getLastInsertId();
							if($id){
								$this->Session->setflash(  "Add Successful." ,  'flash_success');
								$msg = "User add successfully in our List"; }
							else{
								$this->Session->setflash(  "Update Successful.",  'flash_success' );
								$msg = "User updated successfully in our List";
								$id = $this->request->data['User']['id']; }
								
					}
				else
				{
					if($this->request->data['User']['profile'] == 1)
					{
						/* redirect for adit profile */
						$this->Session->setflash(  "Please fill all field.",  'flash_danger' );
						$this->redirect( array( 'controller' => 'users', 'action' => 'userProfile' ) );
					}
						 
					$error = $this->User->validationErrors;                              
				}
			}
             
			$title = "Add New Users";
			if(!empty($saveuser))
			{
				if($this->request->data['User']['user_image'])
				{
					$image = $this->request->data['User']['user_image'];
				}
				else
				{
					$image = "demo.png";
				}
				
				$userDetail	=	$this->User->find('first',array('conditions' =>array('User.id' => $id)));
				$popupArray	=	array("User has been added.","<div style = text-align:center; >
									<div class=clearfix>
									<div class=message>
									<img class= manage_image style='border-radius: 158px; height: 200px; width: 200px;' src=".'app/webroot/img/upload/'.$image." ></div>
									</div>
									<div class=form-group>
									<label for=username ><strong>".ucfirst($userDetail['User']['first_name'])."</strong> ".$msg."</label>                                        
									</div>
									</div>","showList");
									
				$this->set( compact("title", "popupArray"));
			
			
			if( isset($this->request->data['User']['profile']) && $this->request->data['User']['profile'] == 1)
			{
				/* redirect for adit profile */
				$this->Session->setflash(  "Profile Update Successful.",  'flash_success' );
				$this->redirect( array( 'controller' => 'users', 'action' => 'userProfile' ) );
			}
		}
		else
		{
			$popupArray ="";
			$this->set( compact("title", "popupArray"));
		}
        
    }
    
    public function edituser($id = null)
    {
		$this->layout = "index";
		$title	=	"Edit User";
        $this->set( compact( "title","allUsers" ));
        
        /* Set other fucntionality for editing the form values and update it accordingly */
        $getList = $this->User->find( 'first',array('conditions' => array('User.id' => $id)) );
        
		/* Start here set the country list */        
        $this->set( 'getLocationArray', $this->Common->getCountryList() );
        
        /* Load Model of state */
        $this->set( 'getStateList', $this->Common->getStateList() );
        
        /* Load Model of state */
        $this->set( 'getCityList', $this->Common->getCityList() );

		$this->set( 'getRoleList', $this->Common->getRoleList() );
		unset($getList['User']['password']);
		
        /* Set the data over edit view where data would be visible for updating */
        $this->request->data = $getList;
	}
	
	/* Use for active the user in database */
	
	/*public function active($id = null)
	{
		
		$this->User->updateAll( array('User.status' => '1'),array('User.id' => $id));
		$this->Session->setflash(  "User Actived Successfully." );
		$this->redirect( array( 'controller' => 'showList' ) );
	}*/
	
	/*Use for deactive the use in database */
	
	/*public function deactive($id = null)
	{
		$this->User->updateAll( array('User.status' => '0'),array('User.id' => $id));
		$this->Session->setflash(  "User Deactived Successfully." );
		$this->redirect( array( 'controller' => 'showList' ) );
	}*/
	
	/* Use for send mail and counting the time */
	
	public function sendmail($id = null)
	{	
		/* Fetch the mail sent counter */
		$countSentMail	=	$this->User->find('first',  array('fields' => array('id','mail_counter'),'conditions' => array('User.id' => $id)));
		/* counter increase the one time */
		$count = $countSentMail['User']['mail_counter'] +1;
		/* Update the counter in database */
		$this->User->updateAll( array('User.mail_counter' => $count),array('User.id' => $id));
		$this->Session->setflash(  "Mail has been sent [ ".$count." ] time successfully.",  'flash_success' );
		$this->redirect( array( 'controller' => 'showList' ) );
	}
	 public function actionlocunlock( $id = null, $str = null, $strAction = null )
    {
        
        /* Set here false to render the self view */
        $this->autorender = false;
        
        /* Action perform according active and deactive */
        
        if( $strAction === "userAction" )
        {            
         
            if( $str === "Deactive" ){
                $action = 0;
                $msg	= "Active Successful";}
            else{
                $action = 1;
                $msg	= "Deactive Successful";}
            
            $this->User->updateAll( array( "User.status" => $action ), array( "User.id" => $id ) );

            /* Redirect action after success */
            $this->Session->setflash( $msg , 'flash_success');                      
            $this->redirect( array( "controller" => "showList" ) );
            
        }
        
    }
    
    /* Use for change is_deleted condition in database */
    
    public function deleteAction($id = null, $isDeleted =null )
    {
		$action 	=	"1";
		if($isDeleted == 0){
			$isDeleted = 1;
			$msg = "Deletion successful"; }
		else{
			$isDeleted = 0;
			$msg = "Retreival successful"; }
			
			$this->User->updateAll( array( "User.is_deleted" => $isDeleted, "User.status" => $action), array( "User.id" => $id ) );
			$this->Session->setflash( $msg ,  'flash_success');                      
            $this->redirect( array( "controller" => "showList" ) );
	}
	
	public function userProfile()
	{
		$this->layout = 'index';
		$this->loadModel( 'User' );
		$title = 'Profile';
		
		$userID	=	 $this->Session->read('Auth.User.id');
		$userDetail	=	$this->User->find('first', array('conditions' => array('User.id' => $userID)) );
		unset($userDetail['User']['password']);
		
		$this->request->data = $userDetail;
		$this->set('title', $title);
		
		
	}
	
	public function index()
	{
		$this->layout = 'index';
	}
    
    
    
}

?>
