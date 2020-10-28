<?php
class admin extends connect{

    private function getAllUsers(){
        $sql = "SELECT * FROM usuario";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row
            }
        }
        
        return $data;
    }

    public function viewAllUsers(){
        $datas = $this->getAllUsers();

        foreach ($datas as $data) {
            # code...
        }
    }
}
?>