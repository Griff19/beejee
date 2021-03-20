<?php

namespace griff;

/**
 * Class Model
 * @package core
 * @property $table string - name of table in database
 * @property db \PDO
 */
use griff\Exception;

class Model
{
	public $id;
	private $db;
 
	public static function tableName()
    {
        return '';
    }
    
    /**
     * Model constructor.
     * @throws Exception
     */
    function __construct()
    {
        try {
            $db       = new Db;
            $this->db = $db->connection;
        } catch (Exception $exception) {
            throw new Exception(T::t('DB_ERROR', 'en'), 500);
        }
    }
    
    public function getTable()
    {
        $class = get_called_class();
        return $class::$table;
    }
    
    public function toArray()
    {
        $arr = [];
        foreach ($this->fields() as $field) {
            $arr += [$field => $this->$field];
        }
        
        return $arr;
    }
    
    /**
     * List of fields in the model
     * @return array
     */
	public function fields()
    {
        return [];
    }
    
    /**
     *
     */
    public function fieldsToStr()
    {
        $arr = [];
        foreach ($this as $key => $value) {
            if (in_array($key, $this->fields())){
                $arr[] = $key;
            }
        }
        return implode(', ', $arr);
    }
    
    /**
     * @param string $mode
     * @return array
     */
    public function fieldsToArrSql($mode = 'INSERT')
    {
        $arr = [];
        foreach ($this as $key => $value) {
            if (in_array($key, $this->fields())) {
                if ($mode == 'INSERT')
                    $arr[':' . $key] = $value;
                if ($mode == 'UPDATE')
                    $arr[$key. '=:' . $key] = $value;
            }
        }
        
        return $arr;
    }
    
    /**
     * Save the model in the database
     * @return bool
     */
    public function save()
    {
        $sql = "INSERT INTO ";
        $sql .= static::tableName(). " (";
        $sql .= $this->fieldsToStr();
        $sql .= ") VALUES (";
        $sql .= implode(', ', array_keys($this->fieldsToArrSql()));
        $sql .= ");";
        
        //echo $sql;
        
        $db = new Db();
        $prepare = $db->connection->prepare($sql);
        if (!$prepare) {
            return false;
        }
        $prepare->execute($this->fieldsToArrSql());
        
        $this->id = $db->connection->lastInsertId();
        $prepare = null;
        
        return true;
    }
    
    /**
     * Update data
     */
    public function update()
    {
        $sql = "UPDATE ". static::tableName() ." SET ";
        $sql .= implode(', ', array_keys($this->fieldsToArrSql('UPDATE')));
        $sql .= " WHERE id=:id";
    
        $db = new Db();
        $prepare = $db->connection->prepare($sql);
        if (!$prepare) {
            return false;
        }
        
        $prepare->execute($this->toArray());
        
        return true;
    }
    
    /**
     * Loading data into the model
     * @param $data
     * @return bool
     */
    public function load($data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $value = Helper::safetyStr($value);
                $this->$key = $value;
            }
        } else {
            return false;
        }
        return true;
    }
    
    /**
     * @param $token
     * @return mixed
     * todo нужно удалить функцию find, похоже ни где не используется
     */
    public static function find($token)
    {
        $sql = "SELECT * FROM ". static::tableName() ." WHERE user_token = :token";
        
        $db = new Db;
        $prepare = $db->connection->prepare($sql);
        $prepare->execute(['token' => $token]);
        
        $result = $prepare->fetch(\PDO::FETCH_LAZY);
        return $result;
    }
    
    /**
     * @param $condition
     * @return mixed
     *
     */
    public static function findOne($condition)
    {
        $class = get_called_class();
        
        $query = "SELECT * FROM ". static::tableName() . " WHERE ";
        if (is_array($condition)) {
            $value = reset($condition);
            $key = key($condition);
            $query .= $key . " = :" . $key . ";";
            $execute = [$key => $value];
        } else {
            $query .= " id = :id;";
            $execute = ['id' => $condition];
        }
        
        $db = new Db;
        $prepare = $db->connection->prepare($query);
        
        $prepare->execute($execute);
        $prepare->setFetchMode(\PDO::FETCH_CLASS, $class);
        $result = $prepare->fetch();
        if ($result)
            return $result;
        else
            return false;
    }
    
    public static function findAll($page = null, $sort = null)
    {
        $query = "SELECT * FROM ". static::tableName();
        if ($sort) {
            $query .= " ORDER BY ". $sort;
        }
        
        if ($page) {
            $number = ($page-1) * 3;
            $query .= " LIMIT $number, 3";
        }
        
        $db = new Db;
        $prepare = $db->connection->prepare($query);
        $prepare->execute();
    
        $result = $prepare->fetchAll();
        
        return $result;
        
    }
    
    public static function getCount()
    {
        $query = "SELECT count(*) as 'count' FROM ". static::tableName();
        $db = new Db;
        $prepare = $db->connection->prepare($query);
        $prepare->execute();
    
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($result)
            return $result[0]['count'];
        else
            return 0;
    }
    
	
}