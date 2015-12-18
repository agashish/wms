onload = function()
{
    /* Declaring default global variables */
    var binCounter = 10;
    var binCounterInitial = 0;    
};

(function($)
 {
    
    $.fn.jijAjax = function( options )
    {
        // Establish our default settings
        var settings = $.extend(
        {
            jij_url                      : null,
            jij_type                     : null,
            jij_data                     : null,
            jij_data_Type                : null,
            jij_dataSetClass_Id          : null,
            jij_selectorIdentifier       : null,
            jij_ajaxType                 : null,
            jij_customMessanger          : null
        }, options); 
        
        return this.each( function()
        {            
            //Do some stuff here
             $.ajax(
             {
                 'url' : settings.jij_url,
                 'type' : settings.jij_type,
                 'data' : settings.jij_data,                    
                 'success' : function( msgArray )
                 {
                    
                    /* Check here ajax type for nondropdown selection guess */
                    if ( settings.jij_ajaxType == null )
                    {
                        if ( msgArray == "" )
                        {
                            /* For custom messanger where we need to set balnk dropdown */
                            if ( settings.jij_customMessanger == "levelBlank" )
                            {                                
                                /* Section will empty */                                
                                $( settings.jij_selectorIdentifier + settings.jij_dataSetClass_Id ).html( "" );
                                swal("Osps data not found!" , "Please choose another option!" , "error");
                            return false;
                            }
                            
                            /* For other */
                            swal("Osps data not found!" , "Please choose another option!" , "error");
                            return false;
                        }
                         
                        /* Here data set at specific location */
                        $( settings.jij_selectorIdentifier + settings.jij_dataSetClass_Id ).html( msgArray  );
                        
                    }
                    else if ( $.trim( msgArray ) == "" )
                    {
                        swal("Osps data not found!" , "" , "Warning");
                        return false;
                    }
                    else
                    {
                        swal("Osps data not found!" , "" , "Warning");
                        return false;
                    }
                 }
             });
        });
    }
    
    /* jquery plugin for add level */
    $.fn.addLevel = function( options )
    {        
	    // Establish our default settings
        var msgString = '';
        var msgType = '';
        var settings = $.extend(
        {
            jij_url                      : null,
            jij_type                     : null,
            jij_data                     : null,
            jij_data_Type                : null,            
            jij_ajaxType                 : null,
            jij_params                   : null
        }, options); 
        
        // Establish our default settings
        return this.each( function()
        {            
            //Do some stuff here
            $.ajax(
            {
                'url' : settings.jij_url,
                'type' : settings.jij_type,
                'data' : settings.jij_data,                    
                'success' : function( msgArray )
                {
                   
                    if ( msgArray == "ok" )
                    {
                        msgString = "Level Inserted!"
                        msgType = 'success';
                    }
                    else if ( msgArray == "error" )
                    {
                        msgString = "Kindly check your input!"
                        msgType = 'error';
                    }
                    else if ( msgArray.split( '<>' )[0] == "alreadyLevel" )
                    {
                        /* Ask to admin, they want to update section quatity or not through confirm box */
                        var id = msgArray.split( '<>' )[1];
                        
                        /* Call custom function for update level corresponding level id if exists or user want. */
                        updateLevel( settings.jij_params , id );
                        return false; 
                    }
                    else if ( msgArray === "duplicate" )
                    {
                        callConfirmSweetBox( msgArray );
                        return false;
                    }
                    
                    /* Sweet popup for other types */
                    swal(msgString , "" , msgType);                    
                    return false;                    
                }
            });		   
        });
    }
    /****************************************************************/
     $.fn.addSection = function( options )
    {        
	    // Establish our default settings
        var msgString = '';
        var msgType = '';
        var settings = $.extend(
        {
            jij_url                      : null,
            jij_type                     : null,
            jij_data                     : null,
            jij_data_Type                : null,            
            jij_ajaxType                 : null
        }, options); 
        
        // Establish our default settings
        return this.each( function()
        {
			
            //Do some stuff here
            $.ajax(
            {
                'url' : settings.jij_url,
                'type' : settings.jij_type,
                'data' : settings.jij_data,                    
                'success' : function( msgArray )
                {                    
                    
        
                    if ( msgArray == "ok" )
                    {
                        msgString = "Level Inserted!"
                        msgType = 'success';
                    }
                    else if ( msgArray == "error" )
                    {
                        msgString = "Kindly check your input!"
                        msgType = 'error';
                    }
                    else if ( msgArray === "duplicate" )
                    {
                        callConfirmSweetBox( msgArray );
                        return false;
                    }
                    
                    /* Sweet popup for other types */
                    swal(msgString , "" , msgType);                    
                    return false;                    
                }
            });		   
        });
    }
    /****************************************************************/
   
    /* Delete data through ajax plugin */
        /* jquery plugin for add level */
    $.fn.deleteData = function( options )
    {        
        // Establish our default settings
        var msgString = '';
        var msgType = '';
        var settings = $.extend(
        {
            jij_url                      : null,
            jij_type                     : null,
            jij_data                     : null,
            jij_data_Type                : null,            
            jij_ajaxType                 : null
        }, options); 
        
        // Establish our default settings
        return this.each( function()
        {
            //Do some stuff here
            $.ajax(
            {
                'url' : settings.jij_url,
                'type' : settings.jij_type,
                'data' : settings.jij_data,                    
                'success' : function( msgArray )
                {
                    
                }
            });		   
        });
    }
    
}(jQuery));

function callConfirmSweetBox( msgArray )
{    
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover levels!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
    function()
    {
        /* Call another ajax for deleting level after asking to user */
        swal("Deleted!", "Levels has been deleted.", "success");                            
    });        
}

function getUrl()
{
       //Do sme stuff here
       var getUrl = window.location;
       var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
return baseUrl;       
}

function getResultStringAfterValidate( $strExtend )
{

}

/* Warning Popup */
function updateSection( argumentArray )
{
    
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this section!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, update it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            var strAction = "update";
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/section/add',
                type    : 'POST',
                data    : { warehouse_id : argumentArray.warehouse_id, warehouse_rack : argumentArray.warehouse_rack, section_label :  argumentArray.section_label, section_action : strAction, section_status : argumentArray.section_status, is_deleted : argumentArray.is_deleted, id : argumentArray.id },
                success :	function( msgArray  )
                {
                    swal("Section updated!", msgArray , "success"); 
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your section is safe :)", "error");
        }
    });
}

