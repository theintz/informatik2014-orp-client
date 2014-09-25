<?php

namespace Plista\OrpClient;

use Silex\Application;

interface Handler {
	/**
	 * @param array $body the json encoded body of the request
	 * @param Application $app the di container
	 * @return string a response
	 */
	public function handle(array $body, Application $app);
}