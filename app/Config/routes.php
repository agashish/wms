<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
    
    /* Start here new routes setup for whole login and logout root controller */
    //Router::connect('/', array('controller' => 'homes', 'action' => 'index'));
    Router::connect('/', array('controller' => 'users', 'action' => 'login'));
    
    /* Start here setting routes for manages roles module */
    Router::connect('/managerole', array('controller' => 'roles', 'action' => 'index'));
    Router::connect('/showRoles', array('controller' => 'roles', 'action' => 'showall'));
    Router::connect('/editRoles/*', array('controller' => 'roles', 'action' => 'editrole'));
        
    /* Start here setting routes for show all users module */
    Router::connect('/showList', array('controller' => 'users', 'action' => 'showall'));
    Router::connect('/register', array('controller' => 'users', 'action' => 'saveuser'));
    Router::connect('/editUsers/*', array('controller' => 'users', 'action' => 'edituser'));
    Router::connect('/sendMail/*', array('controller' => 'users', 'action' => 'sendmail'));
    Router::connect('/lockUnlockUser/*', array('controller' => 'users', 'action' => 'actionlocunlock'));
    Router::connect('/deleteUser/*', array('controller' => 'users', 'action' => 'deleteAction'));
    Router::connect('/userProfile', array('controller' => 'users', 'action' => 'userProfile'));
    
    /* Start here setting routes for add and region module */
    Router::connect('/manageCounty', array('controller' => 'locations', 'action' => 'index'));    
    Router::connect('/showallLocation', array('controller' => 'locations', 'action' => 'showall'));
    Router::connect('/editCounty/*', array('controller' => 'locations', 'action' => 'editlocation'));
    
    /* Start here setting routes for add and state module */
    Router::connect('/manageState', array('controller' => 'locations', 'action' => 'addstate'));    
    Router::connect('/showallStates', array('controller' => 'locations', 'action' => 'showallstate'));
    Router::connect('/editState/*', array('controller' => 'locations', 'action' => 'editstate'));
    Router::connect('/deleteState/*', array('controller' => 'locations', 'action' => 'statedelete'));
    
    /* Start here setting routes for add and city module */
    Router::connect('/manageCity', array('controller' => 'locations', 'action' => 'addcity'));    
    Router::connect('/showallCities', array('controller' => 'locations', 'action' => 'showallcity'));
    Router::connect('/editCity/*', array('controller' => 'locations', 'action' => 'editcity'));
    Router::connect('/deleteCity/*', array('controller' => 'locations', 'action' => 'citydelete'));
    Router::connect('/lockUnlock/*', array('controller' => 'locations', 'action' => 'actionlocunlock'));
        
    /* Start here setting routes for add warehouses module */
    Router::connect('/manageWarehouse', array('controller' => 'warehouses', 'action' => 'addwarehouse'));    
    Router::connect('/showallWarehouses', array('controller' => 'warehouses', 'action' => 'showallwarehouse'));
    Router::connect('/editWarehouse/*', array('controller' => 'warehouses', 'action' => 'editwarehouse'));        
    Router::connect('/deleteWH/*', array('controller' => 'warehouses', 'action' => 'warehousedelete'));
    Router::connect('/rackdetailWH/*', array('controller' => 'warehouses', 'action' => 'detailWarehouseRack'));
    Router::connect('/lock/*', array('controller' => 'warehouses', 'action' => 'actionlocunlock'));
    Router::connect('/deleteRack', array('controller' => 'warehouses', 'action' => 'deleteRetrieveRack'));
    Router::connect('/retrieveRack', array('controller' => 'warehouses', 'action' => 'deleteRetrieveRack'));
    
    /* Start here setting routes for add Client module */
    Router::connect('/manage/client/new', array('controller' => 'clients', 'action' => 'addclient'));    
    Router::connect('/showall/Client/List', array('controller' => 'clients', 'action' => 'showallclient'));
    Router::connect('/showall/Client/List/edit/*', array('controller' => 'clients', 'action' => 'editclient'));        
    Router::connect('/showall/Client/List/delete/CL/*', array('controller' => 'clients', 'action' => 'clientdelete'));
    Router::connect('/showall/Client/List/lock/UnlockCL/*', array('controller' => 'clients', 'action' => 'actionlocunlock'));

    /* Start here route setting for suppiers */
    Router::connect('/manageSupplier', array('controller' => 'suppliers', 'action' => 'addsupplier'));
    Router::connect('/showAllSupplier', array('controller' => 'suppliers', 'action' => 'showallsupplier'));
    Router::connect('/editSupplier/*', array('controller' => 'suppliers', 'action' => 'editsupplier'));   
    Router::connect('/deleteSP/*', array('controller' => 'suppliers', 'action' => 'supplierdelete'));
    Router::connect('/lockUnlockSP/*', array('controller' => 'suppliers', 'action' => 'actionlocunlock'));
    /* End here route setting for suppiers */
	
	/* Start here route setting for products */
    Router::connect('/manageProducts', array('controller' => 'products', 'action' => 'addproducts'));
    Router::connect('/showAllProducts', array('controller' => 'products', 'action' => 'showallproducts'));
    Router::connect('/editProducts/*', array('controller' => 'products', 'action' => 'editproducts'));   
    Router::connect('/deletePr/*', array('controller' => 'products', 'action' => 'productdelete'));
    Router::connect('/lockUnlockPr/*', array('controller' => 'products', 'action' => 'actionlocunlock'));
    /* End here route setting for products */
    
    /* Start here routing for ajax controller to be seperate in different folders */
    Router::connect('/jijGroup/server/warehouse/list', array('controller' => 'serverajaxs', 'action' => 'getRacksBehindWarehouse'));    
    Router::connect('/jijGroup/server/warehouse/section/add', array('controller' => 'serverajaxs', 'action' => 'addSection'));
    Router::connect('/jijGroup/server/warehouse/level/list', array('controller' => 'serverajaxs', 'action' => 'getLevelBehindSection'));
    Router::connect('/jijGroup/server/warehouse/level/add', array('controller' => 'serverajaxs', 'action' => 'addLevelForWarehouse'));
    /* End here routing for ajax controller to be seperate in different folders */
	
    /* Start here routing for ajax section controller to be seperate in different folders */
    Router::connect('/jijGroup/server/warehouse/section/getWarehouse', array('controller' => 'serverajaxs', 'action' => 'getWarehouseFromCity'));
    Router::connect('/jijGroup/server/warehouse/section/getSection', array('controller' => 'serverajaxs', 'action' => 'getAllSection'));
    Router::connect('/jijGroup/server/warehouse/section_update', array('controller' => 'serverajaxs', 'action' => 'sectionUpdate'));
    Router::connect('/jijGroup/server/warehouse/section_delete', array('controller' => 'serverajaxs', 'action' => 'sectionDeleteRetrieve'));
    Router::connect('/jijGroup/server/warehouse/section_retrieve', array('controller' => 'serverajaxs', 'action' => 'sectionDeleteRetrieve'));
    /* End here routing for ajax controller to be seperate in different folders */
    
    /* Start here routing for ajax level controller to be seperate in different folders */
    Router::connect('/jijGroup/server/warehouse/level_delete', array('controller' => 'serverajaxs', 'action' => 'levelDeleteRetrieve'));
    Router::connect('/jijGroup/server/warehouse/level_retrive', array('controller' => 'serverajaxs', 'action' => 'levelDeleteRetrieve'));
    Router::connect('/jijGroup/server/warehouse/level_update', array('controller' => 'serverajaxs', 'action' => 'levelUpdate'));
    Router::connect('/jijGroup/server/warehouse/section/getLevel', array('controller' => 'serverajaxs', 'action' => 'getAllLevel'));
    Router::connect('/jijGroup/server/warehouse/get_level_detail', array('controller' => 'serverajaxs', 'action' => 'getleveldetail'));
    /* End here routing for ajax level controller to be seperate in different folders */
    
    /* Start here routing for ajax bin controller to be seperate in different folders */
    Router::connect('/jijGroup/server/warehouse/addBin/add', array('controller' => 'serverajaxs', 'action' => 'saveBin'));
    Router::connect('/jijGroup/server/warehouse/bin/list', array('controller' => 'serverajaxs', 'action' => 'getAllBinsById'));
    /* End here routing for ajax bin controller to be seperate in different folders */

    /* Start here routing for ajax controller to be seperate in different folders */
    Router::connect('/jijGroup/server/warehouse/bin_delete', array('controller' => 'Warehouses', 'action' => 'deleteBin'));
    Router::connect('/jijGroup/server/warehouse/add_section', array('controller' => 'Warehouses', 'action' => 'addSectionByRack'));
    Router::connect('/jijGroup/server/warehouse/remove_section', array('controller' => 'Warehouses', 'action' => 'removeSectionByRack'));
    Router::connect('/jijGroup/server/warehouse/getbin', array('controller' => 'serverajaxs', 'action' => 'getAllBin'));
    Router::connect('/jijGroup/server/warehouse/editbin', array('controller' => 'serverajaxs', 'action' => 'showBinUpdate'));
    Router::connect('/jijGroup/server/warehouse/bin_delete', array('controller' => 'serverajaxs', 'action' => 'showBinDelete'));
    Router::connect('/jijGroup/server/warehouse/bin/delete', array('controller' => 'serverajaxs', 'action' => 'deleteBinsById'));
    /* End here routing for ajax controller to be seperate in different folders */

    /* Start here route setting for brands */
    Router::connect('/manageBrand', array('controller' => 'brands', 'action' => 'addbrand'));
    Router::connect('/showAllBrand', array('controller' => 'brands', 'action' => 'showallbrand'));
    Router::connect('/editBrand/*', array('controller' => 'brands', 'action' => 'editbrand'));   
    Router::connect('/deleteBr/*', array('controller' => 'brands', 'action' => 'branddelete'));
    Router::connect('/lockUnlockBr/*', array('controller' => 'brands', 'action' => 'actionlocunlock'));
    Router::connect('/Brand/lock/UnlockCL/*', array('controller' => 'brands', 'action' => 'actionlocunlock'));
    Router::connect('/Brand/delete/CL/*', array('controller' => 'brands', 'action' => 'deleteAction'));
    Router::connect('/Brand/edit/*', array('controller' => 'brands', 'action' => 'editBrand'));
    /* End here route setting for brands */

    /* Start here route setting for category */
    Router::connect('/manageCategory', array('controller' => 'categories', 'action' => 'addCategory'));
    Router::connect('/showAllCategory', array('controller' => 'categories', 'action' => 'showCategory'));
    Router::connect('/activedeactive/*', array('controller' => 'categories', 'action' => 'activeDeactive'));
    Router::connect('/deleteCAT/*', array('controller' => 'categories', 'action' => 'deleteAction'));
    Router::connect('/editCategory/*', array('controller' => 'categories', 'action' => 'editCategory'));
    /* End here route setting for category */
    
    /* Start here route setting for product attribute */
    Router::connect('/attribute', array('controller' => 'brands', 'action' => 'addAttribute'));
    Router::connect('/addattribute', array('controller' => 'brands', 'action' => 'addAttribute'));
    Router::connect('/lockUnlockAttr/*', array('controller' => 'brands', 'action' => 'actionlocunlockAttr'));
    Router::connect('/editarrribute/*', array('controller' => 'brands', 'action' => 'editArrribute'));
    Router::connect('/saveattribute', array('controller' => 'brands', 'action' => 'saveAttribute'));
    Router::connect('/deleteAttr/*', array('controller' => 'brands', 'action' => 'attrDeleteRetrive'));
    Router::connect('/addoptions/*', array('controller' => 'brands', 'action' => 'addOption'));
    Router::connect('/addattributeoption/*', array('controller' => 'brands', 'action' => 'addAttributeOption'));
    Router::connect('/addoptionoptional', array('controller' => 'brands', 'action' => 'addOptionOptional'));
    Router::connect('/jijGroup/brand/editOption', array('controller' => 'brands', 'action' => 'editAttributeOption'));
    Router::connect('/jijGroup/brand/deleteOption', array('controller' => 'brands', 'action' => 'deleteAttributeOption'));
    /* End here route setting for product attribute */

	
    /* Start here route setting for LINNWORKS API */    
    Router::connect('/JijGroup/Generic/Category', array('controller' => 'Linnworksapis', 'action' => 'getCategory'));
    Router::connect('/JijGroup/Generic/StockItem', array('controller' => 'Linnworksapis', 'action' => 'getStockItem'));
    Router::connect('/JijGroup/Generic/Status/Order', array('controller' => 'Linnworksapis', 'action' => 'getorderStatus'));
    Router::connect('/JijGroup/Generic/Services/Postal', array('controller' => 'Linnworksapis', 'action' => 'getPostalServices'));
    Router::connect('/JijGroup/Generic/Store/Location', array('controller' => 'Linnworksapis', 'action' => 'getLocations'));
    Router::connect('/JijGroup/Generic/Order/GetOrder', array('controller' => 'Linnworksapis', 'action' => 'getOrder'));    
    Router::connect('/JijGroup/Generic/Order/OrderFilter', array('controller' => 'Linnworksapis', 'action' => 'getFilterOrder'));    
    Router::connect('/JijGroup/Generic/Order/OrderFilterDownload', array('controller' => 'Linnworksapis', 'action' => 'downloadExcel'));    
    /* End here route setting for LINNWORKS API */
    
    /* Start here for setting for linnwork php api */
    
    Router::connect('/JijGroup/Generic/Order/GetOpenFilter', array('controller' => 'Linnworksapis', 'action' => 'getOpenOrder'));    
    Router::connect('/jijGroup/Order/orderProcess', array('controller' => 'Linnworksapis', 'action' => 'orderProcess'));    
    Router::connect('/jijGroup/Order/orderCancel', array('controller' => 'Linnworksapis', 'action' => 'orderCancel'));
    Router::connect('/jijGroup/Order/orderDelete', array('controller' => 'Linnworksapis', 'action' => 'orderDelete'));        
    Router::connect('/Linnworksapis/getOrderdetail/*', array('controller' => 'Linnworksapis', 'action' => 'getOrderDetail'));    
    
    /* End here for setting for linnwork php api */
    
    /* Start Delevery Matrix */
    
    Router::connect('/JijGroup/DeleveryMatrix', array('controller' => 'Matrices', 'action' => 'addMatrix'));    
    Router::connect('/JijGroup/showallmatrix', array('controller' => 'Matrices', 'action' => 'ShowAllMatrix'));    
	Router::connect('/JijGroup/addPostalProvider', array('controller' => 'Matrices', 'action' => 'addPostalProvider'));    
    Router::connect('/JijGroup/showallpostalprovider', array('controller' => 'Matrices', 'action' => 'showAllPostalProvider'));    
    Router::connect('/JijGroup/Showallplatformfee', array('controller' => 'Matrices', 'action' => 'ShowAllPlatFormFee'));    
    Router::connect('/JijGroup/addplatformfee', array('controller' => 'Matrices', 'action' => 'addAmazonPlatformFee'));    
    
    /* End Delevery Matrix */
    
    /* Start FlatFormFee Charges*/
    
    Router::connect('/JijGroup/ShowAmazonFbaFee', array('controller' => 'Platformcharges', 'action' => 'ShowAmazonFbaFee'));    
    Router::connect('/JijGroup/ShowAllCategoryFee', array('controller' => 'Platformcharges', 'action' => 'ShowAllCategoryFee'));    
    Router::connect('/JijGroup/AddCategoryFee', array('controller' => 'Platformcharges', 'action' => 'AddCategoryFee'));    
    
    /* End FlatFormFee Charges*/
    
    /* Start here route for manage  products */
    
    Router::connect('/addProductattributeset', array('controller' => 'products', 'action' => 'addattributeset'));
    Router::connect('/manageProduct', array('controller' => 'products', 'action' => 'addproduct'));
    Router::connect('/showAllProduct', array('controller' => 'products', 'action' => 'showallproduct'));
    /* End here route for manage  products */
	
	/* Start for upload product */
	Router::connect('/JijGroup/UploadProducts', array('controller' => 'products', 'action' => 'UploadProducts'));
	Router::connect('/JijGroup/DownloadSample', array('controller' => 'products', 'action' => 'DownloadSample'));
	/* End for upload product */
    
    Router::connect('/JijGroup/ShowCustomers', array('controller' => 'Linnworksapis', 'action' => 'ShowCustomers'));
    Router::connect('/JijGroup/Sorting', array('controller' => 'Cronjobs', 'action' => 'shortingthtml'));

	/* Start for upload product */
	Router::connect('/JijGroup/Packaging/Type/On', array('controller' => 'packagetypes', 'action' => 'addPackage'));	
	Router::connect('/JijGroup/Packaging/Type/Show', array('controller' => 'packagetypes', 'action' => 'showAllPackage'));	
	Router::connect('/JijGroup/Envelope/PackagingType/On', array('controller' => 'packagetypes', 'action' => 'addEnvelope'));		
	Router::connect('/JijGroup/Envelope/PackagingEnvelopes/Show', array('controller' => 'packagetypes', 'action' => 'showAllEnvelope'));			
	/* End for upload product */
	
	/* Start for upload product */
	Router::connect('/JijGroup/CheckIn/Stock', array('controller' => 'products', 'action' => 'checkIn'));		
	/* End for upload product */

    
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