/* Delete Bin after ensuring from user */
function deleteBin( argumentArray )
{
    
    /* Set background values to work with deleteBin prototype */
    var getWarehouseId = argumentArray.warehouse_id;
    var getRackId = argumentArray.rack_id;
    var getSectionId = argumentArray.section_id;
    var levelIntegerText = argumentArray.level_id;    
    var setId = argumentArray.id;
    
    /* Set default update action */
    var strAction = "delete";
    argumentArray.bin_action = strAction;
    
    swal({
        title: "Confirm?",
        text: "Sure, You will not be able to recover this bins!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            
            /* Set JSon String for sending the data at specific location -->>
             <<-- Data set according to cakephp convention */
            var sendJsonData = '';
            sendJsonData = '{"warehouse_id":' + getWarehouseId;
            sendJsonData += ', "warehouse_rack":' + getRackId;
            sendJsonData += ', "warehouse_section":' + getSectionId;
            sendJsonData += ', "warehouse_level":' + levelIntegerText;              
            sendJsonData += ', "bin_action":' + '"' + strAction + '"';            
            sendJsonData += ', "id":' + '"' + setId + '"';    
            sendJsonData += '}';
            
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/bin/delete',
                type    : 'POST',
                data    : sendJsonData,
                success : function( msgArray  )
                {   
                    if( msgArray === "ok" )
                    {
                        
                        swal({
                            title: "Bins deleted!",
                            text: "",
                            timer: 1200,
                            showConfirmButton: true
                        });
                        
                        /* Remove row after getting result accordingly */                        
                        $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( argumentArray.rowId ).remove();
                        $( 'div.outer_bin_addMore .binlabel_textfeild div.addLabel' ).eq( argumentArray.rowId ).remove();    
                        
                        /* If we found is last row will rest after delete then will remve customClose icon */
                        if ( argumentArray.counterInc == 2 )
                        {                           
                            /* Remove customClose icon from row if we found last row visible */
                            $( 'a.panel-close' ).remove();
                        }
                    }
                    else if( msgArray === "error" )
                    {
                        swal( "Error", "Error found in deletion!", "error" );
                        return false
                    }
                return false;
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your bins are safe :)", "success");
        }
    });      
}

/* Warning Level updating Popup */
function updateLevel( argumentArray, id )
{
    var getParams = argumentArray.split(',');
    var getWarehouseId = parseInt(getParams[0]);
    var getRackId = parseInt(getParams[1]);
    var getSectionId = parseInt(getParams[2]);
    var levelIntegerText = parseInt(getParams[3]);
    var status = parseInt(getParams[4]);
    var is_deleted = parseInt(getParams[5]);
    var setId = parseInt(id);
        
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this levels!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, update it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            /* Set default update action */
            var strAction = "update";
            
            /* Set JSon String for sending the data at specific location -->>
             <<-- Data set according to cakephp convention */
            var sendJsonData = '';
            sendJsonData = '{"warehouse_id":' + getWarehouseId;
            sendJsonData += ', "warehouse_rack":' + getRackId;
            sendJsonData += ', "warehouse_section":' + getSectionId;
            sendJsonData += ', "warehouse_level_text":' + levelIntegerText;  
            sendJsonData += ', "level_status":' + status;
            sendJsonData += ', "level_action":' + '"' + strAction + '"';
            sendJsonData += ', "is_deleted":' + is_deleted;
            sendJsonData += ', "id":' + setId;    
            sendJsonData += '}';
            
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/level/add',
                type    : 'POST',
                data    : sendJsonData,
                success :	function( msgArray  )
                {
                    swal("Level updated!", msgArray , "success");
                    return false;
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your level is safe :)", "error");
        }
    });
}

/* Warning Level updating Popup */
function updateBin( argumentArray, id , formData )
{
                
    var getWarehouseId = argumentArray.warehouse_id;
    var getRackId = argumentArray.rack_id;
    var getSectionId = argumentArray.section_id;
    var levelIntegerText = argumentArray.level_id;    
    var setId = argumentArray.id;

    /* Set default update action */
    var strAction = "update";
            
    /* Custom serializeObject here for custom setting for confirm box */    
    var formDataNew = formData.split( '}' )[0] + ',"data[WarehouseBin][id]":' + '"' + id + '"' + ', "bin_action":' + '"' + strAction + '"' + '}';
    
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this bins!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, update it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {            
            /* Set JSon String for sending the data at specific location -->>
             <<-- Data set according to cakephp convention */
            var sendJsonData = '';
            sendJsonData = '{"warehouse_id":' + getWarehouseId;
            sendJsonData += ', "warehouse_rack":' + getRackId;
            sendJsonData += ', "warehouse_section":' + getSectionId;
            sendJsonData += ', "warehouse_level":' + levelIntegerText;              
            sendJsonData += ', "bin_action":' + '"' + strAction + '"';            
            sendJsonData += ', "id":' + '"' + setId + '"';    
            sendJsonData += '}';
            
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/addBin/add',
                type    : 'POST',
                data    : formDataNew,
                success : function( msgArray  )
                {
                    swal({
                        title: "Bins Updated",
                        text: "",
                        timer: 1200,
                        showConfirmButton: true
                    });
                return false;
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your bins are safe :)", "success");
        }
    });    
}

/* Selection process of warehouse and after chnage will get list of racks and associated with dropdown over popup*/
$( 'body' ).on( 'change', '#LevelWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/serverajaxs/getRacksBehindWarehouse',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'racks_class',
          'jij_selectorIdentifier'          : '.'
    });
      
});

/* Start here warehouse onchange dropdown for Bin form */
$( 'body' ).on( 'change', '#LevelWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/serverajaxs/getRacksBehindWarehouse',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'racks_class_bin',
          'jij_selectorIdentifier'          : '.'       
    });
      
});

/* Start here warehouse onchange dropdown */
$( 'body' ).on( 'change', '#LevelWarehouseSectionId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/serverajaxs/getRacksBehindWarehouse',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'racks_class',
          'jij_selectorIdentifier'          : '.'       
    });
      
});

/*************************Start for fetch Rack name and id ****************************/

$( 'body' ).on( 'change', '#SectionWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/list',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'rack_class_select',
          'jij_selectorIdentifier'          : '.'       
    });
      
});

/*************************End for fetch Rack name and id   ****************************/

/* Selection of rack that after will add with rack dropdown, if we get the racks list */
$( 'body' ).on( 'change', '.racks_class', function()
{
    
    /* Get selected value from warehouse dropdown */
    var getRackIdFromDropdown = $(this).val();
    var getWarehouseIdFromDropdown = $("#LevelWarehouseSectionId").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/serverajaxs/getPrepareSectionListFromCounter',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"action":' + getRackIdFromDropdown + ', "wh":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'sectionsList_class',
          'jij_selectorIdentifier'      : '.',
          'jij_customMessanger'         : 'levelBlank'
    });
      
});

/* Selection of rack that after will add with rack dropdown for bin form, if we get the racks list */
$( 'body' ).on( 'change', '.racks_class_bin', function()
{
    
    /* Get selected value from warehouse dropdown */
    var getRackIdFromDropdown = $(this).val();
    var getWarehouseIdFromDropdown = $("#LevelWarehouseId").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/serverajaxs/getPrepareSectionListFromCounter',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"action":' + getRackIdFromDropdown + ', "wh":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'sections_class',
          'jij_selectorIdentifier'      : '.'          
    });
      
});

