<?php
namespace Kir\Streams\Common;

class StringStream extends ResourceStream {
	/**
	 * @param string $data
	 */
	public function __construct($data = '') {
		$res = fopen('php://memory', 'r+');
		fwrite($res, $data);
		rewind($res);
		parent::__construct($res);
	}
}