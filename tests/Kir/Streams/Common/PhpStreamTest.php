<?php
namespace Kir\Streams\Common;

use Kir\Streams\Tests\Helper\ClosureStreamFactory;
use Kir\Streams\Tests\ResourceStreamTest AS StreamTest;

class PhpStreamTest extends StreamTest {
	public function setUp() {
		parent::setFactory(new ClosureStreamFactory(function () {
			return new PhpStream('php://memory', 'r+', true);
		}));
	}
}
 