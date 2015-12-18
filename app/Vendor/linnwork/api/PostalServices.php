<?php
class PostalServicesMethods 
{ public static function GetPostalServices($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("PostalServices/GetPostalServices", "", $ApiToken, $ApiServer)); 
}

public static function CreatePostalService($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("PostalServices/CreatePostalService", "", $ApiToken, $ApiServer)); 
}

public static function UpdatePostalService($ApiToken, $ApiServer)
{
 Factory::GetResponse("PostalServices/UpdatePostalService", "", $ApiToken, $ApiServer); 
}

public static function DeletePostalService($ApiToken, $ApiServer)
{
 Factory::GetResponse("PostalServices/DeletePostalService", "", $ApiToken, $ApiServer); 
} 
}
?>