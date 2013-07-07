<?php
class HeaderWidget extends ZcWidget {
	
	public function render($data = '') {
		$data = array();
		
		$data['isLogin'] = isset($_SESSION[SessionConst::userId]);
		if ($data['isLogin']) {
			$data['userName'] = $_SESSION[SessionConst::userName];
		}
		
		return $this->renderFile('common/header', $data);
	}
}