/* Call plugin for adding level according to warehouse sections */
$( 'body' ).on( 'click', '.addLevel', function()
{    
	
    var getWarehouseId  	= 	$( '#LevelWarehouseSectionId' ).val();
    var getRackId       	= 	$( '.racks_class_level' ).val();
    var getSectionId    	= 	$( '.sectionsList_class' ).val();
    var levelIntegerText    = 	$( '.addLevelValue' ).val();
    var status          	= 	0;
    var is_deleted      	= 	0;
    
    /* Validate Level form feilds values */
    if ( getWarehouseId == "" || getRackId == "" || getSectionId == "" || ( levelIntegerText == "" || levelIntegerText == 0)  )
    {
        swal( "Oops! Error occured" ,"Kindly fill your correct values!" , "error" );
        return false;
    }
    
    /* Data set according to cakephp convention */
    var sendJsonData = '';
    sendJsonData = '{"warehouse_id":' + getWarehouseId;
    sendJsonData += ', "warehouse_rack":' + getRackId;
    sendJsonData += ', "warehouse_section":' + getSectionId;
    sendJsonData += ', "warehouse_level_text":' + levelIntegerText;  
    sendJsonData += ', "level_status":' + status;
    sendJsonData += ', "is_deleted":' + is_deleted;    
    sendJsonData += '}';
    
    var argumenyArray = getWarehouseId + ',' + getRackId + ',' + getSectionId + ',' + levelIntegerText + ',' + status + ',' + is_deleted;
    
    /* Call Plugin for selection dropdows here */ 
    $(this).addLevel(
    {
        'jij_url'     : getUrl() + '/jijGroup/server/warehouse/level/add',
        'jij_type'    : 'POST',
        'jij_data'    : sendJsonData,        
        'jij_ajaxType': 'level',
        'jij_params'  : argumenyArray
    });  
            
});

/* Call plugin for adding section according to warehouse rack */


/*************************** Start Add Section by ajax ****************************************/

$( 'body' ).on('click', '.addSection', function()
{    
	var getWarehouseId  = $( '#SectionWarehouseId' ).val();
    var getRackId       = $( '.rack_for_section' ).val();
    var getSectionVal   = $( '.addSectionValue' ).val();
    var status          = 0;
    var is_deleted      = 0;
    alert(getRackId);
    var msgString = '';
    var msgType = '';
    
    /* Sweet popup for other types */
    if ( getWarehouseId == "" )
    {
         swal("Kindly select warehouse!" , "" , "error");                    
    return false;  
    }
    
    if ( getRackId == "" )
    {
         swal("Kindly select warehouse rack!" , "" , "error");                    
    return false;  
    }
    
    if ( getSectionVal == "" )
    {
         swal("Blank section never save!" , "" , "error");                    
    return false;  
    }
    else if ( getSectionVal == 0 || getSectionVal < 0 )
    {
        swal("Kindly input no. of sections!" , "" , "warning");                            
    return false;  
    }
    
    $.ajax(
    {
	    url     : getUrl() + '/jijGroup/server/warehouse/section/add',
        type    : 'POST',
        data    : { warehouse_id : getWarehouseId, warehouse_rack : getRackId, section_label :  getSectionVal, section_status : status, is_deleted : is_deleted },
        success :	function( msgArray  )
        {
            
            if ( msgArray == "ok" )
            {
                msgString = "Section Inserted!"
                msgType = 'success';
            }
            else if ( msgArray == "error" )
            {
                msgString = "Kindly check your input!"
                msgType = 'error';
            }
            else if ( msgArray.split( '<>' )[0] == "already" )
            {
                /* Ask to admin, they want to update section quatity or not through confirm box */
                var id = msgArray.split( '<>' )[1];
                var argumenyArray = {warehouse_id : getWarehouseId, warehouse_rack : getRackId, section_label :  getSectionVal, section_status : status, is_deleted : is_deleted, id : id};                 
                updateSection( argumenyArray );
                return false; 
            }
            else if ( msgArray === "duplicate" )
            {
                callConfirmSweetBox( msgArray );
                return false;
            }
            else
            {
                swal( msgArray, "" , "warning" );
                return false;
            }
            
            /* Sweet popup for other types */
            swal(msgString , "" , msgType);                    
            return false;  
		}        
    });  
}); 
/*************************** End Add Section by ajax ****************************************/

$('.showAll').click( function(){
	
	if($('.defaultListNone').is(':hidden'))
	{
		$('.defaultListNone').show();
		$('.showAll').html('Hide');
	}
	else
	{
		$('.defaultListNone').hide();
		$('.showAll').html('Show All');
	}
	
	});
	
	
/**************************************** Start code for fetch lavel ***************************************************/



/* Selection of rack that after will add with rack dropdown, if we get the racks list */
$( 'body' ).on( 'change', '.sections_class', function()
{
    
    /* Get selected value from warehouse dropdown */
    var getSectionIdFromDropdown 		= 	$(this).val();
    var getWarehouseIdFromDropdown 	    = 	$("#LevelWarehouseId").val();
    var getRackIdFromDropdown 		    = 	$(".racks_class_bin").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/level/list',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"sectionid":' + getSectionIdFromDropdown + ', "whid":' + getWarehouseIdFromDropdown + ', "rackid":' + getRackIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'level_class_bin',
          'jij_selectorIdentifier'      : '.'
    });      
});
/**************************************** End code for fetch lavel   ***************************************************/

	
/**************************************** Start code for fetch lavel ***************************************************/
/* Selection of level that after will add with level dropdown, if we get the number */
$( 'body' ).on( 'change', '.level_class', function()
{
    
    /* Get selected value from warehouse dropdown */
    var getLevelIdFromDropdown 		= 	$(this).val();
    var getWarehouseIdFromDropdown 	= 	$("#LevelWarehouseId").val();
    var getRackIdFromDropdown 		= 	$(".racks_class").val();
    var getSectionIdFromDropdown 		= 	$(".sections_class").val();
    

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/serverajaxs/getUniqueNumber',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"sectionid":' + getSectionIdFromDropdown + ', "whid":' + getWarehouseIdFromDropdown + ', "rackid":' + getRackIdFromDropdown + ', "levelid":' + getLevelIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'binid',
          'jij_selectorIdentifier'      : '.'
    });      
});

