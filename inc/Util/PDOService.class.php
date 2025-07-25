<?php

class PDOService {

    // Database connection details
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbport = 3306;

    // DSN string
    private $dsn = "";

    // Class name for fetch mode
    private $className;

    // Error message
    private $error;

    // Prepared statement
    private $stmt;

    // PDO object
    private $pdo;

    public function __construct(string $className) {
        // Copy the class name
        $this->className = $className;

        // Build DSN (Always check your MySQL port!)
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $this->dsn .= ';port=' . $this->dbport;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        ];

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // Prepare the statement for execution
    public function query(string $query) {
        $this->stmt = $this->pdo->prepare($query);
    }

    // Bind parameters to the prepared statement
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute($data = null) {
        if (is_null($data)) {
            return $this->stmt->execute();
        } else {
            return $this->stmt->execute($data);
        }
    }

    // Return a single result as an object of the specified class
    public function singleResult() {
        
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        return $this->stmt->fetch(PDO::FETCH_CLASS);
    }

    // Return all results as an array of objects of the specified class
    public function resultSet() {
        
        return $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    // Return the number of rows affected by the last SQL statement
    public function rowCount(): int {
        return $this->stmt->rowCount();
    }

    // Get the last inserted ID
    public function lastInsertId(): int {
        return $this->pdo->lastInsertId();
        // returns a string representing the ID of the last inserted row
    }

    // Output debug information about the parameters bound to the statement
    public function debugDumpParams() {
        return $this->stmt->debugDumpParams();
        // outputs a detailed dump of the parameters that have been bound to the statement
    }
}
?>