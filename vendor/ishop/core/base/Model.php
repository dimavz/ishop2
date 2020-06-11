<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.11.2018
 * Time: 13:04
 */

namespace ishop\base;
use ishop\Db;
use Valitron\Validator;
use RedBeanPHP\R as R;

abstract class Model
{
	public $attributes = []; //Свойство для хранения массива свойств модели, который будет идентичен полям в таблице БД
	public $errors = []; //Свойство для хранения массива ошибок
	public $rules = []; //Свойство для хранения массива правил валидации данных
    private $table; // Свойство для хранения наименования таблицы в БД

	public function __construct()
	{
		Db::getInstance();
	}

    public function loadFormData($data){
        foreach($this->attributes as $name => $value){
            if(isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($table=''){
	    if(empty($table))
        {
            if(!empty($this->table))
            {
                $tbl = R::dispense($this->table);
                foreach($this->attributes as $name => $value){
                    $tbl->$name = $value;
                }
                return R::store($tbl);
            }
            $this->errors['table'][] = 'Пустое свойство table в модели!';
            return false;
        }
	    else{
            $tbl = R::dispense($table);
            foreach($this->attributes as $name => $value){
                $tbl->$name = $value;
            }
            return R::store($tbl);
        }
	    return false;
    }

    public function update($table, $id){
        $bean = R::load($table, $id);
        foreach($this->attributes as $name => $value){
            $bean->$name = $value;
        }
        return R::store($bean);
    }

    public function validate($data){
        Validator::langDir(WWW . '/validator/lang');
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if($v->validate()){
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function getErrors(){
        $errors = '<ul>';
        foreach($this->errors as $error){
            foreach($error as $item){
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }

    public function setTable($table){
	    $this->table = $table;
    }

}