/* Date 25 June 2015 */
/* Update Bin value default mode */
$( 'body' ).on( 'change', '.level_class_bin', function()
{    
    /* Get selected value from warehouse dropdown */
    var getLevelIdFromDropdown 		= 	$(this).val();
    var getWarehouseIdFromDropdown 	= 	$("#LevelWarehouseId").val();
    var getRackIdFromDropdown 		= 	$(".racks_class_bin").find('option:selected').text();
    var getSectionIdFromDropdown 	= 	$(".sections_class").val();
   
    /* Vaidate when user will choose blank option that will not render again and again */
    if ( getLevelIdFromDropdown === "" )
    {
        return false;
    }
    
    var argumentId = {};
    argumentId.warehouseId = getWarehouseIdFromDropdown;
    argumentId.rackId = $(".racks_class_bin").val();
    argumentId.sectionId = getSectionIdFromDropdown;
    argumentId.levelId = getLevelIdFromDropdown;
    argumentId.rackIdText = getRackIdFromDropdown;
    
    /* Start here get existing data from database if, it is present into tables */
    var customOBJ = new __JijGroupPrototyping__.__JijGroup__();    
    customOBJ.getAllBinsById( argumentId );    
            
});
/**************************************** End code for fetch lavel   ***************************************************/

/****************************************** Start for save bin *********************************************************/

$( 'body' ).on( 'click', '.addBin', function( event )
{    
    $(this).preventDefaultOption(event);
    var formData = JSON.stringify($('form.save_bin').serializeObject());
    
	var msgString = '';
    var msgType = '';
    
    /* Validate here, must be choose all feild values and these are mandatory here */
    if ( ( $( '#LevelWarehouseId' ).val() == "" ) || ( $( '.racks_class_bin' ).val() == "" ) || ( $( '.sections_class' ).val() == "" ) || ( $( '.level_class_bin' ).val() == "" ) )
    {
        swal( 'Error', 'Kindly choose all values from selection lists!', 'error' );
        return false;
    }
    
    /* Call Plugin for selection dropdows here */  
    $.ajax(
    {
        'url'                     : getUrl() + '/jijGroup/server/warehouse/addBin/add',
        'type'                    : 'POST',
        'data'                    : formData,
        'success' 				  : function( msgArray )
        {
           
            if ( msgArray == "ok" )
            {
                msgString = "Bins Inserted!"
                msgType = 'success';
                swal({
                    title: "Success",
                    text: "Bins Inserted",
                    timer: 1200,
                    showConfirmButton: true
                });
                return false;
            }
            else if ( msgArray == "error" )
            {
                msgString = "Kindly check your input!"
                msgType = 'error';
            }
            else if ( msgArray === "duplicate" )
            {
                callConfirmSweetBox( msgArray );
                return false;
            }
            else if ( msgArray.split( '<>' )[0] == "alreadyBin" )
            {
                /* Ask to admin, they want to update section quatity or not through confirm box */
                var id = msgArray.split( '<>' )[1];
                    
                /* Call custom function for update level corresponding level id if exists or user want. */
                var warehouse_id   = $("#LevelWarehouseId").val();
                var rack_id        = $(".racks_class_bin").val();
                var section_id     = $(".sections_class").val();
                var level_id       = $(".level_class_bin").val();
                
                var argumentArray = {};
                argumentArray.warehouse_id = warehouse_id;
                argumentArray.rack_id = rack_id;
                argumentArray.section_id = section_id;
                argumentArray.level_id = level_id;
                argumentArray.id = id;                
                
                updateBin( argumentArray , id , formData );
                return false; 
            }
            else if ( msgArray === "matchLabel" )
            {
                msgString = "Bin labels found duplicate, Please input different labels!";
                msgType = 'error';
                swal( "Duplicate Label warning", msgString, 'error');
                return false;
            }
            else if ( msgArray === "matchBlank" )
            {
                msgString = "Bin labels found blank, Please input!";
                msgType = 'error';
                swal( "Blank Label warning", msgString, 'error');
                return false;
            }
            
            /* Sweet popup for other types */
            swal(msgString , "" , msgType);                    
            return false;  
        }  
    });      
});
/****************************************** End for save bin ***********************************************************/

/****************** Add MOre bins added in queue maximum 10 ************************************************************/

/* Start here delete customClose icon from first row of add bins */
$( 'body' ).on( 'click', '.customClose', function( event )
{
        var descendentRowIdCounter = $( '.counterInc' ).attr( "id" ).split( '_' )[1];
        var binObject = {};        
        /* Count no. of div to be extend already */
        var counterInc_ = $.getCountThroughClass( 'addId' );
       
        /* Call custom function for update level corresponding level id if exists or user want. */
        var warehouse_id   = $("#LevelWarehouseId").val();
        var rack_id        = $(".racks_class_bin").val();
        var rackTextFromDropdown = $(".racks_class_bin option:selected").text();
        var section_id     = $(".sections_class").val();
        var level_id       = $(".level_class_bin").val();        
        
        var argumentArray = {};
        argumentArray.warehouse_id = warehouse_id;
        argumentArray.rack_id = rack_id;
        argumentArray.section_id = section_id;
        argumentArray.level_id = level_id;
        argumentArray.rowId = parseInt( $('.customClose').index(this) );
        argumentArray.counterInc = counterInc_;
        
        if ( counterInc_ > 2 )
        {            
            /* Start here to check custom classes then do operate accordignly */
            if( $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).
               eq( $('.customClose').
                  index(this) ).
               hasClass( 'addCustomId' ) )
            {
                /* If equal to 2 then we need to check id is available or not */    
                var getBinId = $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) ).attr( 'class' ).split( ' ' )[3].split('_')[1];
                argumentArray.id = getBinId;
                
                /* Start here call cakephp ajax handlers to manipulating the code blocks */
                var customOBJ = new __JijGroupPrototyping__.__JijGroup__();    
                customOBJ.deleteBinsById( argumentArray );
                
                /* Remove row bindId and binLabel after will remove customClose icon from firstRow 
                $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) ).remove();
                $( 'div.outer_bin_addMore .binlabel_textfeild div.addLabel' ).eq( $('.customClose').index(this) ).remove();    
                */
                return false;
            }
            else
            {                
                /* Remove row bindId and binLabel after will remove customClose icon from firstRow */
                $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) ).remove();
                $( 'div.outer_bin_addMore .binlabel_textfeild div.addLabel' ).eq( $('.customClose').index(this) ).remove();
                
                /* We will find customLabel class that which will come through addMore click that will represent a new row and differentiate through. */                
                var reference = $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) );                
                if ( reference.hasClass( 'customId' ) )
                {                    
                    /* Start here to setup Bin Unique Id */
                    var concatStringUniqueBinNumberFormat = 'WH'+warehouse_id + '-' + rackTextFromDropdown + '-' + 'S' + section_id + '-' + 'L' + level_id + '-' + '000';
                    var initialCounter = descendentRowIdCounter;
                    
                    $.each($('.customId'), function(index, value)
                    {
                        initialCounter = parseInt( initialCounter ) + 1;                    
                        $(this).find('input').attr( 'value' , concatStringUniqueBinNumberFormat + initialCounter );
                    });
                }                
            }
            return false;
        }
        else if ( counterInc_ == 2 )
        {
            
            if( $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).
               eq( $('.customClose').
                  index(this) ).
               hasClass( 'addCustomId' ) )
            {                
                /* If equal to 2 then we need to check id is available or not */    
                var getBinId = $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) ).attr( 'class' ).split( ' ' )[3].split('_')[1];
                argumentArray.id = getBinId;
                
                /* Step 1 Remove but open confirm bx to verify, user wants it
                to perform the same operation or not thrugh call ajax */
                
                /* Step 2 Start here call cakephp ajax handlers to manipulating the code blocks */
                
                /* Step 3 Start here code for getting all bins that will related to specific level */
                var customOBJ = new __JijGroupPrototyping__.__JijGroup__();    
                customOBJ.deleteBinsById( argumentArray );
                return false;
            }
            else
            {                
                /* Start here to check it is pre existing row or dumpo row create */                
                $( 'div.outer_bin_addMore .binid_textfeild div.addId' ).eq( $('.customClose').index(this) ).remove();
                $( 'div.outer_bin_addMore .binlabel_textfeild div.addLabel' ).eq( $('.customClose').index(this) ).remove();            
            }
        }
        return false;
});

