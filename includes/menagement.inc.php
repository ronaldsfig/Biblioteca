<?php
class admin extends connection{

    public function getAllUsers(){
        $sql = "SELECT * FROM usuarios";
        $result = $this->connect()->query($sql);
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