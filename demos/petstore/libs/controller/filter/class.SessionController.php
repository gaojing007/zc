<?php
/**
 * 启动Session
 * 
 * @author tangjianhui 2013-7-7 下午3:48:39
 */
class SessionController extends ZcController {

	public function index() {
		Zc::startSessionWithParams('zcid', '', '', 'file');
	}
}
