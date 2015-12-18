<?php

class AuthMethods 
{ public static function GetDebugInformation($key,$password)
{
 return json_decode(Factory::GetResponse("Auth/GetDebugInformation", "key=" . $key . "&password=" . $password . "", "", "")); 
}

public static function MultiLogin($userName,$password)
{
 return json_decode(Factory::GetResponse("Auth/MultiLogin", "userName=" . $userName . "&password=" . $password . "", "", "")); 
}

public static function Authorize($userName,$password,$userId)
{
 return json_decode(Factory::GetResponse("Auth/Authorize", "userName=" . $userName . "&password=" . $password . "&userId=" . $userId . "", "", "")); 
}

public static function RequestPasswordReset($userName)
{
 Factory::GetResponse("Auth/RequestPasswordReset", "userName=" . $userName . "", "", ""); 
}

public static function ResetPassword($UserName,$ResetToken,$NewPassword,$ConfirmNewPassword)
{
 Factory::GetResponse("Auth/ResetPassword", "UserName=" . $UserName . "&ResetToken=" . $ResetToken . "&NewPassword=" . $NewPassword . "&ConfirmNewPassword=" . $ConfirmNewPassword . "", "", ""); 
}

public static function ApplicationAuthorization($token,$application,$applicationSecret)
{
 return json_decode(Factory::GetResponse("Auth/ApplicationAuthorization", "token=" . $token . "&application=" . $application . "&applicationSecret=" . $applicationSecret . "", "", "")); 
}

public static function GetServerUTCTime()
{
 return json_decode(Factory::GetResponse("Auth/GetServerUTCTime", "", "", "")); 
} 
}
?>
