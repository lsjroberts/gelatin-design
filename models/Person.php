<?php

class Person extends Ares\Model {

	static $schema = array(
		'name' => 'varchar',
		'email' => 'varchar'
	);

	static $relations = array(
		'Event' => self::MANY_TO_MANY,
		'Comment' => self::ONE_TO_MANY
	);

	function __toString() {
		if (trim($this->name) != '') {
			return $this->name.' ('.$this->email.')';
		} else {
			return $this->email;
		}
	}

}