<?php
/**
 * PetStore首页
 * @author tangjianhui 2013-7-4 上午11:17:09
 *
 */
class HomeController extends ZcController {
	
	/**
	 * @var ProductService
	 */
	private $productService;
	
	/**
	 * 构造函数初始化
	 */
	public function __construct($route) {
		parent::__construct($route);
		
		$this->productService = Zc::singleton('ProductService');
	}
	
	public function index() {
		// 调用模型层获取数据
		$ps = $this->productService->getProductList();
		//Zc::dump($ps);

		// 组装待会渲染视图层模板需要用到的数据
		$renderData['ps'] = $ps;
		$renderData['name'] = $_SESSION['user_name'];
		
		// 渲染模板
		$this->render($renderData);
	}
}
