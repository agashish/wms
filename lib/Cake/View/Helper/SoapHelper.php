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
class SoapHelper extends AppHelper
{
	
    function getcomponent($strComponentname)
	{
		
		if( $strComponentname !== "" )		
		{
			App::import( "Component", $strComponentname );
			$objComponent =  new $strComponentname();			
			return $objComponent;
		}
		else
		{
			throw new Exception( "Oops,Kindly pass your component here!" );
		}
	}
    
    /**
    * 
    *   Soap Helper function and its attribute (Params)   
    *   Soap request for getting information og order is process or not
    */    
    public function getProcessedOrder( $param = array() )
    {
        
        $Token = Configure::read('access_token');
        $soapUrl = "http://api.linnlive.com/order.asmx?op=ProcessOrder";                
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <ProcessOrder xmlns="http://api.linnlive.com/order">
              <Token>'.$Token.'</Token>
              <request>        
                <OrderIdIsSet>true</OrderIdIsSet>
                <OrderId>'.$param['OrderId'].'</OrderId>                                                
                <ProcessedByName>'.$param['ProcessedByName'].'</ProcessedByName>
                <ProcessDateTimeIdIsSet>true</ProcessDateTimeIdIsSet>        
              </request>
            </ProcessOrder>
          </soap:Body>
        </soap:Envelope>';
        
        $headers = array(
        "POST /generic.asmx HTTP/1.1",
        "Host: api.linnlive.com",
        "Content-Type: text/xml; charset=utf-8",
        "Content-Length: ".strlen($xml_post_string)
        );
        
        $url = $soapUrl;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch); 
        curl_close($ch);
        
