<?php

class tx_webdav_pages extends Sabre_DAV_Directory {

	private $uid, $title;

	function __construct( $uid, $row = null ) {
		$this->uid = $uid;

		if ( $row === null ) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'title, tstamp',
				'pages',
				'uid='.intval($this->uid) . ' ' .
					t3lib_BEfunc::deleteClause('pages')
			);
			$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
			if ( !row ) throw new Sabre_DAV_Exception_FileNotFound("Could not find page with uid '$uid'.");
		}
		$this->title = $row['title'];
		$this->lastMod = $row['tstamp']; // should it be SYS_LASTCHANGE ??
	}

	function getChildren() {
		$children = array();
		$res = $this->getChildrenQuery();
		while(($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))) {
			$children[] = new tx_webdav_pages( $row['uid'], $row );
		}
		$resContent = tx_webdav_content::getContentForParent( $this->uid );
		while(($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resContent))) {
			$children[] = tx_webdav_content::newFromRow( $row );
		}
		return $children;
	}

	private function getChildrenQuery( $forTitle = null ) {
		// fixme, what if empty
		//$title = $GLOBALS['TCA']['pages']['ctrl']['label'];
		$title = 'title';
		$where = 'pid='.intval($this->uid) . ' ' .
			t3lib_BEfunc::deleteClause('pages');

		if ( !is_null( $forTitle ) ) {
			$where .= ' AND ' . $title . '="' .
				$GLOBALS['TYPO3_DB']->quoteStr( $forTitle, 'pages' ) . '"';
		}
		// fixme $GLOBALS['BE_USER']->getPagesPermsClause
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'uid,' . $title . ' AS title, tstamp',
			'pages',
			$where
		);
		return $res;
	}
	function getChild( $title ) {
		// What if there are two records with same title...
		$res = $this->getChildrenQuery( $title );
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);

		if ( $row ) return new tx_webdav_pages( $row['uid'], $row );

		// try for tt_content.

		$res = tx_webdav_content::getContentForParent( $this->uid, $title );
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		if ( $row ) return tx_webdav_content::newFromRow( $row );

		if ( !row ) throw new Sabre_DAV_Exception_FileNotFound("Could not find file '$title'.");
	}

	function childExists( $title ) {
		$res = $this->getChildrenQuery( $title );
		if ( $GLOBALS['TYPO3_DB']->sql_num_rows( $res ) !== 0 ) {
			return true;
		}
		$res = tx_webdav_content::getContentForParent( $this->uid, $title );
		if ( $GLOBALS['TYPO3_DB']->sql_num_rows( $res ) !== 0 ) {
			return true;
		}
		return false;
	}

	function getName() {
		return  $this->title;
	}

	function getLastModified() {
		return $this->lastMod;
	}

}
