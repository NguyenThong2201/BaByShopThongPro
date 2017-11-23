<?php 
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class TypeProductTable extends AbstractTableGateway {
	public function construct(Adapter $adapter) {
		$this->adapter->$adapter;
		$this->table = 'type_products';
	}
	public function getListTypeProducts(){
		$select = new Select($this->table);
		$select->columns(array(
				'id',
				'name_type',
				'description_type',
				'image',
				'created_at',
				'updated_at',
		));
		$select->join("sex", "type_products.id_sex = sex.id",array(
				'name',
		),$select::JOIN_INNER);
		$select->order('id');
		$result = $this->selectWith($select);
		return $result->count() ? $result : null;
	}
}
?>