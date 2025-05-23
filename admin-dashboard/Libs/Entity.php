<?php

class Entity {

    public static $DBObjectType;
    public static $DBObjectName;
    public static $DBObjectClass;

    function __construct() {
        //echo get_called_class()." __construct<br>";
    }

    public function query($where = 1, $limit = 1, $offset = 0) {
        $ViewObject = Entity::$DBObjectClass;
        $query = $ViewObject::$query;
        if (isset($where)) {
            $query = "select * from (" . $query. ") a where " . $where;
        }
        if (isset($limit) && isset($offset)) {
            $query.= ' limit ' . $offset . ',' . $limit;
        } else {
            if (isset($limit))
                $query.= ' limit ' . $limit;
        }
        echo $query;
        $result = Database::$connection->select($query);
        foreach (get_class_vars($ViewObject) as $var) {
            if (is_a($var, 'Attribute')) {
                $Attributes[] = $var;
            }
        }

        if (count($result) > 0) {
            //$obj[] = new EmpMasterVO();
            foreach ($result as $row) {
                $i= 0;
                foreach ($Attributes as $atr) {
                    $set = 'set' . $atr->Name;
                    if(isset($row[$atr->ColumnName])){
                    $obj[$row['id']]->$set = $row[$atr->ColumnName];
                    }
                }
                $i++;
                //$objs[] = $obj;
            }
            return $obj;
        }
        
        //print_r($result);        
        //echo __CLASS__;
    }



}
