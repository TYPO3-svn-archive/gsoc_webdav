<?php

class tx_webdav_extmgm {
	function emMakeHeader() {
		include_once t3lib_extMgm::extPath('webdav').'lib/sabredav/lib/Sabre.autoload.php';
		return '<b>'.Sabre_DAV_Version::VERSION.'</b>'.' ('.Sabre_DAV_Version::STABILITY.')';
	}
}