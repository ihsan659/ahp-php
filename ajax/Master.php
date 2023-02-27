<?php

require_once '../includes/config.php';

class Master {
    private $conn = "";
    private $table;

    public function __construct($reason, $session, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        switch ($reason) {
            case 'kriteria':
                $this->dataKriteria();
                break;
            case 'keterampilan':
                $this->dataKeterampilan();
                break;
            case 'jabatan':
                $this->dataJabatan();
                break;
            case 'pangkat':
                $this->dataPangkat();
                break;
            default:
                break;
        }
    }

    private function dataKriteria(){
        $result = array();
		$sql = "SELECT 
                    code,
                    keterangan as name
                FROM 
                    kriteria ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result
        );
        echo json_encode($send);
	}

    private function dataKeterampilan(){
        $result = array();
		$sql = "SELECT 
                    id as code,
                    keterangan as name
                FROM 
                    keterampilan ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result
        );
        echo json_encode($send);
	}

    private function dataJabatan(){
        $result = array();
		$sql = "SELECT 
                    id as code,
                    nama as name
                FROM 
                    jabatan ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result
        );
        echo json_encode($send);
	}

    private function dataPangkat(){
        $result = array();
		$sql = "SELECT 
                    id as code,
                    nama as name
                FROM 
                    pangkat ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result
        );
        echo json_encode($send);
	}
} 

new Master($_POST['reason'], json_decode($_POST['session']), json_decode($_POST['data']));