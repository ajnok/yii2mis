<?php
/**
 * Created by PhpStorm.
 * User: kprums
 * Date: 10/11/2558
 * Time: 14:09
 */

namespace backend\models;

use Yii;
use yii\base\Object;

class JsonData extends Object
{
    public function getField($type = "array")
    {
        $url = "http://mis.kpru.ac.th/api/EmployeeInOrg/012";
        $json = file_get_contents($url);
        $arrData = json_decode($json);
        $field = array();
        foreach ($arrData[0] as $key => $value) {
            array_push($field, $key);
        }
        sort($field);
        if (isset($type)) {
            switch ($type) {
                case "array":
                    return $field;
                    break;
                case "json":
                    return json_encode($field);
                    break;
                default:
                    return $field;
            }

        }
        return json_encode($field);
    }
}