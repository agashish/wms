<?php
class ImportExportMethods 
{ public static function GetSFTPFolderContent($server,$port,$userName,$password,$compression,$path,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetSFTPFolderContent", "server=" . $server . "&port=" . $port . "&userName=" . $userName . "&password=" . $password . "&compression=" . $compression . "&path=" . $path . "", $ApiToken, $ApiServer)); 
}

public static function CreateFTPFolder($server,$port,$ssl,$userName,$password,$passiveMode,$path,$folderName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CreateFTPFolder", "server=" . $server . "&port=" . $port . "&ssl=" . $ssl . "&userName=" . $userName . "&password=" . $password . "&passiveMode=" . $passiveMode . "&path=" . $path . "&folderName=" . $folderName . "", $ApiToken, $ApiServer)); 
}

public static function DeleteFTPFile($server,$port,$ssl,$userName,$password,$passiveMode,$path,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/DeleteFTPFile", "server=" . $server . "&port=" . $port . "&ssl=" . $ssl . "&userName=" . $userName . "&password=" . $password . "&passiveMode=" . $passiveMode . "&path=" . $path . "", $ApiToken, $ApiServer)); 
}

public static function RenameFTPFolder($server,$port,$ssl,$userName,$password,$passiveMode,$path,$newfolderName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/RenameFTPFolder", "server=" . $server . "&port=" . $port . "&ssl=" . $ssl . "&userName=" . $userName . "&password=" . $password . "&passiveMode=" . $passiveMode . "&path=" . $path . "&newfolderName=" . $newfolderName . "", $ApiToken, $ApiServer)); 
}

public static function GetColumnsFromFile($URL,$delimiter,$hasHeaders,$escape,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromFile", "URL=" . $URL . "&delimiter=" . json_encode($delimiter) . "&hasHeaders=" . $hasHeaders . "&escape=" . json_encode($escape) . "", $ApiToken, $ApiServer)); 
}

public static function CheckFile($URL,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckFile", "URL=" . $URL . "", $ApiToken, $ApiServer)); 
}

public static function GetImportTypes($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportTypes", "", $ApiToken, $ApiServer)); 
}

public static function SaveImport($importConfig,$feedType,$feedJSON,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/SaveImport", "importConfig=" . json_encode($importConfig) . "&feedType=" . $feedType . "&feedJSON=" . $feedJSON . "", $ApiToken, $ApiServer)); 
}

public static function AreImportsEnabled($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/AreImportsEnabled", "", $ApiToken, $ApiServer)); 
}

public static function IsImportEnabled($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/IsImportEnabled", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function EnableImports($enable,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/EnableImports", "enable=" . $enable . "", $ApiToken, $ApiServer); 
}

public static function EnableImport($importId,$enable,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/EnableImport", "importId=" . $importId . "&enable=" . $enable . "", $ApiToken, $ApiServer)); 
}

public static function RunNowImport($importId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/RunNowImport", "importId=" . $importId . "", $ApiToken, $ApiServer); 
}

public static function GetImport($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImport", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function GetImportIdByName($friendlyName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportIdByName", "friendlyName=" . $friendlyName . "", $ApiToken, $ApiServer)); 
}

public static function DeleteImport($id,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DeleteImport", "id=" . $id . "", $ApiToken, $ApiServer); 
}

public static function GetExecutingOrQueuedImports($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExecutingOrQueuedImports", "", $ApiToken, $ApiServer)); 
}

public static function GetImportSessionErrors($sessionId,$pageNumber,$entriesPerPage,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportSessionErrors", "sessionId=" . $sessionId . "&pageNumber=" . $pageNumber . "&entriesPerPage=" . $entriesPerPage . "", $ApiToken, $ApiServer)); 
}

public static function GetImportSessions($importId,$pageNumber,$entriesPerPage,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportSessions", "importId=" . $importId . "&pageNumber=" . $pageNumber . "&entriesPerPage=" . $entriesPerPage . "", $ApiToken, $ApiServer)); 
}

public static function GetImports($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImports", "", $ApiToken, $ApiServer)); 
}

public static function GetImportRegister($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportRegister", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function DownloadImportedFile($fileId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DownloadImportedFile", "fileId=" . $fileId . "", $ApiToken, $ApiServer); 
}

public static function GetImportListOfValues($importType,$columnName,$additionalFieldName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetImportListOfValues", "importType=" . json_encode($importType) . "&columnName=" . $columnName . "&additionalFieldName=" . $additionalFieldName . "", $ApiToken, $ApiServer)); 
}

public static function GetFullfilmentCenterSettings($fkStockLocationId,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetFullfilmentCenterSettings", "fkStockLocationId=" . $fkStockLocationId . "", $ApiToken, $ApiServer)); 
}

public static function SaveOrdersExportId($fkStockLocationId,$fkOrdersExportId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/SaveOrdersExportId", "fkStockLocationId=" . $fkStockLocationId . "&fkOrdersExportId=" . $fkOrdersExportId . "", $ApiToken, $ApiServer); 
}

