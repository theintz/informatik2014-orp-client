<?php

namespace Plista\OrpClient;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class takes care of routing the messages to appropriate handlers.
 *
 * @package Plista\OrpClient
 */
class AppController {

	private static $validMsgTypes = ['recommendation_request', 'item_update', 'event_notification', 'error_notification'];

	public function post(Request $request, Application $app) {
		// unpack the body
		$type = $request->get('type');
		$body = $request->get('body');

		if (empty($type) || empty($body)) {
			throw new Exception('required POST parameters missing');
		}

		// look at the type first
		if (!in_array($type, self::$validMsgTypes)) {
			throw new Exception('type missing or illegal');
		}

		$body = @json_decode($body, true);

		if ($body === null) {
			throw new Exception('could not deserialize message');
		}

		if (!is_array($body)) {
			throw new Exception('wrong message format');
		}

		$handler = $app['controller.' . $type];

		if (empty($handler) || !($handler instanceof Handler)) {
			throw new Exception('no handler registered');
		}

		return $handler->handle($body, $app);
	}
}
