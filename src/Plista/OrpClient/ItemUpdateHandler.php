<?php

namespace Plista\OrpClient;

use Silex\Application;

class ItemUpdateHandler implements Handler {

	public function handle(array $body, Application $app) {
		$fileName = __DIR__ . '/../../item_update-' . date('Ymd') . '.log';
		file_put_contents($fileName, json_encode($body) . PHP_EOL, FILE_APPEND);
	}
}
