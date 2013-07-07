<?php

class ProductService {
	
	/**
	 * 加上如下注释，是为了让IDE可以自动进行代码提示
	 * @var ProductDao
	 */
	private $productDao;
	
	/**
	 * @var ProductImageDao
	 */
	private $productImageDao;
	
	public function __construct() {
		$this->productDao = Zc::singleton('ProductDao');
		$this->productImageDao = Zc::singleton('ProductImageDao');
	}
	
	/**
	 * 获取完整的商品信息。
	 * 通过调用商品信息、商品图片信息Dao来得到数据，并组装。
	 * 
	 * @return array
	 */
	public function getProductList() {
		$productList = $this->productDao->getProductList();
		$productImageList = $this->productImageDao->getProductImageList();
		
		//Zc::dump($productList);
		//Zc::dump($productImageList);
		
		foreach($productImageList as $pid => $pi) {
			$productList[$pid]['images'] = $pi;
		}
		//Zc::dump($productList);
		
		return $productList;
	}
}
