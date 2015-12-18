<?php
/**
 * Html Helper class file.
 *
 * Simplifies the construction of HTML elements.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Helper
 * @since         CakePHP(tm) v 0.9.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppHelper', 'View/Helper');
App::uses('CakeResponse', 'Network');

/**
 * Html Helper class for easy use of HTML widgets.
 *
 * HtmlHelper encloses all methods needed while working with HTML pages.
 *
 * @package       Cake.View.Helper
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html
 */
class CoreprintingHelper extends AppHelper
{
    
    public function getAuth()
    {
		return Configure::read( 'username' );
	}
	
	public function getHost( $getUri = null )
	{
		return $this->getApiUrl().$getUri;
	}
       
    public function getHostUriToPrint()
    {
		return 'printjobs';
	}   
	
	public function combHost()
	{
		return $this->getHost( $this->getHostUriToPrint() );
	}
	
	public function getApiUrl()
	{
		return 'https://api.printnode.com/';
	}
	
	public function setDtlToPrt( $prtId = null , $itle = null , $contType = null , $uri = null , $source = null )
	{		
		$createArray = array(
				'printerId' => $prtId,
				'title' => $itle,
				'contentType' => $contType,
				'content' => $uri,
				'source' => $source
			);
		return $createArray;
	}
	
	public function curlInitialize()
	{
		return curl_init();
	}
	
	public function setUrl()
	{
		return CURLOPT_URL;
	}
	
	public function setTimeOut()
	{
		return CURLOPT_TIMEOUT;
	}
	
	public function verify()
	{
		return CURLOPT_SSL_VERIFYPEER;
	}
	
	public function setPost()
	{
		return CURLOPT_POST;
	}
	
	public function setPostFeild()
	{
		return CURLOPT_POSTFIELDS;
	}
	
	public function setTransfer()
	{
		return CURLOPT_RETURNTRANSFER;
	}
	
	public function curlAuth()
	{
		return CURLOPT_HTTPAUTH;
	}
	
	public function getDetail()
	{
		return CURLOPT_USERPWD;
	}
	
	public function getCodeHttp()
	{
		return CURLINFO_HTTP_CODE;
	}
	
	public function getExec( $ch = null )
	{
		return curl_exec ($ch);
	}
	
	public function setPrinterUri()
	{
		return $this->getApiUrl() . 'printers';
	}
	
	public function setOptUrl( $ch = null , $URL = null )
	{		
		curl_setopt($ch, $this->setUrl() ,$URL);		
	}
	
	public function setTout( $ch = null )
	{
		curl_setopt($ch, $this->setTimeOut(), 30); //timeout after 30 seconds	
	}
	
	public function setVerify( $ch = null , $boolValue )
	{
		curl_setopt($ch, $this->verify(), false); //timeout after 30 seconds	
	}
	
	public function setTransferVerify( $ch = null )
	{
		curl_setopt($ch, $this->setTransfer(), 1); //timeout after 30 seconds	
	}
	
	public function setCurlAuth( $ch = null )
	{
		curl_setopt($ch, $this->curlAuth(), 1); 
	}
	
	public function getDetailNow( $ch = null , $username = null, $password = null )
	{
		curl_setopt($ch, $this->getDetail(), "$username:$password");
	}
	
	public function curlShutDown( $ch = null )
	{
		curl_close ($ch);
	}
	
	public function setPostNow( $ch = null )
	{
		curl_setopt($ch, $this->setPost(), 1);
	}
	
	public function setPostOutNow( $ch = null , $postFeilds = array()  )
	{
		curl_setopt($ch, $this->setPostFeild(), http_build_query( $postFeilds ));
	}
	
}
