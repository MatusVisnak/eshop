<?php
class Database {
    private $conn;

    public function __construct(
        private string $host = "localhost",
        private string $user = "root",
        private string $pass = "",
        private string $dbname = "cukrarenmavi"
    ) {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            die("DB Error: " . $this->conn->connect_error);
        }

        session_start();
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }

    public function close(): void {
        $this->conn->close();
    }
}
