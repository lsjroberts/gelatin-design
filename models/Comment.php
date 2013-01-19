<?php

class Comment extends Ares\Model {

	static $schema = array(
		'comment' => 'text'
	);

	function __toString() {
		if (trim($this->name) != '') {
			return $this->name.' ('.$this->email.')';
		} else {
			return $this->email;
		}
	}

}