$( 'body' ).on( 'click', '.btn_binAddMore', function( event )
{ 
    /* Default Event */
    $(this).preventDefaultOption(event)
    
    /* Count no. of div to be extend already */
    var counterInc_ = $.getCountThroughClass( 'addId' ) + 1;
    
    /*  If user find only one option to add bin and they need to add more that time will add close option to evryone. If option will rest only single that will disallow to user never clicked to close */
    if( $.getCountThroughClass( 'addId' ) == 1 )//if ( $.getCountThroughClass( 'addId' ) == 1 )
    {
        /* If we found only single option to add bin and needd to addMore that will add close icon to every one */
        $( '.binlabel_textfeild .addLabel input' ).after( '<a class="panel-close" href="#"><i class="ion-close customClose"></i></a>' );
    }
    
    if( counterInc_ > 10 )
    {
        /* Display message how many bin has been addedin queue */
        swal( "Warning", "Upto " + parseInt(counterInc_ - 1) + " can add only!.", "warning" );
    return false;
    }
    else
    {        
        /* Start here add in queue (list) of more bins */        
        $(this).addBinId();
        $(this).addBinLabel();
        
        /* Display message how many bin has been addedin queue */
        $( 'div.outer_bin_addMore div.alert_bin' ).removeClass( 'defaultListNone' ).addClass( 'defaultListBlock' ).html( counterInc_ + " bins has been addded." );
        
        /* SetTimeout calling */
        setTimeout( function(){ $( 'div.outer_bin_addMore div.alert_bin' ).removeClass( 'defaultListBlock' ).addClass( 'defaultListNone' ); },10000 );
        
        /* Get selected value from warehouse dropdown */
        var getLevelIdFromDropdown 		= 	$( ".level_class_bin" ).val();
        var getWarehouseIdFromDropdown 	= 	$("#LevelWarehouseId").val();
        var getRackIdFromDropdown 		= 	$(".racks_class_bin").val();
        var getSectionIdFromDropdown 	= 	$(".sections_class").val();
        var rackTextFromDropdown        =   $(".racks_class_bin").find('option:selected').text();
        
        /* Get and set the BinId value according to last just one previous counter value */
        var getSplit = parseInt( $( "div.addId:last" ).prev().find( 'input' ).attr( 'value' ).split( '-' )[4] );
        
        /* Start here to setup Bin Unique Id */
        var concatStringUniqueBinNumberFormat = 'WH'+getWarehouseIdFromDropdown + '-' + rackTextFromDropdown + '-' + 'S' + getSectionIdFromDropdown + '-' + 'L' + getLevelIdFromDropdown + '-' + '000' + parseInt(getSplit + 1);
        
        $( "div.addId input:last" ).attr( 'value' , concatStringUniqueBinNumberFormat);
        
        return false;
    }
});
/****************** Add MOre bins added in queue maximum 10 ************************************************************/

/* Plugin for count certain divs */
$.extend({
    getCountThroughClass: function( strClass )
    {       
       /* Through class */
       return parseInt( $( '.' + strClass ).size() );       
    }
});
/* Plugin for count certain divs */

