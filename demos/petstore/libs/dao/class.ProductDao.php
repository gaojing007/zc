<?php

class ProductDao {
	private $db;
	
	public function __construct() {
		//$this->db = Zc::singleton('ZcDbSimpleMysql');
	}
	
	/**
	 * 获取宠物列表
	 * 
	 * @return array 所有的宠物
	 */
	public function getProductList() {
		//mock DB操作
		$ps = array(
					1000 => array(
							'name' => 'Cat 1',
							'color' => 'Red',
							'price' => 100,
						),
					1001 => array(
							'name' => 'Cat 2',
							'color' => 'Black',
							'price' => 200,
						),
					1002 => array(
							'name' => 'Cat 3',
							'color' => 'Pink',
							'price' => 300,
					),
				);
		return $ps;
	}
}

