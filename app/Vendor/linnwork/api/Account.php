<?php
class AccountMethods 
{ public static function Account_GenerateAnywhereToken($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("Account/Account_GenerateAnywhereToken", "", $ApiToken, $ApiServer)); 
}

public static function AccountDetails_Country_List($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("Account/AccountDetails_Country_List", "", $ApiToken, $ApiServer)); 
}

public static function AccountDetails_Vatin_GetCountryVatInfo($country,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("Account/AccountDetails_Vatin_GetCountryVatInfo", "country=" . $country . "", $ApiToken, $ApiServer)); 
}

public static function AccountDetails_GetAccountDetails($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("Account/AccountDetails_GetAccountDetails", "", $ApiToken, $ApiServer)); 
} 
}
?>