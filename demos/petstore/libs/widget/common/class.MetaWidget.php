<?php
class MetaWidget extends ZcWidget {

	/* (non-PHPdoc)
	 * @see ZcWidget::render()
	 */
	public function render($renderData= '') {
		$renderData = array();
		
		$renderData['route'] = $_GET['route'];
		
		$title = '';
		$metaDesc = '';
		$metaKeywords = '';
		switch ($renderData['route']) {
			case RouteConst::productHomeIndex:
				$title = 'PetStore首页';
				$metaDesc = 'PetStore Meta Description: 这是个在线宠物商店';
				$metaKeywords = 'PetStore Meta Keywords: 宠物，优惠';
				break;
			default:
				$title = 'PetStore';
				$metaDesc = 'PetStore Meta Description: 这是个在线宠物商店';
				$metaKeywords = 'PetStore Meta Keywords: 宠物，优惠';
		}
		
		$renderData['title'] = $title;
		$renderData['metaDesc'] = $metaDesc;
		$renderData['metaKeywords'] = $metaKeywords;
		
		return $this->renderFile('common/meta', $renderData);
	}
	
}