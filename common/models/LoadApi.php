<?php
/**
 * Created by PhpStorm.
 * User: kprums
 * Date: 17/11/2558
 * Time: 14:28
 */
namespace common\models;

use Yii;
use yii\base\Object;
use yii\helpers\Json;

class LoadApi extends Object
{
    private $_url_personal = 'http://mis.kpru.ac.th/api/EmployeeInOrg/012';
    private $_url_student = '';
    private $_data;
    private $_field;

    public function getPerson()
    {
        return self::_getData('personal');
    }

    public function getStudent()
    {
//        return Json::decode(self::_getData());
        return self::_getData('student');
    }

    private function _getData($mode = 'personal')
    {

        if (isset($mode)) {
            $mode = '_url_' . $mode;
            $this->_data = file_get_contents($this->$mode);
            if(self::is_json($this->_data)) {
                $this->_data = Json::decode($this->_data);
                if (count($this->_data) > 0) {
                    $this->_field = array_keys(array_change_key_case($this->_data[0], CASE_LOWER));
                    sort($this->_field);
                    $this->_field = array_unique($this->_field);
                    return ['field'=>$this->_field,'data'=>$this->_data];
//                    return array(); // This for test return empty only
                } else
                {
                    return array();
                }
            } else
            {
                return array();
            }
        } else {
            return array();
        }
    }

    private function is_json($string, $return_data = false)
    {
//        $this->_data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $this->_data : true) : false;
    }
}