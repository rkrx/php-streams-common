<?php
namespace Kir\Streams\Common;

class MemoryStream extends PhpStream {
	/**
	 */
	public function __construct() {
		parent::__construct('php://memory', 'r+', true);
	}
}