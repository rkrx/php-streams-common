<?php
namespace Kir\Streams\Common;

use Kir\Streams\Helper\ClosureStreamFactory;
use Kir\Streams\VersatileStreamTest;

class StringStreamTest extends VersatileStreamTest {
	public function setUp() {
		parent::setUp();
		$this->setFactory(new ClosureStreamFactory(function () {
			return new StringStream();
		}));
	}
}
 