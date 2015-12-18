<?php
	
	class CommonComponent extends Component
	{	
		
		function startup (Controller $controller)
                {
            
		}
        
        /*
         * Function : GetCountry List
         * Version : 1.0
         * Company : JijGroup US - UK - India - Europe
         * Parameters : @Null
         * Result List Array
         * 
         */
        public function getCountryList()
        {
            
            /* Start here set the country list */            
            App::import( "Model","Location" );
            $location = new Location();            
            $options = array(				
				'fields' => array('Location.county_name')
			);
            
        return $getLocationArray = $location->find( 'list', $options );
        }

        public function getStateList()
        {
            
            /* Start here set the country list */            
            App::import( "Model","State" );
            $state = new State();            
            $options = array(				
				'fields' => array('State.id','State.state_name','State.is_deleted')
			);
            $getStateAllWithStatus = $state->find( 'all', $options );			
            $newStateList = array();
            if( $state->find( 'count', $options ) > 0 )
            {				
                foreach( $getStateAllWithStatus as $index => $value )
                {					
                    if( $value["State"]["is_deleted"] == "1" )
                    {
                            $newStateList[$value["State"]["id"]] = $value["State"]["state_name"]." (Under Deleted)";						
                    }
                    else
                    {
                            $newStateList[$value["State"]["id"]] = $value["State"]["state_name"];						
                    }
                }
            }
        return $getCityList = $newStateList;	
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
        
        public function getWarehouseList()
		{
			
			/* Load Model of warehouses and setup the list */
			App::import( 'Model', 'Warehouse' );
			$warehouse = new Warehouse();			
			$getWarehouseAllWithStatus = $warehouse->find( 'all' );
			
			$newWarehouseList = array();
			if( $warehouse->find( 'count' ) > 0 )
			{				
				foreach( $getWarehouseAllWithStatus as $index => $value )
				{					
					if( $value["WarehouseDesc"]["is_deleted"] == "1" )
					{
						$newWarehouseList[$value["Warehouse"]["id"]] = $value["Warehouse"]["warehouse_name"]." (Under Deleted)";						
					}
					else
					{
						$newWarehouseList[$value["Warehouse"]["id"]] = $value["Warehouse"]["warehouse_name"];						
					}
				}
			}
		return $getWarehouseList = $newWarehouseList;	
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


	public function getRoleList()
        {
            /* Start here set the role list */            
            App::import( "Model","Role" );
            $role = new Role();            
            return $getRolesList = $role->find( 'list',array('fields' => array('Role.id', 'Role.role_name')));			
        }
        
        public function getProviderList()
        {
            /* Start here set the role list */            
            App::import( "Model","PostalProvider" );
            $PostalProvider = new PostalProvider();            
            return $getproviderList = $PostalProvider->find( 'list',array('fields' => array('PostalProvider.id', 'PostalProvider.provider_name')));			
        }

	}
	
?>
