<?php
class ADMIN extends CONNECT{

    public function getAllUsers(){
        $sql = "SELECT * FROM usuarios";
        $result = $this->connection()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            };
        }
        
        return $data;
    }

}
?>