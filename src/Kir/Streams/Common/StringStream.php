<?php
namespace Kir\Streams\Common;

use Kir\Streams\VersatileStream;

class StringStream implements VersatileStream {
	/**
	 * @var string
	 */
	private $data = '';

	/**
	 * @var int
	 */
	private $pos = 0;

	/**
	 * @var string
	 */
	private $charset = null;

	/**
	 * @param string $data
	 * @param string $charset
	 */
	public function __construct($data = '', $charset = 'ISO-8859-1') {
		$this->data = $data;
		$this->charset = $charset;
	}

	/**
	 * @return $this
	 */
	public function open() {
		return $this;
	}

	/**
	 * @return $this
	 */
	public function close() {
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEof() {
		return $this->pos >= $this->getSize();
	}

	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null) {
		if($length === null) {
			$part = substr($this->data, $this->pos);
		} else {
			$part = substr($this->data, $this->pos, $length);
		}
		$partLength = strlen($part);
		$this->setPosition($this->pos + $partLength);
		return $part;
	}

	/**
	 * @param string $data
	 * @return $this
	 */
	public function write($data) {
		$partLength = strlen($data);
		$endPart = substr($this->data, $this->pos + $partLength);
		$startPart = substr($this->data, 0, $this->pos);
		$this->data = $startPart . $data . $endPart;
		$this->setPosition($this->pos + $partLength);
		return $this;
	}

	/**
	 * @param int $pos
	 * @return $this
	 */
	public function setPosition($pos) {
		$pos = min($this->getSize(), $pos);
		$pos = max(0, $pos);
		$this->pos = $pos;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPosition() {
		return $this->pos;
	}

	/**
	 * @return $this
	 */
	public function rewind() {
		$this->pos = 0;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getSize() {
		return strlen($this->data);
	}

	/**
	 * @param int $size
	 * @return $this
	 */
	public function truncate($size = 0) {
		$this->data = str_repeat(' ', $size);
		$this->pos = 0;
		return $this;
	}
}