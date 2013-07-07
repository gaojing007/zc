<?php

class ProductImageDao {
	private $db;
	
	public function __construct() {
		//$this->db = Zc::singleton('ZcDbSimpleMysql');
	}
	
	/**
	 * 获取宠物列表
	 * 
	 * @return array 所有的宠物
	 */
	public function getProductImageList() {
		//mock DB操作
		$pis = array(
					1000 => array(
							'http://cdn2.image-tmart.com/prodimgs/1/15001747/Warm-Silk-Cotton-Pet-Pad-for-Pet-Dog-_320x320.jpg',
							'http://cdn1.image-tmart.com/prodimgs/1/15001747/Warm-Silk-Cotton-Pet-Pad-for-Pet-Dog-_3_320x320.jpg'
						),
					1001 => array(
							'http://cdn1.image-tmart.com/prodimgs/P/P11D01GY/Grey-Grooming-Tie-Bow-for-Dog-Cat-Pet_320x320.jpg',
							'http://cdn2.image-tmart.com/prodimgs/P/P11D01GY/Grey-Grooming-Tie-Bow-for-Dog-Cat-Pet_1_320x320.jpg'
						),
					1002 => array(
							'http://cdn1.image-tmart.com/prodimgs/1/15001260/Pet-Dog-Skirt-Adjustable-Strap-Dress-Red-Size-L_320x320.jpg'
					),
				);
		return $pis;
	}
}

