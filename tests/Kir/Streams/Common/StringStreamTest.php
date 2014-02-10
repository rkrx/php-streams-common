<?php
namespace Kir\Streams\Common;

use Kir\Streams\Tests\Helper\ClosureStreamFactory;
use Kir\Streams\Tests\ResourceStreamTest;

class StringStreamTest extends ResourceStreamTest {
	public function setUp() {
		parent::setFactory(new ClosureStreamFactory(function () {
			return new StringStream();
		}));
	}
}
 