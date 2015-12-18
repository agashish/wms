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
class CommonHelper extends AppHelper
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
	
	public function getUserDataAfterLogin( $userData = null )
	{
		
		App::import( "Model", "User" );
		$userObject =  new User();			
		
		/* Get data from id */
		$getUserData = $userObject->findById( $userData );
	return $getUserData;	
	}
	
	public function getFirstLastName( $userData = null )
	{
		
		App::import( "Model", "User" );
		$userObject =  new User();			
		
		/* Get data from id */
		$getUserData = $userObject->findById( $userData );
		
		/* Get Data */
		$lastName = str_split( $getUserData['User']['last_name'] );
		
	return ucfirst( $getUserData['User']['first_name']. ' '. $lastName[0]);  					
	}
	
	public function getWarehouseList()
	{
		
		/* Load Model of warehouses and setup the list */
		App::import( 'Model', 'Warehouse' );
		$warehouse = new Warehouse();
		
		/* Set conditions */
        $options = array(
            'fields' => array('City.city_name','Warehouse.warehouse_name','Warehouse.id'),
            'joins' => array(                
                array(
                    'alias' => 'City',  
                    'table' => 'cities',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'City.id = WarehouseDesc.city_id',
                    )
                )            
            ),
	    'conditions' => array('WarehouseDesc.is_deleted' => 0), 
        );		
		$getWarehouseAllWithStatus = $warehouse->find( 'all', $options );		
		$newWarehouseList = array();
		if( $warehouse->find( 'count' ) > 0 )
		{				
			foreach( $getWarehouseAllWithStatus as $index => $value )
			{					
				$newWarehouseList[$value["Warehouse"]["id"]] = $value["Warehouse"]["warehouse_name"] ." (" . $value["City"]["city_name"] . ")" ;						
			}
		}
	return $getWarehouseList = $newWarehouseList;	
	}
	
	public function getWarehouseLevelList()
	{
		/* Load Model of warehouses and setup the list */
		App::import( 'Model', 'WarehouseLevel' );
		$warehouseLevel = new WarehouseLevel();
		
		$options = array(
            'fields' => array('WarehouseLevel.warehouse_rack','WarehouseLevel.warehouse_section','WarehouseLevel.warehouse_level','Warehouse.warehouse_name','Warehouse.id'),
            'joins' => array(                
                array(
                    'alias' => 'Warehouse',  
                    'table' => 'warehouses',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Warehouse.id = WarehouseLevel.warehouse_id',
                    )
                )           
            )
        );	
		$getWarehouseLeveldetails = $warehouseLevel->find( 'all',  $options);
		
		return $getWarehouseLeveldetails = $getWarehouseLeveldetails;	
		
	}


	 public function getCityList()
        {
            
            /* Start here set the country list */            
            App::import( "Model","City" );
            $city = new City();            
            $options = array('fields' => array('City.id','City.city_name','City.is_deleted'));
            $getCityAllWithStatus = $city->find( 'all', $options );			
            $newCityList = array();
            if( $city->find( 'count', $options ) > 0 )
            {				
                foreach( $getCityAllWithStatus as $index => $value )
                {					
                    if( $value["City"]["is_deleted"] == "1" )
                    {
                            $newCityList[$value["City"]["id"]] = $value["City"]["city_name"]." (Under Deleted)";						
                    }
                    else
                    {
                            $newCityList[$value["City"]["id"]] = $value["City"]["city_name"];						
                    }
                }
            }
        return $getCityList = $newCityList;
        }

public function getCategoryList()
        {
            
            /* Start here set the country list */            
            App::import( "Model","Category" );
            $category = new Category();            
            $options = array('fields' => array('Category.id','Category.category_name','Category.parent_id', 'Category.is_deleted', 'Category.status', 'Category.is_blocked'),
					'conditions' => array('Category.is_deleted' => '0'));
					
            $getCategoryAllWithStatus = $category->find( 'all', $options );			
            $newcategoryList = array();
            if( $category->find( 'count', $options ) > 0 )
            {				
                foreach( $getCategoryAllWithStatus as $index => $value )
                {					
                    if( $value["Category"]["status"] == "1" )
                    {
                            $newCategoryList[$value["Category"]["id"]] = $value["Category"]["category_name"]." (Deactive)";						
                    }
                    else
                    {
                            $newCategoryList[$value["Category"]["id"]] = $value["Category"]["category_name"];						
                    }
                }
                return $getCategoryList = $newCategoryList;
            }
			
        }
        
         /* function use for get curreny conversion rate from table */
        
        public function getconversionrate()
		{
			App::import( "Model","CurrencyExchange" );
            $currency = new CurrencyExchange(); 
            
			$getConversionRate	=	$currency->find('all', array('order' => array('CurrencyExchange.date' => 'DESC')));
			return $getConversionRate;
		}
		
		public function getBrandName()
		{
			/* Start here get brand name */            
			App::import( "Model","Brand" );
			$Brand = new Brand();            
			return $getproviderList = $Brand->find( 'list', array('fields' => array('Brand.id', 'Brand.brand_name')));			
		}				
	
}
