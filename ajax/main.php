<?php 

class Main {
    function getKriteria() {
        $result = array();
		$sql = "SELECT 
                    code,
                    bobot
                FROM kriteria ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        return $result;
    }
}


?>