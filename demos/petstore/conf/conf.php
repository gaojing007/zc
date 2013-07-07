<?php

return array (
		'autoload.dirs.fs' => array (
				dirname(dirname( __FILE__ )) . '/libs/tool/' 
		),
		'autoload.dirs.ws' => array (
				'libs/service/',
				'libs/dao/'
		),
		'url.handler' => array (
						'class' => 'PetStoreUrlHandler',
						'file' => 'libs/tool/class.PetStoreUrlHandler.php' 
						),
		'monitor.autostart' => true,
		'monitor.need.log.error.level.constants' => E_ALL | E_STRICT,
		'language.current' => 'english',
		'default.timezone' => 'Etc/GMT+5',
		'default.route' => 'product/home/index',
		'clean.quotes' => false,
		'filters' => array(
					array(
							'route' => 'filter/session/index',
							'route.pattern' => '/.*/i',
						),
					),
);