<?php
/**
 * Zc 2.0的入口文件
 * 
 * @author tangjianhui 2013-6-28 下午3:42:28
 *
 */
class Zc {
	private static $isZcFrameworkAutoload = false;
	
	private static $zcClassMapping = array();
	
	private static function zcFrameworkAutoloader($class) {
		if (isset(self::$zcClassMapping[$class]) && file_exists(self::$zcClassMapping[$class])) {
			require_once self::$zcClassMapping[$class];
		}
	}
	
	/**
	 * 初始化Zc框架的内部类的自动加载机制
	 */
	public static function initZcFrameworkAutoloader() {
		if (self::$isZcFrameworkAutoload) {
			return ;
		}
		
		$zcFsDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
		$zcBaseFsDir = $zcFsDir . 'base' . DIRECTORY_SEPARATOR;
		$zcCacheFsDir = $zcFsDir . 'cache' . DIRECTORY_SEPARATOR;
		$zcDbFsDir = $zcFsDir . 'db' . DIRECTORY_SEPARATOR;
		$zcMonitorFsDir = $zcFsDir . 'monitor' . DIRECTORY_SEPARATOR;
		$zcWebFsDir =  $zcFsDir . 'web' . DIRECTORY_SEPARATOR;
		$zcWebUrlHandlersFsDir =  $zcFsDir . 'web' . DIRECTORY_SEPARATOR . 'url-handlers' . DIRECTORY_SEPARATOR;
		$zcWebSessionHandlersFsDir =  $zcFsDir . 'web' . DIRECTORY_SEPARATOR . 'session-handlers' . DIRECTORY_SEPARATOR;
		
		self::$zcClassMapping = array(
				'ZcAutoloader' => $zcBaseFsDir . 'class.ZcAutoloader.php',
				'ZcConfig' => $zcBaseFsDir . 'class.ZcConfig.php',
				'ZcFactory' => $zcBaseFsDir . 'class.ZcFactory.php',
				'ZcLanguage' => $zcBaseFsDir . 'class.ZcLanguage.php',
				'ZcLog' => $zcBaseFsDir . 'class.ZcLog.php',
				
				'ZcAbstractCache' => $zcCacheFsDir . 'class.ZcAbstractCache.php',
				'ZcCacheApc' => $zcCacheFsDir . 'class.ZcCacheApc.php',
				'ZcCacheDebug' => $zcCacheFsDir . 'class.ZcCacheDebug.php',
				'ZcCacheFile' => $zcCacheFsDir . 'class.ZcCacheFile.php',
				'ZcCacheMemcached' => $zcCacheFsDir . 'class.ZcCacheMemcached.php',
				
				'ZcDbSimpleMysql' => $zcDbFsDir . 'class.ZcDbSimpleMysql.php',
				
				'ZcMonitor' => $zcMonitorFsDir . 'class.ZcMonitor.php',
				'ZcMonitorHandler' => $zcMonitorFsDir . 'class.ZcMonitorHandler.php',
				
				'ZcAction' => $zcWebFsDir . 'class.ZcAction.php',
				'ZcController' => $zcWebFsDir . 'class.ZcController.php',
				'ZcDispatcher' => $zcWebFsDir . 'class.ZcDispatcher.php',
				'ZcSession' => $zcWebFsDir . 'class.ZcSession.php',
				'ZcSessionHandler' => $zcWebFsDir . 'class.ZcSessionHandler.php',
				'ZcUrl' => $zcWebFsDir . 'class.ZcUrl.php',
				'ZcUrlHandler' => $zcWebFsDir . 'class.ZcUrlHandler.php',
				'ZcWidget' => $zcWebFsDir . 'class.ZcWidget.php',
				
				'ZcDefaultUrlHandler' => $zcWebUrlHandlersFsDir . 'class.ZcDefaultUrlHandler.php',
				'ZcSimplePathInfoUrlHandler' => $zcWebUrlHandlersFsDir . 'class.ZcSimplePathInfoUrlHandler.php',
				'ZcSimpleRewriteUrlHandler' => $zcWebUrlHandlersFsDir . 'class.ZcSimpleRewriteUrlHandler.php',
				
				'ZcDbSessionHandler' => $zcWebSessionHandlersFsDir . 'class.ZcDbSessionHandler.php',
				'ZcMemcachedSessionHandler' => $zcWebSessionHandlersFsDir . 'class.ZcMemcachedSessionHandler.php',
				);
		
		spl_autoload_register(array('Zc', 'zcFrameworkAutoloader'));
		
		self::$isZcFrameworkAutoload = true;
	}
	
