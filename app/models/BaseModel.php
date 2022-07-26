<?php

namespace App\Models;

use PDO;
use PDOException;

class BaseModel
{
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost; dbname=we3014.01; charset=utf8", 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    //Hàm lấy toàn bộ dữ liệu
    public static function all()
    {
        $model = new static;
        $sqlBuilder = "SELECT * FROM " . $model->tableName;
        $stmt = $model->conn->prepare($sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function find($id)
    {
        $model = new static;
        $sqlBuilder = "SELECT * FROM " . $model->tableName . " WHERE id=$id";
        $stmt = $model->conn->prepare($sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchALl(PDO::FETCH_CLASS, get_class($model));
        return $result[0];
    }

    public function insert($arrs)
    {
        $this->queryBuilder = "INSERT INTO " . $this->tableName;
        $cols = "(";
        $params = "(";
        foreach ($arrs as $key => $value) {
            $cols .= "$key, ";
            $params .= ":$key, ";
        }
        //Xóa dấu phẩy bên phải
        $cols = rtrim($cols, ", ") . ") ";
        $params = rtrim($params, ", ") . ")";
        //Nối vào chuỗi queryBuilder 
        $this->queryBuilder .= $cols . "VALUES" . $params;
        $stmt = $this->conn->prepare($this->queryBuilder);
        $stmt->execute($arrs);
    }

    public function update($arrs)
    {
        $this->queryBuilder = "UPDATE " . $this->tableName . " SET ";
        foreach ($arrs as $key => $value) {
            $this->queryBuilder .= "$key=:$key, ";
        }

        $this->queryBuilder = rtrim($this->queryBuilder, ", ");
        $this->queryBuilder .= " WHERE id=:id";
        //Thêm id vào mảng
        $arrs['id'] = $this->id;

        $stmt = $this->conn->prepare($this->queryBuilder);
        $stmt->execute($arrs);
    }

    public static function where($column, $operator, $value)
    {
        $model = new static;
        $model->queryBuilder = "SELECT * FROM $model->tableName WHERE $column $operator '$value'";
        return $model;
    }

    public function andWhere($column, $operator, $value)
    {
        $this->queryBuilder .= " AND $column $operator '$value'";
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $this->queryBuilder .= " OR $column $operator '$value'";
        return $this;
    }

    public function get()
    {
        $stmt = $this->conn->prepare($this->queryBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));
    }
}
