<?php

########################################################################
# Extension Manager/Repository config file for ext "webdav".
#
# Auto generated 16-06-2011 17:44
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'WebDav for filemounts',
	'description' => '',
	'category' => 'misc',
	'shy' => 0,
	'version' => '0.3.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Kay Strobach',
	'author_email' => 'info@kay-strobach.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'conflicts' => array(
			'ks_sabredav' => '0.0.0-9.9.9',
		),
		'depends' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:115:{s:9:"ChangeLog";s:4:"cacf";s:10:"README.txt";s:4:"ee2d";s:21:"ext_conf_template.txt";s:4:"e3fc";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"cb73";s:16:"webdavserver.php";s:4:"9587";s:42:"Classes/class.tx_webdav_browser_plugin.php";s:4:"3ada";s:34:"Classes/class.tx_webdav_extmgm.php";s:4:"1264";s:45:"Classes/class.tx_webdav_permission_plugin.php";s:4:"11fa";s:36:"Classes/class.tx_webdav_rootDirs.php";s:4:"c7c6";s:21:"Classes/typo3init.php";s:4:"0213";s:37:"Resources/Public/Stylesheets/main.css";s:4:"37d2";s:14:"doc/manual.sxw";s:4:"73aa";s:19:"doc/wizard_form.dat";s:4:"fffe";s:20:"doc/wizard_form.html";s:4:"28c2";s:22:"lib/sabredav/ChangeLog";s:4:"0cbe";s:20:"lib/sabredav/LICENSE";s:4:"fe15";s:26:"lib/sabredav/basicauth.php";s:4:"acf0";s:35:"lib/sabredav/lib/Sabre.autoload.php";s:4:"3943";s:35:"lib/sabredav/lib/Sabre.includes.php";s:4:"0239";s:35:"lib/sabredav/lib/Sabre/autoload.php";s:4:"0bbb";s:42:"lib/sabredav/lib/Sabre/CalDAV/Calendar.php";s:4:"4963";s:48:"lib/sabredav/lib/Sabre/CalDAV/CalendarObject.php";s:4:"ab9c";s:50:"lib/sabredav/lib/Sabre/CalDAV/CalendarRootNode.php";s:4:"74d9";s:47:"lib/sabredav/lib/Sabre/CalDAV/ICalendarUtil.php";s:4:"5f71";s:40:"lib/sabredav/lib/Sabre/CalDAV/Plugin.php";s:4:"73d7";s:40:"lib/sabredav/lib/Sabre/CalDAV/Server.php";s:4:"e33e";s:47:"lib/sabredav/lib/Sabre/CalDAV/UserCalendars.php";s:4:"4c2f";s:41:"lib/sabredav/lib/Sabre/CalDAV/Version.php";s:4:"2e25";s:41:"lib/sabredav/lib/Sabre/CalDAV/XMLUtil.php";s:4:"6028";s:50:"lib/sabredav/lib/Sabre/CalDAV/Backend/Abstract.php";s:4:"c8c0";s:45:"lib/sabredav/lib/Sabre/CalDAV/Backend/PDO.php";s:4:"84cb";s:66:"lib/sabredav/lib/Sabre/CalDAV/Exception/InvalidICalendarObject.php";s:4:"199e";s:72:"lib/sabredav/lib/Sabre/CalDAV/Property/SupportedCalendarComponentSet.php";s:4:"5a5a";s:64:"lib/sabredav/lib/Sabre/CalDAV/Property/SupportedCalendarData.php";s:4:"5fa6";s:64:"lib/sabredav/lib/Sabre/CalDAV/Property/SupportedCollationSet.php";s:4:"d6b0";s:40:"lib/sabredav/lib/Sabre/DAV/Directory.php";s:4:"b7fd";s:40:"lib/sabredav/lib/Sabre/DAV/Exception.php";s:4:"714b";s:35:"lib/sabredav/lib/Sabre/DAV/File.php";s:4:"494c";s:42:"lib/sabredav/lib/Sabre/DAV/ICollection.php";s:4:"02de";s:50:"lib/sabredav/lib/Sabre/DAV/IExtendedCollection.php";s:4:"d793";s:36:"lib/sabredav/lib/Sabre/DAV/IFile.php";s:4:"ec5f";s:40:"lib/sabredav/lib/Sabre/DAV/ILockable.php";s:4:"a06a";s:36:"lib/sabredav/lib/Sabre/DAV/INode.php";s:4:"1632";s:42:"lib/sabredav/lib/Sabre/DAV/IProperties.php";s:4:"2667";s:37:"lib/sabredav/lib/Sabre/DAV/IQuota.php";s:4:"c9bf";s:35:"lib/sabredav/lib/Sabre/DAV/Node.php";s:4:"4269";s:41:"lib/sabredav/lib/Sabre/DAV/ObjectTree.php";s:4:"6f44";s:39:"lib/sabredav/lib/Sabre/DAV/Property.php";s:4:"bb43";s:37:"lib/sabredav/lib/Sabre/DAV/Server.php";s:4:"d700";s:43:"lib/sabredav/lib/Sabre/DAV/ServerPlugin.php";s:4:"e8d5";s:46:"lib/sabredav/lib/Sabre/DAV/SimpleDirectory.php";s:4:"28e8";s:56:"lib/sabredav/lib/Sabre/DAV/TemporaryFileFilterPlugin.php";s:4:"c9e4";s:35:"lib/sabredav/lib/Sabre/DAV/Tree.php";s:4:"e618";s:38:"lib/sabredav/lib/Sabre/DAV/URLUtil.php";s:4:"6171";s:38:"lib/sabredav/lib/Sabre/DAV/Version.php";s:4:"2e28";s:38:"lib/sabredav/lib/Sabre/DAV/XMLUtil.php";s:4:"1e75";s:42:"lib/sabredav/lib/Sabre/DAV/Auth/Plugin.php";s:4:"c8a5";s:45:"lib/sabredav/lib/Sabre/DAV/Auth/Principal.php";s:4:"1bd8";s:55:"lib/sabredav/lib/Sabre/DAV/Auth/PrincipalCollection.php";s:4:"8659";s:52:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/Abstract.php";s:4:"862a";s:57:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/AbstractBasic.php";s:4:"259f";s:58:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/AbstractDigest.php";s:4:"f214";s:50:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/Apache.php";s:4:"663f";s:48:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/File.php";s:4:"0a14";s:47:"lib/sabredav/lib/Sabre/DAV/Auth/Backend/PDO.php";s:4:"061a";s:55:"lib/sabredav/lib/Sabre/DAV/Browser/GuessContentType.php";s:4:"8e42";s:55:"lib/sabredav/lib/Sabre/DAV/Browser/MapGetToPropFind.php";s:4:"d7f7";s:45:"lib/sabredav/lib/Sabre/DAV/Browser/Plugin.php";s:4:"c029";s:51:"lib/sabredav/lib/Sabre/DAV/Exception/BadRequest.php";s:4:"edc2";s:49:"lib/sabredav/lib/Sabre/DAV/Exception/Conflict.php";s:4:"7c59";s:56:"lib/sabredav/lib/Sabre/DAV/Exception/ConflictingLock.php";s:4:"23db";s:53:"lib/sabredav/lib/Sabre/DAV/Exception/FileNotFound.php";s:4:"1da2";s:50:"lib/sabredav/lib/Sabre/DAV/Exception/Forbidden.php";s:4:"de85";s:60:"lib/sabredav/lib/Sabre/DAV/Exception/InsufficientStorage.php";s:4:"2dcd";s:60:"lib/sabredav/lib/Sabre/DAV/Exception/InvalidResourceType.php";s:4:"f1a7";s:67:"lib/sabredav/lib/Sabre/DAV/Exception/LockTokenMatchesRequestUri.php";s:4:"30d6";s:47:"lib/sabredav/lib/Sabre/DAV/Exception/Locked.php";s:4:"68ad";s:57:"lib/sabredav/lib/Sabre/DAV/Exception/MethodNotAllowed.php";s:4:"633a";s:57:"lib/sabredav/lib/Sabre/DAV/Exception/NotAuthenticated.php";s:4:"1d72";s:55:"lib/sabredav/lib/Sabre/DAV/Exception/NotImplemented.php";s:4:"2d2c";s:59:"lib/sabredav/lib/Sabre/DAV/Exception/PreconditionFailed.php";s:4:"7a6b";s:61:"lib/sabredav/lib/Sabre/DAV/Exception/ReportNotImplemented.php";s:4:"9807";s:69:"lib/sabredav/lib/Sabre/DAV/Exception/RequestedRangeNotSatisfiable.php";s:4:"a66f";s:61:"lib/sabredav/lib/Sabre/DAV/Exception/UnsupportedMediaType.php";s:4:"e149";s:43:"lib/sabredav/lib/Sabre/DAV/FS/Directory.php";s:4:"c377";s:38:"lib/sabredav/lib/Sabre/DAV/FS/File.php";s:4:"a10d";s:38:"lib/sabredav/lib/Sabre/DAV/FS/Node.php";s:4:"a222";s:46:"lib/sabredav/lib/Sabre/DAV/FSExt/Directory.php";s:4:"0487";s:41:"lib/sabredav/lib/Sabre/DAV/FSExt/File.php";s:4:"f8ca";s:41:"lib/sabredav/lib/Sabre/DAV/FSExt/Node.php";s:4:"5e29";s:45:"lib/sabredav/lib/Sabre/DAV/Locks/LockInfo.php";s:4:"ba20";s:43:"lib/sabredav/lib/Sabre/DAV/Locks/Plugin.php";s:4:"4fdf";s:53:"lib/sabredav/lib/Sabre/DAV/Locks/Backend/Abstract.php";s:4:"3ba3";s:47:"lib/sabredav/lib/Sabre/DAV/Locks/Backend/FS.php";s:4:"5d52";s:48:"lib/sabredav/lib/Sabre/DAV/Locks/Backend/PDO.php";s:4:"c36a";s:43:"lib/sabredav/lib/Sabre/DAV/Mount/Plugin.php";s:4:"f683";s:55:"lib/sabredav/lib/Sabre/DAV/Property/GetLastModified.php";s:4:"5c93";s:44:"lib/sabredav/lib/Sabre/DAV/Property/Href.php";s:4:"57e4";s:45:"lib/sabredav/lib/Sabre/DAV/Property/IHref.php";s:4:"1f85";s:53:"lib/sabredav/lib/Sabre/DAV/Property/LockDiscovery.php";s:4:"5262";s:49:"lib/sabredav/lib/Sabre/DAV/Property/Principal.php";s:4:"423c";s:52:"lib/sabredav/lib/Sabre/DAV/Property/ResourceType.php";s:4:"717c";s:48:"lib/sabredav/lib/Sabre/DAV/Property/Response.php";s:4:"c4dc";s:53:"lib/sabredav/lib/Sabre/DAV/Property/SupportedLock.php";s:4:"8aa1";s:58:"lib/sabredav/lib/Sabre/DAV/Property/SupportedReportSet.php";s:4:"1ca8";s:46:"lib/sabredav/lib/Sabre/DAV/Tree/Filesystem.php";s:4:"e562";s:39:"lib/sabredav/lib/Sabre/HTTP/AWSAuth.php";s:4:"a9bf";s:44:"lib/sabredav/lib/Sabre/HTTP/AbstractAuth.php";s:4:"4e16";s:41:"lib/sabredav/lib/Sabre/HTTP/BasicAuth.php";s:4:"4950";s:42:"lib/sabredav/lib/Sabre/HTTP/DigestAuth.php";s:4:"6f37";s:39:"lib/sabredav/lib/Sabre/HTTP/Request.php";s:4:"8055";s:40:"lib/sabredav/lib/Sabre/HTTP/Response.php";s:4:"6dd2";s:36:"lib/sabredav/lib/Sabre/HTTP/Util.php";s:4:"5f79";s:39:"lib/sabredav/lib/Sabre/HTTP/Version.php";s:4:"08dd";}',
);

?>