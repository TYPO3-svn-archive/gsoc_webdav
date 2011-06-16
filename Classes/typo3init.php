<?php
/***************************************************************
*  Copyright notice
*
*  (c) 1999-2007 Kasper Skaarhoj (kasperYYYY@typo3.com)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


// *******************************
// Set error reporting
// *******************************
error_reporting (E_ALL ^ E_NOTICE);


// ******************
// Constants defined
// ******************
$TYPO3_MISC['microtime_start'] = microtime();
define('TYPO3_OS', stristr(PHP_OS,'win')&&!stristr(PHP_OS,'darwin')?'WIN':'');
define('TYPO3_MODE','FE');

if (!defined('PATH_thisScript')) 	define('PATH_thisScript',str_replace('//','/', str_replace('\\','/', (php_sapi_name()=='cgi'||php_sapi_name()=='isapi' ||php_sapi_name()=='cgi-fcgi')&&($_SERVER['ORIG_PATH_TRANSLATED']?$_SERVER['ORIG_PATH_TRANSLATED']:$_SERVER['PATH_TRANSLATED'])? ($_SERVER['ORIG_PATH_TRANSLATED']?$_SERVER['ORIG_PATH_TRANSLATED']:$_SERVER['PATH_TRANSLATED']):($_SERVER['ORIG_SCRIPT_FILENAME']?$_SERVER['ORIG_SCRIPT_FILENAME']:$_SERVER['SCRIPT_FILENAME']))));
if (!defined('PATH_site')) 			define('PATH_site', dirname(dirname(dirname(dirname(PATH_thisScript)))).'/');
if (!defined('PATH_t3lib')) 		define('PATH_t3lib', PATH_site.'t3lib/');

define('TYPO3_mainDir', 'typo3/');		// This is the directory of the backend administration for the sites of this TYPO3 installation.
define('PATH_typo3', PATH_site.TYPO3_mainDir);
define('PATH_typo3conf', PATH_site.'typo3conf/');

if (!defined('PATH_tslib')) {
	if (@is_dir(PATH_site.TYPO3_mainDir.'sysext/cms/tslib/')) {
		define('PATH_tslib', PATH_site.TYPO3_mainDir.'sysext/cms/tslib/');
	} elseif (@is_dir(PATH_site.'tslib/')) {
		define('PATH_tslib', PATH_site.'tslib/');
	}
}

if (!@is_dir(PATH_typo3conf))	die('Cannot find configuration. This file is probably executed from the wrong location.');

// *********************
// Timetracking started
// *********************
require_once(PATH_t3lib.'class.t3lib_timetrack.php');
$TT = new t3lib_timeTrack;
$TT->start();
$TT->push('','Script start');


// *********************
// Mandatory libraries included
// *********************
$TT->push('Include class t3lib_db, t3lib_div, t3lib_extmgm','');
	require_once(PATH_t3lib.'class.t3lib_div.php');
	require_once(PATH_t3lib.'class.t3lib_extmgm.php');
$TT->pull();



// **********************
// Include configuration
// **********************
$TT->push('Include config files','');
require(PATH_t3lib.'config_default.php');
if (!defined ('TYPO3_db')) 	die ('The configuration file was not included.');	// the name of the TYPO3 database is stored in this constant. Here the inclusion of the config-file is verified by checking if this var is set.
if (!t3lib_extMgm::isLoaded('cms'))	die('<strong>Error:</strong> The main frontend extension "cms" was not loaded. Enable it in the extension manager in the backend.');

if (!defined('PATH_tslib')) {
	define('PATH_tslib', t3lib_extMgm::extPath('cms').'tslib/');
}

require_once(PATH_t3lib.'class.t3lib_db.php');
$TYPO3_DB = t3lib_div::makeInstance('t3lib_DB');
$TYPO3_DB->debugOutput = $TYPO3_CONF_VARS['SYS']['sqlDebug'];

$CLIENT = t3lib_div::clientInfo();				// Set to the browser: net / msie if 4+ browsers
$TT->pull();


// *******************************
// Checking environment
// *******************************
if (t3lib_div::int_from_ver(phpversion())<4003000)	die ('TYPO3 requires PHP 4.3.0 or higher.');

if (isset($_POST['GLOBALS']) || isset($_GET['GLOBALS']))	die('You cannot set the GLOBALS-array from outside the script.');
if (!get_magic_quotes_gpc())	{
	$TT->push('Add slashes to GET/POST arrays','');
	t3lib_div::addSlashesOnArray($_GET);
	t3lib_div::addSlashesOnArray($_POST);
	$HTTP_GET_VARS = $_GET;
	$HTTP_POST_VARS = $_POST;
	$TT->pull();
}


// *********************
// Look for extension ID which will launch alternative output engine
// *********************
if ($temp_extId = t3lib_div::_GP('eID'))	{
	if ($classPath = t3lib_div::getFileAbsFileName($TYPO3_CONF_VARS['FE']['eID_include'][$temp_extId]))	{
		require_once(PATH_tslib.'class.tslib_eidtools.php');
		require($classPath);
	}
	exit;
}