<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ProductsTable;

class IndexController extends AbstractActionController {

	public function indexAction() {
		$view = new ViewModel();
		$productTable = new ProductsTable($this->getAdapter());
		if ($_GET['page'] = null) {
			$products = $productTable->getListProduct();
		}else{
			$page = $_GET['page'];
			$products = $productTable->getListProduct($page);
		}
		
		$productsNew = $productTable->getListProductNew();
		$productsSale = $productTable->getListProductSale();
		$this->layout('layout/main-layout');
		$view->setTemplate('application/index/index.phtml');
		return [ 
				'products' => $products,
				'productsNew' => $productsNew,
				'productsSale' => $productsSale,
				'view' => $view,
		];
	}
	
	private function getAdapter() {
		return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
	}
	
}
