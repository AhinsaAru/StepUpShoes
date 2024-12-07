<?php

namespace App\Classes;

use Exception;
use PDO;
use PDOException;

class DbConnector
{
    private string $host = 'localhost';
    private string $db = 'stepup_shoes';
    private string $username = 'root';
    private string $password = '';
    private PDO $pdo;

    /**
     * DbConnector constructor.
     * Create a new PDO instance for the database connection
     *
     * @throws Exception If an error occurs while connecting to the database
     */
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Get the PDO connection instance.
     *
     * @return PDO The PDO instance for the database connection
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
