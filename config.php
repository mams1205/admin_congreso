<?php

/* $Id:       config.php  2017-11-14 $*/
/* Author:    FSC                    $*/
/* $Revision: 2017-1.0               $*/

$DefaultLanguage ='en_GB.utf8';
$TimeDif         = 21600;
$allow_demo_mode = True;

$host      = 'localhost';
$mysqlport = 3306;
$dbType    = 'mysqli';

//cambiar usuario y password db
$dbuser     = 'u890351539_somemma';
$dbpassword = 'S0m3mm4#';

//solo se cambia la company
$AllowCompanySelectionBox = true;
$DefaultCompany           = 'somemma';
$SessionLifeTime          = 7200;
$MaximumExecutionTime     = 120;
$CryptFunction            = "sha1"; 
$DefaultClock             = 12;

$rootpath = dirname($_SERVER['PHP_SELF']);
if (isset($DirectoryLevelsDeep)) {
	for ($i=0;$i<$DirectoryLevelsDeep;$i++) {
		$rootpath = substr($rootpath,0,strrpos($rootpath,'/'));
	}
}
if ($rootpath == "/" OR $rootpath == "\\") $rootpath = "";

error_reporting (E_ALL && ~E_NOTICE);
?> 