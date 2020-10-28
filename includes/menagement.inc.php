<?php
class admin extends connection{

    private function getAllUsers(){
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

    public function viewAllUsers(){
        $datas = $this->getAllUsers();

        foreach ($datas as $data) {
            echo "<th scope='row'>".$data['id']."</th>";
            echo "<td>".$data['nome']."</td>";
            echo "<td>".$data['data_nascimento']."</td>";
            echo "<td>".$data['email']."</td>";
        }
    }
}
?>