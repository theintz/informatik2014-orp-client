<?php

namespace Plista\OrpClient;

use Symfony\Component\HttpFoundation\JsonResponse;

class Response extends JsonResponse {

	public function __construct(array $ids) {
		$targetScores = count($ids) > 0 ? array_fill(0, count($ids), null) : [];
		parent::__construct(['recs' => ['ints' => ['3' => $ids], 'floats' => ['2' => $targetScores]]]);
	}

	/**
	 * Generates an empty yet valid response.
	 *
	 * @return Response
	 */
	public static function getEmptyResponse() {
		return new self([]);
	}
}
