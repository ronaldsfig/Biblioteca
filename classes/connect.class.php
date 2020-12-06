<?php
class CONNECT {
    private $host;
    private $username;
    private $password;
    private $database;

    protected function connection() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "nm206";
        
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        return $conn;
    }

    public function close() {
        @mysqli_close($this->connection());
    }
}
?>