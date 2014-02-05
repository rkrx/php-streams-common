<?php
namespace Kir\Streams\Common;

use Kir\Streams\Helper\ClosureStreamFactory;
use Kir\Streams\VersatileStreamTest;

class PhpStreamTest extends VersatileStreamTest {
	public function setUp() {
		parent::setUp();
		$this->setFactory(new ClosureStreamFactory(function () {
			$stream = new PhpStream('php://memory', 'r+');
			return $stream->open();
		}));
	}
}
 