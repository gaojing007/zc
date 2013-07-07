<?php
/**
 * 登录
 * @author tangjianhui 2013-7-7 下午4:11:44
 *
 */
class LoginController extends ZcController{
	
	
	public function index () {
		$this->render();
	}
	
	public function doLogin() {
		$username = $_POST['username'];
		$password = $_POST['passwor'];
		
		//假设登录成功
		$_SESSION[SessionConst::userId] = 1;
		$_SESSION[SessionConst::userName] = $username;
		
		//登录成功后，跳到首页
		$this->redirect(Zc::url(RouteConst::productHomeIndex));
	}
	
	public function doLogout() {
		ZcSession::sessionDestroy();
		
		//登录成功后，跳到首页
		$this->redirect(Zc::url(RouteConst::productHomeIndex));
	}
}