/* Stringify serialize to json */
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function()
    {        
        if (o[this.name] !== undefined)
        {
            if (!o[this.name].push)
            {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        }
        else
        {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
/* Stringify serialize to json */

/* Default preventOption */
(function ($)
{
    $.fn.preventDefaultOption = function ( event )
    {  
        event.preventDefault();
    }
})(jQuery);

/* Plugin for add bin in list after click over addMore button */
(function ($)
{   
    $.fn.addBinId = function ( event )
    {
        var getBinIdHtml = '';
        getBinIdHtml = $.returnBinIdHtmlString().replace( 'undefined','' );
        
        /* Apply and add bin + binLabel in queue list where user will click over addMore button */
        $( "div.binid_textfeild .addId:last-child" ).after( getBinIdHtml );
        
    }
})(jQuery);


/* get here Bin text and label html thrugh plugin */
$.extend({
    returnBinIdHtmlString: function()
    {
        var binIdHtmlString = '';
        binIdHtmlString += '<div class="form-group addId customId">';
        binIdHtmlString += '<input type="text" readonly="readonly" class="form-control bin_value" name="data[WarehouseBin][warehouse_binId][]" placeholder="E.g.- Dell Laptop">';
        binIdHtmlString += '</div>';        
    return binIdHtmlString;
    }
});

/* Plugin for add bin in list after click over addMore button */
(function ($)
{   
    $.fn.addBinLabel = function ( event )
    {        
        var getBinLabelHtml = '';
        getBinLabelHtml = $.returnBinLabelHtmlString().replace( 'undefined','' );
        
        /* Apply and add bin + binLabel in queue list where user will click over addMore button */
        $( "div.binlabel_textfeild .addLabel:last-child" ).after( getBinLabelHtml );
        
    }
})(jQuery);

/* get here Bin text and label html thrugh plugin */
$.extend({
    returnBinLabelHtmlString: function()
    {
        /*var binLabelHmlString;
        binLabelHmlString += '<div class="form-group addLabel">';
        binLabelHmlString += '<div class="row"><div class="col-lg-10 "><input type="text" class="form-control bin_value" name="data[WarehouseBin][warehouse_binLabel][]" placeholder="E.g.- Dell Laptop"></div>';
        binLabelHmlString += '<div class="col-lg-2"><a class="panel-close" href="#"><i class="ion-close customClose"></i></a></div></div>';
        binLabelHmlString += '</div>';*/
        var binLabelHmlString;
        binLabelHmlString += '<div class="form-group addLabel">';
        binLabelHmlString += '<input type="text" class="form-control bin_value" name="data[WarehouseBin][warehouse_binLabel][]" placeholder="E.g.- Dell Laptop">';
        binLabelHmlString += '<div class="col-lg-2"><a class="panel-close" href="#"><i class="ion-close customClose"></i></a>';
        binLabelHmlString += '</div>';
    return binLabelHmlString;
    }
});

/* Custom JijGroup function booting */
__JijGroupPrototyping__ = {
    getJijGroup_abc: function(x,y)
    {   
        //Do your code here
    },
    __JijGroup__: function(){}    
}
__JijGroupPrototyping__.getJijGroup_abc( 2,2 );

/* Function prototyping for inheritenceship */

/* Its image roller function , it will show and hide image roller properly */
__JijGroupPrototyping__.__JijGroup__.prototype.imageRoler = function( argumentId )
{
    /* Need a class which we need to show and hide */
    
}
                
/* When user will select level value then it will fetch existing bins list if it have */
__JijGroupPrototyping__.__JijGroup__.prototype.deleteBinsById = function( argumentId )
{
    
    /* Need an object to calling prototyping*/
    var needObj = new __JijGroupPrototyping__.__JijGroup__();
    //alert(argumentId.warehouse_id);
    /* Set class fow that class will show and hide */
    var argumentClass = '';
    
    /* Start here to create json encoded form to pass through post method */
    var sendJsonData = '';
    sendJsonData = '{"warehouse_id":' + argumentId.warehouse_id;
    sendJsonData += ', "warehouse_rack":' + argumentId.rack_id;
    sendJsonData += ', "warehouse_section":' + argumentId.section_id;
    sendJsonData += ', "warehouse_level":' + argumentId.level_id;
    sendJsonData += ', "id":' + argumentId.id;  
    sendJsonData += '}';
    
    var result = '';
    
    /* Start here code for getting all bins that will related to specific level */        
    $.ajax(
    {
        'url'                     : getUrl() + '/jijGroup/server/warehouse/bin/delete',
        'type'                    : 'POST',
        'data'                    : sendJsonData,
        //'beforeSend'              : needObj.imageRoler(),  
        'success' 				  : function( msgArray )
        {
            /* set the result into global variable and call this function */            
            if ( msgArray === "already" )
            {
                /* If we found exist bin row then will open confirm box to ensure, what type of operation he wants? */                
                swal({
                    title: "Are you sure?",
                    text: "Do you want to delete bins....!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Please confirm!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    /* isConfirm tell us true or false */
                    if (isConfirm)
                    {            
                        deleteBin( argumentId );
                        return false
                    }
                    else
                    {
                        swal("Cancelled", "Your bins are safe :)", "success");
                        return false
                    }
                });                
            }
        }  
    });    
};
/* When user will select level value then it will fetch existing bins list if it have */
__JijGroupPrototyping__.__JijGroup__.prototype.getAllBinsById = function( argumentId )
{
    
    /* Need an object to calling prototyping*/
    var needObj = new __JijGroupPrototyping__.__JijGroup__();
    
    /* Set class fow that class will show and hide */
    var argumentClass = '';
    
    /* Start here to create json encoded form to pass through post method */
    var sendJsonData = '';
    sendJsonData = '{"warehouse_id":' + argumentId.warehouseId;
    sendJsonData += ', "warehouse_rack":' + argumentId.rackId;
    sendJsonData += ', "warehouse_rack_text":' + '"'+argumentId.rackIdText+'"';
    sendJsonData += ', "warehouse_section":' + argumentId.sectionId;
    sendJsonData += ', "warehouse_level":' + argumentId.levelId;  
    sendJsonData += '}';
    
    /* Start here code for getting all bins that will related to specific level */        
    $.ajax(
    {
        'url'                     : getUrl() + '/jijGroup/server/warehouse/bin/list',
        'type'                    : 'POST',
        'data'                    : sendJsonData,
        //'beforeSend'              : needObj.imageRoler(),  
        'success' 				  : function( msgArray )
        {            
            if ( msgArray != '' )
            {
                /* Render html at specific under dom element */
                $( "div.outer_bin_addMore" ).html( msgArray );
            }
            else
            {
                /* When user will get no data then need to display:none behind the popup */
                $( "div.outer_bin_addMore" ).html('');
                swal({
                    title: "Error",
                    text: "Oops, Sorry no [bins] found!",
                    timer: 1500,
                    showConfirmButton: true
                });
                return false;            
            }
        }  
    });    
};

/* Date 25 June 2015 */





/********************************** start script for show , edit , delete level *********************************************/



	$( 'body' ).on( 'click', '.showAll_level', function()
	{
		$('#addSectionpanel').hide();
		$('#levelList').show();
		
		$(this).jijAjax(
			{
				  'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getLevel',
				  'jij_type'                    : 'POST',
				  'jij_data'                    : '{"warehouseID": "" }',
				  'jij_dataSetClass_Id'         : 'level_data',
				  'jij_selectorIdentifier'      : '.'
			});
	});
	
	
	$( 'body' ).on( 'click', '.addLevelcontent', function()
	{
		$('#addSectionpanel').show();
		$('#levelList').hide();
	});
	
	
	$( 'body' ).on('change', '#getLevelByWarehouseId', function()
	{    
		 var getWearehouseId = $(this).val();
    /* Call Plugin for selection dropdows here */ 
    
    $(this).jijAjax(
			{
				  'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getLevel',
				  'jij_type'                    : 'POST',
				  'jij_data'                    : '{"warehouseID": '+ getWearehouseId + '}',
				  'jij_dataSetClass_Id'         : 'level_data',
				  'jij_selectorIdentifier'      : '.'
			});
	});
	
	function delete_level(id)
	{
		swal({
        title: "Are you sure?",
        text: "You want to delete level !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
			},
		function(isConfirm)
			{
		
				/* isConfirm tell us true or false */
				if (isConfirm)
					{
						/* Set default update action */
						var retrieve	=	"";
            
						/* Set JSon String for sending the data at specific location -->>
						<<-- Data set according to cakephp convention */
						$.ajax(
								{
									url     : getUrl() + '/jijGroup/server/warehouse/level_delete',
									type    : 'POST',
									data    : {levelId : id ,retrieve : retrieve},
									success :	function( msgArray  )
										{
											$('.level_no_'+id).remove();
											$('.update_button_'+id).remove();
											$('.delete_botton_'+id).remove();
											swal("Level Deleted", "" , "success");
											return false;
										}                
								});           
					}
				else
					{
						swal("Cancelled", "Your level is safe :)", "error");
					}
			});
	} 
	
	
	function update_level(id)
	{
		$('.level_no_'+id).hide();
		$('.update_button_'+id).hide();
		
		$('.lavel_value_'+id).show();
		$('.ok_value_'+id).show();
		$('.cancel_value_'+id).show();
	}
	function cancel_update_level(id)
	{
		$('.level_no_'+id).show();
		$('.update_button_'+id).show();
		
		$('.lavel_value_'+id).hide();
		$('.ok_value_'+id).hide();
		$('.cancel_value_'+id).hide();
		
	}
	function updatelevel_value(id)
	{
		var sectionValue	=	$('.lavel_value_'+id).val();
		$.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/level_update',
                type    : 'POST',
                data    : {sectionId : id ,sectionValue : sectionValue},
                success :	function( msgArray  )
                {
					$('.level_no_'+id).show();
					$('.update_button_'+id).show();
					
					$('.lavel_value_'+id).hide();
					$('.ok_value_'+id).hide();
					$('.cancel_value_'+id).hide();
					
					$('.level_no_'+id).text(sectionValue);
					
                    swal("Level update", msgArray , "success");
                    return false;
                }                
            });           
   	
	}
	
	


/************************************ end script for show , edit , delete level *********************************************/


/************************************ Start script for show , edit , delete Section *****************************************/



	$( 'body' ).on('change', '#getSectionByWarehouseId', function()
	{    
		 var getWearehouseId = $(this).val();
    
 
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getSection',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"warehouseID":' + getWearehouseId + '}',
          'jij_dataSetClass_Id'         : 'panel_body_table',
          'jij_selectorIdentifier'      : '.'
    });
	}); 
	
	
	$( 'body' ).on( 'change', '#CityCityId', function()
	{
   
		/* Get selected value from city dropdown */
		
		var getCityId = $(this).val();
    
 
		/* Call Plugin for selection dropdows here */  
		$(this).jijAjax(
		{
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getWarehouse',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"city_id":' + getCityId + '}',
          'jij_dataSetClass_Id'         : 'get_warehouse',
          'jij_selectorIdentifier'      : '.'
		});
      
	});

	$( 'body' ).on( 'click', '.showAllSection', function()
	{
		$('.addSectionpanel').hide();
		$('#showlistpanel').show();
		var getWearehouseId = '';
		
		$(this).jijAjax(
		{
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/section/getSection',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"warehouseID":' + getWearehouseId + '}',
          'jij_dataSetClass_Id'         : 'panel_body_table',
          'jij_selectorIdentifier'      : '.'
		});
	});
	
	$( 'body' ).on( 'click', '.addSectioncontent', function()
	{
		$('.addSectionpanel').show();
		$('#showlistpanel').hide();
	});

	function edit_section(id, wID, rID)
	{
		
		$(this).jijAjax(
		{
			'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/list',
			'jij_type'                        : 'POST',
			'jij_data'                        : '{"action":' + wID + '}',
			'jij_dataSetClass_Id'             : 'rack_class_select',
			'jij_selectorIdentifier'          : '.'       
		});
						
		
		$('.section_count_'+id).hide();
		$('.editSection_'+id).hide();
		$('.section_delete_'+id).hide();
		
		$('.edit_section_count_'+id).show();
		$('.section_update_'+id).show();
		$('.section_cancel_'+id).show();
		
		
		$('select[name^="select_warehouse"] option[value='+wID+']').attr("selected","selected");		
		setTimeout( function(){ $('.edit_rack_name_'+id).val( rID ).attr( 'selected', '' ); }, 1000 );
		
		
			
	}
		
	function cancel_edit(id)
	{

		$('.section_count_'+id).show();
		$('.editSection_'+id).show();
		$('.section_delete_'+id).show();
		$('.edit_section_count_'+id).hide();

		$('.section_update_'+id).hide();
		$('.section_cancel_'+id).hide();
	}
	
