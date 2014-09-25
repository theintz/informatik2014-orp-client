<?php

namespace Plista\OrpClient;

/**
 * This class handles errors which might be thrown by the Controller.
 *
 * @package Plista\OrpClient
 */
class ErrorHandler {

	public function handle(\Exception $e) {
		// we want to log the exception
		$logFileName = __DIR__ . '/../../errors-' . date('Ymd') . '.log';
		$excText = date('Y-m-d H:i:s') . ' ' . $e->getMessage() . PHP_EOL;

		if ($e instanceof Exception) {
			$excText .= 'current message type: ' . $e->getType() . PHP_EOL .
				'current context: ' . $e->getContextAsString() . PHP_EOL;
		}

		$excText .= $e->getTraceAsString() . PHP_EOL . PHP_EOL;

		file_put_contents($logFileName, $excText, FILE_APPEND);

		// but still return a valid response
		return Response::getEmptyResponse();
	}
}