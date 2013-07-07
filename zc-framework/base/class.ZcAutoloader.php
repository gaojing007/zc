<?php
/**
 * 自动加载类
 * 
 * @author tangjianhui
 *
 */
class ZcAutoloader {
	private $autoloadDirs = array();
	private $autoloadClassFileMapping = array();
	
	public function __construct() {
		$config = ZcFactory::getConfig();
		
		//获取绝对路径的自动加载目录
		$dirsFs = $config->get('autoload.dirs.fs');
		foreach($dirsFs as $dir) {
			$this->autoloadDirs[] = rtrim(trim($dir), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;		
		}
		
		//获取应用路径的自动加载目录
		$dirsWs = $config->get('autoload.dirs.ws');
		$dirApp = $config->get('dir.fs.app');
		foreach($dirsWs as $dir) {
			$this->autoloadDirs[] = $dirApp . trim(trim($dir), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		}
		
		$this->autoloadClassFileMapping = $config->get('autoload.class.file.mapping');
	}
	
	public function init() {
		spl_autoload_register(array($this, "autoload"));
	}
	
	public function autoload($class) {
		if (isset($this->autoloadClassFileMapping[$class])) {
			include_once $this->autoloadClassFileMapping[$class];
			return ;
		}
		
		foreach ($this->autoloadDirs as $autoLoadDir) {
			$classFile = $autoLoadDir . 'class.' . $class . '.php';
			if (file_exists($classFile)) {
				include_once $classFile;
				continue;
			}
			
			$classFile = $autoLoadDir . $class . '.class.php';
			if (file_exists($classFile)) {
				include_once $classFile;
				continue;
			}
			
			$classFile = $autoLoadDir . $class . '.php';
			if (file_exists($classFile)) {
				include_once $classFile;
			}
		}
	}
}