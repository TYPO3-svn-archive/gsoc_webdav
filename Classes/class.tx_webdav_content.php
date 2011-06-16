<?php

class tx_webdav_content extends Sabre_DAV_File {

	private $uid, $title, $type, $content, $lastMod = 0;
	private $load = false;

	function __construct( $uid ) {
		$this->uid = $uid;
		
	}
	static function newFromRow( $row ) {
		$item = new tx_webdav_content( $row['uid'] );
		$item->loadFromRow( $row );
		return $item;
	}
	private function loadFromRow( $row ) {
		// fixme, php uses weird comparisions.
		$this->load = true;
		$this->title = $row['header'] ? $row['header'] : 'uid-' . $this->uid;
		$this->content = $row['bodytext'];
		$this->type = $row['CType'];
		$this->lastMod = $row['tstamp'];
	}

	private function load () {
		if ($this->load) return;
		throw new Exception("not implemented");
	}

	/**
	 * Meant to be called by tx_webdav_pages in order to find
	 * the tt_content records for a specific page
	 *
	 * @param $pid Int page id.
	 * @return Mysql query result
	 */
	static function getContentForParent($pid, $title=null) {
		$fields = 'uid, header, bodytext, CType, colPos, tstamp';
		$where = 'pid=' . intval( $pid ) . ' ' .
			t3lib_BEfunc::deleteClause('tt_content');

		if ( $title !== null ) {
			$where .= ' AND ' . self::getWhereForTitle( $title );
		}

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			$fields,
			'tt_content',
			$where
		);
		return $res;
	}
	/**
	 * Given a node title, get a where clause to find it in db
	 * @todo: Hacky!
	 */
	static function getWhereForTitle( $title ) {
		if ( substr( $title, 0, 4 ) === 'uid-' ) {
			$id = substr( $title, 4 );
			if ( is_numeric( $id ) ) {
				return  'uid=' . intval( $id );
			}
		}

		return 'header="' . $GLOBALS['TYPO3_DB']->quoteStr( $title, 'tt_content' ) . '"';
	}

	function get() {
		$this->load();
		return $this->content;
	}

	function getContentType() {
		$this->load();
		switch ( $this->type ) {
			case "text":
				return 'text/plain;charset=UTF-8';
			case "html":
				return 'text/html;charset=UTF-8';
			default:
				return 'application/octet-stream';

		}
	}
	function getLastModified() {
		return $this->lastMod;
	}
	function getSize() {
		$this->load();
		return strlen( $this->content );
	}
	function getName() {
		return  $this->title;
	}

}
