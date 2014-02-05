<?php
namespace Kir\Streams\Common;

class StringStreamTest extends VersatileStreamTest {
	public function setUp() {
		parent::setUp();
		$this->setFactory(new ClosureStreamFactory(function () {
			return new StringStream();
		}));
	}
}
 