<?php

class Page extends Ares\Model {

	static $schema = array(
		'title' => 'varchar'
	);

	function __toString() {
		return $this->title;
	}

}