public static function SaveOrdersImportId($fkStockLocationId,$fkOrdersImportId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/SaveOrdersImportId", "fkStockLocationId=" . $fkStockLocationId . "&fkOrdersImportId=" . $fkOrdersImportId . "", $ApiToken, $ApiServer); 
}

public static function SaveInventoryImportId($fkStockLocationId,$fkInventoryImportId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/SaveInventoryImportId", "fkStockLocationId=" . $fkStockLocationId . "&fkInventoryImportId=" . $fkInventoryImportId . "", $ApiToken, $ApiServer); 
}

public static function DeleteOrdersExportId($fkStockLocationId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DeleteOrdersExportId", "fkStockLocationId=" . $fkStockLocationId . "", $ApiToken, $ApiServer); 
}

public static function DeleteOrdersImportId($fkStockLocationId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DeleteOrdersImportId", "fkStockLocationId=" . $fkStockLocationId . "", $ApiToken, $ApiServer); 
}

public static function DeleteInventoryImportId($fkStockLocationId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DeleteInventoryImportId", "fkStockLocationId=" . $fkStockLocationId . "", $ApiToken, $ApiServer); 
}

public static function GetFulfilmentCenterNameByOrdersExportId($fkOrdersExportId,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetFulfilmentCenterNameByOrdersExportId", "fkOrdersExportId=" . $fkOrdersExportId . "", $ApiToken, $ApiServer)); 
}

public static function GetFulfilmentCenterNameByOrdersImportId($fkOrdersImportId,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetFulfilmentCenterNameByOrdersImportId", "fkOrdersImportId=" . $fkOrdersImportId . "", $ApiToken, $ApiServer)); 
}

public static function GetFulfilmentCenterNameByInventoryImportId($fkInventoryImportId,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetFulfilmentCenterNameByInventoryImportId", "fkInventoryImportId=" . $fkInventoryImportId . "", $ApiToken, $ApiServer)); 
}

public static function GetExportIdByName($friendlyName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportIdByName", "friendlyName=" . $friendlyName . "", $ApiToken, $ApiServer)); 
}

public static function GetExportTypes($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportTypes", "", $ApiToken, $ApiServer)); 
}

public static function GetExportSubQuerySelectionFieldValues($exportType,$subQueryName,$selectionFieldName,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportSubQuerySelectionFieldValues", "exportType=" . json_encode($exportType) . "&subQueryName=" . $subQueryName . "&selectionFieldName=" . $selectionFieldName . "", $ApiToken, $ApiServer)); 
}

public static function SaveExport($exportConfig,$feedType,$feedJSON,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/SaveExport", "exportConfig=" . json_encode($exportConfig) . "&feedType=" . $feedType . "&feedJSON=" . $feedJSON . "", $ApiToken, $ApiServer)); 
}

public static function AreExportsEnabled($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/AreExportsEnabled", "", $ApiToken, $ApiServer)); 
}

public static function IsExportEnabled($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/IsExportEnabled", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function EnableExports($enable,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/EnableExports", "enable=" . $enable . "", $ApiToken, $ApiServer); 
}

public static function EnableExport($exportId,$enable,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/EnableExport", "exportId=" . $exportId . "&enable=" . $enable . "", $ApiToken, $ApiServer)); 
}

public static function RunNowExport($exportId,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/RunNowExport", "exportId=" . $exportId . "", $ApiToken, $ApiServer); 
}

public static function GetExport($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExport", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function DeleteExport($id,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/DeleteExport", "id=" . $id . "", $ApiToken, $ApiServer); 
}

public static function GetExecutingOrQueuedExports($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExecutingOrQueuedExports", "", $ApiToken, $ApiServer)); 
}

public static function GetExportSessionErrors($sessionId,$pageNumber,$entriesPerPage,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportSessionErrors", "sessionId=" . $sessionId . "&pageNumber=" . $pageNumber . "&entriesPerPage=" . $entriesPerPage . "", $ApiToken, $ApiServer)); 
}

public static function GetExportSessions($exportId,$pageNumber,$entriesPerPage,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportSessions", "exportId=" . $exportId . "&pageNumber=" . $pageNumber . "&entriesPerPage=" . $entriesPerPage . "", $ApiToken, $ApiServer)); 
}

public static function GetExports($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExports", "", $ApiToken, $ApiServer)); 
}

public static function GetExportRegister($id,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetExportRegister", "id=" . $id . "", $ApiToken, $ApiServer)); 
}

public static function GetSQLColumns($sqlQuery,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetSQLColumns", "sqlQuery=" . $sqlQuery . "", $ApiToken, $ApiServer)); 
}

public static function GetDropboxAccounts($ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetDropboxAccounts", "", $ApiToken, $ApiServer)); 
}

public static function SetDropboxAccounts($accounts,$ApiToken, $ApiServer)
{
 Factory::GetResponse("ImportExport/SetDropboxAccounts", "accounts=" . json_encode($accounts) . "", $ApiToken, $ApiServer); 
}

