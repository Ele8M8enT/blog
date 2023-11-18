<?php

if (!class_exists('Database')) {
        class Database {
                private $conn;

                public function __construct() {
                    include_once('db_config.php');
                    $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    if ($this->conn->connect_error) {
                        die("Connection failed: " . $this->conn->connect_error);
                    }
                }
            
                public function getConnection() {
                    return $this->conn;
                }
        }

    }
?>