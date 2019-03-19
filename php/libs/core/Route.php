<?php
namespace Core;

class Route {

	public static $fileExtention 	= '.php';
	public static $default			= 'Index';
	public static $error			= 'Error';

	public static $URL 				= '';
	public static $MODEL			= '';
	public static $REQUEST 			= '';
	public static $CONTROLLER 		= '';

	public static function init() {
		$url 			= isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : null;
		$url 			= rtrim($url, '/');
		$url 			= filter_var($url, FILTER_SANITIZE_URL);
		self::$URL 		= explode('/', $url);
		self::$REQUEST 	= $_SERVER['REQUEST_METHOD'];

		// if (empty(self::$URL[0])) {
		// 	self::load(self::$default);
		// } else {
		// 	self::load(self::$URL[0]);
		// }

		// self::call(self::$URL);

		self::simpleRoute(strtolower($url));
	}

	public static function simpleRoute($inputPath) {
		$pathBeg = __DIR__ . '/../../app/controllers/';
		switch ($inputPath) {
			case '/index' :
				require $pathBeg . 'Index.php';
				self::$CONTROLLER = new \Index;
				break;
			case '' :
				require $pathBeg . 'Index.php';
				break;
			case '/preview' :

				require $pathBeg . 'Preview.php';
				self::$CONTROLLER = new \Preview;

				break;

			case '/insert' :

				require $pathBeg . 'Insert.php';
				self::$CONTROLLER = new \Insert;

				break;

			case '/globaljs':
				echo file_get_contents(__DIR__ . '/../../public/assets/js/global.js');

				break;
			case '/globalcss':
				header("Content-type: text/css");
				echo readfile(__DIR__ . '/../../public/assets/css/global.css');

				break;
			default: 
				require $pathBeg . 'Error.php';
				break;
		}
		echo $CONTROLLER;
		if(self::$CONTROLLER != ''){
			self::$CONTROLLER->index();
		}
		
	}

	public static function load($controller) {
		
		echo $controller;
		$path = CONTROLLERS.'/'.ucfirst($controller).self::$fileExtention;

		if (file_exists($path)) {
			require $path;
			self::$CONTROLLER = new $controller;
		} else {
			self::error();
			return false;
		}
	}

	public static function call($url) {
		$length 	= count($url);
		$request 	= (self::$REQUEST == 'GET') ? '' : strtolower(self::$REQUEST).'_';

		if ($length > 1) {
			if (!method_exists(self::$CONTROLLER, $url[1])) {
				self::error();
			}
		}

		switch ($length) {
			case 5:
				self::$CONTROLLER->{$request.$url[1]}($url[2], $url[3], $url[4]);
			break;

			case 4:
				self::$CONTROLLER->{$request.$url[1]}($url[2], $url[3]);
			break;

			case 3:
				self::$CONTROLLER->{$request.$url[1]}($url[2]);
			break;

			case 2:
				self::$CONTROLLER->{$request.$url[1]}();
			break;

			default:
				self::$CONTROLLER->{$request.self::$default}();
			break;
		}
	}

	public static function error() {
		require CONTROLLERS.'/'.self::$error.self::$fileExtention;
		self::$CONTROLLER = new \Error;
		self::$CONTROLLER->index();
		exit;
	}

}