public static function GetColumnsFromUploadedFile($fileId,$delimiter,$comment,$hasHeaders,$escape,$quote,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromUploadedFile", "fileId=" . $fileId . "&delimiter=" . $delimiter . "&comment=" . $comment . "&hasHeaders=" . $hasHeaders . "&escape=" . $escape . "&quote=" . $quote . "", $ApiToken, $ApiServer)); 
}

public static function CheckHTTPFile($URL,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckHTTPFile", "URL=" . $URL . "", $ApiToken, $ApiServer)); 
}

public static function EvalExpression($expression,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/EvalExpression", "expression=" . $expression . "", $ApiToken, $ApiServer)); 
}

public static function GetColumnsFromDropboxFile($token,$filePath,$fileName,$delimiter,$comment,$hasHeaders,$escape,$quote,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromDropboxFile", "token=" . $token . "&filePath=" . $filePath . "&fileName=" . $fileName . "&delimiter=" . $delimiter . "&comment=" . $comment . "&hasHeaders=" . $hasHeaders . "&escape=" . $escape . "&quote=" . $quote . "", $ApiToken, $ApiServer)); 
}

public static function GetColumnsFromHTTPFile($URL,$delimiter,$comment,$hasHeaders,$escape,$quote,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromHTTPFile", "URL=" . $URL . "&delimiter=" . $delimiter . "&comment=" . $comment . "&hasHeaders=" . $hasHeaders . "&escape=" . $escape . "&quote=" . $quote . "", $ApiToken, $ApiServer)); 
}

public static function CheckFTPFile($server,$port,$filePath,$fileName,$SSL,$passiveMode,$protocol,$userName,$password,$postDownload,$ftpMoveToFolder,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckFTPFile", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&fileName=" . $fileName . "&SSL=" . $SSL . "&passiveMode=" . $passiveMode . "&protocol=" . json_encode($protocol) . "&userName=" . $userName . "&password=" . $password . "&postDownload=" . json_encode($postDownload) . "&ftpMoveToFolder=" . $ftpMoveToFolder . "", $ApiToken, $ApiServer)); 
}

public static function CheckSFTPFile($server,$port,$filePath,$fileName,$compression,$userName,$password,$postDownload,$ftpMoveToFolder,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckSFTPFile", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&fileName=" . $fileName . "&compression=" . $compression . "&userName=" . $userName . "&password=" . $password . "&postDownload=" . json_encode($postDownload) . "&ftpMoveToFolder=" . $ftpMoveToFolder . "", $ApiToken, $ApiServer)); 
}

public static function GetColumnsFromFTPFile($server,$port,$filePath,$fileName,$SSL,$passiveMode,$protocol,$userName,$password,$delimiter,$hasHeaders,$escape,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromFTPFile", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&fileName=" . $fileName . "&SSL=" . $SSL . "&passiveMode=" . $passiveMode . "&protocol=" . json_encode($protocol) . "&userName=" . $userName . "&password=" . $password . "&delimiter=" . $delimiter . "&hasHeaders=" . $hasHeaders . "&escape=" . $escape . "", $ApiToken, $ApiServer)); 
}

public static function GetColumnsFromSFTPFile($server,$port,$filePath,$fileName,$compression,$userName,$password,$delimiter,$comment,$hasHeaders,$escape,$quote,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetColumnsFromSFTPFile", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&fileName=" . $fileName . "&compression=" . $compression . "&userName=" . $userName . "&password=" . $password . "&delimiter=" . $delimiter . "&comment=" . $comment . "&hasHeaders=" . $hasHeaders . "&escape=" . $escape . "&quote=" . $quote . "", $ApiToken, $ApiServer)); 
}

public static function CheckFTPConnection($server,$port,$filePath,$SSL,$passiveMode,$protocol,$userName,$password,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckFTPConnection", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&SSL=" . $SSL . "&passiveMode=" . $passiveMode . "&protocol=" . json_encode($protocol) . "&userName=" . $userName . "&password=" . $password . "", $ApiToken, $ApiServer)); 
}

public static function CheckSFTPConnection($server,$port,$filePath,$compression,$userName,$password,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/CheckSFTPConnection", "server=" . $server . "&port=" . $port . "&filePath=" . $filePath . "&compression=" . $compression . "&userName=" . $userName . "&password=" . $password . "", $ApiToken, $ApiServer)); 
}

public static function GetFTPFolderContent($server,$port,$ssl,$userName,$password,$passiveMode,$path,$ApiToken, $ApiServer)
{
 return json_decode(Factory::GetResponse("ImportExport/GetFTPFolderContent", "server=" . $server . "&port=" . $port . "&ssl=" . $ssl . "&userName=" . $userName . "&password=" . $password . "&passiveMode=" . $passiveMode . "&path=" . $path . "", $ApiToken, $ApiServer)); 
} 
}
?>