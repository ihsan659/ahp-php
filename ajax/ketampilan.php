<?php

require_once '../includes/config.php';

class Pangkat {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        $this->table = "ketampilan";
        switch ($reason) {
            case 'ketampilan':
                $this->getData();
                break;
            case 'data':
                $this->getData();
                break;
            case 'save':
                $this->saveData();
                break;
            case 'saveedit':
                $this->saveEdit();
                break;
            case 'edit':
                $this->editData();
                break;
            case 'delete':
                $this->deleteData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $result = array();
		$sql = "SELECT 
                    id,
                    keterangan 
                FROM 
                    $this->table ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result ? $result : null
        );
        echo json_encode($send);
	}

    private function editData(){
        $data = $this->data;
		$sql = "SELECT 
                    id,
                    keterangan
                FROM 
                    $this->table
                WHERE id = $data->id";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );

        echo json_encode($send);
	}
    
    private function saveData(){
        $data = $this->data;
        $sql = "INSERT INTO $this->table (
                                    keterangan
                                )
                                VALUES(
                                    '$data->description'
                                )";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $data,
            );
            echo json_encode($send);
        }
    }
    
    private function saveEdit(){
        $data = $this->data;
        $sql = "UPDATE 
                    $this->table
                SET
                    keterangan = '$data->description'
                WHERE 
                    id = $data->id ";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }
    }

    private function deleteData() {
        $data = $this->data;
        $sql = "DELETE FROM $this->table where id = $data->id";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $query,
            );
            echo json_encode($send);
        }
    }

    
} 

new Pangkat($_POST['reason'], json_decode($_POST['data']));