$( 'body' ).on( 'change', '#warehouseWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/list',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'rack_class_select',
          'jij_selectorIdentifier'          : '.'       
    });
      
});


function edit_section_update(id)
{
    /* Get selected value */
	var warehouseId		=	$('.display_warehouse_'+id).val();
	var rackId			=	$('.edit_rack_name_'+id).val();
	var sectionVal		=	$('.edit_section_count_'+id).val();
	var result = '';
		if ( warehouseId == "" )
		{
         swal("Kindly select warehouse!" , "" , "error");                    
		return false;  
		}
		
		if ( rackId == "" )
		{
         swal("Kindly select warehouse rack!" , "" , "error");                    
		 return false;  
		}
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/jijGroup/server/warehouse/section_update',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"sectionId":' + id + ',"warehouseId": '+warehouseId+', "rackid" : '+rackId+', "sectionval" :'+sectionVal+'}'                    
    });
    
}

function delete_section(id)
{
	
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this sections!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            /* Set default update action */
            var strAction = "update";
            
            /* Set JSon String for sending the data at specific location -->>
             <<-- Data set according to cakephp convention */
            var sendJsonData = '';
            sendJsonData = '{"sectionId":' + id;
            sendJsonData += '}';
            
            /* Start here updating section */
            $.ajax(
            {
                url     : getUrl() + '/jijGroup/server/warehouse/section_delete',
                type    : 'POST',
                data    : sendJsonData,
                success :	function( msgArray  )
                {
                    swal("Section deleted", msgArray , "success");
                    return false;
                }                
            });            
        }
        else
        {
            swal("Cancelled", "Your section is safe :)", "error");
        }
    });
	
}


/************************************ end script for show , edit , delete Section *******************************************/

/************************************ start script for show , edit , delete Bin *******************************************/


$( 'body' ).on( 'change', '#BinWarehouseId', function()
{    
    /* Get selected value from warehouse dropdown */
    var getWarehouseIdFromDropdown = $(this).val();

    /* Check value whether will greater than 0 else 0 */
    if ( getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;
        
    }
    else
    {
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                         : getUrl() + '/serverajaxs/getRacksBehindWarehouse',
          'jij_type'                        : 'POST',
          'jij_data'                        : '{"action":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'             : 'racks_class_bin_list',
          'jij_selectorIdentifier'          : '.'
    });
      
});


/* Selection of rack that after will add with rack dropdown for bin form, if we get the racks list */
$( 'body' ).on( 'change', '.racks_class_bin_list', function()
{
		
    /* Get selected value from warehouse dropdown */
    var getRackIdFromDropdown = $(this).val();
    var getWarehouseIdFromDropdown = $("#BinWarehouseId").val();
    
    

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/serverajaxs/getPrepareSectionListFromCounter',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"action":' + getRackIdFromDropdown + ', "wh":' + getWarehouseIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'sections_class_list',
          'jij_selectorIdentifier'      : '.'          
    });
      
});

$( 'body' ).on( 'change', '.sections_class_list', function()
{
    
    /* Get selected value from rack dropdown */
    var getSectionIdFromDropdown 		= 	$(this).val();
    var getWarehouseIdFromDropdown 	    = 	$("#BinWarehouseId").val();
    var getRackIdFromDropdown 		    = 	$(".racks_class_bin_list").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
    $(this).jijAjax(
    {
          'jij_url'                     : getUrl() + '/jijGroup/server/warehouse/level/list',
          'jij_type'                    : 'POST',
          'jij_data'                    : '{"sectionid":' + getSectionIdFromDropdown + ', "whid":' + getWarehouseIdFromDropdown + ', "rackid":' + getRackIdFromDropdown + '}',
          'jij_dataSetClass_Id'         : 'level_class_bin_list',
          'jij_selectorIdentifier'      : '.'
    });
      
});

