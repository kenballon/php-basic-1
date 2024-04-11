<?php

// connect to our Database with PHP PDO
// create a new instance of the PDO class
// DSN Data Source Name. Connection string.

class Database
{
    public $conn; // property
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $con = 'mysql:' . http_build_query($config, '', ';');

        $this->conn = new PDO($con, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params)
    {
        try {
            $this->statement = $this->conn->prepare($query);

            $this->statement->execute($params);

            return $this;

        } catch (PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }

    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            abort();
        }

        return $result;
    }
}