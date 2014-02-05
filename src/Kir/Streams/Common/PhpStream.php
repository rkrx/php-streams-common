<?php
namespace Kir\Streams\Common;

use Kir\Streams\Common\Exceptions\IOException;
use Kir\Streams\OpenableStream;
use Kir\Streams\SerializableStream;

class PhpStream extends ResourceStream implements OpenableStream, SerializableStream {
	/**
	 * @var string
	 */
	private $filename = null;

	/**
	 * @var string
	 */
	private $accessMode = null;

	/**
	 * @var bool
	 */
	private $opened = false;

	/**
	 * @var bool
	 */
	private $seekable = false;

	/**
	 * @param string $filename
	 * @param string $accessMode
	 * @param bool $openNow
	 */
	public function __construct($filename, $accessMode, $openNow=false) {
		$this->filename = $filename;
		$this->accessMode = $accessMode;
		if($openNow) {
			$this->open();
		}
	}

	/**
	 * @throws \Kir\Streams\Common\Exceptions\IOException
	 * @return $this
	 */
	public function open() {
		try {
			$res = fopen($this->filename, $this->accessMode);
			$this->setResource($res);
			$this->opened = true;
			$this->seekable = $this->isSeekable();
		} catch (IOException $e) {
			try {
				$this->close();
			} catch(\Exception $e) {
			}
			throw $e;
		}
		return $this;
	}

	/**
	 * @throws \Kir\Streams\Common\Exceptions\IOException
	 * @return $this
	 */
	public function close() {
		$this->opened = false;
		return parent::close();
	}

	/**
	 * @return string
	 */
	public function serialize() {
		$result = json_encode(array(
			'filename' => $this->filename,
			'mode' => $this->accessMode,
			'opened' => $this->opened,
			'position' => $this->getPosition()
		));
		return $result;
	}

	/**
	 * @param string $serialized
	 * @return void
	 */
	public function unserialize($serialized) {
		$data = json_decode($serialized, true);
		$this->filename = $data['filename'];
		$this->accessMode = $data['mode'];

		if($data['opened']) {
			$this->open();

			if($this->isSeekable()) {
				$this->setPosition($data['position']);
			}
		}
	}
}