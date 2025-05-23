<?php

class Database extends PDO
{
    static $connection;
    public $queries;
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        //echo __CLASS__." __construct<br>";
        try {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);      
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
        $this->exec("SET NAMES utf8");
        //echo "Database Connected <br>";
        } catch(PDOException $e) {
            echo 'No Database Connection .. please try later ';
            die;
        } catch (Exception $e){
            echo 'No Database Connection .. please try later ';
            die;
        }
    }
    
    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */

    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $this->queries["select"][] = $sth->queryString;
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    

    public function insert($table,$data,$where = null) {   
        unset($data['action']);
        ksort($data);        
        foreach($data as $key=> $value) {
            if(!is_array($value)) {
                $fieldDetails .= "`$key`=:$key,";
            } else {
                unset($data[$key]);
            }
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sth = $this->prepare("INSERT INTO $table SET $fieldDetails");
        
        foreach ($data as $key => $value) {
            if(!is_array($value)) {
                $sth->bindValue(":$key", $value);
            }
        }        
        $this->queries["insert"][] = array("query"=>$sth->queryString,"data"=>$data);
        $sth->execute();
    }
   
    public function update($table,$data,$id) {   
        if(empty($id)) return;
        unset($data['action']);
        ksort($data);        
        foreach($data as $key=> $value) {
            if(!is_array($value)) {
                $fieldDetails .= "`$key`=:$key,";
            } else unset($data[$key]);
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE id = $id");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }        
        $this->queries["update"][] = array("query"=>$sth->queryString,"data"=>$data);
        $sth->execute();
    }
    
    public function delete($table,$data,$id,$limit = 1)
    {
        if(empty($id)) return;
        $this->queries["delete"][] = "DELETE FROM $table WHERE id=$id LIMIT $limit";
        return $this->exec("DELETE FROM $table WHERE id = $id LIMIT $limit");
    }
    
}