<?php

namespace Plista\OrpClient;

class Exception extends \Exception {

	private $type = 'unknown';
	private $context = [];

	public function __construct($msg, array $body = []) {
		parent::__construct($msg);

		if (isset($body['type'])) {
			// TODO: get message type from somewhere else
		}

		if (isset($body['context']) && isset($body['context']['simple'])) {
			$this->context = $body['context'];
		}
	}

	public function getType() {
		return $this->type;
	}

	public function getContextAsString() {
		if (empty($this->context)) {
			return "";
		}

		return 'publisher: ' . $this->context['simple']['27'];
	}
}
