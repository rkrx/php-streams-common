php-streams-common
==================

Basic stream implementations for PHP 5.3+

Basic example:

```PHP
use Kir\Streams\InputStream;
use Kir\Streams\Common\PhpStream;

function test(InputStream $stream) {
	echo $stream->read();
}

$stream = new PhpStream('php://memory', 'r+', true);
$stream->write('This is a test')->rewind();
test($stream);
```


Versioning
----------

www.semver.org


Composer
--------

`composer require rkr/php-streams-common dev-master`

