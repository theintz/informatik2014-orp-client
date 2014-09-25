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

		// TODO: not sure if its ever callable, maybe we can just check for empty and instanceof Handler
		if (!is_callable($handler)) {
			throw new Exception('no handler registered');
		}

		// TODO: maybe handler is already an instance not a callback, see above comment
		$handler()->handle($body);
	}
}
