<?php

class DB {

    protected $db = null;

    public function __construct() {
        $this->db = DB::connToDB();
    }

    public function connToDB() {

        try {
            $conn = new \PDO("sqlite:db/sqlite.db", '', '');
            $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $conn->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            
            return $conn;

        } catch (PDOException $e) {
            echo "Ошибка подключения к базе данных";

        }
    }

    public function query($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function queryGetOne($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function queryGetAll($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}