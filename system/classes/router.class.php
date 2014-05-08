<?
class Router {

	public static function getUriSegments() {
		return explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}

	public static function getUriSegment($num = 0) {
		if ($num > 0) {
			$segments = self::getUriSegments();
			return (count($segments) && count($segments) >= ($num - 1)) ? ($segments[$num]) : ('');
		}
	}
	
}
?>