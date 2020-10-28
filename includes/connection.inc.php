<?php
class connection {
    private $host;
    private $username;
    private $password
    private $database;

    protected function connect() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "sistema";
        
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        return $conn;
    }
}
?>