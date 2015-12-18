<?php
class ExternalApplicationsMethods 
{ public static function RevokeToken($token,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ExternalApplications/RevokeToken", "token=" . $token . "", $ApiToken, $ApiServer); 
}

public static function GetTokens($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ExternalApplications/GetTokens", "", $ApiToken, $ApiServer)); 
} 
}
?>