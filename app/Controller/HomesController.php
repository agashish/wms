<?php

class HomesController extends AppController
{
    
    var $name = "Homes";
    
    var $helpers = array('Html','Form');
    
    public function index()
    {
        
        /* Start here set custom title and breadcrumbs */
        $this->set( "title","Welcome to WMS administration" );
        $this->layout = "index";
    }
    
}

?>
