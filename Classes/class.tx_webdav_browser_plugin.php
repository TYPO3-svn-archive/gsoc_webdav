<?php

class tx_webdav_browser_plugin extends Sabre_DAV_Browser_Plugin {
	/**
     * Generates the html directory index for a given url
     *
     * @param string $path
     * @return string
     */
    public function generateDirectoryIndex($path) {
        global $extRoot,$typo3root;
		#$extRoot   = dirname($this->server->getBaseUri());
		#$typo3root = $extRoot.'/../../../typo3/';
		$html = '
			<html>
				<head>
					<title>Index for ' . $this->escapeHTML($path) . '/ - SabreDAV ' . Sabre_DAV_Version::VERSION . '</title>
					<link media="screen" href="'.$extRoot.'../Resources/Public/Stylesheets/main.css" type="text/css" rel="stylesheet">
				</head>
				<body class="typo3-file-list-php">
					<div id="typo3-top-container">
						<div id="typo3-logo">
							<a onclick="this.blur();" target="_blank" href="http://www.typo3.com/"><img alt="" title="TYPO3 Content Management Framework" src="'.$typo3root.'gfx/typo3logo_mini.png"></a>
							<a href="http://code.google.com/p/sabredav/">Generated with SabreDAV ' . Sabre_DAV_Version::VERSION .'-'. Sabre_DAV_Version::STABILITY . ' </a>
						</div>
					</div>
					<div id="typo3-inner-docbody">
						<h4 class="uppercase">Index for ' . $this->escapeHTML($path) . '/</h4>
						<table id="typo3-filelist">
							<colgroup>
								<col width="2">
								<col width="*">
								<col width="*">
								<col width="*">
								<col width="*">
							</colgroup>
							<tr class="c-headLine"><td class="col-icon"><a href="'.$this->server->getBaseUri().'/'.dirname($this->escapeHTML($path)).'"><img width="16" height="16" alt="" title="Eine Ebene höher gehen" src="'.$typo3root.'sysext/t3skin/icons/gfx/i/folder_up.gif"></a></td><td>Name</td><td>Type</td><td>Size</td><td>Last modified</td></tr>
							';
		$files = $this->server->getPropertiesForPath($path,array(
			'{DAV:}resourcetype',
			'{DAV:}getcontenttype',
			'{DAV:}getcontentlength',
			'{DAV:}getlastmodified',
		),1);
		$k=0;
		foreach($files as $k=>$file) {
			$k++;
			// This is the current directory, we can skip it
			if (rtrim($file['href'],'/')==$path) {
				continue;
			}
			$name = $this->escapeHTML(basename($file['href']));
			$type = null;
			if (isset($file[200]['{DAV:}resourcetype'])) {
				$type = $file[200]['{DAV:}resourcetype']->getValue();
				// resourcetype can have multiple values
				if (is_array($type)) {
					$type = implode(', ', $type);
				}
				// Some name mapping is preferred
				switch($type) {
					case '{DAV:}collection' :
						$type = 'Collection';
					break;
				}
			}
			// If no resourcetype was found, we attempt to use
			// the contenttype property
			if (!$type && isset($file[200]['{DAV:}getcontenttype'])) {
				$type = $file[200]['{DAV:}getcontenttype'];
			}
			if (!$type) $type = 'Unknown';
			$type = $this->escapeHTML($type);
			$size = isset($file[200]['{DAV:}getcontentlength'])?(int)$file[200]['{DAV:}getcontentlength']:'';
			$lastmodified = isset($file[200]['{DAV:}getlastmodified'])?$file[200]['{DAV:}getlastmodified']->getTime()->format('d.m.Y H:i:s'):'';
			$fullPath = '/' . trim($this->server->getBaseUri() . ($path?$this->escapeHTML($path) . '/':'') . $name,'/');
			if($k%2==1) {
				$class = 'bgColor4';
			} else {
				$class = 'bgColor6';
			}
			if($type=='Collection') {
				$icon = $typo3root.'sysext/t3skin/icons/gfx/i/_icon_webfolders.gif';
			} else {
				$icon = $typo3root.'gfx/fileicons/default.gif';
			}
			$html.= "<tr class='".$class."''>
					<td><img src='".$icon."' alt='Icon'></td>
					<td><a href=\"{$fullPath}\">{$name}</a></td>
					<td>{$type}</td>
					<td>{$size}</td>
					<td>{$lastmodified}</td>
				</tr>";
    	}
    	$html.= "</table>";
		if ($this->enablePost) {
			$html.= '
				<div style="width:360px; float:left;">
					<form method="post" action="">
						<input type="hidden" name="action" value="mkcol" />
						<table width="350" cellspacing="1" cellpadding="0" border="0" id="typo3-clipboard">
							<colgroup>
								<col width="10">
								<col width="130">
								<col width="*">
							</colgroup>
							<tbody><tr class="bgColor2">
								<td nowrap="nowrap" align="center" colspan="3"><span class="uppercase"><strong>Create new folder</strong></span></td>
							</tr>
							<tr class="bgColor5">
								<td>&nbsp;</td>
								<td class="typo3-dimmed">
									Name
								</td>
								<td>
									<input type="text" name="name" />
								</td>
							</tr>
							<tr class="bgColor5">
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>
									<input type="submit" value="create" />
								</td>
							</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div style="width:360px; float:left;">
					<form method="post" action="" enctype="multipart/form-data">
						<input type="hidden" name="action" value="put" />
						<table width="350" cellspacing="1" cellpadding="0" border="0" id="typo3-clipboard">
							<colgroup>
								<col width="10">
								<col width="130">
								<col width="*">
							</colgroup>
							<tbody><tr class="bgColor2">
								<td nowrap="nowrap" align="center" colspan="3"><span class="uppercase"><strong>Upload File</strong></span></td>
							</tr>
							<tr class="bgColor5">
								<td>&nbsp;</td>
								<td class="typo3-dimmed">
									Name (optional)
								</td>
								<td>
									<input type="text" name="name" />
								</td>
							</tr>
							<tr class="bgColor5">
								<td>&nbsp;</td>
								<td class="typo3-dimmed">
									File
								</td>
								<td>
									<input type="file" name="file" />
								</td>
							</tr>
							<tr class="bgColor5">
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>
									<input type="submit" value="upload" />
								</td>
							</tr>
							</tbody>
						</table>
					</form>
				</div>
			';
			
		}
		$html.= "</body>
			</html>";
		return $html;
    }
}