<?php
class ZcSimpleRewriteUrlHandler implements  ZcUrlHandler {

	public function buildUrl($route, $params = '', $ssl = false) {
		$scheme = $ssl ? 'https' : 'http';
		$domain = $_SERVER['HTTP_HOST'];
		$port = $_SERVER['SERVER_PORT'];

		$route = trim($route, '/');
			
		$url = $scheme . '://' . $domain . ($port == 80 ? '' : ':' . $port) . '/' . $route;

		if (is_array($params)) {
			$params = http_build_query($params, '', '&');
		}

		if ($params) {
			$url .= '?' . ltrim($params, '&');
		}
		return $url;
	}

	public function parseBack() {
		if (isset($_GET['_route_'])) {
			$_GET['route'] = trim($_GET['_route_'], '/');
			unset($_GET['_route_']);
		}
	}
}