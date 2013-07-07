<?php
class FooterWidget extends ZcWidget {
	/*
	 * (non-PHPdoc) @see ZcWidget::render()
	 */
	public function render($renderData = '') {
		return $this->renderFile('common/footer', $renderData);
	}
}