        $response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
        $parser = simplexml_load_string($response);
        //echo "<pre>";
        //print_r($parser);
    return $parser->ProcessOrderResponse->ProcessOrderResult->Error;
        //exit;        
        
    }
    
    public function getFilteredOrder( $data = array() )
    {
		$Token = Configure::read('access_token');
		$xml_string = '';
		//pr($data);
		
		$from 	= 	$data['Linnworksapi']['datefrom'];
		$newfrom = date("Y-m-d", strtotime($from)).'T01:03:52.42';
		
		$to		=	$data['Linnworksapi']['dateto'];
		$newto = date("Y-m-d", strtotime($to)).'T23:55:52.42';
		
		
		
		if($data['Linnworksapi']['order_type'] == 0 && !empty($newfrom) && !empty($newto) )
		{
			$xml_string .= '<OrderDateFromIsSet>true</OrderDateFromIsSet>
						    <OrderDateFrom>'.$newfrom.'</OrderDateFrom>
						    <OrderDateToIsSet>true</OrderDateToIsSet>
						    <OrderDateTo>'.$newto.'</OrderDateTo>';
		}
		if($data['Linnworksapi']['order_type'] == 1 && !empty($data['Linnworksapi']['order_type']) &&!empty($newfrom) && !empty($newto) )
		{
			$xml_string .= '<OrderProcessDateFromIsSet>true</OrderProcessDateFromIsSet>
						    <OrderProcessDateFrom>'.$newfrom.'</OrderProcessDateFrom>
						    <OrderProcessDateToIsSet>true</OrderProcessDateToIsSet>
						    <OrderProcessDateTo>'.$newto.'</OrderProcessDateTo>';
		}
		if(!empty($data['Linnworksapi']['orderid']))
		{
			$xml_string .= '<OrderIdIsSet>true</OrderIdIsSet><OrderId>'.$data['Linnworksapi']['orderid'].'</OrderId>';
		}
		
		if($data['Linnworksapi']['order_type'] == 2)
		{
			$xml_string .= '<OrderDateFromIsSet>true</OrderDateFromIsSet>
						    <OrderDateFrom>'.$newfrom.'</OrderDateFrom>
						    <OrderDateToIsSet>true</OrderDateToIsSet>
						    <OrderDateTo>'.$newto.'</OrderDateTo><Cancel>true</Cancel>';
		}
		if(!empty($data['Linnworksapi']['source']))
		{
			$xml_string .= '<Source>'.$data['Linnworksapi']['source'].'</Source>';
		}
		if(!empty($data['Linnworksapi']['subsource']))
		{
			$xml_string .= '<SubSource>'.$data['Linnworksapi']['subsource'].'</SubSource>';
		}
		if(!empty($data['Linnworksapi']['location']))
		{
			$xml_string .= '<Location>'.$data['Linnworksapi']['location'].'</Location>';
		}
		
			
			$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
				<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFilteredOrders xmlns="http://api.linnlive.com/order">
					  <Token>'.$Token.'</Token>
					  <Filter>'.$xml_string.'</Filter>
					</GetFilteredOrders>
				  </soap:Body>
				</soap:Envelope>'; 
				
				$xml_post_string;
				
			$soapUrl = "http://api.linnlive.com/order.asmx?op=GetFilteredOrders";

			$headers = array(
			"GET /order.asmx HTTP/1.1",
			"Host: api.linnlive.com",
			"Content-Type: text/xml; charset=utf-8",
			"Content-Length: ".strlen($xml_post_string)
			);

			$url = $soapUrl;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch); 

			curl_close($ch);

			$response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
			$parserData = simplexml_load_string($response);
			//pr($parserData);
			//exit;
			return $parserData;
	}
	
	public function getLocation()
	{
		$Token = Configure::read('access_token');

		$soapUrl = "http://api.linnlive.com/generic.asmx?op=GetLocations";

		$xml_post_string ='<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><GetLocations xmlns="http://api.linnlive.com/generic"><Token>'.$Token.'</Token></GetLocations></soap:Body></soap:Envelope>';

		$headers = array(
		"GET /generic.asmx HTTP/1.1",
		"Host: api.linnlive.com",
		"Content-Type: text/xml; charset=utf-8",
		"Content-Length: ".strlen($xml_post_string)
		);

		$url = $soapUrl;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch); 

		curl_close($ch);

		$response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
		$parser = simplexml_load_string($response);
		
		foreach( $parser->GetLocationsResponse->GetLocationsResult->DataObj->StockItemLocation as $value )
                {					
			        $location[''.$value->LocationName.'' ]	=	 $value->LocationName;
                }
		
		return $location; 
	}
	
	public function getOpenOrder()
	{
			$Token = Configure::read('access_token');
			$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
				<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFilteredOrders xmlns="http://api.linnlive.com/order">
					  <Token>'.$Token.'</Token>
					  <Filter></Filter>
					</GetFilteredOrders>
				  </soap:Body>
				</soap:Envelope>'; 
			$soapUrl = "http://api.linnlive.com/order.asmx?op=GetFilteredOrders";

			$headers = array(
			"GET /order.asmx HTTP/1.1",
			"Host: api.linnlive.com",
			"Content-Type: text/xml; charset=utf-8",
			"Content-Length: ".strlen($xml_post_string)
			);

			$url = $soapUrl;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch); 

			curl_close($ch);

			$response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
			$parserData = simplexml_load_string($response);
			return $parserData;
	}

	public function getOrderById( $id = null)
	{
		$Token = Configure::read('access_token');
		$xml_string = '<OrderIdIsSet>true</OrderIdIsSet><OrderId>'.$id.'</OrderId>';
		$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
				<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				  <soap:Body>
					<GetFilteredOrders xmlns="http://api.linnlive.com/order">
					  <Token>'.$Token.'</Token>
					  <Filter>'.$xml_string.'</Filter>
					</GetFilteredOrders>
				  </soap:Body>
				</soap:Envelope>';
		$soapUrl = "http://api.linnlive.com/order.asmx?op=GetFilteredOrders";

		$headers = array(
		"GET /order.asmx HTTP/1.1",
		"Host: api.linnlive.com",
		"Content-Type: text/xml; charset=utf-8",
		"Content-Length: ".strlen($xml_post_string)
		);

		$url = $soapUrl;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch); 

		curl_close($ch);

		$response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
		$parserData = simplexml_load_string($response);
		//pr($parserData);
		//exit;
		return $parserData;
	}
    
    
    
}