	/**
	 * 初始化系统配置。
	 * *fs* = Filesystem directories (local/physical)。绝对路径的目录
	 * *ws* = Webserver directories (virtual/URL)。相对于应用的目录
	 *  
	 * @param string $rootDir 系统根目录，比如/home/www/
	 * @param string $appDir mvc代码相对于系统根目录的位置 比如 front_app/
	 */
	private static function initConfig($rootDir, $appDir) {
		$config = ZcFactory::getConfig();
		
		$rootDir = rtrim($rootDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		if ($appDir == DIRECTORY_SEPARATOR) {
			$appDir =  '';
		} else {
			$appDir = rtrim($appDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		}
		
		$appFsDir = $rootDir . $appDir;
		
		$config->set('dir.fs.root', $rootDir);
		$config->set('dir.fs.app', $appFsDir);
		$config->set('dir.fs.conf', $appFsDir . 'conf' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.languages', $appFsDir . 'languages' . DIRECTORY_SEPARATOR);
		
		$config->set('dir.fs.views.layout', $appFsDir . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.views.page', $appFsDir . 'views' . DIRECTORY_SEPARATOR . 'page' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.views.widget', $appFsDir . 'views' . DIRECTORY_SEPARATOR . 'widget' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.views.static', $appFsDir . 'views' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR);
		$config->set('dir.ws.views.static', $appDir . 'views' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR);
		
		$config->set('dir.fs.libs', $appFsDir . 'libs' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.libs.controller', $appFsDir . 'libs' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
		$config->set('dir.fs.libs.widget', $appFsDir . 'libs' . DIRECTORY_SEPARATOR . 'widget' . DIRECTORY_SEPARATOR);
		
		$config->set('dir.ws.app', $appDir);
		
		//language
		$config->set('language.default', 'english');
		$config->set('language.current', 'chinese');
		
		$config->mergeFromFile($config->get('dir.fs.conf') . 'conf.php');
	}
	
	private static function initMonitor() {
		$isAutoStart = ZcFactory::getConfig()->get('monitor.autostart');
		if (!$isAutoStart) {
			return ;
		}
		ZcMonitor::setHandler(new ZcMonitorHandler());
		self::setMonitor();
	}
	
	private static function setMonitor() {
		register_shutdown_function(array('ZcMonitor', 'appShutdown'));
		set_error_handler(array('ZcMonitor','appError'));
		set_exception_handler(array('ZcMonitor','appException'));
	}
	
	public static function init($rootDir, $appDir = DIRECTORY_SEPARATOR) {
		
		// 初始化Zc框架内部类的自动加载机制
		self::initZcFrameworkAutoloader();
		
		// 初始化配置
		self::initConfig($rootDir, $appDir);
		
		// 初始化默认时区
		self::initTimeZone();
		
		// 初始化监控
		self::initMonitor();
		
		// 应用类的自动加载
		$autoloader = new ZcAutoloader();
		$autoloader->init();
		//Zc::dump($autoloader);
	}
	
    public static function dump($var, $strict=true, $echo=true, $label=null) {
		$label = ($label === null) ? '' : rtrim($label) . ' ';
		if (!$strict) {
			if (ini_get('html_errors')) {
				$output = print_r($var, true);
				$output = "<pre style='white-space: pre-wrap; word-wrap: break-word;'>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
			} else {
				$output = $label . print_r($var, true);
			}
		} else {
			ob_start();
			var_dump($var);
			$output = ob_get_clean();
			if (!extension_loaded('xdebug')) {
				$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
				$output = "<pre style='white-space: pre-wrap; word-wrap: break-word;'>" . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			}
		}
		if ($echo) {
			echo($output);
			return null;
		}else
			return $output;
	}
	
	/**
	 * 渲染输出Widget
	 * 
	 * @param string $route
	 * @param array $data
	 * @param boolean $return
	 * @return NULL | string
	 */
	public static function W($route, $data=array(), $return=false) {
		$parts = explode('/', $route);
	
		$lastPart = array_pop($parts);
		$className = str_replace(' ', '', ucwords(strtolower(str_replace(array('-', '_'), ' ', $lastPart)))) . 'Widget';
	
		$path = '';
		foreach ($parts as $part) {
			$path .= $part . '/';
		}
		//加载语言
		ZcFactory::getLanguageObject()->loadWidgetLanguageByRoute($route);
		
		require_once (Zc::C('dir.fs.libs.widget') . $path . 'class.' . $className . '.php');
		$widget = new $className();
		$content = $widget->render($data);
		if ($return)
			return $content;
		else
			echo $content;
	}
	
	/**
	 * 获取某个语言常量
	 * @param string $key
	 */
	public static function L($key) {
		return ZcFactory::getLanguageObject()->get($key);
	}
	
	public static function C($key = '') {
		return ZcFactory::getConfig()->get($key);
	}
	
	public static function url($route, $param, $ssl = false) {
		return ZcFactory::getUrl()->url($route, $param, $ssl);
	}
	
	public static function singleton($className) {
		return ZcFactory::singleton($className);
	}
	
	private static function my_microtime_float($dec = 3) {
		list($usec, $sec) = explode(" ", microtime());
		return bcadd($usec, $sec, $dec);
	}
	
	//记录和统计时间（微妙）
	public static function G($start = '', $end = '', $dec = 3) {
	
		if ( empty($_GET['need_stat']) ) {
			return false;
		}
	
		static $_info = array();
	
		if (is_float($end)) {
			$info[$start] = $end;
		} elseif (!empty($end)) {
			if (!isset($_info[$end])) {
				$_info[$end] = my_microtime_float($dec);
			}
			return number_format($_info[$end] - $_info[$start], $dec);
		} elseif (!empty($start)) {
			$_info[$start] = my_microtime_float($dec);
		} else {
			$temp = array();
	
			$findFirst = true;
			foreach ($_info as $key => $value) {
				if ($findFirst) {
					$baseTime = $value;
					$lastTime = 0;
					$findFirst = false;
				}
	
				$currTime = bcsub($value, $baseTime, 3);
				$currCostTime = bcsub($currTime, $lastTime, 3);
				$lastTime = $currTime;
	
				$temp[$key] = $currTime . ' [' . $currCostTime . ']';
			}
			return $temp;
		}
	}
	
	public static function startMonitor($handler = null) {
		if (empty($handler)) {
			ZcMonitor::setHandler(new ZcMonitorHandler());
		} else {
			ZcMonitor::setHandler($handler);
		}
		self::setMonitor();
	}
	
	/**
	 * 返回Log对象
	 *
	 * log文件的位置：
	 * 1， $log_name没有以.log结尾，对于日志文件，会自动加上.log
	 * 2， $log_name后面会自动加上.今天的日期，比如.2012_02_12
	 * 3， 可以用/来自动创建目录，
	 *
	 * 比如调用Zc::getLog('ds/register');那么日志的位置是：Zc::C{log.dir}/ds/register.log.2012_02_12
	 *
	 * @param $logName log名字
	 * @param $defaultLevel 定义在Log的常量，只有高于默认log级别的log，才会被记录下来
	 * @param $echo 是否输出，如果设置为true，那么当记log的时候，同时会echo到页面中。仅供不懂得用tail -f查看log的懒人调试用，并用于开发环境
	 * @return ZcLog
	 */
	public static function getLog($logName = '', $defaultLevel = ZcLog::INFO, $echo = false) {
		$logName = trim($logName);
		
		if (empty($logName)) {
			$logName = 'zc';
		}
		if (stripos($logName, '.log') === false) {
			$logName .= '.log';
		}
		if ($logName[0] != '/' || $logName[1] != ':') {
			$logName = rtrim(Zc::C('log.dir'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR  . $logName;
		}
		
		$logPath = $logName . '.' . date('Y-m-d', time ());
		$log = new ZcLog($logPath, $defaultLevel, $echo);
		return $log;
	}
	
	/**
	 * 返回缓存对象实例
	 * 
	 * @param string $bizName 缓存的业务标识，这个字段的设置，可以保证缓存对象实现单例
	 * @param string $cacheType 
	 * @param string $timestamp
	 * @param array $options
	 * @return ZcAbstractCache
	 */
	public static function getCache($bizName, $cacheType = '',  $timestamp = '', $options = null) {
		static $cacheInstances = array();
		
		$cacheInstanceKey = $bizName;
		if (!isset($cacheInstances[$cacheInstanceKey])) {
			if (empty($cacheType) || empty($options)) {
				throw new Exception("try to create cache[{$bizName}], but cacheType[{$cacheType}], options[" . print_r($options, true) . "]");
			}
			
			$cacheClassName = 'ZcCache' . ucwords($cacheType);
			$cache = new $cacheClassName($timestamp, $options);
			$cacheInstances[$cacheInstanceKey] = $cache;
		}
		
		return $cacheInstances[$cacheInstanceKey];
	}
	
	/**
	 * 采用stripslashes反转义特殊字符
	 *
	 * @param array|string $data 待反转义的数据
	 * @return array|string 反转义之后的数据
	 */
	private static function _stripSlashes(&$data) {
		return is_array($data) ? array_map(array(self, '_stripSlashes'), $data) : stripslashes($data);
	}
	
	private static function cleanQuotes() {
		$config = ZcFactory::getConfig();
		if (!$config->get('clean.quotes')) {
			return;
		}
		
		if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
			if (isset($_GET)) $_GET = self::_stripSlashes($_GET);
			if (isset($_POST)) $_POST = self::_stripSlashes($_POST);
			if (isset($_REQUEST)) $_REQUEST = self::_stripSlashes($_REQUEST);
			if (isset($_COOKIE)) $_COOKIE = self::_stripSlashes($_COOKIE);
		}
		set_magic_quotes_runtime(false);
		if (ini_get('magic_quotes_sybase') != 0) {
			ini_set('magic_quotes_sybase', 0);
		}
	}
	
	private static function initTimeZone() {
		$config = ZcFactory::getConfig();
		$timeZone = $config->get('default.timezone');
		if (!empty($timeZone)) {
			date_default_timezone_set($timeZone);
		}
	}
	
	/**
	 * 把启动Session作为一个方法暴露出来，这样可以利用整个Zc框架的类自动加载机制，同时也可以作为一个Zc类的一个普通static方法暴露出来使用
	 * 
	 * @param unknown_type $sessionName
	 * @param unknown_type $sessionDomain
	 * @param unknown_type $sessionId
	 * @param unknown_type $sessionType
	 * @param unknown_type $options
	 */
	public static function startSessionWithParams($sessionName, $sessionDomain, $sessionId, $sessionType, $options) {
		self::initZcFrameworkAutoloader();	
		ZcSession::startSessionWithParams($sessionName, $sessionDomain, $sessionId, $sessionType, $options);
	}
	
	/**
	 * Zc框架执行Web MVC的入口函数。
	 * 
	 * 我考虑是否把init方法作为私有，而然runMVC来得到rootdir和appdir，调用init来完成初始化框架和应用工作。
	 * 这样其实隐含的一个逻辑，整个Zc框架，可以随着runMVC的参数不同，可以去跑不同的app应用。这个时候还需要把所有的Factory的对象池都清空掉。
	 * 总之，需要把Zc的对象池都清空。
	 */
	public static function runMVC($route = '') {
		//Zc::dump(ZcFactory::getConfig());
		
		//确保关闭魔术引号
		self::cleanQuotes();
		
		//URL rewrite
		$zcUrl = ZcFactory::getUrl();
		$zcUrl->parse();
		
		if (empty($route)) {
			$route = isset($_GET['route']) ? $_GET['route'] : Zc::C('default.route');
		}
		$action = new ZcAction($route);
		$dispatcher = new ZcDispatcher();
		$dispatcher->dispatch($action);
	}
}

Zc::initZcFrameworkAutoloader();