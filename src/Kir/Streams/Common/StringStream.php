<?php
namespace Kir\Streams\Common;

class StringStream extends MemoryStream {
	/**
	 * @param string $data
	 */
	public function __construct($data = '') {
		parent::__construct();
		parent::write($data);
		parent::rewind();
	}
}