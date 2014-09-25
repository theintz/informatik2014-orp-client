<?php

namespace Plista\OrpClient;

use Silex\Application;

/**
 * Implements a very basic most recent recommender.
 *
 * @package Plista\OrpClient
 */
class RecommendationRequestHandler implements Handler {

	public function handle(array $body, Application $app) {
		$fileName = __DIR__ . '/../../../logs/recommendation_request-' . date('Ymd') . '.log';
		file_put_contents($fileName, json_encode($body) . PHP_EOL, FILE_APPEND);

		return Response::getEmptyResponse();
	}
}
