<?php

class Event extends Ares\Model {

	static $schema = array(
		'title' => 'varchar'
	);

	static $relations = array(
		'Comment' => self::ONE_TO_MANY
	);

	function __toString() {
		return $this->title;
	}

}