<?php
/**
 * 配置类
 * 
 * @author tangjianhui
 *
 */
class ZcConfig {
	private $config = array();

	public function __construct() {
		$this->config = array (
				'dir.fs.app' => '',
				'language.default' => 'english',
				'language.current' => 'chinese',
				'url.handler' => array (
								'class' => 'ZcDefaultUrlHandler'
								),
				'default.route' => 'home/main/index',
				'default.timezone' => 'Asia/Shanghai',
				'clean.quotes' => true,
				
				'monitor.autostart' => false,
				'monitor.need.log.error.level.constants' => E_ALL & ~E_WARNING & ~E_NOTICE, 
				'monitor.db.server' => '192.168.10.251',
				'monitor.db.username' => 'tmart_db_dev',
				'monitor.db.password' => 'tmart_db_dev',
				'monitor.db.database' => 'tmart_hyl',
				
				'log.dir' => '/tmp/zc/',
				'log.level' => ZcLog::INFO,
		);
	}

	public function mergeFromFile($file) {
		if(file_exists($file)) {
			$outConfig = require($file);
			$this->config = array_merge($this->config, $outConfig);
		}
	}

	public function set($key, $value) {
		$this->config[$key] = $value;
	}

	public function get($key) {
		return empty($key) ? $this->config : $this->config[$key];
	}
}