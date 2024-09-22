<?php

class ConexionDb{

    private static $instace = null;
    private $conn;
    private function __construct()
    {
      try {
        $this->conn = new PDO("mysql:host=localhost;port=3306;dbname=local_library", "root", "");        
      }catch (\Throwable $e) {
        throw $e;
      }
    }

    public static function getInstance()
    {
        if (!self::$instace) {
            self::$instace = new ConexionDb();
        }
        return self::$instace;
    }

    public function getConnection()
    {
        return $this->conn;
    }
    }


