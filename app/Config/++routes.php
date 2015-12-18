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
