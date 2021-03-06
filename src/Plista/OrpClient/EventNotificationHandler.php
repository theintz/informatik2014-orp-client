<?php

namespace Plista\OrpClient;

use Silex\Application;

class EventNotificationHandler implements Handler {

	public function handle(array $body, Application $app) {
		$fileName = __DIR__ . '/../../../logs/event_notification-' . date('Ymd') . '.log';
		file_put_contents($fileName, json_encode($body) . PHP_EOL, FILE_APPEND);

		return Response::getEmptyResponse();
	}
}