$( 'body' ).on( 'change', '.level_class_bin_list', function()
{
    
    /* Get selected value from level dropdown */
    var getLevelIdFromDropdown 			= 	$(this).val();
    var getWarehouseIdFromDropdown 	    = 	$("#BinWarehouseId").val();
    var getRackIdFromDropdown 		    = 	$(".racks_class_bin_list").val();
    var getSectionIdFromDropdown 		= 	$(".sections_class_list").val();

    /* Check value whether will greater than 0 else 0 */
    if ( getRackIdFromDropdown > 0 && getWarehouseIdFromDropdown > 0 )
    {
        //If gt from 0 then send with original value
        getRackIdFromDropdown = getRackIdFromDropdown;
        getWarehouseIdFromDropdown = getWarehouseIdFromDropdown;                
    }
    else
    {
        getRackIdFromDropdown = 0;
        getWarehouseIdFromDropdown = 0;
    }
    
    /* Call Plugin for selection dropdows here */  
		$.ajax({
                url     	: getUrl() + '/jijGroup/server/warehouse/getbin',
                type    	: 'POST',
                data    	: { warehouseID : getWarehouseIdFromDropdown,  
								sectionID : getSectionIdFromDropdown, 
								rackID : getRackIdFromDropdown, 
								levelID : getLevelIdFromDropdown },
                success 	:	function( data  )
                {
					$('.bin_data').html(data);
			    }                
            });
	});
	
	/* show the edit test box field and other content */
	function edit_bin(id)
		{
			$('.editBin_'+id).hide();
			$('.display_bin_value_'+id).hide();
			
			$('.bin_update_'+id).show();
			$('.bin_cancel_'+id).show();
			$('.bin_value_'+id).show();
			$('.dis_bin_value_'+id).show();
		}
	
	/* hide the edit test box field and other content */
	function cancel_edit_bin( id )
		{
			$('.editBin_'+id).show();
			$('.display_bin_value_'+id).show();
			
			$('.bin_update_'+id).hide();
			$('.bin_cancel_'+id).hide();
			$('.bin_value_'+id).hide();
			$('.dis_bin_value_'+id).hide();
		}
		
	function edit_bin_update( id )
		{
			/* get the text value for selected bin */
			var getLebel	=	$('.bin_value_'+id).val();
		 
			/* ajax use update the selected bin */
			$.ajax(
				{
					url     	: getUrl() + '/jijGroup/server/warehouse/editbin',
					type    	: 'POST',
					data    	: { binID : id, binlabel : getLebel },
					success 	:	function( data  )
						{
							swal("Bin update successfully !" , "" , "error");
							$('.editBin_'+id).show();
							$('.display_bin_value_'+id).show(); 
							$('.display_bin_value_'+id).text(getLebel); 
							$('.bin_update_'+id).hide();
							$('.bin_cancel_'+id).hide();
							$('.bin_value_'+id).hide();
							$('.dis_bin_value_'+id).hide();                   
							return false; 
						}                
            });
		}
		
	function delete_bin( id )
	{
		swal({
        title: "Are you sure?",
        text: "You want to delete bin !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
			},
			function(isConfirm)
				{
		
				/* isConfirm tell us true or false */
				if (isConfirm)
					{
						$.ajax(
								{
									url     : getUrl() + '/jijGroup/server/warehouse/bin_delete',
									type    : 'POST',
									data    : { binId : id },
									success :	function( msgArray  )
										{
											$('.whole_row_'+id).remove();
											swal("Bin Deleted", "" , "success");
											return false;
										}                
								});           
						}
				else
					{
						swal("Cancelled", "Your bin is safe :)", "error");
					}
				});
	}


/************************************ end script for show , edit , delete Bin *******************************************/

/* Start Warehouse Scripting below */
var Counter = 1;
$(document).ready(function()
{
	
	if($("#WarehouseDescWarehouseType").val() == 2)
		{ 
			$('.rack_block').hide(); 
			$('#btnAdd').hide(); 
			$('.rackdetail').hide(); 
			
			//Main class replacing
			$( "form#warehouse div.warehouseDetails" ).removeClass( "col-lg-6" ).addClass( "col-lg-12" );
			
			//Child class replacing
			$( "form#warehouse div.warehouseDetails div.row div.col-lg-12:first-child" )
			.removeClass( "col-lg-12" ).addClass( "col-lg-8 col-lg-offset-2" );
		}
	
	$( "#WarehouseDescWarehouseType" ).change(function()
	{
		if($(this).val() == 1)
		{ 
	
			/* Start here set up  for rack block appearance */
			//step 1: main class : col-lg-6 -> class
 			//step 2: col-lg-12 -> city
			
			//Main class replacing
			$( "form#warehouse div.warehouseDetails" ).removeClass( "col-lg-12" ).addClass( "col-lg-6" );
			
			//Child class replacing
			$( "form#warehouse div.warehouseDetails div.row div.col-lg-8:first-child" )
			.removeClass( "col-lg-8 col-lg-offset-2" ).addClass( "col-lg-12" );
			
			$('.rack_block').show(); 
			$('#btnAdd').show(); 
			$('.rackdetail').show(); 
		}
		else
		{ 
			$('.rack_block').hide(); 
			$('#btnAdd').hide(); 
			$('.rackdetail').hide(); 
			
			//Main class replacing
			$( "form#warehouse div.warehouseDetails" ).removeClass( "col-lg-6" ).addClass( "col-lg-12" );
			
			//Child class replacing
			$( "form#warehouse div.warehouseDetails div.row div.col-lg-12:first-child" )
			.removeClass( "col-lg-12" ).addClass( "col-lg-8 col-lg-offset-2" );
		}
	});
			
	$( ".add_fieldset" ).click(function()
	{			
		var rackHtml = $(".rackContainer").html();			
		var counter = $('div.rackContainer:visible').length;
		var str = counter+1;
		var count =0;		
		rackHtml = rackHtml.replace(' 1', str);	
		rackHtml = rackHtml.replace('btn-success', 'btn-info');	
		rackHtml = rackHtml.replace('<span class="btn-label"><i class="glyphicon glyphicon-remove">', '<span class="btn-label remove"><i class="glyphicon glyphicon-minus">');
		$(".rack_block").append( '<div class="rackContainer">' + rackHtml + '</div>' );
		$( ".rack_block .rackContainer .label-rounded" ).each(function()
		{
			var content = $(this).text();
			count = count+1;
			content.replace($(this).text(),$(this).text(count));
		});			
	});
		
	$("body").on("click", ".remove", function ()
	{
		var count =0;
		$(this).closest(".rackContainer").remove();
		$( ".rack_block .rackContainer .label-rounded" ).each(function()
		{
			var content = $(this).text();
			count = count+1;
			content.replace($(this).text(),$(this).text(count));
		});	
	});				
})
/* End Warehouse Scripting below */
